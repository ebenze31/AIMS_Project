<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Sos_map;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Mylog;
use App\Models\Nationality;

use App\Http\Controllers\API\API_Time_zone;
use App\Models\LineMessagingAPI;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailTo_sos_partner;
use App\Models\Partner_condo;
use App\Models\Partner;
use App\Models\Sos_map_title;
use App\User;
use App\Http\Controllers\API\ImageController;
use App\Models\Group_line;
use App\Models\Report_repair;
use App\Models\Sos_map_wait_delete;
use App\Models\Sos_by_organization;

use App\Http\Controllers\API\LineApiController;


class Sos_mapController extends Controller
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
            $sos_map = Sos_map::where('content', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('lat', 'LIKE', "%$keyword%")
                ->orWhere('lng', 'LIKE', "%$keyword%")
                ->orWhere('area', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $sos_map = Sos_map::latest()->paginate($perPage);
        }

        return view('sos_map.index', compact('sos_map'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $condo_id = $request->get('condo_id');
        $text_sos = $request->get('text');

        $user = Auth::user();
        if (!empty($user->nationalitie)){
            $nationalitie = Nationality::where('nationality',$user->nationalitie)->get();
            foreach ($nationalitie as $item) {
                $nationalitie_tel = $item->tel;
            }
            return view('sos_map.create', compact('user','text_sos','nationalitie_tel', 'condo_id'));
        }
        // echo "<pre>";
        // print_r($nationalitie_tel);
        // echo "<pre>";
        // exit();
        return view('sos_map.create', compact('user','text_sos', 'condo_id'));
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

        $requestData['type_reporter'] = $requestData['private_type_reporter'] ;
        
        // echo "<pre>";
        // print_r($requestData);
        // echo "<pre>";
        // exit();

        if (!empty($requestData['title_sos'])){
            $requestData['title_sos'] = $requestData['title_sos'] ;
        }else{
            $requestData['title_sos'] = "";
        }

        if (!empty($requestData['title_sos_other'])){
            $requestData['title_sos_other'] = $requestData['title_sos_other'] ;
        }else{
            $requestData['title_sos_other'] = "";
        }

        $sos_map_title = Sos_map_title::where('name_partner', $requestData['area'])
            ->where('ask_to_partner' , null)
            ->where('title' , $requestData['title_sos_other'])
            ->first();

        // ตรวจสอบ และเพิ่ม title sos
        if( $requestData['title_sos'] == 'อื่นๆ' ){

            if( empty($sos_map_title) ){

                $title_by_user = Sos_map_title::where('ask_to_partner', $requestData['area'])
                    ->where('title' , $requestData['title_sos_other'])
                    ->first();

                if(!empty($title_by_user)){

                    if(empty($title_by_user->count)){
                        $count_by_user_old = 0 ;
                    }else{
                        $count_by_user_old = intval($title_by_user->count) ;
                    }

                    DB::table('sos_map_titles')
                        ->where('id',$title_by_user->id)
                        ->update([
                            'count' => $count_by_user_old + 1 ,
                    ]);

                }else{

                    $new_data_title = [];
                    $new_data_title['title'] = $requestData['title_sos_other'];
                    $new_data_title['ask_to_partner'] = $requestData['area'];
                    $new_data_title['user_id'] = $requestData['user_id'];
                    $new_data_title['count'] = '1';

                    Sos_map_title::create($new_data_title);

                }

            }else{

                if(empty($sos_map_title->count)){
                    $count_old = 0 ;
                }else{
                    $count_old = intval($sos_map_title->count) ;
                }

                if(!empty($sos_map_title)){
                    DB::table('sos_map_titles')
                        ->where('id',$sos_map_title->id)
                        ->update([
                            'count' => $count_old + 1 ,
                    ]);  
                }
                
            }

        }else{

            $sos_map_title_main = Sos_map_title::where('name_partner', $requestData['area'])
                ->where('title' , $requestData['title_sos'])
                ->first();

            if(empty($sos_map_title_main->count)){
                $count_main = 0 ;
            }else{
                $count_main = intval($sos_map_title_main->count) ;
            }

            if( !empty($sos_map_title_main) ){
                DB::table('sos_map_titles')
                    ->where('id',$sos_map_title_main->id)
                    ->update([
                        'count' => $count_main + 1 ,
                ]);
            }
        }

        if ($request->hasFile('photo_area')) {
            $requestData['photo'] = $request->file('photo_area')
                ->store('uploads', 'public');
        }
        // if (!empty($requestData['photo'])) {


            // $name_file_img = uniqid('photo_sos-', true);
            // $output_file_img = "./storage/uploads/".$name_file_img.".png";

            // $data_64_img = explode( ',', $requestData['text_img'] );

            // $fp_img = fopen($output_file_img, "w+");
     
            // fwrite($fp_img, base64_decode( $data_64_img[ 1 ] ) );
             
            // fclose($fp_img);

            // $url_img_sos = str_replace("./storage/","",$output_file_img);
            // $requestData['photo'] = $url_img_sos ;
        // }

        $requestData['notify'] = $requestData['area'] ;

        if ( $requestData['content'] == "emergency_Charlie_Bangkok" ) {
            $requestData['name_area']  = 'ชาลีกรุงเทพ' ;
        }

        $requestData['status'] = "รับแจ้งเหตุ" ;

        Sos_map::create($requestData);

        $sos_map_latests = Sos_map::latest()->first();
        $tag_sos_or_repair = $sos_map_latests->tag_sos_or_repair;
        $sos_name_content = $sos_map_latests->content;

        if ($tag_sos_or_repair == "tag_repair") {
            
            $requestData['sos_map_id'] = $sos_map_latests->id ;
            Report_repair::create($requestData);

        }

        // ----------- RESIZE PHOTO ----------- //
        $resize_photo = new ImageController();

        if (!empty($requestData['photo'])) {
           $resize_photo->resize_photo($sos_map_latests->photo);
        }

        $id_sos_map = $sos_map_latests->id;
        $requestData['name_partner'] = $sos_map_latests->area ;
        $requestData['name_area'] = $sos_map_latests->name_area ;

        // echo "<pre>";
        // print_r($requestData);
        // echo "<pre>"; 
        // exit();

        DB::table('users')
            ->where([ 
                    ['id', $requestData['user_id'] ],
                ])
            ->update([
                'lat' => $requestData['lat'],
                'lng' => $requestData['lng'],
                'phone' => $requestData['phone'],
            ]);


        switch ($requestData['content']) {
            case 'help_area':
                // ตรวจสอบ area แล้วส่งข้อมูลผ่านไลน์ 
                $this->_pushLine($requestData , $id_sos_map);
                break;
            case 'emergency_js100':
                // send data to groupline js100
                $this->_pushLine_to_js100($requestData , $id_sos_map);
                break;
            case 'emergency_Charlie_Bangkok':
                // send data to groupline Charlie_Bangkok
                // $this->_pushLine_to_Charlie($requestData , $id_sos_map);
                $this->_pushLine($requestData , $id_sos_map);
                break;   
        }
        
        // เช็ค type user แล้วเลือก redirect
        // type line เด้งกลับ line oa
        // อื่นๆ แนะนำให้ผูกบัญชีกับไลน์
        $data_user = User::where('id', $requestData['user_id'] )->get();

        foreach ($data_user as $key_itme) {

            if ($key_itme->type == 'line') {
                if (!empty($requestData['condo_id'])) {
                    $data_condos = Partner_condo::where('id' , $requestData['condo_id'])->first();
                    $link_line_oa = $data_condos->link_line_oa ;
                }else{
                    $link_line_oa = "https://lin.ee/xnFKMfc" ;
                }

                // return redirect('/sos_thank_area')->with('flash_message', 'Sos_map added!');
                return view('sos_map.sos_thank_area', compact('link_line_oa' , 'id_sos_map' , 'tag_sos_or_repair','sos_name_content'));

            }else{
                return redirect('/sos_thank')->with('flash_message', 'Sos_map added!');
            }

        }
        
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
        $sos_map = Sos_map::findOrFail($id);

        return view('sos_map.show', compact('sos_map'));
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
        $sos_map = Sos_map::findOrFail($id);

        return view('sos_map.edit', compact('sos_map'));
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
        
        if ($request->hasFile('photo_succeed')) {
            $requestData['photo_succeed'] = $request->file('photo_succeed')
                ->store('uploads', 'public');
        }

        $sos_map = Sos_map::findOrFail($id);
        $sos_map->update($requestData);

        return redirect()->back();
        // return redirect('sos_map')->with('flash_message', 'Sos_map updated!');
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
        Sos_map::destroy($id);

        return redirect('sos_map')->with('flash_message', 'Sos_map deleted!');
    }

    public function sos_insurance_blade(Request $request)
    {
        $user = Auth::user();

        $latlng = $request->get('latlng');

        $register_car = DB::table('register_cars')
            ->where('user_id', $user->id)
            ->where('active', "Yes")
            ->get();

        $name_insurance = Insurance::where('company', '!=',"" )
            ->groupBy('company')
            ->orderBy('company')
            ->get();

        $select_ins = Insurance::where('company', '!=',"" )
            ->groupBy('company')
            ->orderBy('company')
            ->get();

        return view('sos_map.sos_insurance', compact('register_car','latlng','name_insurance','select_ins'));
    }

    public function sos_login(Request $request)
    {
        $requestData = $request->all();

        if (!empty($requestData['condo_id'])) {

            $condo_id = $requestData['condo_id'];

            if(Auth::check()){
                return redirect('sos_map/create?condo_id=' . $condo_id);
            }else{
                return redirect('login/line?redirectTo=sos_map/create?condo_id=' . $condo_id);
            }

        }else{

            if(Auth::check()){
                return redirect('sos_map/create');
            }else{
                return redirect('login/line?redirectTo=sos_map/create');
            }

        }
        
    }

    public function sos_login_facebook()
    {
        if(Auth::check()){
            return redirect('sos_map/create');
        }else{
            return redirect('login/facebook?redirectTo=sos_map/create');
        }
    }

    public function sos_login_other_app(Request $request , $user_from)
    {
        if(Auth::check()){

            $data_user = Auth::user();

            if ( !empty($data_user->user_from) ){

                $check_user_from = explode(",",$data_user->user_from);

                if ( in_array( $user_from , $check_user_from ) ){
                    $update_user_from = $data_user->user_from ;
                }else{
                    $update_user_from = $data_user->user_from .','. $user_from ;
                }

            }else{
                $update_user_from = $user_from ;
            }

            DB::table('users')
                ->where([ 
                        ['type', 'line'],
                        ['provider_id', $data_user->provider_id],
                    ])
                ->update(['user_from' => $update_user_from]);

            return redirect('sos_map/create');
        }else{
            return redirect('login/line/'.$user_from.'?redirectTo=sos_map/create');
        }
    }

    public function insurance_login()
    {
        if(Auth::check()){
            return redirect('sos_insurance_blade');
        }else{
            return redirect('login/line?redirectTo=sos_insurance_blade');
        }
    }

    public function insurance_login_facebook()
    {
        if(Auth::check()){
            return redirect('sos_insurance_blade');
        }else{
            return redirect('login/facebook?redirectTo=sos_insurance_blade');
        }
    }

    public function rate_help($id_sos_map)
    {
        $data_sos_map = Sos_map::findOrFail($id_sos_map);
        $data_users = User::findOrFail($data_sos_map->user_id);

        if (!empty($data_sos_map->score_impression)) {
            $score = "Yes" ; 
        }else{
            $score = "No" ;
        }

        return view('sos_map.rate_help', compact('data_sos_map','data_users','score'));
    }

    public function sos_thank_submit_score($user_id)
    {
        return view('sos_map.sos_thank_submit_score', compact('user_id'));
    }

    public function log_in_sos_map_add_photo($id_sos_map)
    {
        if(Auth::check()){
            return redirect('sos_map/add_photo' . '/' . $id_sos_map);
        }else{
            return redirect('login/line?redirectTo=sos_map/add_photo' . '/' . $id_sos_map);
        }
    }

    public function sos_map_add_photo($id_sos_map)
    {   
        $user = Auth::user();
        $data_sos_map = Sos_map::findOrFail($id_sos_map);

        if (!empty($data_sos_map->photo_succeed_by)) {
            $data_officer = User::where('id' , $data_sos_map->photo_succeed_by)->first();
        }else{
            $data_officer = "" ;
        }

        if (!empty($data_sos_map->photo_succeed)) {
            $photo_succeed = "Yes" ; 
        }else{
            $photo_succeed = "No" ;
        }

        return view('sos_map.add_photo_succeed', compact('user' , 'data_sos_map' , 'photo_succeed' ,'data_officer'));
    }

    // public $channel_access_token = env('CHANNEL_ACCESS_TOKEN');

    protected function _pushLine($data , $id_sos_map)
    {   
        $date_now =  date("d-m-Y");
        $time_now =  date("H:i");
        $name_user = $data['name'];
        $phone_user = $data['phone'];
        $lat_user = $data['lat'];
        $lng_user = $data['lng'];
        $photo = $data['photo'];
        $user_id = $data['user_id'];
        $title_sos = $data['title_sos'];
        $title_sos_other = $data['title_sos_other'];
        $tag_sos_or_repair = $data['tag_sos_or_repair'];

        if(empty($title_sos)){
            $title_sos = "ขอความช่วยเหลือ" ;
        }

        if(empty($title_sos_other)){
            $title_sos_other = "ไม่ได้เพิ่มข้อมูล" ;
        }

        $data_users = User::where('id' , $user_id)->first();

        $data_name_sp = explode("&",$data['area']);
        $data_name_area_sp = explode("&",$data['name_area']);

        for ($i=0; $i < count($data_name_sp); $i++) {
            
            $data_name_sp[$i] = str_replace("amp; ","",$data_name_sp[$i]);
            // $data_name_area_sp[$i] = str_replace(" ","",$data_name_area_sp[$i]);

            $data_partners = DB::table('partners')
                ->where('name', $data_name_sp[$i])
                ->where('name_area','LIKE', "%$data_name_area_sp[$i]%")
                ->get();

            foreach ($data_partners as $data_partner) {
                $name_partner = $data_partner->name ;
                $name_line_group = $data_partner->line_group ;
                $mail_partner = $data_partner->mail ;
                $id_partner = $data_partner->id ;
                $group_line_id = $data_partner->group_line_id;
            }

            $data_line_group = DB::table('group_lines')->where('id', $group_line_id)->get();

            foreach ($data_line_group as $key) {
                $groupId = $key->groupId ;
                $name_time_zone = $key->time_zone ;
                $group_language = $key->language ;
            }

            // TIME ZONE
            $API_Time_zone = new API_Time_zone();
            $time_zone = $API_Time_zone->change_Time_zone($name_time_zone);

            $data_topic = [
                        "กำลังไปช่วยเหลือ",
                        "พื้นที่",
                    ];

            for ($xi=0; $xi < count($data_topic); $xi++) { 

                $text_topic = DB::table('text_topics')
                        ->select($group_language)
                        ->where('th', $data_topic[$xi])
                        ->where('en', "!=", null)
                        ->get();

                foreach ($text_topic as $item_of_text_topic) {
                    $data_topic[$xi] = $item_of_text_topic->$group_language ;
                }
            }
            
            $text_at = '@' ;

            // FLEX SOS เอกชน ทั่วไป
            if ($data['content'] == 'help_area') {
                //ส่งเมล
                $data_send_mail = array();
                $data_send_mail['photo'] = $photo ;
                $data_send_mail['name_partner'] = $name_partner ;
                $data_send_mail['time_zone'] = $time_zone ;
                $data_send_mail['name_user'] = $name_user ;
                $data_send_mail['phone_user'] = $phone_user ;
                $data_send_mail['lat'] = $lat_user ;
                $data_send_mail['lng'] = $lng_user ;
                $data_send_mail['lat_mail'] = $text_at.$lat_user;

                $email = $mail_partner ;

                if ($email == "-" or $email == null) {
                    $email = "vii_test@gmail.com" ;
                }
                
                // Mail::to($email)->send(new MailTo_sos_partner($data_send_mail));
                
                // flex ask_for_help
                $template_path = storage_path('../public/json/ask_for_help_tag_sos.json');
                $string_json = file_get_contents($template_path);

            }else if($data['content'] == 'emergency_Charlie_Bangkok'){
                // FLEX SOS ชาลี
                $template_path = storage_path('../public/json/flex_volunteer/flex_sos_chalie_v2.json');
                $string_json = file_get_contents($template_path);
            }
            

            if (!empty($data['photo'])) {
                $string_json = str_replace("photo_sos.png",$photo,$string_json);
            }

            if ($tag_sos_or_repair == 'tag_sos') {
                $string_json = str_replace("TAG_SOS","SOS",$string_json);
                $string_json = str_replace("#888888","#DD8F00",$string_json);
                $text_tag_sos = "SOS : " ;
            }else{
                $string_json = str_replace("TAG_SOS","แจ้งซ่อม",$string_json);
                $string_json = str_replace("#888888","#004AAD",$string_json);
                $text_tag_sos = "แจ้งซ่อม : " ;
            }
               
            $string_json = str_replace("ตัวอย่าง",$text_tag_sos.$title_sos,$string_json);

            $string_json = str_replace("name_user",$name_user,$string_json);
            $string_json = str_replace("area",$data_name_area_sp[$i],$string_json);

            $string_json = str_replace("หัวข้อขอความช่วยเหลือ",$title_sos,$string_json);
            $string_json = str_replace("รายละเอียดขอความช่วยเหลือ",$title_sos_other,$string_json);

            if (!empty($data_users->photo)) {
                $string_json = str_replace("photo_profile_user",$data_users->photo,$string_json);
            }else{
                $string_json = str_replace("https://www.viicheck.com/storage/photo_profile_user","https://www.viicheck.com/img/stickerline/Flex/12.png",$string_json);
            }

            $string_json = str_replace("png_language",$data_users->language,$string_json);
            $string_json = str_replace("png_national",$data_users->nationalitie,$string_json);

            $string_json = str_replace("วันที่แจ้ง",$date_now,$string_json);
            $string_json = str_replace("เวลาที่แจ้ง",$time_now,$string_json);

            $string_json = str_replace("กำลังไปช่วยเหลือ",$data_topic[0],$string_json);
            $string_json = str_replace("พื้นที่",$data_topic[1],$string_json);

            $string_json = str_replace("id_sos_map",$id_sos_map,$string_json);
            $string_json = str_replace("organization",$id_partner,$string_json);

            $string_json = str_replace("0999999999",$phone_user,$string_json);

            $string_json = str_replace("gg_lat_mail",$text_at.$lat_user,$string_json);
            $string_json = str_replace("gg_lat",$lat_user,$string_json);
            $string_json = str_replace("lng",$lng_user,$string_json);

            $messages = [ json_decode($string_json, true) ];

            $body = [
                "to" => $groupId,
                "messages" => $messages,
            ];

            // flex ask_for_help
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

            // SAVE LOG
            $data = [
                "title" => "ข้อมูลขอความช่วยเหลือ" . $name_partner ,
                "content" => "จากคุณ" . $name_user,
            ];
            MyLog::create($data);

        }
        
    }

    // send data to groupline Charlie
    protected function _pushLine_to_Charlie($data , $id_sos_map)
    {   
        $datetime =  date("d-m-Y  h:i:sa");
        $date_now =  date("d-m-Y");
        $time_now =  date("h:i:sa");

        $name_user = $data['name'];
        $user_id = $data['user_id'];
        $phone_user = $data['phone'];
        $lat_user = $data['lat'];
        $lng_user = $data['lng'];
        $photo = $data['photo'];

        $title_sos = $data['title_sos'];
        $title_sos_other = $data['title_sos_other'];
        $tag_sos_or_repair = $data['tag_sos_or_repair'];

        if(empty($title_sos)){
            $title_sos = "ขอความช่วยเหลือ" ;
        }

        if(empty($title_sos_other)){
            $title_sos_other = "ไม่ได้เพิ่มข้อมูล" ;
        }

        $data_users = User::where('id' , $user_id)->first();

        $data_line_group = DB::table('group_lines')->where('system', 'emergency_Charlie')->first();

        $groupId = $data_line_group->groupId ;
        $name_time_zone = $data_line_group->time_zone ;
        $group_language = $data_line_group->language ;
        $id_partner = $data_line_group->partner_id ;

        // TIME ZONE
        $API_Time_zone = new API_Time_zone();
        $time_zone = $API_Time_zone->change_Time_zone($name_time_zone);

        $data_topic = [
                    "กำลังไปช่วยเหลือ",
                    "พื้นที่",
                ];

        for ($xi=0; $xi < count($data_topic); $xi++) { 

            $text_topic = DB::table('text_topics')
                    ->select($group_language)
                    ->where('th', $data_topic[$xi])
                    ->where('en', "!=", null)
                    ->get();

            foreach ($text_topic as $item_of_text_topic) {
                $data_topic[$xi] = $item_of_text_topic->$group_language ;
            }
        }
        
        $text_at = '@' ;

        $template_path = storage_path('../public/json/flex_volunteer/flex_sos_chalie_v2.json');
        $string_json = file_get_contents($template_path);

        $string_json = str_replace("ตัวอย่าง",$data_topic[0],$string_json);

        $string_json = str_replace("กำลังไปช่วยเหลือ",$data_topic[0],$string_json);
        $string_json = str_replace("พื้นที่",$data_topic[1],$string_json);

        if (!empty($data_users->photo)) {
            $string_json = str_replace("IMG_USER",$data_users->photo,$string_json);
        }else{
            $string_json = str_replace("https://www.peddyhub.com/storage/IMG_USER","https://www.viicheck.com/img/stickerline/Flex/12.png",$string_json);
        }

        if ($tag_sos_or_repair == 'tag_sos') {
            $string_json = str_replace("TAG_SOS","SOS",$string_json);
            $string_json = str_replace("#888888","#DD8F00",$string_json);
            $text_tag_sos = "SOS : " ;
        }else{
            $string_json = str_replace("TAG_SOS","แจ้งซ่อม",$string_json);
            $string_json = str_replace("#888888","#004AAD",$string_json);
            $text_tag_sos = "แจ้งซ่อม : " ;
        }

        $string_json = str_replace("NAME_USER",$name_user,$string_json);

        if (!empty($data_users->language)) {
            $string_json = str_replace("PNG_LANGUAGE",$data_users->language,$string_json);
        }else{
            $string_json = str_replace("PNG_LANGUAGE","-",$string_json);
        }

        if (!empty($data_users->nationalitie)) {
            $string_json = str_replace("USER_NATIONAL",$data_users->nationalitie,$string_json);
        }else{
            $string_json = str_replace("USER_NATIONAL","-",$string_json);
        }

        $string_json = str_replace("PHOTO_SOS",$photo,$string_json);
        $string_json = str_replace("PHONE_USER",$phone_user,$string_json);
        $string_json = str_replace("DATE_SOS",$date_now,$string_json);
        $string_json = str_replace("TIME_SOS",$time_now,$string_json);

        $string_json = str_replace("id_sos_map",$id_sos_map,$string_json);
        $string_json = str_replace("organization",$id_partner,$string_json);

        $string_json = str_replace("gg_lat_mail",$text_at.$lat_user,$string_json);
        $string_json = str_replace("gg_lat",$lat_user,$string_json);
        $string_json = str_replace("lng",$lng_user,$string_json);

        $messages = [ json_decode($string_json, true) ];

        $body = [
            "to" => $groupId,
            "messages" => $messages,
        ];

        // flex ask_for_help
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

        // SAVE LOG
        $data = [
            "title" => "ข้อมูลขอความช่วยเหลือ Charlie" ,
            "content" => "จากคุณ" . $name_user,
        ];
        MyLog::create($data);

    }

    // send data to grouplin js100
    protected function _pushLine_to_js100($data , $id_sos_map)
    {   
        $datetime =  date("d-m-Y  h:i:sa");
        $date_now =  date("d-m-Y");
        $time_now =  date("h:i:sa");

        $name_user = $data['name'];
        $user_id = $data['user_id'];
        $phone_user = $data['phone'];
        $lat_user = $data['lat'];
        $lng_user = $data['lng'];
        $photo = $data['photo'];

        $data_users = User::where('id' , $user_id)->first();

        $data_line_group = DB::table('group_lines')->where('system', 'emergency_js100')->first();

        $groupId = $data_line_group->groupId ;
        $name_time_zone = $data_line_group->time_zone ;
        $group_language = $data_line_group->language ;
        
        $text_at = '@' ;

        $template_path = storage_path('../public/json/flex-sos-js100.json');
        $string_json = file_get_contents($template_path);

        if (!empty($data_users->photo)) {
            $string_json = str_replace("photo_profile_user",$data_users->photo,$string_json);
        }else{
            $string_json = str_replace("https://www.viicheck.com/storage/photo_profile_user","https://www.viicheck.com/img/stickerline/Flex/12.png",$string_json);
        }

        $string_json = str_replace("name_user",$name_user,$string_json);

        if (!empty($data_users->language)) {
            $string_json = str_replace("png_language",$data_users->language,$string_json);
        }else{
            $string_json = str_replace("png_language","-",$string_json);
        }

        if (!empty($data_users->nationalitie)) {
            $string_json = str_replace("png_national",$data_users->nationalitie,$string_json);
        }else{
            $string_json = str_replace("png_national","-",$string_json);
        }
        
        $string_json = str_replace("0899999999",$phone_user,$string_json);
        $string_json = str_replace("วันที่แจ้ง",$date_now,$string_json);
        $string_json = str_replace("เวลาที่แจ้ง",$time_now,$string_json);

        $string_json = str_replace("gg_lat_mail",$text_at.$lat_user,$string_json);
        $string_json = str_replace("gg_lat",$lat_user,$string_json);
        $string_json = str_replace("lng",$lng_user,$string_json);

        $messages = [ json_decode($string_json, true) ];

        $body = [
            "to" => $groupId,
            "messages" => $messages,
        ];

        // flex ask_for_help
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

        // SAVE LOG
        $data = [
            "title" => "ข้อมูลขอความช่วยเหลือ JS100" ,
            "content" => "จากคุณ" . $name_user,
        ];
        MyLog::create($data);

    }

    function check_tag_sos_log_in($id_sos_map,$groupId){

        if(Auth::check()){
            return redirect("sos_map/check_tag_sos" . "/" . $id_sos_map . "/" . $groupId) ;
        }else{
            $re_to = "sos_map/check_tag_sos" . "/" . $id_sos_map . "/" . $groupId ;
            return redirect('login/line?redirectTo=' . $re_to);
        }
    }

    function check_tag_sos($id_sos_map,$groupId){

        $data_sos_map = Sos_map::where('id',$id_sos_map)->first();

        // echo $data_sos_map->tag_sos_or_repair ;

        if($data_sos_map->tag_sos_or_repair == 'tag_sos'){
            // ไปหน้า map เจ้าหน้าที่
            return redirect("sos_map/tag_sos/map_officer" . "/" . $id_sos_map . "/" . $groupId) ;
        }else{
            return redirect("sos_map/report_repair" . "/" . $id_sos_map) ;
        }
    }

    function map_officer($id_sos_map , $groupId){

        $data_sos_map = Sos_map::where('id',$id_sos_map)->first();

        return view('sos_map.map_officer', compact('data_sos_map','groupId'));

    }

    function update_location_officer(Request $request)
    {
        $requestData = $request->all();

        DB::table('users')
            ->where([ 
                    ['id', $requestData['officer_id'] ],
                ])
            ->update([
                'lat' => $requestData['officer_lat'],
                'lng' => $requestData['officer_lng'],
            ]);

        $data_sos_map = Sos_map::where('id' , $requestData['sos_map_id'])->select('user_id','remark_command')->first();
        $data_user = User::where('id' , $data_sos_map->user_id)->select('lat' , 'lng')->first();

        $data_user->remark_command = $data_sos_map->remark_command ;

        return $data_user ;

    }

    function update_status(Request $request)
    {
        $requestData = $request->all();

        // เช็คสถานะ และอัพเดทเวลาตามสถานะ
        if($requestData['status'] == "ถึงที่เกิดเหตุ"){
            DB::table('sos_maps')
                ->where([ 
                        ['id', $requestData['sos_map_id'] ],
                    ])
                ->update([
                    'status' => $requestData['status'],
                    'time_to_the_scene' => date('Y-m-d H:i:s'),
                ]);
        }else if($requestData['status'] == "ออกจากที่เกิดเหตุ"){
            DB::table('sos_maps')
                ->where([ 
                        ['id', $requestData['sos_map_id'] ],
                    ])
                ->update([
                    'status' => $requestData['status'],
                    'time_leave_the_scene' => date('Y-m-d H:i:s'),
                ]);
        }else if($requestData['status'] == "เสร็จสิ้น"){
            DB::table('sos_maps')
                ->where([ 
                        ['id', $requestData['sos_map_id'] ],
                    ])
                ->update([
                    'status' => $requestData['status'],
                    'remark_status' => $requestData['remark_status'],
                ]);
        }

        return "OK" ;

    }

    function help_complete(Request $request)
    {
        $requestData = $request->all();

        $data_helpers = User::where('id' , $requestData["officer_id"])->first();
        $name_helper = $data_helpers->name ;

        if(!empty($requestData["command_id"])){
            $command_id = $requestData["command_id"] ;

            $data_command = User::where('id' , $requestData["command_id"])->select('name')->first();
            $name_command = $data_command->name ;
        }else{
            $name_command = 'no_name_command' ;
        }

        $event = [] ;
        $event["source"]["userId"] = $data_helpers->provider_id;
        $event["source"]["groupId"] = $requestData["groupId"];

        $line = new LineApiController();

        if($name_command != 'no_name_command'){
            $line->help_complete_by_command($event, 'help_complete', $requestData['sos_map_id'] , $name_command , $name_helper);
        }else{
            $line->check_help_complete_by_helper($event, 'help_complete', $requestData['sos_map_id']);
        }
    
    }

    function user_view_officer_login($id_sos_map){
        if(Auth::check()){
            return redirect("sos_map/user_view_officer" . "/" . $id_sos_map) ;
        }else{
            $re_to = "sos_map/user_view_officer" . "/" . $id_sos_map ;
            return redirect('login/line?redirectTo=' . $re_to);
        }
    }

    function user_view_officer($id_sos_map){

        $data_sos = Sos_map::where('id' , $id_sos_map)->first();

        return view('sos_map.user_view_officer', compact('data_sos'));
    }

    function update_location_user(Request $request)
    {
        $requestData = $request->all();

        if(!empty($requestData['user_id'])){
            DB::table('users')
                ->where([ 
                        ['id', $requestData['user_id'] ],
                    ])
                ->update([
                    'lat' => $requestData['user_lat'],
                    'lng' => $requestData['user_lng'],
                ]);
        }

        $data = [];

        $data_sos_map = Sos_map::where('id' , $requestData['sos_map_id'])->select('helper_id','status','remark_status','sos_1669_id')->first();
        $data_helper = User::where('id' , $data_sos_map->helper_id)->select('lat' , 'lng')->first();

        $data['data_helper'] = $data_helper;
        $data['status'] =  $data_sos_map->status ;
        $data['remark_status'] =  $data_sos_map->remark_status ;
        $data['sos_1669_id'] =  $data_sos_map->sos_1669_id ;

        return $data ;
    }

    function loop_check_status_sos_map($id_sos_map){

        $data_sos_map = Sos_map::where('id' , $id_sos_map)->first();

        $data_helper = User::where('id', $data_sos_map->helper_id )->first();
        if(!empty($data_helper)){
            $data_sos_map->photo_officer = $data_helper->photo ;
        }

        return $data_sos_map ;
    }

    function sos_map_command($id_sos_map){

        $data_sos_map = Sos_map::where('id' , $id_sos_map)->first();
        $data_partner = Partner::where('name' , $data_sos_map->area)
            ->where('name_area' , $data_sos_map->name_area)
            ->first();

        $data_groupline = Group_line::where('id' , $data_partner->group_line_id)->first();
        $groupId = $data_groupline->groupId ;

        return view('sos_map.sos_map_command', compact('data_sos_map' ,'groupId'));
    }

    function get_location_user_and_officer(Request $request)
    {
        $requestData = $request->all();
        $data_sos_map = Sos_map::where('id' , $requestData['sos_map_id'])->first();

        $data = [];

        $data['status'] = $data_sos_map->status;
        $data['user_lat'] = $data_sos_map->user->lat;
        $data['user_lng'] = $data_sos_map->user->lng;
        $data['officer_lat'] = $data_sos_map->user_helper->lat;
        $data['officer_lng'] = $data_sos_map->user_helper->lng;

        return $data ;

    }

    function search_phone_niems($cityName){

        $data = [];

        $phone_niems = DB::table('phone_niems')->where('province', 'LIKE', "%$cityName%")->get();
        $province_ths = DB::table('province_ths')
            ->where('province_name',  $cityName)
            ->where('sos_1669_show',  "show")
            ->first();

        if(!empty($phone_niems)){
            $data['phone_niems'] = $phone_niems;
        }else{
           $data['phone_niems'] = "no";
        }

        if(!empty($province_ths)){
            $data['1669'] = $cityName;
        }else{
            $data['1669'] = "no";
        }

        return $data ;
    }

    function update_sos_1669_id($sos_1669_id , $sos_map_id ,$district_P,$name_admin){

        DB::table('sos_maps')
            ->where([ 
                    ['id', $sos_map_id ],
                ])
            ->update([
                'sos_1669_id' => $sos_1669_id,
                'status' => "เสร็จสิ้น",
                'remark_status' => "อัพเดทสถานะเสร็จสิ้นโดย : " . $name_admin . " หมายเหตุ : ส่งต่อ สพฉ. " . $district_P,
            ]);

        return "ok" ;

    }

    function update_helper_id($admin_id , $sos_map_id){

        $data_sos_map = Sos_map::where('id' , $sos_map_id)->first();

        if(empty($data_sos_map->helper_id)){
            $data_user = User::where('id' , $admin_id)->first();

            DB::table('sos_maps')
                ->where([ 
                        ['id', $sos_map_id ],
                    ])
                ->update([
                    'helper' => $data_user->name,
                    'helper_id' => $data_user->id,
                    'organization_helper' => $data_user->organization,
                ]);

            return $data_user->id ;
        }else{
            return $data_sos_map->helper_id ;
        }

    }

    function report_repair($id_sos_map){

        $data_report = Report_repair::where('sos_map_id' , $id_sos_map)->first();
        $data_partner = Partner::where('name' , $data_report->sos_map->area)
            ->where('name_area' , $data_report->sos_map->name_area)
            ->first();

        $data_groupline = Group_line::where('id' , $data_partner->group_line_id)->first();
        $groupId = $data_groupline->groupId ;

        return view('sos_map.sos_report_repair', compact('groupId' ,'data_report'));

    }

    
    function update_data_report_repair(Request $request)
    {
        $requestData = $request->all();

        $data_user = User::where('id' , $requestData['user_id'])->first();
        $datetime = now();
        DB::table('report_repair')
            ->where([ 
                    ['sos_map_id',$requestData['sos_map_id'] ],
                ])
            ->update([
                'how_to_fix' => $requestData['how_to_fix'],
                'link' => $requestData['link'],
            ]);

            $sos_map = DB::table('sos_maps')->where('id', $requestData['sos_map_id']);

            $sos_map->update([
                'status' => $requestData['status'],
                'helper_id' => $data_user->id,
                'helper' => $data_user->name,
                'organization_helper' => $data_user->organization,
               
            ]);

            if ($requestData['status'] === "กำลังไปช่วยเหลือ") {
                $sos_map->update(['time_go_to_help' => $datetime]);
            } elseif ($requestData['status'] === "เสร็จสิ้น") {
                $sos_map->update(['help_complete_time' => $datetime]);
            }
        

        $this->sent_line_repair_to_user($requestData['sos_map_id'] , $requestData['user_id'] , $requestData['status']);

        return "ok";
    }

    function report_repair_for_user_check_login($id_sos_map){

        if(Auth::check()){
            return redirect("sos_map/report_repair_for_user_success" . "/" . $id_sos_map);
        }else{
            $re_to = "sos_map/report_repair_for_user_success" . "/" . $id_sos_map ;
            return redirect('login/line?redirectTo=' . $re_to);
        }
        
    }

    function report_repair_for_user_success($id_sos_map){

        $data_report = Report_repair::where('sos_map_id' , $id_sos_map)->first();
        $data_helper = User::where('id' ,$data_report->sos_map->helper_id)->first();

        return view('sos_map.sos_report_repair_for_user', compact('data_report','data_helper'));
        
    }

    function delete_case($id_sos_map){
        
        Sos_map::where('id' , $id_sos_map)->delete();

        return redirect()->back();
    }

    function delete_case_from_wait_delete($id_sos_map){
        
        Sos_map::where('id' , $id_sos_map)->delete();
        Sos_map_wait_delete::where('sos_map_id' , $id_sos_map)->delete();

        return redirect()->back();
        
    }

    function sent_line_repair_to_user($sos_map_id , $user_id , $status){

        $data_sos_map = Sos_map::where('id' , $sos_map_id)->first();
        $data_user = User::where('id' , $user_id)->first();

        $title_sos_other = '';
        if(!empty($data_sos_map->title_sos_other)){
            $title_sos_other = $data_sos_map->title_sos_other ;
        }

        $datetime =  date("d-m-Y  h:i:sa");
        $date_now =  date("d-m-Y");
        $time_now =  date("h:i");

        if($status == "กำลังไปช่วยเหลือ"){
            $template_path = storage_path('../public/json/flex-repair/flxe_line_repair_process.json');
        }else if($status == "เสร็จสิ้น"){
            $template_path = storage_path('../public/json/flex-repair/flxe_line_repair_success.json');
        }

        $string_json = file_get_contents($template_path);
           
        $string_json = str_replace("ตัวอย่าง","การแจ้งซ่อมของคุณ..",$string_json);

        $string_json = str_replace("สวัสดีคุณ","สวัสดีคุณ " . $data_user->name,$string_json);

        $string_json = str_replace("date",$date_now,$string_json);
        $string_json = str_replace("time",$time_now,$string_json);

        $string_json = str_replace("หัวข้อ",$data_sos_map->title_sos,$string_json);
        $string_json = str_replace("รายละเอียด",$title_sos_other,$string_json);

        $string_json = str_replace("id_sos_map",$sos_map_id,$string_json);

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

        // SAVE LOG
        $data = [
            "title" => "อัพเดทสถานะแจ้งซ่อม : " . $status,
            "content" => $data_user->name,
        ];
        MyLog::create($data);

    }

    function submit_remark_command(Request $request)
    {
        $requestData = $request->all();

        DB::table('sos_maps')
            ->where([ 
                    ['id',$requestData['sos_map_id'] ],
                ])
            ->update([
                'remark_command' => $requestData['remark_command'],
            ]);

        return "ok" ;
    }

    function request_delete_case($sos_map_id , $officer_id){

        DB::table('sos_maps')
            ->where([ 
                    ['id',$sos_map_id ],
                ])
            ->update([
                'wait_delete' => "Yes",
            ]);

        $data = [];

        $data['sos_map_id'] = $sos_map_id;
        $data['officer_id'] = $officer_id;
        
        Sos_map_wait_delete::create($data);

        return "ok" ;

    }

    function send_data_sos_api(Request $request)
    {
        $requestData = $request->all();

        $data = [];

        $data['status_code'] = 201;
        $data['result'] = 'Created';
        $data['data']['case_id'] = '972ef179-fb33-4039-91ba-c7da0d5be06c';
        $data['message'] = null;

        return $data ;

    }

    function send_data_sos_api_to_line($user_id , $full_name , $case_id){

        $line = new LineMessagingAPI();
        $line->_send_data_sos_api_to_line($user_id , $full_name , $case_id);

        return 'success';
    }

    function get_data_btn_organizations(Request $request){
        $requestData = $request->all();

        // แยกชื่อบริษัทหลักออกจากกัน
        $company_names = explode(',', $requestData['user_from']);
        // ดึงข้อมูลบริษัทย่อย
        $subsidiaries = [];
        foreach ($company_names as $company_name) {
            $subsidiaries = array_merge($subsidiaries, Sos_by_organization::where('name_partner', $company_name)
            ->leftJoin('partners', 'sos_by_organizations.name_partner', '=', 'partners.name')
            ->whereNull('partners.name_area')
            ->get()->toArray());
        }

        // จัดกลุ่มข้อมูลบริษัทย่อย
        $groupedSubsidiaries = array_reduce($subsidiaries, function ($acc, $subsidiary) {
            $acc[$subsidiary['name_partner']][] = $subsidiary;
            return $acc;
        }, []);

        // ส่งข้อมูลบริษัทย่อยกลับไปยัง client
        return response()->json($groupedSubsidiaries);
    }

    public function sos_organization(Request $request)
    {
        $condo_id = $request->get('condo_id');
        $text_sos = $request->get('text');

        $user = Auth::user();
        if (!empty($user->nationalitie)){
            $nationalitie = Nationality::where('nationality',$user->nationalitie)->get();
            foreach ($nationalitie as $item) {
                $nationalitie_tel = $item->tel;
            }
            return view('sos_partners.sos_organization', compact('user','text_sos','nationalitie_tel', 'condo_id'));
        }
        
        return view('sos_partners.sos_organization', compact('user','text_sos', 'condo_id'));
    }

}