<div class="modal fade" id="create_career" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 ps-4 bg-soft-success">
                <h5 class="modal-title" id="myModalLabel">Add Career Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'career.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="careerid" id="career_id" />

                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name"
                                   onclick="slugMaker('name','slug')" required>
                            <div class="invalid-feedback">
                                Please enter the career name.
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="slug" id="slug" required>
                            <div class="invalid-feedback">
                                Please enter the career slug.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label>Number of open position <span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" name="position" required>
                            <div class="invalid-feedback">
                                Please enter the open position.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Career Type <span class="text-danger">*</span></label>
                            <select class="form-control shadow-none" name="type" required>
                                <option value disabled selected> Select Career Type</option>
                                <option value="full_time"> Full Time </option>
                                <option value="part_time"> Part Time </option>
                            </select>
                            <div class="invalid-feedback">
                                Please enter the position.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label>Submission Closing Date <span class="text-danger">*</span></label>
                            <input type="text" name="end_date" class="form-control" data-provider="flatpickr"
                                   data-date-format="d M, Y">
                            <div class="invalid-feedback">
                                Please Select the career application closing date.
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Salary</label>
                        <input type="text" class="form-control" name="salary">
                        <div class="invalid-feedback">
                            Please enter the salary.
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="career-publish-status-input" class="form-label">Status</label>
                        <select class="form-select" id="career-publish-status-input" name="status">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div class="invalid-feedback">
                            Please enter the salary.
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="ckeditor-classic" name="description" placeholder="Enter career description" rows="4" required></textarea>
                            <div class="invalid-tooltips">
                                Please enter the description.
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider mb-3"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="meta-title-input">Meta title</label>
                                <input type="text" class="form-control" placeholder="Enter meta title" name="meta_title" id="meta-title-input">
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="meta-keywords-input">Meta Keywords</label>
                                <input type="text" class="form-control" placeholder="Enter meta keywords" name="meta_tags" id="meta-keywords-input">
                                <span class="figure-caption">use comma (,) to separate the keywords.</span>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="mb-3">
                        <label class="form-label" for="meta-description-input">Meta Description</label>
                        <textarea class="form-control" id="meta-description-input" placeholder="Enter meta description" name="meta_description" rows="5"></textarea>
                    </div>

                    <div class="col-lg-6" style="margin: auto; width: 50%">
                        <label class="form-label" for="meta-description-input">Featured Image</label>

                        <img  id="current-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                        <input  type="file" accept="image/png, image/jpeg" hidden
                                id="profile-foreground-img-file-input" onchange="loadbasicFile('profile-foreground-img-file-input','current-img',event)" name="feature_image" required
                                class="profile-foreground-img-file-input" >

                        <figcaption class="figure-caption">Featured image for current career.</figcaption>
                        <div class="invalid-feedback" >
                            Please select a image.
                        </div>
                        <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light feature-image-button">
                            <i class="ri-image-edit-line align-bottom me-1"></i> Add Feature Image
                        </label>
                    </div>


                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="blog-category-update-button">Create</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
