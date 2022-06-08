@extends('frontend.layouts.master')
@section('title') {{ucwords(@$cat_name)}} | Blog @endsection

@section('content')

    <!-- BLOG POSTS LISTING
    ============================================= -->
    <section id="blog-page" class="bg-snow wide-50 inner-page-hero blog-page-section division">
        <div class="container">


            <!-- SECTION TITLE -->	
            <div class="row justify-content-center">	
                <div class="col-md-10 col-lg-8">
                    <div class="section-title title-02 mb-85">	
                        <h2>Relevant news on "{{ucwords(@$cat_name)}}" category</h2>
                    </div>	
                </div>
            </div>



            <!-- POSTS WRAPPER -->
            <div class="posts-wrapper">


                <!-- BLOG POSTS CATEGORY --> 
                <!-- <div class="row">
                    <div class="col-md-12">
                        <h5 class="h5-lg posts-category">Our Articles</h5>
                    </div>
                </div> -->


                <!-- BLOG POSTS -->
                <div class="row">	
                    <div class="col gallery-items-list">
                        <div class="masonry-wrap grid-loaded">
                      
                            <!-- BLOG POST #1 -->
                            @if(count($allPosts) > 0)
                                @foreach($allPosts as $post)
                                <div class="blog-3-post masonry-image">

                                    <!-- BLOG POST IMAGE -->
                                    <div class="blog-post-img">
                                        <div class="hover-overlay"> 
                                            <img class="img-fluid" src="<?php if(@$post->image){?>{{asset('/images/blog/'.@$post->image)}}<?php }?>" alt="{{@$post->slug}}" />
                                            <div class="item-overlay"></div>
                                        </div>
                                    </div>

                                    <!-- BLOG POST TEXT -->
                                    <div class="blog-post-txt">

                                        <!-- Post Tag -->
                                        <p class="p-md post-tag">Published on &ensp; {{date('M j, Y',strtotime(@$post->created_at))}}</p>	

                                        <!-- Post Link -->
                                        <h5 class="h5-md">
                                            <a href="{{route('blog.single',$post->slug)}}">
                                            {{ucwords($post->title)}}
                                            </a>
                                        </h5>

                                        

                                    </div>	<!-- END BLOG POST TEXT -->

                                </div>
                                @endforeach
                                @else

                                <section class="no-results not-found">
                                    <header class="page-header">
                                        <h1 class="page-title">Nothing Found</h1>
                                    </header>
                                    <div class="page-content">
                                        <p>It seems we can not find what you are looking for.</p>
                                    
                                    </div>
                                </section>
                            @endif
                            <!-- END BLOG POST #1 -->

                        </div>
                    </div>
                </div>	<!-- END BLOG POSTS -->


            </div>	<!-- END POSTS WRAPPER -->


        </div>     <!-- End container -->
    </section>	<!-- END BLOG POSTS LISTING -->


    <!-- PAGE PAGINATION
    ============================================= -->
    <div class="bg-snow pb-100 page-pagination division">
        <div class="container">
            <div class="row">	
                <div class="col-md-12">
                {{ $allPosts->links('vendor.pagination.default') }}
                    
                </div>
            </div>  <!-- End row -->	
        </div> <!-- End container -->
    </div>	<!-- END PAGE PAGINATION -->

@endsection