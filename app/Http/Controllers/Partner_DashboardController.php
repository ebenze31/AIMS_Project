<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use Illuminate\Http\Request;

use App\Exports\UsersExport;
use App\Models\Ads_content;
use Maatwebsite\Excel\Facades\Excel;
Use Carbon\Carbon;
use PDF;
use App\User;
use App\Models\Partner;
use App\Models\Check_in;
use App\Models\Guest;
use App\Models\Register_car;
use App\Models\Sos_help_center;
use App\Models\Sos_map;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Averages;
use SebastianBergmann\Environment\Console;

class Partner_DashboardController extends Controller
{
    function dashboard_index(Request $request)
    {
        $user_login = Auth::user();

        $data_partner = Partner::where('name', '=', $user_login->organization)
        ->where('name_area' , null)
        ->first();

        $text_user_form = str_replace( " ", "_", $data_partner->name );

        // ddd($text_user_form);
        // เจ้าหน้าที่ในองค์กร
        $data_officer_last5 = User::where('organization', '=', $user_login->organization)
        ->orderBy('created_at','DESC')
        ->limit(5)
        ->get();

        // ผู้ใช้ที่มาจาก API
        $data_user_from_last5 = User::where('user_from','LIKE',"%$text_user_form%")
        ->orderBy('created_at','DESC')
        ->limit(5)
        ->get();

        // นับผู้ใช้ทั้งหมด
        $data_officer = User::where('organization', '=', $user_login->organization)->orderBy('created_at','DESC')->get();
        $data_user_from = User::where('user_from','LIKE',"%$text_user_form%")->get();
        $all_user = count($data_officer) + count($data_user_from);

        // นับผู้ใช้แต่ละเดือน
        $date_now = Carbon::now();
        $all_user_m = User::whereMonth('created_at', $date_now)
        ->where('organization', '=', $user_login->organization)
        ->orWhere('user_from','LIKE',"%$text_user_form%")
        ->count();

        // ช่องทางเข้าสู่ระบบ
        $count_type_login = DB::table('users')
        ->where('users.organization', '=', $user_login->organization)
        ->orWhere('user_from','LIKE',"%$text_user_form%")
        ->select('users.type', DB::raw('COUNT(*) as user_type_count'))
        ->groupBy('users.type')
        ->orderBy('user_type_count','DESC')
        ->get();

        // จังหวัดของผู้ใช้สูงสุด 5 อันดับ
        $count_user_location = DB::table('users')
        ->where('users.organization', '=', $user_login->organization)
        ->orWhere('user_from','LIKE',"%$text_user_form%")
        ->select('users.location_P', DB::raw('COUNT(*) as user_location_count'))
        ->groupBy('users.location_P')
        ->orderBy('user_location_count','DESC')
        ->limit(5)
        ->get();



        //==================================================================================================================//
                                                        //  vii sos
        //==================================================================================================================//
        $sos_all_data = Sos_map::where('area',$user_login->organization)
        ->where('content','help_area')
        ->get();

        //หาจำนวนการขอความช่วยเหลือ
        $count_sos_all_data = count($sos_all_data);

        //หาระยะเวลาเฉลี่ยการขอความช่วยเหลือ
        $average_sos_all_data = Sos_map::where('area',$user_login->organization)
        ->where('content','help_area')
        ->where('help_complete','=','Yes')
        ->get();

        $totalDifference = 0;
        $count = 0;

        foreach ($average_sos_all_data as $data) {
            $timeSosSuccess = strtotime($data->help_complete_time);
            $timeCommand = strtotime($data->time_go_to_help);

            if ($timeSosSuccess !== false && $timeCommand !== false) {
                $difference = $timeSosSuccess - $timeCommand;
                $totalDifference += $difference;
                $count++;
            }
        }

        if ($count > 0) {
            $averageDifference = $totalDifference / $count;

        } else {
            $averageDifference = "0";
        }

        //หาเวลาที่เช็คอินมากสุด และน้อยสุด
        $sos_timeInCounts = array();

        foreach ($average_sos_all_data as $index => $sos) {
            $timeIn = $sos->created_at;
            $hour = date('H', strtotime($timeIn));

            if (!isset($sos_timeInCounts[$hour])) {
                $sos_timeInCounts[$hour] = 0;
            }
            $sos_timeInCounts[$hour]++;

        }

        $sos_maxValue = 0; // กำหนดค่าเริ่มต้นสำหรับ $sos_maxValue
        $sos_minValue = 0; // กำหนดค่าเริ่มต้นสำหรับ $sos_minValue

        if (!empty($sos_timeInCounts)) {
            $sos_maxValue = max($sos_timeInCounts); // หาค่าที่มากที่สุดในอาร์เรย์
            $sos_maxTimeCounts = array_keys($sos_timeInCounts, $sos_maxValue);
            $sos_maxTimeCounts = array_slice($sos_maxTimeCounts, 0, 2);

            $sos_minValue = min($sos_timeInCounts); // หาค่าที่มากที่สุดในอาร์เรย์
            $sos_minTimeCounts = array_keys($sos_timeInCounts, $sos_minValue);
            $sos_minTimeCounts = array_slice($sos_minTimeCounts, 0, 2);
        }else{
            $sos_maxTimeCounts = [
                '0' => 0,
            ];
            $sos_minTimeCounts = [
                '0' => 0,
            ];
        }

        // ข้อมูลการขอความช่วยเหลือ 10 ลำดับล่าสุด
        $all_data_sos = Sos_map::where('area',$user_login->organization)
            ->where('content','help_area')
            ->limit(10)
            ->orderBy('id','desc')
            ->get();

        $amount_ten_data_sos = Sos_map::select('user_id', DB::raw('count(*) as amount_sos'))
            ->where('area', $user_login->organization)
            ->where('content', 'help_area')
            ->groupBy('user_id')
            ->orderBy('user_id', 'desc')
            ->limit(10)
            ->get();

        // เวลาในการช่วยเหลือ เร็ว ที่สุด 5 อันดับ
        $data_sos_fastest_5 = Sos_map::where('area',$user_login->organization)
            ->where('content','help_area')
            ->where('help_complete','=','Yes')
            ->limit(5)
            ->orderByRaw('TIMESTAMPDIFF(SECOND, help_complete_time, time_go_to_help) desc')
            ->get();

        // เวลาในการช่วยเหลือ ช้า ที่สุด 5 อันดับ
        $data_sos_slowest_5 = Sos_map::where('area',$user_login->organization)
            ->where('content','help_area')
            ->where('help_complete','=','Yes')
            ->limit(5)
            ->orderByRaw('TIMESTAMPDIFF(SECOND, help_complete_time, time_go_to_help) asc')
            ->get();

            $data_sos_score_best_5 = Sos_map::where('area', $user_login->organization)
            ->where('content', 'help_area')
            ->where('score_total', '!=', null)
            ->groupBy('helper') // กลุ่มตามชื่อผู้ใช้
            ->selectRaw('helper, AVG(score_total) as avg_score')
            ->orderByDesc('avg_score')
            ->limit(5)
            ->get();

        // MAP
        $sos_map_data = Sos_map::where('area',$user_login->organization)
            ->where('lat','!=',null)
            ->where('lng','!=',null)
            ->get();

        // การขอความช่วยเหลือในจังหวัด
        $area_sos = Sos_map::where('area',$user_login->organization)
            ->where('name_area', '!=', null)
            ->get('name_area');

        $decoded_area = [];

        foreach ($area_sos as $item) {
            $decoded = json_decode('"' . $item->name_area . '"'); // แปลง Unicode เป็นภาษาไทย

            if (isset($decoded)) {
                $decoded_area[] = $decoded;
            }
        }

        $districtCounts = collect($decoded_area)->countBy();

        // หา district ที่มากที่สุด
        $mostCommonDistrict = $districtCounts->sortDesc()->keys()->first();
        $countMostCommonDistrict = $districtCounts->sortDesc()->first();

        // ลบ district ที่มากที่สุดออกจาก districtCounts
        $districtCountsWithoutMostCommon = $districtCounts->except([$mostCommonDistrict]);

        $orderedDistricts = $districtCountsWithoutMostCommon->sortByDesc(function ($count, $district) {
            return $count;
        });


        //==================================================================================================================//
                                                        //  viinews
        //==================================================================================================================//
        $twoMonthsAgo = Carbon::now()->subMonths(2);

        //Check in
        $check_in_data = Partner::where('name', '=', $user_login->organization)
        ->where('name_area', '=', null)
        ->get();


        $check_in_data_arr = array();
        $count_hbd = 0;
        for ($i=0; $i < count($check_in_data); $i++) {
            $check_ins_finder = Check_in::where('partner_id',$check_in_data[$i]['id'])->where('created_at', '>=', $twoMonthsAgo)->get();

            //หาเวลาที่เช็คอินมากสุด และน้อยสุด
            $timeInCounts = array();

            foreach ($check_ins_finder as $index => $check_in) {
                $timeIn = $check_in->time_in;
                $hour = date('H', strtotime($timeIn));

                if (!isset($timeInCounts[$hour])) {
                    $timeInCounts[$hour] = 0;
                }
                $timeInCounts[$hour]++;

            }

            $maxValue = 0; // กำหนดค่าเริ่มต้นสำหรับ $maxValue
            $minValue = 0; // กำหนดค่าเริ่มต้นสำหรับ $minValue

            if (!empty($timeInCounts)) {
                $maxValue = max($timeInCounts); // หาค่าที่มากที่สุดในอาร์เรย์
                $maxTimeCounts = array_keys($timeInCounts, $maxValue);
                $maxTimeCounts = array_slice($maxTimeCounts, 0, 2);

                $minValue = min($timeInCounts); // หาค่าที่มากที่สุดในอาร์เรย์
                $minTimeCounts = array_keys($timeInCounts, $minValue);
                $minTimeCounts = array_slice($minTimeCounts, 0, 2);
            }else{
                $maxTimeCounts = [];
                $minTimeCounts = [];
            }

            // หาวันที่เช็คอินมากสุด และน้อยสุด
            $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            $thaiDays = ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'];

            $dayCount = array_fill_keys($daysOfWeek, 0); // เริ่มต้นนับทุกวันให้เป็น 0

            foreach ($check_ins_finder as $check_in) {
                $time_in = $check_in->time_in;
                $dayOfWeek = date('l', strtotime($time_in));

                $dayCount[$dayOfWeek]++; // เพิ่มจำนวนครั้งที่ปรากฏในวันนั้นๆ
            }

            $maxDayCount = max($dayCount);
            $maxDays = array_keys($dayCount, $maxDayCount);

            $minDayCount = min($dayCount);
            $minDays = array_keys($dayCount, $minDayCount);

            $maxThaiDay = [];
            foreach ($maxDays as $maxDay) {
                $maxThaiDay[] = $thaiDays[array_search($maxDay, $daysOfWeek)];
            }
            $maxThaiDay = array_slice($maxThaiDay, 0, 2);

            $minThaiDay = [];
            foreach ($minDays as $minDay) {
                $minThaiDay[] = $thaiDays[array_search($minDay, $daysOfWeek)];
            }
            $minThaiDay = array_slice($minThaiDay, 0, 2);

            // นับคนที่เกิดเดือนนี้
            $currentMonth = date('m');

            $encounteredIds = array();

            for ($isus=0; $isus < count($check_ins_finder); $isus++) {
                $finder_hbd = User::where('id',$check_ins_finder[$isus]['user_id'])->first();

                $userId = $finder_hbd->id;
                if (in_array($userId, $encounteredIds)) {
                    continue; // ถ้าเจอ id ที่ถูกนับแล้ว ข้ามไปเช็คคนถัดไป
                }

                $birthDate = $finder_hbd->brith;
                $birthMonth = date('m', strtotime($birthDate));

                if($birthMonth == $currentMonth){
                    $count_hbd++;
                    $encounteredIds[] = $userId; // เพิ่ม id เข้าไปในอาร์เรย์เพื่อไม่นับซ้ำ
                }
            }

            // // จำนวนการเข้าพื้นที่
            $count_check_in_at_area = count($check_ins_finder);

        }

        //========================== end =============================//

        $all_data_partner = Partner::where('name' ,'=', $user_login->organization)
        ->get();

        $check_in_chart_arr = $this->check_in_all_area_chart($all_data_partner);
        //ใช้ 2 ตัวนี้ สำหรับกราฟ แสดง เวลาเช็คอินของแต่ละพื้นที่
        $resultArray = [];
        $timeArray = [];

        for ($i=0; $i < count($all_data_partner); $i++) {
            $check_ins_data = Check_in::where('partner_id',$all_data_partner[$i]['id'])
            ->where('created_at', '>=', Carbon::now()->subMonths(2))
            ->get();
            // ddd($check_ins_data);
            $dataCounts = [];
            $timeCount = [];
            foreach ($check_ins_data as $index => $check_in) {
                $timeIn = $check_in->time_in;
                $hour = date('H:i', strtotime($timeIn));

                if (!isset($dataCounts[$hour])) {
                    $dataCounts[$hour] = 0;
                }
                $dataCounts[$hour]++;

                $formattime = date('H:i:s', strtotime($timeIn));
                if (!isset($timeCount[$formattime])) {
                    $timeCount[$formattime] = 0;
                }else{

                }


            }

            // foreach ($check_ins_data as $time_check_in) {
            //     $timeCount[] = $time_check_in['time_in'];
            // }

            if(!empty($all_data_partner[$i]['name_area'])){
                $resultArray[] = [
                    'name' => $all_data_partner[$i]['name_area'],
                    'data' => $dataCounts,
                    'time' => $timeCount
                ];
            }else{
                $resultArray[] = [
                    'name' => "รวม",
                    'data' => $dataCounts,
                    'time' => $timeCount
                ];
            }

        }


        //========================== end chart =============================//

        $data_checkin = Partner::where('name' ,'=', $user_login->organization)->first();

        //ไม่ได้เข้าพื้นที่นานที่สุด
        $last_checkIn_data = Check_in::where('partner_id',$data_checkin->id)
        ->groupBy('user_id')
        ->select('user_id')
        ->get();

        if(!empty($last_checkIn_data)){

            $sorted_last_checkIn_data = [];

            for ($i=0; $i < count($last_checkIn_data); $i++) {
                $data_user_from_checkin = User::where('id','=',$last_checkIn_data[$i]['user_id'])->first();
                $last_checkIn_data[$i]['name'] = $data_user_from_checkin->name;
                $last_checkIn_data[$i]['avatar'] = $data_user_from_checkin->avatar;
                $last_checkIn_data[$i]['photo'] = $data_user_from_checkin->photo;

                $data_checkin_from_checkin = Check_in::where('user_id',$last_checkIn_data[$i]['user_id'])
                ->orderBy('time_out','desc')
                ->get();

                $last_checkIn_data[$i]['time_out'] = $data_checkin_from_checkin[0]['time_out'];


                // เก็บข้อมูลที่ปรับแต่งเพื่อใช้ในการเรียงลำดับลงในอาร์เรย์
                $sorted_last_checkIn_data[] = $last_checkIn_data[$i];

            }

            usort($sorted_last_checkIn_data, function ($a, $b) {
                return strtotime($a['time_out']) - strtotime($b['time_out']);
            });
        }else{
            $sorted_last_checkIn_data = [];
        }


        //เข้าพื้นที่บ่อยที่สุด
        $most_often_checkIn_data = Check_in::where('partner_id',$data_checkin->id)
        ->select('*',DB::raw('COUNT(user_id) as count_user_checkin'))
        ->groupBy('user_id')
        ->orderBy('count_user_checkin','desc')
        ->limit(5)
        ->get();

        for ($i=0; $i < count($most_often_checkIn_data); $i++) {
            $data_user_from_checkin = User::where('id','=',$most_often_checkIn_data[$i]['user_id'])->first();
            $most_often_checkIn_data[$i]['name'] = $data_user_from_checkin->name;
            $most_often_checkIn_data[$i]['avatar'] = $data_user_from_checkin->avatar;
            $most_often_checkIn_data[$i]['photo'] = $data_user_from_checkin->photo;
        }

        //เข้าพื้นที่ล่าสุด
        $lastest_checkIn_data = Check_in::where('partner_id',$data_checkin->id)
        ->groupBy('user_id')
        ->select('user_id')
        ->limit(5)
        ->get();

        if(!empty($lastest_checkIn_data)){
            $sorted_lastest_checkIn_data = [];

            for ($i=0; $i < count($lastest_checkIn_data); $i++) {
                $data_user_from_checkin = User::where('id','=',$lastest_checkIn_data[$i]['user_id'])->first();
                $lastest_checkIn_data[$i]['name'] = $data_user_from_checkin->name;
                $lastest_checkIn_data[$i]['avatar'] = $data_user_from_checkin->avatar;
                $lastest_checkIn_data[$i]['photo'] = $data_user_from_checkin->photo;

                $data_checkin_from_checkin = Check_in::where('user_id',$last_checkIn_data[$i]['user_id'])
                ->orderBy('time_in','desc')
                ->get();


                $lastest_checkIn_data[$i]['time_in'] = $data_checkin_from_checkin[0]['time_in'];

                // เก็บข้อมูลที่ปรับแต่งเพื่อใช้ในการเรียงลำดับลงในอาร์เรย์
                $sorted_lastest_checkIn_data[] = $lastest_checkIn_data[$i];
            }

            usort($sorted_lastest_checkIn_data, function ($a, $b) {
                return strtotime($b['time_in']) - strtotime($a['time_in']);
            });
        }else{
            $sorted_lastest_checkIn_data = [];
        }
        //==================================================================================================================//
                                                        //  viimove
        //==================================================================================================================//

        $all_car_organization = Register_car::where('juristicNameTH',$user_login->organization)->get();

        $car_type_data = Register_car::where('juristicNameTH',$user_login->organization)->where('car_type','car')->count();
        $motorcycle_type_data = Register_car::where('juristicNameTH',$user_login->organization)->where('car_type','motorcycle')->count();
        $other_type_data = Register_car::where('juristicNameTH',$user_login->organization)->where('car_type','other')->count();


        // รถที่ลงทะเบียน 10 ลำดับล่าสุด
        $last_reg_car_top10 = Register_car::where('juristicNameTH',$user_login->organization)
        ->orderBy('id','desc')
        ->limit(10)
        ->get();

        for ($i=0; $i < count($last_reg_car_top10); $i++) {
            $data_user_from_last_reg_car_top10 = User::where('id','=',$last_reg_car_top10[$i]['user_id'])->first();
            $last_reg_car_top10[$i]['name_from_users'] = $data_user_from_last_reg_car_top10->name;
            $last_reg_car_top10[$i]['avatar'] = $data_user_from_last_reg_car_top10->avatar;
            $last_reg_car_top10[$i]['photo'] = $data_user_from_last_reg_car_top10->photo;
        }


        // รถที่ถูกรายงานมากที่สุด 5 อันดับ
        $report_car_top5 = Guest::where('organization',$user_login->organization)
        ->select('*',DB::raw('COUNT(user_id) as amount_report'))
        ->groupBy('user_id')
        ->get();

        for ($i=0; $i < count($report_car_top5); $i++) {
            $data_user_from_report_car_top5 = User::where('id','=',$report_car_top5[$i]['user_id'])->first();
            $report_car_top5[$i]['name_from_users'] = $data_user_from_report_car_top5->name;
            $report_car_top5[$i]['avatar'] = $data_user_from_report_car_top5->avatar;
            $report_car_top5[$i]['photo'] = $data_user_from_report_car_top5->photo;
        }

        // ประเภทรถมากที่สุด 5 อันดับ
        $type_car_registration_top5 = Register_car::where('juristicNameTH',$user_login->organization)
        ->select('*',DB::raw('COUNT(type_car_registration) as amount_type_car'))
        ->groupBy('type_car_registration')
        ->orderBy('amount_type_car','desc')
        ->limit(5)
        ->get();

        for ($i=0; $i < count($type_car_registration_top5); $i++) {
            $data_user_from_report_car_top5 = User::where('id','=',$type_car_registration_top5[$i]['user_id'])->first();
            $type_car_registration_top5[$i]['name_from_users'] = $data_user_from_report_car_top5->name;
            $type_car_registration_top5[$i]['avatar'] = $data_user_from_report_car_top5->avatar;
            $type_car_registration_top5[$i]['photo'] = $data_user_from_report_car_top5->photo;
        }

        //ยี่ห้อรถมากที่สุด
        $brand_car_top5 = Register_car::where('juristicNameTH',$user_login->organization)
        ->select('*',DB::raw('COUNT(brand) as amount_brand_car'))
        ->groupBy('brand')
        ->orderBy('amount_brand_car','desc')
        ->limit(5)
        ->get();


        //==================================================================================================================//
                                                        //  Dashboard BoardCast
        //==================================================================================================================//

        $all_ads_content = Ads_content::where('name_partner',$user_login->organization)->limit(5)->get();

        // เนื้อหาที่ส่งถึงผู้ใช้เยอะที่สุด
        $all_show_user = Ads_content::where('name_partner',$user_login->organization)
        ->get();

        // broadcast ที่ส่ง
        $most_send_round = Ads_content::where('name_partner', $user_login->organization)
        ->where('send_round', $all_show_user->max('send_round'))
        ->first();

        // broadcast ที่ส่งหาผู้ใช้ทั้งหมด และ ส่งหาผู้ใช้แบบไม่ซ้ำทั้งหมด
        for ($i=0; $i < count($all_show_user); $i++) {
            if(!empty($all_show_user[$i]['show_user'])){
                $all_Explode = json_decode($all_show_user[$i]['show_user']);

                $counts = array_count_values($all_Explode); // นับโดยสนคนซ้ำ
                $all_counts = 0;
                foreach ($counts as $key) {
                    $all_counts++;
                }

                $all_show_user[$i]['count_show_user'] = $all_counts; // ส่งหาผู้ใช้แบบไม่ซ้ำทั้งหมด
            }else{
                $all_show_user[$i]['count_show_user'] = 0;
            }
        }

        $show_user_maxCount = 0; // ระบุค่าสูงสุดเริ่มต้น
        $most_show_user = null; // ระบุตัวแปรเพื่อเก็บผลลัพธ์

        //หา count_show_user ที่มีค่าสูงสุด
        foreach ($all_show_user as $item) {
            if(!empty($item['count_show_user'])){
                if ($item['count_show_user'] > $show_user_maxCount) {
                    $show_user_maxCount = $item['count_show_user'];
                    $most_show_user = $item;
                }
            }
        }
        // broadcast ที่มีคนดู
        for ($i=0; $i < count($all_show_user); $i++) {
            if(!empty($all_show_user[$i]['user_click'])){
                $user_click_Explode = json_decode($all_show_user[$i]['user_click']);

                $counts_amount_user_click = count($user_click_Explode); // จำนวนคนคลิ๊ก โดยไม่สนคนซ้ำ

                $count_user_click = array_count_values($user_click_Explode); // จำนวนคนคลิ๊ก โดยสนคนซ้ำ
                $user_click = 0;
                foreach ($count_user_click as $key) {
                    $user_click++;
                }

                $all_show_user[$i]['count_user_click'] = $user_click;  // จำนวนคนคลิ๊ก แบบไม่รวมคนซ้ำ
                $all_show_user[$i]['count_amount_user_click'] = $counts_amount_user_click; // จำนวนคนคลิ๊ก แบบรวมคนซ้ำ
            }else{
                $all_show_user[$i]['count_user_click'] = 0;
                $all_show_user[$i]['count_amount_user_click'] = 0;
            }
        }

        $user_click_maxCount = 0; // ระบุค่าสูงสุดเริ่มต้น
        $most_user_click = null; // ระบุตัวแปรเพื่อเก็บผลลัพธ์

        //หา count_user_click ที่มีค่าสูงสุด
        foreach ($all_show_user as $item2) {
            if(!empty($item2['count_user_click'])){
                if ($item2['count_user_click'] > $user_click_maxCount) {
                    $user_click_maxCount = $item2['count_user_click'];
                    $most_user_click = $item2;
                }
            }
        }

        $user_click_maxCount_2 = 0; // ระบุค่าสูงสุดเริ่มต้น
        $most_amount_user_click = null; // ระบุตัวแปรเพื่อเก็บผลลัพธ์

        //หา count_user_click ที่มีค่าสูงสุด
        foreach ($all_show_user as $item3) {
            if(!empty($item3['count_amount_user_click'])){
                if ($item3['count_amount_user_click'] > $user_click_maxCount_2) {
                    $user_click_maxCount_2 = $item3['count_amount_user_click'];
                    $most_amount_user_click = $item3;
                }
            }
        }


        $count_all_content = Ads_content::where('name_partner',$user_login->organization)
        ->count();

        $count_all_by_checkin = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_check_in')
        ->count();

        $count_all_by_user = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_user')
        ->count();

        $count_all_by_car = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_car')
        ->count();

        // ======================== by_check_in =============================

        // เนื้อหาที่ส่งถึงผู้ใช้เยอะที่สุด
        $all_by_checkin_show_user = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_check_in')
        ->get();

        for ($i=0; $i < count($all_by_checkin_show_user); $i++) {
            if(!empty($all_by_checkin_show_user[$i]['show_user'])){
                $all_by_checkin_Explode = json_decode($all_by_checkin_show_user[$i]['show_user']);

                $counts = array_count_values($all_by_checkin_Explode);// นับโดยสนคนซ้ำ
                $all_by_checkin_counts = 0;
                foreach ($counts as $key) {
                    $all_by_checkin_counts++;
                }

                $all_by_checkin_show_user[$i]['count_show_user'] = $all_by_checkin_counts; // ส่งหาผู้ใช้แบบไม่ซ้ำ เฉพาะ by_checkin
            }else{
                $all_by_checkin_show_user[$i]['count_show_user'] = 0;
            }

        }
        // เรียงลำดับ มากไปน้อยสุด และจำกัดเอาแค่ 5 ลำดับ
        $sorted_all_by_checkin_show_user = $all_by_checkin_show_user->sortByDesc(function ($item) {
            return $item->count_show_user;
        })->take(5);

        // เนื้อหาที่ส่งบ่อยที่สุด
        $all_by_checkin_send_round = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_check_in')
        ->orderBy('send_round','desc')
        ->limit(5)
        ->get();

        // เนื้อหาที่มีคนดูมากที่สุด
        $all_by_checkin_user_click = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_check_in')
        ->get();

        for ($i=0; $i < count($all_by_checkin_user_click); $i++) {

            if(!empty($all_by_checkin_user_click[$i]['user_click'])){
                $user_click_Explode = json_decode($all_by_checkin_user_click[$i]['user_click']);

                $counts_by_checkin_user_click = count($user_click_Explode); // นับโดยไม่สนคนซ้ำ

                $count_user_click = array_count_values($user_click_Explode); // นับโดยสนคนซ้ำ
                $checkin_user_click = 0;
                foreach ($count_user_click as $key) {
                    $checkin_user_click++;
                }

                $all_by_checkin_user_click[$i]['count_user_click'] = $checkin_user_click; // จำนวนผู้ใช้ที่คลิ๊กแบบไม่ซ้ำ เฉพาะ by_checkin
                $all_by_checkin_user_click[$i]['count_amount_user_click'] = $counts_by_checkin_user_click; // จำนวนผู้ใช้ที่คลิ๊ก เฉพาะ by_checkin
            }else{
                $all_by_checkin_user_click[$i]['count_user_click'] = 0;
                $all_by_checkin_user_click[$i]['count_amount_user_click'] = 0;
            }

        }
        // เรียงลำดับ มากไปน้อยสุด และจำกัดเอาแค่ 5 ลำดับ
        $sorted_all_by_checkin_user_click = $all_by_checkin_user_click->sortByDesc(function ($item) {
            return $item->count_user_click;
        })->take(5);

        // เรียงลำดับ มากไปน้อยสุด และจำกัดเอาแค่ 5 ลำดับ
        $sorted_all_by_checkin_amount_user_click = $all_by_checkin_user_click->sortByDesc(function ($item) {
            return $item->count_amount_user_click;
        })->take(5);

        // ======================== by_car =============================

        // เนื้อหาที่ส่งถึงผู้ใช้เยอะที่สุด
        $all_by_car_show_user = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_car')
        ->get();

        for ($i=0; $i < count($all_by_car_show_user); $i++) {
            if(!empty($all_by_car_show_user[$i]['show_user'])){
                $all_by_car_Explode = json_decode($all_by_car_show_user[$i]['show_user']);

                $counts_by_car_amount = count($all_by_car_Explode); // นับโดยไม่สนคนซ้ำ

                $counts = array_count_values($all_by_car_Explode); // นับโดยสนคนซ้ำ
                $all_by_car_counts = 0;
                foreach ($counts as $key) {
                    $all_by_car_counts++;
                }

                $all_by_car_show_user[$i]['count_show_user'] = $all_by_car_counts; // ส่งหาผู้ใช้แบบไม่ซ้ำ เฉพาะ by_car
                $all_by_car_show_user[$i]['count_amount_user'] = $counts_by_car_amount; //ที่ส่งหาผู้ใช้ เฉพาะ by_car
            }else{
                $all_by_car_show_user[$i]['count_show_user'] = 0;
                $all_by_car_show_user[$i]['count_amount_user'] = 0;
            }

        }
        // เรียงลำดับ มากไปน้อยสุด และจำกัดเอาแค่ 5 ลำดับ
        $sorted_all_by_car_show_user = $all_by_car_show_user->sortByDesc(function ($item) {
            return $item->count_show_user;
        })->take(5);

        // เนื้อหาที่ส่งบ่อยที่สุด
        $all_by_car_send_round = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_car')
        ->orderBy('send_round','desc')
        ->limit(5)
        ->get();

        // เนื้อหาที่มีคนดูมากที่สุด
        $all_by_car_user_click = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_car')
        ->get();

        for ($i=0; $i < count($all_by_car_user_click); $i++) {

            if(!empty($all_by_car_user_click[$i]['user_click'])){
                $user_click_Explode = json_decode($all_by_car_user_click[$i]['user_click']);

                $counts_by_car_user_click = count($user_click_Explode); // นับโดยไม่สนคนซ้ำ

                $count_user_click = array_count_values($user_click_Explode); // นับโดยสนคนซ้ำ
                $checkin_user_click = 0;
                foreach ($count_user_click as $key) {
                    $checkin_user_click++;
                }

                $all_by_car_user_click[$i]['count_user_click'] = $checkin_user_click; // จำนวนผู้ใช้ที่คลิ๊กแบบไม่ซ้ำ เฉพาะ by_car
                $all_by_car_user_click[$i]['count_amount_user_click'] = $counts_by_car_user_click; // จำนวนผู้ใช้ที่คลิ๊ก เฉพาะ by_car
            }else{
                $all_by_car_user_click[$i]['count_user_click'] = 0;
                $all_by_car_user_click[$i]['count_amount_user_click'] = 0;
            }

        }
        // เรียงลำดับ มากไปน้อยสุด และจำกัดเอาแค่ 5 ลำดับ
        $sorted_all_by_car_user_click = $all_by_car_user_click->sortByDesc(function ($item) {
            return $item->count_user_click;
        })->take(5);

        // เรียงลำดับ มากไปน้อยสุด และจำกัดเอาแค่ 5 ลำดับ
        $sorted_all_by_car_amount_user_click = $all_by_car_user_click->sortByDesc(function ($item) {
            return $item->count_amount_user_click;
        })->take(5);

        // ======================== by_user =============================

        // เนื้อหาที่ส่งถึงผู้ใช้เยอะที่สุด
        $all_by_user_show_user = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_user')
        ->get();

        for ($i=0; $i < count($all_by_user_show_user); $i++) {
            if(!empty($all_by_user_show_user[$i]['show_user'])){
                $all_by_user_Explode = json_decode($all_by_user_show_user[$i]['show_user']);

                $counts_by_user_amount = count($all_by_user_Explode); // นับโดยไม่สนคนซ้ำ

                $counts = array_count_values($all_by_user_Explode);  // นับโดยสนคนซ้ำ
                $all_by_user_counts = 0;
                foreach ($counts as $key) {
                    $all_by_user_counts++;
                }

                $all_by_user_show_user[$i]['count_show_user'] = $all_by_user_counts; //ส่งหาผู้ใช้แบบไม่ซ้ำ เฉพาะ by_user
                $all_by_user_show_user[$i]['count_amount_user'] = $counts_by_user_amount; //ที่ส่งหาผู้ใช้ เฉพาะ by_user
            }else{
                $all_by_user_show_user[$i]['count_show_user'] = 0;
                $all_by_user_show_user[$i]['count_amount_user'] = 0;
            }

        }
        // เรียงลำดับ มากไปน้อยสุด และจำกัดเอาแค่ 5 ลำดับ
        $sorted_all_by_user_show_user = $all_by_user_show_user->sortByDesc(function ($item) {
            return $item->count_show_user;
        })->take(5);

        // เนื้อหาที่ส่งบ่อยที่สุด
        $all_by_user_send_round = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_user')
        ->orderBy('send_round','desc')
        ->limit(5)
        ->get();

        // เนื้อหาที่มีคนดูมากที่สุด
        $all_by_user_user_click = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_user')
        ->get();

        for ($i=0; $i < count($all_by_user_user_click); $i++) {

            if(!empty($all_by_user_user_click[$i]['user_click'])){
                $user_click_Explode = json_decode($all_by_user_user_click[$i]['user_click']);

                $counts_by_user_user_click = count($user_click_Explode); // นับโดยไม่สนคนซ้ำ

                $count_user_click = array_count_values($user_click_Explode); // นับโดยสนคนซ้ำ
                $checkin_user_click = 0;
                foreach ($count_user_click as $key) {
                    $checkin_user_click++;
                }

                $all_by_user_user_click[$i]['count_user_click'] = $checkin_user_click; // จำนวนผู้ใช้ที่คลิ๊กแบบไม่ซ้ำ เฉพาะ by_user
                $all_by_user_user_click[$i]['count_amount_user_click'] = $counts_by_user_user_click; // จำนวนผู้ใช้ที่คลิ๊ก เฉพาะ by_user
            }else{
                $all_by_user_user_click[$i]['count_user_click'] = 0;
                $all_by_user_user_click[$i]['count_amount_user_click'] = 0;
            }

        }
        // เรียงลำดับ มากไปน้อยสุด และจำกัดเอาแค่ 5 ลำดับ
        $sorted_all_by_user_user_click = $all_by_user_user_click->sortByDesc(function ($item) {
            return $item->count_user_click;
        })->take(5);

        // เรียงลำดับ มากไปน้อยสุด และจำกัดเอาแค่ 5 ลำดับ
        $sorted_all_by_user_amount_user_click = $all_by_user_user_click->sortByDesc(function ($item) {
            return $item->count_amount_user_click;
        })->take(5);


        return view('dashboard.dashboard_index',  compact(
            'data_officer',
            'data_user_from',
            'data_officer_last5',
            'data_user_from_last5',
            'all_user',
            'all_user_m',
            'count_type_login',
            'count_user_location',
            'all_data_partner',
            'sorted_last_checkIn_data',
            'most_often_checkIn_data',
            'sorted_lastest_checkIn_data',
            'all_car_organization',
            'last_reg_car_top10',
            'car_type_data',
            'motorcycle_type_data',
            'other_type_data',
            'report_car_top5',
            'type_car_registration_top5',
            'brand_car_top5',
            'count_all_content',
            'count_all_by_checkin',
            'count_all_by_user',
            'count_all_by_car',
            'sorted_all_by_checkin_show_user',
            'all_by_checkin_send_round',
            'sorted_all_by_checkin_user_click',
            'sorted_all_by_checkin_amount_user_click',
            'sorted_all_by_car_show_user',
            'all_by_car_send_round',
            'sorted_all_by_car_user_click',
            'sorted_all_by_car_amount_user_click',
            'sorted_all_by_user_show_user',
            'all_by_user_send_round',
            'sorted_all_by_user_user_click',
            'sorted_all_by_user_amount_user_click',
            'count_hbd',
            'count_check_in_at_area',
            'maxThaiDay',
            'minThaiDay',
            'maxDayCount',
            'minDayCount',
            'maxTimeCounts',
            'minTimeCounts',
            'maxValue',
            'minValue',
            'resultArray',
            'timeArray',
            'check_in_chart_arr',
            'data_sos_fastest_5',
            'data_sos_slowest_5',
            'data_sos_score_best_5',
            'all_data_sos',
            'amount_ten_data_sos',
            'mostCommonDistrict',
            'orderedDistricts',
            'countMostCommonDistrict',
            'sos_map_data',
            'count_sos_all_data',
            'averageDifference',
            'sos_maxTimeCounts',
            'sos_minTimeCounts',
            'all_ads_content',
            'all_show_user',
            'most_send_round',
            'most_show_user',
            'most_user_click',
            'most_amount_user_click'
        ));

    }

    //========================================== dashboard_user show ================================================

    function dashboard_user_index(Request $request)
    {
        $user_login = Auth::user();

        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $user_data = User::where('organization', '=', $user_login->organization)
                ->orWhere('user_from','LIKE',"%มีเงิน_จำกัด%")
                ->where('name', 'LIKE', "%$keyword%")
                ->orWhere('name_staff', 'LIKE', "%$keyword%")
                ->orWhere('sex', 'LIKE', "%$keyword%")
                ->orWhere('location_P', 'LIKE', "%$keyword%")
                ->orWhere('location_A', 'LIKE', "%$keyword%")
                ->orWhere('country', 'LIKE', "%$keyword%")
                ->orWhere('language', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $user_data = User::where('organization', '=', $user_login->organization)->orWhere('user_from','LIKE',"%มีเงิน_จำกัด%")->latest()->paginate($perPage);
        }

        // GroupBy ที่อยู่ไปใช้ใน dropdown filter
        $filter_location_P = DB::table('users')
            ->where('users.location_P', '!=', null)
            ->where('users.organization', '=', $user_login->organization)
            ->orWhere('user_from','LIKE',"%มีเงิน_จำกัด%")
            ->select('users.location_P')
            ->groupBy('users.location_P')
            ->orderBy('users.location_P','DESC')
            ->get();

        return view('dashboard.dashboard_user.user_index' , compact('user_data','filter_location_P'));
    }

    //========================================== dashboard_viisos show ================================================

    function dashboard_viisos(Request $request){
        // $user_login = Auth::user();
        $user_login = $request->get('user_organization');

        // dd($user_login);
        // นับ sos ทั้งหมด
        $data_sos = Sos_map::where('area',$user_login)
        ->where('content','help_area')
        ->get();
        // ddd($data_sos);
        return response()->json($data_sos);

    }
    function dashboard_1669_all_case_sos_show(Request $request){
        // $user_login = Auth::user();
        $user_login = $request->get('user_sub_organization');
        $year_start = $request->get('year');
        $month_start = $request->get('month_start');
        $month_end = $request->get('month_end');

        $data_sos = DB::table('sos_help_centers as main_sos_help_center')
        ->where('main_sos_help_center.notify', 'LIKE', "%$user_login%")
        ->join('sos_1669_form_yellows', 'main_sos_help_center.id', '=', 'sos_1669_form_yellows.sos_help_center_id')
        ->join('data_1669_officer_commands', 'main_sos_help_center.command_by', '=', 'data_1669_officer_commands.id')
        ->leftjoin('sos_help_centers as forward_sos_help_center_form', 'main_sos_help_center.forward_operation_from', '=', 'forward_sos_help_center_form.id')
        ->leftjoin('sos_help_centers as forward_sos_help_center_to', 'main_sos_help_center.forward_operation_to', '=', 'forward_sos_help_center_to.id')
        ->select(
            'main_sos_help_center.id',
            'main_sos_help_center.operating_code',
            'main_sos_help_center.status',
            'main_sos_help_center.remark_status',
            'main_sos_help_center.created_at',
            'main_sos_help_center.lat',
            'main_sos_help_center.lng',
            'main_sos_help_center.address',
            'main_sos_help_center.name_user',
            'main_sos_help_center.phone_user',
            'main_sos_help_center.organization_helper',
            'main_sos_help_center.name_helper',
            'main_sos_help_center.remark_photo_sos',
            'main_sos_help_center.time_command',
            'main_sos_help_center.time_go_to_help',
            'main_sos_help_center.time_to_the_scene',
            'main_sos_help_center.time_leave_the_scene',
            'main_sos_help_center.time_hospital',
            'main_sos_help_center.time_to_the_operating_base',
            'main_sos_help_center.time_sos_success',
            'main_sos_help_center.score_impression',
            'main_sos_help_center.score_period',
            'main_sos_help_center.score_total',
            'main_sos_help_center.comment_help',
            'main_sos_help_center.remark_helper',
            'main_sos_help_center.joint_case',
            'main_sos_help_center.refuse',
            'forward_sos_help_center_form.operating_code as forward_operating_form',
            'forward_sos_help_center_to.operating_code as forward_operating_to',
            'sos_1669_form_yellows.location_sos',
            'sos_1669_form_yellows.be_notified',
            'sos_1669_form_yellows.vehicle_type',
            'sos_1669_form_yellows.operating_suit_type',
            'sos_1669_form_yellows.symptom',
            'sos_1669_form_yellows.symptom_other',
            'sos_1669_form_yellows.idc',
            'sos_1669_form_yellows.rc',
            'sos_1669_form_yellows.rc_black_text',
            'sos_1669_form_yellows.km_create_sos_to_go_to_help',
            'sos_1669_form_yellows.km_to_the_scene_to_leave_the_scene',
            'sos_1669_form_yellows.km_hospital',
            'sos_1669_form_yellows.km_operating_base',
            'sos_1669_form_yellows.treatment',
            'sos_1669_form_yellows.sub_treatment',
            'sos_1669_form_yellows.patient_name_1',
            'sos_1669_form_yellows.patient_age_1',
            'sos_1669_form_yellows.patient_hn_1',
            'sos_1669_form_yellows.patient_vn_1',
            'sos_1669_form_yellows.delivered_province_1',
            'sos_1669_form_yellows.delivered_hospital_1',
            'sos_1669_form_yellows.patient_name_2',
            'sos_1669_form_yellows.patient_age_2',
            'sos_1669_form_yellows.patient_hn_2',
            'sos_1669_form_yellows.patient_vn_2',
            'sos_1669_form_yellows.delivered_province_2',
            'sos_1669_form_yellows.delivered_hospital_2',
            'sos_1669_form_yellows.patient_name_3',
            'sos_1669_form_yellows.patient_age_3',
            'sos_1669_form_yellows.patient_hn_3',
            'sos_1669_form_yellows.patient_vn_3',
            'sos_1669_form_yellows.delivered_province_3',
            'sos_1669_form_yellows.delivered_hospital_3',
            'sos_1669_form_yellows.submission_criteria',
            'sos_1669_form_yellows.communication_hospital',
            'sos_1669_form_yellows.registration_category',
            'sos_1669_form_yellows.registration_number',
            'sos_1669_form_yellows.registration_province',
            'sos_1669_form_yellows.owner_registration',
            'data_1669_officer_commands.name_officer_command'
        );

        if (($month_start == 11 || $month_start == 12) && ($month_end == 1 || $month_end == 2)) {
            $year_end = $year_start + 1;

            $data_sos_filter = $data_sos->whereYear('main_sos_help_center.created_at', '>=', $year_start)
            ->whereYear('main_sos_help_center.created_at', '<=', $year_end)
            ->where(function ($query) use ($month_start, $month_end) {
                $query->where(function ($query) use ($month_start, $month_end) {
                    $query->whereMonth('main_sos_help_center.created_at', '>=', $month_start)
                        ->whereMonth('main_sos_help_center.created_at', '<=', 12);
                })->orWhere(function ($query) use ($month_start, $month_end) {
                    $query->whereMonth('main_sos_help_center.created_at', '>=', 1)
                        ->whereMonth('main_sos_help_center.created_at', '<=', $month_end);
                });
            })
            ->get();

        } else {

            $data_sos_filter = $data_sos->whereYear('main_sos_help_center.created_at', $year_start)
                ->whereMonth('main_sos_help_center.created_at', '>=', $month_start)
                ->whereMonth('main_sos_help_center.created_at', '<=', $month_end)
                ->get();
        }
        // dd($user_login);
        // นับ sos ทั้งหมด


        // ddd($data_sos);
        return response()->json($data_sos_filter);

    }
    function viisos_3_topic(Request $request){
        $user_login = Auth::user();

        // เวลาในการช่วยเหลือ เร็ว ที่สุด 5 อันดับ
        $data_sos_score_time = Sos_map::where('area',$user_login->organization)
            ->where('help_complete','=','Yes')
            ->orderByRaw('TIMESTAMPDIFF(SECOND, help_complete_time, time_go_to_help) desc')
            ->get();

        return view('dashboard.dashboard_viisos.viisos_show.viisos_3_topic', compact('data_sos_score_time') );
    }

    function viisos_used(Request $request){
        // return view('dashboard.dashboard_viisos.viisos_show.viisos_test');
        return view('dashboard.dashboard_viisos.viisos_show.viisos_used');
    }

    //========================================== viimove show ================================================

    function viimove_register_car(Request $request){

        $user_login = Auth::user();

        $last_reg_car = Register_car::where('juristicNameTH',$user_login->organization)
        ->orderBy('id','desc')
        ->get();

        for ($i=0; $i < count($last_reg_car); $i++) {
            $data_user_from_last_reg_car = User::where('id','=',$last_reg_car[$i]['user_id'])->first();
            $last_reg_car[$i]['name_from_users'] = $data_user_from_last_reg_car->name;
            $last_reg_car[$i]['avatar'] = $data_user_from_last_reg_car->avatar;
            $last_reg_car[$i]['photo'] = $data_user_from_last_reg_car->photo;
        }

        return view('dashboard.dashboard_viimove.viimove_show.register_car', compact('last_reg_car') );
    }

    function viimove_car_3_topic(Request $request){
        $user_login = Auth::user();
        $type_page = $request->get('type_page');

        // รถที่ถูกรายงานมากที่สุด
        $report_car = Guest::where('organization',$user_login->organization)
        ->select('*',DB::raw('COUNT(user_id) as amount_report'))
        ->groupBy('user_id')
        ->get();

        for ($i=0; $i < count($report_car); $i++) {
            $data_user_from_report_car = User::where('id','=',$report_car[$i]['user_id'])->first();
            $report_car[$i]['name_from_users'] = $data_user_from_report_car->name;
            $report_car[$i]['avatar'] = $data_user_from_report_car->avatar;
            $report_car[$i]['photo'] = $data_user_from_report_car->photo;
        }

        // ประเภทรถมากที่สุด
        $type_car_registration = Register_car::where('juristicNameTH',$user_login->organization)
        ->select('*',DB::raw('COUNT(type_car_registration) as amount_type_car'))
        ->groupBy('type_car_registration')
        ->orderBy('amount_type_car','desc')
        ->get();

        for ($i=0; $i < count($type_car_registration); $i++) {
            $data_user_from_report_car = User::where('id','=',$type_car_registration[$i]['user_id'])->first();
            $type_car_registration[$i]['name_from_users'] = $data_user_from_report_car->name;
            $type_car_registration[$i]['avatar'] = $data_user_from_report_car->avatar;
            $type_car_registration[$i]['photo'] = $data_user_from_report_car->photo;
        }

        //ยี่ห้อรถมากที่สุด
        $brand_car = Register_car::where('juristicNameTH',$user_login->organization)
        ->select('*',DB::raw('COUNT(brand) as amount_brand_car'))
        ->groupBy('brand')
        ->orderBy('amount_brand_car','desc')
        ->get();

        return view('dashboard.dashboard_viimove.viimove_show.car_3_topic', compact('report_car','type_car_registration','brand_car','type_page') );
    }
    //========================================== viinews show ================================================

    function viinews_3_topic(Request $request){
        $user_login = Auth::user();
        $type_page = $request->get('type_page');

        $data_checkin = Partner::where('name' ,'=', $user_login->organization)->first();

        //ไม่ได้เข้าพื้นที่นานที่สุด
        $last_checkIn_data = Check_in::where('partner_id',$data_checkin->id)
        ->groupBy('user_id')
        ->select('user_id')
        ->get();

        $sorted_last_checkIn_data = [];

        for ($i=0; $i < count($last_checkIn_data); $i++) {
            $data_user_from_checkin = User::where('id','=',$last_checkIn_data[$i]['user_id'])->first();
            $last_checkIn_data[$i]['name'] = $data_user_from_checkin->name;
            $last_checkIn_data[$i]['avatar'] = $data_user_from_checkin->avatar;
            $last_checkIn_data[$i]['photo'] = $data_user_from_checkin->photo;

            $data_checkin_from_checkin = Check_in::where('user_id',$last_checkIn_data[$i]['user_id'])
            ->orderBy('time_out','desc')
            ->get();

            $last_checkIn_data[$i]['time_out'] = $data_checkin_from_checkin[0]['time_out'];

            // เก็บข้อมูลที่ปรับแต่งเพื่อใช้ในการเรียงลำดับลงในอาร์เรย์
            $sorted_last_checkIn_data[] = $last_checkIn_data[$i];
        }

        usort($sorted_last_checkIn_data, function ($a, $b) {
            return strtotime($a['time_out']) - strtotime($b['time_out']);
        });


        //เข้าพื้นที่บ่อยที่สุด
        $most_often_checkIn_data = Check_in::where('partner_id',$data_checkin->id)
        ->select('*',DB::raw('COUNT(user_id) as count_user_checkin'))
        ->groupBy('user_id')
        ->orderBy('count_user_checkin','desc')
        ->limit(5)
        ->get();

        for ($i=0; $i < count($most_often_checkIn_data); $i++) {
            $data_user_from_checkin = User::where('id','=',$most_often_checkIn_data[$i]['user_id'])->first();
            $most_often_checkIn_data[$i]['name'] = $data_user_from_checkin->name;
            $most_often_checkIn_data[$i]['avatar'] = $data_user_from_checkin->avatar;
            $most_often_checkIn_data[$i]['photo'] = $data_user_from_checkin->photo;
        }

        //เข้าพื้นที่ล่าสุด
        $lastest_checkIn_data = Check_in::where('partner_id',$data_checkin->id)
        ->groupBy('user_id')
        ->select('user_id')
        ->limit(5)
        ->get();

        $sorted_lastest_checkIn_data = [];

        for ($i=0; $i < count($lastest_checkIn_data); $i++) {
            $data_user_from_checkin = User::where('id','=',$lastest_checkIn_data[$i]['user_id'])->first();
            $lastest_checkIn_data[$i]['name'] = $data_user_from_checkin->name;
            $lastest_checkIn_data[$i]['avatar'] = $data_user_from_checkin->avatar;
            $lastest_checkIn_data[$i]['photo'] = $data_user_from_checkin->photo;

            $data_checkin_from_checkin = Check_in::where('user_id',$last_checkIn_data[$i]['user_id'])
            ->orderBy('time_in','desc')
            ->get();

            $lastest_checkIn_data[$i]['time_in'] = $data_checkin_from_checkin[0]['time_in'];

            // เก็บข้อมูลที่ปรับแต่งเพื่อใช้ในการเรียงลำดับลงในอาร์เรย์
            $sorted_lastest_checkIn_data[] = $lastest_checkIn_data[$i];
        }

        usort($sorted_lastest_checkIn_data, function ($a, $b) {
            return strtotime($b['time_in']) - strtotime($a['time_in']);
        });


        return view('dashboard.dashboard_viinews.viinews_show.viinews_3_topic', compact('sorted_last_checkIn_data','most_often_checkIn_data','sorted_lastest_checkIn_data','type_page') );
    }

    //========================================== boardcast show ================================================

    function boardcast_3_topic(Request $request){
        $user_login = Auth::user();
        $type_page = $request->get('type_page');

        $ads_contents_all = Ads_content::where('name_partner',$user_login->organization)->get();

        //========================== by check_in =============================

        $all_by_checkin = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_check_in')
        ->get();

        for ($i=0; $i < count($all_by_checkin); $i++) {
            // if(!empty($all_by_checkin[$i]['show_user'])){
            //     $all_by_checkin_Explode = json_decode($all_by_checkin[$i]['show_user']);

            //     $counts = array_count_values($all_by_checkin_Explode);

            //     $all_by_checkin_counts = 0;
            //     foreach ($counts as $key => $value) {
            //         $all_by_checkin_counts++;
            //     }

            //     $all_by_checkin[$i]['count_show_user'] = $all_by_checkin_counts;
            // }else{
            //     $all_by_checkin[$i]['count_show_user'] = 0;
            // }

            // if(!empty($all_by_checkin[$i]['user_click'])){
            //     $user_click_Explode = json_decode($all_by_checkin[$i]['user_click']);

            //     $count_user_click = array_count_values($user_click_Explode);

            //     $checkin_user_click = 0;
            //     foreach ($count_user_click as $key => $value) {
            //         $checkin_user_click++;
            //     }

            //     $all_by_checkin[$i]['count_user_click'] = $checkin_user_click;
            // }else{
            //     $all_by_checkin[$i]['count_user_click'] = 0;
            // }

        }

        // เรียงลำดับ มากไปน้อยสุด และจำกัดเอาแค่ 5 ลำดับ
        $sorted_all_by_checkin = $all_by_checkin->sortByDesc(function ($item) {
            return $item->send_round;
        });

        //========================== by car =============================

        $all_by_car = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_car')
        ->get();

        for ($i=0; $i < count($all_by_car); $i++) {
            if(!empty($all_by_car[$i]['show_user'])){
                $all_by_car_Explode = json_decode($all_by_car[$i]['show_user']);

                $counts = array_count_values($all_by_car_Explode);

                $all_by_car_counts = 0;
                foreach ($counts as $key => $value) {
                    $all_by_car_counts++;
                }

                $all_by_car[$i]['count_show_user'] = $all_by_car_counts;
            }else{
                $all_by_car[$i]['count_show_user'] = 0;
            }

            if(!empty($all_by_car[$i]['user_click'])){
                $user_click_Explode = json_decode($all_by_car[$i]['user_click']);

                $count_user_click = array_count_values($user_click_Explode);

                $checkin_user_click = 0;
                foreach ($count_user_click as $key => $value) {
                    $checkin_user_click++;
                }

                $all_by_car[$i]['count_user_click'] = $checkin_user_click;
            }else{
                $all_by_car[$i]['count_user_click'] = 0;
            }

        }

        // เรียงลำดับ มากไปน้อยสุด และจำกัดเอาแค่ 5 ลำดับ
        $sorted_all_by_car = $all_by_car->sortByDesc(function ($item) {
            return $item->send_round;
        });

        //========================== by user =============================

        $all_by_user = Ads_content::where('name_partner',$user_login->organization)
        ->where('type_content','BC_by_user')
        ->get();

        for ($i=0; $i < count($all_by_user); $i++) {
            if(!empty($all_by_user[$i]['show_user'])){
                $all_by_user_Explode = json_decode($all_by_user[$i]['show_user']);

                $counts = array_count_values($all_by_user_Explode);

                $all_by_user_counts = 0;
                foreach ($counts as $key => $value) {
                    $all_by_user_counts++;
                }

                $all_by_user[$i]['count_show_user'] = $all_by_user_counts;
            }else{
                $all_by_user[$i]['count_show_user'] = 0;
            }

            if(!empty($all_by_user[$i]['user_click'])){
                $user_click_Explode = json_decode($all_by_user[$i]['user_click']);

                $count_user_click = array_count_values($user_click_Explode);

                $checkin_user_click = 0;
                foreach ($count_user_click as $key => $value) {
                    $checkin_user_click++;
                }

                $all_by_user[$i]['count_user_click'] = $checkin_user_click;
            }else{
                $all_by_user[$i]['count_user_click'] = 0;
            }

        }

        // เรียงลำดับ มากไปน้อยสุด และจำกัดเอาแค่ 5 ลำดับ
        $sorted_all_by_user = $all_by_user->sortByDesc(function ($item) {
            return $item->send_round;
        });

        return view('dashboard.dashboard_boardcast.boardcast_show.boardcast_3_topic', compact('sorted_all_by_checkin','sorted_all_by_car','sorted_all_by_user','type_page') );
    }


    //=========================================== from api =====================================

    function filter_user(Request $request){
        $user_login = Auth::user();

        $keyword = $request->all();
        $perPage = 10;

        if(!empty($keyword)){

        } else {
            // GroupBy ช่องทาง login
            $filter_location_P = DB::table('users')
            ->where('users.location_P', '!=', null)
            ->where('users.organization', '=', $user_login->organization)
            ->orWhere('user_from','LIKE',"%มีเงิน_จำกัด%")
            ->select('users.location_P')
            ->groupBy('users.location_P')
            ->orderBy('users.location_P','DESC')
            ->get();
        }

        return $filter_location_P;
    }

    function get_area_checkin(Request $request , $area_id , $user_login){

        $check_in_data = Partner::where('id' , $area_id)
        ->get();

        if(!empty($check_in_data)){
            for ($i=0; $i < count($check_in_data); $i++) {
                $check_ins_finder = Check_in::where('partner_id',$check_in_data[$i]['id'])
                ->where('created_at', '>=', Carbon::now()->subMonths(2))
                ->get();

                //หาเวลาที่เช็คอินมากสุด และน้อยสุด
                $timeInCounts = array();

                foreach ($check_ins_finder as $index => $check_in) {
                    $timeIn = $check_in->time_in;
                    $hour = date('H', strtotime($timeIn));

                    if (!isset($timeInCounts[$hour])) {
                        $timeInCounts[$hour] = 0;
                    }
                    $timeInCounts[$hour]++;

                }

                $maxValue = 0; // กำหนดค่าเริ่มต้นสำหรับ $maxValue
                $minValue = 0; // กำหนดค่าเริ่มต้นสำหรับ $minValue

                if (!empty($timeInCounts)) {
                    $maxValue = max($timeInCounts); // หาค่าที่มากที่สุดในอาร์เรย์
                    $maxTimeCounts = array_keys($timeInCounts, $maxValue);
                    $maxTimeCounts = array_slice($maxTimeCounts, 0, 2);

                    $minValue = min($timeInCounts); // หาค่าที่มากที่สุดในอาร์เรย์
                    $minTimeCounts = array_keys($timeInCounts, $minValue);
                    $minTimeCounts = array_slice($minTimeCounts, 0, 2);
                }else{
                    $maxTimeCounts = [];
                    $minTimeCounts = [];
                }

                //หาวันที่เช็คอินมากสุด และน้อยสุด
               // หาวันที่เช็คอินมากสุด และน้อยสุด
                $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                $thaiDays = ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'];

                $dayCount = array_fill_keys($daysOfWeek, 0); // เริ่มต้นนับทุกวันให้เป็น 0

                foreach ($check_ins_finder as $check_in) {
                    $time_in = $check_in->time_in;
                    $dayOfWeek = date('l', strtotime($time_in));

                    $dayCount[$dayOfWeek]++; // เพิ่มจำนวนครั้งที่ปรากฏในวันนั้นๆ
                }

                $maxDayCount = max($dayCount);
                $maxDays = array_keys($dayCount, $maxDayCount);

                $minDayCount = min($dayCount);
                $minDays = array_keys($dayCount, $minDayCount);

                $maxThaiDay = [];
                foreach ($maxDays as $maxDay) {
                    $maxThaiDay[] = $thaiDays[array_search($maxDay, $daysOfWeek)];
                }

                $minThaiDay = [];
                foreach ($minDays as $minDay) {
                    $minThaiDay[] = $thaiDays[array_search($minDay, $daysOfWeek)];
                }

                // นับคนที่เกิดเดือนนี้
                $currentMonth = date('m');
                $count_hbd = 0;
                $encounteredIds = array();

                for ($isus=0; $isus < count($check_ins_finder); $isus++) {
                    $finder_hbd = User::where('id',$check_ins_finder[$isus]['user_id'])->first();

                    $userId = $finder_hbd->id;
                    if (in_array($userId, $encounteredIds)) {
                        continue; // ถ้าเจอ id ที่ถูกนับแล้ว ข้ามไปเช็คคนถัดไป
                    }

                    $birthDate = $finder_hbd->brith;
                    $birthMonth = date('m', strtotime($birthDate));

                    if($birthMonth == $currentMonth){
                        $count_hbd++;
                        $encounteredIds[] = $userId; // เพิ่ม id เข้าไปในอาร์เรย์เพื่อไม่นับซ้ำ
                    }
                }

                // จำนวนการเข้าพื้นที่
                $count_check_in_at_area = count($check_ins_finder);

            }

            // เปลี่ยนค่าว่างของพื้นที่รวม ให้เป็นรวม
            if(empty($check_in_data->name_area)){
                $name_area_show = "รวม";
            }

            // นำตัวแปรมาเรียงเป็น Associative Array
            $responseData = [
                'count_hbd' => $count_hbd,
                'count_check_in_at_area' => $count_check_in_at_area,
                'maxThaiDay' => $maxThaiDay,
                'minThaiDay' => $minThaiDay,
                'maxDayCount' => $maxDayCount,
                'minDayCount' => $minDayCount,
                'maxTimeCounts' => $maxTimeCounts,
                'minTimeCounts' => $minTimeCounts,
                'maxValue' => $maxValue,
                'minValue' => $minValue,
                'name_area' => $name_area_show,
            ];
        }else{
            // เปลี่ยนค่าว่างของพื้นที่รวม ให้เป็นรวม
            if(empty($check_in_data->name_area)){
                $name_area_show = "รวม";
            }

            // นำตัวแปรมาเรียงเป็น Associative Array
            $responseData = [
                'count_hbd' => 0,
                'count_check_in_at_area' => 0,
                'maxThaiDay' => ['--'],
                'minThaiDay' => ['--'],
                'maxDayCount' => 0,
                'minDayCount' => 0,
                'maxTimeCounts' => ['--'],
                'minTimeCounts' => ['--'],
                'maxValue' => 0,
                'minValue' => 0,
                'name_area' => $name_area_show,
            ];
        }

        // ส่งข้อมูลกลับไปยัง client ในรูปแบบ JSON
        return response()->json($responseData);
    }


    function get_area_checkin_3_topic(Request $request , $area_id , $user_login){

        $data_checkin = Partner::where('id',$area_id)->first();
        // Check in
        if(!empty($data_checkin->name_area)){
            $name_area = $data_checkin->name_area;
        }else{
            $name_area = "รวม";
        }

        //ไม่ได้เข้าพื้นที่นานที่สุด
        $last_checkIn_data = Check_in::where('partner_id',$data_checkin->id)
        ->groupBy('user_id')
        ->select('user_id')
        ->get();

        $sorted_last_checkIn_data = [];

        for ($i=0; $i < count($last_checkIn_data); $i++) {
            $data_user_from_checkin = User::where('id','=',$last_checkIn_data[$i]['user_id'])->first();
            $last_checkIn_data[$i]['name'] = $data_user_from_checkin->name;
            $last_checkIn_data[$i]['avatar'] = $data_user_from_checkin->avatar;
            $last_checkIn_data[$i]['photo'] = $data_user_from_checkin->photo;

            $data_checkin_from_checkin = Check_in::where('user_id',$last_checkIn_data[$i]['user_id'])
            ->orderBy('time_out','desc')
            ->get();

            $last_checkIn_data[$i]['time_out'] = $data_checkin_from_checkin[0]['time_out'];

            // เก็บข้อมูลที่ปรับแต่งเพื่อใช้ในการเรียงลำดับลงในอาร์เรย์
            $sorted_last_checkIn_data[] = $last_checkIn_data[$i];
        }

        usort($sorted_last_checkIn_data, function ($a, $b) {
            return strtotime($a['time_out']) - strtotime($b['time_out']);
        });


        //เข้าพื้นที่บ่อยที่สุด
        $most_often_checkIn_data = Check_in::where('partner_id',$data_checkin->id)
        ->select('*',DB::raw('COUNT(user_id) as count_user_checkin'))
        ->groupBy('user_id')
        ->orderBy('count_user_checkin','desc')
        ->limit(5)
        ->get();

        for ($i=0; $i < count($most_often_checkIn_data); $i++) {
            $data_user_from_checkin = User::where('id','=',$most_often_checkIn_data[$i]['user_id'])->first();
            $most_often_checkIn_data[$i]['name'] = $data_user_from_checkin->name;
            $most_often_checkIn_data[$i]['avatar'] = $data_user_from_checkin->avatar;
            $most_often_checkIn_data[$i]['photo'] = $data_user_from_checkin->photo;
        }

        //เข้าพื้นที่ล่าสุด
        $lastest_checkIn_data = Check_in::where('partner_id',$data_checkin->id)
        ->groupBy('user_id')
        ->select('user_id')
        ->limit(5)
        ->get();

        $sorted_lastest_checkIn_data = [];

        for ($i=0; $i < count($lastest_checkIn_data); $i++) {
            $data_user_from_checkin = User::where('id','=',$lastest_checkIn_data[$i]['user_id'])->first();
            $lastest_checkIn_data[$i]['name'] = $data_user_from_checkin->name;
            $lastest_checkIn_data[$i]['avatar'] = $data_user_from_checkin->avatar;
            $lastest_checkIn_data[$i]['photo'] = $data_user_from_checkin->photo;

            $data_checkin_from_checkin = Check_in::where('user_id',$last_checkIn_data[$i]['user_id'])
            ->orderBy('time_in','desc')
            ->get();

            $lastest_checkIn_data[$i]['time_in'] = $data_checkin_from_checkin[0]['time_in'];

            // เก็บข้อมูลที่ปรับแต่งเพื่อใช้ในการเรียงลำดับลงในอาร์เรย์
            $sorted_lastest_checkIn_data[] = $lastest_checkIn_data[$i];
        }

        usort($sorted_lastest_checkIn_data, function ($a, $b) {
            return strtotime($b['time_in']) - strtotime($a['time_in']);
        });

         // นำตัวแปรมาเรียงเป็น Associative Array
        $responseData = [
            'sorted_last_checkIn_data' => $sorted_last_checkIn_data,
            'most_often_checkIn_data' => $most_often_checkIn_data,
            'sorted_lastest_checkIn_data' => $sorted_lastest_checkIn_data,
            'name_area' => $name_area,
        ];

        // ส่งข้อมูลกลับไปยัง client ในรูปแบบ JSON
        return response()->json($responseData);
    }

    function map_sos_organization(Request $request,$user_login_organization){

        // $user_login = $request->user_login_organization;

        $sos_map_data = Sos_map::where('area',$user_login_organization)->get();

        return $sos_map_data;
    }

    function check_in_all_area_chart($all_data_partner){

        $hours = [];
        $currentHour = Carbon::now()->startOfDay();
        $chartData = array();

        for ($i = 0; $i < 24; $i++) {
            $hours[] = $currentHour->format('H:00');
            $currentHour->addHour();
        }

        $iii = 0;

        $chartData = [
            'categories' => $hours,
            'series' => [],
        ];

        foreach ($all_data_partner as $key) {

            $data[$iii] = DB::table('check_ins')
                ->where('partner_id',$key->id)
                ->where('created_at', '>=', Carbon::now()->subMonths(2))
                ->select(
                    DB::raw('TIME_FORMAT(time_in, "%H:00") as hour'),
                    DB::raw('COUNT(*) as count')
                )
                ->groupBy('hour')
                ->get();

            if(empty($key->name_area)){
                $key->name_area = "รวม";
            }

            $data_array_loop =
                [
                    'name' => $key->name_area,
                    'data' => $this->mergeData($hours, $data[$iii]),
                ];

            array_push($chartData['series'],$data_array_loop);

            $iii++;

        }


        return $chartData;
    }

    private function mergeData($hours, $data)
    {
        $mergedData = [];

        foreach ($hours as $hour) {
            $match = $data->firstWhere('hour', $hour);

            if ($match) {
                $mergedData[] = $match->count;
            } else {
                $mergedData[] = 0;
            }
        }

        return $mergedData;
    }

    function viisos_used_api($user_login_organization){

        $amount_ten_data_sos = Sos_map::select('user_id', DB::raw('count(*) as amount_sos'))
            ->where('area', $user_login_organization)
            ->where('content', 'help_area')
            ->groupBy('user_id')
            ->leftJoin('users', 'sos_maps.user_id', '=', 'users.id')
            ->addSelect('users.name as name_user', 'users.block_sos as block_sos')
            ->orderBy('sos_maps.user_id', 'desc')
            ->get();

        return $amount_ten_data_sos;
    }

    function update_status_block_user(Request $request){
        $user_id = $request->get('user_id');
        $type = $request->get('type');


        if ($type == "block") {
            DB::table('users')
            ->where([
                    ['id', $user_id],
                ])
            ->update([
                    'block_sos' => null,
                ]);
            $status = "unblock";
        } else {
            DB::table('users')
            ->where([
                    ['id', $user_id],
                ])
            ->update([
                    'block_sos' => "Yes",
                ]);
            $status = "block";
        }
        return $status;
    }


}
