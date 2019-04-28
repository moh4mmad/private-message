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
    
    <link href="{{asset('assets/adm/css/pages/dashboard.css')}}" rel="stylesheet">   

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
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <i class="icon-cog"></i>
    </button>
    <a class="navbar-brand" href="{{ url('/') }}">{{$front->title}}</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav navbar-right">


		<li class="dropdown">
						
			<a href="javscript:;" class="dropdown-toggle" data-toggle="dropdown">
				<i class="icon-user"></i>
				@php
				$admin = \Auth::guard('admin')->user();
				@endphp
				{{$admin->name}}
				<b class="caret"></b>
			</a>
			
			<ul class="dropdown-menu">
				<li><a href="{{ route('profile') }}">My Profile</a></li>
				<li class="divider"></li>
				<li><a href="{{ route('admin.logout') }}">Logout</a></li>
			</ul>
			
		</li>
    </ul>
  </div><!-- /.navbar-collapse -->
</div> <!-- /.container -->
</nav>
    



    
<div class="subnavbar">

	<div class="subnavbar-inner">
	
		<div class="container">
			
			<a href="javascript:;" class="subnav-toggle" data-toggle="collapse" data-target=".subnav-collapse">
		      <span class="sr-only">Toggle navigation</span>
		      <i class="icon-reorder"></i>
		      
		    </a>

			<div class="collapse subnav-collapse">
				<ul class="mainnav">
				
					<li class="@if(request()->path() == 'admin/dashboard') active @endif">
						<a href="{{ route('dashboard') }}">
							<i class="icon-home"></i>
							<span>Dashboard</span>
						</a>	    				
					</li>
					<li class="@if(request()->path() == 'admin/messages') active @endif">
						<a href="{{ route('allmessages') }}">
							<i class="icon-envelope"></i>
							<span>Messages</span>
						</a>	    				
					</li>
					
					
					
					<li class="{{ Request::is('admin/settings/*') ? 'active' : ''}} dropdown">					
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-wrench"></i>
							<span>Settings</span>
							<b class="caret"></b>
						</a>	    
					
						<ul class="dropdown-menu">
							<li class="@if(request()->path() == 'admin/settings/frontend') active @endif"><a href="{{ route('FrontEND') }}">Frontend settings</a></li>
							<li class="@if(request()->path() == 'admin/settings/pages') active @endif"><a href="{{ route('pages') }}">Pages settings</a></li>
							<li class="@if(request()->path() == 'admin/settings/messages') active @endif"><a href="{{ route('messages') }}">Message attachment settings</a></li>
							<li class="@if(request()->path() == 'admin/settings/captcha') active @endif"><a href="{{ route('captcha')}}">Google captcha settings</a></li>
							<li class="@if(request()->path() == 'admin/settings/mail') active @endif"><a href="{{ route('mail') }}">Mail settings</a></li>
							<li class="@if(request()->path() == 'admin/settings/template') active @endif"><a href="{{ route('template') }}">Mail template</a></li>
							<li class="@if(request()->path() == 'admin/settings/social') active @endif"><a href="{{ route('social') }}">Social settings</a></li>
						</ul> 				
					</li>
				
				
				</ul>
			</div> <!-- /.subnav-collapse -->

		</div> <!-- /container -->
	
	</div> <!-- /subnavbar-inner -->

</div> <!-- /subnavbar -->
    
    
<div class="main">

    <div class="container">

      <div class="row">
      	
      	@yield('content')
			
		</div> <!-- /row -->

	</div> <!-- /container -->

</div> <!-- /extra -->


    
    
<div class="footer">
		
	<div class="container">
		
		<div class="row">
			
			<div id="footer-copyright" class="col-md-6">
				{!!$front->footer!!}
			</div> <!-- /span6 -->
			
			<div id="footer-terms" class="col-md-6">
				Developed by <a href="https://sakib.info" target="_blank">S4K16</a>
			</div> <!-- /.span6 -->
			
		</div> <!-- /row -->
		
	</div> <!-- /container -->
	
</div> <!-- /footer -->
@yield('modal')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="{{asset('assets/adm/js/libs/jquery-ui-1.10.0.custom.min.js')}}"></script>
<script src="{{asset('assets/adm/js/libs/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/adm/js/plugins/msgGrowl/js/msgGrowl.js')}}"></script>
<script src="{{asset('assets/adm/js/plugins/flot/jquery.flot.js')}}"></script>
<script src="{{asset('assets/adm/js/plugins/flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('assets/adm/js/plugins/flot/jquery.flot.resize.js')}}"></script>

<script src="{{asset('assets/adm/js/Application.js')}}"></script>

@yield('script')

@if (Session::has('alert'))
   <script>
	$.msgGrowl ({
			type: 'error'
			, title: 'Error'
			, text: "{{ Session::get('alert') }}"
		});
   </script>
   @endif

  </body>

</html>
