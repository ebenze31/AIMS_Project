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

    function check_data_area($user_id){
        $data = DB::table('aims_commands')
            ->where('aims_commands.user_id', '=' ,$user_id)
            ->leftjoin('aims_areas', 'aims_commands.aims_area_id', '=', 'aims_areas.id')
            ->select(
                'aims_areas.id as area_id',
                'aims_areas.name_area as name_area',
                'aims_areas.check_time_command as check_time_command',
                'aims_areas.time_start_command as time_start_command',
                'aims_areas.time_end_command as time_end_command',
                'aims_areas.day_command as day_command',
            )
            ->get();

        return $data ;
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

    function check_to_home(){
        // ตรวจสอบว่าผู้ใช้ login แล้วหรือไม่
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        
        if (in_array($user->role, ['operator-area', 'admin-area', 'admin-partner'])) {
            return redirect('/partner_index');
        } elseif ($user->role === 'officer-area') {
            return redirect('/home_for_officer');
        }
        else {
            return redirect('/form-sos');
        }

        return redirect('/404');
    }

    public function save_time_config(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $validated = $request->validate([
            'id'                   => 'required|exists:aims_areas,id',
            'check_time_command'   => 'required|in:Yes,No',
            'day_command'          => 'nullable|string',
            'time_start_command'   => 'nullable|date_format:H:i',
            'time_end_command'     => 'nullable|date_format:H:i',
        ]);

        // เตรียมข้อมูลที่ต้องอัปเดต
        $updateData = [
            'check_time_command'   => $validated['check_time_command'],
            'day_command'          => $validated['day_command'],
            'time_start_command'   => $validated['check_time_command'] === 'Yes' ? $validated['time_start_command'] : null,
            'time_end_command'     => $validated['check_time_command'] === 'Yes' ? $validated['time_end_command'] : null,
            'updated_at'           => now(),
        ];

        // อัปเดตข้อมูลในตาราง aims_areas
        DB::table('aims_areas')
            ->where('id', $validated['id'])
            ->update($updateData);

        return response()->json([
            'status' => 'success',
            'message' => 'บันทึกเวลาทำการในพื้นที่สำเร็จ',
            'data' => $updateData
        ]);
    }

    function check_auto_emergency_types($user_id)
    {
        // 1. หาพื้นที่จาก user_id
        $data = DB::table('aims_commands')
            ->where('user_id', $user_id)
            ->select('aims_area_id')
            ->first();

        if (!$data) {
            return response()->json(['error' => 'ไม่พบ aims_area_id'], 404);
        }

        $aims_area_id = $data->aims_area_id;

        // 2. ดึง emergency_types จากพื้นที่นั้น
        $emergency_types = DB::table('aims_emergency_types')
            ->where('aims_area_id', $aims_area_id)
            ->where('status', "Active")
            ->pluck('name_emergency_type')
            ->toArray();

        // 3. เพิ่ม "ผู้ใช้ไม่ได้กรอก" เข้าไป
        $emergency_types[] = 'ผู้ใช้ไม่ได้กรอก';

        // 4. ดึงหน่วยทั้งหมดในพื้นที่
        $all_units = DB::table('aims_type_units')
            ->where('aims_area_id', $aims_area_id)
            ->get();

        // 5. สร้างรายการ emergency_type ทั้งหมดที่ปรากฏจริงใน aims_type_units
        $existing_emergency_types = $all_units
            ->pluck('emergency_type')
            ->map(function ($json) {
                $decoded = json_decode($json, true);
                if (is_array($decoded)) {
                    return collect($decoded)->pluck('name_emergency_type')->toArray();
                }
                return [];
            })
            ->flatten()
            ->unique()
            ->toArray();

        // 6. แยกประเภทที่ขาด และที่มีอยู่
        $missing_emergency_types = [];
        $has_emergency_types = [];

        foreach ($emergency_types as $type_name) {
            $unit_count = 0;

            foreach ($all_units as $unit) {
                $decoded = json_decode($unit->emergency_type, true);
                if (is_array($decoded)) {
                    foreach ($decoded as $item) {
                        if (
                            isset($item['name_emergency_type']) &&
                            $item['name_emergency_type'] === $type_name
                        ) {
                            $unit_count++;
                            break; // เจอใน unit นี้พอแล้ว
                        }
                    }
                }
            }

            if ($unit_count === 0) {
                $missing_emergency_types[] = [
                    'name_emergency_type' => $type_name
                ];
            } else {
                $has_emergency_types[] = [
                    'name_emergency_type' => $type_name,
                    'unit_count' => $unit_count
                ];
            }
        }

        return response()->json([
            'aims_area_id' => $aims_area_id,
            'has_emergency_types' => $has_emergency_types,
            'missing_emergency_types' => $missing_emergency_types,
        ]);
    }

}
