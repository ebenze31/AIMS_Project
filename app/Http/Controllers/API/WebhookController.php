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

        // ตรวจสอบโครงสร้างข้อมูล: ถ้ามี form-sos ให้ดึงจาก form-sos, ถ้าไม่มีให้ใช้ $data ตรง ๆ
        $formData = isset($data['form-sos']) ? $data['form-sos'] : $data;

        return view('aims_emergencys.aims_sos', compact('formData'));
    }
}
