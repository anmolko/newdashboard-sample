@extends('backend.layouts.master')
@section('title', "Customer Package List")
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
                        <h4 class="mb-sm-0">Customer Package List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Manage Customer Package List</li>
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
                                    <h4 class="card-title mb-0">Customer Package List</h4>

                                </div>
{{--                                <div class="col-sm">--}}
{{--                                    <div class="d-flex justify-content-sm-end">--}}
{{--                                        <div>--}}
{{--                                            <a href="{{route('services.create')}}" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i>New Service</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row" >

                                <div class="table-responsive  mt-3 mb-1">
                                    <table id="package-index" class="table align-middle table-nowrap table-striped">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Project Plan Selected</th>
                                            <th>Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($packages))
                                            @foreach($packages as  $package)
                                                <tr>
                                                    <td >
                                                        {{ ucwords(@$package->full_name) }}
                                                    </td>
                                                    <td>
                                                       <a href="mailto:{{@@$package->email}}">{{ @$package->email}}</a>
                                                    </td>
                                                    <td>
                                                        <a href="tel:{{@$package->phone}}">{{@$package->phone}}</a>
                                                    </td>
                                                    <td>{{ucwords(@$package->projectPlan->name)}}</td>
                                                    <td>
                                                        <div class="btn-group view-btn" id="status-button-{{$package->id}}">
                                                            <button class="btn btn-light dropdown-toggle" style="width: 10em;" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                                                {{ucwords(@$package->status)}}
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside" style="">
                                                                @if($package->status == "pending")
                                                                    <li><a class="dropdown-item change-status" cs-update-route="{{route('package-status.update',$package->id)}}" href="#" cs-status-value="responded">Responded</a></li>
                                                                @else
                                                                    <li><a class="dropdown-item change-status" cs-update-route="{{route('package-status.update',$package->id)}}" href="#" cs-status-value="pending">Pending</a></li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td >
                                                        <div class="row">

                                                            <div class="col text-center dropdown">
                                                                <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                                    <button class="btn btn-light hidden" id="package_{{$package->projectPlan->id}}" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle Right offcanvas</button>
                                                                    <li><a class="dropdown-item cs-plan-view" id="{{$package->projectPlan->id}}" cs-edit-route="{{route('project-plan.edit',$package->projectPlan->id)}}"><i class="ri-pencil-fill me-2 align-middle"></i>View Plan</a></li>
                                                                    <li><a class="dropdown-item cs-service-remove" cs-delete-route="{{route('package.destroy',$package->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
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

    @include('backend.package_response.modals.view-plan')

@endsection

@section('js')
    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script src="{{asset('assets/backend/custom_js/package-response.js')}}"></script>

@endsection
