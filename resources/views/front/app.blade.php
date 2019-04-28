<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	<meta charset="UTF-8">
    <meta name="description" content="{{$front->description}}">
	<meta name="keywords" content="{{$front->keywords}}">
	<meta name="author" content="Sakib">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{asset('assets/images/icons/favicon.ico')}}"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/animate/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/css-hamburgers/hamburgers.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/animsition/css/animsition.min.css')}}>

	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.datetimepicker.min.css')}}">
	<script src='https://www.google.com/recaptcha/api.js'></script>




</head>


<body>
<div id="loading" class="loading"></div>

	<div class="container-contact100" >
		<div style="background-color: {{$front->bg_color}}; background-image:url({{$front->bg_image}});" class="contact100-map"></div>

		<div style=" "class="wrap-contact100">
			<div class="contact100-form-title" style="background-color: {{$front->header_bg}};">
				<i style="color: #fff;" class="{{$front->header_icon}} fa-4x"></i>
				<a href="{{ url('/') }}">
				<span class="contact100-form-title-1">
					 {{$front->header_title}}
				</span>
				</a>
				<span class="contact100-form-title-2">
					{{$front->header_description}}
				</span>
			</div>

			@yield('content')

		<section id="footer">
		<div class="container">
			<div class="row text-center text-xs-center text-sm-left text-md-left">
				<div class="col-xs-12 col-sm-4 col-md-4">

					<ul class="list-unstyled quick-links">
						<li><a href="{{ route('about') }}"><i class="fa fa-angle-double-right"></i>About</a></li>
						<li><a href="{{ route('faq') }}"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
						<li><a href="{{ route('privacy') }}"><i class="fa fa-angle-double-right"></i>Privacy</a></li>
						<li><a href="{{ route('support') }}"><i class="fa fa-angle-double-right"></i>Support</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
					<ul class="list-unstyled list-inline social text-center">
					@foreach($socials as $social)
						<li class="list-inline-item"><a target="_blank" href="{{$social->url}}"><i class="{{$social->icon}}"></i></a></li>
						@endforeach
					</ul>
				</div>
				</hr>
			</div>	
				</div>
			</div>
			
			<div class="row">

		</div>
		</div>
	</section>
</div>
                
		

<div class="copy-wthree">
		<p>{!!$front->footer!!}
		</p>
	</div>

</div>	
	
@yield('modal')

	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="{{asset('assets/js/jquery.datetimepicker.full.min.js')}}"></script>
	<script src="{{asset('assets/js/notify.min.js')}}"></script>
	<script src="{{asset('assets/js/main.js')}}"></script>
	<script>
	$("#loading").hide();
   </script>
	@yield('script')
	@if (Session::has('error'))
   <script>
	$.notify("{{ Session::get('error') }}","error");
   </script>
   @endif


</body>
</html>
