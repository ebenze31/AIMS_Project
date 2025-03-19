<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Register_car;
use Illuminate\Support\Facades\DB;
use App\Models\Mylog;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailToGuest;
use App\Http\Controllers\API\API_Time_zone;
use App\Models\Text_topic;
use App\User;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\API\ImageController;
use App\Models\Sos_partner_officer;


class LineMessagingAPI extends Model
{
    // public $channel_access_token = env('CHANNEL_ACCESS_TOKEN');

    public function reply_success($event , $data_postback)
    {
        $data_Text_topic = [
            "ระบบได้รับการตอบกลับของท่านแล้ว ขอบคุณค่ะ",
        ];

        $data_topic = $this->language_for_user($data_Text_topic, $event["source"]['userId']);

        $template_path = storage_path('../public/json/text_success.json');

        $string_json = file_get_contents($template_path);
        $string_json = str_replace("ระบบได้รับการตอบกลับของท่านแล้ว ขอบคุณค่ะ",$data_topic[0],$string_json);
        $messages = [ json_decode($string_json, true) ];


        $body = [
            "replyToken" => $event["replyToken"],
            "messages" => $messages,
        ];

        $opts = [
            'http' =>[
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];

        $context  = stream_context_create($opts);
        //https://api-data.line.me/v2/bot/message/11914912908139/content
        $url = "https://api.line.me/v2/bot/message/reply";
        $result = file_get_contents($url, false, $context);

        //SAVE LOG
        $data = [
            "title" => "ระบบได้รับการตอบกลับของท่านแล้ว ขอบคุณค่ะ",
            "content" => "reply Success",
        ];
        MyLog::create($data);
        return $result;

    }
    public function select_reply($data, $event, $postback_data)
    {
        // ป้ายทะเบียนรถที่ถูกเรียก
        $data_postback_explode = explode("?",$event["postback"]["data"]);
        $license_plate = explode("/",$data_postback_explode[1]);  ;
        $registration_number = $license_plate[0];
        $province = $license_plate[1];

        $data_cars = DB::table('register_cars')
                ->where('registration_number', $registration_number)
                ->where('province', $province)
                ->get();

        foreach ($data_cars as $data_car) {
            $license_plate_id = $data_car->id ;
            $car_type = $data_car->car_type ;
        }

        $data_Text_topic = [
            "ขอบคุณ",
            "รอสักครู่",
            "ฉันไม่สะดวก",
            "เลือกการตอบกลับ",
            "ตอบกลับได้เพียง 1 ข้อ เท่านั้น",
        ];

        $data_topic = $this->language_for_user($data_Text_topic, $event["source"]['userId']);

        switch($car_type)
        {
            case "car":
                $template_path = storage_path('../public/json/viimove/reply/flex_select_reply_car.json');
                $string_json = file_get_contents($template_path);
                break;
            case "motorcycle":
                $template_path = storage_path('../public/json/viimove/reply/flex_select_reply_motorcycle.json');
                $string_json = file_get_contents($template_path);

                $reg = $registration_number ;
                $reg_text = preg_replace('/[0-9]+/', '', $reg);
                $reg_num = preg_replace('/[^A-Za-z0-9\-]/', ' ', $reg);
                $reg_num_sp = explode(" ", $reg_num);
                $last_list_num = count($reg_num_sp) - 1 ;

                $reg_1 = $reg_num_sp[0] . $reg_text ;
                $reg_2 = $reg_num_sp[$last_list_num] ;

                $string_json = str_replace("TEXT_REG_MOR_1",$reg_1,$string_json);
                $string_json = str_replace("TEXT_REG_MOR_2",$reg_2,$string_json);
                break;
            default:
                $template_path = storage_path('../public/json/viimove/reply/flex_select_reply_car.json');
                $string_json = file_get_contents($template_path);
                break;
        }


        $string_json = str_replace("TEXT_REG_NUM",$registration_number,$string_json);
        $string_json = str_replace("TEXT_REG_PRO",$province,$string_json);
        $string_json = str_replace("license_plate_id",$license_plate_id,$string_json);

        $string_json = str_replace("ขอบคุณ",$data_topic[0],$string_json);
        $string_json = str_replace("รอสักครู่",$data_topic[1],$string_json);
        $string_json = str_replace("ฉันไม่สะดวก",$data_topic[2],$string_json);
        $string_json = str_replace("เลือกการตอบกลับ",$data_topic[3],$string_json);
        $string_json = str_replace("ตอบกลับได้เพียง 1 ข้อ เท่านั้น",$data_topic[4],$string_json);

        $messages = [ json_decode($string_json, true) ];

        $body = [
            "replyToken" => $event["replyToken"],
            "messages" => $messages,
        ];

        $opts = [
            'http' =>[
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];

        $context  = stream_context_create($opts);
        $url = "https://api.line.me/v2/bot/message/reply";
        $result = file_get_contents($url, false, $context);

        //SAVE LOG
        $data = [
            "title" => "ส่งข้อความเลือกการตอบกลับ ",
            "content" => "ตอบกลับ " . $registration_number . '/' . $province,
        ];
        MyLog::create($data);
        return $result;

    }

    public function replyToUser($data, $event, $message_type)
    {
    	switch($message_type)
        {
            case 'niems':
                $template_path = storage_path('../public/json/text_success.json');
                $string_json = file_get_contents($template_path);
                $string_json = str_replace("ระบบได้รับการตอบกลับของท่านแล้ว ขอบคุณค่ะ","https://www.viicheck.com/officers/switch_standby_login?openExternalBrowser=1",$string_json);

                $messages = [ json_decode($string_json, true) ];
            break;
            case 'Chinese':
                $provider_id = $event["source"]['userId'];
                $user = User::where('provider_id', $provider_id)->get();

                foreach ($user as $item) {
                    $user_id = $item->id ;
                }
                $template_path = storage_path('../public/json/flex-language-Chinese.json');
                $string_json = file_get_contents($template_path);
                $string_json = str_replace("user_id",$user_id,$string_json);

                $messages = [ json_decode($string_json, true) ];
            break;
            case "contact_viiCHECK":

                $template_path = storage_path('../public/json/flex-contact.json');
                $string_json = file_get_contents($template_path);
                $string_json = str_replace("โทร","โทร / Call",$string_json);
                $string_json = str_replace("อีเมล","อีเมล / E-mail",$string_json);
                $string_json = str_replace("Facebook","Facebook",$string_json);

                $messages = [ json_decode($string_json, true) ];
                break;
            case "language":
                $provider_id = $event["source"]['userId'];

                $user = DB::select("SELECT * FROM users WHERE provider_id = '$provider_id'");
                foreach ($user as $item) {
                    $user_id = $item->id ;
                }
                $template_path = storage_path('../public/json/flex-language.json');
                $string_json = file_get_contents($template_path);
                $string_json = str_replace("user_id",$user_id,$string_json);

                $messages = [ json_decode($string_json, true) ];
                break;
        	case "other":

                $data_Text_topic = [
                    "ข้อมูลของคุณ",
                    "ถาม",
                    "ตอบ",
                    "ติดต่อ",
                    "ตามหาสัตว์เลี้ยง",
                    "ชุมชน",
                    "รพ.สัตว์",
                    "ลงทะเบียน",
                    "petland",
                    "เปิดสถานะ",
                    "การช่วยเหลือ",
                    "แก้ไขข้อมูล",
                    "แจ้งปัญหา",
                ];

                $data_topic = $this->language_for_user($data_Text_topic, $event["source"]['userId']);

                $data_user = User::where('provider_id' , $event["source"]['userId'])->first();

                // ---- //// ส่ง เมนู สพฉ //// ---- //
                if ($message_type == "other" && $data_user->organization == "สพฉ") {

                    $template_path = storage_path('../public/json/flex-sos-1669/flex_other_officer.json');
                    $string_json = file_get_contents($template_path);

                    $string_json = str_replace("เปิดสถานะ",$data_topic[9],$string_json);
                    $string_json = str_replace("การช่วยเหลือ",$data_topic[10],$string_json);
                    $string_json = str_replace("แก้ไขข้อมูล",$data_topic[11],$string_json);
                    $string_json = str_replace("แจ้งปัญหา",$data_topic[12],$string_json);

                }else{

                    $template_path = storage_path('../public/json/flex-other_new.json');
                    $string_json = file_get_contents($template_path);

                    $string_json = str_replace("ตามหาสัตว์เลี้ยง",$data_topic[4],$string_json);
                    $string_json = str_replace("ชุมชน",$data_topic[5],$string_json);
                    $string_json = str_replace("รพ.สัตว์",$data_topic[6],$string_json);
                    $string_json = str_replace("ลงทะเบียน",$data_topic[7],$string_json);
                    $string_json = str_replace("petland",$data_topic[8],$string_json);

                }

                $string_json = str_replace("ข้อมูลของคุณ",$data_topic[0],$string_json);
                $string_json = str_replace("ถาม",$data_topic[1],$string_json);
                $string_json = str_replace("ตอบ",$data_topic[2],$string_json);
                $string_json = str_replace("ติดต่อ",$data_topic[3],$string_json);


                $messages = [ json_decode($string_json, true) ];
                break;
            case "sos":
                $template_path = storage_path('../public/json/flex-sos.json');
                $string_json = file_get_contents($template_path);

                $messages = [ json_decode($string_json, true) ];
                break;
            case "contact":

                $data_Text_topic = [
                    "โทร",
                    "อีเมล",
                    "ติดต่อเรา",
                ];

                $data_topic = $this->language_for_user($data_Text_topic, $event["source"]['userId']);

                $template_path = storage_path('../public/json/flex-contact.json');
                $string_json = file_get_contents($template_path);
                $string_json = str_replace("โทร",$data_topic[0],$string_json);
                $string_json = str_replace("อีเมล",$data_topic[1],$string_json);
                $string_json = str_replace("ติดต่อเรา",$data_topic[2],$string_json);

                $messages = [ json_decode($string_json, true) ];
                break;
            case "vmarket":
                $template_path = storage_path('../public/json/flex-vmarket.json');
                $string_json = file_get_contents($template_path);

                $messages = [ json_decode($string_json, true) ];
                break;
            case "vnews":
                $template_path = storage_path('../public/json/flex-vnews.json');
                $string_json = file_get_contents($template_path);

                $messages = [ json_decode($string_json, true) ];
                break;
            case "peddyhub":
                $template_path = storage_path('../public/json/peddyhub.json');
                $string_json = file_get_contents($template_path);

                $messages = [ json_decode($string_json, true) ];
                break;
            case "profile":

                $provider_id = $event["source"]['userId'];

                $user = DB::select("SELECT * FROM users WHERE provider_id = '$provider_id'");

                foreach($user as $item){
                    if (!empty($item->sex)) {
                        $sex = $item->sex ;
                    }else{
                        $sex = "กรุณาระบุเพศ" ;
                    }

                    $date_time_birth = strtotime($item->brith);

                    if(date('m-d') == date('m-d', $date_time_birth)) {
                        $birth_day = "สุขสันต์วันเกิด";
                        $img_birthday = "https://www.viicheck.com/img/stickerline/PNG/48.png";
                    }else{
                        $birth_day = "วันเกิด";
                        $img_birthday = "https://www.viicheck.com/img/stickerline/PNG/47.png";
                    }

                    $data_Text_topic = [
                        "แก้ไข",
                        "อีเมล",
                        "เบอร์ติดต่อ",
                        $birth_day,
                        "เพศ",
                        $sex,
                        "ใบอนุญาตขับรถ",
                    ];

                    $data_topic = $this->language_for_user($data_Text_topic, $event["source"]['userId']);

                    if (!empty($item->photo)) {
                        $photo_profile = "https://www.viicheck.com/storage/".$item->photo ;
                    }
                    if (empty($item->photo)) {
                        if ($item->avatar == "กรุณาเพิ่มรูปโปรไฟล์") {
                            $photo_profile = "https://www.viicheck.com/img/stickerline/PNG/tab.png";
                        }else{
                            $photo_profile = $item->avatar ;
                        }
                    }

                    $template_path = storage_path('../public/json/flex-profile.json');
                    $string_json = file_get_contents($template_path);
                    $string_json = str_replace("แก้ไข",$data_topic[0],$string_json);
                    $string_json = str_replace("อีเมล",$data_topic[1],$string_json);
                    $string_json = str_replace("เบอร์ติดต่อ",$data_topic[2],$string_json);
                    $string_json = str_replace("วันเกิด",$data_topic[3],$string_json);
                    $string_json = str_replace("เพศ",$data_topic[4],$string_json);
                    $string_json = str_replace("ชาย",$data_topic[5],$string_json);
                    $string_json = str_replace("ใบอนุญาตขับรถ",$data_topic[6],$string_json);

                    $string_json = str_replace("https://scdn.line-apps.com/n/channel_devcenter/img/flexsnapshot/clip/clip13.jpg",$photo_profile,$string_json);
                    $string_json = str_replace("E Benze",$item->name,$string_json);
                    $string_json = str_replace("benze@gmail.com",$item->email,$string_json);
                    $string_json = str_replace("https://www.viicheck.com/img/stickerline/PNG/47.png",$img_birthday,$string_json);

                    // เบอร์โทร
                    if (!empty($item->phone)) {
                        $string_json = str_replace("0999999999",$item->phone,$string_json);
                    }else{
                        $string_json = str_replace("0999999999","กรุณาเพิ่มเบอร์โทรศัพท์",$string_json);
                    }


                    $date_birth = date('d/m/Y', $date_time_birth);
                    // วันเกิด
                    if (!empty($item->brith)) {
                        $string_json = str_replace("31/08/1998",$date_birth,$string_json);

                    }else{
                        $string_json = str_replace("31/08/1998","กรุณาเพิ่มวันเกิด",$string_json);
                         $string_json = str_replace("https://scdn.line-apps.com/n/channel_devcenter/img/flexsnapshot/clip/clip13.jpg",$photo_profile,$string_json);

                    }

                    // Random logo partner
                    $Random_logo = new ImageController();

                    $img_partner = $Random_logo->Random_logo_partner(5) ;

                    $string_json = str_replace("IMGPARTNER_1",$img_partner[0],$string_json);
                    $string_json = str_replace("IMGPARTNER_2",$img_partner[1],$string_json);
                    $string_json = str_replace("IMGPARTNER_3",$img_partner[2],$string_json);
                    $string_json = str_replace("IMGPARTNER_4",$img_partner[3],$string_json);
                    $string_json = str_replace("IMGPARTNER_5",$img_partner[4],$string_json);

                    // เพศ
                    // if (!empty($item->sex)) {
                    //     $string_json = str_replace("ชาย",$item->sex,$string_json);
                    // }else{
                    //     $string_json = str_replace("ชาย","กรุณาระบุเพศ",$string_json);
                    // }
                    // ranking
                    // if (!empty($item->ranking)) {
                    //     switch ($item->ranking) {
                    //         case 'Gold':
                    //             $string_json = str_replace("1212312121","gold",$string_json);
                    //             break;
                    //         case 'Silver':
                    //             $string_json = str_replace("1212312121","silver",$string_json);
                    //             break;
                    //         case 'Bronze':
                    //             $string_json = str_replace("1212312121","bronze",$string_json);
                    //             break;
                    //     }
                    // }

                    $string_json = str_replace("xxxxx",$item->id,$string_json);

                    // // พรบ

                    // // เวลาปัจจุบัน
                    // $date_now = date("Y-m-d ");
                    // // วันหมดอายุ พรบ
                    // $dtae_act = $item->act;
                    // // ตัวแปรสำหรับเช็คการแจ้งเตือน
                    // $alert = (strtotime($dtae_act) - strtotime($date_now))/  ( 60 * 60 * 24 );

                    // if ($alert <= 30 && $alert >= 1) {
                    //     $string_json = str_replace("tick","warning",$string_json);
                    // }
                    // if ($alert <= 0){
                    //     $string_json = str_replace("tick","wrong",$string_json);
                    // }

                    // ข้อความสุดท้ายที่จะส่ง
                    $messages = [ json_decode($string_json, true) ];

                }

                break;

            case "myvehicle":
                $data_Text_topic = [
                    "รถยนต์",
                    "จักรยานยนต์",
                    "รถอื่นๆ",
                ];

                $data_topic = $this->language_for_user($data_Text_topic, $event["source"]['userId']);

                $template_path = storage_path('../public/json/flex_select_car.json');
                $string_json = file_get_contents($template_path);
                $string_json = str_replace("รถยนต์",$data_topic[0],$string_json);
                $string_json = str_replace("จักรยานยนต์",$data_topic[1],$string_json);
                $string_json = str_replace("รถอื่นๆ",$data_topic[2],$string_json);


                $messages = [ json_decode($string_json, true) ];
            break;

            case "mycar":

                $data_Text_topic = [
                    "รถของฉัน",
                    "พรบ",
                    "ประกัน",
                    "ดูรถทั้งหมด",
                ];

                $data_topic = $this->language_for_user($data_Text_topic, $event["source"]['userId']);

                $provider_id = $event["source"]['userId'];

                $car_row = DB::select("SELECT * FROM register_cars WHERE provider_id = '$provider_id' AND active = 'Yes' AND car_type = 'car' ");

                $randomCar = DB::table('register_cars')
                    ->where('provider_id' , $provider_id)
                    ->where('car_type' , "car")
                    ->where('active' , "Yes")
                    ->limit(3)
                    ->get();

                for ($i=0; $i < count($randomCar);) {
                    foreach($randomCar as $item ){
                        $id[$i] = $item->id;
                        $brand[$i] = $item->brand;
                        $registration_number[$i] = $item->registration_number;
                        $act[$i] = $item->act;
                        $insurance[$i] = $item->insurance;
                        $generation[$i] =  $item->generation;
                        $province[$i] =  $item->province;

                        $i++;
                    }
                }

                $edit = 49;
                $warning = 50;
                $wrong = 17;
                $tick = 18;

                switch(count($car_row))
                {
                    case "1":
                        $template_path = storage_path('../public/json/flex-mycar-1.json');
                        $string_json = file_get_contents($template_path);

                        $string_json = str_replace("รูป-แบนด์1", strtolower($brand[0]),$string_json);
                        $string_json = str_replace("แบนด์1", strtoupper($brand[0]),$string_json);
                        $string_json = str_replace("ป้ายทะเบียน1",$registration_number[0],$string_json);
                        $string_json = str_replace("รุ่น1",$generation[0],$string_json);
                        $string_json = str_replace("จังหวัด1",$province[0],$string_json);

                        $string_json = str_replace("act1",$id[0],$string_json);
                        // พรบ
                        // เวลาปัจจุบัน
                        $date_now = date("Y-m-d ");
                        // วันหมดอายุ พรบ
                        $dtae_act = $act[0];
                        // วันหมดอายุ ประกัน
                        $dtae_insurance = $insurance[0];
                        // ตัวแปรสำหรับเช็คการแจ้งเตือน
                        $act = (strtotime($dtae_act) - strtotime($date_now))/  ( 60 * 60 * 24 );



                        // ไม่ได้ใส่
                        if ($dtae_act == null){
                            $string_json = str_replace("พรบ1",$edit,$string_json);
                        }
                        // ใกล้หมด
                        if ($act <= 30 && $act >= 1) {
                            $string_json = str_replace("พรบ1",$warning,$string_json);
                        }
                        // หมด
                        if ($act <= 0){
                            $string_json = str_replace("พรบ1",$wrong,$string_json);
                        }
                        // ปรกติ
                        else{
                            $string_json = str_replace("พรบ1",$tick,$string_json);
                        }

                        $insurance = (strtotime($dtae_insurance) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_insurance == null){
                            $string_json = str_replace("ประกัน1",$edit,$string_json);
                        }
                        if ($insurance <= 30 && $insurance >= 1) {
                            $string_json = str_replace("ประกัน1",$warning,$string_json);
                        }
                        if ($insurance <= 0){
                            $string_json = str_replace("ประกัน1",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("ประกัน1",$tick,$string_json);
                        }

                        $string_json = str_replace("รถของฉัน",$data_topic[0],$string_json);
                        $string_json = str_replace("พรบ",$data_topic[1],$string_json);
                        $string_json = str_replace("ประกัน",$data_topic[2],$string_json);
                        $string_json = str_replace("ดูรถทั้งหมด",$data_topic[3],$string_json);

                        break;

                    case "2":
                        $template_path = storage_path('../public/json/flex-mycar-2.json');
                        $string_json = file_get_contents($template_path);

                        // คันที่1
                        $string_json = str_replace("รูป-แบนด์1", strtolower($brand[0]),$string_json);
                        $string_json = str_replace("แบนด์1", strtoupper($brand[0]),$string_json);
                        $string_json = str_replace("รุ่น1",$generation[0],$string_json);
                        $string_json = str_replace("จังหวัด1",$province[0],$string_json);
                        $string_json = str_replace("ป้ายทะเบียน1",$registration_number[0],$string_json);
                        $string_json = str_replace("act1",$id[0],$string_json);

                        // พรบ
                        // เวลาปัจจุบัน
                        $date_now = date("Y-m-d ");
                        // วันหมดอายุ พรบ คันที่ 1
                        $dtae_act = $act[0];
                        // วันหมดอายุ พรบ คันที่ 2
                        $dtae_act2 = $act[1];
                        // วันหมดอายุ ประกัน คันที่ 1
                        $dtae_insurance = $insurance[0];
                        // วันหมดอายุ ประกัน คันที่ 2
                        $dtae_insurance2 = $insurance[1];

                        // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 1
                        $act = (strtotime($dtae_act) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_act == null){
                            $string_json = str_replace("พรบ1",$edit,$string_json);
                        }
                        if ($act <= 30 && $act >= 1) {
                            $string_json = str_replace("พรบ1",$warning,$string_json);
                        }
                        if ($act <= 0){
                            $string_json = str_replace("พรบ1",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("พรบ1",$tick,$string_json);
                        }

                        $insurance = (strtotime($dtae_insurance) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_insurance == null){
                            $string_json = str_replace("ประกัน1",$edit,$string_json);
                        }
                        if ($insurance <= 30 && $insurance >= 1) {
                            $string_json = str_replace("ประกัน1",$warning,$string_json);
                        }
                        if ($insurance <= 0){
                            $string_json = str_replace("ประกัน1",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("ประกัน1",$tick,$string_json);
                        }

                        // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 2
                        $act2 = (strtotime($dtae_act2) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_act2 == null){
                            $string_json = str_replace("พรบ2",$edit,$string_json);
                        }
                        if ($act2 <= 30 && $act2 >= 1) {
                            $string_json = str_replace("พรบ2",$warning,$string_json);
                        }
                        if ($act2 <= 0){
                            $string_json = str_replace("พรบ2",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("พรบ2",$tick,$string_json);
                        }

                        $insurance2 = (strtotime($dtae_insurance2) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_insurance2 == null){
                            $string_json = str_replace("ประกัน2",$edit,$string_json);
                        }
                        if ($insurance2 <= 30 && $insurance2 >= 1) {
                            $string_json = str_replace("ประกัน2",$warning,$string_json);
                        }
                        if ($insurance2 <= 0){
                            $string_json = str_replace("ประกัน2",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("ประกัน2",$tick,$string_json);
                        }

                        // คันที่2
                        $string_json = str_replace("รูป-แบนด์2", strtolower($brand[1]),$string_json);
                        $string_json = str_replace("แบนด์2", strtoupper($brand[1]),$string_json);
                        $string_json = str_replace("รุ่น2",$generation[1],$string_json);
                        $string_json = str_replace("จังหวัด2",$province[1],$string_json);
                        $string_json = str_replace("ป้ายทะเบียน2",$registration_number[1],$string_json);
                        $string_json = str_replace("act2",$id[1],$string_json);

                        $string_json = str_replace("รถของฉัน",$data_topic[0],$string_json);
                        $string_json = str_replace("พรบ",$data_topic[1],$string_json);
                        $string_json = str_replace("ประกัน",$data_topic[2],$string_json);
                        $string_json = str_replace("ดูรถทั้งหมด",$data_topic[3],$string_json);


                        break;

                    default:
                        $template_path = storage_path('../public/json/flex-mycar-3.json');
                        $string_json = file_get_contents($template_path);

                        // คันที่1
                        $string_json = str_replace("รูป-แบนด์1", strtolower($brand[0]),$string_json);
                        $string_json = str_replace("แบนด์1", strtoupper($brand[0]),$string_json);
                        $string_json = str_replace("ป้ายทะเบียน1",$registration_number[0],$string_json);
                        $string_json = str_replace("รุ่น1",$generation[0],$string_json);
                        $string_json = str_replace("จังหวัด1",$province[0],$string_json);
                        $string_json = str_replace("act1",$id[0],$string_json);

                        // เวลาปัจจุบัน
                        $date_now = date("Y-m-d ");

                        // วันหมดอายุ พรบ คันที่ 1
                        $dtae_act = $act[0];
                        // วันหมดอายุ พรบ คันที่ 2
                        $dtae_act2 = $act[1];
                        // วันหมดอายุ พรบ คันที่ 3
                        $dtae_act3 = $act[2];

                        // วันหมดอายุ ประกัน คันที่ 1
                        $dtae_insurance = $insurance[0];
                        // วันหมดอายุ ประกัน คันที่ 2
                        $dtae_insurance2 = $insurance[1];
                        // วันหมดอายุ ประกัน คันที่ 3
                        $dtae_insurance3 = $insurance[2];

                        // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 1
                        $act = (strtotime($dtae_act) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_act == null){
                            $string_json = str_replace("พรบ1",$edit,$string_json);
                        }
                        if ($act <= 30 && $act >= 1) {
                            $string_json = str_replace("พรบ1",$warning,$string_json);
                        }
                        if ($act <= 0){
                            $string_json = str_replace("พรบ1",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("พรบ1",$tick,$string_json);
                        }

                        $insurance = (strtotime($dtae_insurance) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_insurance == null){
                            $string_json = str_replace("ประกัน1",$edit,$string_json);
                        }
                        if ($insurance <= 30 && $insurance >= 1) {
                            $string_json = str_replace("ประกัน1",$warning,$string_json);
                        }
                        if ($insurance <= 0){
                            $string_json = str_replace("ประกัน1",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("ประกัน1",$tick,$string_json);
                        }

                        // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 2
                        $act2 = (strtotime($dtae_act2) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_act2 == null){
                            $string_json = str_replace("พรบ2",$edit,$string_json);
                        }
                        if ($act2 <= 30 && $act2 >= 1) {
                            $string_json = str_replace("พรบ2",$warning,$string_json);
                        }
                        if ($act2 <= 0){
                            $string_json = str_replace("พรบ2",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("พรบ2",$tick,$string_json);
                        }

                        $insurance2 = (strtotime($dtae_insurance2) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_insurance2 == null){
                            $string_json = str_replace("ประกัน2",$edit,$string_json);
                        }
                        if ($insurance2 <= 30 && $insurance2 >= 1) {
                            $string_json = str_replace("ประกัน2",$warning,$string_json);
                        }
                        if ($insurance2 <= 0){
                            $string_json = str_replace("ประกัน2",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("ประกัน2",$tick,$string_json);
                        }

                        // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 3
                        $act3 = (strtotime($dtae_act3) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_act3 == null){
                            $string_json = str_replace("พรบ3",$edit,$string_json);
                        }
                        if ($act3 <= 30 && $act3 >= 1) {
                            $string_json = str_replace("พรบ3",$warning,$string_json);
                        }
                        if ($act3 <= 0){
                            $string_json = str_replace("พรบ3",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("พรบ3",$tick,$string_json);
                        }

                        $insurance3 = (strtotime($dtae_insurance3) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_insurance3 == null){
                            $string_json = str_replace("ประกัน3",$edit,$string_json);
                        }
                        if ($insurance3 <= 30 && $insurance3 >= 1) {
                            $string_json = str_replace("ประกัน3",$warning,$string_json);
                        }
                        if ($insurance3 <= 0){
                            $string_json = str_replace("ประกัน3",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("ประกัน3",$tick,$string_json);
                        }

                        // คันที่2
                        $string_json = str_replace("รูป-แบนด์2", strtolower($brand[1]),$string_json);
                        $string_json = str_replace("แบนด์2", strtoupper($brand[1]),$string_json);
                        $string_json = str_replace("รุ่น2",$generation[1],$string_json);
                        $string_json = str_replace("จังหวัด2",$province[1],$string_json);
                        $string_json = str_replace("ป้ายทะเบียน2",$registration_number[1],$string_json);
                        $string_json = str_replace("act2",$id[1],$string_json);

                        // คันที่3
                        $string_json = str_replace("รูป-แบนด์3", strtolower($brand[2]),$string_json);
                        $string_json = str_replace("แบนด์3", strtoupper($brand[2]),$string_json);
                        $string_json = str_replace("รุ่น3",$generation[2],$string_json);
                        $string_json = str_replace("จังหวัด3",$province[2],$string_json);
                        $string_json = str_replace("ป้ายทะเบียน3",$registration_number[2],$string_json);
                        $string_json = str_replace("act3",$id[2],$string_json);

                        $string_json = str_replace("รถของฉัน",$data_topic[0],$string_json);
                        $string_json = str_replace("พรบ",$data_topic[1],$string_json);
                        $string_json = str_replace("ประกัน",$data_topic[2],$string_json);
                        $string_json = str_replace("ดูรถทั้งหมด",$data_topic[3],$string_json);

                        break;

                }
                // ข้อความสุดท้ายที่จะส่ง
                $messages = [ json_decode($string_json, true) ];
                break;

            case "mymotorcycles":

                $data_Text_topic = [
                    "รถของฉัน",
                    "พรบ",
                    "ประกัน",
                    "ดูรถทั้งหมด",
                ];

                $data_topic = $this->language_for_user($data_Text_topic, $event["source"]['userId']);

                $provider_id = $event["source"]['userId'];

                $car_row = DB::select("SELECT * FROM register_cars WHERE provider_id = '$provider_id' AND active = 'Yes' AND car_type = 'motorcycle' ");

                $randomCar = DB::table('register_cars')
                    ->where('provider_id' , $provider_id)
                    ->where('car_type' , "motorcycle")
                    ->where('active' , "Yes")
                    ->limit(3)
                    ->get();

                for ($i=0; $i < count($randomCar);) {
                    foreach($randomCar as $item ){
                        $id[$i] = $item->id;
                        $brand[$i] = $item->brand;
                        $registration_number[$i] = $item->registration_number;
                        $act[$i] = $item->act;
                        $insurance[$i] = $item->insurance;
                        $generation[$i] =  $item->generation;
                        $province[$i] =  $item->province;

                        $i++;
                    }
                }

                $edit = 49;
                $warning = 50;
                $wrong = 17;
                $tick = 18;

                switch(count($car_row))
                {
                    case "1":
                        $template_path = storage_path('../public/json/flex-mycar-1.json');
                        $string_json = file_get_contents($template_path);

                        $string_json = str_replace("รูป-แบนด์1", strtolower($brand[0]),$string_json);
                        $string_json = str_replace("แบนด์1", strtoupper($brand[0]),$string_json);
                        $string_json = str_replace("ป้ายทะเบียน1",$registration_number[0],$string_json);
                        $string_json = str_replace("รุ่น1",$generation[0],$string_json);
                        $string_json = str_replace("จังหวัด1",$province[0],$string_json);

                        $string_json = str_replace("act1",$id[0],$string_json);
                        // พรบ
                        // เวลาปัจจุบัน
                        $date_now = date("Y-m-d ");
                        // วันหมดอายุ พรบ
                        $dtae_act = $act[0];
                        // วันหมดอายุ ประกัน
                        $dtae_insurance = $insurance[0];
                        // ตัวแปรสำหรับเช็คการแจ้งเตือน
                        $act = (strtotime($dtae_act) - strtotime($date_now))/  ( 60 * 60 * 24 );



                        // ไม่ได้ใส่
                        if ($dtae_act == null){
                            $string_json = str_replace("พรบ1",$edit,$string_json);
                        }
                        // ใกล้หมด
                        if ($act <= 30 && $act >= 1) {
                            $string_json = str_replace("พรบ1",$warning,$string_json);
                        }
                        // หมด
                        if ($act <= 0){
                            $string_json = str_replace("พรบ1",$wrong,$string_json);
                        }
                        // ปรกติ
                        else{
                            $string_json = str_replace("พรบ1",$tick,$string_json);
                        }

                        $insurance = (strtotime($dtae_insurance) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_insurance == null){
                            $string_json = str_replace("ประกัน1",$edit,$string_json);
                        }
                        if ($insurance <= 30 && $insurance >= 1) {
                            $string_json = str_replace("ประกัน1",$warning,$string_json);
                        }
                        if ($insurance <= 0){
                            $string_json = str_replace("ประกัน1",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("ประกัน1",$tick,$string_json);
                        }

                        $string_json = str_replace("รถของฉัน",$data_topic[0],$string_json);
                        $string_json = str_replace("พรบ",$data_topic[1],$string_json);
                        $string_json = str_replace("ประกัน",$data_topic[2],$string_json);
                        $string_json = str_replace("ดูรถทั้งหมด",$data_topic[3],$string_json);

                        break;

                    case "2":
                        $template_path = storage_path('../public/json/flex-mycar-2.json');
                        $string_json = file_get_contents($template_path);

                        // คันที่1
                        $string_json = str_replace("รูป-แบนด์1", strtolower($brand[0]),$string_json);
                        $string_json = str_replace("แบนด์1", strtoupper($brand[0]),$string_json);
                        $string_json = str_replace("รุ่น1",$generation[0],$string_json);
                        $string_json = str_replace("จังหวัด1",$province[0],$string_json);
                        $string_json = str_replace("ป้ายทะเบียน1",$registration_number[0],$string_json);
                        $string_json = str_replace("act1",$id[0],$string_json);

                        // พรบ
                        // เวลาปัจจุบัน
                        $date_now = date("Y-m-d ");
                        // วันหมดอายุ พรบ คันที่ 1
                        $dtae_act = $act[0];
                        // วันหมดอายุ พรบ คันที่ 2
                        $dtae_act2 = $act[1];
                        // วันหมดอายุ ประกัน คันที่ 1
                        $dtae_insurance = $insurance[0];
                        // วันหมดอายุ ประกัน คันที่ 2
                        $dtae_insurance2 = $insurance[1];

                        // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 1
                        $act = (strtotime($dtae_act) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_act == null){
                            $string_json = str_replace("พรบ1",$edit,$string_json);
                        }
                        if ($act <= 30 && $act >= 1) {
                            $string_json = str_replace("พรบ1",$warning,$string_json);
                        }
                        if ($act <= 0){
                            $string_json = str_replace("พรบ1",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("พรบ1",$tick,$string_json);
                        }

                        $insurance = (strtotime($dtae_insurance) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_insurance == null){
                            $string_json = str_replace("ประกัน1",$edit,$string_json);
                        }
                        if ($insurance <= 30 && $insurance >= 1) {
                            $string_json = str_replace("ประกัน1",$warning,$string_json);
                        }
                        if ($insurance <= 0){
                            $string_json = str_replace("ประกัน1",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("ประกัน1",$tick,$string_json);
                        }

                        // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 2
                        $act2 = (strtotime($dtae_act2) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_act2 == null){
                            $string_json = str_replace("พรบ2",$edit,$string_json);
                        }
                        if ($act2 <= 30 && $act2 >= 1) {
                            $string_json = str_replace("พรบ2",$warning,$string_json);
                        }
                        if ($act2 <= 0){
                            $string_json = str_replace("พรบ2",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("พรบ2",$tick,$string_json);
                        }

                        $insurance2 = (strtotime($dtae_insurance2) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_insurance2 == null){
                            $string_json = str_replace("ประกัน2",$edit,$string_json);
                        }
                        if ($insurance2 <= 30 && $insurance2 >= 1) {
                            $string_json = str_replace("ประกัน2",$warning,$string_json);
                        }
                        if ($insurance2 <= 0){
                            $string_json = str_replace("ประกัน2",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("ประกัน2",$tick,$string_json);
                        }

                        // คันที่2
                        $string_json = str_replace("รูป-แบนด์2", strtolower($brand[1]),$string_json);
                        $string_json = str_replace("แบนด์2", strtoupper($brand[1]),$string_json);
                        $string_json = str_replace("รุ่น2",$generation[1],$string_json);
                        $string_json = str_replace("จังหวัด2",$province[1],$string_json);
                        $string_json = str_replace("ป้ายทะเบียน2",$registration_number[1],$string_json);
                        $string_json = str_replace("act2",$id[1],$string_json);

                        $string_json = str_replace("รถของฉัน",$data_topic[0],$string_json);
                        $string_json = str_replace("พรบ",$data_topic[1],$string_json);
                        $string_json = str_replace("ประกัน",$data_topic[2],$string_json);
                        $string_json = str_replace("ดูรถทั้งหมด",$data_topic[3],$string_json);


                        break;

                    default:
                        $template_path = storage_path('../public/json/flex-mycar-3.json');
                        $string_json = file_get_contents($template_path);

                        // คันที่1
                        $string_json = str_replace("รูป-แบนด์1", strtolower($brand[0]),$string_json);
                        $string_json = str_replace("แบนด์1", strtoupper($brand[0]),$string_json);
                        $string_json = str_replace("ป้ายทะเบียน1",$registration_number[0],$string_json);
                        $string_json = str_replace("รุ่น1",$generation[0],$string_json);
                        $string_json = str_replace("จังหวัด1",$province[0],$string_json);
                        $string_json = str_replace("act1",$id[0],$string_json);

                        // เวลาปัจจุบัน
                        $date_now = date("Y-m-d ");

                        // วันหมดอายุ พรบ คันที่ 1
                        $dtae_act = $act[0];
                        // วันหมดอายุ พรบ คันที่ 2
                        $dtae_act2 = $act[1];
                        // วันหมดอายุ พรบ คันที่ 3
                        $dtae_act3 = $act[2];

                        // วันหมดอายุ ประกัน คันที่ 1
                        $dtae_insurance = $insurance[0];
                        // วันหมดอายุ ประกัน คันที่ 2
                        $dtae_insurance2 = $insurance[1];
                        // วันหมดอายุ ประกัน คันที่ 3
                        $dtae_insurance3 = $insurance[2];

                        // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 1
                        $act = (strtotime($dtae_act) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_act == null){
                            $string_json = str_replace("พรบ1",$edit,$string_json);
                        }
                        if ($act <= 30 && $act >= 1) {
                            $string_json = str_replace("พรบ1",$warning,$string_json);
                        }
                        if ($act <= 0){
                            $string_json = str_replace("พรบ1",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("พรบ1",$tick,$string_json);
                        }

                        $insurance = (strtotime($dtae_insurance) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_insurance == null){
                            $string_json = str_replace("ประกัน1",$edit,$string_json);
                        }
                        if ($insurance <= 30 && $insurance >= 1) {
                            $string_json = str_replace("ประกัน1",$warning,$string_json);
                        }
                        if ($insurance <= 0){
                            $string_json = str_replace("ประกัน1",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("ประกัน1",$tick,$string_json);
                        }

                        // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 2
                        $act2 = (strtotime($dtae_act2) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_act2 == null){
                            $string_json = str_replace("พรบ2",$edit,$string_json);
                        }
                        if ($act2 <= 30 && $act2 >= 1) {
                            $string_json = str_replace("พรบ2",$warning,$string_json);
                        }
                        if ($act2 <= 0){
                            $string_json = str_replace("พรบ2",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("พรบ2",$tick,$string_json);
                        }

                        $insurance2 = (strtotime($dtae_insurance2) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_insurance2 == null){
                            $string_json = str_replace("ประกัน2",$edit,$string_json);
                        }
                        if ($insurance2 <= 30 && $insurance2 >= 1) {
                            $string_json = str_replace("ประกัน2",$warning,$string_json);
                        }
                        if ($insurance2 <= 0){
                            $string_json = str_replace("ประกัน2",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("ประกัน2",$tick,$string_json);
                        }

                        // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 3
                        $act3 = (strtotime($dtae_act3) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_act3 == null){
                            $string_json = str_replace("พรบ3",$edit,$string_json);
                        }
                        if ($act3 <= 30 && $act3 >= 1) {
                            $string_json = str_replace("พรบ3",$warning,$string_json);
                        }
                        if ($act3 <= 0){
                            $string_json = str_replace("พรบ3",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("พรบ3",$tick,$string_json);
                        }

                        $insurance3 = (strtotime($dtae_insurance3) - strtotime($date_now))/  ( 60 * 60 * 24 );

                        if ($dtae_insurance3 == null){
                            $string_json = str_replace("ประกัน3",$edit,$string_json);
                        }
                        if ($insurance3 <= 30 && $insurance3 >= 1) {
                            $string_json = str_replace("ประกัน3",$warning,$string_json);
                        }
                        if ($insurance3 <= 0){
                            $string_json = str_replace("ประกัน3",$wrong,$string_json);
                        }else{
                            $string_json = str_replace("ประกัน3",$tick,$string_json);
                        }

                        // คันที่2
                        $string_json = str_replace("รูป-แบนด์2", strtolower($brand[1]),$string_json);
                        $string_json = str_replace("แบนด์2", strtoupper($brand[1]),$string_json);
                        $string_json = str_replace("รุ่น2",$generation[1],$string_json);
                        $string_json = str_replace("จังหวัด2",$province[1],$string_json);
                        $string_json = str_replace("ป้ายทะเบียน2",$registration_number[1],$string_json);
                        $string_json = str_replace("act2",$id[1],$string_json);

                        // คันที่3
                        $string_json = str_replace("รูป-แบนด์3", strtolower($brand[2]),$string_json);
                        $string_json = str_replace("แบนด์3", strtoupper($brand[2]),$string_json);
                        $string_json = str_replace("รุ่น3",$generation[2],$string_json);
                        $string_json = str_replace("จังหวัด3",$province[2],$string_json);
                        $string_json = str_replace("ป้ายทะเบียน3",$registration_number[2],$string_json);
                        $string_json = str_replace("act3",$id[2],$string_json);

                        $string_json = str_replace("รถของฉัน",$data_topic[0],$string_json);
                        $string_json = str_replace("พรบ",$data_topic[1],$string_json);
                        $string_json = str_replace("ประกัน",$data_topic[2],$string_json);
                        $string_json = str_replace("ดูรถทั้งหมด",$data_topic[3],$string_json);

                        break;

                }

                // ข้อความสุดท้ายที่จะส่ง
                $messages = [ json_decode($string_json, true) ];
                break;

                case "mycarother":

                    $data_Text_topic = [
                        "รถของฉัน",
                        "พรบ",
                        "ประกัน",
                        "ดูรถทั้งหมด",
                    ];

                    $data_topic = $this->language_for_user($data_Text_topic, $event["source"]['userId']);

                    $provider_id = $event["source"]['userId'];

                    $car_row = DB::select("SELECT * FROM register_cars WHERE provider_id = '$provider_id' AND active = 'Yes' AND car_type = 'other' ");

                    $randomCar = DB::table('register_cars')
                        ->where('provider_id' , $provider_id)
                        ->where('car_type' , "other")
                        ->where('active' , "Yes")
                        ->limit(3)
                        ->get();

                    for ($i=0; $i < count($randomCar);) {
                        foreach($randomCar as $item ){
                            $id[$i] = $item->id;
                            $brand[$i] = $item->brand;
                            $registration_number[$i] = $item->registration_number;
                            $act[$i] = $item->act;
                            $insurance[$i] = $item->insurance;
                            $generation[$i] =  $item->generation;
                            $province[$i] =  $item->province;

                            $i++;
                        }
                    }

                    $edit = 49;
                    $warning = 50;
                    $wrong = 17;
                    $tick = 18;

                    switch(count($car_row))
                    {
                        case "1":
                            $template_path = storage_path('../public/json/flex-mycar-1.json');
                            $string_json = file_get_contents($template_path);

                            $string_json = str_replace("รูป-แบนด์1", "",$string_json);
                            $string_json = str_replace("แบนด์1", strtoupper($brand[0]),$string_json);
                            $string_json = str_replace("ป้ายทะเบียน1",$registration_number[0],$string_json);
                            $string_json = str_replace("รุ่น1",$generation[0],$string_json);
                            $string_json = str_replace("จังหวัด1",$province[0],$string_json);

                            $string_json = str_replace("act1",$id[0],$string_json);
                            // พรบ
                            // เวลาปัจจุบัน
                            $date_now = date("Y-m-d ");
                            // วันหมดอายุ พรบ
                            $dtae_act = $act[0];
                            // วันหมดอายุ ประกัน
                            $dtae_insurance = $insurance[0];
                            // ตัวแปรสำหรับเช็คการแจ้งเตือน
                            $act = (strtotime($dtae_act) - strtotime($date_now))/  ( 60 * 60 * 24 );



                            // ไม่ได้ใส่
                            if ($dtae_act == null){
                                $string_json = str_replace("พรบ1",$edit,$string_json);
                            }
                            // ใกล้หมด
                            if ($act <= 30 && $act >= 1) {
                                $string_json = str_replace("พรบ1",$warning,$string_json);
                            }
                            // หมด
                            if ($act <= 0){
                                $string_json = str_replace("พรบ1",$wrong,$string_json);
                            }
                            // ปรกติ
                            else{
                                $string_json = str_replace("พรบ1",$tick,$string_json);
                            }

                            $insurance = (strtotime($dtae_insurance) - strtotime($date_now))/  ( 60 * 60 * 24 );

                            if ($dtae_insurance == null){
                                $string_json = str_replace("ประกัน1",$edit,$string_json);
                            }
                            if ($insurance <= 30 && $insurance >= 1) {
                                $string_json = str_replace("ประกัน1",$warning,$string_json);
                            }
                            if ($insurance <= 0){
                                $string_json = str_replace("ประกัน1",$wrong,$string_json);
                            }else{
                                $string_json = str_replace("ประกัน1",$tick,$string_json);
                            }

                            $string_json = str_replace("รถของฉัน",$data_topic[0],$string_json);
                            $string_json = str_replace("พรบ",$data_topic[1],$string_json);
                            $string_json = str_replace("ประกัน",$data_topic[2],$string_json);
                            $string_json = str_replace("ดูรถทั้งหมด",$data_topic[3],$string_json);

                            break;

                        case "2":
                            $template_path = storage_path('../public/json/flex-mycar-2.json');
                            $string_json = file_get_contents($template_path);

                            // คันที่1
                            $string_json = str_replace("รูป-แบนด์1", "",$string_json);
                            $string_json = str_replace("แบนด์1", strtoupper($brand[0]),$string_json);
                            $string_json = str_replace("รุ่น1",$generation[0],$string_json);
                            $string_json = str_replace("จังหวัด1",$province[0],$string_json);
                            $string_json = str_replace("ป้ายทะเบียน1",$registration_number[0],$string_json);
                            $string_json = str_replace("act1",$id[0],$string_json);

                            // พรบ
                            // เวลาปัจจุบัน
                            $date_now = date("Y-m-d ");
                            // วันหมดอายุ พรบ คันที่ 1
                            $dtae_act = $act[0];
                            // วันหมดอายุ พรบ คันที่ 2
                            $dtae_act2 = $act[1];
                            // วันหมดอายุ ประกัน คันที่ 1
                            $dtae_insurance = $insurance[0];
                            // วันหมดอายุ ประกัน คันที่ 2
                            $dtae_insurance2 = $insurance[1];

                            // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 1
                            $act = (strtotime($dtae_act) - strtotime($date_now))/  ( 60 * 60 * 24 );

                            if ($dtae_act == null){
                                $string_json = str_replace("พรบ1",$edit,$string_json);
                            }
                            if ($act <= 30 && $act >= 1) {
                                $string_json = str_replace("พรบ1",$warning,$string_json);
                            }
                            if ($act <= 0){
                                $string_json = str_replace("พรบ1",$wrong,$string_json);
                            }else{
                                $string_json = str_replace("พรบ1",$tick,$string_json);
                            }

                            $insurance = (strtotime($dtae_insurance) - strtotime($date_now))/  ( 60 * 60 * 24 );

                            if ($dtae_insurance == null){
                                $string_json = str_replace("ประกัน1",$edit,$string_json);
                            }
                            if ($insurance <= 30 && $insurance >= 1) {
                                $string_json = str_replace("ประกัน1",$warning,$string_json);
                            }
                            if ($insurance <= 0){
                                $string_json = str_replace("ประกัน1",$wrong,$string_json);
                            }else{
                                $string_json = str_replace("ประกัน1",$tick,$string_json);
                            }

                            // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 2
                            $act2 = (strtotime($dtae_act2) - strtotime($date_now))/  ( 60 * 60 * 24 );

                            if ($dtae_act2 == null){
                                $string_json = str_replace("พรบ2",$edit,$string_json);
                            }
                            if ($act2 <= 30 && $act2 >= 1) {
                                $string_json = str_replace("พรบ2",$warning,$string_json);
                            }
                            if ($act2 <= 0){
                                $string_json = str_replace("พรบ2",$wrong,$string_json);
                            }else{
                                $string_json = str_replace("พรบ2",$tick,$string_json);
                            }

                            $insurance2 = (strtotime($dtae_insurance2) - strtotime($date_now))/  ( 60 * 60 * 24 );

                            if ($dtae_insurance2 == null){
                                $string_json = str_replace("ประกัน2",$edit,$string_json);
                            }
                            if ($insurance2 <= 30 && $insurance2 >= 1) {
                                $string_json = str_replace("ประกัน2",$warning,$string_json);
                            }
                            if ($insurance2 <= 0){
                                $string_json = str_replace("ประกัน2",$wrong,$string_json);
                            }else{
                                $string_json = str_replace("ประกัน2",$tick,$string_json);
                            }

                            // คันที่2
                            $string_json = str_replace("รูป-แบนด์2", "",$string_json);
                            $string_json = str_replace("แบนด์2", strtoupper($brand[1]),$string_json);
                            $string_json = str_replace("รุ่น2",$generation[1],$string_json);
                            $string_json = str_replace("จังหวัด2",$province[1],$string_json);
                            $string_json = str_replace("ป้ายทะเบียน2",$registration_number[1],$string_json);
                            $string_json = str_replace("act2",$id[1],$string_json);

                            $string_json = str_replace("รถของฉัน",$data_topic[0],$string_json);
                            $string_json = str_replace("พรบ",$data_topic[1],$string_json);
                            $string_json = str_replace("ประกัน",$data_topic[2],$string_json);
                            $string_json = str_replace("ดูรถทั้งหมด",$data_topic[3],$string_json);


                            break;

                        default:
                            $template_path = storage_path('../public/json/flex-mycar-3.json');
                            $string_json = file_get_contents($template_path);

                            // คันที่1
                            $string_json = str_replace("รูป-แบนด์1", "",$string_json);
                            $string_json = str_replace("แบนด์1", strtoupper($brand[0]),$string_json);
                            $string_json = str_replace("ป้ายทะเบียน1",$registration_number[0],$string_json);
                            $string_json = str_replace("รุ่น1",$generation[0],$string_json);
                            $string_json = str_replace("จังหวัด1",$province[0],$string_json);
                            $string_json = str_replace("act1",$id[0],$string_json);

                            // เวลาปัจจุบัน
                            $date_now = date("Y-m-d ");

                            // วันหมดอายุ พรบ คันที่ 1
                            $dtae_act = $act[0];
                            // วันหมดอายุ พรบ คันที่ 2
                            $dtae_act2 = $act[1];
                            // วันหมดอายุ พรบ คันที่ 3
                            $dtae_act3 = $act[2];

                            // วันหมดอายุ ประกัน คันที่ 1
                            $dtae_insurance = $insurance[0];
                            // วันหมดอายุ ประกัน คันที่ 2
                            $dtae_insurance2 = $insurance[1];
                            // วันหมดอายุ ประกัน คันที่ 3
                            $dtae_insurance3 = $insurance[2];

                            // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 1
                            $act = (strtotime($dtae_act) - strtotime($date_now))/  ( 60 * 60 * 24 );

                            if ($dtae_act == null){
                                $string_json = str_replace("พรบ1",$edit,$string_json);
                            }
                            if ($act <= 30 && $act >= 1) {
                                $string_json = str_replace("พรบ1",$warning,$string_json);
                            }
                            if ($act <= 0){
                                $string_json = str_replace("พรบ1",$wrong,$string_json);
                            }else{
                                $string_json = str_replace("พรบ1",$tick,$string_json);
                            }

                            $insurance = (strtotime($dtae_insurance) - strtotime($date_now))/  ( 60 * 60 * 24 );

                            if ($dtae_insurance == null){
                                $string_json = str_replace("ประกัน1",$edit,$string_json);
                            }
                            if ($insurance <= 30 && $insurance >= 1) {
                                $string_json = str_replace("ประกัน1",$warning,$string_json);
                            }
                            if ($insurance <= 0){
                                $string_json = str_replace("ประกัน1",$wrong,$string_json);
                            }else{
                                $string_json = str_replace("ประกัน1",$tick,$string_json);
                            }

                            // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 2
                            $act2 = (strtotime($dtae_act2) - strtotime($date_now))/  ( 60 * 60 * 24 );

                            if ($dtae_act2 == null){
                                $string_json = str_replace("พรบ2",$edit,$string_json);
                            }
                            if ($act2 <= 30 && $act2 >= 1) {
                                $string_json = str_replace("พรบ2",$warning,$string_json);
                            }
                            if ($act2 <= 0){
                                $string_json = str_replace("พรบ2",$wrong,$string_json);
                            }else{
                                $string_json = str_replace("พรบ2",$tick,$string_json);
                            }

                            $insurance2 = (strtotime($dtae_insurance2) - strtotime($date_now))/  ( 60 * 60 * 24 );

                            if ($dtae_insurance2 == null){
                                $string_json = str_replace("ประกัน2",$edit,$string_json);
                            }
                            if ($insurance2 <= 30 && $insurance2 >= 1) {
                                $string_json = str_replace("ประกัน2",$warning,$string_json);
                            }
                            if ($insurance2 <= 0){
                                $string_json = str_replace("ประกัน2",$wrong,$string_json);
                            }else{
                                $string_json = str_replace("ประกัน2",$tick,$string_json);
                            }

                            // ตัวแปรสำหรับเช็คการแจ้งเตือน คันที่ 3
                            $act3 = (strtotime($dtae_act3) - strtotime($date_now))/  ( 60 * 60 * 24 );

                            if ($dtae_act3 == null){
                                $string_json = str_replace("พรบ3",$edit,$string_json);
                            }
                            if ($act3 <= 30 && $act3 >= 1) {
                                $string_json = str_replace("พรบ3",$warning,$string_json);
                            }
                            if ($act3 <= 0){
                                $string_json = str_replace("พรบ3",$wrong,$string_json);
                            }else{
                                $string_json = str_replace("พรบ3",$tick,$string_json);
                            }

                            $insurance3 = (strtotime($dtae_insurance3) - strtotime($date_now))/  ( 60 * 60 * 24 );

                            if ($dtae_insurance3 == null){
                                $string_json = str_replace("ประกัน3",$edit,$string_json);
                            }
                            if ($insurance3 <= 30 && $insurance3 >= 1) {
                                $string_json = str_replace("ประกัน3",$warning,$string_json);
                            }
                            if ($insurance3 <= 0){
                                $string_json = str_replace("ประกัน3",$wrong,$string_json);
                            }else{
                                $string_json = str_replace("ประกัน3",$tick,$string_json);
                            }

                            // คันที่2
                            $string_json = str_replace("รูป-แบนด์2", "",$string_json);
                            $string_json = str_replace("แบนด์2", strtoupper($brand[1]),$string_json);
                            $string_json = str_replace("รุ่น2",$generation[1],$string_json);
                            $string_json = str_replace("จังหวัด2",$province[1],$string_json);
                            $string_json = str_replace("ป้ายทะเบียน2",$registration_number[1],$string_json);
                            $string_json = str_replace("act2",$id[1],$string_json);

                            // คันที่3
                            $string_json = str_replace("รูป-แบนด์3", "",$string_json);
                            $string_json = str_replace("แบนด์3", strtoupper($brand[2]),$string_json);
                            $string_json = str_replace("รุ่น3",$generation[2],$string_json);
                            $string_json = str_replace("จังหวัด3",$province[2],$string_json);
                            $string_json = str_replace("ป้ายทะเบียน3",$registration_number[2],$string_json);
                            $string_json = str_replace("act3",$id[2],$string_json);

                            $string_json = str_replace("รถของฉัน",$data_topic[0],$string_json);
                            $string_json = str_replace("พรบ",$data_topic[1],$string_json);
                            $string_json = str_replace("ประกัน",$data_topic[2],$string_json);
                            $string_json = str_replace("ดูรถทั้งหมด",$data_topic[3],$string_json);

                            break;

                    }
                    // ข้อความสุดท้ายที่จะส่ง
                    $messages = [ json_decode($string_json, true) ];
                    break;

                case "driver_license":

                $provider_id = $event["source"]['userId'];

                $data_Text_topic = [
                    "ใบอนุญาตขับรถรถยนต์",
                    "ใบอนุญาตขับรถจักรยานยนต์",
                    "กรุณาเพิ่มใบอนุญาตขับรถ",
                ];

                $data_topic = $this->language_for_user($data_Text_topic, $provider_id);

                $user = DB::table('users')
                    ->where('provider_id' , $provider_id)
                    ->get();
                $template_path = storage_path('../public/json/flex-driver_license.json');



                $string_json = file_get_contents($template_path);

                $string_json = str_replace("ใบอนุญาตรถยนต์",$data_topic[0],$string_json);
                $string_json = str_replace("จักรยานยนต์",$data_topic[1],$string_json);
                $string_json = str_replace("กรุณาเพิ่มใบอนุญาตขับรถ",$data_topic[2],$string_json);

                foreach($user as $item){
                    if ( !empty($item->driver_license) && !empty($item->driver_license2) ) {
                        $string_json = str_replace("ccaarr",$item->driver_license,$string_json);
                        $string_json = str_replace("mmotorcycle",$item->driver_license2,$string_json);
                        $string_json = str_replace("zoom-in-1","zoom-in",$string_json);
                        $string_json = str_replace("zoom-in-2","zoom-in",$string_json);
                    }
                    if ( !empty($item->driver_license) && empty($item->driver_license2) ) {
                        $string_json = str_replace("ccaarr",$item->driver_license,$string_json);
                        $string_json = str_replace("storage/mmotorcycle","edit_profile?openExternalBrowser=1",$string_json);
                        $string_json = str_replace("zoom-in-1","zoom-in",$string_json);
                    }
                    if ( empty($item->driver_license) && !empty($item->driver_license2) ) {
                        $string_json = str_replace("storage/ccaarr","edit_profile?openExternalBrowser=1",$string_json);
                        $string_json = str_replace("mmotorcycle",$item->driver_license2,$string_json);
                        $string_json = str_replace("zoom-in-2","zoom-in",$string_json);
                    }
                    if ( empty($item->driver_license) && empty($item->driver_license2) ) {
                        $string_json = str_replace("storage/ccaarr","edit_profile?openExternalBrowser=1",$string_json);
                        $string_json = str_replace("storage/mmotorcycle","edit_profile?openExternalBrowser=1",$string_json);
                    }
                }


                $messages = [ json_decode($string_json, true) ];
                break;

            case "promotion":

                $data_Text_topic = [
                    "โปรโมชั่น",
                    "โปรโมชั่นรถยนต์",
                    "โปรโมชั่นรถจักรยานยนต์",
                ];

                $data_topic = $this->language_for_user($data_Text_topic, $event["source"]['userId']);

                $template_path = storage_path('../public/json/flex-promotion.json');
                $string_json = file_get_contents($template_path);

                $string_json = str_replace("โปรโมชั่นรถยนต์",$data_topic[1],$string_json);
                $string_json = str_replace("โปรโมชั่นรถจักรยานยนต์",$data_topic[2],$string_json);
                $string_json = str_replace("โปรโมชั่น",$data_topic[0],$string_json);


                $messages = [ json_decode($string_json, true) ];
                break;

            case "promotion_car":

                $data_Text_topic = [
                    "ดูโปรโมชั่นเพิ่มเติม",
                    "โปรโมชั่น",
                    "รายละเอียด",
                ];

                $data_topic = $this->language_for_user($data_Text_topic, $event["source"]['userId']);

                $template_path = storage_path('../public/json/flex-promotion_car.json');
                $string_json = file_get_contents($template_path);

                $string_json = str_replace("ดูโปรโมชั่นเพิ่มเติม",$data_topic[0],$string_json);
                $string_json = str_replace("โปรโมชั่น",$data_topic[1],$string_json);
                $string_json = str_replace("รายละเอียด",$data_topic[2],$string_json);

                $randomPromotion = DB::table('promotions')
                    ->where('type', "car")
                    ->inRandomOrder()
                    ->limit(6)
                    ->get();

                for ($i=1; $i < count($randomPromotion);) {
                    foreach($randomPromotion as $item ){
                        $company[$i] = $item->company;
                        $titel[$i] = $item->titel;
                        $time_period[$i] = $item->time_period;
                        $link[$i] = $item->link;
                        $photo[$i] = $item->photo;

                        $i++;
                    }
                }


                $string_json = str_replace("https://www.viicheck.com/img1",$photo[1],$string_json);
                $string_json = str_replace("https://www.viicheck.com/link1",$link[1],$string_json);

                $string_json = str_replace("https://www.viicheck.com/img2",$photo[2],$string_json);
                $string_json = str_replace("https://www.viicheck.com/link2",$link[2],$string_json);

                $string_json = str_replace("https://www.viicheck.com/img3",$photo[3],$string_json);
                $string_json = str_replace("https://www.viicheck.com/link3",$link[3],$string_json);

                $string_json = str_replace("https://www.viicheck.com/img4",$photo[4],$string_json);
                $string_json = str_replace("https://www.viicheck.com/link4",$link[4],$string_json);

                $string_json = str_replace("https://www.viicheck.com/img5",$photo[5],$string_json);
                $string_json = str_replace("https://www.viicheck.com/link5",$link[5],$string_json);

                $string_json = str_replace("https://www.viicheck.com/img6",$photo[6],$string_json);
                $string_json = str_replace("https://www.viicheck.com/link6",$link[6],$string_json);

                $string_json = str_replace("carpromotion","car",$string_json);

                $messages = [ json_decode($string_json, true) ];
                break;

            case "promotion_motorcycle":

                $data_Text_topic = [
                    "ดูโปรโมชั่นเพิ่มเติม",
                    "โปรโมชั่น",
                    "รายละเอียด",
                ];

                $data_topic = $this->language_for_user($data_Text_topic, $event["source"]['userId']);

                $template_path = storage_path('../public/json/flex-promotion_car.json');
                $string_json = file_get_contents($template_path);

                $randomPromotion = DB::table('promotions')
                    ->where('type', "motorcycle")
                    ->inRandomOrder()
                    ->limit(6)
                    ->get();

                for ($i=1; $i < count($randomPromotion);) {
                    foreach($randomPromotion as $item ){
                        $company[$i] = $item->company;
                        $titel[$i] = $item->titel;
                        $time_period[$i] = $item->time_period;
                        $link[$i] = $item->link;
                        $photo[$i] = $item->photo;

                        $i++;
                    }
                }


                $string_json = str_replace("https://www.viicheck.com/img1",$photo[1],$string_json);
                $string_json = str_replace("https://www.viicheck.com/link1",$link[1],$string_json);

                $string_json = str_replace("https://www.viicheck.com/img2",$photo[2],$string_json);
                $string_json = str_replace("https://www.viicheck.com/link2",$link[2],$string_json);

                $string_json = str_replace("https://www.viicheck.com/img3",$photo[3],$string_json);
                $string_json = str_replace("https://www.viicheck.com/link3",$link[3],$string_json);

                $string_json = str_replace("https://www.viicheck.com/img4",$photo[4],$string_json);
                $string_json = str_replace("https://www.viicheck.com/link4",$link[4],$string_json);

                $string_json = str_replace("https://www.viicheck.com/img5",$photo[5],$string_json);
                $string_json = str_replace("https://www.viicheck.com/link5",$link[5],$string_json);

                $string_json = str_replace("https://www.viicheck.com/img6",$photo[6],$string_json);
                $string_json = str_replace("https://www.viicheck.com/link6",$link[6],$string_json);

                $string_json = str_replace("carpromotion","motorcycle",$string_json);

                $string_json = str_replace("ดูโปรโมชั่นเพิ่มเติม",$data_topic[0],$string_json);
                $string_json = str_replace("โปรโมชั่น",$data_topic[1],$string_json);
                $string_json = str_replace("รายละเอียด",$data_topic[2],$string_json);

                $messages = [ json_decode($string_json, true) ];
                break;
        }

        $body = [
            "replyToken" => $event["replyToken"],
            "messages" => $messages,
        ];

        $opts = [
            'http' =>[
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];

        $context  = stream_context_create($opts);
        //https://api-data.line.me/v2/bot/message/11914912908139/content
        $url = "https://api.line.me/v2/bot/message/reply";
        $result = file_get_contents($url, false, $context);

        //SAVE LOG
        $data = [
            "title" => "reply Success",
            "content" => "reply Success",
        ];
        MyLog::create($data);

        return $result;

    }

    public function _pushguestLine($data, $event, $postback_data)
    {
        // เวลาปัจจุบัน
        $datetime =  date("d-m-Y  h:i:sa");

        $data_postback_explode = explode("?",$event["postback"]["data"]);
        $license_plate = explode("/",$data_postback_explode[1]);  ;
        $registration_number = $license_plate[0];
        $province = $license_plate[1];

        $data_cars = DB::table('register_cars')
            ->where('registration_number', $registration_number)
            ->where('province', $province)
            ->first();

        $car_type = $data_cars->car_type ;

        $google_registration_number = $license_plate[0] ;
        $google_province = $license_plate[1] ;

    	// UserId เจ้าของรถ
    	$provider_id = $event["source"]['userId'];

    	// UserId คนเรียก
    	$reply = DB::table('register_cars')
	            ->select('reply_provider_id','registration_number','province')
                ->where([
                        ['registration_number', $registration_number],
                        ['province', $province],
                        ['now', "Yes"],
                    ])
	            ->get();

        // type login
        foreach($reply as $item){

            $type_login = DB::table('users')
                        ->select('type' , 'email' , 'name', 'time_zone')
                        ->where('provider_id', $item->reply_provider_id)
                        ->get();

            $to_user = $item->reply_provider_id;
        }

        $data_Text_topic = [
            "โปรดรอสักครู่",
            "ขอบคุณค่ะ",
            "เวลาที่ตอบกลับ",
            "หมายเลขทะเบียน",
        ];

        $data_topic = $this->language_for_user($data_Text_topic, $to_user);

        foreach($type_login as $item){

            // TIME ZONE LINE
            $API_Time_zone = new API_Time_zone();
            $time_zone = $API_Time_zone->change_Time_zone($item->time_zone);

            // datetime
            $time_zone_explode = explode(" ",$time_zone);

            $date = $time_zone_explode[0] ;
            $time = $time_zone_explode[1] ;
            $utc = $time_zone_explode[3] ;

            switch ($item->type) {
                case 'line':

                    switch($car_type)
                    {
                        case "car":
                            $template_path = storage_path('../public/json/viimove/reply/flex_reply_message_car.json');
                            $string_json = file_get_contents($template_path);
                            break;
                        case "motorcycle":
                            $template_path = storage_path('../public/json/viimove/reply/flex_reply_message_motorcycle.json');
                            $string_json = file_get_contents($template_path);

                            $reg = $registration_number ;
                            $reg_text = preg_replace('/[0-9]+/', '', $reg);
                            $reg_num = preg_replace('/[^A-Za-z0-9\-]/', ' ', $reg);
                            $reg_num_sp = explode(" ", $reg_num);
                            $last_list_num = count($reg_num_sp) - 1 ;

                            $reg_1 = $reg_num_sp[0] . $reg_text ;
                            $reg_2 = $reg_num_sp[$last_list_num] ;

                            $string_json = str_replace("TEXT_REG_MOR_1",$reg_1,$string_json);
                            $string_json = str_replace("TEXT_REG_MOR_2",$reg_2,$string_json);
                            break;
                        default:
                            $template_path = storage_path('../public/json/viimove/reply/flex_reply_message_car.json');
                            $string_json = file_get_contents($template_path);
                            break;
                    }

                    switch($postback_data){
                        case "wait":
                            $string_json = str_replace("ขอบคุณ",$data_topic[0],$string_json);
                            $string_json = str_replace("สติกเกอร์ไลน์","2",$string_json);
                            break;
                        case "thx":
                            $string_json = str_replace("ขอบคุณ",$data_topic[1],$string_json);
                            $string_json = str_replace("สติกเกอร์ไลน์","3",$string_json);
                            break;
                    }

                    $string_json = str_replace("ตัวอย่าง","ผู้ใช้แจ้งว่า..",$string_json);
                    $string_json = str_replace("TEXT_REG_NUM",$registration_number,$string_json);
                    $string_json = str_replace("TEXT_REG_PRO",$province,$string_json);

                    $string_json = str_replace("date",$date,$string_json);
                    $string_json = str_replace("time",$time,$string_json);
                    $string_json = str_replace("UTC", "UTC " . $utc,$string_json);

                    $string_json = str_replace("เวลาที่ตอบกลับ",$data_topic[2],$string_json);
                    $string_json = str_replace("หมายเลขทะเบียน",$data_topic[3],$string_json);

                    $messages = [ json_decode($string_json, true) ];

                    $body = [
                        "to" => $to_user,
                        "messages" => $messages,
                    ];

                    $opts = [
                        'http' =>[
                            'method'  => 'POST',
                            'header'  => "Content-Type: application/json \r\n".
                                        'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                            'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                            //'timeout' => 60
                        ]
                    ];

                    $context  = stream_context_create($opts);
                    $url = "https://api.line.me/v2/bot/message/push";
                    $result = file_get_contents($url, false, $context);

                    //SAVE LOG
                    $data = [
                        "title" => "https://api.line.me/v2/bot/message/push",
                        "content" => json_encode($result, JSON_UNESCAPED_UNICODE),
                    ];

                    DB::table('register_cars')
                            ->where([
                                    ['registration_number', $google_registration_number],
                                    ['province', $google_province],
                                    ['now', "Yes"]
                                ])
                            ->update(['now' => null]);

                    MyLog::create($data);
                    return $result;
                    break;

                case 'google':

                    $google_data = [
                        "name" => $item->name,
                        "registration_number" => $google_registration_number,
                        "province" => $google_province,
                        "postback_data" => $postback_data,
                        "datetime" => $time_zone,
                    ];

                    switch($postback_data)
                    {
                        case "wait":
                            $email = $item->email ;
                            Mail::to($email)->send(new MailToGuest($google_data));
                            break;
                        case "thx":
                            $email = $item->email ;
                            Mail::to($email)->send(new MailToGuest($google_data));
                            break;

                    }
                    DB::table('register_cars')
                            ->where([
                                    ['registration_number', $google_registration_number],
                                    ['province', $google_province],
                                    ['now', "Yes"]
                                ])
                            ->update(['now' => null]);
                    break;

                case 'facebook':
                    switch($postback_data)
                    {
                        case "wait":
                            //
                            break;
                        case "thx":
                            //
                            break;

                    }
                    break;
            }
        }

    }

    public function alert_act()
    {
        $date_now = date("Y-m-d");
        $date_add = strtotime("+30 Day");
        $date_30 = date("Y-m-d" , $date_add);

        // พรบ
        $act = Register_car::where('act' , "<=" , $date_30)
                    ->where('provider_id', 'LIKE', "%U%")
                    ->whereNull('alert_act')
                    ->get();

        foreach ($act as $item) {

            $data_Text_topic = [
                    "พรบ. ของคุณใกล้หมดอายุ",
                    "พรบ",
                    "ของคุณเหลือน้อยกว่า",
                    "แก้ไขวันที่",
                    "วัน",
                    "จะหมดอายุวันที่",
                    "หมายเลขทะเบียน",
                    "ขออภัยหากท่านต่ออายุแล้ว",
                ];

            $data_topic = $this->language_for_user($data_Text_topic, $item->provider_id);

            $template_path = storage_path('../public/json/flex-act.json');
            $string_json = file_get_contents($template_path);
            $string_json = str_replace("ตัวอย่าง",$data_topic[0],$string_json);
            $string_json = str_replace("99ก9999",$item->registration_number,$string_json);
            $string_json = str_replace("กรุงเทพมหานคร",$item->province,$string_json);
            $string_json = str_replace("00/00/0000",$item->act,$string_json);
            $string_json = str_replace("car_id",$item->id,$string_json);

            $string_json = str_replace("พรบ",$data_topic[1],$string_json);
            $string_json = str_replace("ของคุณเหลือน้อยกว่า",$data_topic[2],$string_json);
            $string_json = str_replace("แก้ไขวันที่",$data_topic[3],$string_json);
            $string_json = str_replace("วัน",$data_topic[4],$string_json);
            $string_json = str_replace("จะหมดอายุวันที่",$data_topic[5],$string_json);
            $string_json = str_replace("หมายเลขทะเบียน",$data_topic[6],$string_json);
            $string_json = str_replace("ขออภัยหากท่านต่ออายุแล้ว",$data_topic[7],$string_json);

            $messages = [ json_decode($string_json, true) ];

            $body = [
                "to" => $item->provider_id,
                "messages" => $messages,
            ];

            $opts = [
                'http' =>[
                    'method'  => 'POST',
                    'header'  => "Content-Type: application/json \r\n".
                                'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                    'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                    //'timeout' => 60
                ]
            ];

            $context  = stream_context_create($opts);
            $url = "https://api.line.me/v2/bot/message/push";
            $result = file_get_contents($url, false, $context);

            //SAVE LOG
            $data = [
                "title" => "https://api.line.me/v2/bot/message/push",
                "content" => json_encode($result, JSON_UNESCAPED_UNICODE),
            ];

            DB::table('register_cars')
                ->where('registration_number', $item->registration_number)
                ->where('province', $item->province)
                ->update(['alert_act' => $date_now]);

            MyLog::create($data);
        }
        // จบ พรบ

        // ประกัน
        $insurance = Register_car::where('insurance' , "<=" , $date_30)
                    ->where('provider_id', 'LIKE', "%U%")
                    ->where('alert_insurance' , "=" , null)
                    ->get();

        foreach ($insurance as $item) {

            $data_Text_topic = [
                    "ประกันภัย ของคุณใกล้หมดอายุ",
                    "ประกัน",
                    "ของคุณเหลือน้อยกว่า",
                    "แก้ไขวันที่",
                    "วัน",
                    "จะหมดอายุวันที่",
                    "หมายเลขทะเบียน",
                    "ขออภัยหากท่านต่ออายุแล้ว",
                ];

            $data_topic = $this->language_for_user($data_Text_topic, $item->provider_id);

            $template_path = storage_path('../public/json/flex-act.json');
            $string_json = file_get_contents($template_path);
            $string_json = str_replace("ตัวอย่าง",$data_topic[0],$string_json);
            $string_json = str_replace("99ก9999",$item->registration_number,$string_json);
            $string_json = str_replace("กรุงเทพมหานคร",$item->province,$string_json);
            $string_json = str_replace("00/00/0000",$item->insurance,$string_json);
            $string_json = str_replace("พรบ",$data_topic[1],$string_json);
            $string_json = str_replace("car_id",$item->id,$string_json);

            $string_json = str_replace("ของคุณเหลือน้อยกว่า",$data_topic[2],$string_json);
            $string_json = str_replace("แก้ไขวันที่",$data_topic[3],$string_json);
            $string_json = str_replace("วัน",$data_topic[4],$string_json);
            $string_json = str_replace("จะหมดอายุวันที่",$data_topic[5],$string_json);
            $string_json = str_replace("หมายเลขทะเบียน",$data_topic[6],$string_json);
            $string_json = str_replace("ขออภัยหากท่านต่ออายุแล้ว",$data_topic[7],$string_json);

            $messages = [ json_decode($string_json, true) ];

            $body = [
                "to" => $item->provider_id,
                "messages" => $messages,
            ];

            $opts = [
                'http' =>[
                    'method'  => 'POST',
                    'header'  => "Content-Type: application/json \r\n".
                                'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                    'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                    //'timeout' => 60
                ]
            ];

            $context  = stream_context_create($opts);
            $url = "https://api.line.me/v2/bot/message/push";
            $result = file_get_contents($url, false, $context);

            //SAVE LOG
            $data = [
                "title" => "https://api.line.me/v2/bot/message/push",
                "content" => json_encode($result, JSON_UNESCAPED_UNICODE),
            ];

            DB::table('register_cars')
                ->where('registration_number', $item->registration_number)
                ->where('province', $item->province)
                ->update(['alert_insurance' => $date_now]);

            MyLog::create($data);
        }
        // จบ ประกัน
    }

    public function send_HelloLinegroup($event,$save_name_group)
    {
        $template_path = storage_path('../public/json/hello_group_line.json');
        $string_json = file_get_contents($template_path);
        $string_json = str_replace("ตัวอย่าง","สวัสดีค่ะ",$string_json);
        $string_json = str_replace("GROUP",$save_name_group['groupName'],$string_json);

        $messages = [ json_decode($string_json, true) ];

        $body = [
            "replyToken" => $event["replyToken"],
            "messages" => $messages,
        ];

        $opts = [
            'http' =>[
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];

        $context  = stream_context_create($opts);
        //https://api-data.line.me/v2/bot/message/11914912908139/content
        $url = "https://api.line.me/v2/bot/message/reply";
        $result = file_get_contents($url, false, $context);

        //SAVE LOG
        $data = [
            "title" => "HELLO LINE GROUP",
            "content" => json_encode($result, JSON_UNESCAPED_UNICODE),
        ];

        MyLog::create($data);

    }

    public function language_for_user($data_topic, $to_user)
    {
        $data_users = DB::table('users')
                    ->where('provider_id', $to_user)
                    ->where('status', "active")
                    ->get();

        foreach ($data_users as $data_user) {
            if (!empty($data_user->language)) {
                    $user_language = $data_user->language ;
                    if ($user_language == "zh-TW") {
                        $user_language = "zh_TW";
                    }
                    if ($user_language == "zh-CN") {
                        $user_language = "zh_CN";
                    }
                }else{
                    $user_language = 'en' ;
                }
        }

        for ($i=0; $i < count($data_topic); $i++) {

            $text_topic = DB::table('text_topics')
                    ->select($user_language)
                    ->where('th', $data_topic[$i])
                    ->where('en', "!=", null)
                    ->get();

            foreach ($text_topic as $item_of_text_topic) {
                $data_topic[$i] = $item_of_text_topic->$user_language ;
            }
        }

        return $data_topic ;

    }

    public function new_flex_2024($data, $event, $message_type)
    {
        switch ($message_type) {
            case 'deme_sos_api':
                    $api_array_data = [
                        "informer" => "self",
                        "symptom" => "รถชน",
                        "cid" => "2390787778323",
                        "firstname" => "สมชาย",
                        "lastname" => "ใจดี",
                        "gender" => "ชาย",
                        "age" => "24",
                        "phone" => "0981234567",
                        "symptom_detail" => "คนขับหมดสติ",
                        "victim_number" => "1",
                        "risk_of_recurrence" => false,
                        "location" => "1768 Thai Summit Tower ถ. เพชรบุรี แขวงบางกะปิ เขตห้วยขวาง กรุงเทพมหานคร 10310 ประเทศไทย",
                        "longitude" => "100.56730535399781",
                        "latitude" => "13.747591710132115",
                        "platform" => "ios",
                        "remark" => "ตรงสี่แยก ใกล้กับเซเว่น"
                    ];

                    $data_user = User::where('provider_id',$event["replyToken"])->first();

                    // TIME ZONE LINE
                    $API_Time_zone = new API_Time_zone();
                    $time_zone = $API_Time_zone->change_Time_zone('Asia/Bangkok');

                    // datetime
                    $time_zone_explode = explode(" ",$time_zone);

                    $date = $time_zone_explode[0] ;
                    $time = $time_zone_explode[1] ;

                    if (!empty($data_user->photo)) {
                        $photo_profile = "https://www.viicheck.com/storage"."/".$data_user->photo ;
                    }else{
                        $photo_profile = "https://www.viicheck.com/img/stickerline/PNG/tab.png";
                    }

                    $template_path = storage_path('../public/json/test_new_flex_line.json');
                    $string_json = file_get_contents($template_path);

                    $string_json = str_replace("https://www.viicheck.com/storage/photo_profile_user",$photo_profile,$string_json);
                    $string_json = str_replace("name_user",$api_array_data['firstname']." ".$api_array_data['lastname'],$string_json);
                    // $string_json = str_replace("name_user",$data_user->username,$string_json);

                    $string_json = str_replace("date",$date,$string_json);
                    $string_json = str_replace("time",$time,$string_json);

                break;
            case 'promotion_partner':
                $privilege_data = Privilege_partner::where('status','active')
                ->inRandomOrder()
                ->take(5)
                ->get();

                $logo_privilege = [];
                $id_privilege = [];
                for ($loop = 0; $loop < count($privilege_data); $loop++) {

                    $id_privilege[$loop] = $privilege_data[$loop]['id'];

                    if (!empty($privilege_data[$loop]['logo'])) {
                        $logo_privilege[$loop] = "https://www.viicheck.com/storage"."/".$privilege_data[$loop]['logo'];
                    } else {
                        $logo_privilege[$loop] = "https://www.viicheck.com/img/logo/logo_x-icon.png";
                    }
                }

                $template_path = storage_path('../public/json/flex_promotion_partner/flex_promotion_partner.json');
                $string_json = file_get_contents($template_path);

                $string_json = str_replace("https://www.viicheck.com/storage/p_slot_1", $logo_privilege[0], $string_json);
                $string_json = str_replace("https://www.viicheck.com/storage/p_slot_2", $logo_privilege[1], $string_json);
                $string_json = str_replace("https://www.viicheck.com/storage/p_slot_3", $logo_privilege[2], $string_json);
                $string_json = str_replace("https://www.viicheck.com/storage/p_slot_4", $logo_privilege[3], $string_json);
                $string_json = str_replace("https://www.viicheck.com/storage/p_slot_5", $logo_privilege[4], $string_json);

                $string_json = str_replace("https://www.viicheck.com/?openExternalBrowser=1&promotion=slot_1", "https://www.viicheck.com/show_privilege_partner?partner_id=".$id_privilege[0]."&openExternalBrowser=1", $string_json);
                $string_json = str_replace("https://www.viicheck.com/?openExternalBrowser=1&promotion=slot_2", "https://www.viicheck.com/show_privilege_partner?partner_id=".$id_privilege[1]."&openExternalBrowser=1", $string_json);
                $string_json = str_replace("https://www.viicheck.com/?openExternalBrowser=1&promotion=slot_3", "https://www.viicheck.com/show_privilege_partner?partner_id=".$id_privilege[2]."&openExternalBrowser=1", $string_json);
                $string_json = str_replace("https://www.viicheck.com/?openExternalBrowser=1&promotion=slot_4", "https://www.viicheck.com/show_privilege_partner?partner_id=".$id_privilege[3]."&openExternalBrowser=1", $string_json);
                $string_json = str_replace("https://www.viicheck.com/?openExternalBrowser=1&promotion=slot_5", "https://www.viicheck.com/show_privilege_partner?partner_id=".$id_privilege[4]."&openExternalBrowser=1", $string_json);

                break;
            case 'fix_flex_line':

                $data_fix = [
                    "maintain_id" => "1",
                    "name_category" => "ชื่อหมวดหมู่",
                    "sub_category" => "คอมพิวเตอร์",
                    "problem_fix_case" => "เปิดไม่ติด เปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติดเปิดไม่ติด..",
                    "location" => "A",
                    "detail_location" => "โครงการมาร์เช่กรุงเทพกรีฑา เลขที่ 252/5 แขวงหัวหมาก เขตบางกะปิ กรุงเทพฯ 10240",
                    "D/M/Y" => "29/9/2022",
                    "H:I:S" => "02:30:57",
                    "name_informer" => "thanakorn tungkasopa",
                    "phone_informer" => "081-234-5678",
                ];

                $template_path = storage_path('../public/json/flex-repair/flex-fix_new/flex_line_repair.json');
                $string_json = file_get_contents($template_path);

                $string_json = str_replace("name_category", $data_fix['name_category'], $string_json);
                $string_json = str_replace("sub_category", $data_fix['sub_category'], $string_json);
                $string_json = str_replace("problem_fix_case", $data_fix['problem_fix_case'], $string_json);
                $string_json = str_replace("location", $data_fix['location'], $string_json);
                $string_json = str_replace("detail_location", $data_fix['detail_location'], $string_json);
                $string_json = str_replace("D/M/Y", $data_fix['D/M/Y'], $string_json);
                $string_json = str_replace("H:I:S", $data_fix['H:I:S'], $string_json);
                $string_json = str_replace("name_informer", $data_fix['name_informer'], $string_json);
                $string_json = str_replace("phone_informer", $data_fix['phone_informer'], $string_json);


                break;
            case 'fix_process': //มาจาก postback ของ fix_flex_line

                $data_fix_process = [
                    "sub_category" => "คอมพิวเตอร์",
                    "D/M/Y" => "29/9/2022",
                    "H:I:S" => "02:30:57",
                    "name_informer" => "thanakorn tungkasopa",
                    "name_officer" => "Theesak",
                ];

                $photo_profile = "https://www.viicheck.com/img/stickerline/PNG/tab.png";

                $template_path = storage_path('../public/json/flex-repair/flex-fix_new/flex_line_repair_process.json');
                $string_json = file_get_contents($template_path);

                $string_json = str_replace("sub_category", $data_fix_process['sub_category'], $string_json);
                $string_json = str_replace("D/M/Y", $data_fix_process['D/M/Y'], $string_json);
                $string_json = str_replace("H:I:S", $data_fix_process['H:I:S'], $string_json);
                $string_json = str_replace("name_informer", $data_fix_process['name_informer'], $string_json);
                $string_json = str_replace("name_officer", $data_fix_process['name_officer'], $string_json);

                $string_json = str_replace("https://www.viicheck.com/img/stickerline/PNG/tab.png", $photo_profile, $string_json);

                break;
            case 'bind_groupLine':
                    // $groupId = $event['source']['groupId'];

                    $template_path = storage_path('../public/json/flex-repair/flex-fix_new/flex_line_groupLine.json');
                    $string_json = file_get_contents($template_path);

                    $string_json = str_replace("GROUP", "ชื่อกลุ่มไลน์", $string_json);
                    // $string_json = str_replace("https://www.viicheck.com/connect_line_groups", "https://www.viicheck.com/connect_line_groups"."/".$groupId, $string_json);
                    break;
            case 'advice_ViiFix': //มาจาก postback ของ fix_flex_line
                $template_path = storage_path('../public/json/flex-repair/flex-fix_new/flex_line_advice_sos.json');
                $string_json = file_get_contents($template_path);

                break;
            default:
                //SAVE LOG
                $data_not_found_flex = [
                    "title" => "not_found_flex",
                    "content" => "ไม่พบชื่อตามเงื่อนไข",
                ];
                MyLog::create($data_not_found_flex);
                break;
        }

        $messages = [ json_decode($string_json, true) ];

        $body = [
            "replyToken" => $event["replyToken"],
            "messages" => $messages,
        ];

        $opts = [
            'http' =>[
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];

        $context  = stream_context_create($opts);
        //https://api-data.line.me/v2/bot/message/11914912908139/content
        $url = "https://api.line.me/v2/bot/message/reply";
        $result = file_get_contents($url, false, $context);

        //SAVE LOG
        $data = [
            "title" => "reply Success",
            "content" => "reply Success",
        ];
        MyLog::create($data);

        return $result;

        // $body = [
        //     "to" => $to_user,
        //     "messages" => $messages,
        // ];

        // $opts = [
        //     'http' =>[
        //         'method'  => 'POST',
        //         'header'  => "Content-Type: application/json \r\n".
        //                     'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
        //         'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
        //         //'timeout' => 60
        //     ]
        // ];

        // $context  = stream_context_create($opts);
        // $url = "https://api.line.me/v2/bot/message/push";
        // $result = file_get_contents($url, false, $context);

        // //SAVE LOG
        // $data = [
        //     "title" => "https://api.line.me/v2/bot/message/push",
        //     "content" => json_encode($result, JSON_UNESCAPED_UNICODE),
        // ];

        // MyLog::create($data);

    }
    
    public function check_process_maintain($data , $event)
    {

        $data_postback_explode = explode("/",$data);
        $data_postback = $data_postback_explode[0] ;
        $maintain_id = $data_postback_explode[1] ;

        // $template_path = storage_path('../public/json/text_success.json');
        // $string_json = file_get_contents($template_path);

        // $string_json = str_replace("ระบบได้รับการตอบกลับของท่านแล้ว ขอบคุณค่ะ","ปฏิเสธเรียบร้อยแล้ว",$string_json);

        $data_maintain = Maintain_noti::where('maintain_notis.id' , $maintain_id)->leftjoin('maintain_categorys', 'maintain_notis.category_id', '=', 'maintain_categorys.id')
        ->leftjoin('maintain_sub_categorys', 'maintain_notis.sub_category_id', '=', 'maintain_sub_categorys.id')
        ->leftJoin('users', 'maintain_notis.user_id', '=', 'users.id')
        ->leftJoin('maintain_notified_users', 'maintain_notis.user_id', '=', 'maintain_notified_users.user_id')
        ->select('maintain_notified_users.name as maintain_user_name','users.email' , 'users.phone' , 'users.photo as user_profile' ,'maintain_notis.*','maintain_sub_categorys.name as name_sub_categorys','maintain_categorys.name as name_categorys' ,'maintain_categorys.line_group_id as maintain_group_line_id')
        ->first();

        if (!empty($data_maintain->user_profile)) {
            $photo_profile = "https://www.viicheck.com/storage/".$data_maintain->user_profile ;
        }else{
            $photo_profile = "https://www.viicheck.com/img/stickerline/PNG/tab.png";
        }

        $officer = User::where('provider_id' , $event["source"]['userId'])->first();
        $data_officer = Sos_partner_officer::where('user_id' , $officer->id)->first();

        // ดึงข้อมูล officer_id ที่มีอยู่ในฐานข้อมูล
        $existingOfficerIds = $data_maintain->officer_id ? json_decode($data_maintain->officer_id) : [];
            
        // ตรวจสอบว่ามี id นี้แล้วหรือยัง ถ้ายังไม่มี ให้เพิ่มเข้าไป
        if (!in_array($data_officer->id, $existingOfficerIds)) {
            $existingOfficerIds[] = $data_officer->id;
        }

        if (!empty($officer->photo)) {
            $officer_profile = "https://www.viicheck.com/storage/".$officer->photo ;
        }else{
            $officer_profile = "https://www.viicheck.com/img/stickerline/PNG/tab.png";
        }

        if($data_maintain->status == 'แจ้งซ่อม'){


            DB::table('maintain_notis')
                ->where([
                        ['id', $data_maintain->id],
                    ])
                ->update([
                    'status' => "รอดำเนินการ",
                    'datetime_command' => now(),  
                    'officer_id' => json_encode($existingOfficerIds),  
                ]);
                
                $date_maintain = date('d/m/Y', strtotime(now()));
                $time_maintain = date('g:i', strtotime(now()));

            switch ($data_postback) {
                case 'command':
                    $template_path = storage_path('../public/json/maintain/maintain_command.json');
                    $string_json = file_get_contents($template_path);
    
                    $string_json = file_get_contents($template_path); 
        
                    $string_json = str_replace("sub_category","$data_maintain->name_sub_categorys",$string_json);
            
                    $string_json = str_replace("D/M/Y",$date_maintain,$string_json);
                    $string_json = str_replace("H:I:S",$time_maintain,$string_json);
            
                    $string_json = str_replace("Name_officer",$data_officer->full_name,$string_json);
                    $string_json = str_replace("https://www.viicheck.com/officer_profile",$officer_profile,$string_json);

            
                    $string_json = str_replace("Name",$data_maintain->maintain_user_name,$string_json);
                    $string_json = str_replace("phone",$data_maintain->phone,$string_json);
                    $string_json = str_replace("maintainID",$data_maintain->id,$string_json);
                    $string_json = str_replace("https://www.viicheck.com/user_profile",$photo_profile,$string_json);


                    $messages = [ json_decode($string_json, true) ];


                    break;
                default:
                    //SAVE LOG
                    $data_not_found_flex = [
                        "title" => "not_found_flex",
                        "content" => "ไม่พบชื่อตามเงื่อนไข",
                    ];
                    MyLog::create($data_not_found_flex);
                    break;
            }



        }else{
                $template_path = storage_path('../public/json/text_success.json');
                $string_json = file_get_contents($template_path);

                $string_json = str_replace("ระบบได้รับการตอบกลับของท่านแล้ว ขอบคุณค่ะ","เคสนี้ได้รับการตอบรับเรียบร้อยแล้ว",$string_json);
        }

       

        $messages = [ json_decode($string_json, true) ];

        $body = [
            "replyToken" => $event["replyToken"],
            "messages" => $messages,
        ];

        $opts = [
            'http' =>[
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];

        $context  = stream_context_create($opts);
        //https://api-data.line.me/v2/bot/message/11914912908139/content
        $url = "https://api.line.me/v2/bot/message/reply";
        $result = file_get_contents($url, false, $context);

        //SAVE LOG
        $data_log = [
            "title" => "reply Success",
            "content" => "reply Success",
        ];
        MyLog::create($data_log);

        return $result;

    }
    function _send_data_sos_api_to_line($user_id , $full_name , $case_id){

        $data_user = User::where('id' , $user_id)->first();

        // TIME ZONE LINE
        $API_Time_zone = new API_Time_zone();
        $time_zone = $API_Time_zone->change_Time_zone('Asia/Bangkok');

        // datetime
        $time_zone_explode = explode(" ",$time_zone);

        $date = $time_zone_explode[0] ;
        $time = $time_zone_explode[1] ;

        if (!empty($data_user->photo)) {
            $photo_profile = "https://www.viicheck.com/storage/".$data_user->photo ;
        }else{
            $photo_profile = "https://www.viicheck.com/img/stickerline/PNG/tab.png";
        }

        $template_path = storage_path('../public/json/flex-sos-1669/sos_by_api.json');
        $string_json = file_get_contents($template_path);
        $string_json = str_replace("ตัวอย่าง","ติดตามสถานะ..",$string_json);

        $string_json = str_replace("name_user",$full_name,$string_json);
        $string_json = str_replace("photo_profile_user",$photo_profile,$string_json);
        $string_json = str_replace("date",$date,$string_json);
        $string_json = str_replace("time",$time,$string_json);
        // $string_json = str_replace("tag_case_id",$case_id,$string_json);
        $string_json = str_replace("https://www.viicheck.com/?openExternalBrowser=1&case_id=tag_case_id","https://www.viicheck.com/demo_sos_1669_api/?openExternalBrowser=1",$string_json);


        $messages = [ json_decode($string_json, true) ];

        $body = [
            "to" => $data_user->provider_id,
            "messages" => $messages,
        ];

        $opts = [
            'http' =>[
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '.env('CHANNEL_ACCESS_TOKEN'),
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];

        $context  = stream_context_create($opts);
        $url = "https://api.line.me/v2/bot/message/push";
        $result = file_get_contents($url, false, $context);

        //SAVE LOG
        $data = [
            "title" => "https://api.line.me/v2/bot/message/push",
            "content" => json_encode($result, JSON_UNESCAPED_UNICODE),
        ];

        MyLog::create($data);

        return "success";

    }



}
