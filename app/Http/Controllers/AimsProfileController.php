<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AimsProfileController extends Controller
{

    public function home_for_officer(Request $request)
    {
        $user = Auth::user();

        $data_officer = DB::table('aims_operating_officers')
            ->where('aims_operating_officers.user_id', '=', $user->id)
            ->leftJoin('users', 'aims_operating_officers.user_id', '=', 'users.id')
            ->select(
                'aims_operating_officers.name_officer',
                'aims_operating_officers.level',
                'aims_operating_officers.vehicle_type',
                'users.*'
            )
            ->first();
            
        return view('amis_homepage.home_for_officer', compact('data_officer'));
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

            $data_officer = DB::table('aims_operating_officers')
                ->where('aims_operating_officers.user_id', '=', $user->id)
                ->leftJoin('users', 'aims_operating_officers.user_id', '=', 'users.id')
                ->select(
                    'aims_operating_officers.name_officer',
                    'aims_operating_officers.level',
                    'aims_operating_officers.vehicle_type',
                    'users.*'
                )
                ->first();

            return view('aims_profile.edit_profile_officer', compact('data_officer'));
        }
        else {
            return redirect('/form-sos');
        }

        return redirect('/404');

    }
}
