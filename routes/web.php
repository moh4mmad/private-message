<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', 'MsgController@index');

Route::group(['prefix' => 'installer'], function () {
	
	Route::get('/', 'InstallController@Index')->name('installer');
	Route::get('/dbsetup', 'InstallController@DBForm')->name('dbinfo');
	Route::post('/dbsetup', 'InstallController@DBInfo')->name('up.dbinfo');
	Route::get('/google-recaptcha', 'InstallController@GoogleRecap')->name('gglinfo');
	Route::post('/google-recaptcha', 'InstallController@GoogleRecaptcha')->name('up.gglinfo');
	Route::get('/setup', 'InstallController@AdminForm')->name('AdminForm');
	Route::post('/setup', 'InstallController@AdminSetup')->name('AdminSetup');
	
});

Route::post('submit', 'MsgController@Submit')->name("submit");
Route::get('message/{token}', 'MsgController@Message')->name("message");
Route::get('message/attachment/{token}', 'MsgController@AttachDownload')->name("AttachDownload");
Route::post('message/{token}', 'MsgController@SubmitPassword')->name("SubmitPassword");
Route::get('about', 'MsgController@About')->name("about");
Route::get('faq', 'MsgController@FAQ')->name("faq");
Route::get('privacy', 'MsgController@Privacy')->name("privacy");
Route::get('support', 'MsgController@Support')->name("support");


Route::group(['prefix' => 'admin'], function () {
	
	Route::get('/dashboard', 'AdmController@dashboard')->name('dashboard');
	Route::post('/content', 'AdmController@ViewContent')->name('showcontent');
	Route::get('/messages', 'AdmController@Messages')->name('allmessages');
	Route::post('/removemsg', 'AdmController@RemoveMSG')->name('RemoveMSG');
	Route::get('/attachment/{id}', 'AdmController@DownloadAttach')->name('DownloadAttach');
	
	Route::get('/profile', 'AdmController@Profile')->name('profile');
	Route::post('/profile', 'AdmController@ProfileUP')->name('profileupdate');
	Route::get('/newadmin', 'AdmController@NewAdmin')->name('newadmin');
	
	Route::post('/newadmin', 'AdminAuth\RegisterController@register')->name('addadmin');
	
	Route::group(['prefix' => 'settings'], function () {
		Route::get('/frontend', 'AdmController@FrontEND')->name('FrontEND');
		Route::post('/system', 'AdmController@SysUP')->name('sysup');
		Route::get('/messages', 'AdmController@MessageSetting')->name('messages');
		Route::get('/pages', 'AdmController@Pages')->name('pages');
		Route::post('/pages', 'AdmController@PagesUP')->name('pageup');
		Route::get('/captcha', 'AdmController@Captcha')->name('captcha');
		Route::get('/mail', 'AdmController@Mailer')->name('mail');
		Route::post('/mail', 'AdmController@MailerUP')->name('mailup');
		Route::get('/template', 'AdmController@Template')->name('template');
		Route::post('/template', 'AdmController@TemplateUP')->name('TemplateUP');
		Route::get('/social', 'AdmController@Social')->name('social');
		Route::post('/social', 'AdmController@SocialAdd')->name('socialadd');
		Route::post('/editsocial', 'AdmController@SocialEdit')->name('editsocial');
		Route::post('/removesocial', 'AdmController@SocialRemove')->name('removesocial');
		
	});
	
  Route::get('/', 'AdminAuth\LoginController@showLoginForm');
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm');
  Route::post('/login', 'AdminAuth\LoginController@login')->name('admin.login');
  Route::get('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');
  Route::get('/forgot-password', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.forget.pass');
  Route::post('/forgot-password', 'AdminAuth\ForgotPasswordController@passreset')->name('admin.forget.pass.post');
  Route::get('/password-reset/{token}', 'AdminAuth\ForgotPasswordController@resetLink')->name('admin.forget.reset');
  Route::post('/password-reset/{token}', 'AdminAuth\ForgotPasswordController@passwordReset')->name('admin.forget.reset.post');
	
	
	
	
	
});