<div class="modal fade" id="edit_project_plan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 ps-4 bg-soft-success">
                <h5 class="modal-title" id="myModalLabel">Edit Project Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updateplan','enctype'=>'multipart/form-data','novalidate'=>'']) !!}
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label" for="update-name">Name</label>
                        <input type="text" name="name" class="form-control" id="update-name" placeholder="Enter plan name" required>
                        <div class="invalid-feedback">
                            Please enter the name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="update-price">Price</label>
                        <input type="text" name="price" class="form-control" id="update-price"
                               placeholder="Enter plan price" required>
                        <div class="invalid-feedback">
                            Please enter the plan price.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="update-type">Type</label>
                        <select class="form-select" name="type" id="update-type" required>
                            <option value disabled>Select plan type</option>
                            <optgroup label="Category one">
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </optgroup>
                            <optgroup label="Category one">
                                <option value="personal">Personal</option>
                                <option value="commercial">Commercial</option>
                            </optgroup>
                        </select>
                        <div class="invalid-feedback">
                            Please enter the plan price.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="update-link">Button Link</label>
                        <input type="text" name="link" class="form-control" id="update-link"
                               placeholder="Enter the link">
                        <div class="invalid-feedback">
                            Please enter the link.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="summary-input">Description </label>
                        <textarea class="form-control" id="ckeditor-classic-update" placeholder="Enter Description (use lists)" name="description" rows="5" required></textarea>
                        <div class="invalid-feedback">
                            Please enter the description.
                        </div>
                        <span class="figure-caption">* Only use list options here</span>
                    </div>

                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="blog-category-update-button" >Update Plan</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
