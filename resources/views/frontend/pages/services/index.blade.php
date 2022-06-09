@extends('frontend.layouts.master')
@section('title') Services @endsection

@section('content')



    <!-- allservices-1
    ============================================= -->
    <section id="projects-1" class="wide-50 inner-page-hero projects-section division">
        <div class="container">


            <!-- SECTION TITLE -->	
            <div class="row justify-content-center">	
                <div class="col-lg-10 col-xl-8">
                    <div class="section-title title-01 mb-80">		

                        <!-- Title -->	
                        <h2 class="h2-md">Our Avaibale Services</h2>	

                        <!-- Text -->	
                        <p class="p-xl">
                        </p>
                            
                    </div>	
                </div>
            </div>


            <!-- PROJECTS-1 WRAPPER -->
            <div class="row">	
                <div class="col gallery-items-list">
                    <div class="masonry-wrap grid-loaded">
                    
                        @if(count($allservices) > 0)
                            @foreach($allservices as $service)
                            <div class="project-details masonry-image">

                                <!-- Image -->
                                <div class="project-preview rel">
                                    <div class="hover-overlay"> 
                                    <a href="{{route('service.single',$service->slug)}}"><img class="img-fluid" src="<?php if(@$service->banner_image){?>{{asset('/images/service/'.@$service->banner_image)}}<?php }?>" alt="services" /></a>
                                        <div class="item-overlay"></div>
                                    </div>
                                </div>

                                <!-- Text -->		
                                <div class="project-txt">

                                    <!-- Text -->	
                                    <!-- <p class="p-md grey-color"></p> -->

                                    <!-- Link -->	
                                    <h5 class="h5-lg">
                                        <a href="{{route('service.single',$service->slug)}}">{{ucwords(@$service->title)}}</a>
                                    </h5>
                                    
                                 

                                </div>	

                            </div>	
                            @endforeach
                        @else

                                <section class="no-results not-found">
                                    <header class="page-header">
                                        <h1 class="page-title">Nothing Found</h1>
                                    </header>
                                    <div class="page-content">
                                        <p>It seems we can not find what you are looking for.</p>
                                    
                                    </div>
                                </section>
                        @endif


                    </div>
                </div>
            </div>	<!-- END PROJECTS-1 WRAPPER -->


        </div>	   <!-- End container -->	
    </section>	<!-- END allservices-1 -->


    
        <!-- PAGE PAGINATION
        ============================================= -->
        <div class="pb-100 page-pagination division">
            <div class="container">
                <div class="row">	
                    <div class="col-md-12">
                        {{ $allservices->links('vendor.pagination.default') }}

                    </div>
                </div>  <!-- End row -->	
            </div> <!-- End container -->
        </div>	<!-- END PAGE PAGINATION -->

@endsection