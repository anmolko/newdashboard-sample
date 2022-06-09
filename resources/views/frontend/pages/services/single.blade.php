@extends('frontend.layouts.seo_master')
@section('css')
    <style>
           
    .custom-editor .media{
        display: block;
    }

    .custom-editor{
        font-size: 1.1875rem;
    }
    .canosoft-listing ul,.canosoft-listing ol {
        padding: 0;
        margin-left: 15px;
    }
   
    </style>
@endsection
@section('seo')
    <title>{{ucfirst(@$singleService->title)}} | @if(!empty(@$setting_data->website_name)) {{ucwords(@$setting_data->website_name)}} @else Canosoft - Let's make IT happen @endif </title>
    <meta name='description' itemprop='description'  content='{{ucfirst(@$singleService->meta_description)}}' />
    <meta name='keywords' content='{{ucfirst(@$singleService->meta_tags)}}' />
    <meta property='article:published_time' content='<?php if(@$singleService->updated_at !=''){?>{{@$singleService->updated_at}} <?php }else {?> {{@$singleService->created_at}} <?php }?>' />
    <meta property='article:section' content='article' />
    <meta property="og:description" content="{{ucfirst(@$singleService->meta_description)}}" />
    <meta property="og:title" content="{{ucfirst(@$singleService->meta_title)}}" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:type" content="IT-Coperation" />
    <meta property="og:locale" content="en-us" />
    <meta property="og:locale:alternate"  content="en-us" />
    <meta property="og:site_name" content="@if(!empty(@$setting_data->website_name)) {{ucwords(@$setting_data->website_name)}} @else Canosoft - Let's make IT happen @endif" />
    <meta property="og:image" content="<?php if(@$singleService->banner_image){?>{{asset('/images/service/'.@$singleService->banner_image)}}<?php }?>" />
    <meta property="og:image:url" content="<?php if(@$singleService->banner_image){?>{{asset('/images/service/'.@$singleService->banner_image)}}<?php }?>" />
    <meta property="og:image:size" content="300" />
@endsection

@section('content')

	<!-- SINGLE PROJECT-1
			============================================= -->
			<section id="project-1" class="bg-snow wide-60 inner-page-hero single-project division">
				<div class="container">
					<div class="row">


						<!-- PROJECT DISCRIPTION -->
						<div class="col-lg-10 offset-lg-1">
							<div class="project-description">


								<!-- PROJECT TITLE -->
								<div class="project-title">

									<!-- Title -->	
									<h2 class="h2-xl">{{ucwords(@$singleService->title)}}</h2>

									<p class="p-xl">
										{{@$singleService->sub_description}}
									</p>

								</div>


								<!-- PROJECT TEXT -->
								<div class="project-txt custom-editor canosoft-listing">

									<!-- Image -->
					 				<div class="project-inner-img mb-50">
										<img class="img-fluid" src="<?php if(@$singleService->banner_image){?>{{asset('/images/service/'.@$singleService->banner_image)}}<?php }?>" alt="{{@$singleService->slug}}" />
									</div>

                                    {!! @$singleService->description !!}
									

								</div>	<!-- END PROJECT TEXT -->


								<!-- MORE PROJECTS BUTTON -->
								<div class="more-projects text-end">
									<a href="{{route('service.frontend')}}"><h3 class="h3-md txt-400">More Services</h3></a>
								</div>


							</div>
						</div>	<!-- END PROJECT DISCRIPTION -->


					</div>	  <!-- End row -->
				</div>	   <!-- End container -->	
			</section>	<!-- END SINGLE PROJECT-1 -->


            	<!-- CALL TO ACTION-3
			============================================= -->
			<section id="cta-3" class="cta-section division">
				<div class="cta-3-holder bg-lightgrey">
					<div class="container">
						<div class="bg-white cta-3-wrapper">
							<div class="row d-flex align-items-center">


								<!-- CALL TO ACTION TEXT -->
								<div class="col-lg-7 col-lg-8">
									<div class="cta-3-txt">
										<h4 class="h4-xl">{{@$singleService->callAction->title}}</h4>
									</div>
								</div>


								<!-- CALL TO ACTION BUTTON -->
								<div class="col-lg-4">
									<div class="text-end">
										<div class="cta-3-btn text-center">
                                            @if($singleService->callAction->button)
											    <a href="{{@$singleService->callAction->link}}" class="btn btn-skyblue tra-grey-hover">{{@$singleService->callAction->button}}</a>
                                            @endif
                                        </div>	
									</div>
								</div>


							</div>
						</div>    <!-- End row -->
					</div>	   <!-- End container -->	
				</div>
			</section>	<!-- END CALL TO ACTION-3 -->


@endsection