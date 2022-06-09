@extends('backend.layouts.master')
@section('title', "Project plan and Pricing")
@section('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/custom_css/datatable_style.css')}}">
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .feature-image-button{
            position: absolute;
            top: 15%;
        }
        .profile-foreground-img-file-input {
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
                        <h4 class="mb-sm-0">Project plan and Pricing</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Project plan</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xxl-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title mb-3 text-start">Create Plan</h6>
                            {!! Form::open(['route' => 'project-plan.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}
                            <div class="mb-3">
                                <label class="form-label" for="name-input">Name</label>
                                <input type="text" name="name" class="form-control" id="name-input" placeholder="Enter plan name" required>
                                <div class="invalid-feedback">
                                    Please enter the name.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="price-input">Price</label>
                                <input type="text" name="price" class="form-control" id="price-input"
                                       placeholder="Enter plan price" required>
                                <div class="invalid-feedback">
                                    Please enter the plan price.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="type-input">Type</label>
                                <select class="form-select" id="type-input" name="type" required>
                                    <option value disabled selected>Select plan type</option>
                                    <optgroup label="Category one">
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                    </optgroup>
                                    <optgroup label="Category Two">
                                        <option value="personal">Personal</option>
                                        <option value="commercial">Commercial</option>
                                    </optgroup>
                                </select>
                                <div class="invalid-feedback">
                                    Please enter the plan price.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="link-input">Button Link</label>
                                <input type="text" name="link" class="form-control" id="link-input"
                                       placeholder="Enter the link">
                                <div class="invalid-feedback">
                                    Please enter the link.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="summary-input">Description </label>
                                <textarea class="form-control" id="ckeditor-classic" placeholder="Enter Descrition (use lists)" name="description" rows="5" required></textarea>
                                <div class="invalid-feedback">
                                    Please enter the description.
                                </div>
                                <span class="figure-caption">* Only use list options here</span>
                            </div>
                            <div class="hstack gap-2 justify-content-center">
                                <button type="submit" class="btn btn-success btn-sm"><i class="ri-play-circle-line align-bottom me-1"></i> Save</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-muted">
                                <h6 class="mb-3 fw-semibold text-uppercase">Project Plan List</h6>
                                <p>Showcase plans and pricing here.</p>

                                <div class="row">
                                    <div class="table-responsive mb-1">
                                        <table id="plan-index" class="table align-middle table-nowrap table-striped">
                                            <thead class="table-light">
                                            <tr>
                                                <th>Name </th>
                                                <th>Price </th>
                                                <th>Type </th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($project_plan))
                                                @foreach($project_plan as  $project)
                                                    <tr>
                                                        <td>{{ ucwords(@$project->name) }}</td>
                                                        <td>{{ @$project->price }}</td>
                                                        <td>{{ ucwords(@$project->type) }}</td>
                                                        <td>
                                                            <div class="row">

                                                                <div class="col text-center dropdown">
                                                                    <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill fs-17"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                                        <li><a class="dropdown-item cs-plan-edit" cs-update-route="{{route('project-plan.update',$project->id)}}" cs-edit-route="{{route('project-plan.edit',$project->id)}}"><i class="ri-pencil-fill me-2 align-middle"></i>Edit</a></li>
                                                                        <li><a class="dropdown-item cs-plan-remove" cs-delete-route="{{route('project-plan.destroy',$project->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
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
            </div><!--end row-->
        </div>
        <!-- container-fluid -->
    </div>

    @include('backend.project_plan.modals.edit')

@endsection

@section('js')
    <script src="{{asset('assets/backend/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/custom_js/project.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>
@endsection
