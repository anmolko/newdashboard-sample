<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="author" content="Canosoft Technology"/>	
		<meta name="description" content="@if(!empty(@$setting_data->website_description)) {{ucwords(@$setting_data->website_description)}} @else Canosoft - Let's make IT happen @endif "/>
		<meta name="keywords" content="@if(!empty(@$setting_data->meta_tags)) {{@$setting_data->meta_tags}} @else Canosoft - Let's make IT happen @endif ">	
		<link rel="canonical" href="https://canosoft.com.np/" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />

			<!-- SITE TITLE -->
		@if (\Request::is('/'))
		    <title>@if(!empty(@$setting_data->website_name)) {{ucwords(@$setting_data->website_name)}} @else Canosoft - Let's make IT happen @endif </title>
		@else
            <title>@yield('title') | @if(!empty(@$setting_data->website_name)) {{ucwords(@$setting_data->website_name)}} @else Canosoft - Let's make IT happen @endif </title>
		@endif			
		<meta property="og:title" content="@if(!empty(@$setting_data->meta_title)) {{ucwords(@$setting_data->meta_title)}} @else Canosoft - Let's make IT happen @endif" />
		<meta property="og:type" content="Web Developing" />
		<meta property="og:url" content="https://canosoft.com.np/" />
		<meta property="og:site_name" content="Canosoft - Let's make IT happen" />
		<meta property="og:description" content="@if(!empty(@$setting_data->meta_description)) {{ucwords(@$setting_data->meta_description)}} @else Canosoft - Let's make IT happen @endif " />


  	
		<!-- FAVICON AND TOUCH ICONS -->


		<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/frontend/images/apple-touch-icon.png')}}">
		<link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/frontend/images/favicon-32x32.png')}}">
		<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/frontend/images/favicon-16x16.png')}}">
		<link rel="manifest" href="{{asset('assets/frontend/images/site.webmanifest')}}">


		<!-- GOOGLE FONTS -->
		<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&amp;display=swap" rel="stylesheet">

		<!-- BOOTSTRAP CSS -->
		<link href="{{asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
		<!-- FONT ICONS -->
		<link href="{{asset('assets/frontend/css/flaticon.css')}}" rel="stylesheet">

		<!-- PLUGINS STYLESHEET -->
		<link href="{{asset('assets/frontend/css/menu.css')}}" rel="stylesheet">	
		<link id="effect" href="{{asset('assets/frontend/css/dropdown-effects/fade-down.css')}}" media="all" rel="stylesheet">
		<link href="{{asset('assets/frontend/css/magnific-popup.css')}}" rel="stylesheet">	
		<link href="{{asset('assets/frontend/css/owl.carousel.min.css')}}" rel="stylesheet">
		<link href="{{asset('assets/frontend/css/owl.theme.default.min.css')}}" rel="stylesheet">

		<!-- ON SCROLL ANIMATION -->
		<link href="{{asset('assets/frontend/css/animate.css')}}" rel="stylesheet">

		<!-- TEMPLATE CSS -->
		<link href="{{asset('assets/frontend/css/style.css')}}" rel="stylesheet"> 
		
		<!-- RESPONSIVE CSS -->
		<link href="{{asset('assets/frontend/css/responsive.css')}}" rel="stylesheet">
		<style>
			.tra-menu.navbar-light .scroll .wsmenu>.wsmenu-list>li.active a,.tra-menu.navbar-dark .wsmenu>.wsmenu-list>li.active>a
			{
				color:#2F72A3;
			}
		</style>
		<script src="{{asset('assets/frontend/js/jquery-3.6.0.min.js')}}"></script>

		 <!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id={{@$setting_data->google_analytics}}"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', '{{@$setting_data->google_analytics}}');
		</script>
        @yield('css')

	</head>



	<body>


		<!-- PRELOADER SPINNER
		============================================= -->	
		@if (\Request::is('/'))
		<div id="loading" class="skyblue-loading">
			<div id="loading-center">
				<div id="loading-center-absolute">
					<div class="object" id="object_one"></div>
					<div class="object" id="object_two"></div>
					<div class="object" id="object_three"></div>
					<div class="object" id="object_four"></div>
				</div>
			</div>
		</div>
		@endif




		<!-- PAGE CONTENT
		============================================= -->	
		<div id="page" class="page">


			<!-- HEADER
			============================================= -->
			<header id="header" class="header tra-menu @if(\Request::is('/') || \Request::route()->getName()=='faq.frontend' || \Request::route()->getName()=='career.frontend' || \Request::route()->getName()=='work.frontend') navbar-light @else navbar-dark @endif">
				<div class="header-wrapper">

					<!-- MOBILE HEADER -->
				    <div class="wsmobileheader clearfix">	  	
				    	<span class="smllogo"><img src="<?php if(@$setting_data->logo){?>{{asset('/images/settings/'.@$setting_data->logo)}}<?php }?>" alt="mobile-logo"/></span>
				    	<a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>	
				 	</div>


				 	<!-- NAVIGATION MENU -->
				  	<div class="wsmainfull menu clearfix">
	    				<div class="wsmainwp clearfix">


	    					<!-- HEADER LOGO -->
	    					<div class="desktoplogo"><a href="/" class="logo-black"><img src="<?php if(@$setting_data->logo){?>{{asset('/images/settings/'.@$setting_data->logo)}}<?php }?>" alt="header-logo"></a></div>
	    					<div class="desktoplogo"><a href="/" class="logo-white"><img src="<?php if(@$setting_data->logo_white){?>{{asset('/images/settings/'.@$setting_data->logo_white)}}<?php }?>" alt="header-logo"></a></div>


	    					<!-- MAIN MENU -->
	      					<nav class="wsmenu clearfix">
	        					<ul class="wsmenu-list nav-skyblue-hover">

	        					
									<li class="nl-simple {{request()->is('/') ? 'active' : ''}}" aria-haspopup="true" >
										<a href="/" class="">Home</a>
									</li>

									@if(!empty($top_nav_data))
										@foreach($top_nav_data as $nav)
										@if(!empty($nav->children[0]))

										<li aria-haspopup="true" class="{{request()->is(@$nav->slug)  ? 'active' : ''}}"><a href="#">@if(@$nav->name == NULL) {{ucwords(@$nav->title)}} @else {{ucwords(@$nav->name)}} @endif  <span class="wsarrow"></span></a>

											<ul class="sub-menu">
												@foreach($nav->children[0] as $childNav)
												@if($childNav->type == 'custom')
													<li aria-haspopup="true" class="{{request()->is(@$childNav->slug) ? 'active' : ''}}">
														<a href="/{{@$childNav->slug}}"  @if(@$childNav->target !== NULL) target="_blank" @endif>@if($childNav->name == NULL) {{@$childNav->title}} @else {{@$childNav->name}} @endif</a>
													</li>
												
												@elseif($childNav->type == 'post')
													<li aria-haspopup="true" class="{{request()->is('blog/'.@$childNav->slug) ? 'active' : ''}}">
														<a href="{{url('blog')}}/{{@$childNav->slug}}"  @if(@$childNav->target !== NULL) target="_blank" @endif>@if($childNav->name == NULL) {{@$childNav->title}} @else {{@$childNav->name}} @endif</a>
													</li>
												@elseif($childNav->type == 'service')
													<li aria-haspopup="true" class="{{request()->is('service/'.@$childNav->slug) ? 'active' : ''}}">
														<a href="{{url('service')}}/{{@$childNav->slug}}"  @if(@$childNav->target !== NULL) target="_blank" @endif>@if($childNav->name == NULL) {{@$childNav->title}} @else {{@$childNav->name}} @endif</a>
													</li>
													
												@else
													<li aria-haspopup="true" class="{{request()->is(@$childNav->slug) ? 'active' : ''}}">
														<a href="{{url('/')}}/{{@$childNav->slug}}"  @if(@$childNav->target !== NULL) target="_blank" @endif>@if($childNav->name == NULL) {{@$childNav->title}} @else {{@$childNav->name}} @endif</a>
													</li>
												@endif
												@endforeach

											</ul>
										</li>

										@else
											@if($nav->type == 'custom')
												<li class="nl-simple {{request()->is(@$nav->slug.'*') ? 'active' : ''}}" aria-haspopup="true" >
													<a href="/{{$nav->slug}}" class=""@if($nav->target == NULL)  @else target="{{$nav->target}}" @endif>@if($nav->name == NULL) {{$nav->title}} @else {{$nav->name}} @endif</a>
												</li>
											@elseif($nav->type == 'post')
												<li class="nl-simple {{request()->is('blog/'.@$nav->slug.'*') ? 'active' : ''}}" aria-haspopup="true" >
													<a href="{{url('blog')}}/{{$nav->slug}}" class="" @if($nav->target == NULL)  @else target="{{$nav->target}}" @endif>@if($nav->name == NULL) {{$nav->title}} @else {{$nav->name}} @endif</a>
												</li>
											@elseif($nav->type == 'service')
												<li class="nl-simple {{request()->is('service/'.@$nav->slug.'*') ? 'active' : ''}}" aria-haspopup="true" >
													<a href="{{url('service')}}/{{$nav->slug}}" class="" @if($nav->target == NULL)  @else target="{{$nav->target}}" @endif>@if($nav->name == NULL) {{$nav->title}} @else {{$nav->name}} @endif</a>
												</li>
												
											@else
												<li class="nl-simple {{request()->is(@$nav->slug.'*') ? 'active' : ''}}" aria-haspopup="true" >
													<a href="{{url('/')}}/{{$nav->slug}}" class="" @if($nav->target == NULL)  @else target="{{$nav->target}}" @endif>@if($nav->name == NULL) {{$nav->title}} @else {{$nav->name}} @endif</a>
												</li>
											@endif
										@endif
										@endforeach
									@endif


	        					</ul>
	        				</nav>	<!-- END MAIN MENU -->


	    				</div>
	    			</div>	<!-- END NAVIGATION MENU -->


				</div>     <!-- End header-wrapper -->
			</header>	<!-- END HEADER -->