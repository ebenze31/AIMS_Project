<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

use App\Models\Ads_content;
use App\Models\Guest;
use App\Models\News;
use App\Models\Parcel;
use App\Models\Problem_report;
use App\Models\Promotion;
use App\Models\Sos_map;
use App\User;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailToPartner_area;
use App\Models\LineMessagingAPI;
use App\Http\Controllers\API\API_Time_zone;
use App\Models\Mylog;
use App\Models\Check_in;
use App\Models\Partner;
use App\Models\Partner_premium;
use App\Models\Partner_condo;
use App\Models\Group_line;
use App\Models\Time_zone;
use App\Models\Disease;
use App\Models\Data_1669_officer_command;
use App\Models\Data_1669_operating_officer;
use App\Models\Data_1669_operating_unit;
use App\Models\Sos_help_center;
use App\Models\Province_th;
use Auth;

class PartnersController extends Controller
{
    public function search_time_zone()
    {
        $data_time_zone = Time_zone::where("CountryCode", "!=" , null)
            ->orderBy('TimeZone', 'ASC')
            ->get();

        return $data_time_zone;
    }

    function video_how_to_use(){
        return view('how_to_use.video_how_to_use');
    }

    public function check_data_partner($user_organization)
    {
        $data_partners = Partner::where("name", $user_organization)
            ->where("name_area", null)
            ->get();

        return $data_partners;
    }

    public function check_data_partner_premium($user_organization)
    {
        $partner_premium = Partner_premium::where("name_partner", $user_organization)->get();

        return $partner_premium ;
    }

    public function check_data_line_group($group_line_id)
    {
        $data_line_group = Group_line::where("id", $group_line_id)
            ->get();

        return $data_line_group;
    }

    public function all_group_line($user_organization)
    {
        $data_partners_groupline = Partner::where("name", $user_organization)
            ->where("name_area", "!=" ,null)
            ->get();

        return $data_partners_groupline;
    }

    public function check_user($id_user)
    {
        $check_user = DB::select("SELECT * FROM users WHERE id = '$id_user' AND email = 'กรุณาเพิ่มอีเมล' AND role != 'null'");
        
        if (!empty($check_user)) {
        	return $check_user;
        }
    }

    public function put_email($email , $id_user , $username)
    {
        DB::table('users')
              ->where('id', $id_user)
              ->update([
                'email' => $email,
                'username' => $username,
            ]);
        return $id_user;
    }

    public function check_username($username , $id_user)
    {
        $username = DB::table('users')
              ->where('username', $username)
              ->where('id', "!=" , $id_user)
              ->get();

        if (!empty($username)) {
            return $username;
        }
        
    }

    public function check_email($email)
    {
        $email = DB::table('users')
              ->where('email', $email)
              ->get();

        if (!empty($email)) {
            return $email;
        }
        
    }

    public function sos_area($area_arr,$name_partner,$name_area)
    {
        DB::table('partners')
              ->where('name', $name_partner)
              ->where('name_area', $name_area)
              ->update([
                'new_sos_area' => $area_arr,
        ]);

        return $name_partner ;
        
    }

    public function area_pending($name_partner,$name_area)
    {
        $data_partners = DB::table('partners')
              ->where('name', $name_partner)
              ->where('name_area', $name_area)
              ->get();

        foreach ($data_partners as $key) {
            $area_pending = $key->new_sos_area ;
        }

        return $area_pending ;
        
    }

    public function area_current($name_partner,$name_area)
    {
        $data_partners = DB::table('partners')
          ->where('name', $name_partner)
          ->where('name_area', $name_area)
          ->get();

        foreach ($data_partners as $key) {
            $area_current = $key->sos_area ;
        }
            
        return $area_current ;

    }

    public function check_new_sos_area()
    {
        $data_partners = DB::table('partners')->get();

        return $data_partners ;
    }

    public function approve_area($input_new_area, $id)
    {
        DB::table('partners')
              ->where('id', $id)
              ->update([
                'sos_area' => $input_new_area,
                'new_sos_area' => null,
        ]);

        $data_partners = DB::table('partners')
            ->where('id', $id)
            ->get();

        $approve = "ได้รับการอนุมัติ เป็นที่เรียบร้อยแล้ว" ;

        foreach ($data_partners as $item) {

            $email = $item->mail;
            $mail_data = [
                    "approve" => $approve,
                    "name" => $item->name,
                    "sos_area" => $item->sos_area,
                ];

            Mail::to($email)->send(new MailToPartner_area($mail_data));

        }

        return $id ;
    }

    public function disapproved_area($id, $answer_reason, $reason_other)
    {
        DB::table('partners')
              ->where('id', $id)
              ->update([
                'new_sos_area' => null,
        ]);

        $data_partners = DB::table('partners')
            ->where('id', $id)
            ->get();

        $approve = "ยังไม่ผ่านการอนุมัติ" ;

        switch ($answer_reason) {
            case '1':
                $answer_reason = 'มีพื้นที่บางส่วนทับซ้อนหรือมีผู้ให้บริการพื้นที่นี้อยู่แล้ว' ;
                break;
            
            case '2':
                $answer_reason = 'พื้นที่บริการไม่สมเหตุสมผลกับองค์กรของท่าน' ;
                break;
        }

        foreach ($data_partners as $item) {

            $email = $item->mail;
            $mail_data = [
                    "approve" => $approve,
                    "name" => $item->name,
                    "answer_reason" => $answer_reason,
                    "reason_other" => $reason_other,
                ];

            Mail::to($email)->send(new MailToPartner_area($mail_data));

        }

        return $id ;
    }

    public function change_color_navbar($color_navbar , $partner)
    {
        $color_navbar = str_replace("_","#",$color_navbar);
        $partner = str_replace("_"," ",$partner);

        DB::table('partners')
              ->where('name', $partner)
              ->where("name_area", null)
              ->update([
                'color_navbar' => $color_navbar,
        ]);

        return $color_navbar ;
    }

    public function change_color_menu($color_menu , $partner , $class_color_menu)
    {
        $color_menu = str_replace("_","#",$color_menu);
        if ($color_menu == "#null") {
            $color_menu = null ;
        }

        $partner = str_replace("_"," ",$partner);

        DB::table('partners')
              ->where('name', $partner)
              ->where("name_area", null)
              ->update([
                'color' => $color_menu,
                'class_color_menu' => $class_color_menu,
        ]);

        return $color_menu ;
    }

    public function area_other($id_user , $name_area)
    {
        $data_user = DB::table('users')
                ->where("id", $id_user)
                ->get();

        foreach ($data_user as $key ) {

            $area_other = DB::table('partners')
                ->where("name","!=", $key->organization)
                ->where("name_area","!=", null)
                ->get();

        }

        return $area_other ;
    }

    public function area_partner_other($id_user , $name_area)
    {
        $data_user = DB::table('users')
                ->where("id", $id_user)
                ->get();

        foreach ($data_user as $key ) {

            $area_partner_other = DB::table('partners')
                ->where("name", $key->organization)
                ->where("name_area","!=", $name_area)
                ->get();

        }

        return $area_partner_other ;
    }

    public function your_old_area($id_user , $name_area)
    {
        $data_user = DB::table('users')
                ->where("id", $id_user)
                ->get();

        foreach ($data_user as $key ) {

            $your_old_area = DB::table('partners')
                ->where("name", $key->organization)
                ->where("name_area", $name_area)
                ->get();

        }

        return $your_old_area ;
    }

    public function check_area_other($id_partnet)
    {
        $area_other = DB::table('partners')
            ->where("id","!=", $id_partnet)
            ->get();

        return $area_other ;
    }

    public function all_sos_area()
    {
        $area = DB::table('partners')->get();

        return $area ;
    }

    public function all_area_partner($name_partner)
    {
        $data_partners = DB::table('partners')
            ->where('name', $name_partner)
            ->where('name_area', '!=' , null)
            ->where('sos_area', '!=' , null)
            ->get();

        return $data_partners ;
    }

    public function send_pass_area($line_group , $num_pass_area)
    {
        $data_line_group = DB::table('group_lines')
                            ->where("groupName", $line_group)
                            ->get();

        $this->send_pass_area_togroupline($data_line_group , $num_pass_area , "viicheck");

        return $data_line_group ;
    }

    public function send_pass_condo($line_group , $num_pass_area)
    {
        $data_line_group = DB::table('group_lines')
                            ->where("groupName", $line_group)
                            ->get();

        $this->send_pass_area_togroupline($data_line_group , $num_pass_area , "condo");

        return $data_line_group ;
    }

    public function update_data_groupline($id_groupline, $system)
    {
        DB::table('group_lines')
            ->where('id', $id_groupline)
            ->update([
                'system' => $system,
        ]);

        return "OK" ;
    }

    public function submit_group_line($line_group ,$id_partner )
    {
        $data_line_group = DB::table('group_lines')
                            ->where("groupName", $line_group)
                            ->get();

        foreach ($data_line_group as $key ) {
            DB::table('partners')
                ->where('id', $id_partner)
                ->update([
                    'line_group' => $line_group,
                    'group_line_id' => $key->id,
            ]);
        }
        
        $data_partner = Partner::where("id" , $id_partner)->get();

        foreach ($data_partner as $item) {
            DB::table('group_lines')
                ->where('groupName', $line_group)
                ->update([
                    'owner' => $item->name . " (Partner)",
                    'partner_id' => $id_partner,
            ]);
        }

        return $data_line_group ;
    }

    public function send_pass_area_togroupline($data_line_group , $num_pass_area , $type)
    {
        foreach ($data_line_group as $key) {
            $groupId = $key->groupId ;
            $name_time_zone = $key->time_zone ;
            $group_language = $key->language ;
            $condo_id = $key->condo_id ;
        }

        $data_condo = Partner_condo::where('id' , $condo_id)->first();

        if ($type == "viicheck") {
            $template_path = storage_path('../public/json/flex-pass_area.json'); 
            $channel_access_token = env('CHANNEL_ACCESS_TOKEN');
        }else{
            // รอแก้ template_path เป็นของคอนโด
            $template_path = storage_path('../public/json/flex-pass_area.json'); 
            $channel_access_token = $data_condo->channel_access_token;
        }

        // TIME ZONE
        $API_Time_zone = new API_Time_zone();
        $time_zone = $API_Time_zone->change_Time_zone($name_time_zone);

        $data_topic = [
                    "รหัสยืนยัน",
                ];

        for ($xi=0; $xi < count($data_topic); $xi++) { 

            $text_topic = DB::table('text_topics')
                    ->select($group_language)
                    ->where('th', $data_topic[$xi])
                    ->where('en', "!=", null)
                    ->get();

            foreach ($text_topic as $item_of_text_topic) {
                $data_topic[$xi] = $item_of_text_topic->$group_language ;
            }
        }
  

        $string_json = file_get_contents($template_path);
        $string_json = str_replace("รหัสยืนยัน",$data_topic[0],$string_json);
        $string_json = str_replace("1234",$num_pass_area,$string_json);
        $messages = [ json_decode($string_json, true) ];


        $body = [
            "to" => $groupId,
            "messages" => $messages,
        ];

        $opts = [
            'http' =>[
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '. $channel_access_token,
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];
                            
        $context  = stream_context_create($opts);
        $url = "https://api.line.me/v2/bot/message/push";
        $result = file_get_contents($url, false, $context);

        //SAVE LOG
        $data = [
            "title" => "ส่งรหัสยืนยัน",
            "content" => "ส่งรหัสยืนยัน",
        ];
        MyLog::create($data);
        return $result;

    }

    public function check_sos_alarm($check_name_partner)
    {
        $data_sos_map = DB::table('sos_maps')
                        ->where("area",'LIKE', "%$check_name_partner%")
                        ->where("helper", null)
                        ->get();

        return $data_sos_map ;
    }

    public function check_sos_alarm_notify($check_name_partner)
    {
        $data_sos_map = DB::table('sos_maps')
                        ->where("area",'LIKE', "%$check_name_partner%")
                        ->where("helper", null)
                        ->get();


        $notify = DB::table('sos_maps')
                        ->where("area",'LIKE', "%$check_name_partner%")
                        ->where("helper", null)
                        ->Where("notify", 'LIKE', "%$check_name_partner%")
                        ->get();

        foreach ($notify as $item) {

            $text_noti = str_replace($check_name_partner,"-",$item->notify) ;

            DB::table('sos_maps')
                ->where('id', $item->id)
                ->update([
                        'notify' => $text_noti ,
            ]);
        }

        return $notify ;
    }

    public function search_std($student_id , $check_in_at, $name_area)
    {
        if ($name_area == "all") {
            $data = DB::table('users')
                ->join('check_ins', 'users.id', '=', 'check_ins.user_id')
                ->select('users.*')
                ->where("check_ins.check_in_at",'LIKE', "%$check_in_at%")
                ->where("users.student_id" , 'LIKE', "%$student_id%")
                ->groupBy('users.id')
                ->get();
        }else{
            $data = DB::table('users')
                ->join('check_ins', 'users.id', '=', 'check_ins.user_id')
                ->select('users.*')
                ->where("check_ins.partner_id", $name_area)
                ->where("users.student_id" , 'LIKE', "%$student_id%")
                ->groupBy('users.id')
                ->get();
        }

        return $data ;
    }

    public function search_name($name , $check_in_at, $name_area)
    {
        if ($name_area == "all") {
            $data = DB::table('users')
                ->join('check_ins', 'users.id', '=', 'check_ins.user_id')
                ->select('users.*')
                ->where("check_ins.check_in_at",'LIKE', "%$check_in_at%")
                ->where("users.name_staff" , 'LIKE', "%$name%")
                ->groupBy('users.id')
                ->get();
        }else{
            $data = DB::table('users')
                ->join('check_ins', 'users.id', '=', 'check_ins.user_id')
                ->select('users.*')
                ->where("check_ins.partner_id", $name_area)
                ->where("users.name_staff" , 'LIKE', "%$name%")
                ->groupBy('users.id')
                ->get();
        }

        

        return $data ;
    }
    public function show_group_risk($user_id , $check_in_at, $name_area ,$name_disease)
    {
        DB::table('users')
          ->where('id', $user_id)
          ->update([
            'check_covid' => "Yes",
        ]);

        $data_all_date = array();
        $uesr_risk_groups = array();
        $data_user_risk_groups = array();

        if ($name_area == "all") {
            
            $groupBy_date = check_in::where("user_id" , $user_id)
                ->where("check_in_at",'LIKE', "%$check_in_at%")
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
                ->get();

            $i = 0 ;

            foreach ($groupBy_date as $key) {
                
                $time_in = "07:00:00";
                $time_out = "19:00:00";
                // echo "<br>";
                // echo date("Y/m/d" , strtotime($key->created_at ));

                $time_in_of_date = check_in::where("user_id" , $user_id)
                    ->select('time_in')
                    ->where("check_in_at",'LIKE', "%$check_in_at%")
                    ->where("time_in", "!=" , null)
                    ->whereDate('created_at', date("Y/m/d" , strtotime($key->created_at )))
                    ->orderBy('time_in', 'desc')
                    ->get();

                foreach ($time_in_of_date as $item) {

                    $time_in = $item->time_in;
                }

                $time_out_of_date = check_in::where("user_id" , $user_id)
                    ->select('time_out')
                    ->where("check_in_at",'LIKE', "%$check_in_at%")
                    ->where("time_out", "!=" , null)
                    ->whereDate('created_at', date("Y/m/d" , strtotime($key->created_at )))
                    ->orderBy('time_out', 'desc')
                    ->get();

                foreach ($time_out_of_date as $item) {

                    $time_out = $item->time_out;
                }

                $data_all_date[$i] = [
                    "date" => date("Y/m/d" , strtotime($key->created_at )),
                    "time_in" => date("H:i" , strtotime($time_in)),
                    "time_out" => date("H:i" , strtotime($time_out)),
                ];

                $i++ ;
                $time_in = "";
                $time_out = "";
            }

            for ($ii=0; $ii < count($data_all_date); $ii++) {
                
                $date_time_in =  $data_all_date[$ii]['date'] . " " . $data_all_date[$ii]['time_in'] ;
                $date_time_in = date("Y/m/d H:i" , strtotime($date_time_in) - 60*60 );

                $date_time_out =  $data_all_date[$ii]['date'] . " " . $data_all_date[$ii]['time_out'] ;
                $date_time_out = date("Y/m/d H:i" , strtotime($date_time_out) + 60*60 );

                $risk_groups = check_in::where("user_id" ,"!=" , $user_id)
                    ->where("check_in_at",'LIKE', "%$check_in_at%")
                    ->whereBetween('created_at', [$date_time_in, $date_time_out])
                    ->groupBy('user_id')
                    ->get();

                foreach ($risk_groups as $risk_group) {
                    array_push($uesr_risk_groups , $risk_group->user_id);
                }
            }


            for ($y=0; $y < count($uesr_risk_groups); $y++) { 

                $data_users = DB::table('users')
                    ->where("users.id" , $uesr_risk_groups[$y])
                    ->get();

                    foreach ($data_users as $data_user) {
                        if (!empty($data_user->name_staff)) {
                            $na_name = $data_user->name_staff ;
                        }else{
                            $na_name = $data_user->name ;
                        }
                        $data_user_risk_groups[$y] = [
                            "id" => $data_user->id,
                            "name" => $na_name,
                            "phone" => $data_user->phone,
                            "student_id" => $data_user->student_id,
                            "check_in_at" => $check_in_at,
                            "name_area" => $name_area,
                            "name_disease" => $name_disease,
                        ];
                    }
            }

        }else{ // มี name_area
            
            $groupBy_date = check_in::where("user_id" , $user_id)
                ->where("partner_id", $name_area)
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
                ->get();

            $i = 0 ;

            foreach ($groupBy_date as $key) {
                
                $time_in = "07:00:00";
                $time_out = "19:00:00";
                // echo "<br>";
                // echo date("Y/m/d" , strtotime($key->created_at ));

                $time_in_of_date = check_in::where("user_id" , $user_id)
                    ->select('time_in')
                    ->where("partner_id", $name_area)
                    ->where("time_in", "!=" , null)
                    ->whereDate('created_at', date("Y/m/d" , strtotime($key->created_at )))
                    ->orderBy('time_in', 'desc')
                    ->get();

                foreach ($time_in_of_date as $item) {

                    $time_in = $item->time_in;
                }

                $time_out_of_date = check_in::where("user_id" , $user_id)
                    ->select('time_out')
                    ->where("partner_id", $name_area)
                    ->where("time_out", "!=" , null)
                    ->whereDate('created_at', date("Y/m/d" , strtotime($key->created_at )))
                    ->orderBy('time_out', 'desc')
                    ->get();

                foreach ($time_out_of_date as $item) {

                    $time_out = $item->time_out;
                }

                $data_all_date[$i] = [
                    "date" => date("Y/m/d" , strtotime($key->created_at )),
                    "time_in" => date("H:i" , strtotime($time_in)),
                    "time_out" => date("H:i" , strtotime($time_out)),
                ];

                $i++ ;
                $time_in = "";
                $time_out = "";
            }

            for ($ii=0; $ii < count($data_all_date); $ii++) {
                
                $date_time_in =  $data_all_date[$ii]['date'] . " " . $data_all_date[$ii]['time_in'] ;
                $date_time_in = date("Y/m/d H:i" , strtotime($date_time_in) - 60*60 );

                $date_time_out =  $data_all_date[$ii]['date'] . " " . $data_all_date[$ii]['time_out'] ;
                $date_time_out = date("Y/m/d H:i" , strtotime($date_time_out) + 60*60 );

                $risk_groups = check_in::where("user_id" ,"!=" , $user_id)
                    ->where("partner_id", $name_area)
                    ->whereBetween('created_at', [$date_time_in, $date_time_out])
                    ->groupBy('user_id')
                    ->get();

                foreach ($risk_groups as $risk_group) {
                    array_push($uesr_risk_groups , $risk_group->user_id);
                }
            }


            for ($y=0; $y < count($uesr_risk_groups); $y++) { 

                $data_users = DB::table('users')
                    ->where("users.id" , $uesr_risk_groups[$y])
                    ->get();

                    foreach ($data_users as $data_user) {
                        if (!empty($data_user->name_staff)) {
                            $na_name = $data_user->name_staff ;
                        }else{
                            $na_name = $data_user->name ;
                        }

                        $data_user_risk_groups[$y] = [
                            "id" => $data_user->id,
                            "name" => $na_name,
                            "phone" => $data_user->phone,
                            "student_id" => $data_user->student_id,
                            "check_in_at" => $check_in_at,
                            "name_area" => $name_area,
                            "name_disease" => $name_disease,

                        ];
                    }
            }

        }

        return $data_user_risk_groups ;
    }

    public function send_risk_group()
    {
        
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        $count_user = count($data);
        $check_in_at = $data[0]['check_in_at'] ;
        $name_area = $data[0]['name_area'] ;
        $name_disease = $data[0]['name_disease'] ;

        for ($i=0; $i < $count_user ; $i++) {

            $user_id = $data[$i]['id'] ;

            $users = DB::table('users')
                ->where('id', $user_id)
                ->where('type' , 'line')
                ->where('send_covid' , null)
                ->get();

            foreach ($users as $user) {

                $user_language = $user->language ;

                if ($name_area == "all") {
                    $data_in_outs = check_in::where('user_id', $user->id)
                        ->where('check_in_at','LIKE', "%$check_in_at%")
                        ->latest()
                        ->take(3)
                        ->get();

                    $location_check_in = $check_in_at ;

                }else{
                    $data_in_outs = check_in::where('user_id', $user->id)
                        ->where("partner_id", $name_area)
                        ->latest()
                        ->take(3)
                        ->get();

                    $data_name_areas = Partner::where('id' , $name_area)->get();
                    foreach ($data_name_areas as $data_name_area) {
                        $text_name_area = $data_name_area->name_area ;
                    }

                    $location_check_in = $check_in_at . ' - ' . $text_name_area ;

                    $data_disease['name'] = $name_disease;
                    Disease::firstOrCreate($data_disease);
                }

                $zx=0;
                foreach ($data_in_outs as $data_in_out ) {

                    if (!empty($data_in_out->created_at)) {
                        $text_time[$zx] = date("d/m/Y H:i" , strtotime($data_in_out->created_at)) ;
                    }else{
                        $text_time[$zx] = "" ;
                    }

                    $zx = $zx + 1 ;    
                }

                if (!empty($text_time[0])) {
                   $text_time_1 = $text_time[0] ;
                }else{
                    $text_time_1 = "-" ;
                }

                if (!empty($text_time[1])) {
                   $text_time_2 = $text_time[1] ;
                }else{
                    $text_time_2 = "-" ;
                }

                if (!empty($text_time[2])) {
                   $text_time_3 = $text_time[2] ;
                }else{
                    $text_time_3 = "-" ;
                }

                // TIME ZONE
                // $API_Time_zone = new API_Time_zone();
                // $time_zone = $API_Time_zone->change_Time_zone($user->time_zone);

                if ($name_disease == 'covid') {
                    $data_topic = [
                            "เรียนคุณ",
                            "ด้วยสถานการณ์การระบาดของ Coronavirus Disease 2019 (COVID -19) ขณะนี้ท่านอยู่ในกลุ่มเสี่ยง",
                            "เนื่องจาก ท่านได้ Scan เข้าพื้นที่",
                            "จึงขอความร่วมมือในการปฏิบัติตามมาตราการเร่งด่วนในการป้องกันและควบคุมโรคติดต่อไวรัสโคโรนา กรุณาทำการตรวจเช็คและเฝ้าระวังตามพระราชบัญญัติโรคติดต่อ พ.ศ.2558",
                            "วัน / เวลา",
                            $name_disease,
                        ];
                }else{
                    $data_topic = [
                            "เรียนคุณ",
                            "ขณะนี้มีการระบาดของ",
                            "เนื่องจาก ท่านได้ Scan เข้าพื้นที่",
                            "จึงขอความร่วมมือในการปฏิบัติตามมาตราการเร่งด่วนในการป้องกันและควบคุมโรคติดต่อกรุณาทำการตรวจเช็คและเฝ้าระวังตามพระราชบัญญัติโรคติดต่อ พ.ศ.2558",
                            "วัน / เวลา",
                            $name_disease,
                        ];
                }


                for ($xi=0; $xi < count($data_topic); $xi++) { 

                    $text_topic = DB::table('text_topics')
                            ->select($user_language)
                            ->where('th', $data_topic[$xi])
                            ->where('en', "!=", null)
                            ->get();

                    foreach ($text_topic as $item_of_text_topic) {
                        $data_topic[$xi] = $item_of_text_topic->$user_language ;
                    }
                }

                $template_path = storage_path('../public/json/risk_group.json');
                $string_json = file_get_contents($template_path);
                // users 
                $string_json = str_replace("ตัวอย่าง",$data_topic[0],$string_json);
                $string_json = str_replace("เรียนคุณ",$data_topic[0],$string_json);
                $string_json = str_replace("check_in_area",$location_check_in,$string_json);
                $string_json = str_replace("xxx",$user->name,$string_json);

                $string_json = str_replace("text_00",$data_topic[1],$string_json);
                $string_json = str_replace("text_02",$data_topic[2],$string_json);
                $string_json = str_replace("text_03",$data_topic[3],$string_json);
                $string_json = str_replace("ตามวัน / เวลาด้านล่าง",$data_topic[4],$string_json);
                $string_json = str_replace("text_01",$data_topic[5],$string_json);

                $string_json = str_replace("text_time_1",$text_time_1,$string_json);
                $string_json = str_replace("text_time_2",$text_time_2,$string_json);
                $string_json = str_replace("text_time_3",$text_time_3,$string_json);
                

                $messages = [ json_decode($string_json, true) ];

                $body = [
                    "to" => $user->provider_id,
                    "messages" => $messages,
                ];

                $opts = [
                    'http' =>[
                        'method'  => 'POST',
                        'header'  => "Content-Type: application/json \r\n".
                                    'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                        'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                        //'timeout' => 60
                    ]
                ];
                                    
                $context  = stream_context_create($opts);
                $url = "https://api.line.me/v2/bot/message/push";
                $result = file_get_contents($url, false, $context);

                // SAVE LOG
                $data_2 = [
                    "title" => "คุณคือกลุ่มเสี่ยง",
                    "content" => $user->name . 'คือกลุ่มเสี่ยง',
                ];
                MyLog::create($data_2);

                $date_now = date("Y-m-d");

                DB::table('users')
                    ->where('id', $user->id)
                    ->where('type' , 'line')
                      ->update([
                        'send_covid' => $date_now,
                ]);
            }


        }

        return $count_user;
    }

    function input_data_partner($name_partner)
    {
        $data = Partner::where('name_area', null )->where('name' , $name_partner)->get();

        return $data ;
    }

    function submit_show_homepage($partner_id , $input_show_homepage)
    {
        DB::table('partners')
            ->where('id', $partner_id)
              ->update([
                'show_homepage' => $input_show_homepage,
        ]);

        return "OK" ;
    }


    function clear_area($name_partner , $name_area)
    {
        DB::table('partners')
            ->where('name', $name_partner)
            ->where('name_area', $name_area)
              ->update([
                'sos_area' => null,
        ]);

        return "OK" ;
    }

    function clear_area_new($name_partner , $name_area)
    {
        DB::table('partners')
            ->where('name', $name_partner)
            ->where('name_area', $name_area)
              ->update([
                'new_sos_area' => null,
        ]);

        return "OK" ;
    }

    function delete_area($id)
    {
        $data_partners = Partner::where('id' , $id)->get();

        foreach ($data_partners as $item) {
            $group_line_id = $item->group_line_id;
        }

        if (!empty($group_line_id)) {
            DB::table('group_lines')
                ->where('id', $group_line_id)
                  ->update([
                    'owner' => null,
                    'partner_id' => null,
            ]);
        }
        
        Partner::where('id' , $id)->delete();

        return "OK" ;
    }

    function show_logo_partner()
    {
        $data_partner_show = Partner::where('name_area', null)
            ->where('show_homepage' , 'show')
            ->get();

        return $data_partner_show ;
    }

    function search_data_sos_js100($name , $phone)
    {
        if ($name == "all" and $phone == "all") {
            $data_sos_js100 = DB::table('sos_maps')
                ->where('content', "emergency_js100")
                ->orderBy('id' , 'desc')
                ->get();
        }elseif ($name == "all" and $phone != "all") {
            $data_sos_js100 = DB::table('sos_maps')
                ->where('content', "emergency_js100")
                ->where('phone','LIKE', "%$phone%")
                ->orderBy('id' , 'desc')
                ->get();
        }elseif ($name != "all" and $phone == "all") {
            $data_sos_js100 = DB::table('sos_maps')
                ->where('content', "emergency_js100")
                ->where('name','LIKE', "%$name%")
                ->orderBy('id' , 'desc')
                ->get();
        }elseif ($name != "all" and $phone != "all") {
            $data_sos_js100 = DB::table('sos_maps')
                ->where('content', "emergency_js100")
                ->where('name','LIKE', "%$name%")
                ->where('phone','LIKE', "%$phone%")
                ->orderBy('id' , 'desc')
                ->get();
        }

        return $data_sos_js100 ;
    }

    function check_new_sos_js100_by_theme()
    {
        $check_new = DB::table('sos_maps')
            ->where('content', "emergency_js100")
            ->where('notify', "!=" , "admin_click")
            ->orwhere('content', "emergency_js100")
            ->Where('notify', null)
            ->get();

        return $check_new ;
    }

    function check_new_sos_js100()
    {
        $check_new = DB::table('sos_maps')
            ->where('content', "emergency_js100")
            ->Where('notify', null)
            ->get();

        return $check_new ;
    }

    function check_notified_js100()
    {
        $check_notified = DB::table('sos_maps')
            ->where('content', "emergency_js100")
            ->Where('notify', "notified")
            ->get();

        return $check_notified ;
    }

    function update_new_sos_js100($id_sos_map)
    {
        DB::table('sos_maps')
            ->where('id', $id_sos_map)
              ->update([
                'notify' => "notified",
        ]);

        return "ok" ;
    }

    function admin_click($all_or_id)
    {
        if ($all_or_id == "all") {

            DB::table('sos_maps')
                ->where('content', "emergency_js100")
                  ->update([
                    'notify' => "admin_click",
            ]);

            $data = DB::table('sos_maps')
                ->where('content', "emergency_js100")
                ->get();

        }else{

            DB::table('sos_maps')
                ->where('id', $all_or_id)
                  ->update([
                    'notify' => "admin_click",
            ]);

            $data = DB::table('sos_maps')
                ->where('id', $all_or_id)
                ->where('content', "emergency_js100")
                ->get();

        }

        return $data ;
    }

    function view_map_officer_all(){

        $data_area = Data_1669_officer_command::where('area' , "!=" , null)
            ->select('area')
            ->groupBy('area')
            ->orderBy('area' , 'ASC')
            ->get();

        $data_officer_all = Data_1669_operating_officer::where('id' , "!=" , null)->get();

        $data_officer_ready = Data_1669_operating_officer::where('lat' , "!=" , null)
            ->where('status' , "Standby")
            ->get();

        $data_officer_helping = Data_1669_operating_officer::where('lat' , "!=" , null)
            ->where('status' , "Helping")
            ->get();

        $data_officer_Not_ready = Data_1669_operating_officer::where('status' , "Not_ready")
            ->orWhere('status' , null)
            ->get();

        $arr_vehicle = array();

        $arr_vehicle['vehicle_car'] = 0 ;
        $arr_vehicle['vehicle_aircraft'] = 0 ;
        $arr_vehicle['vehicle_boat_1'] = 0 ;
        $arr_vehicle['vehicle_boat_2'] = 0 ;
        $arr_vehicle['vehicle_boat_3'] = 0 ;
        $arr_vehicle['vehicle_boat_other'] = 0 ;

        $arr_vehicle['vehicle_fr'] = 0 ;
        $arr_vehicle['vehicle_bls'] = 0 ;
        $arr_vehicle['vehicle_ils'] = 0 ;
        $arr_vehicle['vehicle_als'] = 0 ;


        foreach ($data_officer_all as $item) {
            // ระดับ
            if($item->level == 'FR'){
                $arr_vehicle['vehicle_fr'] = $arr_vehicle['vehicle_fr'] + 1;
            }else if($item->level == 'BLS'){
                $arr_vehicle['vehicle_bls'] = $arr_vehicle['vehicle_bls'] + 1;
            }else if($item->level == 'ILS'){
                $arr_vehicle['vehicle_ils'] = $arr_vehicle['vehicle_ils'] + 1;
            }else if($item->level == 'ALS'){
                $arr_vehicle['vehicle_als'] = $arr_vehicle['vehicle_als'] + 1;
            }

            // ยานพาหนะ
            if($item->vehicle_type == 'รถ'){
                $arr_vehicle['vehicle_car'] = $arr_vehicle['vehicle_car'] + 1;
            }else if($item->vehicle_type == 'อากาศยาน'){
                $arr_vehicle['vehicle_aircraft'] = $arr_vehicle['vehicle_aircraft'] + 1;
            }else if($item->vehicle_type == 'เรือ ป.1'){
                $arr_vehicle['vehicle_boat_1'] = $arr_vehicle['vehicle_boat_1'] + 1;
            }else if($item->vehicle_type == 'เรือ ป.2'){
                $arr_vehicle['vehicle_boat_2'] = $arr_vehicle['vehicle_boat_2'] + 1;
            }else if($item->vehicle_type == 'เรือ ป.3'){
                $arr_vehicle['vehicle_boat_3'] = $arr_vehicle['vehicle_boat_3'] + 1;
            }else if($item->vehicle_type == 'เรือประเภทอื่นๆ'){
                $arr_vehicle['vehicle_boat_other'] = $arr_vehicle['vehicle_boat_other'] + 1;
            }
        }

        $amphoe_sos = Sos_help_center::where('address', '!=', null)
            ->get();

        $decoded_districts = [];
        
        foreach ($amphoe_sos as $item) {
            $parts = explode('/', $item->address);
            $text_p_a = $parts[0] . "/" . $parts[1];
            if (isset($text_p_a)) {
                $decoded_districts[] = $text_p_a;
            }
        }

        $districtCounts = collect($decoded_districts)->countBy();

        $orderedDistricts = $districtCounts->sortByDesc(function ($count, $district) {
            return $count;
        });

        $data_officer_gotohelp = Data_1669_operating_officer::where('go_to_help' , "!=" , null)
            ->orderBy('go_to_help',"desc")
            // ->limit(20)
            ->get();

        $sos_success = Sos_help_center::where('status', 'เสร็จสิ้น')->get();

        return view('view_map_officer_all', compact('data_officer_all','data_officer_ready','data_officer_helping','data_officer_Not_ready','arr_vehicle','orderedDistricts','data_officer_gotohelp','sos_success','data_area'));

    }

    function view_map_officer_area(){

        // $template_path = storage_path('../public/อำเภอ.json');
        // $string_json = file_get_contents($template_path);

        // $data = [ json_decode($string_json, true) ];

        // // สร้าง array เพื่อเก็บค่า ADM1_TH ทั้งหมด
        // $adm_categories = [];

        // // วนลูปผ่าน features ทุกตัว
        // foreach ($data[0]['features'] as $feature) {
        //     // ดึงค่า ADM1_TH และ ADM2_TH จาก properties
        //     $adm1_th = $feature['properties']['ADM1_TH'];
        //     $adm2_th = $feature['properties']['ADM2_TH'];

        //     $geometry = $feature['geometry']['coordinates'];
        //     $geometry = json_encode($geometry);

        //     $geometry = str_replace("[[[","{",$geometry);
        //     $geometry = str_replace("]]]","}",$geometry);
        //     $geometry = str_replace("[","{",$geometry);
        //     $geometry = str_replace("]","}",$geometry);

        //     $geometry = str_replace("},{","/",$geometry);
        //     $geometry = str_replace("{","",$geometry);
        //     $geometry = str_replace("}","",$geometry);

        //     $geometry = explode("/",$geometry);

        //     $arr_lat_lng = '';

        //     for ($i=0; $i < count($geometry); $i++) { 
        //         $geometry_ex_1 = explode(".",$geometry[$i]);
        //         $geometry_ex_2 = explode(",",$geometry_ex_1[1]);

        //         $text_lng_1 = '"lng":' . $geometry_ex_1[0];
        //         $text_lng_2 = $geometry_ex_2[0];

        //         $text_lat_1 = '"lat":' . $geometry_ex_2[1];
        //         $text_lat_2 = $geometry_ex_1[2];

        //         $arr_lat_lng = $arr_lat_lng . "{" . $text_lng_1 . "." . $text_lng_2 . "," . $text_lat_1 . "." . $text_lat_2 . "}," ;
        //     }

        //     $geometry = "[" . $arr_lat_lng . "]";
        //     $geometry = str_replace(",]","]",$geometry);


        //     // ตรวจสอบว่าค่า ADM1_TH นี้มี key ใน $adm_categories หรือยัง
        //     if (!array_key_exists($adm1_th, $adm_categories)) {
        //         // ถ้ายังไม่มี, ให้สร้าง key ใหม่และกำหนดให้เป็น array
        //         $adm_categories[$adm1_th] = [];
        //     }

        //     // เพิ่มค่า ADM2_TH ลงใน array ของ key ที่เป็น ADM1_TH
        //     // $adm_categories[$adm1_th][] = $adm2_th;
        //     $adm_categories[$adm1_th][$adm2_th] = $geometry;
            
        // }

        // foreach ($adm_categories as $province => $districts) {
        //     ksort($adm_categories[$province]);
        // }

        // ksort($adm_categories);


        // // $adm_categories ตอนนี้จะมีค่า ADM1_TH ทั้งหมด
        // echo count($adm_categories);
        // echo "<br>";
        // // echo "<pre>";
        // // print_r($adm_categories);
        // // echo "<pre>";

        // foreach ($adm_categories as $province => $districts) {
        //     // echo $province; // ชื่อจังหวัด
        //     // echo "<br>";

        //     foreach ($districts as $district => $geometry) {
        //         // echo $district; // ชื่อเขต/อำเภอ
        //         // echo "<br>";

        //         // ทำตามที่คุณต้องการกับ $geometry ที่นี่
        //         // ยกตัวอย่างเช่น
        //         // echo $geometry;
        //         // echo "<br>";

        //         $data_insert = [
        //             'province_name' => $province,
        //             'amphoe_name' => $district,
        //             // 'amphoe_lat' => '',
        //             // 'amphoe_lon' => '',
        //             'amphoe_zoom' => '12',
        //             'polygon' => $geometry,
        //         ];

        //         DB::table('polygon_amphoe_ths')->insert($data_insert);

        //         echo "<br>";
        //         echo "-----------------------------------------------------------";
        //         echo "<br>";
        //         echo "เพิ่ม " . $province ."/". $district . " เรียบร้อย" ;
        //         echo "<br>";
        //         echo "-----------------------------------------------------------";
        //         echo "<br>";

        //     }

        // }
        // exit();

        $area = Auth::user()->sub_organization ;

        return view('view_map_officer_area' , compact('area'));
    }

    function draw_select_area($select_area){

        $data = Province_th::where('province_name' , $select_area)->first();

        return $data ;

    }

    function get_sos_help_center_success($area){

        $sos_success = DB::table('sos_1669_form_yellows')
                ->join('sos_help_centers', 'sos_help_centers.id', '=', 'sos_1669_form_yellows.sos_help_center_id')
                ->where('sos_help_centers.status', 'เสร็จสิ้น')
                ->where("sos_help_centers.notify",'LIKE', "%$area%")
                ->select('sos_help_centers.*' , 'sos_1669_form_yellows.rc as rc')
                ->get();

        return $sos_success ;
    }

    function get_data_officer_all($area){

        $data_officer_all = DB::table('data_1669_operating_officers')
            ->join('data_1669_operating_units', 'data_1669_operating_units.id', '=', 'data_1669_operating_officers.operating_unit_id')
            ->leftJoin('users' , 'data_1669_operating_officers.user_id','=','users.id')
            ->where("data_1669_operating_units.area" , $area)
            ->select('data_1669_operating_officers.*' , 'data_1669_operating_units.*' ,'users.photo as photo_user')
            ->orderBy('go_to_help' , 'desc')
            ->get();

        return $data_officer_all ;
    }

    function Manage_uploaded_photos(Request $request){

        $text_hello_world = "HELLO WORLD" ;

        $files = Storage::files('public/uploads');
        $type_part = "uploads";

        // $files = Storage::files('public/1669');
        // $type_part = "1669";

        // $files = Storage::files('public/check_in');
        // $type_part = "check_in";

        return view('Manage_uploaded_photos', compact('text_hello_world','files','type_part'));
    }

    function Manage_resize_photos(Request $request){

        $text_hello_world = "HELLO WORLD" ;

        $files = Storage::files('public/uploads');
        $type_part = "uploads";

        // $files = Storage::files('public/1669');
        // $type_part = "1669";

        // $files = Storage::files('public/check_in');
        // $type_part = "check_in";

        return view('Manage_resize_photos', compact('text_hello_world','files','type_part'));
    }

    function delete_uploaded_photos($name_file,$type_part){

        $filename = 'public/'.$type_part.'/' . $name_file;

        if (Storage::exists($filename)) {
            Storage::delete($filename);
            $text = 'ไฟล์ถูกลบออกแล้ว';
        } else {
            $text = 'ไม่พบไฟล์ที่ต้องการลบ';
        }

        return $name_file . " - " . $text ;

    }

    function resize_img($name_file , $type_part){

        $filename = 'public/'.$type_part.'/' . $name_file;

        $image = Image::make(storage_path("app/") . $filename);
        
        $size = $image->filesize();  

        if($size > 112000 ){
            $image->resize(
                intval($image->width()/2) , 
                intval($image->height()/2)
            )->save(); 
        }

        $new_filesize = $image->filesize(); 
        // $new_size = round($new_filesize / (1024 * 1024), 2);

        return $new_filesize ;

    }

    function get_new_size_img($name_file , $type_part){

        $filename = 'public/'.$type_part.'/' . $name_file;

        $image = Image::make(storage_path("app/") . $filename);
        
        $size = $image->filesize(); 
        
        return $size ;

    }

}