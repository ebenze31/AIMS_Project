<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // รับข้อมูลจาก Third Party
        $data = $request->all();

        // บันทึกลง session อยู่แค่ 1 request
        session()->flash('webhook_data', $data);

        return redirect()->route('form_sos');
        // return response()->json([
        //     'redirect_url' => route('form_sos')  // ส่ง URL ที่ต้องการให้ทำการ redirect
        // ]);

    }
}
