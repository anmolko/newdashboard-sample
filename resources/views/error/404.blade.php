@extends('frontend.layouts.master')
@section('title') 404 Page @endsection
@section('content')

    <section id="hero-24" class="bg-tra-blue hero-section division">
        <div class="container">
            <div class="row d-flex align-items-center">


                <!-- 404 PAGE TEXT -->
                <div class="col-md-8 col-lg-6 offset-md-2 offset-lg-3">
                    <div class="hero-24-txt text-center">

                        <!-- Image -->
                        <div class="rel hero-24-img">

                            <!-- Image -->
                            <img class="img-fluid" src="{{asset('assets/frontend/images/error-404.png')}}" alt="error-404-img">

                            <!-- Transparent Header -->
                            <h2 class="tra-header">404</h2>

                        </div>

                        <!-- Text -->
                        <h2 class="h2-md">Page Not Found</h2>
                        <h5 class="h5-md">The page you are looking for might have been moved , renamed or might never existed </h5>

                        <!-- Button -->
                        <a href="/" class="btn btn-skyblue tra-grey-hover">Back To Home</a>


                    </div>
                </div>
                <!-- END 404 PAGE TEXT -->


            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </section>


@endsection
