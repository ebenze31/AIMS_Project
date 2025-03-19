<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\LineApiController;
use App\Models\Sos_map;
use App\Models\Polygon_amphoe_th;

class LocationController extends Controller
{
    public function search_location($lat, $lng)
    {

        $province_name = DB::select("SELECT tambon_th,amphoe_th,changwat_th,( 3959 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance FROM lat_longs  HAVING distance < 10 ORDER BY distance LIMIT 0 ,3", []);

        return $province_name;
    }

    public function check_news($lat, $lng)
    {
    	$d_30 = strtotime("-30 minute");
        $date_30 = date("Y-m-d H:i:s", $d_30);
        // echo $date_30;
        // exit();

        $check_news = DB::select("SELECT title,photo,( 3959 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance FROM news WHERE created_at > '$date_30' HAVING distance < 0.5 ORDER BY distance LIMIT 0 ,1", []);
        if (!empty($check_news)) {
        	return $check_news;
        }
    }

    public function show_location_P()
    {

        $location_P = DB::table('districts')
                        ->select('province')
                        ->groupBy('province')
                        ->orderBy('province', 'asc')
                        ->get();

        return $location_P;
    }

    public function show_location_A($location_P)
    {

        $location_A = DB::table('districts')
                        ->select('amphoe')
                        ->where('province', $location_P)
                        ->groupBy('amphoe')
                        ->orderBy('amphoe', 'asc')
                        ->get();
        return $location_A;
    }

    public function show_location_T($location_P , $location_A)
    {

        $location_T = DB::table('districts')
                        ->select('district')
                        ->where('province', $location_P)
                        ->where('amphoe', $location_A)
                        ->groupBy('district')
                        ->orderBy('district', 'asc')
                        ->get();

        return $location_T;
    }

    public function get_let_lng_district($area , $district){

        $data = Polygon_amphoe_th::where('province_name', $area)
                ->where('amphoe_name', $district)
                ->first();

        return $data;
    }

    function get_polygon_all_amphoe(){

        $data = DB::table('polygon_amphoe_ths')
                ->select('polygon','amphoe_name')
                ->get();

        return $data ;

    }
    

    public function change_country($user_id)
    {
        $data_user = DB::table('users')->where('id', $user_id)->get();

        foreach ($data_user as $item) {
                
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

            $ip = $ipaddress; // your ip address here
            $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));

            if($query && $query['status'] == 'success')
            {
                DB::table('users')
                    ->where('id', $user_id)
                    ->update([
                        'country' => $query['countryCode'],
                        'time_zone' => $query['timezone'],
                        'ip_address' => $query,
                ]);
            }
        }
       
        return $user_id;
    }

    public function user_language($language, $user_id)
    {
        $data_user = DB::table('users')->where('id', $user_id)->get();

        DB::table('users')
            ->where('id', $user_id)
            ->update([
                'language' => $language,
        ]);

        $user = DB::table('users')->where('id', $user_id)->get();   

        $lineAPI = new LineApiController();
        $lineAPI->check_language_user($user);
       
        return $user_id;
    }

    public function province_search()
    {
        $province_ = DB::table('lat_longs')
                    ->select('changwat_th')
                    ->groupBy('changwat_th')
                    ->orderBy('changwat_th', 'asc')
                    ->get();

        return $province_;
    }

    public function amphoe_search($province)
    {
        $amphoe = DB::table('lat_longs')
                    // ->select('amphoe_th')
                    ->where('changwat_th', $province)
                    ->groupBy('amphoe_th')
                    ->orderBy('amphoe_th', 'asc')
                    ->get();

        return $amphoe;
    }

    public function district_search($amphoe)
    {
        $district = DB::table('lat_longs')
                    // ->select('tambon_th')
                    ->where('amphoe_th', $amphoe)
                    ->groupBy('tambon_th')
                    ->orderBy('tambon_th', 'asc')
                    ->get();

        return $district;
    }

    public function show_tambon($province , $amphoe)
    {
        $district = DB::table('lat_longs')
                    // ->select('tambon_th')
                    ->where('changwat_th', $province)
                    ->where('amphoe_th', $amphoe)
                    ->groupBy('tambon_th')
                    ->orderBy('tambon_th', 'asc')
                    ->get();

        return $district;
    }

    public function zoom_district($district)
    {
        $district = DB::table('lat_longs')
                    ->where('tambon_th', $district)
                    ->get();

        return $district;
    }

    public function zoom_map($province , $amphoe , $district)
    {
        if ($province == "null") {
            $province = "" ;
        }
        if ($amphoe == "null") {
            $amphoe = "" ;
        }
        if ($district == "null") {
            $district = "" ;
        }

        $location = DB::table('lat_longs')
                    ->select('lat' , 'lng')
                    ->where('changwat_th', 'LIKE', "%$province%")
                    ->where('amphoe_th', 'LIKE', "%$amphoe%")
                    ->where('tambon_th', 'LIKE', "%$district%")
                    ->get();

        if (count($location) == 0) {
            $location = DB::table('lat_longs')
                    ->select('lat' , 'lng')
                    ->where('changwat_th', 'LIKE', "%$province%")
                    ->where('amphoe_th', 'LIKE', "%$amphoe%")
                    ->get();
        }

        return $location;
    }

    public function check_sos_country($user_id)
    {
        $data_user = DB::table('users')->where('id', $user_id)->get();

        foreach ($data_user as $item) {
                
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

            $ip = $ipaddress; // your ip address here
            $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
        }

        return $query;
    }

    public function show_sos_area($countryCode)
    {
        $area = Sos_map::selectRaw('area')
            ->where('area', '!=', null)
            ->where('CountryCode', $countryCode)
            ->groupBy('area')
            ->orderBy('area')
            ->get();

        return $area;
    }

    public function view_marker($name_partner)
    {
        $data_partners = DB::table('partners')
              ->where('name', $name_partner)
              ->get();

        foreach ($data_partners as $key) {
            $area = $key->sos_area ;
        }

        return $area ;
    }

}
