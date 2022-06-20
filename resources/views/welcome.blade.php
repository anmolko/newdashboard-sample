
@extends('frontend.layouts.master')
@section('css')
<link href="{{asset('assets/backend/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

<style>
    #hero-19 .quick-form {
        margin: 40px 5% 0;
    }
    .package-price{
        font-size: 2.25rem;
        font-weight: 500;
    }
    .domain-search-container {
        box-shadow: 0px 11px 92px 0px rgb(118 191 254 / 19%);
        transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
        margin: 20px 0px 40px 0px;
        --e-column-margin-right: 0px;
        --e-column-margin-left: 0px;
        padding: 30px 30px 30px 30px;
        background-color: #6c757d61;
        border-radius: 30px 30px 30px 30px;
    }

    .canosoft-listing{
        padding-top: 25px;
        margin-top: 25px;
        border-top: 1px solid #ccc;
    }
    .canosoft-listing ul,.canosoft-listing ol {
        font-size: 1.125rem;
    }

    .welcome-description ul{
        margin-top: 0;
        margin-bottom: 1rem;
        list-style: disc;
        padding-left: 2rem;
    }
    .domain-search-container .input-group {
        max-width: 100% !important;
        margin-left: 0px;
        margin: 0 auto;
        border: 1px solid #d6d6d6 !important;
        border-radius: 5px;
        margin-bottom: 20px;
        box-shadow: 0 2px 0 0px rgb(0 0 0 / 3%);
        border-radius: 5px 5px 5px 5px !important;
        position: relative;
        display: table;
        border-collapse: separate;
    }

    .large input.form-control.domain::placeholder {
        color: #a0a0a0;
    }
    .large input.form-control.domain {
        font-size: 18px;
        color: #a0a0a0;
        padding: 0 0 0 23px;
        height: 70px;
        border: 1px solid #fff;
        border-radius: 5px 0 0 5px !important;
        box-shadow: none;
        position: relative;
        z-index: 2;
        float: left;
        width: 100%;
        margin-bottom: 0;
        background-color: #fff;
    }

    .domain-search-container span.input-group-btn.form-btn {
        border: 4px solid #fff;
        border-radius: 0 5px 5px 0;
        background-color: #fff;
        position: relative;
        font-size: 0;
        width: 1%;
        white-space: nowrap;
        vertical-align: middle;
        display: table-cell;
    }

    .advantages li:after,.advantages li{
        color:white;
    }

    span.domain-type {
        color: white;
        font-weight: 500;
    }

    @media screen and (max-width: 767px){
        .domain-search-container .input-group {
            max-width: 100% !important;
            margin: 0 auto;
            overflow: hidden;
        }

        .large input.form-control.domain {
            height: 50px;
            padding: 0 0 0 0px;
            text-align: center;
            font-size: 14px;
        }
    }

    @media only screen and (max-width: 567px){
        .domain-search-container .input-group {
            display: block;
            width: 100%;
        }

        .domain-search-container span.input-group-btn.form-btn{
            border-radius: 5px !important;
            display: block;
            width: 100%;
        }

        .domain-search-container span.input-group-btn.form-btn button.btn.btn-md.btn-stateblue.black-hover.submit
        {
            right: 0px;
            font-size: 14px;
        }
    }

</style>
@endsection
@section('content')

    <!-- HERO-19
    ============================================= -->
    <section id="hero-19" class="bg-scroll hero-section division">
        <div class="container">
            <div class="row d-flex align-items-center">


                <!-- HERO TEXT -->
                <div class="col-md-10 offset-md-1">
                    <div class="hero-21-txt text-center white-color">

                        <!-- Title -->
                        <h2 class="h2-lg">Creativity never goes wrong, all you need is right direction</h2>

                        <!-- Text -->
                        <p class="p-xl">Mauris donec ociis et magnis sapien sagittis sapien tempor gravida
                        and aliquet suscipit in magna dignissim, porttitor hendrerit
                        </p>

                        <div class="domain-search-container">
                            <!-- HERO QUICK FORM -->
                            <form name="quickform" class="quick-form">

                                <!-- Form Inputs -->
                                <div class="input-group large">
                                    <input type="text" name="domain" class="form-control domain" placeholder="Type your domain address" autocomplete="off" required>
                                    <span class="input-group-btn form-btn">
                                        <button type="submit" class="btn btn-md btn-stateblue black-hover submit">Search</button>
                                    </span>
                                </div>

                                <!-- Form Message -->
                                <div class="quick-form-msg"><span class="loading"></span></div>

                            </form>

                            <!-- Advantages List -->
                            <ul class="advantages mt-35 mb-20">
                                <li class="first-li"><p><span class="domain-type">.com.np</span></p></li>
                                <li ><p><span class="domain-type">.com</span></p></li>
                                <li ><p><span class="domain-type">.net</span></p></li>
                                <li class="last-li"><p><span class="domain-type">.org</span></p></li>
                            </ul>
                        </div>

                    </div>
                </div>	<!-- END HERO TEXT -->


            </div>	   <!-- End row -->

        </div>	   <!-- End container -->
    </section>	<!-- END HERO-19 -->



    <!-- Welcome section-2
    ============================================= -->
    @if(!empty($homepage_info->welcome_description))
    <section id="content-2" class="content-2 wide-60 content-section division">
        <div class="container">
            <div class="row d-flex align-items-center">

                @if(@$homepage_info->welcome_side_image == "left") 
                    <!-- IMAGE BLOCK -->
                    <div class="col-md-5 col-lg-6">
                        <div class="rel img-block left-column wow fadeInRight">
                            <img class="img-fluid" src="<?php if(!empty(@$homepage_info->welcome_image)){ echo '/images/home/welcome/'.@$homepage_info->welcome_image; } ?>" alt="content-image">
                        </div>
                    </div>


                    <!-- TEXT BLOCK -->
                    <div class="col-md-7 col-lg-6">
                        <div class="txt-block right-column wow fadeInLeft">

                            <!-- Section ID -->
                            <span class="section-id txt-upcase">{{@$homepage_info->welcome_heading}}</span>

                            <!-- Title -->
                            <h2 class="h2-xs">{{@$homepage_info->welcome_subheading}}</h2>

                            <!-- Text -->
                            <div class="p-lg welcome-description"> {!! @$homepage_info->welcome_description !!}
                            </div>


                        </div>
                    </div>	<!-- END TEXT BLOCK -->

                @else

                    <!-- TEXT BLOCK -->
                    <div class="col-md-7 col-lg-6">
                        <div class="txt-block right-column wow fadeInLeft">

                            <!-- Section ID -->
                            <span class="section-id txt-upcase">{{@$homepage_info->welcome_heading}}</span>

                            <!-- Title -->
                            <h2 class="h2-xs">{{@$homepage_info->welcome_subheading}}</h2>

                            <!-- Text -->
                            <div class="p-lg welcome-description"> {!! @$homepage_info->welcome_description !!}
                            </div>


                        </div>
                    </div>	<!-- END TEXT BLOCK -->
                    <!-- IMAGE BLOCK -->
                    <div class="col-md-5 col-lg-6">
                        <div class="rel img-block left-column wow fadeInRight">
                            <img class="img-fluid" src="<?php if(!empty(@$homepage_info->welcome_image)){ echo '/images/home/welcome/'.@$homepage_info->welcome_image; } ?>" alt="content-image">
                        </div>
                    </div>


                  
                @endif


            </div>	   <!-- End row -->
        </div>	   <!-- End container -->
    </section>	<!-- END Welcome section-2 -->

    @endif


    <!-- CONTENT-5
    ============================================= -->
    <section id="content-5" class="content-5 ws-wrapper content-section division">
        <div class="container">
            <div class="content-5-wrapper bg-whitesmoke">
                <div class="row d-flex align-items-center">


                    <!-- TEXT BLOCK -->
                    <div class="col-md-7 col-lg-6">
                        <div class="txt-block left-column wow fadeInRight">

                            <!-- Section ID -->
                            <span class="section-id txt-upcase">Digital Strategy</span>

                            <!-- Title -->
                            <h2 class="h2-xs">We make your business gain more revenue at a glance</h2>

                            <!-- List -->
                            <ul class="simple-list">

                                <li class="list-item">
                                    <p class="p-lg">Fringilla risus, luctus mauris auctor euismod an iaculis luctus
                                        magna purus pretium ligula purus and quaerat sapien rutrum mauris auctor
                                    </p>
                                </li>

                                <li class="list-item">
                                    <p class="p-lg">Nemo ipsam egestas volute turpis dolores ligula and aliquam quaerat
                                        at sodales sapien purus
                                    </p>
                                </li>

                            </ul>

                        </div>
                    </div>	<!-- END TEXT BLOCK -->


                    <!-- IMAGE BLOCK -->
                    <div class="col-md-5 col-lg-6">
                        <div class="img-block right-column wow fadeInLeft">
                            <img class="img-fluid" src="images/img-17.png" alt="content-image">
                        </div>
                    </div>


                </div>
            </div>    <!-- End row -->
        </div>	   <!-- End container -->
    </section>	<!-- END CONTENT-5 -->




    <!-- CONTENT-3
    ============================================= -->
    <section id="content-3" class="content-3 wide-60 content-section division">
        <div class="container">


            <!-- SECTION TITLE -->
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="section-title title-01 mb-70">

                        <!-- Title -->
                        <h2 class="h2-md">Optimized Business Platform</h2>

                        <!-- Text -->
                        <p class="p-xl">Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis a libero
                            tempus, blandit and cursus varius and magnis sapien
                        </p>

                    </div>
                </div>
            </div>


            <!-- TOP ROW -->
            <div class="top-row pb-50">
                <div class="row d-flex align-items-center">


                    <!-- IMAGE BLOCK -->
                    <div class="col-md-5 col-lg-6">
                        <div class="img-block left-column wow fadeInRight">
                            <img class="img-fluid" src="images/img-14.png" alt="content-image">
                        </div>
                    </div>


                    <!-- TEXT BLOCK -->
                    <div class="col-md-7 col-lg-6">
                        <div class="txt-block right-column wow fadeInLeft">

                            <!-- Section ID -->
                            <span class="section-id txt-upcase">Totally Optimized</span>

                            <!-- Title -->
                            <h2 class="h2-xs">More productivity with less effort</h2>

                            <!-- Text -->
                            <p class="p-lg">Quaerat sodales sapien euismod blandit purus a purus ipsum primis in cubilia
                                laoreet augue luctus magna dolor luctus and egestas sapien egestas vitae nemo volute
                            </p>

                            <!-- Text -->
                            <p class="p-lg">Quaerat sodales sapien euismod blandit at vitae ipsum primis undo and cubilia
                                laoreet augue and luctus magna dolor luctus at egestas sapien vitae nemo egestas
                            </p>

                        </div>
                    </div>	<!-- END TEXT BLOCK -->


                </div>
            </div>	<!-- END TOP ROW -->


            <!-- BOTTOM ROW -->
            <div class="bottom-row">
                <div class="row d-flex align-items-center">


                    <!-- TEXT BLOCK -->
                    <div class="col-md-7 col-lg-6 order-last order-md-2">
                        <div class="txt-block left-column wow fadeInRight">

                            <!-- TEXT BOX -->
                            <div class="txt-box mb-20">

                                <!-- Title -->
                                <h5 class="h5-lg">Advanced Analytics Review</h5>

                                <!-- Text -->
                                <p class="p-lg">Quaerat sodales sapien euismod blandit at vitae ipsum primis undo and
                                    cubilia laoreet augue and luctus magna dolor luctus at egestas sapien vitae nemo egestas
                                    volute and turpis dolores aliquam quaerat sodales a sapien
                                </p>

                            </div>

                            <!-- TEXT BOX -->
                            <div class="txt-box">

                                <!-- Title -->
                                <h5 class="h5-lg">Search Engine Optimization (SEO)</h5>

                                <!-- List -->
                                <ul class="simple-list">

                                    <li class="list-item">
                                        <p class="p-lg">Fringilla risus, luctus mauris auctor euismod an iaculis luctus
                                            magna purus pretium ligula purus and quaerat
                                        </p>
                                    </li>

                                    <li class="list-item">
                                        <p class="p-lg">Nemo ipsam egestas volute turpis dolores undo ultrice aliquam quaerat
                                            at sodales sapien purus
                                        </p>
                                    </li>

                                </ul>

                            </div>	<!-- END TEXT BOX -->

                        </div>
                    </div>	<!-- END TEXT BLOCK -->


                    <!-- IMAGE BLOCK -->
                    <div class="col-md-5 col-lg-6 order-first order-md-2">
                        <div class="img-block right-column wow fadeInLeft">
                            <img class="img-fluid" src="images/img-15.png" alt="content-image">
                        </div>
                    </div>


                </div>
            </div>	<!-- END BOTTOM ROW -->


        </div>	   <!-- End container -->
    </section>	<!-- END CONTENT-3 -->




    <!-- CONTENT-2A
    ============================================= -->
    <section id="content-2a" class="content-2 bg-02 wide-60 content-section division">
        <div class="container">
            <div class="row d-flex align-items-center">


                <!-- IMAGE BLOCK -->
                <div class="col-md-5 col-lg-6">
                    <div class="rel img-block left-column wow fadeInRight">
                        <img class="img-fluid" src="images/img-10.png" alt="content-image">
                    </div>
                </div>


                <!-- TEXT BLOCK -->
                <div class="col-md-7 col-lg-6">
                    <div class="txt-block right-column white-color wow fadeInLeft">

                        <!-- Section ID -->
                        <span class="section-id txt-upcase">Monitor Your Growth</span>

                        <!-- Title -->
                        <h2 class="h2-xs">Committed to top quality and results</h2>

                        <!-- List -->
                        <ul class="simple-list">

                            <li class="list-item">
                                <p class="p-lg">Fringilla risus, luctus mauris orci auctor euismod iaculis luctus
                                    magna purus pretium ligula purus undo quaerat tempor sapien rutrum mauris quaerat ultrice
                                </p>
                            </li>

                            <li class="list-item">
                                <p class="p-lg">Quaerat sodales sapien euismod purus blandit</p>
                            </li>

                            <li class="list-item">
                                <p class="p-lg">Nemo ipsam egestas volute turpis dolores undo ultrice aliquam
                                    quaerat at sodales sapien purus
                                </p>
                            </li>

                        </ul>

                    </div>
                </div>	<!-- END TEXT BLOCK -->


            </div>	   <!-- End row -->
        </div>	   <!-- End container -->
    </section>	<!-- END CONTENT-2A -->


    <!-- PRICING-3
    ============================================= -->
    
    @if(count($allpackages) > 2)

    <section id="pricing-3" class="bg-whitesmoke wide-60 pricing-section division">
        <div class="container">


            <!-- SECTION TITLE -->	
            <div class="row justify-content-center">	
                <div class="col-lg-10 col-xl-8">
                    <div class="section-title title-01 mb-80">		

                        <!-- Title -->	
                        <h2 class="h2-sm">Simple And Flexible Pricing</h2>	

                        <!-- Text -->	
                        <p class="p-xl">You have Free Unlimited Updates and Premium Support on each package. You can also purchase add-ons such as SSL Certificate and G Suite.
                        </p>
                            
                    </div>	
                </div>
            </div>


            <!-- PRICING TABLES -->
            <div class="pricing-3-row pc-20">
                <div class="row row-cols-1 row-cols-md-3">

                    <!-- BASIC PLAN -->
                    @foreach($allpackages as $package)

                    <div class="col">
                        <div class="pricing-3-table bg-white rel mb-40 wow fadeInUp">	

                            <!-- Hightlight Badge -->
                            <div class="badge-wrapper">
                                <div class="highlight-badge bg-skyblue white-color">
                                    @if($package->link == "personal")
                                    <h6 class="h6-md">Personal</h6>
                                    @else
                                    <h6 class="h6-md">Commercial</h6>
                                    @endif
                                </div>
                            </div>	
                                            
                            <!-- Plan Price  -->
                            <div class="pricing-plan">
                                <h6 class="h6-md">{{ucwords(@$package->name)}}</h6>									
                                <p class="package-price">{{$package->price}}</p>								
                               
                                <p class="p-lg">{{ucwords(@$package->type)}} Payment</p>
                            </div>	
                                        
                            <!-- Plan Features  -->
                            <div class="canosoft-listing">
                                {!! @$package->description !!}

                            </div>

                          

                        </div>
                    </div>	
                    @endforeach
                    
                    <!-- END BASIC PLAN -->

                </div>
            </div>	<!-- END PRICING TABLES -->


            <!-- PRICING NOTICE TEXT -->
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="pricing-notice text-center mb-40">						
                        <p class="p-md">
                        </p>
                    </div>	
                </div>
            </div>


        </div>	   <!-- End container -->
    </section>	<!-- END PRICING-3 -->
    @endif

    <!-- STATISTIC-3
    ============================================= -->
    <section id="statistic-3" class="bg-03 statistic-section division">
        <div class="container">
            <div class="statistic-3-wrapper white-color text-center">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">


                    <!-- STATISTIC BLOCK #1 -->
                    <div class="col">
                        <div class="statistic-block mb-40 wow fadeInUp">

                            <!-- Icon  -->
                            <div class="statistic-ico ico-65">
                                <span class="flaticon-alarm-clock"></span>
                            </div>

                            <!-- Text -->
                            <h3 class="h3-md statistic-number"><span class="count-element">@if(!empty(@$setting_data->online)) {{@$setting_data->online}} @else 1000 @endif</span>+</h3>
                            <p class="p-lg txt-400">Years of online creativity</p>

                        </div>
                    </div>


                    <!-- STATISTIC BLOCK #2 -->
                    <div class="col">
                        <div class="statistic-block mb-40 wow fadeInUp">

                            <!-- Icon  -->
                            <div class="statistic-ico ico-65">
                                <span class="flaticon-shuttle"></span>
                            </div>

                            <!-- Text -->
                            <h3 class="h3-md statistic-number"><span class="count-element">@if(!empty(@$setting_data->projects)) {{@$setting_data->projects}} @else 3900 @endif</span>+</h3>
                            <p class="p-lg txt-400">Projects Delivered</p>

                        </div>
                    </div>


                    <!-- STATISTIC BLOCK #3 -->
                    <div class="col">
                        <div class="statistic-block mb-40 wow fadeInUp">

                            <!-- Icon  -->
                            <div class="statistic-ico ico-65">
                                <span class="flaticon-speech-bubble-3"></span>
                            </div>

                            <!-- Text -->
                            <h3 class="h3-md statistic-number"><span class="count-element">@if(!empty(@$setting_data->clients)) {{@$setting_data->clients}} @else 5000 @endif</span>+</h3>
                            <p class="p-lg txt-400">Happy Customers</p>

                        </div>
                    </div>


                    <!-- STATISTIC BLOCK #4 -->
                    <div class="col">
                        <div class="statistic-block mb-40 wow fadeInUp">

                            <!-- Icon  -->
                            <div class="statistic-ico ico-65"><span class="flaticon-increase"></span></div>

                            <!-- Text -->
                            <h3 class="h3-md statistic-number"><span class="count-element">@if(!empty(@$setting_data->projects)) {{@$setting_data->projects}} @else 10000 @endif</span>+</h3>
                            <p class="p-lg txt-400">Professionals engaged</p>

                        </div>
                    </div>


                </div>    <!-- End row -->
            </div>    <!-- End statistic-3-wrapper -->
        </div>	   <!-- End container -->
    </section>	<!-- END STATISTIC-3 -->



    <!-- TESTIMONIALS-1
    ============================================= -->
    @if(count($testimonials) > 0)

    <section id="reviews-1" class="bg-whitesmoke wide-100 reviews-section division">
        <div class="container">


            <!-- SECTION TITLE -->
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="section-title title-01 mb-70">

                        <!-- Title -->
                        <h2 class="h2-md">Stories From Our Customers</h2>

                        <!-- Text -->
                        <p class="p-xl">
                        </p>

                    </div>
                </div>
            </div>


            <!-- TESTIMONIALS CONTENT -->
            <div class="row">
                <div class="col">
                    <div class="owl-carousel owl-theme reviews-1-wrapper">


                    
                        <!-- TESTIMONIAL #1 -->
                        @foreach(@$testimonials as $testimonial)

                        <div class="review-1">

                            <!-- Quote Icon -->
                            <div class="review-1-ico ico-25">
                                <span class="flaticon-left-quote"></span>
                            </div>

                            <!-- Text -->
                            <div class="review-1-txt">

                                <!-- Text -->
                                <p class="p-lg">{!! @$testimonial->description !!}
                                </p>

                                <!-- Testimonial Author -->
                                <div class="author-data clearfix">

                                    <!-- Testimonial Avatar -->
                                    <div class="review-avatar">
                                        <img src="<?php if(!empty(@$testimonial->image)){ echo '/images/testimonial/'.@$testimonial->image; } else { echo '/images/uploads/profiles/male.png'; }?>" alt="review-customer-canosoft">
                                    </div>

                                    <!-- Testimonial Author -->
                                    <div class="review-author">

                                        <h6 class="h6-xl">{{ucwords(@$testimonial->name)}}</h6>
                                        <p class="p-md">{{ucwords(@$testimonial->position)}}</p>

                                        <!-- Rating -->
                                        <div class="review-rating ico-15 yellow-color">
                                        
                                            @for($i=0;$i<$testimonial->rating; $i++)
                                                <span class="flaticon-star-1"></span>
                                            @endfor
                                        
                                        </div>

                                    </div>

                                </div>	<!-- End Testimonial Author -->

                            </div>	<!-- End Text -->

                        </div>	<!-- END TESTIMONIAL #1 -->

                        @endforeach

                      


                    </div>
                </div>
            </div>	<!-- END TESTIMONIALS CONTENT -->


        </div>     <!-- End container -->
    </section>	<!-- END TESTIMONIALS-1 -->

    @endif



    <!-- FAQs-2
    ============================================= -->
    <section id="faqs-2" class="pb-60 faqs-section division">
        <div class="container">


            <!-- SECTION TITLE -->
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="section-title title-02 mb-70 mt-70">

                        <!-- Section ID -->
                        <span class="section-id txt-upcase">Frequently Asked Questions</span>

                        <!-- Title -->
                        <h2 class="h2-xs">Everything you need to know before getting started</h2>

                    </div>
                </div>
            </div>

            @if(count($faqs) > 0)
            <!-- FAQs-2 QUESTIONS -->
            <div class="faqs-2-questions">
                <div class="row row-cols-1 row-cols-lg-2">


                    <!-- QUESTIONS HOLDER -->
                    @foreach($faqs->chunk(2) as $firstchunk)

                    <div class="col">
                        <div class="questions-holder pr-15">
                            @foreach($firstchunk as $key=>$final)

                            <div class="question wow fadeInUp">

                                <!-- Question -->
                                <h5 class="h5-md">{{$final->name}}</h5>

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
                        <h5 class="h5-sm">Have more questions? <a href="{{route('faq.frontend')}}">View all questions here</a></h5>
                    </div>
                </div>
            </div>


        </div>	   <!-- End container -->
    </section>	<!-- END FAQs-2 -->




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
                                <h4 class="h4-xl">Start your trial now and pick a plan later</h4>
                            </div>
                        </div>


                        <!-- CALL TO ACTION BUTTON -->
                        <div class="col-lg-4">
                            <div class="text-end">
                                <div class="cta-3-btn text-center">
                                    <a href="/" class="btn btn-skyblue tra-grey-hover">Get Started Now</a>
                                    <p><a href="#">Read The FAQs</a></p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>    <!-- End row -->
            </div>	   <!-- End container -->
        </div>
    </section>	<!-- END CALL TO ACTION-3 -->
@endsection



