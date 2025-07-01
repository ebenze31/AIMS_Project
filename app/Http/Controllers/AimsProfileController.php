<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AimsProfileController extends Controller
{

    public function home_for_officer(Request $request)
    {
        return view('amis_homepage.home_for_officer');
    }

    public function aims_edit_profile(Request $request)
    {
        // ตรวจสอบว่าผู้ใช้ login แล้วหรือไม่
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        
        if (in_array($user->role, ['operator-area', 'admin-area', 'admin-partner'])) {
            return view('aims_profile.edit_profile_command');
        }
        elseif ($user->role === 'officer-area') {
            return view('aims_profile.edit_profile_officer');
        }
        else {
            return redirect('/form-sos');
        }

        return redirect('/404');

    }
}
