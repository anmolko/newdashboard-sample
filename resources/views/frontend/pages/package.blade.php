@extends('frontend.layouts.master')
@section('title') Our Packages @endsection
@section('css')
    <link href="{{asset('assets/frontend/css/toastr.min.css')}}" rel="stylesheet">

    <style>
           
    .custom-editor .media{
        display: block;
    }

    .custom-editor{
        font-size: 1.1875rem;
    }
    .canosoft-listing{
        padding-top: 25px;
        margin-top: 25px;
        border-top: 1px solid #ccc;
    }
    .canosoft-listing ul,.canosoft-listing ol {
        font-size: 1.125rem;
    }
   
    .pull-right {
        float: right;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .order-now {
        background-color: #183952;
        border-color: #3381bd;
        color: #FFFFFF;
        opacity: 1;
        filter: alpha(opacity=100);
        font-size: 12px;
        font-weight: 600;
        padding: 0.5rem 18px;
    }

    .close-modal-button{
        background-color: #161f28;
        font-size: 12px;
        font-weight: 600;
        padding: 0.5rem 18px;
    }
    </style>
@endsection
@section('content')

	<!-- PRICING-2
			============================================= -->
			<section id="pricing-2" class="bg-snow pb-60 inner-page-hero pricing-section division">
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row justify-content-center">	
						<div class="col-lg-10 col-xl-8">
							<div class="section-title title-01 mb-80">		

								<!-- Title -->	
								<h2 class="h2-md">Simple And Flexible Packages</h2>	

								<!-- Text -->	
								<p class="p-xl">You have Free Unlimited Updates and Premium Support on each package. You can also purchase add-ons such as SSL Certificate and G Suite.</p>
									
							</div>	
						</div>
					</div>


					<!-- PRICING TABLES -->
					<div class="pricing-3-row pc-20">
						<div class="row row-cols-1 row-cols-md-3">

							<!-- ADVANCED PLAN -->
                            @if(count($allpackages) > 0)
                                @foreach($allpackages as $package)
                                    <div class="col">
                                        <div class="pricing-3-table bg-white rel mb-40 wow fadeInUp">

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
                                        </div>	
                                            <!-- Plan Price  -->
                                            <div class="pricing-plan highlight">
                                              
                                                <sup class="validity dark-color"><span>{{$package->price}}</span> / {{@$package->type}}</sup>
                                            </div>	

                                            <div class="canosoft-listing">
                                                {!! @$package->description !!}

                                            </div>
                                            <!-- Pricing Plan Button -->
                                            <a onclick="setOrder(this)" data-toggle="modal" data-target="#orderModal" data-package="{{ucwords(@$package->id)}}" data-plan="{{ucwords(@$package->name)}} Web Hosting" class="btn btn-sm btn-skyblue tra-grey-hover">Order Now</a>
                                        </div>
                                    </div>	<!-- END ADVANCED PLAN -->
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
					</div>	<!-- END PRICING TABLES -->


				</div>	   <!-- End container -->
			</section>	<!-- END PRICING-2 -->

            <div class="modal fade" id="orderModal"  role="dialog" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Place an order</h5>
                    </div>
                    <form method="POST" action="{{route('package.store')}}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label">Your Order</label>
                                <input type="text" id="order_name" name="order_name" value="Hosting" class="form-control" disabled="">
                                <input type="hidden" id="project_plan_id" name="project_plan_id"  >
                            </div>
                        
                            <div class="form-group">
                                <label class="col-form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <input type="submit" name="submit" value="Order Now!" class="btn btn-success order-now">
                            <div class="pull-right">
                                <button type="button" class="btn btn-default btn-simple close-modal-button" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                        </div>
                        
                    </form>

                    </div>
                </div>
            </div>


            

@endsection

@section('js')
<script src="{{asset('assets/frontend/js/toastr.min.js')}}"></script>
<script>

    @if(Session::has('success'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('success') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  function setOrder(element){
    var plan = $(element).data('plan');
    var package = $(element).data('package');
    $('#project_plan_id').val(package);
    $('#order_name').val(plan);

    
    $('#orderModal').modal("show");
  }

  
  $(document).on('click','.close-modal-button', function (e) {
    e.preventDefault();
    $('#orderModal').modal('hide');

  });
</script>
@endsection
