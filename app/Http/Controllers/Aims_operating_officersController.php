<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Aims_operating_officer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class Aims_operating_officersController extends Controller
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
            $aims_operating_officers = Aims_operating_officer::where('name_officer', 'LIKE', "%$keyword%")
                ->orWhere('type', 'LIKE', "%$keyword%")
                ->orWhere('level', 'LIKE', "%$keyword%")
                ->orWhere('amount_help', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('lat', 'LIKE', "%$keyword%")
                ->orWhere('lng', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('aims_operating_unit_id', 'LIKE', "%$keyword%")
                ->orWhere('aims_partner_id', 'LIKE', "%$keyword%")
                ->orWhere('aims_area_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $aims_operating_officers = Aims_operating_officer::latest()->paginate($perPage);
        }

        return view('aims_operating_officers.index', compact('aims_operating_officers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('aims_operating_officers.create');
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
        
        Aims_operating_officer::create($requestData);

        return redirect('aims_operating_officers')->with('flash_message', 'Aims_operating_officer added!');
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
        $aims_operating_officer = Aims_operating_officer::findOrFail($id);

        return view('aims_operating_officers.show', compact('aims_operating_officer'));
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
        $aims_operating_officer = Aims_operating_officer::findOrFail($id);

        return view('aims_operating_officers.edit', compact('aims_operating_officer'));
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
        
        $aims_operating_officer = Aims_operating_officer::findOrFail($id);
        $aims_operating_officer->update($requestData);

        return redirect('aims_operating_officers')->with('flash_message', 'Aims_operating_officer updated!');
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
        Aims_operating_officer::destroy($id);

        return redirect('aims_operating_officers')->with('flash_message', 'Aims_operating_officer deleted!');
    }

    function get_data_officer($area_id){

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
            ['users.provider_id as user_provider_id'],
            ['users.photo as user_photo'],
        );

        $data_officer = DB::table('aims_operating_officers')
            ->where('aims_operating_officers.aims_area_id', '=', $area_id)
            ->where('aims_operating_officers.status', '=', 'Standby')
            ->leftJoin('aims_operating_units', 'aims_operating_officers.aims_operating_unit_id', '=', 'aims_operating_units.id')
            ->leftJoin('aims_type_units', 'aims_operating_units.aims_type_unit_id', '=', 'aims_type_units.id')
            ->leftJoin('users', 'aims_operating_officers.user_id', '=', 'users.id')
            ->select($unit_selects)
            ->get();

        return $data_officer ;

    }

    function officer_no_response(Request $request)
    {
        $data = $request->json()->all();

        $emergency_id = $data['emergency_id'] ?? null;
        $officer_id = $data['officer_id'] ?? null;

        if (!$emergency_id || !$officer_id) {
            return response()->json(['status' => 'error', 'message' => 'Missing data'], 400);
        }

        $currentData = DB::table('aims_emergency_operations')
            ->where('aims_emergency_id', $emergency_id)
            ->first();

        if (!empty($currentData)) {
            $existingOfficerIds = $currentData->officer_no_respond;

            if (empty($existingOfficerIds)) {
                $newOfficerIds = $officer_id;
            } else {
                $officerArray = explode(',', $existingOfficerIds);
                if (!in_array($officer_id, $officerArray)) {
                    $officerArray[] = $officer_id;
                }
                $newOfficerIds = implode(',', $officerArray);
            }

            DB::table('aims_emergency_operations')
                ->where('aims_emergency_id', $emergency_id)
                ->update([
                    'waiting_reply' => null,
                    'officer_no_respond' => $newOfficerIds,
                    'updated_at' => now()
                ]);
        }

        return response()->json(['status' => 'ok']);
    }

    function UpdateOfficerLocation(Request $request, $officers_id)
    {
        $requestData = $request->all();

        DB::table('aims_operating_officers')
            ->where('id', $officers_id)
            ->update([
                'lat' => $requestData['lat'],
                'lng' => $requestData['lng'],
                'updated_at' => now()
            ]);

        return "success" ;
    }

    public function UpdateStatusOfficer(Request $request, $officers_id , $status)
    {
        $requestData = $request->all();

        if($status == 'null'){
            $status = null ;
        }

        $updateData = [
            'status' => $status,
            'updated_at' => now(),
        ];

        // ถ้ามี lat/lng ค่อยเพิ่มเข้าไป
        if (isset($requestData['lat']) && isset($requestData['lng'])) {
            $updateData['lat'] = $requestData['lat'];
            $updateData['lng'] = $requestData['lng'];
        } else {
            // ถ้าไม่มี ให้เคลียร์ตำแหน่ง (เลือกได้ว่าจะ null หรือไม่อัพเดต)
            $updateData['lat'] = null;
            $updateData['lng'] = null;
        }

        DB::table('aims_operating_officers')
            ->where('id', $officers_id)
            ->update($updateData);

        return "success";
    }

    function get_data_individual_officer($officers_id){
        $data_officer = DB::table('aims_operating_officers')
            ->where('aims_operating_officers.id', '=', $officers_id)
            ->leftJoin('aims_operating_units', 'aims_operating_officers.aims_operating_unit_id', '=', 'aims_operating_units.id')
            ->leftJoin('aims_type_units', 'aims_operating_units.aims_type_unit_id', '=', 'aims_type_units.id')
            ->leftJoin('users', 'aims_operating_officers.user_id', '=', 'users.id')
            ->select(
                'aims_operating_officers.name_officer',
                'aims_operating_units.name_unit',
                'aims_type_units.name_type_unit',
                'users.photo'
            )
            ->get();

        return $data_officer;

    }

    function officer_change_status(Request $request){
        $data_user = Auth::user();
        $data_officer = DB::table('aims_operating_officers')
            ->where('user_id', $data_user->id)
            ->first();

        return view('aims_operating_officers.change_status', compact('data_user','data_officer'));
    }

    function officer_register_operating(){
        return view('aims_operating_officers.officer_register_operating');
    }

    function officer_register_unit(Request $request, $unit_id){

        $data_user = Auth::user();
        $info = [];
        $unit_old = null ;

        $check_officer = DB::table('aims_operating_officers')
            ->where('user_id', $data_user->id)
            ->first();

        $info['old_data'] = "ไม่มีข้อมูล";
        if( !empty($check_officer->id) ){
            $info['old_data'] = "มีข้อมูลเดิม";
            $info['old_unit'] = "คนละหน่วย";
            if( $check_officer->aims_operating_unit_id == $unit_id ){
                $info['old_unit'] = "หน่วยเดิม";
            }
            else{
                $unit_old = DB::table('aims_operating_units')
                    ->where('aims_operating_units.id', '=', $check_officer->aims_operating_unit_id)
                    ->leftJoin('aims_type_units', 'aims_operating_units.aims_type_unit_id', '=', 'aims_type_units.id')
                    ->select(
                        'aims_operating_units.*',
                        'aims_type_units.name_type_unit',
                    )
                    ->first();
            }
        }

        $data = DB::table('aims_operating_units')
            ->where('aims_operating_units.id', '=', $unit_id)
            ->leftJoin('aims_type_units', 'aims_operating_units.aims_type_unit_id', '=', 'aims_type_units.id')
            ->select(
                'aims_operating_units.*',
                'aims_type_units.name_type_unit',
            )
            ->first();

        return view('aims_operating_officers.officer_register_unit', compact('data','info','unit_old'));
    }

    public function officer_reg_to_unit(Request $request)
    {
        // ตรวจสอบความถูกต้องของข้อมูล
        $validator = Validator::make($request->all(), [
            'name_officer' => 'required|string|max:255',
            'vehicle_type' => 'required|string|max:255',
            'user_id' => 'required|numeric',
            'aims_operating_unit_id' => 'required|numeric',
            'aims_partner_id' => 'required|numeric',
            'aims_area_id' => 'required|numeric',
            'level' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // หา officer ที่มี user_id นี้อยู่แล้วหรือไม่
        $officer = Aims_operating_officer::where('user_id', $request->user_id)->first();

        if ($officer) {
            // อัพเดทข้อมูล officer เดิม
            $officer->update($request->all());
        } else {
            // สร้างข้อมูล officer ใหม่
            $officer = Aims_operating_officer::create($request->all());
        }

        // อัพเดท role ของ user ในตาราง users
        $user = User::find($request->user_id);
        if ($user) {
            $user->role = 'officer-area';
            $user->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'ลงทะเบียนสำเร็จ',
            'data' => $officer
        ], 201);
    }

}
