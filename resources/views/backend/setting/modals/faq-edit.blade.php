<div class="modal fade" id="edit_faq" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 ps-4 bg-soft-success">
                <h5 class="modal-title" id="myModalLabel">Edit Project Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatefaq','enctype'=>'multipart/form-data','novalidate'=>'']) !!}
                <div class="row">

                    <div class="mb-3">
                        <label class="form-label" for="update-name">Name</label>
                        <input type="text" name="name" class="form-control" id="update-name" placeholder="Enter FAQ name" required>
                        <div class="invalid-feedback">
                            Please enter the name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="update-description">Description </label>
                        <textarea class="form-control" id="update-description" placeholder="Enter FAQ Description" name="description" rows="6" required></textarea>
                        <div class="invalid-feedback">
                            Please enter the description.
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="blog-category-update-button" >Update FAQ</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
