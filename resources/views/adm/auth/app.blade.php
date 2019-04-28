<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title') :: {{$front->title}}</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    
    <link rel="icon" type="image/png" href="{{asset('assets/images/icons/favicon.ico')}}"/>
    <link href="{{asset('assets/adm/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/adm/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="{{asset('assets/adm/css/font-awesome.min.css')}}" rel="stylesheet">        
    
    <link href="{{asset('assets/adm/css/ui-lightness/jquery-ui-1.10.0.custom.min.css')}}" rel="stylesheet">
    
    <link href="{{asset('assets/adm/css/base-admin-3.css')}}" rel="stylesheet">
    <link href="{{asset('assets/adm/css/base-admin-3-responsive.css')}}" rel="stylesheet">
    
    <link href="{{asset('assets/adm/css/pages/signin.css')}}" rel="stylesheet">   

    <link href="{{asset('assets/adm/css/custom.css')}}" rel="stylesheet">
	<link href="{{asset('assets/adm/js/plugins/msgGrowl/css/msgGrowl.css')}}" rel="stylesheet">
	@yield('css')
	
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

<body>
	
<nav class="navbar navbar-inverse" role="navigation">

	<div class="container">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <div class="navbar-brand">{{$front->title}}</div>
  </div>

</div> <!-- /.container -->
</nav>



@yield('content')


<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="{{asset('assets/adm/js/libs/jquery-ui-1.10.0.custom.min.js')}}"></script>
<script src="{{asset('assets/adm/js/libs/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/adm/js/plugins/msgGrowl/js/msgGrowl.js')}}"></script>

<script src="{{asset('assets/adm/js/Application.js')}}"></script>

<script src="{{asset('assets/adm/js/demo/signin.js')}}"></script>
@yield('script')
@if($errors->any())
   <script>
     $.msgGrowl ({
			type: 'error'
			, title: 'Alert'
			, text: '{{$errors->first()}}'
		});
   </script>
   @endif
</body>
</html>