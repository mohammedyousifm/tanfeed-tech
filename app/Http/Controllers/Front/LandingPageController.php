<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('front.landing');
    }

    public function  license()
    {
        return view('front.license');
    }
}
