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

        // Debug: ตรวจสอบข้อมูลดิบที่ได้รับ
        \Log::info('Raw request data:', $data);

        // ตรวจสอบโครงสร้างข้อมูล: ถ้ามี form-sos ให้ดึงจาก form-sos, ถ้าไม่มีให้ใช้ $data ตรง ๆ
        $formData = isset($data['form-sos']) ? $data['form-sos'] : $data;

        // Debug: ตรวจสอบข้อมูลที่ดึงมาได้
        \Log::info('Received form-sos data:', $formData);

        // ดึงข้อมูลจากฟิลด์
        $report_platform = $formData['report_platform'] ?? '';
        $name_reporter = $formData['name_reporter'] ?? '';
        $type_reporter = $formData['type_reporter'] ?? '';
        $phone_reporter = $formData['phone_reporter'] ?? '';

        // Debug: ตรวจสอบข้อมูลที่เก็บใน session
        $sessionData = [
            'report_platform' => $report_platform,
            'name_reporter' => $name_reporter,
            'type_reporter' => $type_reporter,
            'phone_reporter' => $phone_reporter,
        ];
        \Log::info('Storing in session:', $sessionData);

        // เก็บข้อมูลลง session
        session()->put('report_platform', $report_platform);
        session()->put('name_reporter', $name_reporter);
        session()->put('type_reporter', $type_reporter);
        session()->put('phone_reporter', $phone_reporter);

        return redirect()->route('form.sos');
    }
}
