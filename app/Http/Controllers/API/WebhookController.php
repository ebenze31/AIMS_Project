<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $data = $request->all();
        $formData = $data['form-sos'] ?? [];

        $report_platform = $formData['report_platform'] ?? '';
        $name_reporter = $formData['name_reporter'] ?? 'Guest';
        $type_reporter = $formData['type_reporter'] ?? '';
        $phone_reporter = $formData['phone_reporter'] ?? '';

        // Redirect พร้อมส่งข้อมูลใน query string
        return redirect()->route('form.sos', [
            'report_platform' => $report_platform,
            'name_reporter' => $name_reporter,
            'type_reporter' => $type_reporter,
            'phone_reporter' => $phone_reporter,
        ]);
    }
}
