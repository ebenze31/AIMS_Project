<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Aims_adminController extends Controller
{
    function check_data_partner($user_id){
        $partners = DB::table('aims_commands')
            ->where('aims_commands.user_id', '=' ,$user_id)
            ->leftjoin('aims_partners', 'aims_commands.aims_partner_id', '=', 'aims_partners.id')
            ->select(
                'aims_partners.name as partner_name',
                'aims_partners.full_name as partner_full_name',
                'aims_partners.logo as partner_logo',
                'aims_commands.status as status_command',
                'aims_commands.name_officer_command as command_name',
                'aims_commands.officer_role as command_role',
            )
            ->get();

        return $partners ;
    }

    function change_status_command($change_to , $user_id){
        if ($change_to == 'null'){
            $change_to = null ;
        }

        DB::table('aims_commands')
            ->where([
                    ['user_id', $user_id],
                ])
            ->update([
                    'status' => $change_to,
                ]);

        return 'OK' ;
    }
}
