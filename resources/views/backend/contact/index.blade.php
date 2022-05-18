@extends('backend.layouts.master')
@section('title', "Contact Details")
@section('css')
<link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
<link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All Contacts</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Contact List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4 class="card-title mb-0">Show & Remove</h4>
                    </div>end card header -->

                    <div class="card-body">

                            <div class="table-responsive  mt-3 mb-1">
                                <table class="table align-middle table-nowrap" id="contact_customer">
                                    <thead class="table-light">
                                        <tr>

                                            <th >#</th>
                                            <th >Customer Name</th>
                                            <th >Email</th>
                                            <th>Phone</th>
                                            <th>Subject</th>
                                            <th >Submitted Date</th>
                                            <th >Action</th>
                                            </tr>
                                    </thead>
                                    <tbody >
                                        @foreach(@$contacts as $contact)
                                            <tr id="customer-block-num-{{@$contact->id}}">
                                                <td >{{@$loop->iteration}}</td>
                                                <td >{{ucwords(@$contact->name)}}</td>
                                                <td >{{@$contact->email}}</td>
                                                <td>{{@$contact->phone}}</td>
                                                <td >{{@$contact->subject}}</td>
                                                <td >{{date('j M, Y',strtotime(@$contact->created_at))}}</td>
                                                <td>
                                                    
                                                    <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <button class="btn  edit-item-btn"
                                                            data-bs-toggle="modal" data-bs-target="#showModal"  contact-edit-action="{{route('contact.edit',$contact->id)}}"><i
                                                                                class="ri-eye-fill align-bottom me-2 text-muted"></i></button>
                                                        </div>
                                                        <div class="remove">
                                                            <button class="btn remove-item-btn"  contact-delete-action="{{route('contact.destroy',$contact->id)}}" ><i
                                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>


                    </div><!-- end card -->
                </div>

              
                <!-- end col -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->



        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title" id="exampleModalLabel">Customer Contact Detail's</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                        <div class="modal-body">


                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Customer Name</label>
                                <input type="text" id="customername-field" class="form-control" placeholder="Enter Name" readonly />
                            </div>

                            <div class="mb-3">
                                <label for="email-field" class="form-label">Email</label>
                                <input type="email" id="email-field" class="form-control" placeholder="Enter Email" readonly />
                            </div>

                            <div class="mb-3">
                                <label for="phone-field" class="form-label">Phone</label>
                                <input type="text" id="phone-field" class="form-control"  placeholder="Enter Phone no." readonly />
                            </div>

                            <div class="mb-3">
                                <label for="subject-field" class="form-label">Subject</label>
                                <input type="text" id="subject-field" class="form-control" placeholder="Select Date" readonly />
                            </div>

                            <div>
                                <label for="message-field" class="form-label">Message</label>
                                <textarea id="message-field" class="form-control" rows="4" readonly ></textarea>

                            </div>
                        </div>
                </div>
            </div>
        </div>


        <!--end modal -->
        <form action="#" method="post" id="deleted-form" >
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
        </form>
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection

@section('js')
<script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/backend/custom_js/contact.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#contact_customer').DataTable({
            paging: true,
            searching: true,
            ordering:  true,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        });

    });
   
</script>
@endsection
