
			<!-- FOOTER-1
			============================================= -->
			<footer id="footer-1" class="bg-lightgrey footer division">
				<div class="container">


					<!-- FOOTER CONTENT -->
					<div class="row">	


						<!-- FOOTER INFO -->
						<div class="col-lg-4">
							<div class="footer-info mb-40">

								<!-- Footer Logo -->	
								<img class="footer-logo mb-25" src="{{asset('assets/frontend/images/logo-01.png')}}" alt="footer-logo">

								<!-- Text -->	
								<p class="p-md">@if(!empty(@$setting_data->website_description)) {{ucwords(@$setting_data->website_description)}} @else Canosoft - Let's make IT happen @endif 
								</p>

							</div>	
						</div>	


						<!-- FOOTER LINKS -->
						<div class="col-sm-6 col-md-3 col-lg-2">
							<div class="footer-links mb-40">
							
								<!-- Title -->
								<h6 class="h6-xl">Company</h6>

								<!-- Footer Links -->
								<ul class="foo-links text-secondary clearfix">
									<li><p class="p-md"><a href="#">About Us</a></p></li>
									<li><p class="p-md"><a href="#">Careers</a></p></li>
									<li><p class="p-md"><a href="#">Press & Media</a></p></li>
									<li><p class="p-md"><a href="#">Contact Us</a></p></li>							
								</ul>

							</div>
						</div>


						<!-- FOOTER LINKS -->
						<div class="col-sm-6 col-md-3 col-lg-2">
							<div class="footer-links mb-40">
												
								<!-- Title -->
								<h6 class="h6-xl">Discover</h6>

								<!-- Footer List -->
								<ul class="foo-links text-secondary clearfix">
									<li><p class="p-md"><a href="#">Our Blog</a></p></li>
									<li><p class="p-md"><a href="#">Advertising</a></p></li>						
									<li><p class="p-md"><a href="#">Plans & Pricing</a></p></li>
									<li><p class="p-md"><a href="#">Testimonials</a></p></li>							
								</ul>

							</div>	
						</div>


						<!-- FOOTER LINKS -->
						<div class="col-sm-6 col-md-3 col-lg-2">
							<div class="footer-links mb-40">
							
								<!-- Title -->
								<h6 class="h6-xl">Legal</h6>

								<!-- Footer List -->
								<ul class="foo-links text-secondary clearfix">							
									<li><p class="p-md"><a href="#">Terms of Use</a></p></li>										
									<li><p class="p-md"><a href="#">Privacy Policy</a></p></li>
									<li><p class="p-md"><a href="#">Cookie Policy</a></p></li>
									<li><p class="p-md"><a href="#">Site Map</a></p></li>					
								</ul>

							</div>
						</div>


						<!-- FOOTER LINKS -->
						<div class="col-sm-6 col-md-3 col-lg-2">
							<div class="footer-links mb-40">
							
								<!-- Title -->
								<h6 class="h6-xl">Support</h6>

								<!-- Footer Links -->
								<ul class="foo-links text-secondary clearfix">
									<li><p class="p-md"><a href="#">FAQs</a></p></li>
									<li><p class="p-md"><a href="#">Editor Help</a></p></li>
									<li><p class="p-md"><a href="#">Community</a></p></li>											
									<li><p class="p-md"><a href="#">Live Chatting</a></p></li>								
								</ul>

							</div>
						</div>


					</div>	<!-- END FOOTER CONTENT -->


					<hr>


					<!-- BOTTOM FOOTER -->
					<div class="bottom-footer">
						<div class="row row-cols-1 row-cols-md-2 d-flex align-items-center">


							<!-- FOOTER COPYRIGHT -->
							<div class="col">
								<div class="footer-copyright">
									<p>&copy; 2022 Canosoft Technology. All Rights Reserved</p>
								</div>
							</div>


							<!-- BOTTOM FOOTER LINKS -->
							<div class="col">
								<ul class="bottom-footer-list text-secondary text-end">
									@if(!empty(@$setting_data->facebook))
										<li class="first-li"><p><a href="@if(!empty(@$setting_data->facebook)) {{@$setting_data->facebook}} @endif" target="_blank">Facebook</a></p></li>
									@endif
									@if(!empty(@$setting_data->youtube))
										<li><p><a href="@if(!empty(@$setting_data->youtube)) {{@$setting_data->youtube}} @endif" target="_blank">Youtube</a></p></li>
									@endif
									@if(!empty(@$setting_data->linkedin))
										<li class="last-li"><p><a href="@if(!empty(@$setting_data->linkedin)) {{@$setting_data->linkedin}} @endif" target="_blank">LinkedIn</a></p></li>
									@endif
								</ul>
							</div>


						</div>  <!-- End row -->
					</div>	<!-- BOTTOM FOOTER -->


				</div>
			</footer>	<!-- END FOOTER-1 -->


		</div>	<!-- END PAGE CONTENT -->	
			

		<!-- EXTERNAL SCRIPTS
		============================================= -->	

		<script src="{{asset('assets/frontend/js/jquery-3.6.0.min.js')}}"></script>
		<script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>	
		<script src="{{asset('assets/frontend/js/modernizr.custom.js')}}"></script>
		<script src="{{asset('assets/frontend/js/jquery.easing.js')}}"></script>
		<script src="{{asset('assets/frontend/js/jquery.appear.js')}}"></script>
		<script src="{{asset('assets/frontend/js/jquery.scrollto.js')}}"></script>	
		<script src="{{asset('assets/frontend/js/menu.js')}}"></script>
		<script src="{{asset('assets/frontend/js/imagesloaded.pkgd.min.js')}}"></script>
		<script src="{{asset('assets/frontend/js/isotope.pkgd.min.js')}}"></script>
		<script src="{{asset('assets/frontend/js/owl.carousel.min.js')}}"></script>
		<script src="{{asset('assets/frontend/js/jquery.magnific-popup.min.js')}}"></script>
		<script src="{{asset('assets/frontend/js/jquery.validate.min.js')}}"></script>
		<script src="{{asset('assets/frontend/js/jquery.ajaxchimp.min.js')}}"></script>	
		<script src="{{asset('assets/frontend/js/wow.js')}}"></script>
				
		<script src="{{asset('assets/frontend/js/custom.js')}}"></script>
		<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		</script>
        @yield('js')




	</body>


</html>