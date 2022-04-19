<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    protected $client = null;


    // public function __construct(Team $team)
    // {
    //     $this->team = $team;
    // }


    public function index()
    {

        return view('welcome');

    }

    public function contact()
    {
        return view('frontend.pages.contact');

    }
}
