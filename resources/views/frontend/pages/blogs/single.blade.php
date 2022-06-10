@extends('frontend.layouts.seo_master')
@section('css')
    <style>
           
    .custom-editor .media{
        display: block;
    }

    .custom-editor{
        font-size: 1.1875rem;
    }
    .canosoft-listing ul,.canosoft-listing ol {
        padding: 0;
        margin-left: 15px;
    }
   
    </style>
@endsection
@section('seo')
    <title>{{ucfirst(@$singleBlog->title)}} | @if(!empty(@$setting_data->website_name)) {{ucwords(@$setting_data->website_name)}} @else Canosoft - Let's make IT happen @endif </title>
    <meta name='description' itemprop='description'  content='{{ucfirst(@$singleBlog->meta_description)}}' />
    <meta name='keywords' content='{{ucfirst(@$singleBlog->meta_tags)}}' />
    <meta property='article:published_time' content='<?php if(@$singleBlog->updated_at !=''){?>{{@$singleBlog->updated_at}} <?php }else {?> {{@$singleBlog->created_at}} <?php }?>' />
    <meta property='article:section' content='article' />
    <meta property="og:description" content="{{ucfirst(@$singleBlog->meta_description)}}" />
    <meta property="og:title" content="{{ucfirst(@$singleBlog->meta_title)}}" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:type" content="IT-Coperation" />
    <meta property="og:locale" content="en-us" />
    <meta property="og:locale:alternate"  content="en-us" />
    <meta property="og:site_name" content="@if(!empty(@$setting_data->website_name)) {{ucwords(@$setting_data->website_name)}} @else Canosoft - Let's make IT happen @endif" />
    <meta property="og:image" content="<?php if(@$singleBlog->image){?>{{asset('/images/blog/'.@$singleBlog->image)}}<?php }?>" />
    <meta property="og:image:url" content="<?php if(@$singleBlog->image){?>{{asset('/images/blog/'.@$singleBlog->image)}}<?php }?>" />
    <meta property="og:image:size" content="300" />
@endsection
@section('content')

	<!-- SINGLE POST ============================================= -->
    <section id="single-post" class="wide-100 inner-page-hero single-post-section division">
        <div class="container">


            <!-- SINGLE POST CONTENT -->
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="single-post-wrapper">


                        <!-- SINGLE POST TITLE -->
                        <div class="single-post-title">

                            <!-- CATEGORY -->
                            <p class="p-sm post-tag txt-500 txt-upcase"><a href="{{route('blog.frontend')}}">Canosoft News</a> | <span class="h6-xl"><a href="{{route('blog.category',$singleBlog->category->slug)}}">{{ucwords($singleBlog->category->name)}}</a></span></p>

                            <!-- TITLE -->
                            <h2 class="h2-md">{{ @$singleBlog->title }}</h2>


                        </div>	<!-- END SINGLE POST TITLE -->


                        <!-- BLOG POST TEXT -->
                        <div class="single-post-txt custom-editor canosoft-listing">
                            {!! $singleBlog->description !!}
                        </div>	<!-- END BLOG POST TEXT -->


                    </div>	<!-- END BLOG POST TEXT -->


                    <!-- SINGLE POST SHARE LINKS -->
                    <div class="row post-share-links d-flex align-items-center">

                        
                        <!-- POST TAGS -->
                        <div class="col-md-9 col-xl-8 ">
                        <p class="p-md custom-editor" >Published on {{date('M j, Y',strtotime(@$singleBlog->created_at))}}</p>								
                        </div>
                        <!-- POST SHARE ICONS -->
                        <div class="col-md-3 col-xl-4 post-share-list text-end">
                            <ul class="share-social-icons ico-25 text-center clearfix">								
                                <li><a href="#" class="share-ico" onclick='fbShare("{{route('blog.single',$singleBlog->slug)}}")'><span class="flaticon-facebook"></span></a></li>
                                <li><a href="#" class="share-ico" onclick='twitShare("{{route('blog.single',$singleBlog->slug)}}","{{ $singleBlog->title }}")' ><span class="flaticon-twitter"></span></a></li>
                                <li><a href="#" class="share-ico"  onclick='whatsappShare("{{route('blog.single',$singleBlog->slug)}}","{{ $singleBlog->title }}")' ><span class="flaticon-whatsapp"></span></a></li>

                            </ul>
                        </div>

                    </div>	<!-- END SINGLE POST SHARE -->

                    </div>
                </div>
            </div>	<!-- END SINGLE POST CONTENT -->


        </div>     <!-- End container -->
    </section>	<!-- END SINGLE POST -->
@endsection

@section('js')
<script>
function fbShare(url) {
  window.open("https://www.facebook.com/sharer/sharer.php?u=" + url, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=200, left=500, width=600, height=400");
}
function twitShare(url, title) {
    window.open("https://twitter.com/intent/tweet?text=" + encodeURIComponent(title) + "+" + url + "", "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=200, left=500, width=600, height=400");
}
function whatsappShare(url, title) {
    message = title + " " + url;
    window.open("https://api.whatsapp.com/send?text=" + message);
}
</script>
@endsection