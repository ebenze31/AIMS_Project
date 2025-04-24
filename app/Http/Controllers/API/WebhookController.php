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

        // ดึงข้อมูลจากฟิลด์
        $report_platform = $formData['report_platform'] ?? 'LINE OA Hello';
        $name_reporter = $formData['name_reporter'] ?? 'Guest';
        $type_reporter = $formData['type_reporter'] ?? '';
        $phone_reporter = $formData['phone_reporter'] ?? '';

        // Debug: บันทึกข้อมูลที่ได้รับ
        \Log::info('Received form-sos data:', $formData);

        // เก็บข้อมูลลง session
        $sessionData = [
            'report_platform' => $report_platform,
            'name_reporter' => $name_reporter,
            'type_reporter' => $type_reporter,
            'phone_reporter' => $phone_reporter,
        ];

        // Debug: บันทึกข้อมูลที่เก็บใน session
        \Log::info('Storing in session:', $sessionData);

        return redirect()->route('form.sos')->with($sessionData);
    }
}
