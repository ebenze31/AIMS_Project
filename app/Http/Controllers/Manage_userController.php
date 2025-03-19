<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\Data_1669_officer_command;

class Manage_userController extends Controller
{
    public function manage_user(Request $request)
    {
    	$keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $all_user = User::where('role', 'LIKE', "$keyword")
                ->latest()->paginate($perPage);
        } else {
            $all_user = User::latest()->paginate($perPage);
        }

        return view('admin_viicheck.user.manage_user', compact('all_user'));
    }

    public function change_ToGuest()
    {
        DB::table('users')
                ->where('id', request('id'))
                ->update(['role' => '']);

        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function change_ToAdmin()
    {
        DB::table('users')
                ->where('id', request('id'))
                ->update(['role' => 'admin']);

        return redirect($_SERVER['HTTP_REFERER']);
    }
    public function change_ToJS100()
    {
        DB::table('users')
                ->where('id', request('id'))
                ->update(['role' => 'js100']);

        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function view_new_user()
    {
        return view('admin_viicheck.user.new_user');
    }

    public function create_user(Request $request)
    {
        $partners = $request->get('partners');
        $data_user = Auth::user();

        $name = uniqid($partners.'-');
        $username = $name ;
        $email = "กรุณาเพิ่มอีเมล" ;
        $password = uniqid();
        $provider_id = uniqid($partners.'-', true);

        // ใช้ชื่อจากเลขนิติ
        // $organization = "" ;

        // echo "name >> ".$name."<br>";
        // echo "username >> ".$username."<br>";
        // echo "email >> ".$email."<br>";
        // echo "password >> ".$password."<br>";
        // echo "provider_id >> ".$provider_id."<br>";
        // exit();

        $user = new User();
        $user->name = $name;
        $user->username = $name;
        $user->provider_id = $provider_id;
        $user->password = Hash::make($password);
        $user->email = $email;
        $user->role = "admin-partner";
        $user->organization = $partners;
        $user->creator = $data_user->id;
        $user->status = "active";


        $user->save();

        $data_user = User::where('role', "admin-partner")
                    ->where('organization', $partners)
                    ->get();

        foreach ($data_user as $item) {

            DB::table('partners')
                ->where('name', $partners)
                ->update(['user_id_admin' => $item->id]);

        }

        return view('admin_viicheck.user.create_user', compact('partners' , 'username' , 'password'));
    }

    function cancel_membership($user_id)
    {
        $data_user = User::where('id' , $user_id)->first();

        if ($data_user->organization == "สพฉ"){
            Data_1669_officer_command::where('user_id' , $user_id)->delete();
        }

        DB::table('users')
            ->where('id', $user_id)
            ->update([
                'role' => null,
                'organization' => null,
        ]);

        return 'ok' ;
    }

}