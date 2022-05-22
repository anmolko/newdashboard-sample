@extends('backend.layouts.master')
@section('title') Menu @endsection

@section('css')
    <style>

    .disabled{pointer-events: none; opacity: 0.7;}
    .hidden{
        display: none;
    }

    .menu-item-bar{background: #eee;padding: 5px 10px;border:1px solid #d7d7d7;margin-bottom: 5px; width: 75%; cursor: move;display: block;}
    #serialize_output{display: none;}
    .menulocation label{font-weight: normal;display: block;}
    body.dragging, body.dragging * {cursor: move !important;}
    .dragged {position: absolute;z-index: 1;}
    ol.example li.placeholder {position: relative;}
    ol.example li.placeholder:before {position: absolute;}
    #menuitem{list-style: none;}
    #menuitem ul{list-style: none;}
    .input-box{width:75%;background:#fff;padding: 10px;box-sizing: border-box;margin-bottom: 5px;}
    .input-box .form-control{width: 75%}
    .menulocation label{font-weight: normal;display: block;}
    .children-content > li{
        padding-left: 30px;
    }


    </style>

@endsection
@section('content')



    <div class="col-xl-9 col-lg-8  col-md-12">
        <?php
        $slug_to_disable = [];
        if($desiredMenu !== null){
            $slug_to_disable = get_slugs_to_disable($desiredMenu->slug);
        }
        ?>
            <div class="card shadow-sm ctm-border-radius grow">
            <div class="card-body align-center">
                <div class="row filter-row">

                @if(count($menus) > 0)

                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                        {!! Form::open(['route' => 'menu.index','method'=>'get','class'=>'needs-validation','id'=>'basic-form','novalidate'=>'']) !!}

                            <div class="form-group mb-xl-0 mb-md-2 mb-sm-2">
                                <select class="form-control select" name="slug">
                                    <option disabled>Select a menu to edit</option>
                                    @foreach($menus as $menu)
                                        @if($desiredMenu !== '')
                                            <option value="{{$menu->slug}}" @if($menu->id == $desiredMenu->id) selected @endif>{{$menu->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-2">
                        <button type="submit" class="btn btn-theme button-1 text-white btn-block p-2 mb-md-0 mb-sm-0 mb-lg-0 mb-0"> Select </button>
                    </div>
                    {!! Form::close() !!}

                    <span>or</span>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                        <a href="#" class="btn btn-theme button-1 text-white btn-block p-2 mb-md-0 mb-sm-0 mb-lg-0 mb-0" data-toggle="modal" data-target="#createMenu"> Create Menu </a>
                    </div>
                    @else
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <h4 class="card-title mb-0 d-inline-block">Create New Menu here</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5 col-sm-12">
                <div class="card flex-fill ctm-border-radius shadow-sm grow">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Add Menu Items</h4>
                    </div>
                    <div class="card-body">
                        <div class="accordion add-employee" id="accordion-details">

                            <div class="card shadow-sm ctm-border-radius">
                                <div class="card-header" id="basic1">
                                    <h4 class="cursor-pointer mb-0">
                                        <a class="coll-arrow d-block text-dark collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#basic-one" aria-expanded="true">
                                            Pages
                                            <br><span class="ctm-text-sm">Your current page lists.</span>
                                        </a>
                                    </h4>
                                </div>
                                <div class="card-body p-0 {{(count($menus) == 0) ? 'disabled':''}}" id="pages-list">
                                    <div id="basic-one" class="ctm-padding collapse show" aria-labelledby="basic1" data-parent="#accordion-details" style="">
                                        @if(count($pages) !== 0)
                                            @foreach($pages as $page)
                                                <div class="custom-control custom-checkbox mb-3 {{(in_array($page->slug, $slug_to_disable)) ? 'disabled':''}}">
                                                    <input type="checkbox" class="custom-control-input" id="page-{{$page->id}}" value="{{$page->id}}" name="select-pages[]" {{(count($menus) == 0 || in_array($page->slug, $slug_to_disable)) ? 'disabled':''}}>
                                                    <label class="custom-control-label {{(in_array($page->slug, $slug_to_disable)) ? 'disabled':''}}" for="page-{{$page->id}}">
                                                        <span class="h6">
                                                            {{ucfirst($page->name)}}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="pb-2">
                                                <span class="h6">Please <a href="{{route('pages.index')}}">create a page</a> to add in menu.</span>
                                            </div>
                                        @endif

                                        <div class="text-center {{(count($pages) == 0) ? 'disabled':''}}">
                                            <label class="pull-left btn-sm btn btn-theme button-1 ctm-border-radius text-white"><input type="checkbox" id="select-all-pages" class="hidden"> Select All</label>
                                            <button type="button" class="pull-right btn-sm btn btn-theme button-1 ctm-border-radius text-white" id="add-pages">Add to Menu</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-sm ctm-border-radius">
                                <div class="card-header" id="headingThree">
                                    <h4 class="cursor-pointer mb-0">
                                        <a class="coll-arrow d-block text-dark collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#term-office" aria-expanded="false">
                                            Posts
                                            <br><span class="ctm-text-sm">Your blog posts link are here.</span>
                                        </a>
                                    </h4>
                                </div>
                                <div class="card-body p-0 {{(count($menus) == 0) ? 'disabled':''}}" id="posts-list">
                                    <div id="term-office" class="ctm-padding collapse" aria-labelledby="headingThree" data-parent="#accordion-details" style="">
                                        @if(count($blogs) !== 0)
                                                @foreach($blogs as $blog)
                                                    <div class="custom-control custom-checkbox mb-3 {{(in_array($blog->slug, $slug_to_disable)) ? 'disabled':''}}">
                                                        <input type="checkbox" name="select-post[]" value="{{$blog->id}}" class="custom-control-input" id="posts-{{$blog->id}}" {{(count($menus) == 0 || in_array($blog->slug, $slug_to_disable)) ? 'disabled':''}}>
                                                        <label class="custom-control-label {{(in_array($blog->slug, $slug_to_disable)) ? 'disabled':''}}" for="posts-{{$blog->id}}">
                                                            <span class="h6">{{$blog->title}}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="pb-2">
                                                    <span class="h6">Please <a href="{{route('blogcategory.index')}}">create a blog</a> to add in menu.</span>
                                                </div>
                                            @endif
                                        <div class="text-center {{(count($blogs) == 0) ? 'disabled':''}}">
                                            <label class="pull-left btn btn-sm btn-theme button-1 ctm-border-radius text-white"><input type="checkbox" id="select-all-posts" class="hidden"> Select All</label>
                                            <button type="button" class="pull-right btn-sm btn btn-theme button-1 ctm-border-radius text-white" id="add-posts">Add to Menu</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-sm ctm-border-radius">
                                <div class="card-header" id="headingFour">
                                    <h4 class="cursor-pointer mb-0">
                                        <a class="coll-arrow d-block text-dark collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#salary_det" aria-expanded="false">
                                            Custom Links
                                            <br><span class="ctm-text-sm">Your can add a custom link from here.</span>
                                        </a>
                                    </h4>
                                </div>
                                <div class="card-body p-0 {{(count($menus) == 0) ? 'disabled':''}}" id="custom-links">
                                    <div id="salary_det" class="ctm-padding collapse" aria-labelledby="headingFour" data-parent="#accordion-details" style="">

                                        <div class="form-group mb-3">
                                            <label>URL </label>
                                            <input type="url" name="url" id="url" class="form-control"  placeholder="https://" required>
                                            <div class="invalid-feedback" id="custom-slug">
                                                Please enter the url.
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>URL Text</label>
                                            <input type="url" name="url_text" id="url_text" class="form-control" required>
                                            <div class="invalid-feedback" id="custom-name">
                                                Please enter the url text.
                                            </div>
                                        </div>
                                        <div class="text-center pull-right mb-2">
                                            <button type="button" class=" btn btn-theme button-1 ctm-border-radius text-white" id="add-custom-link">Add to Menu</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-sm-12">
                <div class="card flex-fill office-card-last ctm-border-radius shadow-sm grow">
                    <div class="card-header ">
                        <h4 class="card-title mb-0">Menu Structure
                        </h4>
                    </div>
                    <div class="card-body">
                        @if($desiredMenu == '')
                           <div class="card shadow-none">
                                <div class="card-header">
                                    <h5 class="card-title text-primary mb-0">Create New Menu</h5>
                                </div>

                                <div class="card-body">
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
                          </div>
                        @else
                            <div id="menu-content">
                                <div style="min-height: 240px;">
                                    <p>Select Posts, pages or add custom links to menus.</p>
                                    @if($desiredMenu != '')
                                        <ul class="menu ui-sortable" id="menuitems">
                                            @if(!empty($menuitems))
                                                @foreach($menuitems as $key=>$item)
                                                    <li data-id="{{$item->id}}" class="mt-2"><span class="menu-item-bar"><i class="lnr lnr-move"></i> @if(empty($item->name)) {{$item->title}} @else {{$item->name}} @endif <a href="#collapse{{$item->id}}" class="pull-right coll-arrow d-block text-dark collapsed" data-toggle="collapse"></a></span>
                                                        <div class="collapse" id="collapse{{$item->id}}">
                                                            <div class="card shadow-sm ctm-border-radius input-box">
                                                                <div class="card-header" id="basic3">
                                                                    <h4 class="cursor-pointer mb-0">
                                                                        <a class="d-block text-dark">
                                                                            Edit details
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div class="card-body p-2">
                                                                    {!! Form::open(['method'=>'post','url'=>route('menu.updatemenuitem', @$item->id),'class'=>'needs-validation','novalidate'=>'']) !!}
                                                                        <div class="form-group mb-3">
                                                                            <label>Link Name </label>
                                                                            <input type="text" class="form-control" name="name" value="@if(empty($item->name)) {{$item->title}} @else {{$item->name}} @endif">
                                                                            <div class="invalid-feedback">
                                                                                Please enter the Link Name.
                                                                            </div>
                                                                        </div>

                                                                        @if($item->type == 'custom')
                                                                            <div class="form-group mb-3">
                                                                                <label>URL </label>
                                                                                <input type="text" class="form-control" name="slug" value="{{$item->slug}}" required>
                                                                                <div class="invalid-feedback">
                                                                                    Please enter the URL.
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        <div class="custom-control custom-checkbox mb-3">
                                                                            <input type="checkbox" name="target" value="_blank" id="main-{{$item->id}}"  @if($item->target == '_blank') checked @endif class="custom-control-input">
                                                                            <label class="custom-control-label" for="main-{{$item->id}}">
                                                                                <span class="h6">Open in a new tab</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="text-center">
                                                                        <button class="pull-right btn btn-sm btn-outline-success"><i class="lnr lnr-bookmark"></i> Save</button>
                                                                        <a href="{{url('auth/delete-menuitem')}}/{{$item->id}}/{{$key}}" class="pull-left btn btn-sm btn-outline-danger">
                                                                            <span class="lnr lnr-trash"></span> Delete
                                                                        </a>
                                                                    </div>

                                                                    {!! Form::close() !!}

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="children-content">
                                                            @if(isset($item->children))
                                                                @foreach($item->children as $m)
                                                                    @foreach($m as $in=>$data)
                                                                        <li data-id="{{$data->id}}" class="menu-item mt-2"> <span class="menu-item-bar"><i class="lnr lnr-move"></i> @if(empty($data->name)) {{$data->title}} @else {{$data->name}} @endif <a href="#collapse{{$data->id}}" class="pull-right coll-arrow d-block text-dark collapsed" data-toggle="collapse"></a></span>
                                                                            <div class="collapse" id="collapse{{$data->id}}">
                                                                                <div class="card shadow-sm ctm-border-radius input-box">
                                                                                    <div class="card-header" id="basic4">
                                                                                        <h4 class="cursor-pointer mb-0">
                                                                                            <a class="d-block text-dark">
                                                                                                Edit details
                                                                                            </a>
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="card-body p-2">
                                                                                        {!! Form::open(['method'=>'post','url'=>route('menu.updatemenuitem', @$data->id),'class'=>'needs-validation','novalidate'=>'']) !!}
                                                                                        <div class="form-group mb-3">
                                                                                            <label>Link Name </label>
                                                                                            <input type="text" class="form-control" name="name" value="@if(empty($data->name)) {{$data->title}} @else {{$data->name}} @endif">
                                                                                            <div class="invalid-feedback">
                                                                                                Please enter the Link Name.
                                                                                            </div>
                                                                                        </div>

                                                                                        @if($data->type == 'custom')
                                                                                            <div class="form-group mb-3">
                                                                                                <label>URL </label>
                                                                                                <input type="text" class="form-control" name="slug" value="{{$data->slug}}" required>
                                                                                                <div class="invalid-feedback">
                                                                                                    Please enter the URL.
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                        <div class="custom-control custom-checkbox mb-3">
                                                                                            <input type="checkbox" name="target" value="_blank" id="main-{{$data->id}}"  @if($data->target == '_blank') checked @endif class="custom-control-input">
                                                                                            <label class="custom-control-label" for="main-{{$data->id}}">
                                                                                                <span class="h6">Open in a new tab</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="text-center">
                                                                                            <button class="pull-right btn btn-sm btn-outline-success"><i class="lnr lnr-bookmark"></i> Save</button>
                                                                                            <a href="{{url('auth/delete-menuitem')}}/{{$data->id}}/{{$key}}/{{$in}}" class="pull-left btn btn-sm btn-outline-danger">
                                                                                                <span class="lnr lnr-trash"></span> Delete
                                                                                            </a>
                                                                                        </div>

                                                                                        {!! Form::close() !!}

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <ul class="children-content">
                                                                                @if(isset($data->children))
                                                                                    @foreach($data->children as $o)
                                                                                        @foreach($o as $keys=>$data1)
                                                                                            <li data-id="{{$data1->id}}" class="menu-item mt-2"> <span class="menu-item-bar"><i class="lnr lnr-move"></i> @if(empty($data1->name)) {{$data1->title}} @else {{$data1->name}} @endif <a href="#collapse{{$data1->id}}" class="pull-right coll-arrow d-block text-dark collapsed" data-toggle="collapse"></a></span>
                                                                                                <div class="collapse" id="collapse{{$data1->id}}">
                                                                                                    <div class="card shadow-sm ctm-border-radius input-box">
                                                                                                        <div class="card-header" id="basic4">
                                                                                                            <h4 class="cursor-pointer mb-0">
                                                                                                                <a class="d-block text-dark">
                                                                                                                    Edit details
                                                                                                                </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div class="card-body p-2">
                                                                                                            {!! Form::open(['method'=>'post','url'=>route('menu.updatemenuitem', @$data1->id),'class'=>'needs-validation','novalidate'=>'']) !!}
                                                                                                            <div class="form-group mb-3">
                                                                                                                <label>Link Name </label>
                                                                                                                <input type="text" class="form-control" name="name" value="@if(empty($data1->name)) {{$data1->title}} @else {{$data1->name}} @endif">
                                                                                                                <div class="invalid-feedback">
                                                                                                                    Please enter the Link Name.
                                                                                                                </div>
                                                                                                            </div>

                                                                                                            @if($data1->type == 'custom')
                                                                                                                <div class="form-group mb-3">
                                                                                                                    <label>URL </label>
                                                                                                                    <input type="text" class="form-control" name="slug" value="{{$data1->slug}}" required>
                                                                                                                    <div class="invalid-feedback">
                                                                                                                        Please enter the URL.
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            @endif
                                                                                                            <div class="custom-control custom-checkbox mb-3">
                                                                                                                <input type="checkbox" name="target" value="_blank" id="main-{{$data1->id}}"  @if($data1->target == '_blank') checked @endif class="custom-control-input">
                                                                                                                <label class="custom-control-label" for="main-{{$data1->id}}">
                                                                                                                    <span class="h6">Open in a new tab</span>
                                                                                                                </label>
                                                                                                            </div>
                                                                                                            <div class="text-center">
                                                                                                                <button class="pull-right btn btn-sm btn-outline-success"><i class="lnr lnr-bookmark"></i> Save</button>
                                                                                                                <a href="{{url('auth/delete-menuitem')}}/{{$data1->id}}/{{$key}}/{{$in}}/{{$keys}}" class="pull-left btn btn-sm btn-outline-danger">
                                                                                                                    <span class="lnr lnr-trash"></span> Delete
                                                                                                                </a>
                                                                                                            </div>

                                                                                                            {!! Form::close() !!}

                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    @endforeach
                                                                                @endif
                                                                            </ul>
                                                                        </li>
                                                                    @endforeach
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    @endif
                                </div>

                                @if($desiredMenu != '')
                                    <div class="form-group">
                                        <label for="title" class="text-heading">Edit Title (for frontend display)</label>
                                        <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{$menuTitle}}" required>
                                        <div class="invalid-feedback">
                                            Please enter the menu title.
                                        </div>
                                    </div>
                                    <div class="form-group menulocation">
                                        <p class="mb-2">Select Menu Location: </p>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input"  name="location" id="header-one" value="1" @if($desiredMenu->location == 1) checked @endif>
                                            <label class="custom-control-label" for="header-one">Header Menu</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input"  name="location" id="footer-one" value="2" @if($desiredMenu->location == 2) checked @endif>
                                            <label class="custom-control-label" for="footer-one">Footer Menu</label>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <a href="{{route('menu.delete',$desiredMenu->id)}}" class="pull-left btn btn-sm btn-outline-danger" id="deleteMenu">
                                            <span class="lnr lnr-trash"></span> Delete Menu
                                        </a>

                                        <button type="button" class="pull-right btn btn-sm btn-outline-success @if(count(@$slug_to_disable) == 0  ) disabled @endif" id="saveMenu" >
                                            <span class="lnr lnr-bookmark"></span> Save Menu</button>
                                    </div>

                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div id="serialize_output">@if(@$desiredMenu){{@$desiredMenu->content}}@endif</div>
    <div class="modal fade bd-example-modal-lg" id="createMenu">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title mb-3">Create New Menu</h4>

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


            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="{{asset('assets/backend/js/jquery-sortable.js')}}"></script>

    <script type="text/javascript">

        //settings for sortable JS
        var group = $("#menuitems").sortable({
            group: 'serialization',
            isValidTarget: function ($item, container) {
                //for limiting the depth of the UL child
                var depth = 1, // Start with a depth of one (the element itself)
                    maxDepth = 3,
                    children = $item.find('ul').first().find('li');


                // Add the amount of parents to the depth
                depth += container.el.parents('ul').length;

                // Increment the depth for each time a child
                while (children.length) {
                    depth++;
                    children = children.find('ul').first().find('li');
                }

                return depth <= maxDepth;
            },
            onDrop: function ($item, container, _super) {
                var data = group.sortable("serialize").get();
                var jsonString = JSON.stringify(data, null, ' ');
                $('#serialize_output').text(jsonString);
                //for animation
                var $clonedItem = $('<li/>').css({height: 0});
                $item.before($clonedItem);
                $clonedItem.animate({'height': $item.height()});

                $item.animate($clonedItem.position(), function  () {
                    $clonedItem.detach();
                    _super($item, container);
                });
            },
            //for animation
            onDragStart: function ($item, container, _super) {
                var offset = $item.offset(),
                    pointer = container.rootGroup.pointer;

                adjustment = {
                    left: pointer.left - offset.left,
                    top: pointer.top - offset.top
                };

                _super($item, container);
            },
            //for animation
            onDrag: function ($item, position) {
                $item.css({
                    left: position.left - adjustment.left,
                    top: position.top - adjustment.top
                });
            }
        });

        $("#name").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            var regExp = /\s+/g;
            Text = Text.replace(regExp,'-');
            $("#slug").val(Text);
        });

        $(document).ready(function () {
            var $data = group.sortable("serialize").get();
            var jsonString = JSON.stringify($data, null, ' ');
            $('#serialize_output').text(jsonString);
        });

        $('#select-all-pages').click(function(event) {
            if(this.checked) {
                $('#pages-list :checkbox:not(:disabled)').each(function() {
                        this.checked = true;
                });
            }else{
                $('#pages-list :checkbox:not(:disabled)').each(function() {
                    this.checked = false;
                });
            }
       });

        $('#select-all-posts').click(function(event) {
            if(this.checked) {
                $('#posts-list :checkbox:not(:disabled)').each(function() {
                    this.checked = true;
                });
            }else{
                $('#posts-list :checkbox:not(:disabled)').each(function() {
                    this.checked = false;
                });
            }
        });

        @if($desiredMenu)

            $('#add-pages').click(function(){
                var menuid  = "{{$desiredMenu->id}}";
                var n       = $('input[name="select-pages[]"]:checked').length;
                var array   = $('input[name="select-pages[]"]:checked');
                var ids     = [];

                if(n == 0){
                    return false;
                }

                for(var i=0;i<n;i++){
                    ids[i] =  array.eq(i).val();
                }

                if(ids.length == 0){
                    return false;
                }

                $.ajax({
                    type:"get",
                    data: {menuid:menuid,ids:ids},
                    url: "{{route('menu.page')}}",
                    success:function(res){
                        location.reload();
                    }
                });
            });

            $('#add-posts').click(function(){
                var menuid  = "{{$desiredMenu->id}}";
                var n       = $('input[name="select-post[]"]:checked').length;
                var array   = $('input[name="select-post[]"]:checked');
                var ids     = [];

                if(n == 0){
                    return false;
                }

                for(var i=0;i<n;i++){
                    ids[i] =  array.eq(i).val();
                }

                if(ids.length == 0){
                    return false;
                }

                $.ajax({
                    type:"get",
                    data: {menuid:menuid,ids:ids},
                    url: "{{route('menu.post')}}",
                    success:function(res){
                        location.reload();
                    }
                });

            });

            $("#add-custom-link").click(function(){
                var menuid  = "{{$desiredMenu->id}}";
                var url = $('#url').val();
                var url_text = $('#url_text').val();

                if(url_text !== ''){
                    $("#custom-name").hide();
                }else{
                    $("#custom-name").show();
                }

                if(url !== ''){
                    $("#custom-slug").hide();
                    $.ajax({
                        type:"get",
                        data: {menuid:menuid,url:url,url_text:url_text},
                        url: "{{route('menu.custom')}}",
                        success:function(res){
                            location.reload();
                        }
                    });
                } else {
                    $("#custom-slug").show();
                }
            });

            $('#saveMenu').click(function(){
                var menuid  = "{{$desiredMenu->id}}";
                var location = $('input[name="location"]:checked').val();
                var title = $('input[name="title"]').val();
                if(title == ""){
                    swal("Missing Title!", "Enter the title to save the menu", "info");
                    return false;
                }
                if(location == null){
                    swal("Mission location!", "Select the location to save the menu", "info");
                    return false;
                }
                var data = JSON.parse($("#serialize_output").text());
                $.ajax({
                    type:"get",
                    data: {menuid:menuid,data:data,location:location,title:title},
                    url: "{{route('menu.updateMenu')}}",
                    success:function(res){
                        window.location.reload();
                    }
                });
            });

        @endif



    </script>
@endsection
