@extends('backend.layouts.master')
@section('title', "User Management Index")
@section('css')
    <style>
        .hidden{
            display:none!important;
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
                        <h4 class="mb-sm-0">User Management</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">User Management</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-sm-4">
                            <div class="search-box">
                                <input type="text" class="form-control" placeholder="Search for name, tasks, projects or something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div><!--end col-->
                        <div class="col-sm-auto ms-auto">
                            <div class="list-grid-nav hstack gap-1">
                                <button type="button" id="list-view-button" class="btn btn-soft-info nav-link  btn-icon fs-14 active filter-button"><i class="ri-list-unordered"></i></button>
                                <button type="button" id="grid-view-button" class="btn btn-soft-info nav-link btn-icon fs-14 filter-button"><i class="ri-grid-fill"></i></button>
{{--                                <button type="button"  id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-soft-info btn-icon fs-14"><i class="ri-more-2-fill"></i></button>--}}
{{--                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">--}}
{{--                                    <li><a class="dropdown-item" href="#">All</a></li>--}}
{{--                                    <li><a class="dropdown-item" href="#">Last Week</a></li>--}}
{{--                                    <li><a class="dropdown-item" href="#">Last Month</a></li>--}}
{{--                                    <li><a class="dropdown-item" href="#">Last Year</a></li>--}}
{{--                                </ul>--}}
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addmembers"><i class="ri-add-fill me-1 align-bottom"></i> Add Members</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <div class="team-list list-view-filter row">
                            @foreach($users as $user)
                            <div class="col">
                                <div class="card team-box">
                                    <div class="team-cover">
                                        <img  src="{{ ($user->cover !== null) ? asset('images/user/cover/'.$user->cover) :  asset('assets/backend/images/profile-bg.jpeg')}}" alt="" class="img-fluid" />
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row align-items-center team-row">
                                            <div class="col-lg-4 col team-settings">
                                                <div class="row">
                                                    <div class="col {{(($user->status == 0) ? "text-warning":"text-success")}}" style="font-weight: 500">
                                                        <i class="{{(($user->status == 0) ? "ri-close-circle-line":"ri-checkbox-circle-line")}} fs-16 align-middle"></i>
                                                        @if($user->status == 0)
                                                            Inactive
                                                        @else
                                                            &nbsp;Active
                                                        @endif

                                                    </div>
                                                    <div class="col text-end dropdown">
                                                        <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill fs-17"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-line me-2 align-middle"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img">
                                                    <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                        <img  src="{{ ($user->image !== null) ? asset('images/user/'.$user->image) :  asset('assets/backend/images/default.png')}}" alt="" class="img-fluid d-block rounded-circle" />
                                                    </div>
                                                    <div class="team-content">
                                                        <h5 class="fs-16 mb-1">{{ucwords(@$user->name)}}</h5>
                                                        <p class="text-muted mb-0">{{@$user->email}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="row text-muted text-center">
                                                    <div class="col-6 border-end border-end-dashed">
                                                        <h5 class="mb-1">{{ucwords(@$user->user_type)}}</h5>
                                                        <p class="text-muted mb-0">User Role</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-1">{{($user->contact == null) ? 'Not Added':@$user->contact}}</h5>
                                                        <p class="text-muted mb-0">Contact</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col">
                                                <div class="text-end">
                                                    <a href="#" class="btn btn-light view-btn">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end card-->
                            </div><!--end col-->
                            @endforeach
                            <div class="col-lg-12">
                                <div class="text-center mb-3">
                                    <a href="javascript:void(0);" class="text-success"><i class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i> Load More </a>
                                </div>
                            </div>
                        </div><!--end row-->

                        <!-- Modal -->
                        <div class="modal fade" id="addmembers" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">Add New Members</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="teammembersName" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="teammembersName" placeholder="Enter name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="designation" class="form-label">Designation</label>
                                                        <input type="text" class="form-control" id="designation" placeholder="Enter designation">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="totalProjects" class="form-label">Projects</label>
                                                        <input type="number" class="form-control" id="totalProjects" placeholder="Total projects">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="totalTasks" class="form-label">Tasks</label>
                                                        <input type="number" class="form-control" id="totalTasks" placeholder="Total tasks">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="mb-4">
                                                        <label for="formFile" class="form-label">Profile Images</label>
                                                        <input class="form-control" type="file" id="formFile">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Add Member</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div><!--end modal-content-->
                            </div><!--end modal-dialog-->
                        </div><!--end modal-->

                    </div>
                </div><!-- end col -->
            </div><!--end row-->

            <svg class="bookmark-hide">
                <symbol viewBox="0 0 24 24" stroke="currentColor" fill="var(--color-svg)" id="icon-star"><path stroke-width=".4" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></symbol>
            </svg>

        </div><!-- container-fluid -->
    </div><!-- End Page-content -->


@endsection

@section('js')
    <!-- profile init js -->
    <script src="{{asset('assets/backend/js/pages/team.init.js')}}"></script>
@endsection
