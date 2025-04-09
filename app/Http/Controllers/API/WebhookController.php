<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    // public function handle(Request $request)
    // {
    //     // รับข้อมูลจาก Third Party
    //     $data = $request->all();

    //     // บันทึกลง session อยู่แค่ 1 request
    //     session()->flash('webhook_data', $data);

    //     return redirect()->route('form_sos');
    //     // return response()->json([
    //     //     'redirect_url' => route('form_sos')  // ส่ง URL ที่ต้องการให้ทำการ redirect
    //     // ]);

    // }

    public function handle(Request $request)
    {
        // รับข้อมูลจาก third-party
        $data = $request->all();

        // ตัวอย่าง: ดึงข้อมูลที่คาดว่าจะได้รับ (ปรับตามโครงสร้างข้อมูลจริง)
        $report_platform = $data['report_platform'] ?? '';
        $name_reporter = $data['name_reporter'] ?? 'Guest';
        $type_reporter = $data['type_reporter'] ?? '';
        $phone_reporter = $data['phone_reporter'] ?? '';

        // redirect ไปยังหน้า form_sos พร้อมส่งข้อมูลผ่าน session
        return redirect()->route('form_sos')->with([
            'report_platform' => $report_platform,
            'name_reporter' => $name_reporter,
            'type_reporter' => $type_reporter,
            'phone_reporter' => $phone_reporter,
        ]);
    }
}
