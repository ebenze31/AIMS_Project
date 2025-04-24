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

        // ดึงข้อมูลจาก key 'form-sos'
        $formData = $data['form-sos'] ?? [];

        // ดึงข้อมูลจากฟิลด์ที่ต้องการ
        $report_platform = $formData['report_platform'] ?? ''; // หากไม่มี report_platform ให้ใช้ค่าเริ่มต้น
        $name_reporter = $formData['name_reporter'] ?? 'Guest';
        $type_reporter = $formData['type_reporter'] ?? '';
        $phone_reporter = $formData['phone_reporter'] ?? '';

        // เก็บข้อมูลลง session และ redirect
        return redirect()->route('form.sos')->with([
            'report_platform' => $report_platform,
            'name_reporter' => $name_reporter,
            'type_reporter' => $type_reporter,
            'phone_reporter' => $phone_reporter,
        ]);
    }
}
