<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // รับข้อมูลจาก third-party
        $data = $request->all();

        // ตัวอย่าง: ดึงข้อมูลที่คาดว่าจะได้รับ (ปรับตามโครงสร้างข้อมูลจริง)
        $report_platform = $data['report_platform'] ?? '';
        $name_reporter = $data['name_reporter'] ?? 'Guest';
        $type_reporter = $data['type_reporter'] ?? '';
        $phone_reporter = $data['phone_reporter'] ?? '';

        // ตรวจสอบและแปลงข้อมูลภาษาไทยให้แน่ใจว่า encoding ถูกต้อง
        $name_reporter = mb_convert_encoding($name_reporter, 'UTF-8', 'auto');
        $type_reporter = mb_convert_encoding($type_reporter, 'UTF-8', 'auto');

        // เก็บข้อมูลใน session โดยใช้ with() เพื่อส่งไปยังหน้า form_sos
        return redirect()->route('form_sos')->with([
            'report_platform' => $report_platform,
            'name_reporter' => $name_reporter,
            'type_reporter' => $type_reporter,
            'phone_reporter' => $phone_reporter,
        ]);
    }
}
