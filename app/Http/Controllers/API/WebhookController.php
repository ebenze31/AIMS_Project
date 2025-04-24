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
        $formData = $data['form-sos'] ?? [];

        // Debug: ตรวจสอบข้อมูลดิบที่ได้รับ
        \Log::info('Raw request data:', $data);
        \Log::info('Received form-sos data:', $formData);

        // ดึงข้อมูลจากฟิลด์ โดยไม่ override ถ้ามีข้อมูล
        $report_platform = isset($formData['report_platform']) ? $formData['report_platform'] : '';
        $name_reporter = isset($formData['name_reporter']) ? $formData['name_reporter'] : 'Guest';
        $type_reporter = isset($formData['type_reporter']) ? $formData['type_reporter'] : '';
        $phone_reporter = isset($formData['phone_reporter']) ? $formData['phone_reporter'] : '';

        // Debug: ตรวจสอบข้อมูลที่เก็บใน session
        $sessionData = [
            'report_platform' => $report_platform,
            'name_reporter' => $name_reporter,
            'type_reporter' => $type_reporter,
            'phone_reporter' => $phone_reporter,
        ];
        \Log::info('Storing in session:', $sessionData);

        // เก็บข้อมูลลง session
        session()->flash('report_platform', $report_platform);
        session()->flash('name_reporter', $name_reporter);
        session()->flash('type_reporter', $type_reporter);
        session()->flash('phone_reporter', $phone_reporter);

        return redirect()->route('form.sos');
    }
}
