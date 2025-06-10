<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AimsProfileController extends Controller
{

    public function home_for_officer(Request $request)
    {
        return view('amis_homepage.home_for_officer');
    }

    public function aims_edit_profile(Request $request)
    {
        return view('aims_profile.aims_edit_profile');
    }
}
