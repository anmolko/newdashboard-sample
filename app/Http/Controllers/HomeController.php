<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\OurWork;
use App\Models\User;
use Illuminate\Http\Request;

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
        $allusers = User::take(7)->get();
        $works    = OurWork::take(7)->latest()->get();
        $feeds    = Blog::take(5)->latest()->get();
        return view('backend.dashboard', compact('allusers','works','feeds'));
    }

    public function filemanager()
    {
        return view('backend.filemanager.index');
    }



}
