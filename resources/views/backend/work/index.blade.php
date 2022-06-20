@extends('backend.layouts.master')
@section('title', "Our Work")
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
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <h6 class="card-title mb-0 flex-grow-1">Add Work</h6>
                            </div>
                            {!! Form::open(['route' => 'our-work.store','method'=>'post','id' => 'work-add-form','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                            <div class="mb-3">
                                <label class="form-label" for="work-title-input">Title</label>
                                <input type="text" name="title" class="form-control" id="work-title-input" placeholder="Enter work title" required>
                                <div class="invalid-feedback">
                                    Please enter the work title.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="choices-work-category-input" class="form-label">Status</label>
                                <select class="form-select" id="choices-work-category-input" name="work_category_id">
                                    <option value selected disabled>Select work category</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select the work category.
                                </div>
                            </div>

                            <label class="form-label">Image</label>
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <img  id="current-work-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                        <input  type="file" accept="image/png, image/jpeg" hidden
                                                id="work-foreground-img-file-input" onchange="loadbasicFile('work-foreground-img-file-input','current-work-img',event)" name="image" required
                                                class="work-foreground-img-file-input" >

                                        <figcaption class="figure-caption">Select your related work image.</figcaption>
                                        <div class="invalid-feedback" >
                                            Please select a image.
                                        </div>
                                        <label for="work-foreground-img-file-input" class="profile-photo-edit btn btn-light feature-image-button">
                                            <i class="ri-image-edit-line align-bottom me-1"></i> Add Work Image
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="hstack gap-2 justify-content-center">
                                <button type="submit" class="btn btn-success btn-sm" id="work-submit"><i class="ri-play-circle-line align-bottom me-1"></i> Save</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
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
                                            Work ({{count($works)}})
                                        </a>
                                    </li>
                                </ul><!--end nav-->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="home-1" role="tabpanel">


                                    @if(count($works)>0)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="text-center">
                                                                <ul class="list-inline categories-filter animation-nav" id="filter">
                                                                    <li class="list-inline-item"><a class="categories active" data-filter="*">All</a></li>
                                                                    @foreach($main_categories as $key=>$value)
                                                                        <li class="list-inline-item"><a class="categories" data-filter=".{{str_replace(' ','-',$value)}}">{{ ucwords($value) }}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>

                                                            <div class="row gallery-wrapper">

                                                                @foreach($works as $work)
                                                                <div class="element-item col-xxl-3 col-xl-4 col-sm-6 {{str_replace(' ','-',$work->category->name)}}" data-category="{{str_replace(' ','-',$work->category->name)}}">
                                                                    <div class="gallery-box card">
                                                                        <div class="gallery-container">
                                                                            <a class="image-popup" href="{{asset('images/work/'.$work->image)}}" title="{{$work->title}}">
                                                                                <img class="gallery-img img-fluid mx-auto" src="{{asset('images/work/'.$work->image)}}" alt="" />
                                                                                <div class="gallery-overlay">
                                                                                    <h5 class="overlay-caption">{{$work->title}}</h5>
                                                                                </div>
                                                                            </a>

                                                                        </div>

                                                                        <div class="box-content">
                                                                            <div class="d-flex align-items-center mt-1">
                                                                                <div class="flex-shrink-0">
                                                                                    <div class="d-flex gap-3">
                                                                                        <a href="#"
                                                                                                cs-update-route="{{route('our-work.update',$work->id)}}" cs-edit-route="{{route('our-work.edit',$work->id)}}"
                                                                                                class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 cs-work-edit">
                                                                                            <i class="ri-edit-2-fill text-muted align-bottom me-1"></i> Edit
                                                                                        </a>
                                                                                        <a href="#"
                                                                                                cs-delete-route="{{route('our-work.destroy',$work->id)}}" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 cs-work-remove">
                                                                                            <i class=" ri-delete-bin-2-fill text-muted align-bottom me-1"></i> Delete
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach

                                                            </div>
                                                            <!-- end row -->
                                                        </div>
                                                    </div>
                                                    <!-- end row -->
                                                </div>
                                                <!-- ene card body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    @else
                                        <form class="mt-4">
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <label for="exampleFormControlTextarea1" class="form-label">There is no available work added currently for display.</label>
                                                </div>
                                            </div>
                                        </form>
                                    @endif









                                </div><!--end tab-pane-->


                            </div><!--end tab-content-->
                        </div>
                    </div><!--end card-->
                </div><!--end col-->
            </div><!--end row-->
        </div>
        <!-- container-fluid -->
    </div>

    @include('backend.work.modal.category-edit')

    @include('backend.work.modal.work-edit')

@endsection

@section('js')
    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <!-- glightbox js -->
    <script src="{{asset('assets/backend/libs/glightbox/js/glightbox.min.js')}}"></script>

    <!-- isotope-layout -->
    <script src="{{asset('assets/backend/libs/isotope-layout/isotope.pkgd.min.js')}}"></script>

    <script src="{{asset('assets/backend/js/pages/gallery.init.js')}}"></script>

    <script src="{{asset('assets/backend/custom_js/work.js')}}"></script>

@endsection
