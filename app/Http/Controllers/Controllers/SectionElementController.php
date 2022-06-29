<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\SectionElement;
use App\Models\SectionGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Null_;


class SectionElementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $photos_path;

    public function __construct()
    {
        $this->middleware('auth');
        $this->photos_path   = public_path('/images/uploads/section_elements/gallery');
        $this->photos_path_2 = public_path('/images/uploads/section_elements/gallery_2');
    }


    public function index()
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $page_section = PageSection::with('page')->where('page_id', $id)->get();
        $sections      = array();
        $list_1        = "";
        $list_2        = "";
        $list_3        = "";
        $list_4        = "";
        $process_num   = "";
        $basic_elements = "";
        $map_descp = "";
        $slider_type = "";
        $call1_elements = "";
        $call2_elements = "";
        $bgimage_elements = "";
        $flash_elements = "";
        $header_descp_elements = "";
        $video_descp_elements = "";
        $gallery_elements = "";
        $location_map = "";
        $gallery2_elements = "";
        $contact_info_elements = "";
        $video_section_elements = "";
        $accordian1_elements = "";
        $accordian2_elements = "";
        $slider_list_elements = "";
        $icon_title_elements = "";
        $process_elements = "";
        foreach ($page_section as $section){
            $sections[$section->id] = $section->section_slug;
            if($section->section_slug == 'basic_section'){
                $basic_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->first();
            } else if($section->section_slug == 'location_and_map'){
                $location_map = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->first();
            } else if($section->section_slug == 'map_and_description'){
                $map_descp = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->first();
            }
            else if ($section->section_slug == 'call_to_action_1'){
                $call1_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->first();
            }
            else if ($section->section_slug == 'video_section'){
                $video_section_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->get();
            } else if ($section->section_slug == 'video_and_description'){
                $video_descp_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->first();
            }
            else if ($section->section_slug == 'call_to_action_2'){
                $call2_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->first();
            }
            else if ($section->section_slug == 'background_image_section'){
                $bgimage_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->get();
            }
            else if ($section->section_slug == 'flash_cards'){
                $flash_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->get();
            }
            else if ($section->section_slug == 'simple_header_and_description'){
                $header_descp_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->first();
            }
            else if ($section->section_slug == 'accordion_section_1'){
                $list_1 = $section->list_number_1;
                $accordian1_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->get();
            }
            else if ($section->section_slug == 'accordion_section_2'){
                $list_2 = $section->list_number_2;
                $accordian2_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->get();
            }
            else if ($section->section_slug == 'gallery_section'){
                $gallery_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->first();
            }
            else if ($section->section_slug == 'gallery_section_2'){
                $gallery2_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->first();
            }
            else if ($section->section_slug == 'contact_information'){
                $contact_info_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->first();
            }

            else if ($section->section_slug == 'slider_list'){
                $list_3      = $section->list_number_3;
                $slider_type = $section->list_number_1;
                $slider_list_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->get();
            }
            else if ($section->section_slug == 'icon_and_title'){
                $list_4 = $section->list_number_4;
                $icon_title_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->get();
            }
            else if ($section->section_slug == 'process_selection'){
                $process_num = $section->list_number_3;
                $process_elements = SectionElement::with('section')
                    ->where('page_section_id', $section->id)
                    ->get();
            }
        }


        return view('backend.pages.section_elements.create',compact( 'sections','process_num','process_elements','slider_type','map_descp','icon_title_elements','list_4','location_map','video_descp_elements','video_section_elements','list_1','list_2','list_3','basic_elements','call1_elements','gallery2_elements','bgimage_elements','call2_elements','flash_elements','gallery_elements','header_descp_elements','accordian1_elements','accordian2_elements','slider_list_elements','contact_info_elements','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section_name = $request->input('section_name');
        $section_id   = $request->input('page_section_id');
        if($section_name == 'basic_section'){
            $data=[
                'heading'                => $request->input('heading'),
                'page_section_id'        => $section_id,
                'subheading'             => $request->input('subheading'),
                'list_image'             => $request->input('list_image'),
                'description'            => $request->input('description'),
                'list_header'            => $request->input('list_header'),
                'list_description'       => $request->input('list_description'),
                'extra_description'      => $request->input('extra_description'),
                'button'                 => $request->input('button'),
                'button_link'            => $request->input('button_link'),
                'created_by'             => Auth::user()->id,
            ];
            if(!empty($request->file('image'))){
                $image        = $request->file('image');
                $name         = uniqid().'_basic_'.$image->getClientOriginalName();
                $path         = base_path().'/public/images/uploads/section_elements/basic_section/';
                $moved        = Image::make($image->getRealPath())->fit(710, 695)->orientate()->save($path.$name);
                if ($moved){
                    $data['image']= $name;
                }
            }
            $status = SectionElement::create($data);
        }
        else if($section_name == 'map_and_description'){
            $data=[
                'heading'                => $request->input('heading'),
                'page_section_id'        => $section_id,
                'description'            => $request->input('description'),
                'button'                 => $request->input('button'),
                'button_link'            => $request->input('button_link'),
                'created_by'             => Auth::user()->id,
            ];
            $status = SectionElement::create($data);
        }
        elseif($section_name == 'video_and_description'){
            $data=[
                'heading'                => $request->input('heading'),
                'page_section_id'        => $section_id,
                'list_header'            => $request->input('list_header'),
                'list_description'       => $request->input('list_description'),
                'description'            => $request->input('description'),
                'button'                 => $request->input('button'),
                'button_link'            => $request->input('button_link'),
                'created_by'             => Auth::user()->id,
            ];
            $status = SectionElement::create($data);
        }
        elseif ($section_name == 'video_section'){
            $type = count($request->input('heading'));
            for ($i=0;$i<$type;$i++){
                $data=[
                    'header'                 => $request->input('heading')[$i],
                    'page_section_id'        => $section_id,
                    'description'            => $request->input('description')[$i],
                    'created_by'             => Auth::user()->id,
                ];
                $status = SectionElement::create($data);
            }
        }
        elseif ($section_name == 'call_to_action_1'){
            $data=[
                'page_section_id'        => $section_id,
                'description'            => $request->input('description'),
                'button'                 => $request->input('button'),
                'button_link'            => $request->input('button_link'),
                'created_by'             => Auth::user()->id,
            ];
            $status = SectionElement::create($data);
        }
        elseif ($section_name == 'location_and_map'){
            $data=[
                'page_section_id'        => $section_id,
                'description'            => $request->input('description'),
                'created_by'             => Auth::user()->id,
            ];
            $status = SectionElement::create($data);
        }
        elseif ($section_name == 'call_to_action_2'){
            $data=[
                'page_section_id'        => $section_id,
                'subheading'             => $request->input('subheading'),
                'description'            => $request->input('description'),
                'button'                 => $request->input('button'),
                'button_link'            => $request->input('button_link'),
                'created_by'             => Auth::user()->id,
            ];
            $status = SectionElement::create($data);
        }
        elseif ($section_name == 'background_image_section'){
            for ($i=0;$i<3;$i++){
                $heading =  (array_key_exists($i, $request->input('heading')) ?  $request->input('heading')[$i]: Null);
                $subheading =  ( array_key_exists($i, $request->input('subheading')) ?  $request->input('subheading')[$i]: Null);
                $data=[
                    'heading'                => $heading,
                    'subheading'             => $subheading,
                    'list_header'            => $request->input('list_header')[$i],
                    'page_section_id'        => $section_id,
                    'list_description'       => $request->input('list_description')[$i],
                    'created_by'             => Auth::user()->id,
                ];

                if($request->file('image') !== null) {
                    if (array_key_exists($i, $request->file('image'))) {
                        $image = $request->file('image')[0];
                        $name = uniqid() . '__background__' . $image->getClientOriginalName();
                        $path = base_path() . '/public/images/uploads/section_elements/bgimage_section/';
                        $moved = Image::make($image->getRealPath())->resize(1920, 800)->orientate()->save($path . $name);
                        if ($moved) {
                            $data['image'] = $name;
                        }

                    }
                }

                $status = SectionElement::create($data);
            }

        }
        elseif ($section_name == 'flash_cards'){
            for ($i=0;$i<3;$i++){
                $data=[
                    'list_header'            => $request->input('list_header')[$i],
                    'page_section_id'        => $section_id,
                    'list_description'       => $request->input('list_description')[$i],
                    'created_by'             => Auth::user()->id,
                ];
                $status = SectionElement::create($data);
            }
        }
        elseif ($section_name == 'simple_header_and_description'){
            $data=[
                'page_section_id'        => $section_id,
                'heading'                => $request->input('heading'),
                'subheading'             => $request->input('subheading'),
                'description'            => $request->input('description'),
                'created_by'             => Auth::user()->id,
            ];
            $status = SectionElement::create($data);
        }
        elseif ($section_name == 'accordion_section_1'){
            $list1_num   = $request->input('list_number_1');
            for ($i=0;$i<$list1_num;$i++){
                $heading     =  (array_key_exists($i, $request->input('heading')) ?  $request->input('heading')[$i]: Null);
                $subheading  =  (array_key_exists($i, $request->input('subheading')) ?  $request->input('subheading')[$i]: Null);
                $description =  (array_key_exists($i, $request->input('description')) ?  $request->input('description')[$i]: Null);
                $data=[
                    'heading'               => $heading,
                    'subheading'            => $subheading,
                    'description'           => $description,
                    'page_section_id'       => $section_id,
                    'list_header'           => $request->input('list_header')[$i],
                    'list_description'      => $request->input('list_description')[$i],
                    'created_by'            => Auth::user()->id,
                ];
                $status = SectionElement::create($data);
            }
        }
        elseif ($section_name == 'accordion_section_2'){
                $list2_num   = $request->input('list_number_2');
                for ($i=0;$i<$list2_num;$i++){
                    $heading     =  (array_key_exists($i, $request->input('heading')) ?  $request->input('heading')[$i]: Null);
                    $subheading  =  (array_key_exists($i, $request->input('subheading')) ?  $request->input('subheading')[$i]: Null);
                    $description =  (array_key_exists($i, $request->input('description')) ?  $request->input('description')[$i]: Null);
                    $data=[
                        'heading'               => $heading,
                        'subheading'            => $subheading,
                        'description'           => $description,
                        'page_section_id'       => $section_id,
                        'list_header'           => $request->input('list_header')[$i],
                        'list_description'      => $request->input('list_description')[$i],
                        'created_by'            => Auth::user()->id,
                    ];
                    $status = SectionElement::create($data);
                }
        }
        elseif ($section_name == 'slider_list'){
            $list3_num   = $request->input('list_number_3');
            for ($i=0;$i<$list3_num;$i++){
                $heading     =  (array_key_exists($i, $request->input('heading')) ?  $request->input('heading')[$i]: Null);
                $subheading  =  (array_key_exists($i, $request->input('description')) ?  $request->input('description')[$i]: Null);
                $data=[
                    'heading'               => $heading,
                    'description'           => $subheading,
                    'list_header'           => $request->input('list_header')[$i],
                    'subheading'            => $request->input('subheading')[$i],
                    'page_section_id'       => $section_id,
                    'list_description'      => $request->input('list_description')[$i],
                    'button'                => $request->input('button')[$i],
                    'button_link'           => $request->input('button_link')[$i],
                    'created_by'            => Auth::user()->id,
                ];
                if (array_key_exists($i,$request->file('list_image'))){
                    $image        = $request->file('list_image')[$i];
                    $name         = uniqid().'_list1_'.$image->getClientOriginalName();
                    $thumb        = 'thumb_'.$name;
                    $path         = base_path().'/public/images/uploads/section_elements/list_1/';
                    $thumb_path   = base_path().'/public/images/uploads/section_elements/list_1/thumb/';
                    $moved        = Image::make($image->getRealPath())->fit(1170, 600)->orientate()->save($path.$name);
                    $thumb        = Image::make($image->getRealPath())->fit(768, 510)->orientate()->save($thumb_path.$thumb);
                    if ($moved && $thumb){
                        $data['list_image']= $name;
                    }
                }
                $status = SectionElement::create($data);
            }
        }
        elseif ($section_name == 'icon_and_title'){
            $list4_num   = $request->input('list_number_4');
            for ($i=0;$i<$list4_num;$i++){
                $heading     =  (array_key_exists($i, $request->input('heading')) ?  $request->input('heading')[$i]: Null);
                $subheading  =  (array_key_exists($i, $request->input('description')) ?  $request->input('description')[$i]: Null);
                $data=[
                    'heading'               => $heading,
                    'description'           => $subheading,
                    'list_header'           => $request->input('list_header')[$i],
                    'list_description'      => ($request->input('list_description')[$i] !== null) ? $request->input('list_description')[$i]:Null,
                    'page_section_id'       => $section_id,
                    'created_by'            => Auth::user()->id,
                ];
                if (array_key_exists($i,$request->file('list_image'))){
                    $image        = $request->file('list_image')[$i];
                    $name         = uniqid().'_icon_title_'.$image->getClientOriginalName();
                    $path         = base_path().'/public/images/uploads/section_elements/list_1/';
                    $moved        = Image::make($image->getRealPath())->resize(128, 128)->orientate()->save($path.$name);
                    if ($moved){
                        $data['list_image']= $name;
                    }
                }
                $status = SectionElement::create($data);
            }
        }

        elseif ($section_name == 'contact_information'){
            $data=[
                'page_section_id'        => $section_id,
                'heading'                => $request->input('heading'),
                'subheading'             => $request->input('subheading'),
                'description'            => $request->input('description'),
                'list_description'       => $request->input('list_description'),
                'created_by'             => Auth::user()->id,
            ];
            $status = SectionElement::create($data);
        }
        elseif ($section_name == 'process_selection'){
            $process_num   = $request->input('list_number_3_process_num');
            for ($i=0;$i<$process_num;$i++){
                $data=[
                    'list_header'           => $request->input('list_header')[$i],
                    'page_section_id'       => $section_id,
                    'list_description'      => $request->input('list_description')[$i],
                    'created_by'            => Auth::user()->id,
                ];
                if (array_key_exists($i,$request->file('list_image'))){
                    $image        = $request->file('list_image')[$i];
                    $name         = uniqid().'_process_list_'.$image->getClientOriginalName();
                    $path         = base_path().'/public/images/uploads/section_elements/list_1/';
                    $moved        = Image::make($image->getRealPath())->fit(510, 215)->orientate()->save($path.$name);
                    if ($moved){
                        $data['list_image']= $name;
                    }

                }
                $status = SectionElement::create($data);
            }
        }


        if($status){
            $response = 'successfully created';
        }
        else{
            $response = 'error';
        }
        return response()->json($response);
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
        //
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
        $section_name = $request->input('section_name');
        $section_id   = $request->input('page_section_id');

        if($section_name == 'basic_section'){
            $basic                      = SectionElement::find($id);
            $basic->heading             = $request->input('heading');
            $basic->page_section_id     = $section_id;
            $basic->subheading          = $request->input('subheading');
            $basic->list_image          = $request->input('list_image');
            $basic->description         = $request->input('description');
            $basic->list_header         = $request->input('list_header');
            $basic->list_description    = $request->input('list_description');
            $basic->extra_description   = $request->input('extra_description');
            $basic->button              = $request->input('button');
            $basic->button_link         = $request->input('button_link');
            $basic->updated_by          = Auth::user()->id;
            $oldimage                   = $basic->image;

            if (!empty($request->file('image'))){
                $image                = $request->file('image');
                $name                 = uniqid().'_basic_'.$image->getClientOriginalName();
                $path                 = base_path().'/public/images/uploads/section_elements/basic_section/';
                $moved                = Image::make($image->getRealPath())->fit(710, 695)->orientate()->save($path.$name);
                if ($moved){
                    $basic->image = $name;
                    if (!empty($oldimage) && file_exists(public_path().'/images/uploads/section_elements/basic_section/'.$oldimage)){
                        @unlink(public_path().'/images/uploads/section_elements/basic_section/'.$oldimage);
                    }
                }
            }
            $status = $basic->update();
        }
        elseif($section_name == 'video_and_description'){
            $video                      = SectionElement::find($id);
            $video->heading             = $request->input('heading');
            $video->page_section_id     = $section_id;
            $video->list_header         = $request->input('list_header');
            $video->list_description    = $request->input('list_description');
            $video->description         = $request->input('description');
            $video->button              = $request->input('button');
            $video->button_link         = $request->input('button_link');
            $video->updated_by          = Auth::user()->id;
            $status = $video->update();
        }
        elseif($section_name == 'map_and_description'){
            $map                      = SectionElement::find($id);
            $map->heading             = $request->input('heading');
            $map->page_section_id     = $section_id;
            $map->description         = $request->input('description');
            $map->button              = $request->input('button');
            $map->button_link         = $request->input('button_link');
            $map->updated_by          = Auth::user()->id;
            $status = $map->update();
        }
        elseif ($section_name == 'call_to_action_1'){
            $action                      = SectionElement::find($id);
            $action->page_section_id     = $section_id;
            $action->description         = $request->input('description');
            $action->button              = $request->input('button');
            $action->button_link         = $request->input('button_link');
            $action->updated_by          = Auth::user()->id;
            $status                      = $action->update();

        }
        elseif ($section_name == 'call_to_action_2'){
            $action                      = SectionElement::find($id);
            $action->page_section_id     = $section_id;
            $action->subheading          = $request->input('subheading');
            $action->description         = $request->input('description');
            $action->button              = $request->input('button');
            $action->button_link         = $request->input('button_link');
            $action->updated_by          = Auth::user()->id;
            $status                      = $action->update();

        }
        elseif ($section_name == 'location_and_map'){
            $action                      = SectionElement::find($id);
            $action->page_section_id     = $section_id;
            $action->description         = $request->input('description');
            $action->updated_by          = Auth::user()->id;
            $status                      = $action->update();
        }
        elseif ($section_name == 'simple_header_and_description'){
            $header                      = SectionElement::find($id);
            $header->page_section_id     = $section_id;
            $header->heading             = $request->input('heading');
            $header->subheading          = $request->input('subheading');
            $header->description         = $request->input('description');
            $header->updated_by          = Auth::user()->id;
            $status                      = $header->update();
        }
        elseif ($section_name == 'contact_information'){
            $header                      = SectionElement::find($id);
            $header->page_section_id     = $section_id;
            $header->heading             = $request->input('heading');
            $header->subheading          = $request->input('subheading');
            $header->description         = $request->input('description');
            $header->list_description    = $request->input('list_description');
            $header->updated_by          = Auth::user()->id;
            $status                      = $header->update();
        }

        if($status){
            $response = 'successfully updated';
        }
        else{
            $response = 'error';
        }
        return response()->json($response);
    }

    public function tablistUpdate(Request $request)
    {
        $section_name       = $request->input('section_name');
        $section_id         = $request->input('page_section_id');

        if($section_name == 'background_image_section'){

            for ($i=0;$i<3;$i++){
                $heading =  (array_key_exists($i, $request->input('heading')) ?  $request->input('heading')[$i]: Null);
                $subheading =  ( array_key_exists($i, $request->input('subheading')) ?  $request->input('subheading')[$i]: Null);

                $bgsection                    = SectionElement::find($request->input('id')[$i]);
                $bgsection->heading           = $heading;
                $bgsection->subheading        = $subheading;
                $bgsection->list_header       = $request->input('list_header')[$i];
                $bgsection->page_section_id   = $section_id;
                $bgsection->list_description  = $request->input('list_description')[$i];
                $bgsection->updated_by        = Auth::user()->id;
                $oldimage                     = $bgsection->image;

                if($request->file('image') !== null){
                    if (array_key_exists($i,$request->file('image'))){
                        $image        = $request->file('image')[$i];
                        $name         = uniqid().'_background_'.$image->getClientOriginalName();
                        $path         = base_path().'/public/images/uploads/section_elements/bgimage_section/';
                        $moved        = Image::make($image->getRealPath())->resize(1920, 800)->orientate()->save($path.$name);
                        if ($moved){
                            $bgsection->image = $name;
                            if (!empty($oldimage) && file_exists(public_path().'/images/uploads/section_elements/bgimage_section/'.$oldimage)){
                                @unlink(public_path().'/images/uploads/section_elements/bgimage_section/'.$oldimage);
                            }
                        }

                    }

                }
                $status = $bgsection->update();
            }

        }
        elseif ($section_name == 'flash_cards') {
            for ($i=0;$i<3;$i++){
                $flash                   = SectionElement::find($request->input('id')[$i]);
                $flash->list_header      = $request->input('list_header')[$i];
                $flash->page_section_id  = $section_id;
                $flash->list_description = $request->input('list_description')[$i];
                $flash->updated_by       = Auth::user()->id;
                $status                  = $flash->update();
            }

        }
        elseif ($section_name == 'video_section') {
            $type = count($request->input('heading'));
            $db_elements     = json_decode($request->input('video_elements'),true);
            $db_elements_id  = array_map(function($item){ return $item['id']; }, $db_elements);
            for ($i=0;$i<$type;$i++){
                if($request->input('id')[$i] == null){
                    $data=[
                        'heading'               => $request->input('heading')[$i],
                        'description'           => $request->input('description')[$i],
                        'page_section_id'       => $section_id,
                        'created_by'            => Auth::user()->id,
                    ];
                    $status = SectionElement::create($data);
                }
                else{
                    $video                      = SectionElement::find($request->input('id')[$i]);
                    $video->heading             = $request->input('heading')[$i];
                    $video->description         = $request->input('description')[$i];
                    $video->page_section_id     = $section_id;
                    $video->updated_by          = Auth::user()->id;
                    $status                     = $video->update();
                }
            }
            foreach ($db_elements_id as $key=>$value){
                if(!in_array($value,$request->input('id'))){
                    $delete_element = SectionElement::find($value);
                    $status         = $delete_element->delete();
                }
            }

        }
        elseif ($section_name == 'accordion_section_1') {
            $list1_num       = $request->input('list_number_1');
            $db_elements     = json_decode($request->input('accordion1_elements'),true);
            $db_elements_id  = array_map(function($item){ return $item['id']; }, $db_elements);

            for ($i=0;$i<$list1_num;$i++){
                $heading     =  (array_key_exists($i, $request->input('heading')) ?  $request->input('heading')[$i]: Null);
                $subheading  =  (array_key_exists($i, $request->input('subheading')) ?  $request->input('subheading')[$i]: Null);
                $description =  (array_key_exists($i, $request->input('description')) ?  $request->input('description')[$i]: Null);
                if($request->input('id')[$i] == null){
                    $data=[
                        'heading'               => $heading,
                        'subheading'            => $subheading,
                        'description'           => $description,
                        'page_section_id'       => $section_id,
                        'list_header'           => $request->input('list_header')[$i],
                        'list_description'      => $request->input('list_description')[$i],
                        'created_by'            => Auth::user()->id,
                    ];
                    $status = SectionElement::create($data);
                }
                else{
                    $accordian1                      = SectionElement::find($request->input('id')[$i]);
                    $accordian1->heading             = $heading;
                    $accordian1->subheading          = $subheading;
                    $accordian1->description         = $description;
                    $accordian1->page_section_id     = $section_id;
                    $accordian1->list_header         = $request->input('list_header')[$i];
                    $accordian1->list_description    = $request->input('list_description')[$i];
                    $accordian1->updated_by          = Auth::user()->id;
                    $status                          = $accordian1->update();

                }
            }
            foreach ($db_elements_id as $key=>$value){
                if(!in_array($value,$request->input('id'))){
                    $delete_element = SectionElement::find($value);
                    $status         = $delete_element->delete();
                }
            }

        }
        elseif ($section_name == 'accordion_section_2') {
            $list2_num       = $request->input('list_number_2');
            $db_elements     = json_decode($request->input('accordion2_elements'),true);
            $db_elements_id  = array_map(function($item){ return $item['id']; }, $db_elements);

            for ($i=0;$i<$list2_num;$i++) {
                $heading     =  (array_key_exists($i, $request->input('heading')) ?  $request->input('heading')[$i]: Null);
                $subheading  =  (array_key_exists($i, $request->input('subheading')) ?  $request->input('subheading')[$i]: Null);
                $description =  (array_key_exists($i, $request->input('description')) ?  $request->input('description')[$i]: Null);
                if($request->input('id')[$i] == null){
                    $data=[
                        'heading'               => $heading,
                        'subheading'            => $subheading,
                        'description'           => $description,
                        'page_section_id'       => $section_id,
                        'list_header'           => $request->input('list_header')[$i],
                        'list_description'      => $request->input('list_description')[$i],
                        'created_by'            => Auth::user()->id,
                    ];
                    $status = SectionElement::create($data);
                }
                else{
                    $accordian2                      = SectionElement::find($request->input('id')[$i]);
                    $accordian2->heading             = $heading;
                    $accordian2->subheading          = $subheading;
                    $accordian2->description         = $description;
                    $accordian2->page_section_id     = $section_id;
                    $accordian2->list_header         = $request->input('list_header')[$i];
                    $accordian2->list_description    = $request->input('list_description')[$i];
                    $accordian2->updated_by          = Auth::user()->id;
                    $status                          = $accordian2->update();
                }
            }

            foreach ($db_elements_id as $key=>$value){
                if(!in_array($value,$request->input('id'))){
                    $delete_element = SectionElement::find($value);
                    $status         = $delete_element->delete();
                }
            }
        }
        elseif ($section_name == 'slider_list') {
            $list3_num   = $request->input('list_number_3');
            $db_elements     = json_decode($request->input('slider_list_elements'),true);
            $db_elements_id  = array_map(function($item){ return $item['id']; }, $db_elements);
            for ($i=0;$i<$list3_num;$i++) {
                $heading     =  (array_key_exists($i, $request->input('heading')) ?  $request->input('heading')[$i]: Null);
                $subheading  =  (array_key_exists($i, $request->input('description')) ?  $request->input('description')[$i]: Null);
                if($request->input('id')[$i] == null){
                    $data=[
                        'heading'               => $heading,
                        'description'           => $subheading,
                        'list_header'           => $request->input('list_header')[$i],
                        'page_section_id'       => $section_id,
                        'subheading'            => $request->input('subheading')[$i],
                        'list_description'      => $request->input('list_description')[$i],
                        'button'                => $request->input('button')[$i],
                        'button_link'           => $request->input('button_link')[$i],
                        'created_by'            => Auth::user()->id,
                    ];
                    if (array_key_exists($i,$request->file('list_image'))){
                        $image        = $request->file('list_image')[$i];
                        $name         = uniqid().'_list1_'.$image->getClientOriginalName();
                        $thumb        = 'thumb_'.$name;
                        $path         = base_path().'/public/images/uploads/section_elements/list_1/';
                        $thumb_path   = base_path().'/public/images/uploads/section_elements/list_1/thumb/';
                        $moved        = Image::make($image->getRealPath())->fit(1170, 600)->orientate()->save($path.$name);
                        $thumb        = Image::make($image->getRealPath())->fit(768, 510)->orientate()->save($thumb_path.$thumb);
                        if ($moved && $thumb){
                            $data['list_image']= $name;
                        }
                    }
                    $status = SectionElement::create($data);
                }
                else{
                    $sliderlist                      = SectionElement::find($request->input('id')[$i]);
                    $sliderlist->heading             = $heading;
                    $sliderlist->description         = $subheading;
                    $sliderlist->list_header         = $request->input('list_header')[$i];
                    $sliderlist->page_section_id     = $section_id;
                    $sliderlist->subheading          = $request->input('subheading')[$i];
                    $sliderlist->list_description    = $request->input('list_description')[$i];
                    $sliderlist->button              = $request->input('button')[$i];
                    $sliderlist->button_link         = $request->input('button_link')[$i];
                    $sliderlist->updated_by          = Auth::user()->id;
                    $oldimage                        = $sliderlist->list_image;
                    $thumbimage                      = 'thumb_'.$sliderlist->list_image;

                    if($request->file('list_image') !== null){
                        if (array_key_exists($i,$request->file('list_image'))){
                            $image        = $request->file('list_image')[$i];
                            $name         = uniqid().'_list1_'.$image->getClientOriginalName();
                            $thumb        = 'thumb_'.$name;
                            $path         = base_path().'/public/images/uploads/section_elements/list_1/';
                            $thumb_path   = base_path().'/public/images/uploads/section_elements/list_1/thumb/';
                            $moved        = Image::make($image->getRealPath())->fit(1170, 600)->orientate()->save($path.$name);
                            $thumb        = Image::make($image->getRealPath())->fit(768, 510)->orientate()->save($thumb_path.$thumb);

                            if ($moved){
                                $sliderlist->list_image = $name;
                                if (!empty($oldimage) && file_exists(public_path().'/images/uploads/section_elements/list_1/'.$oldimage)){
                                    @unlink(public_path().'/images/uploads/section_elements/list_1/'.$oldimage);
                                }
                                if (!empty($thumbimage) && file_exists(public_path().'/images/uploads/section_elements/list_1/thumb/'.$thumbimage)){
                                    @unlink(public_path().'/images/uploads/section_elements/list_1/thumb/'.$thumbimage);
                                }
                            }
                        }
                    }
                    $status = $sliderlist->update();
                }
            }


            foreach ($db_elements_id as $key=>$value){
                if(!in_array($value,$request->input('id'))){
                    $delete_element = SectionElement::find($value);
                    if (!empty($delete_element->list_image) && file_exists(public_path().'/images/uploads/section_elements/list_1/'.$delete_element->list_image)){
                        @unlink(public_path().'/images/uploads/section_elements/list_1/'.$delete_element->list_image);
                    }
                    $status        = $delete_element->delete();
                }
            }

        }
        elseif ($section_name == 'icon_and_title') {
            $list4_num   = $request->input('list_number_4');
            $db_elements     = json_decode($request->input('icon_title_elements'),true);
            $db_elements_id  = array_map(function($item){ return $item['id']; }, $db_elements);

            for ($i=0;$i<$list4_num;$i++) {
                $heading     =  (array_key_exists($i, $request->input('heading')) ?  $request->input('heading')[$i]: Null);
                $subheading  =  (array_key_exists($i, $request->input('description')) ?  $request->input('description')[$i]: Null);

                if($request->input('id')[$i] == null){
                    $data=[
                        'heading'               => $heading,
                        'description'           => $subheading,
                        'list_header'           => $request->input('list_header')[$i],
                        'list_description'      => ($request->input('list_description')[$i] !== null) ? $request->input('list_description')[$i]:Null,
                        'page_section_id'       => $section_id,
                        'created_by'            => Auth::user()->id,
                    ];
                    if (array_key_exists($i,$request->file('list_image'))){
                        $image        = $request->file('list_image')[$i];
                        $name         = uniqid().'_icon_title_'.$image->getClientOriginalName();
                        $path         = base_path().'/public/images/uploads/section_elements/list_1/';
                        $moved        = Image::make($image->getRealPath())->resize(128, 128)->orientate()->save($path.$name);
                        if ($moved){
                            $data['list_image']= $name;
                        }
                    }
                    $status = SectionElement::create($data);
                }
                else{
                    $icontitle                      = SectionElement::find($request->input('id')[$i]);
                    $icontitle->heading             = $heading;
                    $icontitle->description         = $subheading;
                    $icontitle->list_header         = $request->input('list_header')[$i];
                    $icontitle->list_description    = ($request->input('list_description')[$i] !== null) ? $request->input('list_description')[$i]:Null;
                    $icontitle->page_section_id     = $section_id;
                    $icontitle->updated_by          = Auth::user()->id;
                    $oldimage                       = $icontitle->list_image;
                    if($request->file('list_image') !== null){
                        if (array_key_exists($i,$request->file('list_image'))){
                            $image        = $request->file('list_image')[$i];
                            $name         = uniqid().'_icon_title_'.$image->getClientOriginalName();
                            $path         = base_path().'/public/images/uploads/section_elements/list_1/';
                            $moved        = Image::make($image->getRealPath())->resize(128, 128)->orientate()->save($path.$name);

                            if ($moved){
                                $icontitle->list_image = $name;
                                if (!empty($oldimage) && file_exists(public_path().'/images/uploads/section_elements/list_1/'.$oldimage)){
                                    @unlink(public_path().'/images/uploads/section_elements/list_1/'.$oldimage);
                                }
                            }
                        }
                    }
                    $status = $icontitle->update();
                }
            }


            foreach ($db_elements_id as $key=>$value){
                if(!in_array($value,$request->input('id'))){
                    $delete_element = SectionElement::find($value);
                    if (!empty($delete_element->list_image) && file_exists(public_path().'/images/uploads/section_elements/list_1/'.$delete_element->list_image)){
                        @unlink(public_path().'/images/uploads/section_elements/list_1/'.$delete_element->list_image);
                    }
                    $status        = $delete_element->delete();
                }
            }

        }
        elseif ($section_name == 'process_selection') {
            $process_num       = $request->input('list_number_3_process_num');
            $db_elements     = json_decode($request->input('process_list_elements'),true);
            $db_elements_id  = array_map(function($item){ return $item['id']; }, $db_elements);
            for ($i=0;$i<$process_num;$i++) {
                if($request->input('id')[$i] == null){
                    $data=[
                        'list_header'           => $request->input('list_header')[$i],
                        'page_section_id'       => $section_id,
                        'list_description'      => $request->input('list_description')[$i],
                        'created_by'            => Auth::user()->id,
                    ];
                    if (array_key_exists($i,$request->file('list_image'))){
                        $image        = $request->file('list_image')[$i];
                        $name         = uniqid().'_process_list_'.$image->getClientOriginalName();
                        $path         = base_path().'/public/images/uploads/section_elements/list_1/';
                        $moved        = Image::make($image->getRealPath())->fit(510, 215)->orientate()->save($path.$name);
                        if ($moved){
                            $data['list_image']= $name;
                        }
                    }
                    $status = SectionElement::create($data);
                }
                else{
                    $process                      = SectionElement::find($request->input('id')[$i]);
                    $process->list_header         = $request->input('list_header')[$i];
                    $process->page_section_id     = $section_id;
                    $process->list_description    = $request->input('list_description')[$i];
                    $process->updated_by          = Auth::user()->id;
                    $oldimage                     = $process->list_image;
                    if($request->file('list_image') !== null){
                        if (array_key_exists($i,$request->file('list_image'))){
                            $image        = $request->file('list_image')[$i];
                            $name         = uniqid().'_process_list_'.$image->getClientOriginalName();
                            $path         = base_path().'/public/images/uploads/section_elements/list_1/';
                            $moved        = Image::make($image->getRealPath())->fit(510, 215)->orientate()->save($path.$name);
                            if ($moved){
                                $process->list_image = $name;
                                if (!empty($oldimage) && file_exists(public_path().'/images/uploads/section_elements/list_1/'.$oldimage)){
                                    @unlink(public_path().'/images/uploads/section_elements/list_1/'.$oldimage);
                                }
                            }
                        }
                    }
                    $status = $process->update();
                }
            }
            foreach ($db_elements_id as $key=>$value){
                if(!in_array($value,$request->input('id'))){
                    $deleteelement = SectionElement::find($value);
                    if (!empty($deleteelement->list_image) && file_exists(public_path().'/images/uploads/section_elements/list_1/'.$deleteelement->list_image)){
                        @unlink(public_path().'/images/uploads/section_elements/list_1/'.$deleteelement->list_image);
                    }
                    $status        = $deleteelement->delete();
                }
            }

        }


        if($status){
            $response = 'successfully updated';
        }
        else{
            $response = 'error';
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadGallery(Request $request,$id)
    {
        $page_section                 =  PageSection::with('page')->find($id);
        if($page_section==null || $page_section=="null"){

             return Response::json([
                'message' => 'Page Section ID Not Found'
            ], 400);
        }

        $photos = $request->file('file');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path, 0777);
        }


        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];
            $name = $page_section->page->slug."_page_gallery_".date('YmdHis') . uniqid();
            $save_name = $name . '.' . $photo->getClientOriginalExtension();

            $resize_name = "Thumb_".$name . '.' . $photo->getClientOriginalExtension();

            Image::make($photo)
                ->orientate()
                // ->resize(500, 500)
                ->save($this->photos_path . '/' . $resize_name);

            $photo->move($this->photos_path, $save_name);

            $upload = new SectionGallery();
            $upload->page_section_id = $page_section->id;
            $upload->upload_by = Auth::user()->id;
            $upload->filename = $save_name;
            $upload->resized_name = $resize_name;
            $upload->original_name = basename($photo->getClientOriginalName());
            $upload->save();
        }

        return response()->json(['success'=>$save_name]);

    }

    public function uploadGallery2(Request $request,$id)
    {
        $page_section                 =  PageSection::with('page')->find($id);
        if($page_section==null || $page_section=="null"){

            return Response::json([
                'message' => 'Page Section ID Not Found'
            ], 400);
        }

        $photos = $request->file('file');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

        if (!is_dir($this->photos_path_2)) {
            mkdir($this->photos_path_2, 0777);
        }


        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];

            $name = $page_section->page->slug."_page_gallery_2_".date('YmdHis') . uniqid();
            $save_name = $name . '.' . $photo->getClientOriginalExtension();
            $resize_name = "Thumb_".$name . '.' . $photo->getClientOriginalExtension();

            Image::make($photo)
                ->orientate()
                // ->resize(600, 550)
                ->save($this->photos_path_2 . '/' . $resize_name);

            $photo->move($this->photos_path_2, $save_name);

            $upload                     = new SectionGallery();
            $upload->page_section_id    = $page_section->id;
            $upload->upload_by          = Auth::user()->id;
            $upload->filename           = $save_name;
            $upload->resized_name       = $resize_name;
            $upload->original_name      = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $upload->save();
        }
        return response()->json(['success'=>$save_name]);

    }

    public function deleteGallery(Request $request)
    {
        $filename = $request->get('filename');
        $uploaded_image = SectionGallery::where('filename', $filename)->first();

        if (empty($uploaded_image)) {
            return Response::json(['message' => 'Sorry file does not exist'], 400);
        }

        $file_path = $this->photos_path . '/' . $uploaded_image->filename;
        $resized_file = $this->photos_path . '/' . $uploaded_image->resized_name;

        if (file_exists($file_path)) {
            @unlink($file_path);
        }

        if (file_exists($resized_file)) {
            @unlink($resized_file);
        }

        if (!empty($uploaded_image)) {
            $uploaded_image->delete();
        }

        return Response::json(['success' => $filename], 200);
    }

    public function deleteGallery2(Request $request)
    {

        $filename       = $request->get('filename');
        $uploaded_image = SectionGallery::where('filename', $filename)->first();

        if (empty($uploaded_image)) {
            return Response::json(['message' => 'Sorry file does not exist'], 400);
        }

        $file_path = $this->photos_path_2 . '/' . $uploaded_image->filename;
        $resized_file = $this->photos_path_2 . '/' . $uploaded_image->resized_name;

        if (file_exists($file_path)) {
            @unlink($file_path);
        }

        if (file_exists($resized_file)) {
            @unlink($resized_file);
        }

        if (!empty($uploaded_image)) {
            $uploaded_image->delete();
        }

        return Response::json(['success' => $filename], 200);
    }

    public function getGallery(Request $request,$id)
    {
        $images = SectionGallery::where('page_section_id',$id)->get()->toArray();
        if (count($images) > 0){
            foreach($images as $image){
                $tableImages[] = $image['filename'];
            }
            $storeFolder = public_path('images/uploads/section_elements/gallery/');
            $file_path = public_path('images/uploads/section_elements/gallery/');
            $files = scandir($storeFolder);
            foreach ( $files as $file ) {
                if ($file !='.' && $file !='..' && in_array($file,$tableImages)) {
                    $obj['name'] = $file;
                    $file_path = public_path('images/uploads/section_elements/gallery/').$file;
                    $obj['size'] = filesize($file_path);
                    $obj['path'] = url('/images/uploads/section_elements/gallery/'.$file);
                    $data[] = $obj;
                }

            }
            return response()->json($data);
        }
    }

    public function getGallery2(Request $request,$id)
    {
        $images = SectionGallery::where('page_section_id',$id)->get()->toArray();

        if (count($images) > 0){
            foreach($images as $image){
                $tableImages[] = $image['filename'];
            }
            $storeFolder = public_path('images/uploads/section_elements/gallery_2/');
            $file_path = public_path('images/uploads/section_elements/gallery_2/');
            $files = scandir($storeFolder);
            foreach ( $files as $file ) {
                if ($file !='.' && $file !='..' && in_array($file,$tableImages)) {
                    $obj['name'] = $file;
                    $file_path = public_path('images/uploads/section_elements/gallery_2/').$file;
                    $obj['size'] = filesize($file_path);
                    $obj['path'] = url('/images/uploads/section_elements/gallery_2/'.$file);
                    $data[] = $obj;
                }

            }
            return response()->json($data);
        }
    }

}
