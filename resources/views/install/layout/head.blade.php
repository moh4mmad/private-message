<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Secret Message System Installer</title>

	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <!-- BASE CSS -->
    <link href="{{asset('assets/install/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/install/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('assets/install/css/vendors.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/install/css/icon_fonts/css/all_icons.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/install/css/skins/square/grey.css')}}" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
   <link href="{{asset('assets/install/css/custom.css')}}" rel="stylesheet">
	
	<script src="{{asset('assets/install/js/modernizr.js')}}"></script>

</head>

<body>
	
<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div>
	
	
	<main>
		@yield('content')
	</main>
	<footer>
		<div class="container clearfix">
			<p>© 2018 S4KIB</p>
		</div>
	</footer>
    <script src="{{asset('assets/install/js/jquery-2.2.4.min.js') }}"></script>
	<script src="{{asset('assets/install/js/common_scripts.min.js') }}"></script>
	@if (session('success'))
	<script>
	$("#success-modal").modal();
	</script>
	@endif
	<script>
	(function(_0xdb80x1) {
    'use strict';
    _0xdb80x1(window)['on']('load', function() {
        _0xdb80x1('[data-loader="circle-side"]')['fadeOut']();
        _0xdb80x1('#preloader')['delay'](350)['fadeOut']('slow');
        _0xdb80x1('body')['delay'](350);
        _0xdb80x1(window)['scroll']()
    });
})(window['jQuery'])
	</script>
</body>
</html>