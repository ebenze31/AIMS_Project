<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Aims_operating_officer;
use App\User;

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

                $ip = request()->ip(); // ดึง IP ของผู้ใช้

                $response = Http::get("http://ip-api.com/json/{$ip}?lang=th");
                $ip_data = $response->successful() ? $response->json() : null;

            return view('aims_profile.edit_profile_officer', compact('data_officer','ip_data'));
        }
        else {
            return redirect('/form-sos');
        }

        return redirect('/404');

    }

    public function cf_edit_profile_officer(Request $request)
    {
        $dataUser = json_decode($request->input('data_user'), true);
        $dataOfficer = json_decode($request->input('data_officer'), true);
        $userId = $request->input('user_id');

        if (isset($dataUser['ip_address']) && is_array($dataUser['ip_address'])) {
            $dataUser['ip_address'] = json_encode($dataUser['ip_address']);
        }
    
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('uploads', 'public');
            $dataUser['photo'] = $path;
        }

        // ป้องกัน mass assignment
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->update($dataUser);

        $dataOfficer['user_id'] = $userId;
        Aims_operating_officer::updateOrCreate(
            ['user_id' => $userId],
            $dataOfficer
        );

        return response()->json(['success' => true, 'data_user' => $dataUser, 'data_officer' => $dataOfficer]);
    }


}
