@extends('backend.layouts.master')
@section('title', "Home Setting")
@section('css')
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .hidden{
            display:none!important;
        }
        .dropdown-item{
            cursor: pointer;
        }

        .feature-image-button{
            position: absolute;
            top: 25%;
        }

        .profile-foreground-img-file-input {
            display: none;
        }

        label.profile-photo-edit.btn.btn-light.feature-side-image-button {
            position: absolute;
            bottom: 25%;
        }
    </style>
@endsection


@section('content')
    <div class="page-content">
        <div class="container-fluid" style="position:relative;">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-n4 mx-n4">
                        <div class="bg-soft-warning">
                            <div class="card-body pb-0 px-4">
                                <div class="row mb-3">
                                    <div class="col-md">
                                        <div class="row align-items-center g-3">
                                           
                                            <div class="col-md">
                                                <div>
                                                    <h4 class="fw-bold">
                                                        
                                                         Home Page Settings</h4>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto" style="    margin-top: 1rem;">
                                        <div class="hstack gap-1 flex-wrap">
                                            <div class="d-sm-flex align-items-center justify-content-between">

                                                <div class="page-title-right">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                                        <li class="breadcrumb-item active">{{str_replace('-',' ',ucwords(Request::segment(2)))}}</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#welcome-tab"
                                           role="tab">
                                            Welcome Section                                        </a>
                                    </li>
                                    @if($homesettings !== null)

                                    <li class="nav-item">
                                        <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#simple-header-overview"
                                           role="tab">
                                            Simple Header & Description
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#background-overview"
                                           role="tab">
                                            Background Image with Header & Description
                                        </a>
                                    </li>
                                  
                                    @endif
                                </ul>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content text-muted">
                        <div class="tab-pane fade show active" id="welcome-tab" role="tabpanel">
                            @if($homesettings !== null)
                                {!! Form::open(['url'=>route('homepage.update', @$homesettings->id),'id'=>'homesettings-info-form','class'=>'needs-validation','novalidate'=>'','method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                            @else
                                {!! Form::open(['route' => 'homepage.store','method'=>'post','class'=>'needs-validation','id'=>'homesettings-info-form','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                            @endif
                                <div class="row  mb-4">
                                    <div class="col-lg-8">
                                            <figure class="figure">
                                                <img src="{{asset('images/default-welcome.png')}}" class="figure-img img-fluid rounded" alt="...">
                                                <figcaption class="figure-caption">Output Sample.</figcaption>
                                            </figure>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="welcome-heading-input">Heading</label>
                                                        <input type="text" class="form-control" id="welcome-heading-input" name="welcome_heading" value="{{@$homesettings->welcome_heading}}"
                                                               placeholder="Enter  heading">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="welcome-subheading-input">Sub Heading </label>
                                                        <input type="text" class="form-control" id="welcome-subheading-input" name="welcome_subheading" value="{{@$homesettings->welcome_subheading}}"
                                                               placeholder="Enter  subheading">
                                                    </div>
                                                    <div class="position-relative">
                                                        <label> Description</label>
                                                        <textarea class="form-control" id="ckeditor-classic" name="welcome_description" placeholder="Enter welcome description" rows="3" required>{{@$homesettings->welcome_description}}</textarea>
                                                        <div class="invalid-tooltip">
                                                            Please enter the  description.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card -->

                                      
                                          
                                            <!-- end card -->
                                            <div class="text-end mb-3">
                                                <button type="submit" class="btn btn-success w-sm">{{($homesettings !== null) ? "Update Home Settings":"Save Home Settings"}}</button>
                                            </div>
                                       


                                    </div>
                                    <!-- end col -->

                                    <div class="col-lg-4">
                                        <div class="sticky-side-div">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Other Details</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <img  id="current-img"  src="{{ (@$homesettings->welcome_image !== null) ? asset('images/home/welcome/'.@$homesettings->welcome_image) :  asset('images/default-image.jpg') }}" class="position-relative img-fluid img-thumbnail welcome-feature-image" >
                                                        <input  type="file" accept="image/png, image/jpeg" hidden
                                                            id="profile-foreground-img-file-input" onchange="loadFile(event)" name="welcome_image" {{ (@$homesettings->welcome_image !== null) ? '' :  'required' }}
                                                        class="profile-foreground-img-file-input" >

                                                        <figcaption class="figure-caption">*use image minimum of 820 x 825px </figcaption>
                                                        <div class="invalid-feedback" >
                                                                Please select a image.
                                                            </div>
                                                        <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light feature-image-button">
                                                            <i class="ri-image-edit-line align-bottom me-1"></i> Add  Image
                                                        </label>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="choices-publish-status-input" class="form-label">Image Alignment</label>

                                                        <select class="form-select" id="choices-publish-status-input" name="welcome_side_image" data-choices data-choices-search-false>
                                                            <option value="left" @if(@$homesettings->welcome_side_image == "left") selected @endif>Left</option>
                                                            <option value="right" @if(@$homesettings->welcome_side_image == "right") selected @endif>Right</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>

                                            
                                        </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}

                        </div>
                        @if($homesettings !== null)
                            <div class="tab-pane fade" id="simple-header-overview" role="tabpanel">

                            {!! Form::open(['url'=>route('homepage.direction', @$homesettings->id),'id'=>'homesettings-simple-header-form','class'=>'needs-validation','novalidate'=>'','method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                            
                            <div class="row  mb-4">
                                    <div class="col-lg-8">
                                        <figure class="figure">
                                            <img src="{{asset('images/default-simple-section.png')}}" class="figure-img img-fluid rounded" alt="...">
                                            <figcaption class="figure-caption">Output Sample.</figcaption>
                                        </figure>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Main Section</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label" for="direction-heading-input">Heading</label>
                                                    <input type="text" class="form-control" id="direction-heading-input" name="direction_heading" value="{{@$homesettings->direction_heading}}"
                                                            placeholder="Enter heading">
                                                </div>
                                               
                                                <div class="position-relative">
                                                    <label> Description</label>
                                                    <textarea class="form-control"  name="direction_description" placeholder="Enter description" rows="3" >{{@$homesettings->direction_description}}</textarea>
                                                    <div class="invalid-tooltip">
                                                        Please enter the  description.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Secondary Section</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label" for="direction-list-heading-input">Heading</label>
                                                    <input type="text" class="form-control" id="direction-list-heading-input" name="direction_list_heading" value="{{@$homesettings->direction_list_heading}}"
                                                            placeholder="Enter  heading">
                                                </div>
                                               
                                                <div class="position-relative">
                                                    <label> Description</label>
                                                    <textarea class="form-control" id="ckeditor-classic-direction" name="direction_list_description" placeholder="Enter description" rows="3" required>{{@$homesettings->direction_list_description}}</textarea>
                                                    <div class="invalid-tooltip">
                                                        Please enter the  description.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->

                                    
                                        
                                        <!-- end card -->
                                        <div class="text-end mb-3">
                                            <button type="submit" class="btn btn-success w-sm">Update Section</button>
                                        </div>
                                       


                                    </div>
                                    <!-- end col -->

                                    <div class="col-lg-4">
                                        <div class="sticky-side-div">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Other Details</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <img  id="direction-current-img"  src="{{ (@$homesettings->direction_list_image !== null) ? asset('images/home/direction/'.@$homesettings->direction_list_image) :  asset('images/default-image.jpg') }}" class="position-relative img-fluid img-thumbnail direction-feature-image" >
                                                        <input  type="file" accept="image/png, image/jpeg" hidden
                                                            id="direction-current-img-update" onchange="loadbasicFile('direction-current-img-update','direction-current-img',event)"  name="direction_list_image" {{ (@$homesettings->direction_list_image !== null) ? '' :  'required' }}
                                                        class="profile-foreground-img-file-input" >

                                                        <figcaption class="figure-caption">*use image minimum of 725 x 810px </figcaption>
                                                        <div class="invalid-feedback" >
                                                                Please select a image.
                                                            </div>
                                                        <label for="direction-current-img-update" class="profile-photo-edit btn btn-light feature-image-button">
                                                            <i class="ri-image-edit-line align-bottom me-1"></i> Add  Image
                                                        </label>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="choices-publish-status-input" class="form-label">Image Alignment</label>

                                                        <select class="form-select" id="choices-publish-status-input" name="direction_displaying_side_image" data-choices data-choices-search-false>
                                                            <option value="left" @if(@$homesettings->direction_displaying_side_image == "left") selected @endif>Left</option>
                                                            <option value="right" @if(@$homesettings->direction_displaying_side_image == "right") selected @endif>Right</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="choices-publish-status-input" class="form-label">Background Color</label>

                                                        <select class="form-select" id="choices-publish-status-input" name="direction_container_color" data-choices data-choices-search-false>
                                                            <option value="white" @if(@$homesettings->direction_container_color == "white") selected @endif>White Color</option>
                                                            <option value="grey" @if(@$homesettings->direction_container_color == "grey") selected @endif>Light Grey color</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                                <!-- end card body -->
                                            </div>

                                            
                                        </div>
                                    </div>
                                </div>

                            {!! Form::close() !!}


                            </div>

                            <div class="tab-pane fade" id="background-overview" role="tabpanel">

                                {!! Form::open(['url'=>route('homepage.background', @$homesettings->id),'id'=>'settings-background-form','class'=>'needs-validation','novalidate'=>'','method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                                <div class="row  mb-4">
                                    <div class="col-lg-8">
                                            <figure class="figure">
                                                <img src="{{asset('images/default-background-section.png')}}" class="figure-img img-fluid rounded" alt="...">
                                                <figcaption class="figure-caption">Output Sample.</figcaption>
                                            </figure>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="background-heading-input">Heading</label>
                                                        <input type="text" class="form-control" id="background-heading-input" name="background_heading" value="{{@$homesettings->background_heading}}"
                                                               placeholder="Enter  heading">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="background-subheading-input">Sub Heading </label>
                                                        <input type="text" class="form-control" id="background-subheading-input" name="background_subheading" value="{{@$homesettings->background_subheading}}"
                                                               placeholder="Enter  subheading">
                                                    </div>
                                                    <div class="position-relative">
                                                        <label> Description</label>
                                                        <textarea class="form-control" id="ckeditor-classic-background" name="background_description" placeholder="Enter description" rows="3" required>{{@$homesettings->background_description}}</textarea>
                                                        <div class="invalid-tooltip">
                                                            Please enter the  description.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card -->

                                      
                                          
                                            <!-- end card -->
                                            <div class="text-end mb-3">
                                                <button type="submit" class="btn btn-success w-sm">Update </button>
                                            </div>
                                       


                                    </div>
                                    <!-- end col -->

                                    <div class="col-lg-4">
                                        <div class="sticky-side-div">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Other Details</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <img  id="background-current-img"  src="{{ (@$homesettings->background_image !== null) ? asset('images/home/background/'.@$homesettings->background_image) :  asset('images/default-image.jpg') }}" class="position-relative img-fluid img-thumbnail welcome-feature-image" >
                                                        <input  type="file" accept="image/png, image/jpeg" hidden
                                                            id="background-current-img-update"  onchange="loadbasicFile('background-current-img-update','background-current-img',event)" name="background_image" {{ (@$homesettings->background_image !== null) ? '' :  'required' }}
                                                        class="background-current-img-update" >

                                                        <figcaption class="figure-caption">*use image minimum of 1920 x 1080px </figcaption>
                                                        <div class="invalid-feedback" >
                                                                Please select a image.
                                                            </div>
                                                        <label for="background-current-img-update" class="profile-photo-edit btn btn-light feature-image-button">
                                                            <i class="ri-image-edit-line align-bottom me-1"></i> Add Background Image
                                                        </label>
                                                    </div>
                                                    <div class="mb-3">
                                                    <img  id="background-side-current-img"  src="{{ (@$homesettings->background_side_image !== null) ? asset('images/home/background/'.@$homesettings->background_side_image) :  asset('images/default-image.jpg') }}" class="position-relative img-fluid img-thumbnail welcome-feature-image" >
                                                        <input  type="file" accept="image/png, image/jpeg" hidden
                                                            id="background-side-current-img-update"  onchange="loadbasicFile('background-side-current-img-update','background-side-current-img',event)" name="background_side_image" {{ (@$homesettings->background_side_image !== null) ? '' :  'required' }}
                                                        class="background-current-img-update" >

                                                        <figcaption class="figure-caption">*use image minimum of 700 x 815px </figcaption>
                                                        <div class="invalid-feedback" >
                                                                Please select a image.
                                                            </div>
                                                        <label for="background-side-current-img-update" class="profile-photo-edit btn btn-light feature-side-image-button">
                                                            <i class="ri-image-edit-line align-bottom me-1"></i> Add Side Image
                                                        </label>
                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>

                                            
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}


                            </div>

                      
                           

                        @endif

                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>



@endsection

@section('js')
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>


    <script src="{{asset('assets/backend/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>


    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script src="{{asset('assets/backend/custom_js/homepage.js')}}"></script>



@endsection