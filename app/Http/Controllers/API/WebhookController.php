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
        $name = $data['name'] ?? 'Guest';
        $email = $data['email'] ?? '';
        $phone = $data['phone'] ?? ''; // เพิ่มตามข้อมูลที่ third-party ส่งมา

        // redirect ไปยังหน้า form_sos พร้อมส่งข้อมูลผ่าน session
        return redirect()->route('form.sos')->with([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);
    }
}
