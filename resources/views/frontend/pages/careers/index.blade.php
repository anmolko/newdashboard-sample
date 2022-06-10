@extends('frontend.layouts.master')
@section('title') Career @endsection
@section('content')
		<!-- PAGE HERO
			============================================= -->	
			<div id="faqs-page" class="page-hero-section division">
				<div class="page-hero-overlay division">
					<div class="container">	
						<div class="row justify-content-center">	
							<div class="col-lg-10 col-xl-8">
								<div class="hero-txt text-center white-color">

									<!-- Title -->
									<h2 class="h2-xs">Career</h2>

									<!-- Text -->	
									<p class="p-xl">
									</p>

								</div>
							</div>	
						</div>	  <!-- End row -->
					</div>	   <!-- End container --> 
				</div>	 <!-- End hero-overlay -->


				<!-- WAVE SHAPE BOTTOM -->	
				<div class="wave-shape-bottom">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80"><path fill="#ffffff" fill-opacity="1" d="M0,32L120,42.7C240,53,480,75,720,74.7C960,75,1200,53,1320,42.7L1440,32L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
				</div>
				

			</div>	<!-- END PAGE HERO -->	


			<section id="pricing-3" class="wide-60 pricing-section division">
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row justify-content-center">	
						<div class="col-md-10 col-lg-8">
							<div class="section-title title-02 mb-85">

								<!-- Section ID -->	
					 			<span class="section-id txt-upcase"></span>			

								<!-- Title -->	
								<h3 class="h3-lg"></h3>
								<!-- Text -->	
								<p class="p-xl">We are looking for team players who are passionate, adaptable and self-motivated. If you share our passion for success, we invite you to be a part of our amazing success story by taking up exciting growth opportunities with us.
								</p>	

							</div>	
						</div>
					</div>


					<!--  TABLES -->
					<div class="pricing-3-row pc-20">
						<div class="row row-cols-1 row-cols-md-3">

							<!-- BASIC PLAN -->
                            @if(count($allcareers) > 0)
                                @foreach($allcareers as $career)
                                    <div class="col">
                                        <div class="pricing-3-table bg-white rel mb-40 wow fadeInUp">	

                                            <!-- Hightlight Badge -->
                                            <div class="badge-wrapper">
                                                <div class="highlight-badge bg-skyblue white-color">
                                                    <h6 class="h6-md">
                                                        @if(@$career->type=="part_time")
                                                            Part Time
                                                        @else
                                                            Full Time
                                                        @endif
                                                    </h6>
                                                </div>
                                            </div>	
                                                            
                                            <!-- Plan Price  -->
                                            <div class="pricing-plan">
                                                <h6 class="h6-md"><a href="{{route('career.single',@$career->slug)}}">{{ucwords(@$career->name)}}</a></h6>									
                                                
                                            </div>	
                                                        
                                            <!-- Plan Features  -->
                                            <ul class="features">
                                                <li><p class="p-md"> Opening Positions :: <span>{{$career->position}}</span></p></li>
                                                @if(@$career->end_date)

                                                <li><p class="p-md"> Apply until :: <span>{{date('M j, Y',strtotime(@$career->end_date))}}</span></p></li>
                                                @else
                                                <li><p class="p-md"> Apply until :: <span>{{date('M j, Y', strtotime('+3 days', strtotime(date("Y-m-d"))))}}</span></p></li>
                                                
                                                @endif
                                                
                                                @if(@$career->salary)
                                                    <li><p class="p-md">Salary ::<span> {{$career->salary}}</span> </p></li>
                                                @else
                                                    <li><p class="p-md">Salary ::<span> Negotiable</span> </p></li>

                                                @endif
                                                
                                            </ul>

                                            <!-- Pricing Plan Button -->
                                            <a href="{{route('career.single',@$career->slug)}}" class="btn btn-green tra-grey-hover">Apply Now</a>

                                        </div>
                                    </div>	<!-- END BASIC PLAN -->
                                @endforeach
                            @endif

						</div>
					</div>	<!-- END  TABLES -->


				


				</div>	   <!-- End container -->
			</section>	
@endsection
