@extends('backend.layouts.master')
@section('title', "Career Response")
@section('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/custom_css/datatable_style.css')}}">
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>

        .hidden{
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
                        <h4 class="mb-sm-0">Career Response List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Manage Career Response List</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row g-4">
                                <div class="col-sm-auto">
                                    <h4 class="card-title mb-0">Career Response List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row" >

                                <div class="table-responsive  mt-3 mb-1">
                                    <table id="response-index" class="table align-middle table-nowrap table-striped">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Message</th>
                                            <th>Applied for</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($applied_job))
                                            @foreach($applied_job as  $applied)
                                                <tr>
                                                    <td>
                                                        {{ ucwords(@$applied->name) }}
                                                    </td>
                                                    <td>
                                                        <a href="mailto:{{@$applied->email}}">{{ @$applied->email}}</a>
                                                    </td>
                                                    <td>
                                                        <a href="tel:{{@$applied->phone}}">{{@$applied->phone}}</a>
                                                    </td>
                                                    <td>
                                                        {{ ucwords(@$applied->address) }}
                                                    </td>
                                                    <td>
                                                        {{ ucwords(@$applied->message) }}
                                                    </td>
                                                    <td>{{ucwords(@$applied->career->name)}}</td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col text-center dropdown">
                                                                <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                                    <button class="btn btn-light hidden" id="career_{{$applied->career->id}}" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle Right offcanvas</button>
                                                                    <li>
                                                                        <a class="dropdown-item" href="{{asset('/images/career/'.@$applied->attachcv)}}" download="{{$applied->attachcv}}">
                                                                            <i class=" ri-file-download-fill me-2 align-middle"></i>
                                                                            Download CV</a></li>
                                                                    <li><a class="dropdown-item cs-career-view" id="{{$applied->career->id}}" cs-edit-route="{{route('career.edit',$applied->career->id)}}"><i class="ri-pencil-fill me-2 align-middle"></i>View Career</a></li>
                                                                    <li><a class="dropdown-item cs-response-remove" cs-delete-route="{{route('career-response.destroy',$applied->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div><!--end row-->
                            <form action="#" method="post" id="deleted-form">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>

    @include('backend.career.modal.view-career')

@endsection

@section('js')
    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    {{--    <script src="{{asset('assets/backend/custom_js/service.js')}}"></script>--}}

    <script>
        $(document).ready(function () {
            var dataTable = $('#response-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            });
        });

        $(document).on('click','.cs-response-remove', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('cs-delete-route');
            form.attr('action',action);
            var url = form.attr('action');
            var form_data = form.serialize();
            Swal.fire({
                imageUrl: "/assets/backend/images/canosoft-logo.png",
                imageHeight: 60,
                html: '<div class="mt-2">' +
                    '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                    ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                    'style="width:120px;height:120px"></lord-icon>' +
                    '<div class="mt-4 pt-2 fs-15">' +
                    '<h4>Are your sure? </h4>' +
                    '<p class="text-muted mx-4 mb-0">' +
                    'You want to Remove this Record ?</p>' +
                    '</div>' +
                    '</div>',
                showCancelButton: !0,
                confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-danger w-xs mt-2",
                confirmButtonText: "Yes!",
                buttonsStyling: !1,
                showCloseButton: !0
            }).then(function(t)
            {
                t.value
                    ?
                    $.post( url, form_data)
                        .done(function(response) {
                            if(response.status == "success") {
                                Swal.fire({
                                    imageUrl: "/assets/backend/images/canosoft-logo.png",
                                    imageHeight: 60,
                                    html: '<div class="mt-2">' +
                                        '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                                        'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                                        '</lord-icon>' +
                                        '<div class="mt-4 pt-2 fs-15">' +
                                        '<h4>Success !</h4>' +
                                        '<p class="text-muted mx-4 mb-0">' + response.message +'</p>' +
                                        '</div>' +
                                        '</div>',
                                    timerProgressBar: !0,
                                    timer: 2e3,
                                    showConfirmButton: !1
                                });

                                setTimeout(function() {
                                    location.reload();
                                }, 3800);
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
                                        '<p class="text-muted mx-4 mb-0">' + response.message +'</p>' +
                                        '</div>' +
                                        '</div>',
                                    timerProgressBar: !0,
                                    timer: 3000,
                                    showConfirmButton: !1
                                });
                            }
                        })
                        .fail(function(response){
                            console.log(response)
                        })

                    :
                    t.dismiss === Swal.DismissReason.cancel &&
                    Swal.fire({
                        title: "Cancelled",
                        text: "Customer package response was not removed.",
                        icon: "error",
                        confirmButtonClass: "btn btn-primary mt-2",
                        buttonsStyling: !1
                    });
            });
        });

        $(document).on('click','.cs-career-view', function (e) {
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                url: $(this).attr('cs-edit-route'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $('#career-name').text(dataResult.edit.name);
                    $('#career-slug').text(dataResult.edit.slug);
                    $('#career-position').text(dataResult.edit.position);
                    var type = dataResult.edit.type;
                    $('#career-type').text(type.replace(/_/g," "));
                    $('#career-end-date').text(dataResult.date);
                    var career = (dataResult.edit.salary !== null) ? dataResult.edit.salary:"Not Assigned";
                    $('#career-salary').text(career);
                    $('#career-status').text(dataResult.edit.status);
                    var myContent = dataResult.edit.description;
                    if(dataResult.edit.feature_image !== null){
                        $('#career-image').attr("src",'/images/career/'+dataResult.edit.feature_image );
                    }
                    $('#career-description').text( myContent.replace(/(<([^>]+)>)/ig,""));
                    $( "#career_"+id).click();
                },
                error: function(error){
                    console.log(error)
                }
            });
        });


    </script>

@endsection
