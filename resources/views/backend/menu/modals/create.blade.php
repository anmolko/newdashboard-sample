
<div class="modal fade" id="createMenu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 ps-4 bg-soft-success">
                <h5 class="modal-title" id="myModalLabel">Create New Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                {!! Form::open(['route' => 'menu.store','method'=>'post','id'=>'menu-form','class'=>'needs-validation','novalidate'=>'']) !!}

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" class="text-heading">Menu Name</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" required>
                            <div class="invalid-feedback">
                                Please enter the menu name.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title" class="text-heading">Menu Title (for frontend display)</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="title" required>
                            <div class="invalid-feedback">
                                Please enter the menu title.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="slug" class="text-heading">Menu Slug</label>
                            <input type="text" class="form-control form-control-lg" id="slug" name="slug" readonly required>
                            <div class="invalid-feedback">
                                Please enter the menu slug.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-theme button-1 ctm-border-radius text-white text-center">Add</button>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>




