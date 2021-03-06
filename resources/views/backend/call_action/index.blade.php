@extends('backend.layouts.master')
@section('title', "Call Actions")
@section('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/custom_css/datatable_style.css')}}">
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Call Actions</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Create Call Actions</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-4">
                    {!! Form::open(['id' => 'call-action-form','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="action-name-input">Name</label>
                                <input type="text" name="name" class="form-control" id="action-name-input"
                                       placeholder="Enter name of call action" />
                                <div class="invalid-feedback">
                                    Please enter the name.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="action-title-input">Title</label>
                                <input type="text" name="title" class="form-control" id="action-title-input"
                                       placeholder="Enter title" required>
                                <div class="invalid-feedback">
                                    Please enter the title.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category-button-input">Button Name</label>
                                <input type="text" name="button" class="form-control" id="category-button-input"
                                       placeholder="Enter button name">
                                <div class="invalid-feedback">
                                    Please enter the button.
                                </div>
                            </div>
                            <div>
                                <label class="form-label" for="category-link-input">Button link</label>
                                <input type="text" name="link" class="form-control" id="category-link-input"
                                       placeholder="Enter button link">
                                <div class="invalid-feedback">
                                    Please enter the button link.
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end card -->

                    <!-- end card -->
                    <div class="text-end mb-3">
                        <button type="button" class="btn btn-success w-sm form-control" id="call-action-add-button" cs-create-route="{{route('call-actions.store')}}">Submit</button>
                    </div>
                    {!! Form::close() !!}



                </div>
                <!-- end col -->

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Call Action List</h4>
                        </div>
                        <div class="card-body">

                            <div class="row" >

                                <div class="table-responsive  mt-3 mb-1">
                                    <table id="call-action-index" class="table align-middle table-nowrap table-striped">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Title</th>
                                            <th>Link</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="call-action-list">
                                        @if(!empty($callactions))
                                            @foreach($callactions as  $call)
                                                <tr id="call-action-num-{{@$call->id}}">
                                                    <td id="call-action-name-{{@$call->id}}">{{ ucwords(@$call->name) }}</td>
                                                    <td id="call-action-title-{{@$call->id}}">{{ ucwords(@$call->title) }}</td>
                                                    <td id="category-td-link-{{@$call->id}}">{{ @$call->link }}</td>
                                                    <td>
                                                        <div class="row">

                                                            <div class="col text-center dropdown">
                                                                <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                                    <li><a class="dropdown-item cs-call-edit" id="cs-role-call-edit-{{$call->id}}" cs-update-route="{{route('call-actions.update',$call->id)}}" cs-edit-route="{{route('call-actions.edit',$call->id)}}"><i class="ri-pencil-fill me-2 align-middle"></i>Edit</a></li>
                                                                    <li><a class="dropdown-item cs-call-remove" cs-delete-route="{{route('call-actions.destroy',$call->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
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
    @include('backend.call_action.modal.edit')


@endsection

@section('js')
    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/backend/custom_js/callaction.js')}}"></script>


@endsection
