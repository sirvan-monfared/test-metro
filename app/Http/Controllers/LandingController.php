<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function yalda1402()
    {
        return view('front.landing.wheel_of_fortune');
    }
}
