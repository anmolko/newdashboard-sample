@extends('backend.layouts.master')
@section('title', "Our Work")
@section('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/custom_css/datatable_style.css')}}">
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

    <style>


    </style>
@endsection
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Our Work</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Our Work</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xxl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title mb-3 text-start">Work Category</h6>
                            {!! Form::open(['id' => 'work-category-add-form','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}
                            <div class="mb-3">
                                <label class="form-label" for="category-title-input">Title</label>
                                <input type="text" name="name" class="form-control" id="category-title-input"
                                       onclick="slugMaker('category-title-input','category-slug-input')" placeholder="Enter category title" required>
                                <div class="invalid-feedback">
                                    Please enter the category title.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category-slug-input">Slug</label>
                                <input type="text" name="slug" class="form-control" id="category-slug-input"
                                       placeholder="Enter category slug" required>
                                <div class="invalid-feedback">
                                    Please enter the category slug.
                                </div>
                            </div>
                            <div class="hstack gap-2 justify-content-center">
                                <button type="button" class="btn btn-success btn-sm" id="work-category-submit" cs-create-route="{{route('work-category.store')}}"><i class="ri-play-circle-line align-bottom me-1"></i> Save</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div><!--end card-->
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-4">
                                <select class="form-control" name="choices-single-default" data-choices data-choices-search-false>
                                    <option value="">Select Task board</option>
                                    <option value="Unassigned">Unassigned</option>
                                    <option value="To Do">To Do</option>
                                    <option value="Inprogress">Inprogress</option>
                                    <option value="In Reviews" selected>In Reviews</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                            <div class="table-card">
                                <table class="table mb-0">
                                    <tbody>
                                    <tr>
                                        <td class="fw-medium">Tasks No</td>
                                        <td>#VLZ456</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Tasks Title</td>
                                        <td>Profile Page Satructure</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Project Name</td>
                                        <td>Velzon - Admin Dashboard</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Priority</td>
                                        <td><span class="badge badge-soft-danger">High</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Status</td>
                                        <td><span class="badge badge-soft-secondary">Inprogress</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Due Date</td>
                                        <td>05 Jan, 2022</td>
                                    </tr>
                                    </tbody>
                                </table><!--end table-->
                            </div>
                        </div>
                    </div><!--end card-->
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <h6 class="card-title mb-0 flex-grow-1">Assigned To</h6>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-danger btn-sm" data-bs-toggle="modal" data-bs-target="#inviteMembersModal"><i class="ri-share-line me-1 align-bottom"></i> Assigned Member</button>
                                </div>
                            </div>
                            <ul class="list-unstyled vstack gap-3 mb-0">
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-10.jpg" alt="" class="avatar-xs rounded-circle">
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1"><a href="pages-profile.html">Tonya Noble</a></h6>
                                            <p class="text-muted mb-0">Full Stack Developer</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <button class="btn btn-icon btn-sm fs-16 text-muted dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-8.jpg" alt="" class="avatar-xs rounded-circle">
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1"><a href="pages-profile.html">Thomas Taylor</a></h6>
                                            <p class="text-muted mb-0">UI/UX Designer</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <button class="btn btn-icon btn-sm fs-16 text-muted dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-circle">
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1"><a href="pages-profile.html">Nancy Martino</a></h6>
                                            <p class="text-muted mb-0">Web Designer</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <button class="btn btn-icon btn-sm fs-16 text-muted dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div><!--end card-->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Attachments</h5>
                            <div class="vstack gap-2">
                                <div class="border rounded border-dashed p-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-sm">
                                                <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                    <i class="ri-folder-zip-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="fs-13 mb-1"><a href="javascript:void(0);" class="text-body text-truncate d-block">App pages.zip</a></h5>
                                            <div>2.2MB</div>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <div class="d-flex gap-1">
                                                <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i class="ri-download-2-line"></i></button>
                                                <div class="dropdown">
                                                    <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Rename</a></li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border rounded border-dashed p-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-sm">
                                                <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                    <i class="ri-file-ppt-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="fs-13 mb-1"><a href="javascript:void(0);" class="text-body text-truncate d-block">Velzon admin.ppt</a></h5>
                                            <div>2.4MB</div>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <div class="d-flex gap-1">
                                                <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i class="ri-download-2-line"></i></button>
                                                <div class="dropdown">
                                                    <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Rename</a></li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border rounded border-dashed p-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-sm">
                                                <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                    <i class="ri-folder-zip-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="fs-13 mb-1"><a href="javascript:void(0);" class="text-body text-truncate d-block">Images.zip</a></h5>
                                            <div>1.2MB</div>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <div class="d-flex gap-1">
                                                <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i class="ri-download-2-line"></i></button>
                                                <div class="dropdown">
                                                    <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Rename</a></li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 text-center">
                                    <button type="button" class="btn btn-success">View more</button>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-->
                </div><!---end col-->
                <div class="col-xxl-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-muted">
                                <h6 class="mb-3 fw-semibold text-uppercase">Work Category List</h6>
                                <p>Showcase your work categories such as web development, analytics here.</p>

                                <div class="row">
                                    <div class="table-responsive mb-1">
                                        <table id="work-category-index" class="table align-middle table-nowrap table-striped">
                                            <thead class="table-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="work-category-list">
                                            @if(!empty($categories))
                                                @foreach($categories as  $category)
                                                    <tr id="category-block-num-{{@$category->id}}">
                                                        <td id="category-td-name-{{@$category->id}}">{{ ucwords(@$category->name) }}</td>
                                                        <td id="category-td-slug-{{@$category->id}}">{{ @$category->slug }}</td>
                                                        <td >
                                                            <div class="row">

                                                                <div class="col text-center dropdown">
                                                                    <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill fs-17"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                                        <li><a class="dropdown-item cs-category-edit" id="cs-role-category-edit-{{$category->id}}" cs-update-route="{{route('work-category.update',$category->id)}}" cs-edit-route="{{route('work-category.edit',$category->id)}}"><i class="ri-pencil-fill me-2 align-middle"></i>Edit</a></li>
                                                                        <li><a class="dropdown-item cs-category-remove" cs-delete-route="{{route('work-category.destroy',$category->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
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
                    </div><!--end card-->
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab">
                                            Comments (5)
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab">
                                            Attachments File (4)
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#profile-1" role="tab">
                                            Time Entries (9 hrs 13 min)
                                        </a>
                                    </li>
                                </ul><!--end nav-->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="home-1" role="tabpanel">
                                    <h5 class="card-title mb-4">Comments</h5>
                                    <div data-simplebar style="height: 508px;" class="px-3 mx-n3 mb-2">
                                        <div class="d-flex mb-4">
                                            <div class="flex-shrink-0">
                                                <img src="assets/images/users/avatar-7.jpg" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-13"><a href="pages-profile.html">Joseph Parker</a> <small class="text-muted">20 Dec 2021 - 05:47AM</small></h5>
                                                <p class="text-muted">I am getting message from customers that when they place order always get error message .</p>
                                                <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                                <div class="d-flex mt-4">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-10.jpg" alt="" class="avatar-xs rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-13"><a href="pages-profile.html">Tonya Noble</a> <small class="text-muted">22 Dec 2021 - 02:32PM</small></h5>
                                                        <p class="text-muted">Please be sure to check your Spam mailbox to see if your email filters have identified the email from Dell as spam.</p>
                                                        <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex mb-4">
                                            <div class="flex-shrink-0">
                                                <img src="assets/images/users/avatar-8.jpg" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-13"><a href="pages-profile.html">Thomas Taylor</a> <small class="text-muted">24 Dec 2021 - 05:20PM</small></h5>
                                                <p class="text-muted">If you have further questions, please contact Customer Support from the “Action Menu” on your <a href="javascript:void(0);" class="text-decoration-underline">Online Order Support</a>.</p>
                                                <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="assets/images/users/avatar-10.jpg" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-13"><a href="pages-profile.html">Tonya Noble</a> <small class="text-muted">26 min ago</small></h5>
                                                <p class="text-muted">Your <a href="javascript:void(0)" class="text-decoration-underline">Online Order Support</a> provides you with the most current status of your order. To help manage your order refer to the “Action Menu” to initiate return, contact Customer Support and more.</p>
                                                <div class="row g-2 mb-3">
                                                    <div class="col-lg-1 col-sm-2 col-6">
                                                        <img src="assets/images/small/img-4.jpg" alt="" class="img-fluid rounded">
                                                    </div>
                                                    <div class="col-lg-1 col-sm-2 col-6">
                                                        <img src="assets/images/small/img-5.jpg" alt="" class="img-fluid rounded">
                                                    </div>
                                                </div>
                                                <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                                <div class="d-flex mt-4">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-13"><a href="pages-profile.html">Nancy Martino</a> <small class="text-muted">8 sec ago</small></h5>
                                                        <p class="text-muted">Other shipping methods are available at checkout if you want your purchase delivered faster.</p>
                                                        <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form class="mt-4">
                                        <div class="row g-3">
                                            <div class="col-lg-12">
                                                <label for="exampleFormControlTextarea1" class="form-label">Leave a Comments</label>
                                                <textarea class="form-control bg-light border-light" id="exampleFormControlTextarea1" rows="3" placeholder="Enter comments"></textarea>
                                            </div><!--end col-->
                                            <div class="col-12 text-end">
                                                <button type="button" class="btn btn-ghost-secondary btn-icon waves-effect me-1"><i class="ri-attachment-line fs-16"></i></button>
                                                <a href="javascript:void(0);" class="btn btn-success">Post Comments</a>
                                            </div>
                                        </div><!--end row-->
                                    </form>
                                </div><!--end tab-pane-->
                                <div class="tab-pane" id="messages-1" role="tabpanel">
                                    <div class="table-responsive table-card">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light text-muted">
                                            <tr>
                                                <th scope="col">File Name</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Upload Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-soft-primary text-primary rounded fs-20">
                                                                <i class="ri-file-zip-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h6 class="fs-15 mb-0"><a href="javascript:void(0)">App pages.zip</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Zip File</td>
                                                <td>2.22 MB</td>
                                                <td>21 Dec, 2021</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="ri-equalizer-fill"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink1" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                            <li class="dropdown-divider"></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-soft-danger text-danger rounded fs-20">
                                                                <i class="ri-file-pdf-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Velzon admin.ppt</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>PPT File</td>
                                                <td>2.24 MB</td>
                                                <td>25 Dec, 2021</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="ri-equalizer-fill"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                            <li class="dropdown-divider"></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-soft-info text-info rounded fs-20">
                                                                <i class="ri-folder-line"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Images.zip</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>ZIP File</td>
                                                <td>1.02 MB</td>
                                                <td>28 Dec, 2021</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink3" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="ri-equalizer-fill"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink3" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle"></i>Download</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-soft-danger text-danger rounded fs-20">
                                                                <i class="ri-image-2-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Bg-pattern.png</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>PNG File</td>
                                                <td>879 KB</td>
                                                <td>02 Nov 2021</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink4" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="ri-equalizer-fill"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink4" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle"></i>Download</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table><!--end table-->
                                    </div>
                                </div><!--end tab-pane-->
                                <div class="tab-pane" id="profile-1" role="tabpanel">
                                    <h6 class="card-title mb-4 pb-2">Time Entries</h6>
                                    <div class="table-responsive table-card">
                                        <table class="table align-middle mb-0">
                                            <thead class="table-light text-muted">
                                            <tr>
                                                <th scope="col">Member</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Duration</th>
                                                <th scope="col">Timer Idle</th>
                                                <th scope="col">Tasks Title</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle avatar-xxs">
                                                        <div class="flex-grow-1 ms-2">
                                                            <a href="pages-profile.html" class="fw-medium">Thomas Taylor</a>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>02 Jan, 2022</td>
                                                <td>3 hrs 12 min</td>
                                                <td>05 min</td>
                                                <td>Apps Pages</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle avatar-xxs">
                                                        <div class="flex-grow-1 ms-2">
                                                            <a href="pages-profile.html" class="fw-medium">Tonya Noble</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>28 Dec, 2021</td>
                                                <td>1 hrs 35 min</td>
                                                <td>-</td>
                                                <td>Profile Page Design</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle avatar-xxs">
                                                        <div class="flex-grow-1 ms-2">
                                                            <a href="pages-profile.html" class="fw-medium">Tonya Noble</a>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>27 Dec, 2021</td>
                                                <td>4 hrs 26 min</td>
                                                <td>03 min</td>
                                                <td>Ecommerce Dashboard</td>
                                            </tr>
                                            </tbody>
                                        </table><!--end table-->
                                    </div>
                                </div><!--edn tab-pane-->

                            </div><!--end tab-content-->
                        </div>
                    </div><!--end card-->
                </div><!--end col-->
            </div><!--end row-->

            <div class="modal fade" id="inviteMembersModal" tabindex="-1" aria-labelledby="inviteMembersModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header p-3 ps-4 bg-soft-success">
                            <h5 class="modal-title" id="inviteMembersModalLabel">Team Members</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="search-box mb-3">
                                <input type="text" class="form-control bg-light border-light" placeholder="Search here...">
                                <i class="ri-search-line search-icon"></i>
                            </div>

                            <div class="mb-4 d-flex align-items-center">
                                <div class="me-2">
                                    <h5 class="mb-0 fs-13">Members :</h5>
                                </div>
                                <div class="avatar-group justify-content-center">
                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tonya Noble">
                                        <div class="avatar-xs">
                                            <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle img-fluid">
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Thomas Taylor">
                                        <div class="avatar-xs">
                                            <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle img-fluid">
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nancy Martino">
                                        <div class="avatar-xs">
                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle img-fluid">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="mx-n4 px-4" data-simplebar style="max-height: 225px;">
                                <div class="vstack gap-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs flex-shrink-0 me-3">
                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="img-fluid rounded-circle">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Nancy Martino</a></h5>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-light btn-sm">Add</button>
                                        </div>
                                    </div>
                                    <!-- end member item -->
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs flex-shrink-0 me-3">
                                            <div class="avatar-title bg-soft-danger text-danger rounded-circle">
                                                HB
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Henry Baird</a></h5>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-light btn-sm">Add</button>
                                        </div>
                                    </div>
                                    <!-- end member item -->
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs flex-shrink-0 me-3">
                                            <img src="assets/images/users/avatar-3.jpg" alt="" class="img-fluid rounded-circle">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Frank Hook</a></h5>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-light btn-sm">Add</button>
                                        </div>
                                    </div>
                                    <!-- end member item -->
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs flex-shrink-0 me-3">
                                            <img src="assets/images/users/avatar-4.jpg" alt="" class="img-fluid rounded-circle">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Jennifer Carter</a></h5>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-light btn-sm">Add</button>
                                        </div>
                                    </div>
                                    <!-- end member item -->
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs flex-shrink-0 me-3">
                                            <div class="avatar-title bg-soft-success text-success rounded-circle">
                                                AC
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Alexis Clarke</a></h5>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-light btn-sm">Add</button>
                                        </div>
                                    </div>
                                    <!-- end member item -->
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs flex-shrink-0 me-3">
                                            <img src="assets/images/users/avatar-7.jpg" alt="" class="img-fluid rounded-circle">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Joseph Parker</a></h5>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-light btn-sm">Add</button>
                                        </div>
                                    </div>
                                    <!-- end member item -->
                                </div>
                                <!-- end list -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light w-xs" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success w-xs">Assigned</button>
                        </div>
                    </div>
                    <!-- end modal-content -->
                </div>
                <!-- modal-dialog -->
            </div>
            <!-- end modal -->

        </div>
        <!-- container-fluid -->
    </div>

    @include('backend.work.modal.category-edit')


@endsection

@section('js')
    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            var dataTable = $('#work-category-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
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

        $('#work-category-submit').on('click', function(e) {
            var form            = $('#work-category-add-form')[0]; //get the form using ID
            if (!form.reportValidity()) { return false;}
            var formData        = new FormData(form); //Creates new FormData object
            var url             = $(this).attr("cs-create-route");
            var request_method  = 'POST'; //get form GET/POST method
            $.ajax({
                type : request_method,
                url : url,
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                data : formData,
                success: function(response){

                    if(response.status=='slug duplicate'){
                        Toastify({ newWindow: !0, text: response.message, gravity: 'top', position: 'center', stopOnFocus: !0, duration: 3000, close: "close",className: "bg-warning",style: "style" == e.style ? { background: "linear-gradient(to right, #0AB39C, #405189)" } : "" }).showToast();
                        return;
                    }
                    ;
                    var category_edit = '/auth/work-category/'+response.category.id+'/edit';
                    var category_update = '/auth/work-category/'+response.category.id;
                    var category_remove = '/auth/work-category/'+response.category.id;

                    if(response.status=='success') {
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
                                response.message +
                                '</p>' +
                                '</div>' +
                                '</div>',
                            timerProgressBar: !0,
                            timer: 2e3,
                            showConfirmButton: !1
                        });


                        var block = '<tr id="category-block-num-'+response.category.id+'">'+
                            '<td id="category-td-name-'+response.category.id+'">'+response.category.name+'<span class="badge bg-success ms-1">New</span></td>'+
                            '<td id="category-td-slug-'+response.category.id+'">'+response.category.slug+'</td>'+
                            '<td>'+
                            '<div class="row">'+
                            '<div class="col text-center dropdown"> ' +
                            '<a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false"> ' +
                            '<i class="ri-more-fill fs-17"></i> ' +
                            '</a> ' +
                            '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2"> ' +
                            '<li><a class="dropdown-item cs-category-edit" id="cs-category-edit-'+response.category.id+'" cs-update-route="'+category_update+'" cs-edit-route="'+category_edit+'"><i class="ri-pencil-fill me-2 align-middle"></i>Edit</a></li>' +
                            '<li><a class="dropdown-item cs-category-remove" cs-delete-route="'+category_remove+'"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li> ' +
                            '</ul>' +
                            '</div>' +
                            '</div>' +
                            '</td>'+
                            '</tr>';
                        $("td.dataTables_empty").remove();
                        $("#work-category-list").prepend(block);
                    }
                    else{
                        Swal.fire({
                            imageUrl: "/assets/backend/images/canosoft-logo.png",
                            imageHeight: 60,
                            html: '<div class="mt-2">' +
                                '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                                ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                                'style="width:120px;height:120px"></lord-icon>' +
                                '<div class="mt-4 pt-2 fs-15">' +
                                '<h4>Oops...! </h4>' +
                                '<p class="text-muted mx-4 mb-0">' + response.message +
                                '</p>' +
                                '</div>' +
                                '</div>',
                            timerProgressBar: !0,
                            timer: 3000,
                            showConfirmButton: !1
                        });
                    }
                }, error: function(response) {
                    console.log(response);
                }
            });
        });

        $(document).on('click','.cs-category-edit', function (e) {
            e.preventDefault();
            // console.log(action)
            var id= $(this).attr('id');
            var action = $(this).attr('cs-update-route');
            $.ajax({
                url: $(this).attr('cs-edit-route'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    // $('#id').val(data.id);
                    $("#edit_work_category").modal("toggle");
                    $('#update-name').attr('value',dataResult.name);
                    $('#update-slug').attr('value',dataResult.slug);
                    $('#category_id').attr('value',dataResult.id);
                    $('.updateworkcategory').attr('action',action);
                },
                error: function(error){
                    console.log(error)
                }
            });
        });

        $(document).on('click','.cs-category-remove', function (e) {
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

                                var category_block = '#category-block-num-'+response.id;
                                setTimeout(function() {
                                    $(category_block).remove();
                                    if(response.count == 1){
                                        var block = '<tr class="odd">' +
                                            '<td valign="top" colSpan="4" class="dataTables_empty">No data available in table </td> ' +
                                            '</tr>';
                                        $("#work-category-list").prepend(block);
                                    }
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
                        text: "Work category was not removed.",
                        icon: "error",
                        confirmButtonClass: "btn btn-primary mt-2",
                        buttonsStyling: !1
                    });
            });



        })


    </script>
@endsection
