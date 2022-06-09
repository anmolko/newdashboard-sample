<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\Service;
use App\Models\ProjectPlan;
use App\Models\Package;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    protected $contact = null;
    protected $setting = null;
    protected $blog = null;
    protected $bcategory = null;
    protected $faq = null;
    protected $service = null;
    protected $pojectPlan = null;
    protected $customer_package = null;
    

    public function __construct(Package $customer_package,ProjectPlan $pojectPlan,Service $service,Faq $faq,Setting $setting,Contact $contact,BlogCategory $bcategory,Blog $blog)
    {
        $this->contact = $contact;
        $this->setting = $setting;
        $this->bcategory = $bcategory;
        $this->blog = $blog;
        $this->faq = $faq;
        $this->service = $service;
        $this->pojectPlan = $pojectPlan;
        $this->customer_package = $customer_package;
        
    }


    public function index()
    {
        return view('welcome');
    }


    public function privacy()
    {
        return view('frontend.pages.privacy');
    }

    public function terms()
    {
        return view('frontend.pages.term');
    }
    
    
    public function faq(){
        $faqs = $this->faq->get();
        return view('frontend.pages.faq',compact('faqs'));
    }

    public function blogs(){
        $bcategories = $this->bcategory->get();
        $allPosts = $this->blog->orderBy('created_at', 'DESC')->where('status','publish')->paginate(6);
        $latestPost = $this->blog->orderBy('created_at', 'DESC')->where('status','publish')->first();
        return view('frontend.pages.blogs.index',compact('allPosts','latestPost','bcategories'));
    }

    
    public function blogSingle($slug){

        $singleBlog = $this->blog->where('slug', $slug)->first();
        if (!$singleBlog) {
            return abort(404);
        }
        $catid = $singleBlog->blog_category_id;
        $relatedBlogs = Blog::where('blog_category_id', '=', $catid)->where('status','publish')->take(2)->get();
        $bcategories = $this->bcategory->get();
        $latestPosts = $this->blog->orderBy('created_at', 'DESC')->where('status','publish')->take(3)->get();
        return view('frontend.pages.blogs.single',compact('singleBlog','relatedBlogs','bcategories','latestPosts'));
    }

    public function service(){
        $allservices = $this->service->paginate(6);
        return view('frontend.pages.services.index',compact('allservices'));
    }

    public function package(){
        $allpackages = $this->pojectPlan->get();
        return view('frontend.pages.package',compact('allpackages'));
    }

    public function packageStore(Request $request)
    {
        $data = [
            'project_plan_id'   => $request->input('project_plan_id'),
            'email'             => $request->input('email'),
            'phone'             => $request->input('phone'),
            'full_name'         => $request->input('full_name'),
        ];
        $status = $this->customer_package->create($data);

//         $theme_data = Setting::first();
//             $mail_data = array(
//                 'fullname'        =>$request->input('name'),
//                 'order_name'        =>$request->input('order_name'),
//                 'phone'        =>$request->input('phone'),
//                 'address'        =>ucwords($theme_data->address),
//                 'site_email'        =>ucwords($theme_data->email),
//                 'site_name'        =>ucwords($theme_data->website_name),
//                 'phone'        =>ucwords($theme_data->phone),
//                 'logo'        =>ucwords($theme_data->logo),
//             );
// //             Mail::to($theme_data->email)->send(new PackageDetail($mail_data));

            if($status){
                Session::flash('success','Thank you for odering package !');
                $confirmed = "success";
                return redirect()->back();
            }
            else{
                Session::flash('error','Failed to order package');
                $confirmed = "error";
                return redirect()->back();
            }

           
        
    }
    
    public function serviceSingle($slug){

        $singleService = $this->service->where('slug', $slug)->first();
        if (!$singleService) {
            return abort(404);
        }
       
        return view('frontend.pages.services.single',compact('singleService'));
    }

    public function blogCategories($slug){
        $bcategory = $this->bcategory->where('slug', $slug)->first();
        $catid = $bcategory->id;
        $cat_name = $bcategory->name;
        $allPosts = $this->blog->where('blog_category_id', $catid)->where('status','publish')->orderBy('created_at', 'DESC')->paginate(6);
        $bcategories = $this->bcategory->get();
        $latestPosts = $this->blog->orderBy('created_at', 'DESC')->where('status','publish')->take(3)->get();
        return view('frontend.pages.blogs.category',compact('allPosts','cat_name','latestPosts','bcategories'));
    }



    public function searchBlog(Request $request)
    {
        $query = $request->s;
        $allPosts = $this->blog->where('title', 'LIKE', '%' . $query . '%')->where('status','publish')->orderBy('title', 'asc')->paginate(6);
        $bcategories = $this->bcategory->get();
        $latestPosts = $this->blog->orderBy('created_at', 'DESC')->where('status','publish')->take(3)->get();

        return view('frontend.pages.blogs.search',compact('allPosts','query','latestPosts','bcategories'));
    }


    public function contact()
    {
        return view('frontend.pages.contact');

    }

    
    public function contactStore(Request $request)
    {
        $data = [
            'name'        => $request->input('name'),
            'email'       => $request->input('email'),
            'phone'       => $request->input('phone'),
            'subject'     => $request->input('subject'),
            'message'     => $request->input('msg'),
        ];
        $status = $this->contact->create($data);

//         $theme_data = Setting::first();
//             $mail_data = array(
//                 'fullname'        =>$request->input('name'),
//                 'message'        =>$request->input('msg'),
//                 'email'        =>$request->input('email'),
//                 'subject'        =>$request->input('subject'),
//                 'address'        =>ucwords($theme_data->address),
//                 'site_email'        =>ucwords($theme_data->email),
//                 'site_name'        =>ucwords($theme_data->website_name),
//                 'phone'        =>ucwords($theme_data->phone),
//                 'logo'        =>ucwords($theme_data->logo),
//             );
// //             Mail::to($theme_data->email)->send(new ContactDetail($mail_data));

            if($status){
                Session::flash('success','Thank you for contacting us!');
                $confirmed = "success";
                return response()->json($confirmed);
            }
            else{
                Session::flash('error','Failed to contact us');
                $confirmed = "error";
                return response()->json($confirmed);
            }

           
        
    }
}
