<!-- Left Sidebar start -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{route('dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('assets/backend/images/canosoft-favicon.png')}}" alt="" height="25">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php if(@$setting_data->logo_white){?>{{asset('/images/settings/'.@$setting_data->logo_white)}}<?php }else{ echo '/assets/backend/images/canosoft-logo.png'; }?>" alt="Logo" height="35">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('assets/backend/images/canosoft-favicon.png')}}" alt="" height="25">
                    </span>
                     <span class="logo-lg">
                        <img src="<?php if(@$setting_data->logo_white){?>{{asset('/images/settings/'.@$setting_data->logo_white)}}<?php }else{ echo '/assets/backend/images/canosoft-logo.png'; }?>" alt="Logo" height="35">
                     </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/" target="_blank">
                        <i class="ri-rocket-line"></i> <span data-key="t-landing">Landing</span>
                        <span class="badge badge-pill bg-success" data-key="t-new">{{Auth::user()->user_type}}</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Components</span></li>


                <li class="nav-item">
                    <a class="nav-link menu-link  @if(\Request::route()->getName() == 'menu.index') active @endif" href="{{route('menu.index')}}">
                    <i class="ri-stack-line"></i> <span data-key="t-forms">Menu</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'alluser') active @endif" href="{{route('alluser')}}">
                        <i class="ri-account-circle-line"></i> <span data-key="t-widgets">User Mgmt.</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'services.index') active @endif" href="{{route('services.index')}}">
                        <i class="ri-customer-service-2-line"></i> <span data-key="t-widgets">Services</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'our-work.index') active @endif" href="{{route('our-work.index')}}">
                        <i class="ri-todo-line"></i> <span data-key="t-widgets">Our Work</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link  @if(\Request::route()->getName() == 'call-actions.index') active @endif" href="{{route('call-actions.index')}}">
                        <i class="ri-attachment-2"></i> <span data-key="t-forms">Call Action</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'blogcategory.index' || \Request::route()->getName() == 'blog.index' ) active @endif" href="#sidebarBlogs" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarBlogs">
                        <i class="ri-bold"></i> <span data-key="t-blog-mgmt">Blog Mgmt.</span>
                    </a>
                    <div class="collapse menu-dropdown @if(\Request::route()->getName() == 'blogcategory.index' || \Request::route()->getName() == 'blog.index' ) show @endif" id="sidebarBlogs">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('blogcategory.index')}}" class="nav-link @if(\Request::route()->getName() == 'blogcategory.index') active @endif" data-key="t-blog-category">Category</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('blog.index')}}" class="nav-link @if(\Request::route()->getName() == 'blog.index') active @endif" data-key="t-blog">Blog</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'career.index') active @endif" href="{{route('career.index')}}">
                        <i class="ri-refund-2-line"></i> <span data-key="t-widgets">Career</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'project-plan.index') active @endif" href="{{route('project-plan.index')}}">
                        <i class="ri-slideshow-4-line"></i> <span data-key="t-widgets">Project Plan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link  @if(\Request::route()->getName() == 'contact.index') active @endif" href="{{route('contact.index')}}">
                        <i class="ri-file-list-3-line"></i> <span data-key="t-forms">Customer Contact</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

<!-- Left Sidebar End -->

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
