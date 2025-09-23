<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AutoSendSOS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $officer_ids;  // << เปลี่ยนเป็น Array
    protected $case_id;
    protected $current_index; // << ลำดับปัจจุบันใน Array

    /**
     * รับรายชื่อ ID ทั้งหมด และลำดับที่จะทำงาน
     */
    public function __construct(array $officer_ids, $case_id, int $current_index)
    {
        $this->officer_ids = $officer_ids;
        $this->case_id = $case_id;
        $this->current_index = $current_index;
    }

    public function handle()
    {
        // --- 1. ทำงานของตัวเอง (ส่งหาคนเดียวตามลำดับ) ---
        
        // หยิบ ID ของเจ้าหน้าที่คนปัจจุบันจาก Array
        $current_officer_id = $this->officer_ids[$this->current_index];
        
        $text = "เคส : " . $this->case_id . " | คนที่ >> " . ($this->current_index + 1);
        Log::info("Worker กำลังส่งหา {$current_officer_id} | {$text}");

        // (ส่วนของการสร้าง body และยิง LINE API)
        $template_path = storage_path('../public/json/text_success.json');
        $string_json_template = file_get_contents($template_path);
        $final_json_string = str_replace("ระบบได้รับการตอบกลับของท่านแล้ว ขอบคุณค่ะ", $text, $string_json_template);
        $body = [
            "to" => $current_officer_id, // << ใช้ ID ของคนปัจจุบัน
            "messages" => [ json_decode($final_json_string, true) ],
        ];
        $response = Http::withToken(env('CHANNEL_ACCESS_TOKEN'))
                        ->post('https://api.line.me/v2/bot/message/push', $body);

        if ($response->failed()) {
            Log::error("ส่ง LINE ไม่สำเร็จหา {$current_officer_id}: " . $response->body());
            // อาจจะเลือกให้หยุดโซ่ หรือข้ามไปคนถัดไปก็ได้
            // ในที่นี้เราจะให้มันหยุดไปเลย
            return;
        }

        // --- 2. สร้างงานชิ้นต่อไป (ถ้ายังมีคนเหลือในรายชื่อ) ---
        $next_index = $this->current_index + 1;

        // ตรวจสอบว่ายังมีเจ้าหน้าที่คนถัดไปใน Array หรือไม่
        if (isset($this->officer_ids[$next_index])) {
            // สร้าง Job ใหม่สำหรับคนถัดไป โดยส่ง "รายชื่อเดิมทั้งหมด" และ "ลำดับใหม่"
            self::dispatch($this->officer_ids, $this->case_id, $next_index)
                ->delay(now()->addSeconds(10)); // << หน่วงเวลา 10 วินาที
        } else {
            Log::info("จบกระบวนการสำหรับเคส {$this->case_id} | ส่งครบทุกคนแล้ว");
        }
    }
}