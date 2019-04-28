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
use App\Mailer;
use App\Template;
use Hash;
use Mail;
use File;
use Auth;
use Config;
use DateTimeZone;
use DateTime;

class AdmController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('checkinstall');
		$this->middleware('admin');
    }
	
	public function Profile()
	{
		
		$admin = Auth::guard('admin')->user();
		return view('adm.profile', compact('admin'));
		
	}
	
	public function ProfileUP(request $request)
	{
		
		$admin = Auth::guard('admin')->user();
		$this->validate($request,
                [
                    'name' => 'required',
					'email' => 'required|email',
                ]);
		if($request->password != "")
		{
		  $this->validate($request,
                [
                    'password' => 'required|string|min:6',
                ]);
			  $admin['password'] = bcrypt(Input::get('password'));

		  }
		
		$admin['name'] = $request->name;
		$admin['email'] = $request->email;
		$admin->save();
		$data = "{\"request\":\"success.\",\"message\":{\"content\":[\"done\"]}}";
		 $content = json_decode($data, true);
	     return response()->json($content, 200);
		
	}
	
	public function dashboard()
    {
		$msg['total'] = Msg::all()->count();
		$msg['read'] = Msg::where('viewcount', '>', 0)->count();
		$msg['unread'] = Msg::where('viewcount', 0)->count();
		$recent = Msg::orderBy('id', 'desc')->limit(20)->get();
		return view('adm.index', compact('msg','recent'));
    }
	
	public function NewAdmin()
	{
		return view('adm.addadmin');		
	}
	
	public function ViewContent(Request $request)
	{
		$this->validate($request,
                [
                    'id' => 'required',
                ]);
		 $msg = Msg::where('id', $request->id)->first();
		 $dmsg = Crypt::decryptString($msg->message);
		 $data = "{\"request\":\"success.\",\"message\":{\"content\":[\"$dmsg\"]}}";
		 $content = json_decode($data, true);
	     return response()->json($content, 200);
				
	}
	
	public function RemoveMSG(Request $request)
	{
		$this->validate($request,
                [
                    'id' => 'required',
                ]);
		 $msg = Msg::where('id', $request->id)->first();
		 if($msg){
			 if($msg->attachment == 1){
			 $attach = Attachments::where('messageid', $msg->id)->first();
			 if($attach){
			 $sys = Front::first();
			 $folder = "/files/".$sys->secure_folder ."/". $attach->secret;
			 $file = public_path($folder);
			 File::delete($file);
			 $attach->delete();
			 }
		 }
		 
		 if($msg->ip_restriction == 1){
			 IPs::where('messageid', $msg->id)->delete();
		 }
		 
		 $msg->delete();
		 $data = "{\"request\":\"success.\",\"message\":{\"content\":[\"Message removed\"]}}";
		 $content = json_decode($data, true);
	     return response()->json($content, 200);
		 }
				
	}
	
	public function SocialRemove(Request $request)
	{
		$this->validate($request,
                [
                    'id' => 'required',
                ]);
		 $social = Social::where('id', $request->id)->first();		 
		 $social->delete();
		 $data = "{\"request\":\"success.\",\"message\":{\"content\":[\"removed\"]}}";
		 $content = json_decode($data, true);
	     return response()->json($content, 200);
		 
				
	}
	
	public function SocialEdit(Request $request)
	{
		$this->validate($request,
                [
                    'id' => 'required',
					'icon' => 'required',
					'url' => 'required',
                ]);
		 $social = Social::where('id', $request->id)->first();		 
		 $social->icon = $request->icon;
		 $social->url = $request->url;
		 $social->save();
		 $data = "{\"request\":\"success.\",\"message\":{\"content\":[\"done\"]}}";
		 $content = json_decode($data, true);
	     return response()->json($content, 200);	
	}
		
	public function MailerUP(Request $request)
	{
		foreach ($request->except('_token') as $data => $value) {
				$valids[$data] = "required";
				}
		$request->validate($valids);
		 
		 $mailer = Mailer::first();

			foreach ($request->except('_token') as $data => $value) {
				$mailer[$data] = $value;
				}
			$mailer->save();
			
		 $data = "{\"request\":\"success.\",\"message\":{\"content\":[\"done\"]}}";
		 $content = json_decode($data, true);
	     return response()->json($content, 200);	
	}
				
	public function SysUP(Request $request)
	{
		
		
				
		foreach ($request->except('_token') as $data => $value) {
				$valids[$data] = "required";
				}
		$request->validate($valids);
		 
		 if($request->hasFile('favicon'))
		 {
			 $this->validate($request, [
			 'favicon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
			 ]);
			 $request->favicon->move('assets/images/icons','favicon.ico');
		}
		$sys = Front::first();

			foreach ($request->except('_token','timezone','favicon','bg_image') as $data => $value) {
				$sys[$data] = $value;
				}
			if($request->hasFile('bg_image'))
			{
				$this->validate($request, [
				'bg_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
				]);
				$bg_img = Input::file('bg_image');
				$sys['bg_image'] = 'data:image/' . pathinfo($bg_img, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($bg_img));
			}
			$sys->save();
			
			$this->setEnvironmentValue('APP_TIMEZONE', $request->timezone);
			
		 $data = "{\"request\":\"success.\",\"message\":{\"content\":[\"done\"]}}";
		 $content = json_decode($data, true);
	     return response()->json($content, 200);	
	}
	
	public function PagesUP(Request $request)
	{
		foreach ($request->except('_token') as $data => $value) {
				$valids[$data] = "required";
				}
		$request->validate($valids);
		 
		 $page = Pages::first();

			foreach ($request->except('_token') as $data => $value) {
				$page[$data] = $value;
				}
			$page->save();
			
		 $data = "{\"request\":\"success.\",\"message\":{\"content\":[\"done\"]}}";
		 $content = json_decode($data, true);
	     return response()->json($content, 200);	
	}
		
	public function TemplateUP(Request $request)
	{
		$this->validate($request,
                [
					'subject' => 'required',
					'body' => 'required',
                ]);
		 $template = Template::first();		 
		 $template->subject = $request->subject;
		 $template->body = $request->body;
		 $template->save();
		 $data = "{\"request\":\"success.\",\"message\":{\"content\":[\"done\"]}}";
		 $content = json_decode($data, true);
	     return response()->json($content, 200);	
	}
	
	public function SocialAdd(Request $request)
	{
		$this->validate($request,
                [
					'icon' => 'required',
					'url' => 'required',
                ]);
			 
		 $social['icon'] = $request->icon;
		 $social['url'] = $request->url;
		 Social::create($social);
		 $data = "{\"request\":\"success.\",\"message\":{\"content\":[\"done\"]}}";
		 $content = json_decode($data, true);
	     return response()->json($content, 200);

	}
	
	public function Messages()
	{
		$msgs = Msg::orderBy('id', 'desc')->paginate(15);
		return view('adm.msg', compact('msgs'));
	}
	
	public function DownloadAttach($id)
	{
		$attach = Attachments::where("messageid", $id)->first();
		if($attach){
		$sys = Front::first();
		$folder = "/files/".$sys->secure_folder ."/". $attach->secret;
		$file = public_path($folder);
			return \Response::download($file, $attach->filename);
		}
		else {
			return back()->with('alert', 'No attachment found.');
		}
	}
	
	public function FrontEND()
	{
		$current_tz = Config()->get('app.timezone');
		return view('adm.settings.frontend', compact('current_tz'));
	}
	public function MessageSetting()
	{
		return view('adm.settings.msg');
	}
	public function Pages()
	{
		$data = Pages::first();
		return view('adm.settings.pages', compact('data'));
	}
	
	public function Mailer()
	{
		$data = Mailer::first();
		return view('adm.settings.mail', compact('data'));
	}
	public function Captcha()
	{
		return view('adm.settings.captcha');
	}
	public function Template()
	{
		$data = Template::first();
		return view('adm.settings.template', compact('data'));
	}
	public function Social()
	{
		$data = Social::paginate(15);
		return view('adm.settings.social', compact('data'));
	}
	
	public function setEnvironmentValue(string $key, string $value, $env_path = null)
	{
		$value = preg_replace('/\s+/', '', $value);
		$key = strtoupper($key);
		$env = file_get_contents(isset($env_path) ? $env_path : base_path('.env'));
		$env = str_replace("$key=" . env($key), "$key=" . $value, $env);
		$env = file_put_contents(isset($env_path) ? $env_path : base_path('.env'), $env);
	}
	
}
