<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Notify_repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use App\Models\Condo_LineMessagingAPI;

use App\Models\Partner_condo;
use App\Models\Partner;
use App\Models\User_condo;
use App\Models\Category_condo;
use App\Models\Group_line;

class Notify_repairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $building = $request->get('building');
        $perPage = 25;

        $user = Auth::user();

        if ($user->role == "admin-condo") {
            $name_condo_of_admin = $user->organization ;
            $data_partners = Partner::where('name' ,$name_condo_of_admin)->where('name_area' , null)->first();

            $condo_id = $data_partners->condo_id ;

            $all_building = User_condo::where('condo_id' , $condo_id)->groupBy('building')->get();
        }

        if (!empty($building)) {
            $notify_repair = Notify_repair::where('building', $building)
                ->where('condo_id', $condo_id)
                ->latest()
                ->paginate($perPage);
            
        } else {
            $building = "ทั้งหมด";
            $notify_repair = Notify_repair::where('condo_id', $condo_id)
                ->latest()
                ->paginate($perPage);
        }

        $naem_group_line = Group_line::where('condo_id' , $condo_id)->where('system' , 'notify_repair')->first();
        $all_group_line = Group_line::where('condo_id' , $condo_id)->where('system' , null)->get();

        return view('notify_repair.index', compact('notify_repair', 'user', 'all_building','building' , 'condo_id','naem_group_line','all_group_line'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $date_now = date("Y-m-d");

        $building = $request->get('building');

        if (empty($building)) {
            $building = "ทั้งหมด";
        }

        $condo_id = $request->get('condo_id');

        $user = Auth::user();

        $all_building = User_condo::where('condo_id' , $condo_id)->groupBy('building')->get();

        $data_user_condo = User_condo::where('user_id' , $user->id)->where('condo_id' , $condo_id)->first();

        $data_category_condo = Category_condo::where('system' , 'notify_repair')
            ->where('condo_id' , null)
            ->orWhere('condo_id' , $condo_id)
            ->get();

        return view('notify_repair.create', compact('user','condo_id','all_building','building','data_category_condo' ,'data_user_condo' ,'date_now'));

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
        $date_now = date('Y-m-d\TH:i:sP');

        $requestData = $request->all();

        if ($request->hasFile('photo')) {
            $requestData['photo'] = $request->file('photo')
            ->store('uploads', 'public');
        }

        $requestData['status'] = "รอยืนยันการนัด";
        $requestData['time_wait_cf'] = $date_now;

        Notify_repair::create($requestData);

        $condo_id = $requestData['condo_id'];
        $data_condos = Partner_condo::where('id' , $condo_id)->first();
        $link_line_oa = $data_condos->link_line_oa ;

        $data_notify_repair = Notify_repair::where('condo_id' , $condo_id)->latest()->first();

        // ส่งไลน์เข้ากลุ่มช่าง (notify_repair)
        $line_condo = new Condo_LineMessagingAPI();
        $line_condo->send_TO_notify_repair($data_condos,$data_notify_repair);

        if (!empty($requestData['user_condo_id'])) {
            return view('notify_repair.add_line', compact('link_line_oa'));
        }else{
            return redirect('notify_repair')->with('flash_message', 'Notify_repair added!');
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
        $notify_repair = Notify_repair::findOrFail($id);

        return view('notify_repair.show', compact('notify_repair'));
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
        $notify_repair = Notify_repair::findOrFail($id);

        return view('notify_repair.edit', compact('notify_repair'));
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
                if ($request->hasFile('photo')) {
            $requestData['photo'] = $request->file('photo')
                ->store('uploads', 'public');
        }

        $notify_repair = Notify_repair::findOrFail($id);
        $notify_repair->update($requestData);

        return redirect('notify_repair')->with('flash_message', 'Notify_repair updated!');
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
        Notify_repair::destroy($id);

        return redirect('notify_repair')->with('flash_message', 'Notify_repair deleted!');
    }

    public function login_line(Request $request)
    {
        $condo_id = $request->get('condo_id');

        if(Auth::check()){
            return redirect('notify_repair/create?condo_id=' . $condo_id);
        }else{
            return redirect('login/line?redirectTo=notify_repair/create?condo_id=' . $condo_id);
        }
    }

    public function select_appointment_time($appointment_date , $condo_id)
    {
        $data = Notify_repair::where('condo_id' , $condo_id)->where('appointment_date', $appointment_date)->get();

        return $data ;
    }

    public function notify_repair_NOCF($id)
    {
        $notify_repair = Notify_repair::findOrFail($id);
        $annotation = $notify_repair->annotation ;
        $data_condos = Partner_condo::where('id', $notify_repair->condo_id)->first();

        return view('notify_repair.nocf', compact('notify_repair','data_condos','annotation'));
    }

    function notify_repair_annotation($id, $annotation)
    {
        DB::table('notify_repairs')
            ->where('id', $id)
            ->update([
                'annotation' => $annotation,
            ]);

        $notify_repair = Notify_repair::where('id', $id)->first();
        $data_condos = Partner_condo::where('id', $notify_repair->condo_id)->first();
        $data_user_condo = User_condo::where('id', $notify_repair->user_condo_id)->first();

        // ส่งไลน์แจ้งลูกบ้านว่ายกเลิกพร้อมเหตุผล
        $template_path = storage_path('../public/json/send_to_usercondo_NOCF.json');
        $string_json = file_get_contents($template_path);

        $string_json = str_replace("ตัวอย่าง","เรียนคุณ",$string_json);
        $string_json = str_replace("name_user",$data_user_condo->user->name,$string_json);
        $string_json = str_replace("annotation",$annotation,$string_json);

        $messages = [ json_decode($string_json, true) ];

        $body = [
            "to" => $data_user_condo->user->provider_id,
            "messages" => $messages,
        ];

        $opts = [
            'http' =>[
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '. $data_condos->channel_access_token,
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];
                            
        $context  = stream_context_create($opts);
        $url = "https://api.line.me/v2/bot/message/push";
        $result = file_get_contents($url, false, $context);

        //SAVE LOG
        $data = [
            "title" => "notify_repair_annotation",
            "content" => json_encode($result, JSON_UNESCAPED_UNICODE),
            "condo_id" => $data_condos->id,
        ];

        Mylog_condo::create($data);

        return "OK";
    }

}
