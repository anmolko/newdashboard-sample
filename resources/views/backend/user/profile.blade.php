@extends('backend.layouts.master')
@section('title', "Profile | ".$user->name)
@section('css')
    <style>
        .hidden{
            display:none!important;
        }
    </style>
@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <div class="profile-foreground position-relative mx-n4 mt-n4">
                <div class="profile-wid-bg">
                    <img
                        src="{{ ($user->cover !== null) ? asset('images/user/cover/'.$user->cover) :  asset('assets/backend/images/profile-bg.jpeg')}}"
                        alt="" class="profile-wid-img" />
                </div>
            </div>
            <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
                <div class="row g-4">
                    <div class="col-auto">

                            <div class="profile-user position-relative d-inline-block mx-auto">
                                <img
                                    src="{{ ($user->image !== null) ? asset('images/user/'.$user->image) :  asset('assets/backend/images/default.png')}}"
                                    class="rounded-circle avatar-x img-thumbnail user-profile-image"
                                    alt="user-profile-image">
                            </div>
{{--                            <img src="{{ ($user->image !== null) ? asset('images/user/'.$user->image) :  asset('assets/backend/images/default.png')}}" alt="user-img"--}}
{{--                                 class="img-thumbnail rounded-circle" />--}}
                    </div>
                    <!--end col-->
                    <div class="col">
                        <div class="p-2">
                            <h3 class="text-white mb-1">{{ucwords($user->name)}}</h3>
                            <p class="text-white-75">{{ucfirst($user->user_type)}}</p>
                            <div class="hstack text-white-50 gap-1">
                                <div class="me-2"><i
                                        class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>
                                    {{ ($user->address !== null) ? ucwords($user->address) : "Address not set yet"}}</div>
                                <div><i class="ri-building-line me-1 text-white-75 fs-16 align-middle"></i>
                                    {{ ($setting_data !== null && $setting_data->website_name !== null) ? $setting_data->website_name:"Canosoft Technology" }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <div class="d-flex">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab"
                                       role="tab">
                                        <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                            class="d-none d-md-inline-block">Overview</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-14" data-bs-toggle="tab" href="#activities"
                                       role="tab">
                                        <i class="ri-list-unordered d-inline-block d-md-none"></i> <span
                                            class="d-none d-md-inline-block">Activities</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="flex-shrink-0">
                                <a href="{{route('profile.edit',$user->slug)}}" class="btn btn-success"><i
                                        class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                            </div>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content pt-4 text-muted">
                            <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-xxl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-5">Complete Your Profile</h5>
                                                <div
                                                    class="progress animated-progress custom-progress progress-label">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                         style="width: {{profile_percentage($user->id)}}%" aria-valuenow="30" aria-valuemin="0"
                                                         aria-valuemax="100">
                                                        <div class="label">{{profile_percentage($user->id)}}%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">Information</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-0">
                                                        <tbody>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Full Name :</th>
                                                            <td class="text-muted">{{ucwords($user->name)}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Mobile :</th>
                                                            <td class="text-muted">{{($user->contact !== null) ? ucwords($user->contact):"Not set yet."}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">E-mail :</th>
                                                            <td class="text-muted">{{$user->email}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Location :</th>
                                                            <td class="text-muted">{{ ($user->address !== null) ? ucwords($user->address) : "Not set yet."}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Joining Date  :</th>
                                                            <td class="text-muted">{{\Carbon\Carbon::parse($user->created_at)->isoFormat('MMMM Do, YYYY')}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4">Portfolio</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @if(@$user->fb !== null)
                                                        <div>
                                                            <a href="{{@$user->fb}}" target="_blank" class="avatar-xs d-block">
                                                                         <span class="avatar-title rounded-circle fs-16 bg-gradient text-light">
                                                                            <i class="ri-facebook-fill"></i>
                                                                        </span>
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @if(@$user->twitter !== null)
                                                        <div>
                                                            <a href="{{@$user->twitter}}" target="_blank" class="avatar-xs d-block">
                                                                   <span class="avatar-title rounded-circle fs-16 bg-twitter">
                                                                        <i class="ri-twitter-fill"></i>
                                                                    </span>
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @if(@$user->insta !== null)
                                                        <div>
                                                            <a href="{{@$user->insta}}" target="_blank" class="avatar-xs d-block">
                                                                        <span class="avatar-title rounded-circle fs-16 bg-instagram">
                                                                            <i class="ri-instagram-fill"></i>
                                                                        </span>
                                                            </a>
                                                        </div>
                                                    @endif

                                                    @if(@$user->linkedin !== null)
                                                        <div>
                                                            <a href="{{@$user->linkedin}}" target="_blank" class="avatar-xs d-block">
                                                                        <span class="avatar-title rounded-circle fs-16 bg-linkedin">
                                                                            <i class="ri-linkedin-fill"></i>
                                                                        </span>
                                                            </a>
                                                        </div>
                                                   @endif

                                                </div>
                                            </div><!-- end card body -->
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-4">
                                                    <div class="flex-grow-1">
                                                        <h5 class="card-title mb-0">Current Users</h5>
                                                    </div>
                                                    @if(Auth::user()->user_type == 'admin')
                                                        <div class="flex-shrink-0">
                                                            <div class="dropdown">
                                                                <a href="#" role="button" id="dropdownMenuLink2"
                                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-2-fill fs-14"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end"
                                                                    aria-labelledby="dropdownMenuLink2">
                                                                    <li><a class="dropdown-item" href="#">Create New</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    @foreach($alluser as $u)
                                                    <div class="d-flex align-items-center py-3">
                                                        <div class="avatar-xs flex-shrink-0 me-3">
                                                            <img src="{{ ($u->image !== null) ? asset('images/user/'.$u->image) :  asset('assets/backend/images/default.png')}}" alt=""
                                                                 class="img-fluid rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div>
                                                                <h5 class="fs-14 mb-1">{{ucwords(@$u->name)}}</h5>
                                                                <p class="fs-13 text-muted mb-0">{{ucwords(@$user->user_type)}}</p>
                                                            </div>
                                                        </div>
{{--                                                        <div class="flex-shrink-0 ms-2">--}}
{{--                                                            <button type="button"--}}
{{--                                                                    class="btn btn-sm btn-outline-success"><i--}}
{{--                                                                    class="ri-user-add-line align-middle"></i></button>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div><!-- end card body -->
                                        </div>
                                        <!--end card-->

                                        @if(count($blogs)>0)
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-4">
                                                    <div class="flex-grow-1">
                                                        <h5 class="card-title mb-0">Latest Posts</h5>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="dropdown">
                                                            <a href="#" role="button" id="dropdownMenuLink1"
                                                               data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ri-more-2-fill fs-14"></i>
                                                            </a>

                                                            <ul class="dropdown-menu dropdown-menu-end"
                                                                aria-labelledby="dropdownMenuLink1">
                                                                <li><a class="dropdown-item" href="{{route('blog.index')}}">Create</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach($blogs as $blog)
                                                <div class="d-flex mb-4">
                                                    <div class="flex-shrink-0">
                                                        <img src="{{asset('/images/blog/'.@$blog->image)}}" alt=""
                                                             height="50" class="rounded" />
                                                    </div>
                                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                                        <a href="{{route('blog.edit',$blog->id)}}">
                                                            <h6 class="text-truncate fs-14"> {{ ucwords(@$blog->title) }}</h6>
                                                        </a>
                                                        <p class="text-muted mb-0">{{\Carbon\Carbon::parse(@$blog->created_at)->isoFormat('MMMM Do, YYYY')}}</p>
                                                    </div>
                                                </div>
                                                @endforeach

                                            </div>
                                            <!--end card-body-->
                                        </div>
                                        <!--end card-->
                                        @endif
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-9">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">About</h5>
                                                @if($user->about == null)
                                                <p>Hi I'm {{ucfirst($user->name)}}, I am currently a user in this system developed by
                                                    <a href="https://canopustechnology.com.np/" target="_blank">Canosoft Technology</a> for the parent company <a href="/" target="_blank">{{@$setting_data->website_name}}.</a>
                                                    The company itself is described as : {!! @$setting_data->website_description !!}
                                                </p>
                                                <p>I joined the ranks of the user in {{\Carbon\Carbon::parse($user->created_at)->isoFormat('MMMM Do, YYYY')}},
                                                    where my assigned role is that of an {{$user->user_type}}. The parent company is located at {{@$setting_data->address}}
                                                    with the registered email {{@$setting_data->email}}.
                                                </p>
                                                @else
                                                    {!! nl2br($user->about) !!}
                                                @endif
                                                <div class="row">
                                                    <div class="col-6 col-md-4">
                                                        <div class="d-flex mt-4">
                                                            <div
                                                                class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div
                                                                    class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                                    <i class="ri-user-2-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Designation :</p>
                                                                <h6 class="text-truncate mb-0">Lead Designer /
                                                                    Developer</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-md-4">
                                                        <div class="d-flex mt-4">
                                                            <div
                                                                class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                                <div
                                                                    class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                                    <i class="ri-global-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p class="mb-1">Website :</p>
                                                                <a href="#"
                                                                   class="fw-semibold">www.velzon.com</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </div>
                                            <!--end card-body-->
                                        </div><!-- end card -->

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header align-items-center d-flex">
                                                        <h4 class="card-title mb-0  me-2">Recent Activity</h4>
                                                        <div class="flex-shrink-0 ms-auto">
                                                            <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0"
                                                                role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active"
                                                                       data-bs-toggle="tab" href="#today"
                                                                       role="tab">
                                                                        Today
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab"
                                                                       href="#weekly" role="tab">
                                                                        Weekly
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab"
                                                                       href="#monthly" role="tab">
                                                                        Monthly
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="tab-content text-muted">
                                                            <div class="tab-pane active" id="today"
                                                                 role="tabpanel">
                                                                <div class="profile-timeline">
                                                                    <div class="accordion accordion-flush"
                                                                         id="todayExample">
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="headingOne">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapseOne"
                                                                                   aria-expanded="true">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            class="flex-shrink-0">
                                                                                            <img src="{{asset('assets/backend/images/users/avatar-2.jpg')}}"
                                                                                                 alt=""
                                                                                                 class="avatar-xs rounded-circle" />
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                Jacqueline Steve
                                                                                            </h6>
                                                                                            <small
                                                                                                class="text-muted">We
                                                                                                has changed 2
                                                                                                attributes on
                                                                                                05:16PM</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div id="collapseOne"
                                                                                 class="accordion-collapse collapse show"
                                                                                 aria-labelledby="headingOne"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div
                                                                                    class="accordion-body ms-2 ps-5">
                                                                                    In an awareness campaign, it
                                                                                    is vital for people to begin
                                                                                    put 2 and 2 together and
                                                                                    begin to recognize your
                                                                                    cause. Too much or too
                                                                                    little spacing, as in the
                                                                                    example below, can make
                                                                                    things unpleasant for the
                                                                                    reader. The goal is to make
                                                                                    your text as comfortable to
                                                                                    read as possible. A
                                                                                    wonderful serenity has taken
                                                                                    possession of my entire
                                                                                    soul, like these sweet
                                                                                    mornings of spring which I
                                                                                    enjoy with my whole heart.
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="headingTwo">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapseTwo"
                                                                                   aria-expanded="false">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            class="flex-shrink-0 avatar-xs">
                                                                                            <div
                                                                                                class="avatar-title bg-light text-success rounded-circle">
                                                                                                M
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                Megan Elmore
                                                                                            </h6>
                                                                                            <small
                                                                                                class="text-muted">Adding
                                                                                                a new event with
                                                                                                attachments -
                                                                                                04:45PM</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div id="collapseTwo"
                                                                                 class="accordion-collapse collapse show"
                                                                                 aria-labelledby="headingTwo"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div
                                                                                    class="accordion-body ms-2 ps-5">
                                                                                    <div class="row g-2">
                                                                                        <div class="col-auto">
                                                                                            <div
                                                                                                class="d-flex border border-dashed p-2 rounded position-relative">
                                                                                                <div
                                                                                                    class="flex-shrink-0">
                                                                                                    <i
                                                                                                        class="ri-image-2-line fs-17 text-danger"></i>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="flex-grow-1 ms-2">
                                                                                                    <h6><a href="javascript:void(0);"
                                                                                                           class="stretched-link">Business
                                                                                                            Template
                                                                                                            -
                                                                                                            UI/UX
                                                                                                            design</a>
                                                                                                    </h6>
                                                                                                    <small>685
                                                                                                        KB</small>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-auto">
                                                                                            <div
                                                                                                class="d-flex border border-dashed p-2 rounded position-relative">
                                                                                                <div
                                                                                                    class="flex-shrink-0">
                                                                                                    <i
                                                                                                        class="ri-file-zip-line fs-17 text-info"></i>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="flex-grow-1 ms-2">
                                                                                                    <h6><a href="javascript:void(0);"
                                                                                                           class="stretched-link">Bank
                                                                                                            Management
                                                                                                            System
                                                                                                            -
                                                                                                            PSD</a>
                                                                                                    </h6>
                                                                                                    <small>8.78
                                                                                                        MB</small>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="headingThree">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapsethree"
                                                                                   aria-expanded="false">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            class="flex-shrink-0">
                                                                                            <img src="{{asset('assets/backend/images/users/avatar-5.jpg')}}"
                                                                                                 alt=""
                                                                                                 class="avatar-xs rounded-circle" />
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                New ticket
                                                                                                received</h6>
                                                                                            <small
                                                                                                class="text-muted mb-2">User
                                                                                                <span
                                                                                                    class="text-secondary">Erica245</span>
                                                                                                submitted a
                                                                                                ticket -
                                                                                                02:33PM</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="headingFour">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapseFour"
                                                                                   aria-expanded="true">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            class="flex-shrink-0 avatar-xs">
                                                                                            <div
                                                                                                class="avatar-title bg-light text-muted rounded-circle">
                                                                                                <i
                                                                                                    class="ri-user-3-fill"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                Nancy Martino
                                                                                            </h6>
                                                                                            <small
                                                                                                class="text-muted">Commented
                                                                                                on
                                                                                                12:57PM</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div id="collapseFour"
                                                                                 class="accordion-collapse collapse show"
                                                                                 aria-labelledby="headingFour"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div
                                                                                    class="accordion-body ms-2 ps-5 fst-italic">
                                                                                    " A wonderful serenity has
                                                                                    taken possession of my
                                                                                    entire soul, like these
                                                                                    sweet mornings of spring
                                                                                    which I enjoy with my whole
                                                                                    heart. Each design is a new,
                                                                                    unique piece of art birthed
                                                                                    into this world, and while
                                                                                    you have the opportunity to
                                                                                    be creative and make your
                                                                                    own style choices. "
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="headingFive">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapseFive"
                                                                                   aria-expanded="true">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            class="flex-shrink-0">
                                                                                            <img src="{{asset('assets/backend/images/users/avatar-7.jpg')}}"
                                                                                                 alt=""
                                                                                                 class="avatar-xs rounded-circle" />
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                Lewis Arnold
                                                                                            </h6>
                                                                                            <small
                                                                                                class="text-muted">Create
                                                                                                new project
                                                                                                buildng product
                                                                                                -
                                                                                                10:05AM</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div id="collapseFive"
                                                                                 class="accordion-collapse collapse show"
                                                                                 aria-labelledby="headingFive"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div
                                                                                    class="accordion-body ms-2 ps-5">
                                                                                    <p class="text-muted mb-2">
                                                                                        Every team project can
                                                                                        have a velzon. Use the
                                                                                        velzon to share
                                                                                        information with your
                                                                                        team to understand and
                                                                                        contribute to your
                                                                                        project.</p>
                                                                                    <div class="avatar-group">
                                                                                        <a href="javascript: void(0);"
                                                                                           class="avatar-group-item"
                                                                                           data-bs-toggle="tooltip"
                                                                                           data-bs-trigger="hover"
                                                                                           data-bs-placement="top"
                                                                                           title=""
                                                                                           data-bs-original-title="Christi">
                                                                                            <img src="{{asset('assets/backend/images/users/avatar-4.jpg')}}"
                                                                                                 alt=""
                                                                                                 class="rounded-circle avatar-xs">
                                                                                        </a>
                                                                                        <a href="javascript: void(0);"
                                                                                           class="avatar-group-item"
                                                                                           data-bs-toggle="tooltip"
                                                                                           data-bs-trigger="hover"
                                                                                           data-bs-placement="top"
                                                                                           title=""
                                                                                           data-bs-original-title="Frank Hook">
                                                                                            <img src="{{asset('assets/backend/images/users/avatar-3.jpg')}}"
                                                                                                 alt=""
                                                                                                 class="rounded-circle avatar-xs">
                                                                                        </a>
                                                                                        <a href="javascript: void(0);"
                                                                                           class="avatar-group-item"
                                                                                           data-bs-toggle="tooltip"
                                                                                           data-bs-trigger="hover"
                                                                                           data-bs-placement="top"
                                                                                           title=""
                                                                                           data-bs-original-title=" Ruby">
                                                                                            <div
                                                                                                class="avatar-xs">
                                                                                                <div
                                                                                                    class="avatar-title rounded-circle bg-light text-primary">
                                                                                                    R
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                        <a href="javascript: void(0);"
                                                                                           class="avatar-group-item"
                                                                                           data-bs-toggle="tooltip"
                                                                                           data-bs-trigger="hover"
                                                                                           data-bs-placement="top"
                                                                                           title=""
                                                                                           data-bs-original-title="more">
                                                                                            <div
                                                                                                class="avatar-xs">
                                                                                                <div
                                                                                                    class="avatar-title rounded-circle">
                                                                                                    2+
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end accordion-->
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="weekly" role="tabpanel">
                                                                <div class="profile-timeline">
                                                                    <div class="accordion accordion-flush"
                                                                         id="weeklyExample">
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="heading6">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapse6"
                                                                                   aria-expanded="true">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            class="flex-shrink-0">
                                                                                            <img src="{{asset('assets/backend/images/users/avatar-3.jpg')}}"
                                                                                                 alt=""
                                                                                                 class="avatar-xs rounded-circle" />
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                Joseph Parker
                                                                                            </h6>
                                                                                            <small
                                                                                                class="text-muted">New
                                                                                                people joined
                                                                                                with our company
                                                                                                -
                                                                                                Yesterday</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div id="collapse6"
                                                                                 class="accordion-collapse collapse show"
                                                                                 aria-labelledby="heading6"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div
                                                                                    class="accordion-body ms-2 ps-5">
                                                                                    It makes a statement, it’s
                                                                                    impressive graphic design.
                                                                                    Increase or decrease the
                                                                                    letter spacing depending on
                                                                                    the situation and try, try
                                                                                    again until it looks right,
                                                                                    and each letter has the
                                                                                    perfect spot of its own.
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="heading7">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapse7"
                                                                                   aria-expanded="false">
                                                                                    <div class="d-flex">
                                                                                        <div class="avatar-xs">
                                                                                            <div
                                                                                                class="avatar-title rounded-circle bg-light text-danger">
                                                                                                <i
                                                                                                    class="ri-shopping-bag-line"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                Your order is
                                                                                                placed <span
                                                                                                    class="badge bg-soft-success text-success align-middle">Completed</span>
                                                                                            </h6>
                                                                                            <small
                                                                                                class="text-muted">These
                                                                                                customers can
                                                                                                rest assured
                                                                                                their order has
                                                                                                been placed - 1
                                                                                                week Ago</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="heading8">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapse8"
                                                                                   aria-expanded="true">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            class="flex-shrink-0 avatar-xs">
                                                                                            <div
                                                                                                class="avatar-title bg-light text-success rounded-circle">
                                                                                                <i
                                                                                                    class="ri-home-3-line"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                Velzon admin
                                                                                                dashboard
                                                                                                templates layout
                                                                                                upload</h6>
                                                                                            <small
                                                                                                class="text-muted">We
                                                                                                talked about a
                                                                                                project on
                                                                                                linkedin - 1
                                                                                                week Ago</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div id="collapse8"
                                                                                 class="accordion-collapse collapse show"
                                                                                 aria-labelledby="heading8"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div
                                                                                    class="accordion-body ms-2 ps-5 fst-italic">
                                                                                    Powerful, clean & modern
                                                                                    responsive bootstrap 5 admin
                                                                                    template. The maximum file
                                                                                    size for uploads in this
                                                                                    demo :
                                                                                    <div class="row mt-2">
                                                                                        <div class="col-xxl-6">
                                                                                            <div
                                                                                                class="row border border-dashed gx-2 p-2">
                                                                                                <div
                                                                                                    class="col-3">
                                                                                                    <img src="{{asset('assets/backend/images/small/img-3.jpg')}}"
                                                                                                         alt=""
                                                                                                         class="img-fluid rounded" />
                                                                                                </div>
                                                                                                <!--end col-->
                                                                                                <div
                                                                                                    class="col-3">
                                                                                                    <img src="{{asset('assets/backend/images/small/img-5.jpg')}}"
                                                                                                         alt=""
                                                                                                         class="img-fluid rounded" />
                                                                                                </div>
                                                                                                <!--end col-->
                                                                                                <div
                                                                                                    class="col-3">
                                                                                                    <img src="{{asset('assets/backend/images/small/img-7.jpg')}}"
                                                                                                         alt=""
                                                                                                         class="img-fluid rounded" />
                                                                                                </div>
                                                                                                <!--end col-->
                                                                                                <div
                                                                                                    class="col-3">
                                                                                                    <img src="{{asset('assets/backend/images/small/img-9.jpg')}}"
                                                                                                         alt=""
                                                                                                         class="img-fluid rounded" />
                                                                                                </div>
                                                                                                <!--end col-->
                                                                                            </div>
                                                                                            <!--end row-->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="heading9">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapse9"
                                                                                   aria-expanded="false">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            class="flex-shrink-0">
                                                                                            <img src="{{asset('assets/backend/images/users/avatar-6.jpg')}}"
                                                                                                 alt=""
                                                                                                 class="avatar-xs rounded-circle" />
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                New ticket
                                                                                                created <span
                                                                                                    class="badge bg-soft-info text-info align-middle">Inprogress</span>
                                                                                            </h6>
                                                                                            <small
                                                                                                class="text-muted mb-2">User
                                                                                                <span
                                                                                                    class="text-secondary">Jack365</span>
                                                                                                submitted a
                                                                                                ticket - 2 week
                                                                                                Ago</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="heading10">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapse10"
                                                                                   aria-expanded="true">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            class="flex-shrink-0">
                                                                                            <img src="{{asset('assets/backend/images/users/avatar-5.jpg')}}"
                                                                                                 alt=""
                                                                                                 class="avatar-xs rounded-circle" />
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                Jennifer Carter
                                                                                            </h6>
                                                                                            <small
                                                                                                class="text-muted">Commented
                                                                                                - 4 week
                                                                                                Ago</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div id="collapse10"
                                                                                 class="accordion-collapse collapse show"
                                                                                 aria-labelledby="heading10"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div
                                                                                    class="accordion-body ms-2 ps-5">
                                                                                    <p
                                                                                        class="text-muted fst-italic mb-2">
                                                                                        " This is an awesome
                                                                                        admin dashboard
                                                                                        template. It is
                                                                                        extremely well
                                                                                        structured and uses
                                                                                        state of the art
                                                                                        components (e.g. one of
                                                                                        the only templates using
                                                                                        boostrap 5.1.3 so far).
                                                                                        I integrated it into a
                                                                                        Rails 6 project. Needs
                                                                                        manual integration work
                                                                                        of course but the
                                                                                        template structure made
                                                                                        it easy. "</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end accordion-->
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="monthly" role="tabpanel">
                                                                <div class="profile-timeline">
                                                                    <div class="accordion accordion-flush"
                                                                         id="monthlyExample">
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="heading11">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapse11"
                                                                                   aria-expanded="false">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            class="flex-shrink-0 avatar-xs">
                                                                                            <div
                                                                                                class="avatar-title bg-light text-success rounded-circle">
                                                                                                M
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                Megan Elmore
                                                                                            </h6>
                                                                                            <small
                                                                                                class="text-muted">Adding
                                                                                                a new event with
                                                                                                attachments - 1
                                                                                                month
                                                                                                Ago.</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div id="collapse11"
                                                                                 class="accordion-collapse collapse show"
                                                                                 aria-labelledby="heading11"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div
                                                                                    class="accordion-body ms-2 ps-5">
                                                                                    <div class="row g-2">
                                                                                        <div class="col-auto">
                                                                                            <div
                                                                                                class="d-flex border border-dashed p-2 rounded position-relative">
                                                                                                <div
                                                                                                    class="flex-shrink-0">
                                                                                                    <i
                                                                                                        class="ri-image-2-line fs-17 text-danger"></i>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="flex-grow-1 ms-2">
                                                                                                    <h6><a href="javascript:void(0);"
                                                                                                           class="stretched-link">Business
                                                                                                            Template
                                                                                                            -
                                                                                                            UI/UX
                                                                                                            design</a>
                                                                                                    </h6>
                                                                                                    <small>685
                                                                                                        KB</small>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-auto">
                                                                                            <div
                                                                                                class="d-flex border border-dashed p-2 rounded position-relative">
                                                                                                <div
                                                                                                    class="flex-shrink-0">
                                                                                                    <i
                                                                                                        class="ri-file-zip-line fs-17 text-info"></i>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="flex-grow-1 ms-2">
                                                                                                    <h6><a href="javascript:void(0);"
                                                                                                           class="stretched-link">Bank
                                                                                                            Management
                                                                                                            System
                                                                                                            -
                                                                                                            PSD</a>
                                                                                                    </h6>
                                                                                                    <small>8.78
                                                                                                        MB</small>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-auto">
                                                                                            <div
                                                                                                class="d-flex border border-dashed p-2 rounded position-relative">
                                                                                                <div
                                                                                                    class="flex-shrink-0">
                                                                                                    <i
                                                                                                        class="ri-file-zip-line fs-17 text-info"></i>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="flex-grow-1 ms-2">
                                                                                                    <h6><a href="javascript:void(0);"
                                                                                                           class="stretched-link">Bank
                                                                                                            Management
                                                                                                            System
                                                                                                            -
                                                                                                            PSD</a>
                                                                                                    </h6>
                                                                                                    <small>8.78
                                                                                                        MB</small>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="heading12">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapse12"
                                                                                   aria-expanded="true">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            class="flex-shrink-0">
                                                                                            <img src="{{asset('assets/backend/images/users/avatar-2.jpg')}}"
                                                                                                 alt=""
                                                                                                 class="avatar-xs rounded-circle" />
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                Jacqueline Steve
                                                                                            </h6>
                                                                                            <small
                                                                                                class="text-muted">We
                                                                                                has changed 2
                                                                                                attributes on 3
                                                                                                month
                                                                                                Ago</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div id="collapse12"
                                                                                 class="accordion-collapse collapse show"
                                                                                 aria-labelledby="heading12"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div
                                                                                    class="accordion-body ms-2 ps-5">
                                                                                    In an awareness campaign, it
                                                                                    is vital for people to begin
                                                                                    put 2 and 2 together and
                                                                                    begin to recognize your
                                                                                    cause. Too much or too
                                                                                    little spacing, as in the
                                                                                    example below, can make
                                                                                    things unpleasant for the
                                                                                    reader. The goal is to make
                                                                                    your text as comfortable to
                                                                                    read as possible. A
                                                                                    wonderful serenity has taken
                                                                                    possession of my entire
                                                                                    soul, like these sweet
                                                                                    mornings of spring which I
                                                                                    enjoy with my whole heart.
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="heading13">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapse13"
                                                                                   aria-expanded="false">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            class="flex-shrink-0">
                                                                                            <img src="{{asset('assets/backend/images/users/avatar-5.jpg')}}"
                                                                                                 alt=""
                                                                                                 class="avatar-xs rounded-circle" />
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                New ticket
                                                                                                received</h6>
                                                                                            <small
                                                                                                class="text-muted mb-2">User
                                                                                                <span
                                                                                                    class="text-secondary">Erica245</span>
                                                                                                submitted a
                                                                                                ticket - 5 month
                                                                                                Ago</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="heading14">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapse14"
                                                                                   aria-expanded="true">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            class="flex-shrink-0 avatar-xs">
                                                                                            <div
                                                                                                class="avatar-title bg-light text-muted rounded-circle">
                                                                                                <i
                                                                                                    class="ri-user-3-fill"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                Nancy Martino
                                                                                            </h6>
                                                                                            <small
                                                                                                class="text-muted">Commented
                                                                                                on 24 Nov,
                                                                                                2021.</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div id="collapse14"
                                                                                 class="accordion-collapse collapse show"
                                                                                 aria-labelledby="heading14"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div
                                                                                    class="accordion-body ms-2 ps-5 fst-italic">
                                                                                    " A wonderful serenity has
                                                                                    taken possession of my
                                                                                    entire soul, like these
                                                                                    sweet mornings of spring
                                                                                    which I enjoy with my whole
                                                                                    heart. Each design is a new,
                                                                                    unique piece of art birthed
                                                                                    into this world, and while
                                                                                    you have the opportunity to
                                                                                    be creative and make your
                                                                                    own style choices. "
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="accordion-item border-0">
                                                                            <div class="accordion-header"
                                                                                 id="heading15">
                                                                                <a class="accordion-button p-2 shadow-none"
                                                                                   data-bs-toggle="collapse"
                                                                                   href="#collapse15"
                                                                                   aria-expanded="true">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            class="flex-shrink-0">
                                                                                            <img src="{{asset('assets/backend/images/users/avatar-7.jpg')}}"
                                                                                                 alt=""
                                                                                                 class="avatar-xs rounded-circle" />
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex-grow-1 ms-3">
                                                                                            <h6
                                                                                                class="fs-14 mb-1">
                                                                                                Lewis Arnold
                                                                                            </h6>
                                                                                            <small
                                                                                                class="text-muted">Create
                                                                                                new project
                                                                                                buildng product
                                                                                                - 8 month
                                                                                                Ago</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                            <div id="collapse15"
                                                                                 class="accordion-collapse collapse show"
                                                                                 aria-labelledby="heading15"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div
                                                                                    class="accordion-body ms-2 ps-5">
                                                                                    <p class="text-muted mb-2">
                                                                                        Every team project can
                                                                                        have a velzon. Use the
                                                                                        velzon to share
                                                                                        information with your
                                                                                        team to understand and
                                                                                        contribute to your
                                                                                        project.</p>
                                                                                    <div class="avatar-group">
                                                                                        <a href="javascript: void(0);"
                                                                                           class="avatar-group-item"
                                                                                           data-bs-toggle="tooltip"
                                                                                           data-bs-trigger="hover"
                                                                                           data-bs-placement="top"
                                                                                           title=""
                                                                                           data-bs-original-title="Christi">
                                                                                            <img src="{{asset('assets/backend/images/users/avatar-4.jpg')}}"
                                                                                                 alt=""
                                                                                                 class="rounded-circle avatar-xs">
                                                                                        </a>
                                                                                        <a href="javascript: void(0);"
                                                                                           class="avatar-group-item"
                                                                                           data-bs-toggle="tooltip"
                                                                                           data-bs-trigger="hover"
                                                                                           data-bs-placement="top"
                                                                                           title=""
                                                                                           data-bs-original-title="Frank Hook">
                                                                                            <img src="{{asset('assets/backend/images/users/avatar-3.jpg')}}"
                                                                                                 alt=""
                                                                                                 class="rounded-circle avatar-xs">
                                                                                        </a>
                                                                                        <a href="javascript: void(0);"
                                                                                           class="avatar-group-item"
                                                                                           data-bs-toggle="tooltip"
                                                                                           data-bs-trigger="hover"
                                                                                           data-bs-placement="top"
                                                                                           title=""
                                                                                           data-bs-original-title=" Ruby">
                                                                                            <div
                                                                                                class="avatar-xs">
                                                                                                <div
                                                                                                    class="avatar-title rounded-circle bg-light text-primary">
                                                                                                    R
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                        <a href="javascript: void(0);"
                                                                                           class="avatar-group-item"
                                                                                           data-bs-toggle="tooltip"
                                                                                           data-bs-trigger="hover"
                                                                                           data-bs-placement="top"
                                                                                           title=""
                                                                                           data-bs-original-title="more">
                                                                                            <div
                                                                                                class="avatar-xs">
                                                                                                <div
                                                                                                    class="avatar-title rounded-circle">
                                                                                                    2+
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end accordion-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->
                                            </div><!-- end col -->
                                        </div><!-- end row -->

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Active Services</h5>
                                                <!-- Swiper -->
                                                <div class="swiper project-swiper mt-n4">
                                                    <div class="d-flex justify-content-end gap-2 mb-2">
                                                        <div class="slider-button-prev">
                                                            <div class="avatar-title fs-18 rounded px-1">
                                                                <i class="ri-arrow-left-s-line"></i>
                                                            </div>
                                                        </div>
                                                        <div class="slider-button-next">
                                                            <div class="avatar-title fs-18 rounded px-1">
                                                                <i class="ri-arrow-right-s-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-wrapper mt-4">
                                                        @foreach($services as $service)
                                                        <div class="swiper-slide">
                                                            <div
                                                                class="card profile-project-card shadow-none profile-project-success mb-0">
                                                                <div class="card-body p-4">
                                                                    <div class="d-flex">
                                                                        <div
                                                                            class="flex-grow-1 text-muted overflow-hidden">
                                                                            <h5
                                                                                class="fs-14 text-truncate mb-1">
                                                                                <a href="#"
                                                                                   class="text-dark">
                                                                                    {{$service->title}}
                                                                                </a>
                                                                            </h5>
                                                                            <p
                                                                                class="text-muted text-truncate mb-0">
                                                                                Slug : <span
                                                                                    class="fw-semibold text-dark">  {{$service->slug}}</span></p>
                                                                        </div>
                                                                        <div class="flex-shrink-0 ms-2">
                                                                            <div>
                                                                                <a href="#" class="badge badge-soft-warning fs-10">view</a>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex mt-4">
                                                                        <div class="flex-grow-1">
                                                                            <div
                                                                                class="d-flex align-items-center gap-2">
                                                                                <div>
                                                                                    <h5
                                                                                        class="fs-12 text-muted mb-0">
                                                                                        Call Action :</h5>
                                                                                </div>
                                                                                <div class="avatar-group">
                                                                                 {{$service->callAction->name}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end card body -->
                                                            </div>
                                                            <!-- end card -->
                                                        </div>
                                                        @endforeach

                                                    </div>

                                                </div>

                                            </div>
                                            <!-- end card body -->
                                        </div><!-- end card -->

                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <div class="tab-pane fade" id="activities" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Activities</h5>
                                        <div class="tab-content text-muted">
                                            <div class="profile-timeline">
                                                <div class="accordion accordion-flush">
                                                    @foreach($activities as $key=>$activity)
                                                    <div class="accordion-item border-0">
                                                        <div class="accordion-header"
                                                             id="heading{{$key}}">
                                                            <a class="accordion-button p-2 shadow-none"
                                                               data-bs-toggle="collapse"
                                                               href="#collapse{{$key}}"
                                                               aria-expanded="true">
                                                                <div class="d-flex">

                                                                    @if($activity->log_name == "Testimonial Module")
                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                            <div class="avatar-title bg-light text-secondary rounded-circle">
                                                                                <i class="ri-service-fill"></i>
                                                                            </div>
                                                                        </div>
                                                                    @elseif($activity->log_name == "Setting Module")
                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                            <div class="avatar-title bg-light text-success rounded-circle">
                                                                                <i class="ri-settings-line"></i>
                                                                            </div>
                                                                        </div>
                                                                    @elseif($activity->log_name == "Service Module")
                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                            <div class="avatar-title bg-light text-primary rounded-circle">
                                                                                <i class="ri-customer-service-2-line"></i>
                                                                            </div>
                                                                        </div>
                                                                    @elseif($activity->log_name == "Our Work Module")
                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                            <div class="avatar-title bg-light text-warning rounded-circle">
                                                                                <i class=" ri-briefcase-4-fill"></i>
                                                                            </div>
                                                                        </div>
                                                                    @elseif($activity->log_name == "Menu Items Module" || $activity->log_name == "Menu Module")
                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                            <div class="avatar-title bg-light text-success rounded-circle">
                                                                                <i class=" ri-apps-line"></i>
                                                                            </div>
                                                                        </div>
                                                                    @elseif($activity->log_name == "Career Module")
                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                            <div class="avatar-title bg-light text-primary rounded-circle">
                                                                                <i class=" ri-briefcase-5-fill"></i>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="flex-shrink-0 avatar-xs">
                                                                            <div class="avatar-title bg-light text-success rounded-circle">
                                                                                {{preg_replace('/(?<!^)\S/', '', $activity->log_name)}}
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div
                                                                        class="flex-grow-1 ms-3">
                                                                        <h6 class="fs-14 mb-1">
                                                                            {{$activity->log_name}}
                                                                            @if($activity->event == 'created')
                                                                                <span class="badge bg-soft-success text-success align-middle">{{$activity->event}}</span>
                                                                            @endif
                                                                            @if($activity->event == 'updated')
                                                                                <span class="badge bg-soft-secondary text-secondary align-middle">{{$activity->event}}</span>
                                                                            @endif
                                                                            @if($activity->event == 'deleted')
                                                                                <span class="badge bg-soft-danger text-danger align-middle ms-1">{{$activity->event}}</span>
                                                                            @endif

                                                                        </h6>

                                                                        <small
                                                                            class="text-muted">{{$activity->description}}</small>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>

                                                        @if($activity->event !== null)
                                                        <div id="collapse{{$key}}"
                                                             class="accordion-collapse collapse show"
                                                             aria-labelledby="heading{{$key}}"
                                                             data-bs-parent="#accordionExample">
                                                            <div class="accordion-body ms-2 ps-5">
                                                                <p class="text-muted mb-2">
                                                                    @if($activity->event == 'created')
                                                                        The details are:
                                                                    <p class="text-capitalize">
                                                                        @foreach($activity->properties['attributes'] as $a=>$value)
                                                                           <span class="text-success"> {{str_replace('_',' ',$a)}}</span>  :   {{$value}}{{($loop->last) ? ".":","}}
                                                                        @endforeach
                                                                    </p>
                                                                @elseif($activity->event == 'updated')
                                                                    The details were changed from:
                                                                            <p class="text-capitalize">
                                                                            @foreach($activity->properties['old'] as $a=>$value)
                                                                                    <span class="text-success"> {{str_replace('_',' ',$a)}}</span>  :   {{$value}}{{($loop->last) ? ".":","}}
                                                                           @endforeach

                                                                                <span class="link-warning text-decoration-underline">To following:</span>
                                                                        @foreach($activity->properties['attributes'] as $a=>$value)
                                                                            <span class="text-success">{{str_replace('_',' ',$a)}}</span>  :   {{$value}}{{($loop->last) ? ".":","}}
                                                                        @endforeach
                                                                    </p>
                                                                @elseif($activity->event == 'deleted')
                                                                    Removed details are:
                                                                    <p class="text-capitalize">
                                                                        @foreach($activity->properties['old'] as $a=>$value)
                                                                            <span class="text-success"> {{str_replace('_',' ',$a)}}</span>  :   {{$value}}{{($loop->last) ? ".":","}}
                                                                        @endforeach
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                         @endif
                                                    </div>
                                                    @endforeach

                                                </div>
                                                <!--end accordion-->
                                            </div>
                                        </div>

                                <!--end card-->
                            </div>
                                </div>
                            </div>

                        </div>
                        <!--end tab-content-->
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div><!-- container-fluid -->
    </div><!-- End Page-content -->


@endsection

@section('js')
    <!-- profile init js -->
    <script src="{{asset('assets/backend/js/pages/profile.init.js')}}"></script>
@endsection
