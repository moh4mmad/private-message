<?php



namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Crypt;
use Session;
use App\Front;
use App\Social;
use App\Msg;
use App\IPs;
use App\Pages;
use App\Attachments;
use App\Template;
use Hash;
use Mail;


class MsgController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('checkinstall');
    }
	
	public function index()
    {
		return view('front.index');
    }
	
	public function Submit(Request $request)
    {
		
	
	 	  $this->validate($request,
                [
                    'content' => 'required',
					'destruct_time' => 'required',
					'maxview' => 'required',
                ]);
		$mailer = 0;
		if ($request->has('email')){
			if(!$request->email == null || !$request->email == ""){
			$this->validate($request,
                [
                    'email' => 'required|email',
                ]);
			$mailer = 1;
			}
		}
	    $capdata = $request->input('g-recaptcha-response');
		
		if($this->captcha_verify($capdata) == false ){
        $err = "{\"message\":\"The given data was invalid.\",\"errors\":{\"captcha\":[\"CAPTCHA Verification Failed.\"]}}";
			  $arr = json_decode($err, true);
			  return response()->json($arr, 422);
        }
				
		  if ($request->has('use_password')){
			  
			  if($request->password == null || $request->password == ""){
			  $password = null;
			  $err = "{\"message\":\"The given data was invalid.\",\"errors\":{\"password\":[\"Password is required.\"]}}";
			  $arr = json_decode($err, true);
			  return response()->json($arr, 422);
			  }
			  else {
				  $use_password = 1;
				  $password = $request->password;
			  }
		  } else {
			  $use_password = 0;
		  }

		  if ($request->has('ip_restriction')){
			  
			  if($request->ips == null || $request->ips == ""){
			  
			  $err = "{\"message\":\"The given data was invalid.\",\"errors\":{\"ips\":[\"IP Addresses are required.\"]}}";
			  $arr = json_decode($err, true);
			  return response()->json($arr, 422);
			  }
			  else{
				  $ip_restriction = 1;
			  }
				  
			  			  
		  } else {
			  $ip_restriction = 0;
		  }
		  if($ip_restriction == 1){
		    $ips = explode(PHP_EOL,$request->ips);
			for($i=0; $i < count($ips); $i++){
				if (filter_var($ips[$i], FILTER_VALIDATE_IP)) {
					
				}
				else {
			  $err = "{\"message\":\"The given data was invalid.\",\"errors\":{\"ips\":[\"$ips[$i] should be valid ip address.\"]}}";
			  $arr = json_decode($err, true);
			  return response()->json($arr, 422);
			}
 			}
		  }
		  
		  if ($request->has('file_attach')){
			  
			  $sys = Front::first();
			  $this->validate($request,
                [
                    'attachment' => 'required|max:'.$sys->max_size .''
                ]);
			    $attachment = 1;
				
				
				if($request->hasFile('attachment'))
				{
					$ext = explode(",",$sys->allowed_file);
				    $extention = pathinfo($request->attachment->getClientOriginalName(), PATHINFO_EXTENSION);
					$file = pathinfo($request->attachment->getClientOriginalName(), PATHINFO_FILENAME);
					if (in_array($extention, $ext)) { 
					$secure_file = str_random(32);
					$request->attachment->move('main/public/files/'.$sys->secure_folder,$secure_file);
					} else {
						 $err = "{\"message\":\"The given data was invalid.\",\"errors\":{\"extention\":[\"$extention is not allowed.\"]}}";
						 $arr = json_decode($err, true);
						 return response()->json($arr, 422);
					}
					
				}
				
				
		  } else {
			   $attachment = 0;
		  }
		  
		 if(strtotime($request->destruct_time) < time())
		 {
			  $err = "{\"message\":\"The given data was invalid.\",\"errors\":{\"destruct_time\":[\"date should be in future.\"]}}";
			  $arr = json_decode($err, true);
			  return response()->json($arr, 422);
		 }
		 
		$secret = str_random(32);
		$client_ip = \Request::ip();
		$msg['by'] = $client_ip;
		$msg['secret'] = $secret;
		$msg['message'] = Crypt::encryptString($request->content);
		$msg['destroy_in'] = $request->destruct_time;
		if($request->maxview == 0){
			$msg['maxview'] = 1;
		} else {
		$msg['maxview'] = $request->maxview;
		}
		$msg['use_password'] = $use_password;
	    if ($use_password == 1) {
		$msg['password'] = bcrypt($password);
		}
		else {
			$msg['password'] = null;
		}
		$msg['ip_restriction'] = $ip_restriction;
		$msg['attachment'] = $attachment;
		$var = Msg::create($msg);
		
		if($ip_restriction == 1){
			
			$ips = explode(PHP_EOL,$request->ips);
			for($i=0; $i< count($ips); $i++){
				$store_ip['messageid'] = $var->id;
				$store_ip['ip'] = $ips[$i];
				IPs::create($store_ip);
 			}	
		}
		
		if($attachment == 1)
		{
			
			$attachments['secret'] = $secure_file;
			$attachments['messageid'] = $var->id;
			$attachments['filename'] = $file.".".$extention;
			Attachments::create($attachments);
		}
		$url = route("message", $secret);
		
		
		if($mailer == 1)
		{
		
		$temp = Template::first();
		$subject = $temp->subject;
		$mailbody = $temp->body;
		$replaceURL = str_replace("{{url}}",$url,$mailbody);
		$replaceIP = str_replace("{{ip}}",$client_ip,$replaceURL);
		$body = str_replace("{{destruct_time}}",$request->destruct_time,$replaceIP);
		Mail::send([], [], function ($message) use ($request,$subject,$body) {
			$message->to($request->email)->subject($subject)->setBody($body, 'text/html');
			});
		}
		
		$data = "{\"request\":\"success.\",\"message\":{\"message\":[\"$url\"]}}";
		$msg = json_decode($data, true);
	    return response()->json($msg, 200);
		
	}
	
	
	public function captcha_verify($value)
    {
		$sys = Front::first();
		$post_data = http_build_query(
		array('secret' => $sys->GOOGLE_RECAPTCHA_SECRET,
        'response' => $value));
		$opts = array('http' =>
		array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $post_data));
		$context  = stream_context_create($opts);
		$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
		$result = json_decode($response);
		if (!$result->success) {
			return false;
			}
			else {
				return true;
			}
	 }
	
	
	public function Message($token)
	{
		
		$content = Msg::where('secret',$token)->first();

		$ip_flag = true;

		if($content){
			
			
			if($content->ip_restriction == 1)
			{
				$ip = \Request::ip();
				if (IPs::where("messageid",$content->id)->where("ip", $ip)->exists()) {
					$ip_flag = true;
				}
				else
				{
					$ip_flag = false;
					Session::flash('error', "You dont have access into this message.");
					return \Redirect("/");
				}
			}
			if($ip_flag == true)
			{
			if(strtotime($content->destroy_in) > time() ){
			if($content->maxview > $content->viewcount){
			

			$message = Crypt::decryptString($content->message);
			if (Session::has('password_varification')){
			$code = Session::get('secret_code');
			$varify = Session::get('password_varification');
			if($varify == true && $code == $content->secret)
			{
				$content["viewcount"] += 1;
				$content->save();
				if($content->attachment == 1){ 
				$attach = Attachments::where("messageid", $content->id)->first();
				return view('front.message',compact('content', 'message','attach'));
				} else {
					return view('front.message',compact('content', 'message'));
					}
			}
			}
			if($content->use_password == 0){
				$content["viewcount"] += 1;
				$content->save();
		if($content->attachment == 1){
			$attach = Attachments::where("messageid", $content->id)->first();
			return view('front.message',compact('content', 'message','attach'));
		} else {
			return view('front.message',compact('content', 'message'));
		}
		} else{
			return view('front.password',compact('token'));
		}
		} else {
			Session::flash('error', "The message has been expired.");
			return \Redirect("/");
		}
		} else {
			Session::flash('error', "The message has been expired.");
			return \Redirect("/");
		}
		}
		}
		else{
			Session::flash('error', "Invalid token.");
			return \Redirect("/");
		}
		
	}
	
	public function AttachDownload($token)
	{
		
		$socials = Social::all();
		$attach = Attachments::where("secret", $token)->first();
		if($attach){
		$content = Msg::where('id',$attach->messageid)->first();
		
		if(strtotime($content->destroy_in) > time() ){
		if($content->maxview > $content->viewcount){
		
		
		
		if (Session::has('password_varification')){
			$varify = Session::get('password_varification');
			$code = Session::get('secret_code');
			if($varify == true && $code == $content->secret)
			{
				$sys = Front::first();
				$folder = "/files/".$sys->secure_folder ."/". $attach->secret;
				$file = public_path($folder);
				return \Response::download($file, $attach->filename);
			}
		}

		$token = $content->secret;
		if($content->use_password == 0){
				
		$sys = Front::first();
		$folder = "/files/".$sys->secure_folder ."/". $attach->secret;
		$file = public_path($folder);
	    return \Response::download($file, $attach->filename);
		} else {
			return view('front.password',compact('token'));
		}
		} else {
			Session::flash('error', "The message has been expired.");
			return \Redirect("/");
		}
		} else {
			Session::flash('error', "The message has been expired.");
			return \Redirect("/");
		}
		
		}
		else{
			Session::flash('error', "Invalid request.");
			return \Redirect("/");
		}
	 }
	 
	 public function SubmitPassword(Request $request,$token)
	 {
		 $this->validate($request,
                [
                    'password' => 'required',
                ]);
		 $capdata = $request->input('g-recaptcha-response');
		if($this->captcha_verify($capdata) == false ){
        $err = "{\"message\":\"The given data was invalid.\",\"errors\":{\"captcha\":[\"CAPTCHA Verification Failed.\"]}}";
			  $arr = json_decode($err, true);
			  return response()->json($arr, 422);
        }
		 
		 
		 $content = Msg::where('secret',$token)->first();
		 if($content->use_password == 1){
			 
			 if(Hash::check(Input::get('password'), $content['password']))
			 {
				 Session::put('password_varification', true);
				 Session::put('secret_code', $content->secret);
				 $err = "{\"message\":\"success.\",\"var\":{\"password\":[\"Password varified.\"]}}";
			     $arr = json_decode($err, true);
			    return response()->json($arr, 200);
			 } else {
			  $err = "{\"message\":\"The given data was invalid.\",\"errors\":{\"password\":[\"Password doesn't match.\"]}}";
			  $arr = json_decode($err, true);
			  return response()->json($arr, 422);
			 }
		 }
		 else {
			 Session::flash('error', "Invalid request.");
			 return \Redirect("/");
		 }
	 }
	
	public function About()
	{
		
		$contents = Pages::first();
		$title = "About";
		$content = $contents->about;
		return view('front.page',compact('content','title'));
	}
	
	public function FAQ()
	{
		
		$contents = Pages::first();
		$title = "FAQ";
		$content = $contents->faq;
		return view('front.page',compact('content','title'));
	}
	
	public function Privacy()
	{
		$contents = Pages::first();
		$title = "Privacy";
		$content = $contents->privacy;
		return view('front.page',compact('content','title'));
	}
	
	public function Support()
	{
		
		$contents = Pages::first();
		$title = "Support";
		$content = $contents->support;
		return view('front.page',compact('content','title'));
	}
	
}