
<div class="modal fade" id="edit_testimonial" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 ps-4 bg-soft-success">
                <h5 class="modal-title" id="myModalLabel">Edit Call Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatetestimonial','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label" for="update-name">Provider Name</label>
                        <input type="text" name="name" class="form-control" id="update-name"  maxlength="15"
                               placeholder="Enter name of testimonial provider" />
                        <div class="invalid-feedback">
                            Please enter the name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="update-position">Position /  Company name</label>
                        <input type="text" name="position" class="form-control" id="update-position"  maxlength="18"
                               placeholder="Enter position/company name of provider" required>
                        <div class="invalid-feedback">
                            Please enter the position/company name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="title-position">Rating</label>

                        <div class='rating_selection'>
                            <input checked id='update_rating_0' name='edit_rating' type='radio' value='0'><label for='update_rating_0'>
                                <span>Unrated</span>
                            </label><input id='update_rating_1' name='edit_rating' type='radio' value='1'><label for='update_rating_1'>
                                <span>Rate 1 Star</span>
                            </label><input id='update_rating_2' name='edit_rating' type='radio' value='2'><label for='update_rating_2'>
                                <span>Rate 2 Stars</span>
                            </label><input id='update_rating_3' name='edit_rating' type='radio' value='3'><label for='update_rating_3'>
                                <span>Rate 3 Stars</span>
                            </label><input id='update_rating_4' name='edit_rating' type='radio' value='4'><label for='update_rating_4'>
                                <span>Rate 4 Stars</span>
                            </label><input id='update_rating_5' name='edit_rating' type='radio' value='5'><label for='update_rating_5'>
                                <span>Rate 5 Stars</span>
                            </label></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="update-description">Description</label>
                        <textarea class="form-control" maxlength="200" id="update-description" name="description" placeholder="Enter Testimonial description" rows="4" required></textarea>
                        <div class="invalid-feedback">
                            Please enter the description.
                        </div>
                    </div>
                    <label class="form-label">Image</label>
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <img id="current-update-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                <input  type="file" accept="image/png, image/jpeg" hidden
                                        id="work-foreground-img-file-update" onchange="loadbasicFile('work-foreground-img-file-update','current-update-img',event)" name="image"
                                        class="work-foreground-img-file-update" >

                                <figcaption class="figure-caption">Select your related testimonial image.</figcaption>
                                <div class="invalid-feedback" >
                                    Please select a image.
                                </div>
                                <label for="work-foreground-img-file-update" class="profile-photo-edit btn btn-light feature-image-button">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Add testimonial Image
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="call-action-update-button" >Update Testimonial</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
