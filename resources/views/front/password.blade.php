@section('title'){{$front->title}} - Verify password @endsection

@extends('front.app')

@section('content')
			<form class="contact100-form" enctype="multipart/form-data" id="password_verification" method="post">

				{{csrf_field()}}
	
				
				<div class="wrap-input100 validate-input" data-validate = "Password required">
					<span class="label-input100">Password:</span>
					<input class="input100" type="password" name="password" placeholder="Enter password to open message">
					<span class="focus-input100"></span>
				</div>
				<div class="g-recaptcha" data-sitekey="{{$front->GOOGLE_RECAPTCHA_KEY}}"></div>
				
				<div class="container-contact100-form-btn">
					<button id="submit" class="contact100-form-btn">
						<span>
							Submit
							<i class="fas fa-long-arrow-alt-right"></i>
						</span>
					</button>
				</div>
			
			</form>
			@endsection

  
  @section("script")
  <script>
  var passwordverification = '{{route('SubmitPassword', $token)}}';
  </script>
  @endsection