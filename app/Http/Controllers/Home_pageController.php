<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Register_car;
use App\Models\Guest;
use Illuminate\Support\Facades\Auth;
use App\Models\Sos_help_center;
use App\Models\Data_1669_operating_officer;
use App\Models\Cancel_Profile;
use App\User;
use App\Models\Sos_map;
use App\Models\Partner;

class Home_pageController extends Controller
{
     public function home_page()
    {
        $user_id = Auth::id();
        
        $Cancel_Profile = Cancel_Profile::where('user_id', $user_id)->get();
            foreach ($Cancel_Profile as $key) {
                $created_last = $key->created_at;
            }
        $cancel_ago = "";
        if (!empty($created_last)) {
            $cancel_ago = str_replace("ago","", $created_last->diffForHumans());
            $str_1 = str_replace("days","วัน", $cancel_ago);
            $str_2 = str_replace("day","วัน", $str_1);
            $str_3 = str_replace("months","เดือน", $str_2);
            $str_4 = str_replace("month","เดือน", $str_3);
            $str_5 = str_replace("years","ปี", $str_4);
            $str_6 = str_replace("year","ปี", $str_5);
            $str_7 = str_replace("weeks","สัปดาห์", $str_6);
            $str_8 = str_replace("week","สัปดาห์", $str_7);
            $str_9 = str_replace("seconds","วินาที", $str_8);
            $str_10 = str_replace("second","วินาที", $str_9);
            $str_11 = str_replace("minutes","นาที", $str_10);
            $str_12 = str_replace("minute","นาที", $str_11);
            $str_13 = str_replace("hours","ชั่วโมง", $str_12);
            $str_14 = str_replace("hour","ชั่วโมง", $str_13);

            $cancel_ago = $str_14;
        }

        // ช่อง 1 นับ users
        $data_users = User::get();
        $count_user = count($data_users);

        // ช่อง 2 ยานพาหนะ
        $data_vehicles = Register_car::get();
        $count_vehicle = count($data_vehicles);

        // ช่อง 3 ให้การช่วยเหลือ
        $data_guests = Guest::get();
        $count_guest = count($data_guests);
        $data_sos_maps = Sos_map::get();
        $count_sos_map = count($data_sos_maps);
        $count_help = $count_guest + $count_sos_map ;

        $partner_show_all = Partner::where('name_area', null)->where('show_homepage' , 'show')->get();

        $count_partner_show = count($partner_show_all);

        $data_partner_show = Partner::where('name_area', null)
            ->where('show_homepage' , 'show')
            ->inRandomOrder()
            ->limit($count_partner_show)
            ->get();

        $data_sos_1669 = Sos_help_center::where('status' , 'เสร็จสิ้น')->get();
        $data_officer_all = Data_1669_operating_officer::where('id' , "!=" , null)->get();

        return view('home_page.home_page', compact('count_user','count_vehicle','count_help','user_id' ,'cancel_ago','data_partner_show','data_sos_1669','data_officer_all'));
    }

    public function check_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        // echo $ipaddress;

        $ip = $ipaddress; // your ip address here
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));

        if($query && $query['status'] == 'success')
        {
            echo "<pre>";
            print_r($query);
            echo "<pre>";

            echo "<br>";

            // echo 'Your country is ' . $query['country'];
            // echo '<br />';
            // echo 'Your countryCode is ' . $query['countryCode'];
            // echo '<br />';
            // echo 'Your City is ' . $query['city'];
            // echo '<br />';
            // echo 'Your State is ' . $query['region'];
            // echo '<br />';
            // echo 'Your Zipcode is ' . $query['zip'];
            // echo '<br />';
            // echo 'Your Coordinates are ' . $query['lat'] . ', ' . $query['lon'];
        }

        $datetime =  date("d-m-Y  h:i:sa");

        // $name_time_zone = "Asia/Bangkok" ; //+7
        $name_time_zone = "Asia/Ust-Nera" ; //+10
        // $name_time_zone = "America/Antigua" ; //-4

        $data_time_zone = DB::table('time_zones')
                        ->where('TimeZone', $name_time_zone)
                        ->get();

        foreach ($data_time_zone as $key_time_zone) {
            $UTC_time_zone = $key_time_zone->UTC ;
        }

        if ($UTC_time_zone < 7) {

            $distance_time = (7) - ($UTC_time_zone) ;
            $time_2 = date("d-m-Y  h:i:sa", strtotime("-" . $distance_time ." hour"));

        }elseif ($UTC_time_zone > 7) {
            $UTC_time_zone = "+".$UTC_time_zone;
            $distance_time = $UTC_time_zone - 7 ;
            $time_2 = date("d-m-Y  h:i:sa", strtotime("+" . $distance_time ." hour"));
        }elseif ($UTC_time_zone == 7) {
            $UTC_time_zone = "+".$UTC_time_zone;
            $time_2 = $datetime ;
        }

        echo $name_time_zone ;
        echo "<br>";

        echo $UTC_time_zone ;
        echo "<br>";

        $time_zone = $time_2 . ", UTC " . $UTC_time_zone ;

        echo $time_zone ;
        echo "<br>";

        exit();
    }

    function re_to_line_oa(){

        if(Auth::check()){
            return view('return_line');
        }else{
            $re_to = "re_to_line_oa_2" ;
            return redirect('login/line?redirectTo=' . $re_to . "&from=re_to_line_oa");
        }
        
    }

    function re_to_line_oa_2(){
        return view('return_line');
    }
}
