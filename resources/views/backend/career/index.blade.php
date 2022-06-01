@extends('backend.layouts.master')
@section('title', "Career")
@section('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/custom_css/datatable_style.css')}}">
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/backend/libs/glightbox/css/glightbox.min.css')}}" />
    <style>
        .feature-image-button{
            position: absolute;
            top: 15%;
        }
        .profile-foreground-img-file-input {
            display: none;
        }

        .glightbox-clean .gdesc-inner {
            padding: 0px 0px 0px 0px;
        }

        .glightbox-clean .gslide-title {
            color: #fff;
        }

        .glightbox-clean .gslide-description {
            background: transparent;
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
                        <h4 class="mb-sm-0">Task Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Career</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="search-box">
                                <input type="text" class="form-control search" placeholder="Search for career...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-md-auto ms-auto">
                            <div class="d-flex hastck gap-2 flex-wrap">
                                <button data-bs-toggle="modal" data-bs-target="#create_career" class="btn btn-success">
                                    <i class="ri-add-fill align-bottom me-1"></i> Add Career</button>
                                <div class="dropdown">
                                    <button class="btn btn-soft-info btn-icon fs-14" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-settings-4-line"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="">
                                        <li><a class="dropdown-item" href="#">Copy</a></li>
                                        <li><a class="dropdown-item" href="#">Move to pipline</a></li>
                                        <li><a class="dropdown-item" href="#">Add to exceptions</a></li>
                                        <li><a class="dropdown-item" href="#">Switch to common form view</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Reset form view to default</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab">
                                            Active
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab">
                                            Inactive
                                        </a>
                                    </li>

                                </ul><!--end nav-->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="home-1" role="tabpanel">
                                    <div class="row" >
                                        <div class="table-responsive  mt-3 mb-1">
                                            <table id="career-index" class="table align-middle table-nowrap table-striped">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>Feature Image</th>
                                                    <th>Name</th>
                                                    <th>Slug</th>
                                                    <th>Type</th>
                                                    <th>End date</th>
                                                    <th>Status</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($careers_active as  $active)
                                                        <tr>
                                                            <td>
                                                                <img src="{{asset('/images/career/'.@$active->feature_image)}}" alt="{{@$active->name}}" class="img-thumbnail avatar-lg">
                                                            </td>
                                                            <td >
                                                                {{ ucwords(@$active->name) }}
                                                            </td>
                                                            <td>
                                                                {{ @$active->slug}}
                                                            </td>
                                                            <td>
                                                                {{ str_replace('_',' ',ucwords(@$active->type))}}
                                                            </td>
                                                            <td>
                                                                {{ ($active->end_date !== null) ? \Carbon\Carbon::parse(@$active->end_date)->isoFormat('MMMM Do, YYYY'):"Not Set"  }}
                                                            </td>
                                                            <td>
                                                                <div class="btn-group view-btn">
                                                                    <button class="btn btn-light dropdown-toggle" style="width: 10em;" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                                                      {{ucfirst(@$active->status)}}
                                                                    </button>
                                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside" style="">
                                                                        @if($active->status == "active")
                                                                            <li><a class="dropdown-item change-status" cs-update-route="{{route('career-status.update',$active->id)}}" href="#" cs-status-value="inactive">Inactive</a></li>
                                                                        @else
                                                                            <li><a class="dropdown-item change-status" cs-update-route="{{route('career-status.update',$active->id)}}" href="#" cs-status-value="active">Active</a></li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col text-center dropdown">
                                                                        <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            <i class="ri-more-fill fs-17"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                                            <li><a class="dropdown-item cs-career-edit" cs-update-route="{{route('career.update',$active->id)}}" cs-edit-route="{{route('career.edit',$active->id)}}"><i class="ri-pencil-fill me-2 align-middle"></i>Edit</a></li>
                                                                            <li><a class="dropdown-item cs-career-remove" cs-delete-route="{{route('career.destroy',$active->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <form action="#" method="post" id="deleted-form">
                                    {{csrf_field()}}
                                    <input name="_method" type="hidden" value="DELETE">
                                </form>
                                <div class="tab-pane" id="messages-1" role="tabpanel">
                                    <div class="row" >
                                        <div class="table-responsive  mt-3 mb-1">
                                            <table id="career-inactive-index" class="table align-middle table-nowrap table-striped">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>Feature Image</th>
                                                    <th>Name</th>
                                                    <th>Slug</th>
                                                    <th>Type</th>
                                                    <th>End date</th>
                                                    <th>Status</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($careers_inactive as  $active)
                                                    <tr>
                                                        <td>
                                                            <img src="{{asset('/images/career/'.@$active->feature_image)}}" alt="{{@$active->name}}" class="img-thumbnail avatar-lg">
                                                        </td>
                                                        <td >
                                                            {{ ucwords(@$active->name) }}
                                                        </td>
                                                        <td>
                                                            {{ @$active->slug}}
                                                        </td>
                                                        <td>
                                                            {{ str_replace('_',' ',ucwords(@$active->type))}}
                                                        </td>
                                                        <td>
                                                            {{ ($active->end_date !== null) ? \Carbon\Carbon::parse(@$active->end_date)->isoFormat('MMMM Do, YYYY'):"Not Set"  }}
                                                        </td>
                                                        <td>
                                                            <div class="btn-group view-btn">
                                                                <button class="btn btn-light dropdown-toggle" style="width: 10em;" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                                                    {{ucfirst(@$active->status)}}
                                                                </button>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside" style="">
                                                                    @if($active->status == "active")
                                                                        <li><a class="dropdown-item change-status" cs-update-route="{{route('career-status.update',$active->id)}}" href="#" cs-status-value="inactive">Inactive</a></li>
                                                                    @else
                                                                        <li><a class="dropdown-item change-status" cs-update-route="{{route('career-status.update',$active->id)}}" href="#" cs-status-value="active">Active</a></li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col text-center dropdown">
                                                                    <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill fs-17"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                                        <li><a class="dropdown-item cs-career-edit" cs-update-route="{{route('career.update',$active->id)}}" cs-edit-route="{{route('career.edit',$active->id)}}"><i class="ri-pencil-fill me-2 align-middle"></i>Edit</a></li>
                                                                        <li><a class="dropdown-item cs-career-remove" cs-delete-route="{{route('career.destroy',$active->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div><!--end tab-content-->
                        </div>
                    </div><!--end card-->
                </div><!--end col-->
            </div><!--end row-->
        </div>
        <!-- container-fluid -->
    </div>

    @include('backend.career.modal.create')
    @include('backend.career.modal.edit')

@endsection

@section('js')
    <script src="{{asset('assets/backend/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>

    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>

    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script src="{{asset('assets/backend/js/pages/project-list.init.js')}}"></script>

    <script src="{{asset('assets/backend/js/pages/form-pickers.init.js')}}"></script>

    {{--    <script src="{{asset('assets/backend/custom_js/work.js')}}"></script>--}}

    <script>
        $(document).ready(function () {
            createEditor('ckeditor-classic');
            createEditor('ckeditor-classic-update');
            var dataTable = $('#career-index, #career-inactive-index').DataTable({
                paging: true,
                searching: true,
                ordering:  false,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            });
        });
        function createEditor(id){
            ClassicEditor.create(document.querySelector("#"+id))
                .then( editor => {
                    window.editor = editor;
                    editor.ui.view.editable.element.style.height="200px";
                    editor.model.document.on( 'change:data', () => {
                        $( '#' + id).text(editor.getData());
                    } );
                } )
                .catch(function(e){console.error(e)});
        }
        var loadbasicFile = function(id1,id2,event) {
            var image       = document.getElementById(id1);
            var replacement = document.getElementById(id2);
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };

        $(document).on('click','.cs-career-edit', function (e) {
            e.preventDefault();
            var url =  $(this).attr('cs-edit-route');
            var action = $(this).attr('cs-update-route');

            $.ajax({
                url: url,
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $("#edit_career").modal("toggle");
                    console.log(dataResult.date);
                    $('#update-name').attr('value',dataResult.edit.name);
                    $('#update-slug').attr('value',dataResult.edit.slug);
                    $('#update-position').attr('value',dataResult.edit.position);
                    $('#update-end_date').attr('value',dataResult.date);
                    // $('#update-end_date').attr('data-deafult-date',dataResult.date);
                    $('#update-salary').attr('value',dataResult.edit.salary);
                    $('#update-type option[value="'+dataResult.edit.type+'"]').prop('selected', true);
                    $('#career-publish-status-update option[value="'+dataResult.edit.status+'"]').prop('selected', true);
                    $('#meta-description-update').text(dataResult.edit.meta_description);
                    $('#meta-title-update').attr('value',dataResult.edit.meta_title);
                    $('#meta-keywords-update').attr('value',dataResult.edit.meta_tags);
                    editor.setData( dataResult.edit.description );
                    $('#current-update-img').attr("src",'/images/career/'+dataResult.edit.feature_image );
                    $('.updatecareer').attr('action',action);

                },
                error: function(error){
                    console.log(error)
                }
            });
        });

        function slugMaker(title, slug){
            $("#"+ title).keyup(function(){
                var Text = $(this).val();
                Text = Text.toLowerCase();
                var regExp = /\s+/g;
                Text = Text.replace(regExp,'-');
                $("#"+slug).val(Text);
            });
        }

        $(document).on('click','.change-status', function (e) {
            e.preventDefault();
            var status = $(this).attr('cs-status-value');
            var url = $(this).attr('cs-update-route');
            if(status == 'inactive'){
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
                        'Changing Status to Inactive will prevent career information from being displayed in front</p>' +
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
                        statusupdate(url,status)
                        :
                        t.dismiss === Swal.DismissReason.cancel &&
                        Swal.fire({
                            title: "Cancelled",
                            text: "Blog status was not changed.",
                            icon: "error",
                            confirmButtonClass: "btn btn-primary mt-2",
                            buttonsStyling: !1
                        });
                });

            }else{
                statusupdate(url,status);
            }

        });

        $(document).on('click','.cs-career-remove', function (e) {
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
                                }, 3000);
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
                        text: "Career detail was not removed.",
                        icon: "error",
                        confirmButtonClass: "btn btn-primary mt-2",
                        buttonsStyling: !1
                    });
            });



        })


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
                    if(response.status == "success"){
                        Swal.fire({
                            imageUrl: "/assets/backend/images/canosoft-logo.png",
                            imageHeight: 60,
                            html: '<div class="mt-2">' +
                                '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                                'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                                '</lord-icon>' +
                                '<div class="mt-4 pt-2 fs-15">' +
                                '<h4>Success !</h4>' +
                                '<p class="text-muted mx-4 mb-0">Career status has been updated successfully.</p>' +
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
                                '<p class="text-muted mx-4 mb-0">' +
                                'Career status could not be changed at the moment .</p>' +
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
                            'Could not confirm the status of the career.</p>' +
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
