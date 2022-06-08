<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="author" content="Canosoft Technology"/>	
		<link rel="canonical" href="" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />

        @yield('seo')

  	
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
			<header id="header" class="header tra-menu @if(\Request::is('/')) navbar-light @else navbar-dark @endif">
				<div class="header-wrapper">

					<!-- MOBILE HEADER -->
				    <div class="wsmobileheader clearfix">	  	
				    	<span class="smllogo"><img src="{{asset('assets/frontend/images/logo-01.png')}}" alt="mobile-logo"/></span>
				    	<a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>	
				 	</div>


				 	<!-- NAVIGATION MENU -->
				  	<div class="wsmainfull menu clearfix">
	    				<div class="wsmainwp clearfix">


	    					<!-- HEADER LOGO -->
	    					<div class="desktoplogo"><a href="/" class="logo-black"><img src="{{asset('assets/frontend/images/logo-01.png')}}" alt="header-logo"></a></div>
	    					<div class="desktoplogo"><a href="/" class="logo-white"><img src="{{asset('assets/frontend/images/logo-02.png')}}" alt="header-logo"></a></div>


	    					<!-- MAIN MENU -->
	      					<nav class="wsmenu clearfix">
	        					<ul class="wsmenu-list nav-skyblue-hover">


	        						<!-- MEGAMENU -->
						          	<li aria-haspopup="true" class="mg_link"><a href="#">Home <span class="wsarrow"></span></a>
	            						<div class="wsmegamenu w-75 clearfix">
	             							<div class="container">
	               								<div class="row">

	               									<!-- MEGAMENU LINKS -->
	               									<ul class="col-md-12 col-lg-3 link-list">
									                    <li class="fst-li"><a href="demo-1.html">App Landing</a></li>
									                    <li><a href="demo-2.html">App Showcase 1</a></li>
									                    <li><a href="demo-3.html">Startup Agency</a></li>
									                    <li><a href="demo-4.html">Design Agency</a></li>	
									                    <li><a href="demo-5.html">Software 1</a></li> 
									                    <li><a href="demo-6.html">SaaS Service 1</a></li> 
									                    <li><a href="demo-7.html">Digital Service 1</a></li>           
									                </ul>

									                <!-- MEGAMENU LINKS -->
	               									<ul class="col-md-12 col-lg-3 link-list">
									                    <li class="fst-li"><a href="demo-8.html">Social Media Marketing</a></li>
									                    <li><a href="demo-9.html">Digital Agency</a></li>	
									                    <li><a href="demo-10.html">SaaS Service 2</a></li> 
									                    <li><a href="demo-11.html">Desktop Software 1</a></li>
									                    <li><a href="demo-12.html">Digital Service 2</a></li> 
									                    <li><a href="demo-13.html">Software SaaS</a></li>
									                    <li><a href="demo-14.html">App Showcase 2</a></li>	               
									                </ul>

									                <!-- MEGAMENU LINKS -->
	               									<ul class="col-md-12 col-lg-3 link-list">
									                    <li class="fst-li"><a href="demo-15.html">Software 2</a></li>  
									                    <li><a href="demo-16.html">App Showcase 3</a></li>
									                    <li><a href="demo-17.html">Desktop Software 2</a></li>
									                    <li><a href="demo-18.html">SEO Company</a></li> 
									                    <li><a href="demo-19.html">Digital Marketing</a></li>	
									                    <li><a href="demo-20.html">Cyber Security</a></li> 
									                    <li><a href="demo-21.html">SaaS Service 3</a></li>  			           
									                </ul>

									               <!-- MEGAMENU LINKS -->
	               									<ul class="col-md-12 col-lg-3 link-list">
									                    <li class="fst-li"><a href="demo-22.html">Marketing Agency</a></li> 
									                    <li><a href="demo-23.html">Branding Agency</a></li> 
									                    <li><a href="404.html">404 Page</a></li>  
									                    <li><a href="demo-24.html">RTL Version #1</a></li>	
									                    <li><a href="demo-25.html">RTL Version #2</a></li>
									                    <li><a href="demo-26.html">RTL Version #3</a></li>    			           
									                </ul>
                
								                </div>  <!-- End row -->	
								            </div>  <!-- End container -->	
								        </div>  <!-- End wsmegamenu -->	
								    </li>	<!-- END MEGAMENU -->


	        						<!-- DROPDOWN MENU -->
						          	<li aria-haspopup="true"><a href="#">About <span class="wsarrow"></span></a>
	            						<ul class="sub-menu">
	            							<li aria-haspopup="true"><a href="#content-2">Why OLMO?</a></li>
	            							<li aria-haspopup="true"><a href="#content-3">Best Solutions</a></li>
	            							<li aria-haspopup="true"><a href="#content-2a">Integrations</a></li>
	            							<li aria-haspopup="true"><a href="#content-10">How It Works</a></li>
	            							<li aria-haspopup="true"><a href="#reviews-1">Testimonials</a></li>	 
						           		</ul>
								    </li>


							    	<!-- DROPDOWN MENU -->
						        	<li aria-haspopup="true"><a href="#">Pages <span class="wsarrow"></span></a>
						        		<div class="wsmegamenu clearfix halfmenu">
						              		<div class="container-fluid">
						                		<div class="row">

						                			<!-- Links -->
									                <ul class="col-lg-6 link-list">	
									                	<li><a href="about.html">About Us</a></li>							          
									                    <li><a href="features.html">Features & Addons</a></li>
									                    <li><a href="pricing.html">Pricing Packages</a></li>
									                    <li><a href="download.html">Download Page</a></li>
									                    <li><a href="projects.html">Our Projects</a></li>  
									                    <li><a href="project-details.html">Project Details</a></li>   
									                </ul>

								                  	<!-- Links -->
									                <ul class="col-lg-6 link-list">	
									                	<li><a href="team.html">Meet The Team</a></li>  			               
									                    <li><a href="faqs.html">FAQs Page</a></li>
									                    <li><a href="blog-listing.html">Blog Listing</a></li>
									                    <li><a href="single-post.html">Single Blog Post</a></li>
									                    <li><a href="terms.html">Terms & Privacy</a></li>
									                    <li><a href="contacts.html">Contact Us</a></li>
									                </ul>

						                		</div>
						              		</div>
						            	</div>
						          	</li>	<!-- END DROPDOWN MENU -->


						          	<!-- DROPDOWN MENU -->
						          	<li aria-haspopup="true"><a href="#">Auth Pages <span class="wsarrow"></span></a>
	            						<ul class="sub-menu">
	            							<li aria-haspopup="true"><a href="login-simple.html">Login Simple <span>NEW</span></a></li>	
	            							<li aria-haspopup="true"><a href="login-boxed.html">Login Boxed <span>NEW</span></a></li>
	            							<li aria-haspopup="true"><a href="login-image.html">Login Image <span>NEW</span></a></li>
	            							<li aria-haspopup="true"><a href="signup-simple.html">Signup Simple <span>NEW</span></a></li>
	            							<li aria-haspopup="true"><a href="signup-boxed.html">Signup Boxed <span>NEW</span></a></li>  
	            							<li aria-haspopup="true"><a href="signup-image.html">Signup Image <span>NEW</span></a></li>
	            							<li aria-haspopup="true"><a href="reset-password-1.html">Reset Pass. #1 <span>NEW</span></a></li>
	            							<li aria-haspopup="true"><a href="reset-password-2.html">Reset Pass. #2 <span>NEW</span></a></li>
						           		</ul>
								    </li>


						          	<!-- SIMPLE NAVIGATION LINK -->
							    	<li class="nl-simple" aria-haspopup="true"><a href="#features-8">Features</a></li>


							    	<!-- SIMPLE NAVIGATION LINK --> 
							    	<li class="nl-simple" aria-haspopup="true"><a href="#faqs-2">FAQs</a></li>


								    <!-- HEADER BUTTON -->
								    <li class="nl-simple" aria-haspopup="true">
								    	<a href="#cta-3" class="btn btn-skyblue tra-white-hover last-link">Let's Started</a>
								    </li> 


									<!-- HEADER SOCIAL LINKS 													
									<li class="nl-simple white-color header-socials ico-20 clearfix" aria-haspopup="true">
										<span><a href="#" class="ico-facebook"><span class="flaticon-facebook"></span></a></span>
										<span><a href="#" class="ico-twitter"><span class="flaticon-twitter"></span></a></span>
										<span><a href="#" class="ico-instagram"><span class="flaticon-instagram"></span></a></span>
										<span><a href="#" class="ico-dribbble"><span class="flaticon-dribbble"></span></a></span>	
									</li> -->	


	        					</ul>
	        				</nav>	<!-- END MAIN MENU -->


	    				</div>
	    			</div>	<!-- END NAVIGATION MENU -->


				</div>     <!-- End header-wrapper -->
			</header>	<!-- END HEADER -->