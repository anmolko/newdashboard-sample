<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[
            'title'             => $request->input('title'),
            'slug'              => $request->input('slug'),
            'description'       => $request->input('description'),
            'status'            => $request->input('status'),
            'blog_category_id'  => $request->input('blog_category_id'),
            'created_by'        => Auth::user()->id,
        ];

        if(!empty($request->file('image'))){
            $image          = $request->file('image');
            $name           = uniqid().'_'.$image->getClientOriginalName();
            $thumb          = 'thumb_'.$name;
            $path           = base_path().'/public/images/blog/';
            $thumb_path     = base_path().'/public/images/blog/thumb/';
            $moved          = Image::make($image->getRealPath())->resize(1280, 720)->orientate()->save($path.$name);
            $thumb          = Image::make($image->getRealPath())->resize(80, 80)->orientate()->save($thumb_path.$thumb);

            if ($moved && $thumb){
                $data['image']=$name;
            }
        }

        $blog = Blog::create($data);
        if($blog){
            Session::flash('success','Your Post was Created Successfully');
        }
        else{
            Session::flash('error','Your Post Creation Failed');
        }
       
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit   = Blog::find($id);
        return response()->json($edit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog                      =  Blog::find($id);
        $blog->title               =  $request->input('title');
        $blog->slug                =  $request->input('slug');
        $blog->description         =  $request->input('description');
        $blog->status              =  $request->input('status');
        $blog->blog_category_id    =  $request->input('blog_category_id');
        $blog->updated_by          = Auth::user()->id;

        $oldimage                  = $blog->image;
        $thumbimage                = 'thumb_'.$blog->image;

        if (!empty($request->file('image'))){
            $image       = $request->file('image');
            $name1       = uniqid().'_'.$image->getClientOriginalName();
            $thumb       = 'thumb_'.$name1;
            $path        = base_path().'/public/images/blog/';
            $thumb_path  = base_path().'/public/images/blog/thumb/';
            $moved       = Image::make($image->getRealPath())->resize(1280, 720)->orientate()->save($path.$name1);
            $thumb       = Image::make($image->getRealPath())->resize(80, 80)->orientate()->save($thumb_path.$thumb);

            if ($moved && $thumb){
                $blog->image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/blog/'.$oldimage)){
                    @unlink(public_path().'/images/blog/'.$oldimage);
                }
                if (!empty($thumbimage) && file_exists(public_path().'/images/blog/thumb/'.$thumbimage)){
                    @unlink(public_path().'/images/blog/thumb/'.$thumbimage);
                }
            }
        }

        $status = $blog->update();
        if($status){
            Session::flash('success','Your Post was updated successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Your Post could not be Updated');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteblog      = Blog::find($id);
        $blogid          = $deleteblog->id;
        $menuitems       = MenuItem::where('blog_id',$blogid)->get();
        $menuname        = [];

        if(count($menuitems)>0){
            foreach ($menuitems as $items){
                $menu  = Menu::find($items->menu_id);
                array_push($menuname,ucwords($menu->name));
            }
            $status = 'Warning';
            return response(['status'=>$status,'message'=>'This blog is attached to menu(s). Please remove menu item first to delete this blog.','name'=>$menuname]);
        }
        $thumbimage      = "thumb_".$deleteblog->image;
        if (!empty($deleteblog->image) && file_exists(public_path().'/images/blog/'.$deleteblog->image)){
            @unlink(public_path().'/images/blog/'.$deleteblog->image);
        }
        if (!empty($thumbimage) && file_exists(public_path().'/images/blog/thumb/'.$thumbimage)){
            @unlink(public_path().'/images/blog/thumb/'.$thumbimage);
        }
        $deleteblog->delete();
        return '#blog';
    }

    public function updateStatus(Request $request, $id){
        $blog          = Blog::find($id);
        $blog->status  = $request->status;
        $status        = $blog->update();
        if($status){
            $confirmed = "yes";
        }
        else{
            $confirmed = "no";
        }
        return response()->json($confirmed);
    }
}
