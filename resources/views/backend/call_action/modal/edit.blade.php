
<div class="modal fade" id="edit_call_action" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 ps-4 bg-soft-success">
                <h5 class="modal-title" id="myModalLabel">Edit Call Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatecallaction','novalidate'=>'']) !!}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="callactionid" id="call_action_id" />

                            <label for="update-name" class="form-label"> Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="update-name"  placeholder="Enter name of call action" />
                            <div class="invalid-feedback">
                                Please enter the category title.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="update-title">Title</label>
                        <input type="text" name="title" class="form-control" id="update-title"
                               placeholder="Enter title" required>
                        <div class="invalid-feedback">
                            Please enter the title.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="update-button">Button Name</label>
                        <input type="text" name="button" class="form-control" id="update-button"
                               placeholder="Enter button name">
                        <div class="invalid-feedback">
                            Please enter the button.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="update-link">Button link</label>
                        <input type="text" name="link" class="form-control" id="update-link"
                               placeholder="Enter button link">
                        <div class="invalid-feedback">
                            Please enter the button link.
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="call-action-update-button" >Update Call Action</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
