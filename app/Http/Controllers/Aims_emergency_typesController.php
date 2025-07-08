<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Aims_emergency_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Aims_command;
use App\Models\Aims_type_unit;

class Aims_emergency_typesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data_user = Auth::user();

        $aims_commands = Aims_command::where('user_id' , $data_user->id)->first();
        $officer_role = $aims_commands->officer_role ;
        $aims_partner_id = $aims_commands->aims_partner_id ;
        $aims_area_id = $aims_commands->aims_area_id ;

        if($officer_role == "admin-partner"){
            $aims_emergency_types = DB::table('aims_emergency_types')
                ->where('aims_emergency_types.aims_partner_id', '=' ,$aims_partner_id)
                ->leftjoin('aims_areas', 'aims_emergency_types.aims_area_id', '=', 'aims_areas.id')
                ->select(
                    'aims_areas.name_area as name_area',
                    'aims_emergency_types.*',
                )
                ->get();
        }
        else if($officer_role == "admin-area"){
            $aims_emergency_types = DB::table('aims_emergency_types')
                ->where('aims_emergency_types.aims_partner_id', '=' ,$aims_partner_id)
                ->where('aims_emergency_types.aims_area_id', '=' ,$aims_area_id)
                ->leftjoin('aims_areas', 'aims_emergency_types.aims_area_id', '=', 'aims_areas.id')
                ->select(
                    'aims_areas.name_area as name_area',
                    'aims_emergency_types.*',
                )
                ->get();
        }

        $data_for_add = DB::table('aims_areas')
                ->where('aims_areas.id', '=' ,$aims_area_id)
                ->leftjoin('aims_partners', 'aims_areas.aims_partner_id', '=', 'aims_partners.id')
                ->select(
                    'aims_areas.name_area as name_area',
                    'aims_partners.name as name_partner',
                )
                ->first();

        return view('aims_emergency_types.index', compact('aims_emergency_types','officer_role','aims_partner_id','aims_area_id','data_for_add'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('aims_emergency_types.create');
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
        
        Aims_emergency_type::create($requestData);

        return redirect('aims_emergency_types')->with('flash_message', 'Aims_emergency_type added!');
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
        $aims_emergency_type = Aims_emergency_type::findOrFail($id);

        return view('aims_emergency_types.show', compact('aims_emergency_type'));
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
        $aims_emergency_type = Aims_emergency_type::findOrFail($id);

        return view('aims_emergency_types.edit', compact('aims_emergency_type'));
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
        
        $aims_emergency_type = Aims_emergency_type::findOrFail($id);
        $aims_emergency_type->update($requestData);

        return redirect('aims_emergency_types')->with('flash_message', 'Aims_emergency_type updated!');
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
        Aims_emergency_type::destroy($id);

        return redirect('aims_emergency_types')->with('flash_message', 'Aims_emergency_type deleted!');
    }

    function get_emergency_types($area_id , $partner_id)
    {
        $data = Aims_emergency_type::where('aims_partner_id' , $partner_id)
            ->where('aims_area_id' , $area_id)
            ->where('status' , 'Active')
            ->get();

        return $data ;
    }

    function cf_add_emergency_type(Request $request)
    {
        $requestData = $request->all();
        Aims_emergency_type::create($requestData);

        return "success" ;

    }

    function change_status_emergency_type($id , $new_status){

        DB::table('aims_emergency_types')
            ->where('id',$id)
            ->update([
                'status' => $new_status ,
        ]);

        return "success" ;

    }

    public function manage_priority($id)
    {
        $aims_emergency_type = Aims_emergency_type::where('id' , $id)->first();

        $name_title = 'ผู้ใช้ไม่ได้กรอก';
        if( !empty($aims_emergency_type->name_emergency_type) ){
            $name_title = $aims_emergency_type->name_emergency_type ;
        }

        $data_user = Auth::user();
        $aims_commands = Aims_command::where('user_id' , $data_user->id)->first();
        $officer_role = $aims_commands->officer_role ;

        $data_aims_type_units = DB::table('aims_type_units')
            ->where('aims_area_id', $aims_commands->aims_area_id)
            ->select('name_type_unit')
            ->get();

        return view('aims_emergency_types.show', compact('name_title', 'id','officer_role','data_aims_type_units'));
    }

    public function getPriorityUnits($id, $user_id)
    {
        // ดึง emergency type จาก id
        $aims_emergency_type = Aims_emergency_type::where('id', $id)->first();

        if ( !empty($aims_emergency_type->name_emergency_type) ) {
            $name_title = $aims_emergency_type->name_emergency_type;
        }
        else{
            $name_title = 'ผู้ใช้ไม่ได้กรอก';
        }

        $aims_commands = DB::table('aims_commands')
            ->where('user_id', $user_id)
            ->select('aims_area_id')
            ->first();

        $aims_area_id = $aims_commands->aims_area_id;

        // ดึงเฉพาะ aims_type_units ที่ตรงกับ aims_area_id
        $units = Aims_type_unit::where('aims_area_id', $aims_area_id)
            ->get()
            ->filter(function ($unit) use ($name_title) {
                $emergency_types = json_decode($unit->emergency_type, true);
                if (is_array($emergency_types)) {
                    foreach ($emergency_types as $item) {
                        if ($item['name_emergency_type'] === $name_title) {
                            return true;
                        }
                    }
                }
                return false;
            })
            ->map(function ($unit) use ($name_title) {
                $emergency_types = json_decode($unit->emergency_type, true);
                $priority = null;
                if (is_array($emergency_types)) {
                    foreach ($emergency_types as $item) {
                        if ( $item['name_emergency_type'] === $name_title) {
                            $priority = $item['priority'] ?? null;
                            break;
                        }
                    }
                }
                return [
                    'id' => $unit->id,
                    'name_type_unit' => $unit->name_type_unit,
                    'priority' => $priority
                ];
            })
            ->sortBy(function ($unit) {
                return $unit['priority'] ?? PHP_INT_MAX;
            })
            ->values();

        return response()->json($units);
    }


    public function updatePriorityUnit(Request $request)
    {
        $realId = $request->input('realId');
        $finalPriority = $request->input('finalPriority');
        $name_title = $request->input('name_title');

        $unit = Aims_type_unit::find($realId);

        if (!$unit) {
            return response()->json(['error' => 'ไม่พบข้อมูล aims_type_unit'], 404);
        }

        $emergency_types = json_decode($unit->emergency_type, true);
        if (!is_array($emergency_types)) {
            $emergency_types = [];
        }

        // หาว่า index ไหนที่มี name_emergency_type ตรงกับ name_title
        $indexToUpdate = null;
        foreach ($emergency_types as $index => $item) {
            if ($item['name_emergency_type'] == $name_title) {
                $indexToUpdate = $index;
                break;
            }
        }

        if ($finalPriority == 'ไม่รับ Auto') {
            // ลบ object ออก
            if (!is_null($indexToUpdate)) {
                array_splice($emergency_types, $indexToUpdate, 1);
            }
        } elseif ($finalPriority == 'สุดท้าย') {
            // ตั้ง priority เป็น null
            if (!is_null($indexToUpdate)) {
                $emergency_types[$indexToUpdate]['priority'] = null;
            }
        } else {
            // แปลงเป็นตัวเลขแล้วเซ็ตเข้า priority
            $priorityNumber = is_numeric($finalPriority) ? (int)$finalPriority : null;
            if (!is_null($indexToUpdate)) {
                $emergency_types[$indexToUpdate]['priority'] = $priorityNumber;
            }
            else {
                // ถ้ายังไม่มี item นี้ ให้เพิ่มใหม่
                $emergency_types[] = [
                    'id' => (string) $request->input('id'), // ถ้ามี id emergency_type ก็ส่งมาด้วย
                    'name_emergency_type' => $name_title,
                    'priority' => $priorityNumber
                ];
            }
        }

        // บันทึกกลับ
        $unit->emergency_type = json_encode($emergency_types, JSON_UNESCAPED_UNICODE);
        $unit->save();

        return response()->json(['message' => 'อัปเดตเรียบร้อย', 'data' => $emergency_types]);
    }

    public function updateEmergencyType(Request $request)
    {
        $name_type_unit = $request->input('name_type_unit');
        $emergency_type_id = $request->input('emergency_type_id');
        $name_emergency_type = $request->input('name_emergency_type');
        $priority = $request->input('priority');

        $aims_emergency_types = DB::table('aims_emergency_types')
            ->where('name_emergency_type', $name_emergency_type)
            ->first();

        if( !empty($aims_emergency_types->id) ){
            $types_id = $aims_emergency_types->id;
        }
        else{
            $types_id = "0" ;
        }

        // 1. ค้นหา aims_type_units ตาม name_type_unit
        $unit = DB::table('aims_type_units')
            ->where('name_type_unit', $name_type_unit)
            ->first();

        if (!$unit) {
            return response()->json(['message' => 'ไม่พบข้อมูลหน่วยที่ระบุ'], 404);
        }

        // 2. ดึง emergency_type มาเป็น array
        $emergencyTypes = json_decode($unit->emergency_type, true) ?? [];

        // 3. เพิ่มหรืออัปเดตข้อมูลใน emergencyTypes
        $found = false;

        foreach ($emergencyTypes as &$item) {
            if ($item['name_emergency_type'] === $name_emergency_type) {
                // ถ้าชื่อซ้ำ → อัปเดต priority และ id
                $item['priority'] = $priority;
                $item['id'] = $types_id;
                $found = true;
                break;
            }
        }

        unset($item); // ป้องกันปัญหาการอ้างอิงตัวแปรใน foreach

        if (!$found) {
            // ถ้าไม่ซ้ำ → เพิ่มใหม่
            $emergencyTypes[] = [
                'id' => $types_id,
                'name_emergency_type' => $name_emergency_type,
                'priority' => $priority,
            ];
        }

        // 4. อัปเดตข้อมูล
        DB::table('aims_type_units')
            ->where('id', $unit->id)
            ->update([
                'emergency_type' => json_encode($emergencyTypes, JSON_UNESCAPED_UNICODE),
                'updated_at' => now(),
            ]);

        return response()->json([
            'message' => 'อัปเดตเรียบร้อยแล้ว',
            'data' => $emergencyTypes,
        ]);
    }


}
