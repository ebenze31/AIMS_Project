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
use App\Jobs\AutoSendSOS;
use App\Http\Controllers\API\WebhookController;

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

        // if( !empty($emergency->uuid) ){
        //     $data_for_api = [
        //         'uuid' => $emergency->uuid,
        //         'case_id' => $emergency->id,
        //         'case_type' => $emergency->emergency_type,
        //         'case_status' => "กำลังไปช่วยเหลือ",
        //     ];

        //     $Webhook = new WebhookController();
        //     $send_api_update = $Webhook->sendSosStatus($data_for_api);
        // }

        // เช็คสถานะเปิดทำการของ Partner
        $status_message = 'ไม่เปิดทำการ';
        $check_open_partner = Aims_area::where('id' , $requestData['aims_area_id'])->first();

        if ($check_open_partner) {
            $current_time = Carbon::now();
            $current_day = strtolower($current_time->format('l')); // monday, tuesday, ...

            // แปลงข้อมูลวันจาก DB เป็น array และตัดช่องว่าง
            $open_days = array_map('trim', explode(',', strtolower($check_open_partner->day_command)));

            if ($check_open_partner->check_time_command === 'No') {
                // เปิดทำการ 24 ชม.
                $status_message = 'เปิดทำการ';
            }

            // เช็คว่ามีการระบุวัน และวันนี้อยู่ในวันเปิดทำการ
            if (in_array($current_day, $open_days)) {

                if ($check_open_partner->check_time_command === 'Yes') {
                    // แปลงเวลาเริ่มต้นและเวลาสิ้นสุดเป็น Carbon
                    $start_time = Carbon::createFromFormat('H:i:s', $check_open_partner->time_start_command);
                    $end_time   = Carbon::createFromFormat('H:i:s', $check_open_partner->time_end_command);

                    // ตรวจสอบว่าเวลาอยู่ในช่วงหรือไม่
                    if ($current_time->between($start_time, $end_time)) {
                        $status_message = 'เปิดทำการ';
                    }
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
        // $formattedPartnerId = str_pad($partner_id, 4, '0', STR_PAD_LEFT);
        $formattedAreaId = str_pad($area_id, 5, '0', STR_PAD_LEFT);
        $new_run_number = $run_number + 1;
        $formattedRunNumber = str_pad($new_run_number, 4, '0', STR_PAD_LEFT);
        $final_code = "{$formattedAreaId}-{$yearMonth}-{$formattedRunNumber}";

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

            $emergency_operation = Aims_emergency_operation::create($data_operation);

        }
        // -->> ไม่เปิดทำการ
        else if($status_message == 'ไม่เปิดทำการ'){
            $data_operation['notify'] = "finished-" . "auto" ;
            $data_operation['command_by'] = "auto" ;
            $data_operation['status'] = "สั่งการ (auto)" ;
            $data_operation['time_create_sos'] = $current_time;
            $data_operation['time_command'] = $current_time; 

            $emergency_operation = Aims_emergency_operation::create($data_operation);


            // ค้นหาเจ้าหน้าที่ของพื้นที่ที่ใกล้จุดเกิดเหตุ
            // 1. เอา name_emergency_type จาก emergency
            $name_emergency_type = $emergency->emergency_type;

            if( empty($name_emergency_type) ){
                $name_emergency_type = "ผู้ใช้ไม่ได้กรอก";
            }


            $check_send_auto_to = DB::table('aims_emergency_types')
                ->where('aims_partner_id', "partner_id")
                ->where('aims_area_id', "area_id")
                ->where('name_emergency_type', $name_emergency_type)
                ->first();

            if($check_send_auto_to && $check_send_auto_to == "group_line"){
                // ส่งเข้ากลุ่มไลน์
                $groupID = $check_send_auto_to->groupID;
                $this->auto_send_sos_to_group_line($emergency->id,$groupID);
            }
            else{
                // 2. ค้นหา aims_type_units ที่มี emergency_type ตรงกับ name_emergency_type
                $type_units = DB::table('aims_type_units')
                    ->get()
                    ->filter(function ($row) use ($name_emergency_type) {
                        $emergencyTypes = json_decode($row->emergency_type, true);

                        if (!is_array($emergencyTypes)) {
                            return false; // ข้าม row นี้ไป
                        }

                        foreach ($emergencyTypes as $emergency) {
                            if ($emergency['name_emergency_type'] === $name_emergency_type) {
                                $row->priority = $emergency['priority'] ?? null;
                                return true;
                            }
                        }
                        return false;
                    })
                    ->sort(function ($a, $b) {
                        $aPriority = is_null($a->priority) ? 9999 : (int) $a->priority;
                        $bPriority = is_null($b->priority) ? 9999 : (int) $b->priority;
                        return $aPriority <=> $bPriority;
                    })
                    ->values();

                // 3. ดึง id ของ type_unit
                $type_unit_ids = $type_units->pluck('id');

                // 4. หา aims_operating_units ที่ status = 'Active' และ type_unit_id อยู่ในกลุ่ม
                $operating_units = DB::table('aims_operating_units')
                    ->whereIn('aims_type_unit_id', $type_unit_ids)
                    ->where('status', 'Active')
                    ->select('id', 'name_unit', 'aims_type_unit_id')
                    ->get();

                // 5. รวมข้อมูลให้เป็น array ของชุด {name_emergency_type, name_type_unit, name_unit}
                $groupedResults = [];

                // 5. รวมข้อมูลโดยจัดกลุ่มตาม priority
                foreach ($type_units as $type_unit) {
                    foreach ($operating_units as $unit) {
                        if ($unit->aims_type_unit_id == $type_unit->id) {
                            $priority = $type_unit->priority ?? 9999;

                            if (!isset($groupedResults[$priority])) {
                                $groupedResults[$priority] = [
                                    'priority' => $priority,
                                    'name_type_unit' => [],
                                    'name_unit' => [],
                                ];
                            }

                            // เพิ่มเฉพาะถ้ายังไม่เคยมีชื่อซ้ำ
                            if (!in_array($type_unit->name_type_unit, $groupedResults[$priority]['name_type_unit'])) {
                                $groupedResults[$priority]['name_type_unit'][] = $type_unit->name_type_unit;
                            }

                            if (!in_array($unit->name_unit, $groupedResults[$priority]['name_unit'])) {
                                $groupedResults[$priority]['name_unit'][] = $unit->name_unit;
                            }
                        }
                    }
                }

                // แปลงผลลัพธ์ให้เรียงตาม priority
                $results = collect($groupedResults)
                    ->sortBy('priority')
                    ->values()
                    ->toArray();

                function haversine($lat1, $lon1, $lat2, $lon2) {
                    $earthRadius = 6371;
                    $dLat = deg2rad($lat2 - $lat1);
                    $dLon = deg2rad($lon2 - $lon1);
                    $a = sin($dLat / 2) * sin($dLat / 2) +
                         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                         sin($dLon / 2) * sin($dLon / 2);
                    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                    return $earthRadius * $c;
                }

                $foundOfficer = null;
                $emergencyLat = $requestData['emergency_lat'];
                $emergencyLng = $requestData['emergency_lng'];

                foreach ($results as $group) {
                    $unitNames = $group['name_unit'];

                    $unitIds = DB::table('aims_operating_units')
                        ->where('status' , 'Active')
                        ->whereIn('name_unit', $unitNames)
                        ->pluck('id');

                    $officers = DB::table('aims_operating_officers')
                        ->where('status' , 'Standby')
                        ->whereIn('aims_operating_unit_id', $unitIds)
                        ->whereNotNull('lat')
                        ->whereNotNull('lng')
                        ->get();

                    $officersWithinRange = $officers->map(function ($officer) use ($emergencyLat, $emergencyLng) {
                        $distance = haversine($emergencyLat, $emergencyLng, $officer->lat, $officer->lng);
                        $officer->distance = $distance;
                        return $officer;
                    })->filter(function ($officer) {
                        return $officer->distance <= 20;
                    })->sortBy('distance')->values();

                    if ($officersWithinRange->isNotEmpty()) {
                        $foundOfficer = $officersWithinRange->first();
                        break;
                    }
                }

                if (!$foundOfficer) {
                    // ดึงชื่อหน่วยทั้งหมดจากทุก priority group
                    $allUnitNames = collect($results)->flatMap(function ($group) {
                        return $group['name_unit'];
                    })->unique();

                    // หาหน่วยที่ Active
                    $unitIds = DB::table('aims_operating_units')
                        ->where('status', 'Active')
                        ->whereIn('name_unit', $allUnitNames)
                        ->pluck('id');

                    // หาจนท. ที่ Standby และมี lat/lng
                    $officers = DB::table('aims_operating_officers')
                        ->where('status', 'Standby')
                        ->whereIn('aims_operating_unit_id', $unitIds)
                        ->whereNotNull('lat')
                        ->whereNotNull('lng')
                        ->get();

                    // คำนวณระยะทางทั้งหมด แล้วหาคนที่ใกล้สุด
                    $officersSortedByDistance = $officers->map(function ($officer) use ($emergencyLat, $emergencyLng) {
                        $distance = haversine($emergencyLat, $emergencyLng, $officer->lat, $officer->lng);
                        $officer->distance = $distance;
                        return $officer;
                    })->sortBy('distance')->values();

                    if ($officersSortedByDistance->isNotEmpty()) {
                        $foundOfficer = $officersSortedByDistance->first();
                    }
                }

                $check_foundOfficer = [
                    'status' => $foundOfficer ? 'found' : 'not found',
                    'emergency_id' => $emergency->id,
                    'name_emergency_type' => $name_emergency_type,
                    'closest_officer' => $foundOfficer,
                    'grouped_data' => $results
                ];

                $data_for_send_auto = [
                    'emergency_id' => $emergency->id,
                    'aims_operating_officers_id' => $check_foundOfficer['closest_officer']->id,
                ];


                // เจอเจ้าหน้าที่ในพื้นที่
                if( $check_foundOfficer['status'] == "found" ){
                    // $this->auto_send_sos_to_officer($data_for_send_auto);
                    $this->send_test_Artisan_call($requestData['name_reporter']);
                }
                // ไม่เจอเจ้าหน้าที่ในพื้นที่ ส่งหาชาลี
                else {

                }

                return $check_foundOfficer ;
            }
        }
        
        // 6. ส่งผลลัพธ์กลับ
        // return "success" ;
        return response()->json([
            'status' => 'success',
            'emergency_id' => $emergency->id,
        ]);

    }

    function send_test_Artisan_call($case_id){

        // --- สำหรับใช้งานจริง ---
        // 1. ค้นหาเจ้าหน้าที่ทั้งหมดที่เกี่ยวข้องกับเคสนี้จาก Database
        // $officers = Officer::where('area', ...)->orderBy('distance')->get();
        // $officer_ids = $officers->pluck('line_user_id')->toArray();
        
        // --- สำหรับการทดสอบ ---
        // จำลองว่าเราได้รายชื่อ ID ของเจ้าหน้าที่มา 3 คน
        $officer_ids = [
            "U912994894c449f2237f73f18b5703e89", // คนที่ 1
            "U912994894c449f2237f73f18b5703e89", // << ใส่ ID ทดสอบคนที่ 2
            "U912994894c449f2237f73f18b5703e89", // << ใส่ ID ทดสอบคนที่ 3
            "U912994894c449f2237f73f18b5703e89", // << ใส่ ID ทดสอบคนที่ 4
            "U912994894c449f2237f73f18b5703e89", // << ใส่ ID ทดสอบคนที่ 5
        ];

        // 2. ตรวจสอบว่ามีเจ้าหน้าที่หรือไม่
        if (empty($officer_ids)) {
            Log::warning("ไม่พบเจ้าหน้าที่สำหรับเคส ID: " . $case_id);
            return "No officers found";
        }

        // 3. เริ่มกระบวนการโดยส่ง "รายชื่อทั้งหมด" และ "ลำดับเริ่มต้น (0)" เข้าไป
        AutoSendSOS::dispatch($officer_ids, $case_id, 0); // << เริ่มที่ index 0

        return "Job chain started for case " . $case_id;
    }

    function auto_send_sos_to_officer($requestData)
    {

        $date_now =  date("d-m-Y");
        $time_now =  date("H:i");
        $text_at = '@' ;

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
                'time_command' => now(),
                'updated_at' => now()
            ]);

        // return "send success";

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

        $string_json = str_replace("emergency_id",$emergency_id,$string_json);
        $string_json = str_replace("aims_area_id",$emergency->aims_area_id,$string_json);

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
            "title" => "(Auto) การขอความช่วยเหลือใหม่ ID : " . $emergency_id,
            "content" => "To Officer id >> " . $officer_id,
        ];
        MyLog::create($data);

        return "send success";

    }

    function auto_send_sos_to_group_line($emergency_id , $groupID)
    {

        $date_now =  date("d-m-Y");
        $time_now =  date("H:i");
        $text_at = '@' ;

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

        DB::table('aims_emergency_operations')
            ->where('aims_emergency_id', $emergency_id)
            ->update([
                'waiting_reply' => "group_line",
                'time_command' => now(),
                'updated_at' => now()
            ]);

        // return "send success";

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

        $string_json = str_replace("emergency_id",$emergency_id,$string_json);
        $string_json = str_replace("aims_area_id",$emergency->aims_area_id,$string_json);

        $string_json = str_replace("gg_lat_mail",$text_at.$lat_user,$string_json);
        $string_json = str_replace("gg_lat",$lat_user,$string_json);
        $string_json = str_replace("lng",$lng_user,$string_json);

        $messages = [ json_decode($string_json, true) ];

        $body = [
            "to" => $groupID,
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
            "title" => "(Auto) การขอความช่วยเหลือใหม่ ID : " . $emergency_id,
            "content" => "To group_line id >> " . $groupID,
        ];
        MyLog::create($data);

        return "send success";

    }

    function check_sos_alarm($user_id){

        $check_data = Aims_emergency_operation::where('notify', 'command_id-' . $user_id)->first();
        $data_return = [];

        DB::table('aims_commands')
            ->where('user_id', $user_id)
            ->update([
                'last_active' => now(),
                'updated_at' => now()
            ]);

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

    function emergency_all_case(){
        return view('aims_emergencys.emergency_all_case');
    }

    function user_wait_officer($emergency_id)
    {
        $emergency = DB::table('aims_emergencys')
            ->where('aims_emergencys.id', '=', $emergency_id)
            ->leftJoin('aims_emergency_operations', 'aims_emergencys.id', '=', 'aims_emergency_operations.aims_emergency_id')
            ->select([
                'aims_emergencys.id',
                'aims_emergencys.emergency_lat',
                'aims_emergencys.emergency_lng',
                'aims_emergency_operations.aims_operating_officers_id as op_aims_operating_officers_id',
                'aims_emergency_operations.status as op_status'
            ])
            ->first();

        return view('aims_emergencys.user_wait_officer', compact('emergency'));
    }

    function assistance_questionnaire($emergency_id)
    {
        $emergency = DB::table('aims_emergencys')
            ->where('aims_emergencys.id', '=', $emergency_id)
            ->leftJoin('aims_emergency_operations', 'aims_emergencys.id', '=', 'aims_emergency_operations.aims_emergency_id')
            ->select([
                'aims_emergencys.id',
                'aims_emergencys.emergency_lat',
                'aims_emergencys.emergency_lng',
                'aims_emergency_operations.aims_operating_officers_id as op_aims_operating_officers_id',
                'aims_emergency_operations.status as op_status'
            ])
            ->first();

        return view('aims_emergencys.assistance_questionnaire', compact('emergency'));
    }

    function loop_check_status($emergency_id){
        $emergency = DB::table('aims_emergency_operations')
            ->where('aims_emergency_id', '=', $emergency_id)
            ->select('status')
            ->first();

        return $emergency->status;
    }

    function get_data_case_all($user_id, Request $request){
        $data_commands = DB::table('aims_commands')->where('user_id', $user_id)->first();

        $perPage = 15;
        $page = $request->input('page', 1); // ค่าเริ่มต้นคือหน้า 1
        $offset = ($page - 1) * $perPage;

        $query = DB::table('aims_emergencys')
            ->where('aims_emergencys.aims_partner_id', '=', $data_commands->aims_partner_id)
            ->where('aims_emergencys.aims_area_id', '=', $data_commands->aims_area_id)
            ->leftJoin('aims_emergency_operations', 'aims_emergencys.id', '=', 'aims_emergency_operations.aims_emergency_id')
            ->leftJoin('aims_commands', 'aims_emergency_operations.command_by', '=', 'aims_commands.id')
            ->leftJoin('aims_operating_officers', 'aims_emergency_operations.aims_operating_officers_id', '=', 'aims_operating_officers.id')
            ->leftJoin('aims_operating_units', 'aims_operating_officers.aims_operating_unit_id', '=', 'aims_operating_units.id')
            ->leftJoin('aims_type_units', 'aims_operating_units.aims_type_unit_id', '=', 'aims_type_units.id');

        // ค้นหาจากฟิลด์ที่ระบุ
        if ($request->filled('search_field') && $request->filled('keyword')) {
            $field = $request->search_field;
            $keyword = $request->keyword;

            $allowedFields = [
                'operating_code' => 'aims_emergency_operations.operating_code',
                'created_at' => 'aims_emergencys.created_at',
                'name_officer_command' => 'aims_commands.name_officer_command',
                'status' => 'aims_emergency_operations.status',
                'emergency_type' => 'aims_emergencys.emergency_type',
            ];

            if (array_key_exists($field, $allowedFields)) {
                $query->where($allowedFields[$field], 'like', '%' . $keyword . '%');
            }
        }


        $total = $query->count(); // จำนวนทั้งหมด

        $data = $query->select(
                'aims_emergencys.id',
                'aims_emergencys.created_at',
                'aims_emergencys.name_reporter',
                'aims_emergencys.type_reporter',
                'aims_emergencys.phone_reporter',
                'aims_emergencys.emergency_type',
                'aims_emergencys.idc',
                'aims_emergencys.rc',
                'aims_emergency_operations.operating_code',
                'aims_emergency_operations.status',
                'aims_emergency_operations.time_sum_sos',
                'aims_commands.name_officer_command',
                'aims_operating_officers.name_officer',
                'aims_operating_units.name_unit',
                'aims_type_units.name_type_unit',
            )
            ->orderBy('aims_emergencys.id', 'DESC')
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return response()->json([
            'data' => $data,
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
        ]);
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
        $user_id_command = $requestData['user_id_command'];

        $command = DB::table('aims_commands')->where('user_id', $user_id_command)->first();

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
                'status' => "สั่งการ",
                'command_by' => $command->id,
                'waiting_reply' => $officer_id,
                'time_command' => now(),
                'updated_at' => now()
            ]);

        // return "send success";

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

        $string_json = str_replace("emergency_id",$emergency_id,$string_json);
        $string_json = str_replace("aims_area_id",$emergency->aims_area_id,$string_json);

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

    function get_for_show_helper($emergency_id){

        $emergency = DB::table('aims_emergencys')
            ->where('aims_emergencys.id', $emergency_id)
            ->leftJoin('aims_emergency_operations', 'aims_emergencys.id', '=', 'aims_emergency_operations.aims_emergency_id')
            ->select(array_merge(
                [
                    'aims_emergencys.id',
                    'aims_emergencys.emergency_lat',
                    'aims_emergencys.emergency_lng',
                    'aims_emergency_operations.aims_operating_officers_id as officer_id',
                    'aims_emergency_operations.status as op_status',
                ]
            ))
            ->first();

        if (!$emergency) {
            return response()->json(['error' => 'ไม่พบเหตุฉุกเฉิน'], 404);
        }

        $officer_id = $emergency->officer_id;

        $officer = DB::table('aims_operating_officers')
            ->where('aims_operating_officers.id', $officer_id)
            ->leftJoin('aims_operating_units','aims_operating_officers.aims_operating_unit_id','=','aims_operating_units.id')
            ->leftJoin('aims_type_units', 'aims_operating_units.aims_type_unit_id','=','aims_type_units.id')
            ->leftJoin('users','aims_operating_officers.user_id','=', 'users.id')
            ->select([
                'aims_operating_officers.*',
                'aims_operating_units.name_unit as unit_name_unit',
                'aims_type_units.name_type_unit as unit_name_type_unit',
                'users.photo as user_photo'
            ])
            ->first();

        return response()->json([
            'emergency' => $emergency,
            'officer'   => $officer,
        ]);

    }

    function get_location_realtime($officer_id, $emergency_id){
        $officer = DB::table('aims_operating_officers')
            ->where('aims_operating_officers.id', $officer_id)
            ->select([
                'aims_operating_officers.lat',
                'aims_operating_officers.lng',
            ])
            ->first();

        $emergency = DB::table('aims_emergency_operations')
            ->where('aims_emergency_operations.aims_emergency_id', $emergency_id)
            ->select([
                'aims_emergency_operations.status',
            ])
            ->first();

        return response()->json([
            'emergency' => $emergency,
            'officer'   => $officer,
        ]);
    }

    function get_data_case_realtime($emergency_id){

        $emergency = DB::table('aims_emergencys')
            ->where('aims_emergencys.id', $emergency_id)
            ->leftJoin('aims_emergency_operations', 'aims_emergencys.id', '=', 'aims_emergency_operations.aims_emergency_id')
            ->select(array_merge(
                [
                    'aims_emergencys.idc',
                    'aims_emergencys.rc',
                    'aims_emergency_operations.status',
                ]
            ))
            ->get();

        return $emergency ;

    }

    function officer_go_to_help($emergency_id){

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

        return view('aims_operating_officers.go_to_help', compact('emergency'));
    }

    function sum_timeline($emergency_id){

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

        return view('aims_operating_officers.sum_timeline', compact('emergency'));
    }

    function test_map_gotohelp($emergency_id){

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

        return view('aims_operating_officers.test_map_gotohelp', compact('emergency'));
    }

    function get_idc_rc_of_case($emergency_id){

        $data = DB::table('aims_emergencys')
            ->where('id', '=', $emergency_id)
            ->select('id', 'idc', 'rc')
            ->get();

        return $data;
    }

    function update_rc($emergency_id, $rc){
        DB::table('aims_emergencys')
            ->where('id', $emergency_id)
            ->update([
                'rc' => $rc,
                'updated_at' => now()
            ]);

        return "success" ;
    }

    function update_help_operations(Request $request)
    {
        $emergencyId = $request->input('emergency_id');
        $name = $request->input('name');
        $value = $request->input('value');
        $text_return = 'ต่อไป' ;

        $allowedFields = ['rc', 'treatment', 'sub_treatment','km_before', 'km_to_the_scene', 'km_hospital', 'km_operating_base'];

        if (!in_array($name, $allowedFields)) {
            return response()->json([
                'status' => 'error',
                'message' => 'ฟิลด์ที่ร้องขอไม่อนุญาต'
            ], 400);
        }

        if ($name === "rc") {
            DB::table('aims_emergencys')
                ->where('id', $emergencyId)
                ->update([
                    $name => $value,
                    'updated_at' => now()
                ]);
        } else {
            // เตรียมข้อมูลอัปเดตพื้นฐาน
            $updateData = [
                $name => $value,
                'updated_at' => now()
            ];

            // ถึงที่เกิดเหตุ
            if ($name === 'km_to_the_scene') {
                $updateData['status'] = "ถึงที่เกิดเหตุ";
                $updateData['time_to_the_scene'] = now();
            }
            // ประเมินและออกจากที่เกิดเหตุ
            elseif ($name === 'sub_treatment') {
                $updateData['time_leave_the_scene'] = now();
                if($value == "ส่งโรงพยาบาล"){
                    $updateData['status'] = "ออกจากที่เกิดเหตุ";
                }
                else{
                    $updateData['status'] = "กำลังกลับฐาน";
                    $updateData['time_sos_success'] = now();
                    $updateData['remark_status'] = $value;
                    $text_return = 'เสร็จสิ้น' ;
                }
            }
            elseif ($name === 'km_hospital') {
                $updateData['status'] = "ถึง รพ.";
                $updateData['remark_status'] = "ส่งโรงพยาบาล";
                $updateData['time_sos_success'] = now();
                $updateData['time_hospital'] = now();
                $text_return = 'เสร็จสิ้น' ;
            }
            elseif ($name === 'km_operating_base') {
                $updateData['time_to_the_operating_base'] = now();
                $updateData['status'] = "เสร็จสิ้น";
                $text_return = 'ถึงฐาน' ;
            }
            
            // บันทึกข้อมูลหลักที่ส่งเข้ามา
            DB::table('aims_emergency_operations')
                ->where('aims_emergency_id', $emergencyId)
                ->update($updateData);


            // ดึงข้อมูลที่ต้องใช้ในการคำนวณเพิ่มเติม
            $operation = DB::table('aims_emergency_operations')
                ->where('aims_emergency_id', $emergencyId)
                ->first([
                    'time_go_to_help',
                    'time_sos_success',
                    'time_to_the_operating_base',
                    'km_before',
                    'km_operating_base'
                ]);

            // คำนวณ time_sum_sos 
            if (
                ($name === 'sub_treatment' && $value !== 'ส่งโรงพยาบาล') ||
                $name === 'km_hospital'
            ) {
                if ($operation->time_go_to_help && $operation->time_sos_success) {
                    $start = Carbon::parse($operation->time_go_to_help);
                    $end = Carbon::parse($operation->time_sos_success);

                    $diffInMinutes = $start->diffInMinutes($end);
                    $formatted = $this->formatDuration($diffInMinutes);

                    DB::table('aims_emergency_operations')
                        ->where('aims_emergency_id', $emergencyId)
                        ->update([
                            'time_sum_sos' => $formatted,
                            'updated_at' => now()
                        ]);
                }
            }

            // คำนวณ km_sum และ time_sum_to_base
            if ($name === 'km_operating_base') {
                // คำนวณ km_sum
                if (is_numeric($operation->km_before) && is_numeric($operation->km_operating_base)) {
                    $distance = abs($operation->km_operating_base - $operation->km_before);
                    $formattedDistance = $distance . ' กิโลเมตร';

                    DB::table('aims_emergency_operations')
                        ->where('aims_emergency_id', $emergencyId)
                        ->update([
                            'km_sum' => $formattedDistance,
                            'updated_at' => now()
                        ]);
                }

                // คำนวณ time_sum_to_base
                if ($operation->time_go_to_help && $operation->time_to_the_operating_base) {
                    $start = Carbon::parse($operation->time_go_to_help);
                    $end = Carbon::parse($operation->time_to_the_operating_base);

                    $diffInMinutes = $start->diffInMinutes($end);
                    $formatted = $this->formatDuration($diffInMinutes);

                    DB::table('aims_emergency_operations')
                        ->where('aims_emergency_id', $emergencyId)
                        ->update([
                            'time_sum_to_base' => $formatted,
                            'updated_at' => now()
                        ]);
                }
            }
        }

        return $text_return;
    }

    private function formatDuration($minutes)
    {
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        $parts = [];
        if ($hours > 0) {
            $parts[] = $hours . ' ชั่วโมง';
        }
        $parts[] = $remainingMinutes . ' นาที';

        return implode(' ', $parts);
    }

    function check_and_update(Request $request, $id)
    {
        $patient = Aims_emergency::findOrFail($id);
        $original = $request->input('originalData');
        $new = $request->input('newData');

        $conflicts = [];
        $validUpdates = [];

        foreach ($new as $key => $newValue) {
            if ($patient->$key != $original[$key]) {
                $conflicts[] = $key;
            } else {
                $validUpdates[$key] = $newValue;
            }
        }

        if (!empty($validUpdates)) {
            foreach ($validUpdates as $key => $value) {
                $patient->$key = $value;
            }
            $patient->save();
        }

        return response()->json([
            'status' => empty($conflicts) ? 'success' : 'partial',
            'conflicts' => $conflicts,
            'currentValues' => collect($conflicts)->mapWithKeys(function ($field) use ($patient) {
                return [$field => $patient->$field];
            }),
        ]);

    }

    public function update_photo_officer(Request $request, $id)
    {
        $emergency = Aims_emergency_operation::findOrFail($id);

        if ($request->hasFile('photo_by_officer')) {
            $path = $request->file('photo_by_officer')->store('photos', 'public');
            $emergency->photo_by_officer = $path;
        }

        if ($request->hasFile('photo_succeed')) {
            $path = $request->file('photo_succeed')->store('photos', 'public');
            $emergency->photo_succeed = $path;
        }

        if ($request->filled('remark_photo_by_officer')) {
            $emergency->remark_photo_by_officer = $request->input('remark_photo_by_officer');
        }

        if ($request->filled('remark_by_helper')) {
            $emergency->remark_by_helper = $request->input('remark_by_helper');
        }

        $emergency->save();

        return response()->json(['success' => true]);
    }

    public function SaveDataEmergency(Request $request, $id)
    {
        $emergency = Aims_emergency::findOrFail($id);

        $currentData  = $request->input('currentData', []);
        $originalData = $request->input('originalData', []);
        $changedData  = $request->input('changedData', []);

        // กำหนดชื่อฟิลด์ที่เก็บข้อมูลเป็น Array (comma-separated string)
        $arrayFields = ['symptom'];

        // กรณีบังคับบันทึกทับ (หลังจากผู้ใช้เลือกใน Modal)
        if (!empty($changedData)) {
            foreach ($changedData as $field => $value) {
                // ถ้าเป็นฟิลด์ array, ให้แปลงกลับเป็น string ก่อนบันทึก
                if (in_array($field, $arrayFields)) {
                    $valuesAsArray = is_array($value) ? $value : (!empty($value) ? explode(',', $value) : []);
                    sort($valuesAsArray); // จัดเรียงเพื่อให้ข้อมูลมี format เดียวกันเสมอ
                    $emergency->$field = implode(',', $valuesAsArray);
                } else {
                    $emergency->$field = $value;
                }
            }
            $emergency->save();
            return response()->json(['status' => 'success']);
        }

        // กรณีบันทึกปกติ (ตรวจสอบ Conflict)
        $conflicts = [];
        $fieldsToUpdate = [];

        foreach ($currentData as $field => $newValue) {
            $dbValue = $emergency->$field;
            $originalValue = $originalData[$field] ?? null;
            $isConflict = false;

            if (in_array($field, $arrayFields)) {
                // --- Logic สำหรับฟิลด์ที่เป็น Array ---
                $dbValues = !empty($dbValue) ? array_map('trim', explode(',', $dbValue)) : [];
                $originalValues = is_array($originalValue) ? $originalValue : (!empty($originalValue) ? array_map('trim', explode(',', (string)$originalValue)) : []);
                
                sort($dbValues);
                sort($originalValues);

                // เปรียบเทียบ Array ที่จัดเรียงแล้ว
                if ($dbValues !== $originalValues) {
                    $isConflict = true;
                }
            } else {
                // --- Logic สำหรับฟิลด์ทั่วไป ---
                if ((string) trim($dbValue) != (string) trim($originalValue)) {
                    $isConflict = true;
                }
            }

            if ($isConflict) {
                $conflicts[$field] = [
                    'current' => $dbValue,
                    'new'     => is_array($newValue) ? implode(',', $newValue) : $newValue,
                ];
            } else {
                // ถ้าไม่ชน ก็เตรียมข้อมูลไว้สำหรับอัปเดต
                $fieldsToUpdate[$field] = $newValue;
            }
        }

        // บันทึกฟิลด์ที่ไม่เกิด Conflict ลงฐานข้อมูลก่อน
        if (!empty($fieldsToUpdate)) {
            foreach ($fieldsToUpdate as $field => $value) {
                if (in_array($field, $arrayFields) && is_array($value)) {
                    sort($value);
                    $emergency->$field = implode(',', $value);
                } else {
                    $emergency->$field = $value;
                }
            }
            $emergency->save();
        }
        
        // ถ้ามี Conflict ให้ส่งกลับไปให้ User เลือก
        if (!empty($conflicts)) {
            return response()->json([
                'status'    => 'conflict',
                'conflicts' => $conflicts,
            ]);
        }

        // ถ้าไม่มี Conflict เลย ก็ถือว่าสำเร็จ
        return response()->json(['status' => 'success']);
    }
    


}
