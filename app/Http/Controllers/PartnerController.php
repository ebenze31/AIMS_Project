<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Partner;
use App\Models\Partner_premium;
use App\Models\Partner_condo;
use Illuminate\Http\Request;
use App\Models\Group_line;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\CarModel;
use App\Models\Ads_content;
use App\Models\Register_car;
use App\Models\Guest;
use App\Models\News;
use App\Models\Report_news;
use App\Models\Motercycle;
use Illuminate\Support\Facades\DB;
use App\Models\Sos_map;
use App\Models\Sos_insurance;
use App\county;
use Illuminate\Support\Facades\Hash;
use App\Models\Time_zone;
use App\Models\Check_in;
use App\Models\Data_1669_officer_command;
use App\Models\Disease;
use App\Models\Sos_map_title;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Sos_partner;


class PartnerController extends Controller
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
            // $partner = Partner::where('name', 'LIKE', "%$keyword%")
            $partner = Sos_partner::where('name', 'LIKE', "%$keyword%")
                ->where('name_area', null)
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('line_group', 'LIKE', "%$keyword%")
                ->orWhere('mail', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            // $partner = Partner::where('name_area', null)->latest()->paginate($perPage);
            // $partner = Partner::where('name_area', null)->latest()->get();
            $partner = Sos_partner::latest()->get();
        }

        foreach ($partner as $key) {
            $new_sos_area = $key->new_sos_area ;
        }

        $group_line = Group_line::where('owner', null)->where('condo_id', null)->get();

        return view('partner.index', compact('partner','group_line','new_sos_area'));
    }

    public function detail_area($name_partner)
    {
        // $name_partner = $request->get('name_partner');
        $perPage = 25;

        $partner = Partner::where('name', $name_partner)
                ->where('name_area', "!=" , null)
                ->latest()
                ->paginate($perPage);

        $group_line = Group_line::where('owner', null)->where('condo_id', null)->get();

        return view('partner.detail_name_area', compact('partner','group_line'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // $group_line = Group_line::where('owner', null)->where('condo_id', null)->get();

        return view('partner.create_partner_sos');
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

        if ($request->hasFile('logo')) {
            $requestData['logo'] = $request->file('logo')->store('uploads', 'public');
        }

        $requestData['phone'] = str_replace("-", "", $requestData['phone']);
        $requestData['phone'] = str_replace(" ", "", $requestData['phone']);

        $requestData['class_color_menu'] = "other";

        if ($requestData['type_partner'] == 'condo') {
            $save_Partner_condo = [
                "name" => $requestData['name'],
            ];

            Partner_condo::firstOrCreate($save_Partner_condo);

            $data_Partner_condo = Partner_condo::get();

            foreach ($data_Partner_condo as $key_condo) {
                $condo_id = $key_condo->id ;

            }
            $requestData['condo_id'] = $condo_id ;

        }

        Partner::create($requestData);

        $data_partners = Partner::where("name", $requestData['name'])->get();
        foreach ($data_partners as $key_1) {

            DB::table('group_lines')
                    ->where('groupName', $requestData['line_group'])
                    ->update([
                        'owner' => $requestData['name']." (Partner)",
                        'partner_id' => $key_1->id,
                ]);

            if( !empty($requestData['condo_id']) ){
                DB::table('partner_condos')
                    ->where('id', $requestData['condo_id'])
                    ->update([
                        'partner_id' => $key_1->id,
                ]);
            }

        }

        $group_line = Group_line::where('groupName', $requestData['line_group'])->get();
        foreach ($group_line as $key_2) {

            DB::table('partners')
                ->where('name', $requestData['name'])
                ->update([
                    'group_line_id' => $key_2->id,
            ]);

        }

        return redirect('partner_viicheck')->with('flash_message', 'Partner added!');
    }

    public function partner_add_area(Request $request)
    {
        $requestData = $request->all();

        $data_partner_big = Partner::where('id' , $requestData['id_partner'])->first();
        $requestData['logo'] = $data_partner_big->logo;
        $requestData['full_name'] = $data_partner_big->full_name;

        $requestData['phone'] = str_replace("-", "", $requestData['phone']);
        $requestData['phone'] = str_replace(" ", "", $requestData['phone']);

        Partner::create($requestData);

        $data_partners = Partner::where("name", $requestData['name'])->where('name_area' , $requestData['name_area'])->first();

        DB::table('group_lines')
                ->where('id', $requestData['group_line_id'])
                ->update([
                    'owner' => $requestData['name']." (Partner)",
                    'partner_id' => $data_partners->id,
            ]);

        $id_partner =  $data_partners->id ;

        $group_line = Group_line::where('partner_id', $id_partner)->get();
        foreach ($group_line as $key_2) {

            DB::table('partners')
                ->where('name', $requestData['name'])
                ->where("name_area", $requestData['name_area'])
                ->update([
                    'group_line_id' => $key_2->id,
            ]);

        }

        return redirect('add_area')->with('flash_message', 'Partner added!');

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
        $partner = Partner::findOrFail($id);

        return view('partner.show', compact('partner'));
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
        $partner = Partner::findOrFail($id);

        return view('partner.edit', compact('partner'));
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

        if ($request->hasFile('logo')) {
            $requestData['logo'] = $request->file('logo')->store('uploads', 'public');
        }

        if (!empty($requestData['mail'])) {
            $data_partner = Partner::where('id' , $id)->first();
            $all_area = Partner::where('name' , $data_partner->name)->get();

            foreach ($all_area as $key) {

                DB::table('partners')
                        ->where('id', $key->id)
                        ->update([
                            'mail' => $requestData['mail'],
                    ]);
            }
        }

        $partner = Partner::findOrFail($id);
        $partner->update($requestData);

        return redirect('partner_viicheck')->with('flash_message', 'Partner updated!');
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
        Partner::destroy($id);

        return redirect('partner_viicheck')->with('flash_message', 'Partner deleted!');
    }

    public function manage_user(Request $request)
    {
        $data_user = Auth::user();

        if($data_user->role != "admin-partner"){
            return redirect('404');
        }else{

            $data_partners = Partner::where("name", $data_user->organization)
                ->where("name_area", null)
                ->get();

            foreach ($data_partners as $data_partner) {
                $name_partner = $data_partner->name ;
            }

            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $all_user = User::Where('organization', $name_partner)->orderByRaw("CASE WHEN role = 'admin-partner' THEN 0 ELSE 1 END, name ASC")
                    ->Where('name', 'LIKE', "%$keyword%")
                    ->latest()->paginate($perPage);
            } else {
                $all_user = User::Where('organization', $name_partner)->orderByRaw("CASE WHEN role = 'admin-partner' THEN 0 ELSE 1 END, name ASC")
                    ->latest()->paginate($perPage);
            }

            $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();


            return view('partner.user.manage_user', compact('data_partners','all_user','data_time_zone'));
        }
    }

    // public function create_user_partner(Request $request)
    // {
    //     $type_user = $request->get('type_user');
    //     $data_user = Auth::user();

    //     $data_partners = Partner::where("name", $data_user->organization)
    //     ->where("name_area", null)
    //     ->get();

    //     $partners = $data_user->organization ;

    //     $name = uniqid($partners.'-');
    //     $username = $name ;
    //     $email = "กรุณาเพิ่มอีเมล" ;
    //     $password = uniqid();
    //     $provider_id = uniqid($partners.'-', true);

    //     $user = new User();
    //     $user->name = $name;
    //     $user->username = $name;
    //     $user->provider_id = $provider_id;
    //     $user->password = Hash::make($password);
    //     $user->email = $email;
    //     $user->role = $type_user;
    //     $user->organization = $partners;
    //     $user->creator = $data_user->id;
    //     $user->status = "active";

    //     $user->save();

    //     $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();

    //     return view('partner.user.create_user_partner', compact('data_partners' , 'partners' , 'username' , 'password','data_time_zone'));
    // }

    public function create_user_partner(Request $request)
    {
        $requestData = $request->all();

        if ($requestData['type_user'] == "admin") {
            $requestData['type_user'] = "admin-partner" ;
        }

        $data_user = Auth::user();

        $data_partners = Partner::where("name", $data_user->organization)
            ->where("name_area", null)
            ->get();

        $partners = $data_user->organization ;

        if (!empty($requestData['sub_organization'])){
            $sub_partners = $requestData['sub_organization'] ;
        }else{
            $sub_partners = $data_user->sub_organization ;
        }


        $type_user = $requestData['type_user'];
        $name = $requestData['name'];
        $username = $requestData['user_name'];
        $email = "กรุณาเพิ่มอีเมล" ;
        $password = uniqid();
        $provider_id = uniqid($partners.'-', true);

        $check_user_old = User::where('name' , $name)->where('username' , $username)->first();

        if(empty($check_user_old->id)){
            $user = new User();
            $user->name = $name;
            $user->username = $username;
            $user->provider_id = $provider_id;
            $user->password = Hash::make($password);
            $user->email = $email;
            $user->role = $type_user;
            $user->organization = $partners;
            $user->creator = $data_user->id;
            $user->status = "active";
            $user->sub_organization = $sub_partners;

            $user->save();

            $user_old = "No" ;

            if ($partners == "สพฉ"){

                $last_user = User::latest()->first();
                $last_officer_1669 = Data_1669_officer_command::where('area',$sub_partners)->get();

                $last_num_officer = "0";
                foreach ($last_officer_1669 as $check_officer){
                    if ( intval($check_officer->number) > intval($last_num_officer) ){
                        $last_num_officer = intval($check_officer->number);
                    }
                }

                $new_officer = [];

                $new_officer['name_officer_command'] = $name;
                $new_officer['user_id'] = $last_user->id;
                $new_officer['area'] = $sub_partners;
                $new_officer['officer_role'] = $type_user;
                $new_officer['number'] = intval($last_num_officer) + 1 ;
                $new_officer['status'] = null;
                $new_officer['creator'] = $data_user->id;

                Data_1669_officer_command::create($new_officer);

            }

        }else{
            $user_old = "Yes" ;
        }

        $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();

        return view('partner.user.create_user_partner', compact('data_partners' , 'partners' , 'username' , 'password','data_time_zone','user_old','check_user_old'));
    }

    public function partner_media(Request $request)
    {
        $media_menu = $request->get('menu');

        return view('partner.partner_media', compact('media_menu'));
    }

    public function partner_index()
    {
        $data_user = Auth::user();

        $data_partners = Partner::where("name", $data_user->organization)
            ->where("name_area", null)
            ->get();

        foreach ($data_partners as $key) {
            $id_condo = $key->condo_id ;
        }

        if (!empty($id_condo)) {
            $data_condos = Partner_condo::where('id' , $id_condo)->first();
        }

        if (!empty($data_condos)) {
            $partner_condo = "Yes" ;
        }else{
            $partner_condo = "No" ;
        }

        return view('partner.partner_index', compact('data_partners','partner_condo'));
    }

    public function register_cars(Request $request)
    {
        $data_user = Auth::user();
        $data_partners = Partner::where("name", $data_user->organization)
            ->where("name_area", null)
            ->get();
        foreach ($data_partners as $key) {
            $neme_partner = $key->name;
        }
        $perPage = 25;
        $report_register_cars = Register_car::where('juristicNameTH', $data_user->organization)
                ->latest()->paginate(25);

                // echo "<pre>";
                // print_r($report_register_cars);
                // echo "<pre>";
                // exit();

        $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();

        return view('partner.partner_register_cars', compact('data_partners', 'report_register_cars','data_time_zone','neme_partner'));
    }

    public function guest_partner(Request $request)
    {
        $data_user = Auth::user();
        $data_partners = Partner::where("name", $data_user->organization)
            ->where("name_area", null)
            ->get();

        $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();

        $year = $request->get('year');
        $month_1 = $request->get('month_1');
        $month_2 = $request->get('month_2');

        $guest_year = Guest::where('organization', $data_user->organization)
                ->groupBy(['date'])
                ->selectRaw('YEAR(created_at) as date')
                ->get();

        $perPage = 20;
        $guest = Guest::where('organization', $data_user->organization)
                ->groupBy('registration')
                ->groupBy('county')
                ->groupBy('register_car_id')
                ->selectRaw('count(register_car_id) as count , registration , county , register_car_id')
                ->orderByRaw('count DESC')
                ->latest()->paginate($perPage);

        if (count($guest) == 0) {
            $i = (count($guest)) ;
            $count_per_month[$i] = array();
            $count_per_month[$i] = "กรุณาระบุปีที่ต้องการเลือก" ;

            $i = "";
        }

        if (!empty($year) and !empty($month_1) and !empty($month_2)) {
            foreach($guest as $guest_key ){

                $i =$guest_key->register_car_id ;

                $count_per_month[$i] = array();

                $monthly_reports = Guest::where('organization', $data_user->organization)
                    ->where('register_car_id',  $guest_key->register_car_id)
                    ->whereMonth('created_at', ">=" , $month_1)
                    ->whereMonth('created_at', "<=" , $month_2)
                    ->whereYear('created_at', $year)
                    ->groupBy('register_car_id')
                    ->selectRaw('count(register_car_id) as count   , register_car_id')
                    ->orderByRaw('count DESC')
                    ->get();

                    if (count($monthly_reports) == 0) {
                        $count_per_month[$i] = 0 ;
                    } else {
                        foreach($monthly_reports as $zxc ){
                            $count_per_month[$i] = $zxc->count ;
                        }
                    }

                $i = "";
            }
        } else if (!empty($year) and empty($month_1))  {
            foreach($guest as $guest_key ){

                $i =$guest_key->register_car_id ;
                $count_per_month[$i] = array();

                $monthly_reports = Guest::where('organization', $data_user->organization)
                    ->where('register_car_id',  $guest_key->register_car_id)
                    ->whereYear('created_at', $year)
                    ->groupBy('register_car_id')
                    ->selectRaw('count(register_car_id) as count   , register_car_id')
                    ->orderByRaw('count DESC')
                    ->get();

                    foreach($monthly_reports as $zxc ){
                        $count_per_month[$i] = $zxc->count ;
                    }

                $i = "";
            }
        } else if (empty($year) and empty($month_1) )  {
            foreach($guest as $guest_key ){

                $i =$guest_key->register_car_id ;
                $count_per_month[$i] = array();
                $count_per_month[$i] = "กรุณาระบุข้อมูล" ;

                $i = "";
            }
        } else if (empty($year))  {
            foreach($guest as $guest_key ){

                $i =$guest_key->register_car_id ;
                $count_per_month[$i] = array();
                $count_per_month[$i] = "กรุณาระบุปีที่ต้องการเลือก" ;

                $i = "";
            }
        }

        return view('partner.guest_partner', compact('data_partners', 'guest','count_per_month','guest_year','data_time_zone'));
    }

    public function partner_guest_latest(Request $request)
    {
        $data_user = Auth::user();
        $data_partners = Partner::where("name", $data_user->organization)
            ->where("name_area", null)
            ->get();

        $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();

        $guest_latest = Guest::where('organization', $data_user->organization)->latest()->paginate(25);

        return view('partner.partner_guest_latest', compact('data_partners', 'guest_latest','data_time_zone'));
    }

    public function view_sos(Request $request)
    {
        $name_area = $request->get('name_area');

        $data_user = Auth::user();
        $data_partners = Partner::where("name", $data_user->organization)
            ->where("name_area", null)
            ->get();

        foreach ($data_partners as $data_partner) {
            $search_area = $data_partner->name ;
            $type_partner = $data_partner->type_partner ;
        }
        $perPage = 20;

        $sos_all_request = Sos_map::selectRaw('count(id) as count')->where('area', $search_area)->get();
                    foreach ($sos_all_request as $key) {
                            $sos_all = $key->count ;
                        }

        // นับจำนวนทั้งหมด
        $view_maps_all = DB::table('sos_maps')
            ->where('area','LIKE', "%$search_area%")
            ->get();

        $count_data = count($view_maps_all);
        ////////

        // $view_maps = DB::table('sos_maps')
        //     ->where('area','LIKE', "%$search_area%")
        //     ->where('name_area','LIKE', "%$name_area%")
        //     ->latest()->paginate($perPage);

        $view_maps = DB::table('sos_maps')
            ->where('area', 'LIKE', "%$search_area%")
            ->where('name_area', 'LIKE', "%$name_area%")
            ->latest()
            ->take(10) // เลือกเพียง 10 รายการ
            ->get();


        $select_name_areas = DB::table('sos_maps')
            ->where('area','LIKE', "%$search_area%")
            ->groupBy('name_area')
            ->get();

        $text_at = '@' ;

        $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();

        $average_per_minute = $this->average_per_minute($view_maps_all);

        return view('partner.partner_sos', compact('data_partners','view_maps' , 'view_maps_all' , 'sos_all' ,'text_at','data_time_zone','count_data', 'select_name_areas' , 'name_area' , 'average_per_minute','type_partner'));
    }

    public function sos_emergency_js100(Request $request)
    {
        $data_user = Auth::user();
        $data_partners = Partner::where("name", $data_user->organization)
            ->where("name_area", null)
            ->get();

        foreach ($data_partners as $data_partner) {
            $search_area = $data_partner->name ;
        }

        $perPage = 20;


        $view_maps_all = DB::table('sos_maps')
            ->where('content', "emergency_js100")
            ->latest()->paginate($perPage);

        $count_data = count($view_maps_all);

        $text_at = '@' ;

        $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();

        $average_per_minute = $this->average_per_minute($view_maps_all);

        return view('partner.js100.sos_emergency_js100', compact('data_partners' , 'view_maps_all' ,'text_at','data_time_zone','count_data' , 'average_per_minute'));
    }

    public function average_per_minute($view_maps_all)
    {

        $minute_all = 0 ;
        $count_case = 0 ;
        $data_average = [] ;

        foreach ($view_maps_all as $item) {

            if(!empty($item->created_at) && !empty($item->help_complete_time)){
                $minute_row = \Carbon\Carbon::parse($item->help_complete_time)->diffinMinutes(\Carbon\Carbon::parse($item->created_at)) ;

                $count_case = $count_case + 1 ;

            }else{
                $minute_row = 0 ;
            }

            $minute_all = $minute_all + (int)$minute_row ;

            if($count_case != 0){
              $minute_per_case = $minute_all / $count_case ;
            }else{
              $minute_per_case = 0 ;
            }

        }

        if (!empty($minute_per_case)) {
            //  วัน
            $data_day = (int)$minute_per_case / 1440 ;
            $data_day_sp = explode("." , $data_day) ;
            $data_average['day'] = $data_day_sp[0] ;

            // ชม.
            $data_hr = (int)$minute_per_case / 60 - ($data_average['day'] * 24) ;
            $data_hr_sp = explode("." , $data_hr) ;
            $data_average['hr'] = $data_hr_sp[0] ;

            // นาที
            if (!empty($data_hr_sp[1])) {
                $data_min_1 = "0." . $data_hr_sp[1] ;
                $data_min_2 = (float)$data_min_1 * 60 ;
                $data_average['min'] = (int)$data_min_2 ;
            }else{
                $data_average['min'] = 0 ;
            }

            // เคส
            $data_average['count_case'] = $count_case ;
        }


        // echo "เวลาทั้งหมด : " . $minute_all;
        // echo "<br>";
        // echo "เคสช่วยเสร็จ : " . $count_case;
        // echo "<br>";
        // echo "นาทีเฉลี่ยต่อเคส : " . $minute_per_case;
        // echo "<br>";
        // echo "<--------------------------------->";
        // echo "<br>";

        // echo "data_average : " . $data_average['day'];
        // echo "<br>";

        // echo "data_average : " . $data_average['hr'];
        // echo "<br>";

        // echo "data_average : " . $data_average['min'];
        // echo "<br>";

        // echo "<pre>";
        // print_r($view_maps);
        // echo "<pre>";
        // exit();

        return $data_average ;
    }

    // public function sos_insurance(Request $request)
    // {
    //     $data_user = Auth::user();
    //     $data_partners = Partner::where("name", $data_user->organization)->get();

    //     $name_insurance = "2B-Green";

    //     $sos_insurance = Sos_insurance::where('insurance', $name_insurance)->get();

    //     return view('Partners_2bgreen.P_2begreen_sos_insurance', compact('datdata_partnersa_user','sos_insurance'));
    // }

    public function add_area(Request $request)
    {
        $count_position = 1 ;

        $data_user = Auth::user();
        $data_partners = Partner::where("name", $data_user->organization)
                            ->where("name_area", null)
                            ->get();

        $all_area_partners = Partner::where("name", $data_user->organization)
                            ->where("name_area", "!=" , null)
                            ->orderBy('id' , 'DESC')
                            ->get();

        $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();

        $group_line = Group_line::where('owner', null)->where('condo_id', null)->get();

        $our_line_group = Group_line::where('owner', $data_user->organization." (Partner)")->get();

        if($data_user->organization == "ชาลีกรุงเทพ"){
            return redirect('404');
        }else{
            return view('partner.service_area.partner_add_area', compact('data_partners' , 'data_time_zone' ,'group_line' ,'all_area_partners','our_line_group'));
        }
    }

    public function service_area(Request $request)
    {
        $name_area = $request->get('name_area');
        $count_position = 1 ;

        $data_user = Auth::user();
        $data_partners = Partner::where("name", $data_user->organization)
                    ->where("name_area", $name_area)
                    ->get();

        $location_array = DB::table('lat_longs')
                ->selectRaw('changwat_th')
                ->groupBy('changwat_th')
                ->orderBy('changwat_th' , 'ASC')
                ->get();


        $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();

        if (!empty($name_area)) {
            return view('partner.service_area.partner_service_area_adjustment', compact('data_partners','count_position','location_array','data_time_zone','name_area'));
        }else{
            $group_line = Group_line::where('owner', null)->where('condo_id', null)->get();
            $all_area_partners = Partner::where("name", $data_user->organization)
                            ->where("name_area", "!=" , null)
                            ->get();

            return view('partner.service_area.partner_add_area', compact('data_partners' , 'data_time_zone' ,'group_line' ,'all_area_partners'));
        }


    }

     public function service_area_pending(Request $request)
    {
        $name_area = $request->get('name_area');
        $data_user = Auth::user();
        $data_partners = Partner::where("name", $data_user->organization)
                        ->where("name_area", $name_area)
                        ->get();

        $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();

        return view('partner.service_area.partner_service_area_pending', compact('data_partners','data_time_zone','name_area'));
    }

    public function service_area_current(Request $request)
    {
        $name_area = $request->get('name_area');
        $data_user = Auth::user();
        $data_partners = Partner::where("name", $data_user->organization)
                        ->where("name_area", $name_area)
                        ->get();

        $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();

        return view('partner.service_area.partner_service_area_current', compact('data_partners','data_time_zone','name_area'));
    }

    public function sos_score_helper(Request $request)
    {
        $data_user = Auth::user();
        $data_partners = Partner::where("name", $data_user->organization)->get();
        $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();

        $user_of_partners = User::where('organization', $data_user->organization)->get();

        // echo "<pre>";
        // print_r($all_go_to_help);
        // echo "<pre>";
        // exit();

        return view('partner.sos_score_helper', compact('data_partners','data_time_zone','user_of_partners'));
    }

     public function score_helper($user_id)
    {

        $data_user = User::where('id' , $user_id)->first();

        $data_partners = Partner::where("name", $data_user->organization)
            ->where("name_area", null)
            ->get();

        foreach ($data_partners as $data_partner) {
            $search_area = $data_partner->name ;
        }
        $perPage = 20;

        $sos_all_request = Sos_map::selectRaw('count(id) as count')
            ->where('helper', "%$data_user->name%")
            ->get();

        foreach ($sos_all_request as $key) {
                $sos_all = $key->count ;
            }

        // นับจำนวนทั้งหมด
        $view_maps_all = DB::table('sos_maps')
            ->where('helper','LIKE', "%$data_user->name%")
            ->get();

        $count_data = count($view_maps_all);
        ////////

        $view_maps = Sos_map::where('helper','LIKE', "%$data_user->name%")
            ->latest()->paginate($perPage);

        $select_name_areas = DB::table('sos_maps')
            ->where('helper','LIKE', "%$data_user->name%")
            ->get();

        $text_at = '@' ;

        $data_time_zone = Time_zone::groupBy('TimeZone')->orderBy('CountryCode' , 'ASC')->get();

        $average_per_minute = $this->average_per_minute($view_maps_all);

        return view('partner.score_helper', compact('data_user' ,'data_partners','view_maps' , 'sos_all' ,'text_at','data_time_zone','count_data', 'select_name_areas' , 'average_per_minute'));
    }

    public function view_check_in(Request $request)
    {
        $perPage = 50;

        $data_user = Auth::user();
        $name_partner = $data_user->organization;

        $requestData = $request->all();
        $select_date = $request->get('select_date');
        $select_time_1 = $request->get('select_time_1');
        $select_time_2 = $request->get('select_time_2');
        $select_student_id = $request->get('select_student_id');

        $request_name_area = $request->get('name_area');
        $text_name_area = null ;

        if ($request_name_area == 'all') {
            $id_partner_name_area = $name_partner ;
            $text_name_area = "ทั้งหมด" ;

        }else{
            $data_partner_name_area = Partner::where('id' , $request_name_area)->get();
            $id_partner_name_area = $request_name_area ;
            foreach ($data_partner_name_area as $data_name_area) {
                $text_name_area = $data_name_area->name_area ;
            }

        }
        // echo "select_date >>>" . $select_date;
        // echo "<br>";
        // echo "select_time_1 >>>" . $select_time_1;
        // echo "<br>";
        // echo "select_time_2 >>>" . $select_time_2;
        // echo "<br>";

        // รหัส นศ. อย่างเดียว
        if ( !empty($select_student_id) and empty($select_time_1) and empty($select_date) ) {
            $check_in = Check_in::where('check_in_at', 'LIKE', "%$id_partner_name_area%")
                ->where('student_id','LIKE', "%$select_student_id%")
                ->latest()->paginate($perPage);
        }
        // วันที่ อย่างเดียว
        else if ( !empty($select_date) and empty($select_time_1) and empty($select_student_id) ) {
            $check_in = Check_in::where('check_in_at', 'LIKE', "%$id_partner_name_area%")
                ->whereDate('created_at', $select_date)
                ->latest()->paginate($perPage);
        }
        // วันที่ และ รหัส นศ.
        else if ( !empty($select_date) and !empty($select_student_id) and empty($select_time_1) ) {
            $check_in = Check_in::where('check_in_at', 'LIKE', "%$id_partner_name_area%")
                ->where('student_id','LIKE', "%$select_student_id%")
                ->whereDate('created_at', $select_date)
                ->latest()->paginate($perPage);
        }
        // วันที่ และ เวลา
        else if ( !empty($select_date) and !empty($select_time_1) and empty($select_student_id) ) {
            $date_and_time_1 =  $select_date . " " . $select_time_1 ;
            $date_and_time_1 = date("Y/m/d H:i" , strtotime($date_and_time_1));

            $date_and_time_2 =  $select_date . " " . $select_time_2 ;
            $date_and_time_2 = date("Y/m/d H:i" , strtotime($date_and_time_2));

            $check_in = Check_in::where('check_in_at', 'LIKE', "%$id_partner_name_area%")
                ->whereBetween('created_at', [$date_and_time_1, $date_and_time_2])
                ->latest()->paginate($perPage);
        }
        // วันที่ และ เวลา และ รหัส นศ.
        else if ( !empty($select_date) and !empty($select_time_1) and !empty($select_student_id) ) {
            $date_and_time_1 =  $select_date . " " . $select_time_1 ;
            $date_and_time_1 = date("Y/m/d H:i" , strtotime($date_and_time_1));

            $date_and_time_2 =  $select_date . " " . $select_time_2 ;
            $date_and_time_2 = date("Y/m/d H:i" , strtotime($date_and_time_2));

            $check_in = Check_in::where('check_in_at', 'LIKE', "%$id_partner_name_area%")
                ->whereBetween('created_at', [$date_and_time_1, $date_and_time_2])
                ->where('student_id','LIKE', "%$select_student_id%")
                ->latest()->paginate($perPage);
        }
        // ว่าง
        else {

            $check_in = Check_in::where('check_in_at', 'LIKE', "%$id_partner_name_area%")
                ->latest()
                ->paginate($perPage);
        }


        // ส่งค่าไปใช้งานฝนหน้า blade

        $data_name_area_all = Partner::where('name' , $name_partner)
            ->where('name_area' , '!=' , null)
            ->orderBy('name_area' , 'ASC')
            ->get();

        $data_of_check_in_ats = Partner::where('name' , $name_partner)
            ->where('name_area' , null)
            ->get();

        foreach ($data_of_check_in_ats as $data_of_check_in_at) {
            $type_partner = $data_of_check_in_at->type_partner ;
            $color_navbar = $data_of_check_in_at->color_navbar ;
        }

        $data_time_zone = Time_zone::groupBy('TimeZone')
            ->orderBy('CountryCode' , 'ASC')
            ->get();

        $diseases = Disease::where('status' , 'show')->orderBy('name' , 'ASC')->get();

        return view('check_in.index', compact('data_time_zone','check_in','name_partner','type_partner','data_name_area_all','id_partner_name_area','text_name_area','diseases','color_navbar'));
    }

    function add_new_check_in(Request $request){

        $data_user = Auth::user();
        $data_partners = Partner::where("name", $data_user->organization)
            ->where("name_area", null)
            ->get();

        foreach($data_partners as $item){
            $type_partner = $item->type_partner ;
        }

        // foreach ($data_partners as $key) {
        //     $logo_partner = $key->logo ;
        // }

        return view('check_in.add_new_check_in' , compact('type_partner'));

    }

    function gallery(Request $request){

        $data_user = Auth::user();
        $data_partners = Partner::where("name", $data_user->organization)
            ->where("name_area", null)
            ->get();

        $all_areas = Partner::where("name", $data_user->organization)
            // ->where("name_area", "!=" , null)
            ->get();

        return view('check_in.gallery', compact('all_areas'));

    }

    function dashboard_broadcast(Request $request){

        $data_user = Auth::user();

        $data_partners = Partner::where("name", $data_user->organization)
            ->where("name_area", null)
            ->first();

        $partners_id = $data_partners->id ;
        $partners_logo = $data_partners->logo ;

        $partner_premium = Partner_premium::where("id_partner",$partners_id)->first();



        // ---------------------------------------------------------------

        // $check_in_most_click_unique = Ads_content::where('id_partner',$partners_id)
        //     ->where('type_content' , 'BC_by_check_in')
        //     ->get();

        // $arr_check_in_click_unique = array() ;
        // foreach ($check_in_most_click_unique as $item ) {

        //     if(!empty($item->user_click)){
        //         $user_click = json_decode($item->user_click) ;
        //         $arr_user_click_unique = array_count_values($user_click);
        //         $count_user_click_unique = count( $arr_user_click_unique ) ;
        //     }else{
        //         $count_user_click_unique = 0 ;
        //     }

        //     $arr_check_in_click_unique[$item->id] = $count_user_click_unique;
        //     arsort($arr_check_in_click_unique);
        // }

        //     exit();

        return view( 'partner.broadcast.dashboard', compact('partners_id','partner_premium') );
    }

    function content_broadcast(Request $request){

        $BC_By = $request->get('By');
        $data_user = Auth::user();

        $data_partners = Partner::where("name", $data_user->organization)
            ->where("name_area", null)
            ->first();

        $partners_id = $data_partners->id ;
        $partners_logo = $data_partners->logo ;

        $partner_premium = Partner_premium::where("id_partner",$partners_id)->first();

        if (!empty($partner_premium)) {
            $id_partner = $partner_premium->id_partner ;
            $name_partner = $partner_premium->name_partner ;

            // CAR
            $BC_by_car_max = $partner_premium->BC_by_car_max ;
            if ($partner_premium->BC_by_car_max == null) {
                $BC_by_car_sent = 0 ;
            }else{
                $BC_by_car_sent = $partner_premium->BC_by_car_sent ;
            }

            // CHECK IN
            $BC_by_check_in_max = $partner_premium->BC_by_check_in_max ;
            if ($partner_premium->BC_by_check_in_max == null) {
                $BC_by_check_in_sent = 0 ;
            }else{
                $BC_by_check_in_sent = $partner_premium->BC_by_check_in_sent ;
            }

            // USER
            $BC_by_user_max = $partner_premium->BC_by_user_max ;
            if ($partner_premium->BC_by_user_max == null) {
                $BC_by_user_sent = 0 ;
            }else{
                $BC_by_user_sent = $partner_premium->BC_by_user_sent ;
            }


            if (!empty($BC_By)) {
                $ads_contents = Ads_content::where('id_partner' , $id_partner)
                    ->where('type_content' , $BC_By)
                    ->orderBy('created_at', 'asc')
                    ->get();
            }else{
                $ads_contents = Ads_content::where('id_partner' , $id_partner)->orderBy('created_at', 'asc')->get();
            }
            // --------------------------------------------------------------------
            // foreach($ads_contents as $item){

            //     if!empty($item->show_user)){
            //         $show_user = json_decode($item->show_user) ;
            //         $count_show_user = count($show_user) ;
            //         $count_show_user_unique = count( array_count_values($show_user) ) ;

            //         echo "<h2>show_user</h2>";

            //         echo "<pre>";
            //         print_r($show_user);
            //         echo "<pre>";

            //         echo "<br>";
            //         echo "แสดงผลต่อผู้ใช้ทั้งหมด >> " . $count_show_user . " ครั้ง    OK";
            //         echo "<br>";
            //         echo "แสดงผลต่อผู้ใช้แบบไม่ซ้ำคน >> " . $count_show_user_unique . " คน    OK";
            //         echo "<br>";

            //         echo "<br>";
            //         echo "-------------------------------------------------------";
            //         echo "<br>";
            //     }else{
            //         $count_show_user = '0' ;
            //     }

            //     if(!empty($item->user_click)){
            //         $user_click = json_decode($item->user_click) ;
            //         $count_user_click = count($user_click) ;
            //         $arr_user_click_unique = array_count_values($user_click);
            //         $count_user_click_unique = count( $arr_user_click_unique ) ;

            //         echo "<h2>user_click</h2>";

            //         echo "<pre>";
            //         print_r($user_click);
            //         echo "<pre>";

            //         echo "<pre>";
            //         print_r( array_count_values($user_click) );
            //         echo "<pre>";

            //         $count_Repeated_users = 0 ;
            //         $click_max = 0 ;
            //         foreach ($arr_user_click_unique as $key => $value) {
            //             echo "<br>";
            //             echo $key . " >> " . $value;

            //             if ($value > 1) {
            //                 $count_Repeated_users = $count_Repeated_users + 1 ;
            //             }
            //             if ($value > $click_max) {
            //                 $click_max = $value ;
            //             }

            //         }

            //         echo "<br>";
            //         echo "การคลิกทั้งหมด >> " . $count_user_click . " ครั้ง    OK";
            //         echo "<br>";
            //         echo "การคลิกแบบไม่ซ้ำคน >> " . $count_user_click_unique . " คน    OK";
            //         echo "<br>";
            //         echo "ผู้ที่คลิกซ้ำ >> " . $count_Repeated_users . " คน";
            //         echo "<br>";
            //         echo "จำนวนที่คลิกซ้ำมากที่สุดต่อ 1 คน >> " . $click_max . " ครั้ง";
            //         echo "<br>";

            //         echo "<br>";
            //         echo "-------------------------------------------------------";
            //         echo "<br>";
            //     }else{
            //         $count_user_click = '0' ;
            //     }


            //     echo "<br>";
            //     echo "<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
            //     echo "<br>";
            // }

            // exit();
            // ---------------------------------------------------------------------

            return view('partner.broadcast.content_broadcast', compact(
                'BC_by_car_max','BC_by_car_sent','name_partner' , 'id_partner','ads_contents','BC_by_check_in_max','BC_by_check_in_sent','BC_by_user_max','BC_by_user_sent','partner_premium','BC_By'
            ));
        }else{
            return redirect('404');
        }
    }

    function broadcast_by_check_in(Request $request){

        $data_user = Auth::user();

        $data_partners = Partner::where("name", $data_user->organization)
            ->where("name_area", null)
            ->first();

        $all_area_partners = Partner::where("name", $data_partners->name)
            ->where("name_area", "!=", "")
            ->get();

        $partners_id = $data_partners->id ;
        $partners_logo = $data_partners->logo ;

        $partner_premium = Partner_premium::where("id_partner",$partners_id)->first();

        if (!empty($partner_premium)) {
            $BC_by_check_in_max = $partner_premium->BC_by_check_in_max ;
            $name_partner = $partner_premium->name_partner ;
            $partner_id = $partner_premium->id_partner ;

            $check_in = Check_in::where('check_in_at', 'LIKE', "%$name_partner%")
                ->groupBy('user_id')
                ->get();

            if ($partner_premium->BC_by_check_in_max == null) {
                $BC_by_check_in_sent = 0 ;
            }else{
                $BC_by_check_in_sent = $partner_premium->BC_by_check_in_sent ;
            }

            $ads_contents = Ads_content::where('id_partner' , $partner_id)->where('type_content' , 'BC_by_check_in')->get();

            return view('partner.broadcast.broadcast_by_check_in', compact('BC_by_check_in_max','BC_by_check_in_sent','name_partner' , 'partner_id','ads_contents','check_in','all_area_partners'));
        }else{
            return redirect('404');
        }
    }

    function broadcast_by_user(Request $request){

        $data_auth_user = Auth::user();


        // หา ประเทศของคนใน องค์กร
        $country_all_of_user = User::where('organization',$data_auth_user->organization)
            ->orWhere('user_from','LIKE',"%$data_auth_user->user_from%")
            ->where('country','!=',null)
            ->where('country','!=',"")
            ->groupBy('country')
            ->get('country');

        // หา nationalitie ของคนใน องค์กร
        $nationalitie_all_of_user = User::where('nationalitie','!=',null)
            ->where('organization',$data_auth_user->organization)
            ->orWhere('user_from','LIKE',"%$data_auth_user->user_from%")
            ->groupBy('nationalitie')
            ->select('nationalitie')
            ->get();

        // หา language ของคนใน องค์กร
        $language_all_of_user = User::where('language','!=',null)
        ->where('organization',$data_auth_user->organization)
        ->orWhere('user_from','LIKE',"%$data_auth_user->user_from%")
        ->groupBy('language')
        ->select('language')
        ->get();

        // หา time_zone ของคนใน องค์กร
        $time_zone_all_of_user = User::where('time_zone','!=',null)
        ->where('organization',$data_auth_user->organization)
        ->orWhere('user_from','LIKE',"%$data_auth_user->user_from%")
        ->groupBy('time_zone')
        ->select('time_zone')
            ->get();

        $data_partner = Partner::where("name", $data_auth_user->organization)
            ->where("name_area", null)
            ->first();


        $partner_premium = Partner_premium::where("name_partner",$data_partner->name)->first();

        $BC_by_user_max = $partner_premium->BC_by_user_max ;
        if(!empty($partner_premium)){
            // USER
            $BC_by_user_max = $partner_premium->BC_by_user_max ;
            $name_partner = $partner_premium->name_partner ;
            $partner_id = $partner_premium->id_partner ;

            if ($partner_premium->BC_by_user_max == null) {
                $BC_by_user_sent = 0 ;
            }else{
                $BC_by_user_sent = $partner_premium->BC_by_user_sent ;
            }

            $ads_contents = Ads_content::where('name_partner' , $data_partner->name)->where('type_content' , 'BC_by_user')->get();

            // broadcast ที่ส่งหาผู้ใช้แบบไม่ซ้ำ
            for ($i=0; $i < count($ads_contents); $i++) {
                if(!empty($ads_contents[$i]['show_user'])){
                    $all_Explode = json_decode($ads_contents[$i]['show_user']);

                    $counts = array_count_values($all_Explode); // นับโดยสนคนซ้ำ
                    $all_counts = 0;
                    foreach ($counts as $key) {
                        $all_counts++;
                    }

                    $ads_contents[$i]['count_show_user'] = $all_counts; // ส่งหาผู้ใช้แบบไม่ซ้ำทั้งหมด
                }else{
                    $ads_contents[$i]['count_show_user'] = 0;
                }
            }

            // broadcast ที่มีคนดู
            for ($i=0; $i < count($ads_contents); $i++) {
                if(!empty($ads_contents[$i]['user_click'])){
                    $user_click_Explode = json_decode($ads_contents[$i]['user_click']);

                    $counts_amount_user_click = count($user_click_Explode); // จำนวนคนคลิ๊ก โดยไม่สนคนซ้ำ

                    $count_user_click = array_count_values($user_click_Explode); // จำนวนคนคลิ๊ก โดยสนคนซ้ำ
                    $user_click = 0;
                    foreach ($count_user_click as $key) {
                        $user_click++;
                    }

                    $ads_contents[$i]['count_user_click'] = $user_click;  // จำนวนคนคลิ๊ก แบบไม่รวมคนซ้ำ
                    $ads_contents[$i]['count_amount_user_click'] = $counts_amount_user_click; // จำนวนคนคลิ๊ก แบบรวมคนซ้ำ
                }else{
                    $ads_contents[$i]['count_user_click'] = 0;
                    $ads_contents[$i]['count_amount_user_click'] = 0;
                }
            }

            // ยังไม่ได้ใช้
            $data_users_organization = User::where("organization", $data_partner->name)->get();
            $data_user_from = User::where("user_from", 'LIKE' , "%$data_partner->name%")->get();

            return view('partner.broadcast.broadcast_by_user', compact('partner_id','name_partner','ads_contents','data_partner','data_users_organization','data_user_from'
            ,'country_all_of_user','time_zone_all_of_user','language_all_of_user','nationalitie_all_of_user','BC_by_user_sent','BC_by_user_max'));
        }else{
            return redirect('404');

        }


    }

    function broadcast_by_sos(Request $request){

        $data_auth_user = Auth::user();

        // หา name_area ใน sos_maps
        $name_area_sos = Sos_map::where('area',$data_auth_user->organization)
            ->where('name_area','!=',null)
            ->where('name_area','!=',"")
            ->groupBy('name_area')
            ->get('name_area');

        // หา title ใน sos_map_title -------------------------------------------
        $title_sos_arr = [];
        $title_sos_1 = Sos_map_title::where('name_partner',$data_auth_user->organization)
            ->where('status',"active")
            ->get('title');

            foreach ($title_sos_1 as $key1) {
                $title_sos_arr[] = $key1->title;
            }
        // จบ title ใน sos_map_title --------------------------------------------

        // หา ประเทศของคนใน องค์กร
        $country_all_of_user = User::where('organization',$data_auth_user->organization)
            ->orWhere('user_from','LIKE',"%$data_auth_user->user_from%")
            ->where('country','!=',null)
            ->where('country','!=',"")
            ->groupBy('country')
            ->get('country');

        // หา nationalitie ของคนใน องค์กร
        $nationalitie_all_of_user = User::where('nationalitie','!=',null)
            ->where('organization',$data_auth_user->organization)
            ->orWhere('user_from','LIKE',"%$data_auth_user->user_from%")
            ->groupBy('nationalitie')
            ->select('nationalitie')
            ->get();

        // หา language ของคนใน องค์กร
        $language_all_of_user = User::where('language','!=',null)
            ->where('organization',$data_auth_user->organization)
            ->orWhere('user_from','LIKE',"%$data_auth_user->user_from%")
            ->groupBy('language')
            ->select('language')
            ->get();

        // หา time_zone ของคนใน องค์กร
        $time_zone_all_of_user = User::where('time_zone','!=',null)
            ->where('organization',$data_auth_user->organization)
            ->orWhere('user_from','LIKE',"%$data_auth_user->user_from%")
            ->groupBy('time_zone')
            ->select('time_zone')
            ->get();

        $data_partner = Partner::where("name", $data_auth_user->organization)
            ->where("name_area", null)
            ->first();

        $partner_premium = Partner_premium::where("name_partner",$data_partner->name)->first();

        $BC_by_sos_max = $partner_premium->BC_by_sos_max ;
        if(!empty($partner_premium)){
            // USER
            $BC_by_sos_max = $partner_premium->BC_by_sos_max ;
            $name_partner = $partner_premium->name_partner ;
            $partner_id = $partner_premium->id_partner ;

            if ($partner_premium->BC_by_sos_max == null) {
                $BC_by_sos_sent = 0 ;
            }else{
                $BC_by_sos_sent = $partner_premium->BC_by_sos_sent ;
            }

            $ads_contents = Ads_content::where('name_partner' , $data_partner->name)->where('type_content' , 'BC_by_sos')->get();

            // broadcast ที่ส่งหาผู้ใช้แบบไม่ซ้ำ
            for ($i=0; $i < count($ads_contents); $i++) {
                if(!empty($ads_contents[$i]['show_user'])){
                    $all_Explode = json_decode($ads_contents[$i]['show_user']);

                    $counts = array_count_values($all_Explode); // นับโดยสนคนซ้ำ
                    $all_counts = 0;
                    foreach ($counts as $key) {
                        $all_counts++;
                    }

                    $ads_contents[$i]['count_show_user'] = $all_counts; // ส่งหาผู้ใช้แบบไม่ซ้ำทั้งหมด
                }else{
                    $ads_contents[$i]['count_show_user'] = 0;
                }
            }

            // broadcast ที่มีคนดู
            for ($i=0; $i < count($ads_contents); $i++) {
                if(!empty($ads_contents[$i]['user_click'])){
                    $user_click_Explode = json_decode($ads_contents[$i]['user_click']);

                    $counts_amount_user_click = count($user_click_Explode); // จำนวนคนคลิ๊ก โดยไม่สนคนซ้ำ

                    $count_user_click = array_count_values($user_click_Explode); // จำนวนคนคลิ๊ก โดยสนคนซ้ำ
                    $user_click = 0;
                    foreach ($count_user_click as $key) {
                        $user_click++;
                    }

                    $ads_contents[$i]['count_user_click'] = $user_click;  // จำนวนคนคลิ๊ก แบบไม่รวมคนซ้ำ
                    $ads_contents[$i]['count_amount_user_click'] = $counts_amount_user_click; // จำนวนคนคลิ๊ก แบบรวมคนซ้ำ
                }else{
                    $ads_contents[$i]['count_user_click'] = 0;
                    $ads_contents[$i]['count_amount_user_click'] = 0;
                }
            }

            $data_sos = Sos_map::where('area' , $data_partner->name)->get();
            $data_user_from_sos = [];

            for ($a=0; $a < count($data_sos); $a++) {
                $data_user_from_sos[] = User::where('id',$data_sos[$a]['user_id'])->first();
            }

            // ยังไม่ได้ใช้
            $data_users_organization = User::where("organization", $data_partner->name)->get();
            $data_user_from = User::where("user_from", 'LIKE' , "%$data_partner->name%")->get();

            return view('partner.broadcast.broadcast_by_sos', compact('ads_contents','title_sos_arr','name_area_sos','data_user_from_sos','name_partner','partner_id','BC_by_sos_max','BC_by_sos_sent','country_all_of_user','time_zone_all_of_user','language_all_of_user','nationalitie_all_of_user'));
        }else{
            return redirect('404');

        }

    }

    function broadcast_by_car(Request $request){

        $requestData = $request->all();
        $data_user = Auth::user();

        $location_user = Register_car::select('location')
            ->orderBy('location')
            ->where('brand', "!=" , null )
            ->where('generation', "!=" , null )
            ->where('location', "!=" , null )
            ->where('location', "!=" , "-" )
            ->groupBy('location')
            ->get();

        $province_registration = Register_car::select('province')
            ->orderBy('province')
            ->where('brand', "!=" , null )
            ->where('generation', "!=" , null )
            ->where('province', "!=" , null )
            ->groupBy('province')
            ->get();

        $type_registrations = Register_car::select('type_car_registration as type_reg')
            ->orderBy('type_car_registration')
            ->where('type_car_registration', "!=" , "รถจักรยานยนต์" )
            ->where('type_car_registration', "!=" , null )
            ->where('type_car_registration', "!=" , "-" )
            ->groupBy('type_car_registration')
            ->get();

        $data_partners = Partner::where("name", $data_user->organization)
            ->where("name_area", null)
            ->first();

        $partners_id = $data_partners->id ;
        $partners_logo = $data_partners->logo ;

        $partner_premium = Partner_premium::where("id_partner",$partners_id)->first();

        if (!empty($partner_premium)) {
            $BC_by_car_max = $partner_premium->BC_by_car_max ;
            $name_partner = $partner_premium->name_partner ;
            $id_partner = $partner_premium->id_partner ;

            if ($partner_premium->BC_by_car_max == null) {
                $BC_by_car_sent = 0 ;
            }else{
                $BC_by_car_sent = $partner_premium->BC_by_car_sent ;
            }

            $ads_contents = Ads_content::where('id_partner' , $id_partner)->where('type_content' , 'BC_by_car')->get();

            return view('partner.broadcast.broadcast_by_car', compact('location_user','province_registration' , 'type_registrations' ,'BC_by_car_max','BC_by_car_sent','name_partner' , 'id_partner','ads_contents'));
        }else{
            return redirect('404');
        }
    }

    function select_content_broadcast(Request $request,$type_content,$name_partner){
        // $type_content = $request->get('type');
        // $name_partner = $request->get('name_partner');

        if (!empty($type_content) && $type_content !== "All") {
            $ads_contents = Ads_content::where('name_partner' , $name_partner)
                ->where('type_content' , $type_content)
                ->orderBy('created_at', 'desc')
                ->get();

            for ($i=0; $i < count($ads_contents); $i++) {
                if(!empty($ads_contents[$i]['show_user'])){
                    $all_by_checkin_Explode = json_decode($ads_contents[$i]['show_user']);

                    $counts_show_user = count($all_by_checkin_Explode); // นับโดยไม่สนคนซ้ำ

                    $counts = array_count_values($all_by_checkin_Explode);// นับโดยสนคนซ้ำ
                    $all_by_checkin_counts = 0;
                    foreach ($counts as $key) {
                        $all_by_checkin_counts++;
                    }

                    $ads_contents[$i]['count_show_user'] = $all_by_checkin_counts; // ส่งหาผู้ใช้แบบไม่ซ้ำ เฉพาะ by_checkin
                    $ads_contents[$i]['count_amount_show_user'] = $counts_show_user; // จำนวนผู้ใช้ที่คลิ๊ก เฉพาะ by_checkin

                }else{
                    $ads_contents[$i]['count_show_user'] = 0;
                    $ads_contents[$i]['count_amount_show_user'] = 0; // จำนวนผู้ใช้ที่คลิ๊ก เฉพาะ by_checkin
                }

            }

            for ($i=0; $i < count($ads_contents); $i++) {

                if(!empty($ads_contents[$i]['user_click'])){
                    $user_click_Explode = json_decode($ads_contents[$i]['user_click']);

                    $counts_by_checkin_user_click = count($user_click_Explode); // นับโดยไม่สนคนซ้ำ

                    $count_user_click = array_count_values($user_click_Explode); // นับโดยสนคนซ้ำ
                    $checkin_user_click = 0;

                    $count_Repeated_users = 0 ; // นับจำนวนคนซ้ำ
                    $click_max = 0 ; // นับจำนวนคลิ๊กของคนซ้ำ ที่คลิ๊กมากที่สุด

                    foreach ($count_user_click as $key => $value) {
                        $checkin_user_click++;

                        if ($value > 1) {
                            $count_Repeated_users = $count_Repeated_users + 1 ;
                        }
                        if ($value > $click_max) {
                            $click_max = $value ;
                        }
                    }

                    $ads_contents[$i]['count_user_click'] = $checkin_user_click; // จำนวนผู้ใช้ที่คลิ๊กแบบไม่ซ้ำ เฉพาะ by_checkin
                    $ads_contents[$i]['count_amount_user_click'] = $counts_by_checkin_user_click; // จำนวนผู้ใช้ที่คลิ๊ก เฉพาะ by_checkin
                    $ads_contents[$i]['count_Repeated_users'] = $count_Repeated_users; // จำนวนคนซ้ำ
                    $ads_contents[$i]['click_max'] = $click_max; // จำนวนคลิ๊กของคนซ้ำ ที่คลิ๊กมากที่สุด
                }else{
                    $ads_contents[$i]['count_user_click'] = 0;
                    $ads_contents[$i]['count_amount_user_click'] = 0;
                    $ads_contents[$i]['count_Repeated_users'] = 0; // จำนวนคนซ้ำ
                    $ads_contents[$i]['click_max'] = 0; // จำนวนคลิ๊กของคนซ้ำ ที่คลิ๊กมากที่สุด
                }

            }
        }else{
            $ads_contents = Ads_content::where('name_partner' , $name_partner)
            ->orderBy('created_at', 'desc')
            ->get();

            for ($i=0; $i < count($ads_contents); $i++) {
                if(!empty($ads_contents[$i]['show_user'])){
                    $all_by_checkin_Explode = json_decode($ads_contents[$i]['show_user']);

                    $counts_show_user = count($all_by_checkin_Explode); // นับโดยไม่สนคนซ้ำ

                    $counts = array_count_values($all_by_checkin_Explode);// นับโดยสนคนซ้ำ
                    $all_by_checkin_counts = 0;
                    foreach ($counts as $key) {
                        $all_by_checkin_counts++;
                    }

                    $ads_contents[$i]['count_show_user'] = $all_by_checkin_counts; // ส่งหาผู้ใช้แบบไม่ซ้ำ เฉพาะ by_checkin
                    $ads_contents[$i]['count_amount_show_user'] = $counts_show_user; // จำนวนผู้ใช้ที่คลิ๊ก เฉพาะ by_checkin

                }else{
                    $ads_contents[$i]['count_show_user'] = 0;
                    $ads_contents[$i]['count_amount_show_user'] = 0; // จำนวนผู้ใช้ที่คลิ๊ก เฉพาะ by_checkin
                }

            }

            for ($i=0; $i < count($ads_contents); $i++) {

                if(!empty($ads_contents[$i]['user_click'])){
                    $user_click_Explode = json_decode($ads_contents[$i]['user_click']);

                    $counts_by_checkin_user_click = count($user_click_Explode); // นับโดยไม่สนคนซ้ำ

                    $count_user_click = array_count_values($user_click_Explode); // นับโดยสนคนซ้ำ
                    $checkin_user_click = 0;

                    $count_Repeated_users = 0 ; // นับจำนวนคนซ้ำ
                    $click_max = 0 ; // นับจำนวนคลิ๊กของคนซ้ำ ที่คลิ๊กมากที่สุด

                    foreach ($count_user_click as $key => $value) {
                        $checkin_user_click++;

                        if ($value > 1) {
                            $count_Repeated_users = $count_Repeated_users + 1 ;
                        }
                        if ($value > $click_max) {
                            $click_max = $value ;
                        }
                    }

                    $ads_contents[$i]['count_user_click'] = $checkin_user_click; // จำนวนผู้ใช้ที่คลิ๊กแบบไม่ซ้ำ เฉพาะ by_checkin
                    $ads_contents[$i]['count_amount_user_click'] = $counts_by_checkin_user_click; // จำนวนผู้ใช้ที่คลิ๊ก เฉพาะ by_checkin
                    $ads_contents[$i]['count_Repeated_users'] = $count_Repeated_users; // จำนวนคนซ้ำ
                    $ads_contents[$i]['click_max'] = $click_max; // จำนวนคลิ๊กของคนซ้ำ ที่คลิ๊กมากที่สุด
                }else{
                    $ads_contents[$i]['count_user_click'] = 0;
                    $ads_contents[$i]['count_amount_user_click'] = 0;
                    $ads_contents[$i]['count_Repeated_users'] = 0; // จำนวนคนซ้ำ
                    $ads_contents[$i]['click_max'] = 0; // จำนวนคลิ๊กของคนซ้ำ ที่คลิ๊กมากที่สุด
                }

            }
        }

        return $ads_contents;
    }

    function check_user_from($name_partner){
        // $users = User::where('user_from', 'LIKE', "%$name_partner%")->get();

        return view('check_user_from', compact('name_partner'));
    }

    function get_data_check_user_from($name_partner){
        $users = User::where('user_from', 'LIKE', "%$name_partner%")
            ->select(
                'name',
                'email',
                'created_at',
                'phone',
                'status',
            )
            ->get();

        return $users;
    }

}
