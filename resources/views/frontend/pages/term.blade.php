@extends('frontend.layouts.master')
@section('title') Our Terms & Condition @endsection
@section('css')
    <style>
           
    .custom-editor .media{
        display: block;
    }

    .custom-editor{
        font-size: 1.1875rem;
    }
   
   
    </style>
@endsection
@section('content')

<!-- TERMS & PRIVACY
			============================================= -->
<section id="terms-page" class="bg-snow wide-70 inner-page-hero terms-section division">
    <div class="container">

        <!-- TERMS CONTENT -->
        <div class="row justify-content-center">	
            <div class="col-lg-10">


                <!-- TERMS TITLE -->
                <div class="terms-title text-center">

                    <!-- Title -->
                    <h2 class="h2-md">Our Terms & Condition</h2>


                </div>


                <!-- DIVIDER LINE -->
                <hr class="divider">

                
                <!-- TERMS BOX -->
                <div class="terms-box mt-60 custom-editor">

                    {!! @$setting_data->terms_conditions !!}
                  

                </div>	<!-- END TERMS BOX -->


                

            </div>	<!-- END TERMS CONTENT -->


        </div>     <!-- End row -->		
    </div>	    <!-- End container -->
</section>	 <!-- END TERMS & PRIVACY -->


@endsection