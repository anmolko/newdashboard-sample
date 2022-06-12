
@extends('frontend.layouts.master')
@section('title') FAQ @endsection
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
									<h2 class="h2-xs">Frequently Asked Questions</h2>

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




			<!-- FAQs-2
			============================================= -->
			<section id="faqs-2" class="wide-60 faqs-section division">				
				<div class="container">

                    @if(count($faqs) > 0)
					<!-- FAQs-2 QUESTIONS -->	
					<div class="faqs-2-questions">
						<div class="row row-cols-1 row-cols-lg-2">
						

							<!-- QUESTIONS HOLDER -->
                            @foreach($faqs->chunk(1) as $firstchunk)

							<div class="col">
								<div class="questions-holder pr-15">

									<!-- QUESTION #1 -->
                                    @foreach($firstchunk as $key=>$final)

									<div class="question wow fadeInUp">

										<!-- Question -->
										<h5 class="h5-md">  {{$final->name}}</h5>

										<!-- Answer -->
										<p class="p-lg">{{$final->description}}
										</p>

									</div>	
                                    @endforeach


								</div>
							</div>	<!-- END QUESTIONS HOLDER -->

                            @endforeach

						</div>	<!-- End row -->
					</div>	<!-- END FAQs-2 QUESTIONS -->	
                    @endif


					<!-- MORE QUESTIONS BUTTON -->	
					<div class="row">
						<div class="col">	
							<div class="more-questions">
								<h5 class="h5-sm">Have more questions? <a href="{{route('contact')}}">Ask your question here</a></h5>
							</div>
						</div>
					</div>


				</div>	   <!-- End container -->		
			</section>	<!-- END FAQs-2 -->
@endsection