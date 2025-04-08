<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // รับข้อมูลจาก Third Party
        $data = $request->all();

        // บันทึกลง session เพื่อให้ frontend นำไปใช้
        session(['webhook_data' => $data]);

        return redirect()->route('form_sos');
    }
}
