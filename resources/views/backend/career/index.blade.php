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
                        <h4 class="mb-sm-0">Career Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Career List </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-xl-12 col-lg-12">
                    <div>
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="row g-4">
                                    <div class="col-sm-auto">
                                        <div>
                                            <button data-bs-toggle="modal" data-bs-target="#create_career" class="btn btn-success">
                                                <i class="ri-add-fill align-bottom me-1"></i> Add Career</button>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control" placeholder="Search Products...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#productnav-all"
                                                   role="tab">
                                                    All <span class="badge badge-soft-danger align-middle rounded-pill ms-1"> {{count($careers)}}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-published"
                                                   role="tab">
                                                    Active <span class="badge badge-soft-danger align-middle rounded-pill ms-1">
                                                        {{count($careers_active)}}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-draft"
                                                   role="tab">
                                                    Inactive <span class="badge badge-soft-danger align-middle rounded-pill ms-1">
                                                        {{count($careers_inactive)}}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- end card header -->
                            <div class="card-body">

                                <div class="tab-content text-muted">
                                    <div class="tab-pane active" id="productnav-all" role="tabpanel">
                                        <div class="row" >
                                            <div class="table-responsive  mt-3 mb-1">
                                                <table id="career-all-index" class="table align-middle table-nowrap table-striped">
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
                                                    @foreach($careers as  $career)
                                                        <tr>
                                                            <td>
                                                                <img src="{{asset('/images/career/'.@$career->feature_image)}}" alt="{{@$career->name}}" class="img-thumbnail avatar-lg">
                                                            </td>
                                                            <td >
                                                                {{ ucwords(@$career->name) }}
                                                            </td>
                                                            <td>
                                                                {{ @$career->slug}}
                                                            </td>
                                                            <td>
                                                                {{ str_replace('_',' ',ucwords(@$career->type))}}
                                                            </td>
                                                            <td>
                                                                {{ ($career->end_date !== null) ? \Carbon\Carbon::parse(@$career->end_date)->isoFormat('MMMM Do, YYYY'):"Not Set"  }}
                                                            </td>
                                                            <td>
                                                                <div class="btn-group view-btn">
                                                                    <button class="btn btn-light dropdown-toggle" style="width: 10em;" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                                                        {{ucfirst(@$career->status)}}
                                                                    </button>
                                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside" style="">
                                                                        @if($career->status == "active")
                                                                            <li><a class="dropdown-item change-status" cs-update-route="{{route('career-stat.update',$career->id)}}" href="#" cs-status-value="inactive">Inactive</a></li>
                                                                        @else
                                                                            <li><a class="dropdown-item change-status" cs-update-route="{{route('career-stat.update',$career->id)}}" href="#" cs-status-value="active">Active</a></li>
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
                                                                            <li><a class="dropdown-item cs-career-edit" cs-update-route="{{route('career.update',$career->id)}}" cs-edit-route="{{route('career.edit',$career->id)}}"><i class="ri-pencil-fill me-2 align-middle"></i>Edit</a></li>
                                                                            <li><a class="dropdown-item cs-career-remove" cs-delete-route="{{route('career.destroy',$career->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
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
                                    <!-- end tab pane -->

                                    <div class="tab-pane" id="productnav-published" role="tabpanel">
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
                                    <!-- end tab pane -->
                                    <form action="#" method="post" id="deleted-form">
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="DELETE">
                                    </form>
                                    <div class="tab-pane" id="productnav-draft" role="tabpanel">
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
                                    <!-- end tab pane -->
                                </div>
                                <!-- end tab content -->

                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

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

    <script src="{{asset('assets/backend/custom_js/career.js')}}"></script>

@endsection
