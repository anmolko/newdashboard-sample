@extends('backend.layouts.master')
@section('title', "Edit Profile | ".$user->name)
@section('css')
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        .hidden{
            display:none!important;
        }
    </style>
@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <div class="position-relative mx-n4 mt-n4">
                <div class="profile-wid-bg profile-setting-img">
                    <img
                        src="{{ ($user->cover !== null) ? asset('images/user/cover/'.$user->cover) :  asset('assets/backend/images/profile-bg.jpeg')}}"
                        class="profile-wid-img" id="profile-foreground-img-file-input-updated" alt="">
                    <div class="overlay-content">
                        <div class="text-end p-3">
                            <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                <input id="profile-foreground-img-file-input" type="file"
                                       name="cover" cs-update-route="{{route('user.imageupdate',$user->id)}}"
                                       class="profile-foreground-img-file-input">
                                <label for="profile-foreground-img-file-input"
                                       class="profile-photo-edit btn btn-light">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--user profile-->
            <div class="row">
                <div class="col-xxl-3">
                    <div class="card mt-n5">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    <img
                                        src="{{ ($user->image !== null) ? asset('images/user/'.$user->image) :  asset('assets/backend/images/default.png')}}"
                                         class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                         id="profile-img-file-input-updated"
                                         alt="user-profile-image">
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                        <input id="profile-img-file-input" type="file" name="image" cs-update-route="{{route('user.imageupdate',$user->id)}}"
                                               class="profile-img-file-input">
                                        <label for="profile-img-file-input"
                                               class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                        </label>
                                    </div>
                                </div>
                                <h5 class="fs-16 mb-1">{{ucwords($user->name)}}</h5>
                                <p class="text-muted mb-0">{{ucwords($user->user_type)}}</p>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-5">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Complete Your Profile</h5>
                                </div>
{{--                                <div class="flex-shrink-0">--}}
{{--                                    <a href="javascript:void(0);" class="badge bg-light text-primary fs-12"><i--}}
{{--                                            class="ri-edit-box-line align-bottom me-1"></i> Edit</a>--}}
{{--                                </div>--}}
                            </div>
                            <div class="progress animated-progress custom-progress progress-label">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{profile_percentage($user->id)}}%"
                                     aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    <div class="label">{{profile_percentage($user->id)}}%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--portfolio card-->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Portfolio</h5>
                                </div>
{{--                                <div class="flex-shrink-0">--}}
{{--                                    <a href="javascript:void(0);" class="badge bg-light text-primary fs-12"><i--}}
{{--                                            class="ri-add-fill align-bottom me-1"></i> Add</a>--}}
{{--                                </div>--}}
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-dark text-light">
                                                <i class="ri-github-fill"></i>
                                            </span>
                                </div>
                                <input type="email" class="form-control" id="gitUsername" placeholder="Username"
                                       value="@daveadame">
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-primary">
                                                <i class="ri-global-fill"></i>
                                            </span>
                                </div>
                                <input type="text" class="form-control" id="websiteInput"
                                       placeholder="www.example.com" value="www.velzon.com">
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-success">
                                                <i class="ri-dribbble-fill"></i>
                                            </span>
                                </div>
                                <input type="text" class="form-control" id="dribbleName" placeholder="Username"
                                       value="@dave_adame">
                            </div>
                            <div class="d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-danger">
                                                <i class="ri-pinterest-fill"></i>
                                            </span>
                                </div>
                                <input type="text" class="form-control" id="pinterestName"
                                       placeholder="Username" value="Advance Dave">
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <div class="col-xxl-9">
                            <div class="card mt-xxl-n5">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails"
                                               role="tab">
                                                <i class="fas fa-home"></i>
                                                Personal Details
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                                <i class="far fa-user"></i>
                                                Change Password
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#privacy" role="tab">
                                                <i class="far fa-envelope"></i>
                                                Privacy Policy
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        {!! Form::open(['route' => ['user.update', $user->id],'method'=>'PUT','class'=>'row g-3 needs-validation','enctype'=>'multipart/form-data','novalidate'=>'']) !!}
                                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3 position-relative">
                                                        <label for="firstnameInput" class="form-label">Full
                                                            Name</label>
                                                        <input type="text" class="form-control" id="firstnameInput" name="name"
                                                               placeholder="Enter your firstname" value="{{@$user->name}}" required>
                                                        <div class="invalid-feedback">
                                                            Please enter a name.
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="phonenumberInput" class="form-label">Phone
                                                            Number</label>
                                                        <input type="text" class="form-control" id="phonenumberInput" name="contact"
                                                               placeholder="Enter your phone number"
                                                               value="{{@$user->contact}}">
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3 position-relative">
                                                        <label for="emailInput" class="form-label">Email
                                                            Address</label>
                                                        <input type="email" class="form-control" id="emailInput" name="email"
                                                               placeholder="Enter your email"
                                                               value="{{@$user->email}}" required>
                                                        <div class="invalid-feedback">
                                                            Please enter a email.
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="JoiningdatInput" class="form-label">Joining
                                                            Date</label>
                                                        <input type="text" class="form-control"
                                                               value="{{\Carbon\Carbon::parse(Auth::user()->created_at)->isoFormat('MMMM Do, YYYY')}}" readonly/>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3 position-relative">
                                                        <label for="designationInput"
                                                               class="form-label">User Role</label>
                                                        @if(@$user->user_type == "admin")
                                                            <select class="form-select mb-3" aria-label="Default select" name="user_type" required>
                                                                <option disabled readonly> Select Role </option>
                                                                <option value="admin" {{(@$user->user_type == "admin") ? "selected":""}}>Admin</option>
                                                                <option value="general" {{(@$user->user_type == "general") ? "selected":""}}>General</option>
                                                            </select>
                                                        @else
                                                            <input type="text" class="form-control" name="user_type"
                                                                   id="designationInput" placeholder="user role"
                                                                   value="{{@$user->user_type}}" required>
                                                        @endif
                                                        <div class="invalid-feedback">
                                                            Please select the user type.
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3 position-relative">
                                                        <label for="websiteInput1"
                                                               class="form-label">Gender</label>
                                                        <select class="form-select mb-3" aria-label="Default select" name="gender" required>
                                                            <option disabled readonly> Select Gender </option>
                                                            <option value="male" {{(@$user->gender == "male") ? "selected":""}}>Male</option>
                                                            <option value="female" {{(@$user->gender == "female") ? "selected":""}}>Female</option>
                                                            <option value="others" {{(@$user->gender == "others") ? "selected":""}}>Others</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select the gender.
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="cityInput" class="form-label">Location</label>
                                                        <input type="text" class="form-control" id="cityInput" name="address"
                                                               placeholder="User Location / Address" value="{{@$user->address}}" />
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="mb-3 pb-2">
                                                        <label for="exampleFormControlTextarea"
                                                               class="form-label">Description</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea" name="about"
                                                                  placeholder="Write something about yourself.."
                                                                  rows="4">{{@$user->about}}</textarea>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="submit" class="btn btn-soft-success">Update</button>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                        {!! Form::close() !!}
                                        </div>


                                <!--end personal details tab-pane-->
                                <div class="tab-pane" id="changePassword" role="tabpanel">
                                    <div class="row g-2">
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="oldpasswordInput" class="form-label">Old
                                                    Password*</label>
                                                <input type="password" class="form-control"
                                                       id="oldpasswordInput" name="password"
                                                       placeholder="Enter current password">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="newpasswordInput" class="form-label">New
                                                    Password*</label>
                                                <input type="password" class="form-control"
                                                       id="newpasswordInput" placeholder="Enter new password">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="confirmpasswordInput" class="form-label">Confirm
                                                    Password*</label>
                                                <input type="password" class="form-control"
                                                       id="confirmpasswordInput"
                                                       placeholder="Confirm password">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <a href="javascript:void(0);"
                                                   class="link-primary text-decoration-underline">Forgot
                                                    Password ?</a>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success">Change
                                                    Password</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->

                                    <div class="mt-4 mb-3 border-bottom pb-2">
                                        <div class="float-end">
                                            <a href="javascript:void(0);" class="link-primary">All Logout</a>
                                        </div>
                                        <h5 class="card-title">Login History</h5>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0 avatar-sm">
                                            <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                <i class="ri-smartphone-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6>iPhone 12 Pro</h6>
                                            <p class="text-muted mb-0">Los Angeles, United States - March 16 at
                                                2:47PM</p>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);">Logout</a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0 avatar-sm">
                                            <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                <i class="ri-tablet-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6>Apple iPad Pro</h6>
                                            <p class="text-muted mb-0">Washington, United States - November 06
                                                at 10:43AM</p>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);">Logout</a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0 avatar-sm">
                                            <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                <i class="ri-smartphone-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6>Galaxy S21 Ultra 5G</h6>
                                            <p class="text-muted mb-0">Conneticut, United States - June 12 at
                                                3:24PM</p>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);">Logout</a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar-sm">
                                            <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                <i class="ri-macbook-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6>Dell Inspiron 14</h6>
                                            <p class="text-muted mb-0">Phoenix, United States - July 26 at
                                                8:10AM</p>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);">Logout</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->

                                <div class="tab-pane" id="privacy" role="tabpanel">
                                    <div class="mb-4 pb-2">
                                        <h5 class="card-title text-decoration-underline mb-3">Security:</h5>
                                        <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-14 mb-1">Two-factor Authentication</h6>
                                                <p class="text-muted">Two-factor authentication is an enhanced
                                                    security meansur. Once enabled, you'll be required to give
                                                    two types of identification when you log into Google
                                                    Authentication and SMS are Supported.</p>
                                            </div>
                                            <div class="flex-shrink-0 ms-sm-3">
                                                <a href="javascript:void(0);"
                                                   class="btn btn-sm btn-primary">Enable Two-facor
                                                    Authentication</a>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-14 mb-1">Secondary Verification</h6>
                                                <p class="text-muted">The first factor is a password and the
                                                    second commonly includes a text with a code sent to your
                                                    smartphone, or biometrics using your fingerprint, face, or
                                                    retina.</p>
                                            </div>
                                            <div class="flex-shrink-0 ms-sm-3">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary">Set
                                                    up secondary method</a>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-14 mb-1">Backup Codes</h6>
                                                <p class="text-muted mb-sm-0">A backup code is automatically
                                                    generated for you when you turn on two-factor authentication
                                                    through your iOS or Android Twitter app. You can also
                                                    generate a backup code on twitter.com.</p>
                                            </div>
                                            <div class="flex-shrink-0 ms-sm-3">
                                                <a href="javascript:void(0);"
                                                   class="btn btn-sm btn-primary">Generate backup codes</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="card-title text-decoration-underline mb-3">Application
                                            Notifications:</h5>
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex">
                                                <div class="flex-grow-1">
                                                    <label for="directMessage"
                                                           class="form-check-label fs-14">Direct messages</label>
                                                    <p class="text-muted">Messages from people you follow</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                               role="switch" id="directMessage" checked />
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14"
                                                           for="desktopNotification">
                                                        Show desktop notifications
                                                    </label>
                                                    <p class="text-muted">Choose the option you want as your
                                                        default setting. Block a site: Next to "Not allowed to
                                                        send notifications," click Add.</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                               role="switch" id="desktopNotification" checked />
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14"
                                                           for="emailNotification">
                                                        Show email notifications
                                                    </label>
                                                    <p class="text-muted"> Under Settings, choose Notifications.
                                                        Under Select an account, choose the account to enable
                                                        notifications for. </p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                               role="switch" id="emailNotification" />
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14"
                                                           for="chatNotification">
                                                        Show chat notifications
                                                    </label>
                                                    <p class="text-muted">To prevent duplicate mobile
                                                        notifications from the Gmail and Chat apps, in settings,
                                                        turn off Chat notifications.</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                               role="switch" id="chatNotification" />
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14"
                                                           for="purchaesNotification">
                                                        Show purchase notifications
                                                    </label>
                                                    <p class="text-muted">Get real-time purchase alerts to
                                                        protect yourself from fraudulent charges.</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                               role="switch" id="purchaesNotification" />
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h5 class="card-title text-decoration-underline mb-3">Delete This
                                            Account:</h5>
                                        <p class="text-muted">Go to the Data & Privacy section of your profile
                                            Account. Scroll to "Your data & privacy options." Delete your
                                            Profile Account. Follow the instructions to delete your account :
                                        </p>
                                        <div>
                                            <input type="password" class="form-control" id="passwordInput"
                                                   placeholder="Enter your password" value="make@321654987"
                                                   style="max-width: 265px;">
                                        </div>
                                        <div class="hstack gap-2 mt-3">
                                            <a href="javascript:void(0);" class="btn btn-soft-danger">Close &
                                                Delete This Account</a>
                                            <a href="javascript:void(0);" class="btn btn-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->

        </div>
    </div>

@endsection

@section('js')
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- profile-setting init js -->
    <script src="{{asset('assets/backend/js/pages/profile-setting.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Sweet alert init js-->
    <script type="text/javascript">

        $('#profile-foreground-img-file-input, #profile-img-file-input').on('change', function() {
            var cover  = this.files[0];
            var userID = "{{$user->id}}";
            var name   = $(this).attr("name");
            var url    = $(this).attr("cs-update-route");
            var imagereplaceID = '#header-profile-user-updates';
            var formData = new FormData();
            formData.append('name', name);
            formData.append('image', cover);
            $.ajax({
                type : 'POST',
                url : url,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                cache: false,
                contentType: false,
                processData: false,
                data : formData,
                success: function(response){
                    console.log(response);

                    if(response.status=='success'){
                        if(name == 'image'){
                            var imagename = 'profile image';
                            $(imagereplaceID).attr("src",'/images/user/'+response.image );
                        }else{
                            var imagename = 'cover photo';
                        }
                        Swal.fire({
                            imageUrl: "/assets/backend/images/canosoft-logo.png",
                            imageHeight: 40,
                            html: '<div class="mt-2">' +
                                '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                                'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                                '</lord-icon>' +
                                '<div class="mt-4 pt-2 fs-15">' +
                                '<h4>Success !</h4>' +
                                '<p class="text-muted mx-4 mb-0">' +
                                'Your '+ imagename +' has been changed .</p>'
                                + '</div>' +
                                '</div>',
                            animation: !1,
                            timerProgressBar: !0,
                            timer: 2e3,
                            showConfirmButton: !1
                        });
                    }else{
                        Swal.fire({
                            imageUrl: "/assets/backend/images/canosoft-logo.png",
                            imageHeight: 40,
                            html: '<div class="mt-2">' +
                                '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                                ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                                'style="width:120px;height:120px"></lord-icon>' +
                                '<div class="mt-4 pt-2 fs-15">' +
                                '<h4>Oops...!</h4>' +
                                '<p class="text-muted mx-4 mb-0">' +
                                'Your'+ imagename +' could not be changed at the moment .</p>'
                                + '</div>' +
                                '</div>',
                            animation: !1,
                            timerProgressBar: !0,
                            timer: 3000,
                            showConfirmButton: !1
                        });
                    }
                },
                error: function(response) {
                   console.log(response);
                }
            })


        });



    </script>
@endsection
