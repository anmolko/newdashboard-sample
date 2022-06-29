<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Client;
use App\Models\Setting;
use App\Models\User;
use App\Models\Award;
use App\Models\Page;
use doode\FormBuilder\Models\Submission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Exports\FormsExport;
use Maatwebsite\Excel\Facades\Excel;
use doode\FormBuilder\Models\Form;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $client_count = Client::count();
        $user_count   = User::count();
        $award_count  = Award::count();
        $page_count   = Page::count();
        $latestPosts  = Blog::orderBy('created_at', 'DESC')->take(3)->get();
        $latestPages  = Page::orderBy('created_at', 'DESC')->take(4)->get();
        $latestUsers  = User::orderBy('created_at', 'DESC')->take(4)->get();
        $settings     = Setting::first();

        return view('backend.dashboard',compact('latestUsers','latestPages','settings','client_count','user_count','award_count','page_count','latestPosts'));

    }

    public function export($id)
    {
        $form = Form::where('id', $id)
        ->with(['user'])
        ->firstOrFail();
        $form_name= ucwords(@$form->name)." - ".date('F j, Y').".xlsx";

        return Excel::download(new FormsExport($id), $form_name);
    }
}
