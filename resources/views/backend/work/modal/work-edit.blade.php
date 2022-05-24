<div class="modal fade" id="edit_work" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 ps-4 bg-soft-success">
                <h5 class="modal-title" id="myModalLabel">Edit Blog Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatework','enctype'=>'multipart/form-data','novalidate'=>'']) !!}
                <div class="row">


                    <div class="mb-3">
                        <label class="form-label" for="work-title-input">Title</label>
                        <input type="text" name="title" class="form-control" id="work-title-update" placeholder="Enter work title" required>
                        <div class="invalid-feedback">
                            Please enter the work title.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="category-id-update" class="form-label">Status</label>
                        <select class="form-select" id="category-id-update" name="work_category_id">
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
                                <img  id="current-work-edit"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                <input  type="file" accept="image/png, image/jpeg" hidden
                                        id="work-foreground-img-edit-input" onchange="loadbasicFile('work-foreground-img-edit-input','current-work-edit',event)" name="image"
                                        class="work-foreground-img-edit-input" >

                                <figcaption class="figure-caption">Select your related work image.</figcaption>
                                <div class="invalid-feedback" >
                                    Please select a image.
                                </div>
                                <label for="work-foreground-img-edit-input" class="profile-photo-edit btn btn-light feature-image-button">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Update Work Image
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="blog-category-update-button">Update</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
