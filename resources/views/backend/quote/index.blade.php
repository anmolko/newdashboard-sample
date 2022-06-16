@extends('backend.layouts.master')
@section('title', "Customer Request Quote List")
@section('css')
<link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/backend/custom_css/datatable_style.css')}}">
<link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<style>
    .hidden {
        display: none;
    }
</style>
@endsection

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"> Request Quote List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage  Request Quote List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4 class="card-title mb-0">Show & Remove</h4>
                    </div>end card header -->

                    <div class="card-body">

                            <div class="table-responsive  mt-3 mb-1">
                                <table class="table align-middle table-nowrap" id="quote_customer">
                                    <thead class="table-light">
                                        <tr>

                                            <th>#</th>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Service</th>
                                            <th>Submitted Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            </tr>
                                    </thead>
                                    <tbody >
                                        @foreach(@$quotes as $quote)
                                            <tr id="customer-block-num-{{@$quote->id}}">
                                                <td >{{@$loop->iteration}}</td>
                                                <td >{{ucwords(@$quote->name)}}</td>
                                                <td >

                                                    <a href="mailto:{{@$quote->email}}">{{@$quote->email}}</a>
                                                </td>
                                                <td>
                                                    <a href="tel: {{@$quote->phone}}"> {{@$quote->phone}}</a>
                                                </td>
                                                <td >{{ucwords(@$quote->service->title)}}</td>
                                                <td >{{date('j M, Y',strtotime(@$quote->created_at))}}</td>
                                                <td>
                                                    <div class="btn-group view-btn" id="status-button-{{$quote->id}}">
                                                        <button class="btn btn-light dropdown-toggle" style="width: 10em;" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                                            {{ucwords(@$quote->status)}}
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside" style="">
                                                            @if($quote->status == "pending")
                                                                <li><a class="dropdown-item change-status" cs-update-route="{{route('quote-status.update',$quote->id)}}" href="#" cs-status-value="responded">Responded</a></li>
                                                            @else
                                                                <li><a class="dropdown-item change-status" cs-update-route="{{route('quote-status.update',$quote->id)}}" href="#" cs-status-value="pending">Pending</a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                    <button class="btn btn-light hidden" id="quote_{{$quote->service->id}}" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle Right offcanvas</button>

                                                        <div class="edit">
                                                            <button class="btn  view-item-btn"
                                                              quote-edit-action="{{route('quote.edit',$quote->service->id)}}" id="{{$quote->service->id}}"><i
                                                                                class="ri-eye-fill align-bottom me-2 text-muted"></i></button>
                                                        </div>
                                                        <div class="remove">
                                                            <button class="btn remove-item-btn"  quote-delete-action="{{route('quote-response.destroy',$quote->id)}}" ><i
                                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>


                    </div><!-- end card -->
                </div>


                <!-- end col -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->






        <!--end modal -->
        <form action="#" method="post" id="deleted-form" >
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
        </form>
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->

@include('backend.quote.modal.view')

@endsection

@section('js')
<script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script type="text/javascript">
    var quoted = "{{$quotation}}";
</script>
<script src="{{asset('assets/backend/custom_js/quote.js')}}"></script>

    <script>
        $(document).on('click','.change-status', function (e) {
            e.preventDefault();
            var status = $(this).attr('cs-status-value');
            var url = $(this).attr('cs-update-route');
            statusupdate(url,status);
        });

        function statusupdate(url,status){
            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                url: url,
                type: "PATCH",
                cache: false,
                data:{
                    status: status,
                },
                success: function(response){
                    console.log(response);
                    if(response.status == "success"){
                        var oldstatus         = response.old_status;
                        var status_url        = "/auth/quote-response/"+response.id+"/status/";
                        var replacementblock  = '#status-button-'+response.id;
                        var replacement = '<button class="btn btn-light dropdown-toggle" style="width: 10em;" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"> '
                            +
                            response.new_status
                            +
                            '</button><ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside" style="">' +
                            '<li>' +
                            '<a class="dropdown-item change-status" cs-update-route="'+status_url+'" href="#" cs-status-value="'+response.value+'">'+oldstatus+'</a>' +
                            '</li></ul>';

                        Swal.fire({
                            imageUrl: "/assets/backend/images/canosoft-logo.png",
                            imageHeight: 60,
                            html: '<div class="mt-2">' +
                                '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                                'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                                '</lord-icon>' +
                                '<div class="mt-4 pt-2 fs-15">' +
                                '<h4>Success !</h4>' +
                                '<p class="text-muted mx-4 mb-0">' +
                                'Quotation Response Status has been updated .</p>' +
                                '</div>' +
                                '</div>',
                            timerProgressBar: !0,
                            timer: 2e3,
                            showConfirmButton: !1
                        });
                        $(replacementblock).html('');
                        $(replacementblock).html(replacement);
                    }else{

                        Swal.fire({
                            imageUrl: "/assets/backend/images/canosoft-logo.png",
                            imageHeight: 60,
                            html: '<div class="mt-2">' +
                                '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                                ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                                'style="width:120px;height:120px"></lord-icon>' +
                                '<div class="mt-4 pt-2 fs-15">' +
                                '<h4>Oops...! </h4>' +
                                '<p class="text-muted mx-4 mb-0">' +
                                'Quotation Response status could not be changed at the moment .</p>' +
                                '</div>' +
                                '</div>',
                            timerProgressBar: !0,
                            timer: 3000,
                            showConfirmButton: !1
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        imageUrl: "/assets/backend/images/canosoft-logo.png",
                        imageHeight: 60,
                        html: '<div class="mt-2">' +
                            '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                            ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                            'style="width:120px;height:120px"></lord-icon>' +
                            '<div class="mt-4 pt-2 fs-15">' +
                            '<h4>Warning...! </h4>' +
                            '<p class="text-muted mx-4 mb-0">' +
                            'Could not confirm the status of the Quotation Response.</p>' +
                            '</div>' +
                            '</div>',
                        timerProgressBar: !0,
                        timer: 3000,
                        showConfirmButton: !1
                    });
                }
            });
        }
    </script>

@endsection
