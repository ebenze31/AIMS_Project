<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Carbon\Carbon;

use App\Models\Aims_emergency;
use App\Models\Aims_emergency_operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Aims_command;
use App\Models\Aims_area;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use App\Models\Mylog;
use App\Http\Controllers\API\LineApiController;

class Aims_emergencysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $aims_emergencys = Aims_emergency::where('aims_partner_id', 'LIKE', "%$keyword%")
                ->orWhere('aims_area_id', 'LIKE', "%$keyword%")
                ->orWhere('report_platform', 'LIKE', "%$keyword%")
                ->orWhere('name_reporter', 'LIKE', "%$keyword%")
                ->orWhere('type_reporter', 'LIKE', "%$keyword%")
                ->orWhere('phone_reporter', 'LIKE', "%$keyword%")
                ->orWhere('emergency_type', 'LIKE', "%$keyword%")
                ->orWhere('emergency_detail', 'LIKE', "%$keyword%")
                ->orWhere('emergency_lat', 'LIKE', "%$keyword%")
                ->orWhere('emergency_lng', 'LIKE', "%$keyword%")
                ->orWhere('emergency_location', 'LIKE', "%$keyword%")
                ->orWhere('emergency_photo', 'LIKE', "%$keyword%")
                ->orWhere('score_impression', 'LIKE', "%$keyword%")
                ->orWhere('score_period', 'LIKE', "%$keyword%")
                ->orWhere('score_total', 'LIKE', "%$keyword%")
                ->orWhere('comment_help', 'LIKE', "%$keyword%")
                ->orWhere('patient_name', 'LIKE', "%$keyword%")
                ->orWhere('patient_birth', 'LIKE', "%$keyword%")
                ->orWhere('patient_identification', 'LIKE', "%$keyword%")
                ->orWhere('patient_gender', 'LIKE', "%$keyword%")
                ->orWhere('patient_blood_type', 'LIKE', "%$keyword%")
                ->orWhere('patient_phone', 'LIKE', "%$keyword%")
                ->orWhere('patient_address', 'LIKE', "%$keyword%")
                ->orWhere('patient_congenital_disease', 'LIKE', "%$keyword%")
                ->orWhere('patient_allergic_drugs', 'LIKE', "%$keyword%")
                ->orWhere('patient_regularly_medications', 'LIKE', "%$keyword%")
                ->orWhere('symptom', 'LIKE', "%$keyword%")
                ->orWhere('symptom_other', 'LIKE', "%$keyword%")
                ->orWhere('idc', 'LIKE', "%$keyword%")
                ->orWhere('rc', 'LIKE', "%$keyword%")
                ->orWhere('rc_black_text', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $aims_emergencys = Aims_emergency::latest()->paginate($perPage);
        }

        return view('aims_emergencys.index', compact('aims_emergencys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('aims_emergencys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Aims_emergency::create($requestData);

        return redirect('aims_emergencys')->with('flash_message', 'Aims_emergency added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $aims_emergency = Aims_emergency::findOrFail($id);

        return view('aims_emergencys.show', compact('aims_emergency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $aims_emergency = Aims_emergency::findOrFail($id);

        return view('aims_emergencys.edit', compact('aims_emergency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $aims_emergency = Aims_emergency::findOrFail($id);
        $aims_emergency->update($requestData);

        return redirect('aims_emergencys')->with('flash_message', 'Aims_emergency updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Aims_emergency::destroy($id);

        return redirect('aims_emergencys')->with('flash_message', 'Aims_emergency deleted!');
    }

    function get_polygon_all(){

        $polygon = DB::table('aims_areas')
            ->join('aims_partners', 'aims_areas.aims_partner_id', '=', 'aims_partners.id')
            ->select(
                'aims_areas.*',
                'aims_partners.name as name_partner',
                'aims_partners.full_name as full_name_partner',
                'aims_partners.logo as logo',
                'aims_partners.color as color',
                'aims_partners.province as province',
                'aims_partners.district as district',
                'aims_partners.sub_district as sub_district',
            )
            ->where('aims_areas.status', "show")
            ->get();

        return $polygon ;

    }

    function send_emergency(Request $request)
    {
        $current_time = Carbon::now();
        $requestData = $request->all();

        if ($request->hasFile('emergency_photo')) {
            $requestData['emergency_photo'] = $request->file('emergency_photo')
                ->store('uploads', 'public');
        }

        $emergency = Aims_emergency::create($requestData);

        // เช็คสถานะเปิดทำการของ Partner
        $status_message = 'ไม่เปิดทำการ';
        $check_open_partner = Aims_area::where('id' , $requestData['aims_area_id'])->first();

        if ($check_open_partner) {
            if ($check_open_partner->check_time_command === 'No') {
                $status_message = 'เปิดทำการ';
            } elseif ($check_open_partner->check_time_command === 'Yes') {
                // แปลงเวลาเริ่มต้นและเวลาสิ้นสุดเป็น Carbon
                $start_time = Carbon::createFromFormat('H:i:s', $check_open_partner->time_start_command);
                $end_time = Carbon::createFromFormat('H:i:s', $check_open_partner->time_end_command);

                // ตรวจสอบว่าเวลาอยู่ในช่วงหรือไม่
                if ($current_time->between($start_time, $end_time)) {
                    $status_message = 'เปิดทำการ';
                }
            }
        }

        // ข้อมูล สำหรับสั่งการ
        $data_operation = [];
        $data_operation['aims_emergency_id'] = $emergency->id ;

        // operating code
        $partner_id = $emergency->aims_partner_id ;
        $area_id = $emergency->aims_area_id ;
        $run_number = $check_open_partner->for_gen_code ;

        $yearMonth = $current_time->format('y') . $current_time->format('m');
        $formattedPartnerId = str_pad($partner_id, 4, '0', STR_PAD_LEFT);
        $formattedAreaId = str_pad($area_id, 5, '0', STR_PAD_LEFT);
        $new_run_number = $run_number + 1;
        $formattedRunNumber = str_pad($new_run_number, 4, '0', STR_PAD_LEFT);
        $final_code = "{$yearMonth}-{$formattedPartnerId}-{$formattedAreaId}-{$formattedRunNumber}";

        $check_open_partner->for_gen_code = $new_run_number;
        $check_open_partner->save();

        $data_operation['operating_code'] = $final_code ;

        // -->> เปิดทำการ
        if($status_message == 'เปิดทำการ'){
            $aims_commands = Aims_command::where('status' , 'Standby')
                ->where('aims_partner_id' , $requestData['aims_partner_id'])
                ->where('aims_area_id' , $requestData['aims_area_id'])
                ->orderByRaw('CAST(number AS UNSIGNED) ASC')
                ->first();

            $data_operation['notify'] = "command_id-" . $aims_commands->id ;
            $data_operation['status'] = "รับแจ้งเหตุ" ;
            $data_operation['time_create_sos'] = $current_time;
        }
        // -->> ไม่เปิดทำการ
        else if($status_message == 'ไม่เปิดทำการ'){
            $data_operation['notify'] = "finished-" . "auto" ;
            $data_operation['command_by'] = "auto" ;
            $data_operation['status'] = "สั่งการ (auto)" ;
            $data_operation['time_create_sos'] = $current_time;
            $data_operation['time_command'] = $current_time; 

            // ค้นหาเจ้าหน้าที่ของพื้นที่ที่ใกล้จุดเกิดเหตุ
        }
        
        
        $emergency_operation = Aims_emergency_operation::create($data_operation);

        return "success" ;
        // return $aims_commands ;
    }

    function check_sos_alarm($user_id){

        $check_data = Aims_emergency_operation::where('notify', 'command_id-' . $user_id)->first();
        $data_return = [];

        if ($check_data) {
            // สำเนาค่าปัจจุบันก่อนอัปเดต
            $original_data = clone $check_data;

            // อัปเดต notify
            $check_data->notify = 'finished-' . $user_id;
            $check_data->save();

            $emergency = Aims_emergency::where('id' , $original_data->aims_emergency_id)->first();

            $data_return['status'] = "alarm" ;
            $data_return['data'] = $original_data ;
            $data_return['emergency'] = $emergency ;

            return $data_return;
        }
        else{
            $data_return['status'] = "empty" ;
            return $data_return;
        }

    }

    function command_operations($id){

        $columns = Schema::getColumnListing('aims_emergency_operations');

        $selects = array_map(function ($col) {
            return "aims_emergency_operations.$col as op_$col";
        }, $columns);

        $emergency = DB::table('aims_emergencys')
            ->where('aims_emergencys.id', '=', $id)
            ->leftJoin('aims_emergency_operations', 'aims_emergencys.id', '=', 'aims_emergency_operations.aims_emergency_id')
            ->select(array_merge(['aims_emergencys.*'], $selects))
            ->first();

        // echo "<pre>";
        // print_r($emergency);
        // echo "<pre>";
        // exit();

        return view('aims_emergencys.command_operations', compact('emergency')); 
    }

    function send_sos_to_officer(Request $request)
    {
        $date_now =  date("d-m-Y");
        $time_now =  date("H:i");
        $text_at = '@' ;

        $requestData = $request->all();
        $officer_id = $requestData['aims_operating_officers_id'];
        $emergency_id = $requestData['emergency_id'];

        $columns = Schema::getColumnListing('aims_emergency_operations');
        $selects = array_map(function ($col) {
            return "aims_emergency_operations.$col as op_$col";
        }, $columns);

        $emergency = DB::table('aims_emergencys')
            ->where('aims_emergencys.id', '=', $emergency_id)
            ->leftJoin('aims_emergency_operations', 'aims_emergencys.id', '=', 'aims_emergency_operations.aims_emergency_id')
            ->leftJoin('aims_areas', 'aims_emergencys.aims_area_id', '=', 'aims_areas.id')
            ->leftJoin('aims_partners', 'aims_emergencys.aims_partner_id', '=', 'aims_partners.id')
            ->select(array_merge(
                ['aims_emergencys.*'],
                $selects,
                ['aims_areas.name_area as area_name_area'],
                ['aims_partners.name as partner_name']
            ))
            ->first();


        $lat_user = $emergency->emergency_lat;
        $lng_user = $emergency->emergency_lng;

        // ดึงชื่อคอลัมน์ของ aims_operating_units
        $unitColumns = Schema::getColumnListing('aims_operating_units');
        $unitSelects = array_map(function ($col) {
            return "aims_operating_units.$col as unit_$col";
        }, $unitColumns);

        // ดึงชื่อคอลัมน์ของ aims_type_units
        $typeUnitColumns = Schema::getColumnListing('aims_type_units');
        $typeUnitSelects = array_map(function ($col) {
            return "aims_type_units.$col as unit_$col";
        }, $typeUnitColumns);

        // รวมทั้งหมด
        $unit_selects = array_merge(
            ['aims_operating_officers.*'],
            $unitSelects,
            $typeUnitSelects,
            ['users.provider_id as user_provider_id']
        );

        $officer = DB::table('aims_operating_officers')
            ->where('aims_operating_officers.id', '=', $officer_id)
            ->leftJoin('aims_operating_units', 'aims_operating_officers.aims_operating_unit_id', '=', 'aims_operating_units.id')
            ->leftJoin('aims_type_units', 'aims_operating_units.aims_type_unit_id', '=', 'aims_type_units.id')
            ->leftJoin('users', 'aims_operating_officers.user_id', '=', 'users.id')
            ->select($unit_selects)
            ->first();

        DB::table('aims_emergency_operations')
            ->where('aims_emergency_id', $emergency_id)
            ->update([
                'waiting_reply' => $officer_id,
                'updated_at' => now()
            ]);

        return "send success";

        $template_path = storage_path('../public/json/aims/send_sos.json');
        $string_json = file_get_contents($template_path);

        $string_json = str_replace("ตัวอย่าง","การขอความช่วยเหลือ",$string_json);

        $text_icon = "-" ;
        if (!empty( $emergency->emergency_photo )) {
            $string_json = str_replace("photo_sos.png",$emergency->emergency_photo,$string_json);
            $text_icon = "🔍" ;
        }

        $emergency_type = "หัวข้อ : ไม่ได้ระบุ" ;
        if (!empty( $emergency->emergency_type )) {
            $emergency_type = $emergency->emergency_type ;
        }

        $emergency_detail = "รายละเอียด : ไม่ได้ระบุ" ;
        if (!empty( $emergency->emergency_detail )) {
            $emergency_detail = $emergency->emergency_detail ;
        }

        $name_reporter = "ไม่ได้ระบุ" ;
        if (!empty( $emergency->name_reporter )) {
            $name_reporter = $emergency->name_reporter ;
        }

        $type_reporter = "ไม่ได้ระบุ" ;
        if (!empty( $emergency->type_reporter )) {
            $type_reporter = $emergency->type_reporter ;
        }

        $phone_reporter = "-" ;
        if (!empty( $emergency->phone_reporter )) {
            $phone_reporter = $emergency->phone_reporter ;
        }

        $emergency_location = "รายละเอียดสถานที่ : ไม่ได้ระบุ" ;
        if (!empty( $emergency->emergency_location )) {
            $emergency_location = $emergency->emergency_location ;
        }

        $string_json = str_replace("name_partner",$emergency->partner_name,$string_json);
        $string_json = str_replace("name_area",$emergency->area_name_area,$string_json);
        $string_json = str_replace("หัวข้อขอความช่วยเหลือ",$emergency_type,$string_json);
        $string_json = str_replace("รายละเอียดขอความช่วยเหลือ",$emergency_detail,$string_json);

        $string_json = str_replace("name_user",$name_reporter,$string_json);
        $string_json = str_replace("type_reporter",$type_reporter,$string_json);
        $string_json = str_replace("0999999999",$phone_reporter,$string_json);
        $string_json = str_replace("emergency_location",$emergency_location,$string_json);
        $string_json = str_replace("icon_photo",$text_icon,$string_json);

        $string_json = str_replace("วันที่แจ้ง",$date_now,$string_json);
        $string_json = str_replace("เวลาที่แจ้ง",$time_now,$string_json);

        // $string_json = str_replace("emergency_id",$emergency_id,$string_json);
        // $string_json = str_replace("aims_area_id",$emergency->aims_area_id,$string_json);

        $string_json = str_replace("gg_lat_mail",$text_at.$lat_user,$string_json);
        $string_json = str_replace("gg_lat",$lat_user,$string_json);
        $string_json = str_replace("lng",$lng_user,$string_json);

        $messages = [ json_decode($string_json, true) ];

        $body = [
            "to" => $officer->user_provider_id,
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
        $data = [
            "title" => "การขอความช่วยเหลือใหม่ ID : " . $emergency_id,
            "content" => "To Officer id >> " . $officer_id,
        ];
        MyLog::create($data);

        return "send success";

    }

    function get_data_wait_officer($emergency_id , $officer_id) {
        $emergency = DB::table('aims_emergency_operations')
            ->where('aims_emergency_id', '=', $emergency_id)
            ->select('waiting_reply', 'officer_refuse', 'aims_operating_officers_id')
            ->first();

        $text = "";

        if ($emergency) {
            $isWaitingReplyNull = is_null($emergency->waiting_reply);

            $officerRefuseArray = $emergency->officer_refuse
                ? explode(',', $emergency->officer_refuse)
                : [];

            $hasOfficerIdInRefuse = in_array($officer_id, $officerRefuseArray);

            $selectedOfficerId = $emergency->aims_operating_officers_id;

            // ตรวจสอบเงื่อนไขใหม่: เจ้าหน้าที่รับเคส
            if ($isWaitingReplyNull && $selectedOfficerId == $officer_id) {
                $text = "รับเคส";
            }
            // เงื่อนไขปฏิเสธ
            elseif ($isWaitingReplyNull && $hasOfficerIdInRefuse) {
                $text = "ปฏิเสธ";
            }
            // เงื่อนไขกำลังรอ
            else {
                $text = "กำลังรอ";
            }
        }

        return $text;
    }


}
