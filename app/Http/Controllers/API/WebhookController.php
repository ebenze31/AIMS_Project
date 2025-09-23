<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aims_emergency;
use Illuminate\Support\Facades\Http;
use App\Models\MyLog; 

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

    public function sos_device(Request $request)
    {
        try {
            // Validate ข้อมูล
            $validated = $request->validate([
                'report_platform' => 'required|string|max:50',
                'name_reporter' => 'required|string|max:100',
                'type_reporter' => 'required|string|max:50',
                'phone_reporter' => 'required|string|max:20',
                'emergency_type' => 'required|string|max:50',
                'emergency_detail' => 'required|string|max:500',
                'emergency_lat' => 'required|string|regex:/^-?\d{1,3}\.\d{1,6}$/', // ตรวจสอบ latitude
                'emergency_lng' => 'required|string|regex:/^-?\d{1,3}\.\d{1,6}$/', // ตรวจสอบ longitude
                'emergency_location' => 'required|string|max:255',
                'emergency_photo_url' => 'required|url|max:255', // ตรวจสอบว่าเป็น URL
                'patient_name' => 'required|string|max:100',
                'patient_birth' => 'required|date_format:Y-m-d', // ตรวจสอบรูปแบบวันที่
                'patient_identification' => 'required|string|size:13', // ตัวอย่าง: เลขบัตรประชาชน 13 หลัก
                'patient_gender' => 'required|string|in:ชาย,หญิง,อื่นๆ', // จำกัดตัวเลือกเพศ
                'patient_blood_type' => 'required|string|in:A,B,AB,O', // จำกัดตัวเลือกกรุ๊ปเลือด
                'patient_phone' => 'required|string|max:20',
                'patient_address' => 'required|string|max:255',
                'patient_congenital_disease' => 'nullable|string|max:255', // อนุญาตให้ว่างได้
                'patient_allergic_drugs' => 'nullable|string|max:255', // อนุญาตให้ว่างได้
                'patient_regular_medications' => 'nullable|string|max:255', // อนุญาตให้ว่างได้
            ]);

            // บันทึกข้อมูลลง database
            $emergency = Aims_emergency::create($validated);

            // ส่ง response กลับ
            return response()->json([
                'status' => 'success',
                'message' => 'SOS request processed successfully',
                'sos_id' => $emergency->id // ส่ง ID ของ record ที่สร้าง
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // กรณี validation ล้มเหลว
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            // กรณีเกิดข้อผิดพลาดอื่นๆ
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    public static function sendSosStatus($data_for_api)
    {
        // URL ของ API ปลายทาง
        $apiUrl = 'https://helloapi.kivaru.com/api/v1.0/openapi/form-sos-status';

        if (empty($data_for_api['case_type'])) {
            $data_for_api['case_type'] = "ขอความช่วยเหลือ";
        }

        try {
            // --- ย้ายการบันทึก Log มาไว้ตรงนี้ ---
            // บันทึก "ความพยายาม" ในการส่งข้อมูลก่อนเสมอ
            MyLog::create([
                "title" => "Send Update API " . $data_for_api['case_id'],
                // บันทึกข้อมูลที่ "กำลังจะส่ง" ไปด้วยเพื่อการตรวจสอบ
                "content" => json_encode($data_for_api, JSON_UNESCAPED_UNICODE)
            ]);
            // ------------------------------------

            // ใช้ Http facade เพื่อส่ง POST request
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($apiUrl, $data_for_api);

            // หลังจากยิง API แล้ว เรายังสามารถบันทึก "ผลลัพธ์" เพิ่มเติมได้
            // (ส่วนนี้จะใส่หรือไม่ก็ได้ แต่แนะนำให้มีเพื่อดูว่า API ตอบอะไรกลับมา)
            MyLog::create([
                "title" => "API Response for case: " . $data_for_api['case_id'],
                "content" => $response->body()
            ]);

            // ส่วนที่เหลือยังคงทำงานเหมือนเดิมเพื่อส่งค่ากลับ
            return $response;

        } catch (\Exception $e) {
            // กรณีเชื่อมต่อไม่ได้ ก็ควรบันทึก Log เช่นกัน
            MyLog::create([
                "title" => "Connection Error for case: " . $data_for_api['case_id'],
                "content" => $e->getMessage()
            ]);

            return null;
        }
    }
}
