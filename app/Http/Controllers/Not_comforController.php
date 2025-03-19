<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Not_comfor;
use Illuminate\Http\Request;
use App\Models\Mylog;
use App\Models\Profanity;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailToGuest_notcomfor;
use App\Models\LineMessagingAPI;

class Not_comforController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $not_comfor = Not_comfor::where('provider_id', 'LIKE', "%$keyword%")
                ->orWhere('reply_provider_id', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('want_phone', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $not_comfor = Not_comfor::latest()->paginate($perPage);
        }

        return view('not_comfor.index', compact('not_comfor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $requestData = $request->all();

        $license_plate_id = $requestData['license_plate_id'] ;

        $data_cars = DB::table('register_cars')
                ->where('id', $license_plate_id)
                ->get();

        foreach ($data_cars as $data_car) {
            $registration_number = $data_car->registration_number;
            $province = $data_car->province;
            $car_type = $data_car->car_type;
        }


        return view('not_comfor.create', compact('registration_number' , 'province' , 'car_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();

        if (!empty($requestData['phone'])) {
            DB::table('users')
                ->where([ ['provider_id', $requestData['provider_id']] ])
                ->update(['phone' => $requestData['phone']]);
        }

        // แบนคำหยาบ
        $profanitie = DB::table('profanities')
                        ->select('content')
                        ->get();

        foreach($profanitie as $p){
            $requestData['content'] = str_replace($p->content, "", $requestData['content']);
            
        }

        $register_cars = DB::table('register_cars')
                    ->select('reply_provider_id')
                    ->where([
                            ['provider_id', $requestData['provider_id']],
                            ['registration_number', $requestData['registration_number']],
                            ['province', $requestData['province']],
                            ['now', "Yes"],
                        ])
                    ->get();

        foreach($register_cars as $item){
            $requestData['reply_provider_id'] = $item->reply_provider_id ; 
        }

        Not_comfor::create($requestData);

        $this->_push_Not_comforLine($requestData);

        return view('not_comfor.thx')->with('flash_message', 'Not_comfor added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $not_comfor = Not_comfor::findOrFail($id);

        return view('not_comfor.show', compact('not_comfor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $not_comfor = Not_comfor::findOrFail($id);

        return view('not_comfor.edit', compact('not_comfor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $not_comfor = Not_comfor::findOrFail($id);
        $not_comfor->update($requestData);

        return redirect('not_comfor')->with('flash_message', 'Not_comfor updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Not_comfor::destroy($id);

        return redirect('not_comfor')->with('flash_message', 'Not_comfor deleted!');
    }

    // public $channel_access_token = env('CHANNEL_ACCESS_TOKEN');

    public function _push_Not_comforLine($data)
    {   
        $line = new LineMessagingAPI();

        if (empty($data['reply_provider_id'])) {

            $provider_id = $data['provider_id'];

            $data_Text_topic = [
                "คุณได้ตอบกลับเรียบร้อยแล้ว",
                "ไม่สามารถทำการตอบกลับได้ค่ะ",
            ];

            $data_topic = $line->language_for_user($data_Text_topic, $provider_id);

            $template_path = storage_path('../public/json/not_sent.json');   
            $string_json = file_get_contents($template_path);
            $string_json = str_replace("คุณได้ตอบกลับเรียบร้อยแล้ว",$data_topic[0],$string_json);
            $string_json = str_replace("ไม่สามารถทำการตอบกลับได้ค่ะ",$data_topic[1],$string_json);
            $messages = [ json_decode($string_json, true) ];

            $body = [
                        "to" => $provider_id,
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
        }

        if (!empty($data['reply_provider_id'])) {

            $provider_id = $data['provider_id'];

            $reply_provider_id = $data['reply_provider_id'];
            $content = $data['content'];
            $phone = $data['phone'];
            $want_phone = $data['want_phone'];
            $registration_number = $data['registration_number'];
            $province = $data['province'];

            $type_login = DB::table('users')
                        ->select('type' , 'email' , 'name')
                        ->where('provider_id', $reply_provider_id)
                        ->get();

            $register_car = DB::select("SELECT * FROM register_cars WHERE registration_number = '$registration_number' AND province = '$province' AND active = 'Yes'");
            
            $reg = $registration_number ;
            $reg_text = preg_replace('/[0-9]+/', '', $reg);
            $reg_num = preg_replace('/[^A-Za-z0-9\-]/', ' ', $reg); 
            $reg_num_sp = explode(" ", $reg_num);
            $last_list_num = count($reg_num_sp) - 1 ;

            $reg_1 = $reg_num_sp[0] . $reg_text ;
            $reg_2 = $reg_num_sp[$last_list_num] ;

            foreach ($register_car as $car) {
                $car_type = $car->car_type;

            }  
            
            $google_registration_number = $registration_number ;
            $google_province = $province ;

            $data_Text_topic = [
                "ฉันไม่สะดวก",
                "เนื่องจาก",
                $content,
            ];

            $data_topic = $line->language_for_user($data_Text_topic, $provider_id);

            foreach($type_login as $item){
                switch ($item->type) {
                    case 'line':
                        switch($want_phone){
                            case "Yes":  
                                switch($car_type){
                                    case "car": 
                                        $template_path = storage_path('../public/json/viimove/call/flex-not-comfor-car.json');   
                                        $string_json = file_get_contents($template_path);
                                        $string_json = str_replace("TEXT_REG_NUM",$registration_number,$string_json);

                                    break;
                                    case "motorcycle": 
                                        $template_path = storage_path('../public/json/viimove/call/flex-not-comfor-motocycle.json');  
                                        $string_json = file_get_contents($template_path);
                                        $string_json = str_replace("TEXT_REG_MOR_1",$reg_1,$string_json);
                                        $string_json = str_replace("TEXT_REG_MOR_2",$reg_2,$string_json);
                                    break;
                                    case "other": 
                                        $template_path = storage_path('../public/json/viimove/call/flex-not-comfor-car.json');   
                                        $string_json = file_get_contents($template_path);
                                        $string_json = str_replace("TEXT_REG_NUM",$registration_number,$string_json);

                                    break;
                                }
                                
                                $string_json = str_replace("ตัวอย่าง",$data_topic[0],$string_json);
                                $string_json = str_replace("ฉันไม่สะดวก",$data_topic[0],$string_json);
                                $string_json = str_replace("TEXT_REG_PRO",$province,$string_json);
                                $string_json = str_replace("CONTENT",$data_topic[2],$string_json);
                                if (!empty($phone)) {
                                    $string_json = str_replace("PHONE_NUMBER",$phone,$string_json);
                                }
                                $string_json = str_replace("เนื่องจาก",$data_topic[1],$string_json);

                                $messages = [ json_decode($string_json, true) ];
                                break;
                            case "No":  
                                switch($car_type){
                                    case "car": 
                                        $template_path = storage_path('../public/json/viimove/nocall/flex-not-comfor-car.json');   
                                        $string_json = file_get_contents($template_path);
                                        $string_json = str_replace("TEXT_REG_NUM",$registration_number,$string_json);
                                    break;
                                    case "motorcycle": 
                                        $template_path = storage_path('../public/json/viimove/nocall/flex-not-comfor-motocycle.json');  
                                        $string_json = file_get_contents($template_path);
                                        $string_json = str_replace("TEXT_REG_MOR_1",$reg_1,$string_json);
                                        $string_json = str_replace("TEXT_REG_MOR_2",$reg_2,$string_json);
                                    break;
                                    case "other": 
                                        $template_path = storage_path('../public/json/viimove/nocall/flex-not-comfor-car.json');   
                                        $string_json = file_get_contents($template_path);
                                        $string_json = str_replace("TEXT_REG_NUM",$registration_number,$string_json);
                                    break;
                                }
                                $string_json = str_replace("ตัวอย่าง",$data_topic[0],$string_json);
                                $string_json = str_replace("ฉันไม่สะดวก",$data_topic[0],$string_json);
                                $string_json = str_replace("TEXT_REG_PRO",$province,$string_json);
                                $string_json = str_replace("CONTENT",$data_topic[2],$string_json);
                                $string_json = str_replace("เนื่องจาก",$data_topic[1],$string_json);

                                $messages = [ json_decode($string_json, true) ];
                                break;
                        }

                        $body = [
                                    "to" => $reply_provider_id,
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
                                "phone" => $phone,
                                "content" => $content,
                                "want_phone" => $want_phone,
                            ];

                            $email = $item->email;
                            Mail::to($email)->send(new MailToGuest_notcomfor($google_data));

                            DB::table('register_cars')
                                ->where([ 
                                        ['registration_number', $google_registration_number],
                                        ['province', $google_province],
                                        ['now', "Yes"] 
                                    ])
                                ->update(['now' => null]);
                        break;

                    case 'facebook':
                        //
                        break;
                }
            }
        }

    }

    public function not_comfor_login(Request $request , $license_plate_id)
    {
        $id = Auth::id();

        if(Auth::check()){
            return redirect('not_comfor/create?license_plate_id='.$license_plate_id);
            // echo Auth::User()->name;
        }else{
            return redirect('login/line?redirectTo=not_comfor/create?license_plate_id='.$license_plate_id);
        }
    }


}
