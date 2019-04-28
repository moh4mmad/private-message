<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use App\Admin;
use App\Front;
use Session;
use File;

class InstallController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('ifinstalled');
    }
	
	public function Index()
    {
       $extensions = [ 'openssl' ,'pdo', 'mbstring', 'tokenizer', 'JSON', 'cURL', 'XML', 'fileinfo' ];
	   $folders = [ '../public/files/','../bootstrap/cache/', '../storage/', '../storage/app/', '../storage/framework/', '../storage/logs/'];
	   return view('install.index', compact('extensions','folders')); 
    }
	public function DBForm()
    {
		return view('install.dbform');
    }
	
	public function GoogleRecap()
    {
		if( Session::get('DBInfo') == true){
			return view('install.recap'); 
		}
		else{
			return redirect()->route('dbinfo');
		}
    }
	
	public function GoogleRecaptcha(Request $request)
    {
		$this->validate($request,
            [
				'GOOGLE_RECAPTCHA_KEY' => 'required',
				'GOOGLE_RECAPTCHA_SECRET' => 'required',
            ]);
	   
	   $sys = Front::first();
	   $secure = str_random(32);
	   $path = "/files/".$secure;
	   File::makeDirectory(public_path($path), $mode = 0777, true, true);
	   
	   $sys['GOOGLE_RECAPTCHA_KEY'] = $request->GOOGLE_RECAPTCHA_KEY;
	   $sys['GOOGLE_RECAPTCHA_SECRET'] = $request->GOOGLE_RECAPTCHA_SECRET;
	   $sys['secure_folder'] = $secure;
	   $sys->save();
	   Session::put('ggl', true);
	   return redirect()->route('AdminForm');

    }
	
	public function AdminForm()
    {
		if(Session::get('DBInfo') == true && Session::get('ggl') == true){
		return view('install.admin'); 
		}
		else{
			return redirect()->route('installer');
		}
    }
	
	public function DBInfo(Request $request)
    {
		$this->validate($request,
            [
				'db_host' => 'required',
				'db_user' => 'required',
				'db_password' => 'required',
				'db_name' => 'required',
            ]);
	   
	   $dbcon = @mysqli_connect($request->db_host, $request->db_user, $request->db_password, $request->db_name);
	   if (mysqli_connect_errno())
	   {
	   return back()->with('alert', mysqli_connect_error());
	   }
	   if($dbcon == true)
	   {
		   $this->setEnvironmentValue("DB_HOST", $request->db_host);
		   $this->setEnvironmentValue("DB_DATABASE", $request->db_name);
		   $this->setEnvironmentValue("DB_USERNAME", $request->db_user);
		   $this->setEnvironmentValue("DB_PASSWORD", $request->db_password);
		   $this->setEnvironmentValue("APP_URL",url('/'));
    	   $check = $this->DBQuery($request->db_host, $request->db_name, $request->db_user, $request->db_password);
		   if($check == true ){
			   Session::put('DBInfo', true);
		   return redirect()->route('gglinfo');
		   }
		   else {
			   return back()->with('alert', "Unknown error. Please contact with developer.");
		   }
	   }
    }
	
	
	public function AdminSetup(Request $request)
    {
		$this->validate($request,
            [
				'admin_name' => 'required',
				'admin_username' => 'required',
				'admin_password' => 'required',
				'admin_email' => 'required',
				'timezone' => 'required',
            ]);
		
	  $user['name'] = $request->admin_name;
	  $user['username'] = $request->admin_username;
	  $user['email'] = $request->admin_email;
	  $user['password'] = bcrypt($request->admin_password);
	  
	  Admin::create($user);
	  $this->setEnvironmentValue("APP_ENV", "production");
	  $this->setEnvironmentValue("APP_TIMEZONE", $request->timezone);
	  return back()->with('success', "Installation Complete.");
	}
	
	
	public function setEnvironmentValue(string $key, string $value, $env_path = null)
	{
		$value = preg_replace('/\s+/', '', $value);
		$key = strtoupper($key);
		$env = file_get_contents(isset($env_path) ? $env_path : base_path('.env'));
		$env = str_replace("$key=" . env($key), "$key=" . $value, $env);
		$env = file_put_contents(isset($env_path) ? $env_path : base_path('.env'), $env);
	}
	
	
	public function DBQuery($host,$db,$user,$pass)
	{
	$conn = @mysqli_connect($host,$user,$pass,$db);
	if ($conn){
		$templine = '';
		$lines = file(public_path("files/secretmsg.sql"));
		foreach ($lines as $line)
		{
			if (substr($line, 0, 2) == '--' || $line == '')
				continue;
			$templine .= $line;
			if (substr(trim($line), -1, 1) == ';')
			{
				mysqli_query($conn, $templine) or mysqli_error();
				$templine = '';
				}
		}
		return true;
	}
	
	}
	
	
}