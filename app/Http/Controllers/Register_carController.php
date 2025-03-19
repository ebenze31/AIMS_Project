<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Organization;
use App\Models\Insurance;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;
use App\CarModel;
use App\county;
use App\User;
use App\Models\Register_car;
use Illuminate\Http\Request;
use Auth;

class Register_carController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $type_car = $request->get('type');

            if (empty($type_car)) {
                $type_car = "all";
            }

        if ($type_car == 'all') {
            $register_car = DB::table('register_cars')
                ->where('user_id', $user->id)
                ->where('juristicNameTH', null)
                ->where('active', "Yes")
                ->get();
        }else{
            $register_car = DB::table('register_cars')
                ->where('user_id', $user->id)
                ->where('juristicNameTH', null)
                ->where('car_type', $type_car)
                ->where('active', "Yes")
                ->get();
        }

        $organization = "";
        if (!empty($user['organization'])) {
            $organization = Organization::where('juristicNameTH', $user['organization'] )->get();
        }

        // เวลาปัจจุบัน
        $date_now = date("Y-m-d "); 

        return view('register_car.index', compact('register_car' , 'date_now' ,'type_car','organization'));
    }

    public function index_organization(Request $request)
    {
        $user = Auth::user();

        $type_car = $request->get('type');

            if (empty($type_car)) {
                $type_car = "all";
            }

        $organization = $user->organization;

        if (!empty($organization)) {
            $organizations = Partner::where('name', $organization )->where('name_area' , null)->get();
                foreach ($organizations as $key ) {
                    $juristicNameTH = $key->name;
                    $logo = $key->logo ;
                    $name_organizations = $key->name ;
                }
        }

        if ($type_car == 'all') {
            $register_car = DB::table('register_cars')
                    ->where('user_id', $user->id)
                    ->where('juristicNameTH', $user['organization'])
                    ->where('active', "Yes")
                    ->get();
        }else{
            $register_car = DB::table('register_cars')
                    ->where('user_id', $user->id)
                    ->where('juristicNameTH', $user['organization'])
                    ->where('active', "Yes")
                    ->where('car_type', $type_car)
                    ->get();
        }

        $data_all_organization = Partner::where('name_area' , null )->get();

        // เวลาปัจจุบัน
        $date_now = date("Y-m-d "); 

        return view('register_car.index_organization', compact('register_car' , 'date_now' ,'type_car','organization','juristicNameTH' , 'logo' ,'data_all_organization','name_organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $type_reg = "" ;
        $type_reg_q = $request->get('type_reg');

        if (!empty($type_reg_q)) {
            $type_reg = $type_reg_q ;
        }

        $user = Auth::user();

        $organization = $user->organization;

        $data_partners = Partner::where('name_area', null )->where('name' , $organization)->get();
        $all_partners = Partner::where('name_area', null )->orderBy('full_name', 'ASC')->get();
        $location_array = county::selectRaw('province')
            ->groupBy('province')
            ->get();

        $car_brand = CarModel::selectRaw('brand,count(brand) as count')
            ->orderByRaw('count DESC')
            ->where('brand', '!=',"" )
            ->groupBy('brand')
            ->limit(10)
            ->get();
        
        $type_array = CarModel::selectRaw('type,count(type) as count')
            ->orderByRaw('count DESC')
            ->where('type', '!=',"" )
            ->groupBy('type')
            ->limit(10)
            ->get();

        $car = Register_car::select('brand', 'generation', 'registration_number', 'province')
            ->where('user_id', $user->id)
            ->where('car_type', 'car')
            ->get();

        $motorcycle = Register_car::select('brand', 'generation', 'registration_number', 'province')
            ->where('user_id', $user->id)
            ->where('car_type', 'motorcycle')
            ->get();

        $name_insurance = Insurance::where('company', '!=',"" )
            ->groupBy('company')
            ->orderBy('company')
            ->get();

        // echo "<pre>";
        // print_r($name_insurance);
        // echo "</pre>";
        // exit();

        return view('register_car.create', compact('location_array', 'car_brand', 'user', 'car', 'motorcycle','type_array' , 'organization','name_insurance','data_partners', 'all_partners','type_reg'));
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

        // echo "<pre>";
        // print_r($requestData);
        // echo "<pre>";
        // exit();

        // update registration_number
        $requestData['registration_number'] = str_replace(" ", "", $requestData['registration_number']);
        // rebrand
        $motor_brand = $requestData['motor_brand'];
        $motor_generation = $requestData['motor_generation'];

        $brand_other = $requestData['brand_other'];
        $generation_other = $requestData['generation_other'];
        $generation = $requestData['generation'];
        $brand = $requestData['brand'];
        $car_type = $requestData['car_type'];

        switch ($car_type) {

            case 'car':
                if ($brand != 'อื่นๆ') {
                    $requestData['motor_brand'] = null;
                    $requestData['motor_generation'] = null;
                }
                if ($brand != 'อื่นๆ' && $generation == 'อื่นๆ') {
                    $requestData['motor_brand'] = null;
                    $requestData['motor_generation'] = null;
                    $requestData['generation'] = $generation_other;
                }
                if ($brand == 'อื่นๆ') {
                    $requestData['motor_brand'] = null;
                    $requestData['motor_generation'] = null;
                    $requestData['generation'] = $brand_other;
                    $requestData['brand'] = $generation_other;
                }

                break;

            case 'motorcycle':
                if ($motor_brand != 'อื่นๆ') {
                    $requestData['brand'] = $motor_brand;
                    $requestData['generation'] = $motor_generation;
                }
                if ($motor_brand != 'อื่นๆ' && $motor_generation == 'อื่นๆ') {
                    $requestData['brand'] = $motor_brand;
                    $requestData['generation'] = str_replace("อื่นๆ", $generation_other, $requestData['generation']);
                }
                if ($motor_brand == 'อื่นๆ') {
                    $requestData['brand'] = $brand_other;
                    $requestData['generation'] = $generation_other;
                }

                break;

            case 'other':
                $requestData['brand'] = $brand_other;
                $requestData['generation'] = $generation_other;

                break;

        }

        if (!empty($requestData['juristicID'])) {

            DB::table('organizations')
                ->where('juristicNameTH', $requestData['juristicNameTH'])
                ->update([
                    'mail' => $requestData['organization_mail'],
                    'phone' => $requestData['phone_2'],
                ]);

            // $juristicData['juristicID'] = $requestData['juristicID'];
            // $juristicData['juristicNameTH'] = $requestData['juristicNameTH'];
            // $juristicData['mail'] = $requestData['organization_mail'];
            // $juristicData['province'] = $requestData['location_P_2'];
            // $juristicData['district'] = $requestData['location_A_2'];
            // $juristicData['phone'] = $requestData['phone_2'];

            // Organization::firstOrCreate($juristicData);
        }

        $requestData['location_A_2'] = "" ;
        $requestData['location_P_2'] = "" ;

        $requestData['branch'] = null ;
        $requestData['branch_district'] = null ;
        $requestData['branch_province'] = null ;

        // echo "<pre>";
        // print_r($requestData);
        // echo "</pre>";
        // exit();
        if (empty(Auth::user()->location_P)) {
            
            DB::table('users')
                ->where('id', $requestData['user_id'])
                ->update([
                    'location_P' => $requestData['location_P'],
                    'location_A' => $requestData['location_A'],
                    'phone' => $requestData['phone'],
                    'organization' => $requestData['juristicNameTH'],
                    'brith' => $requestData['brith'],
                ]);
        }
        if (!empty(Auth::user()->location_P) and empty(Auth::user()->organization)) {
            
            DB::table('users')
                ->where('id', $requestData['user_id'])
                ->update([
                    'organization' => $requestData['juristicNameTH'],
                ]);
        }

        if (!empty($requestData['name_insurance_another'])) {
        
            $requestData['name_insurance'] = $requestData['name_insurance_another'];
        }

        if ($requestData['check_reg'] == "1") {
            $requestData['juristicNameTH'] = null ;
            $requestData['organization_mail'] = null ;
            $requestData['branch'] = null ;
        }

        $registration =  $requestData['registration_number'];
        $text_registration = preg_replace('/[0-9]+/', '', $registration);

        $count_sp_text = $this->utf8_strlen($text_registration);

        if ($requestData['car_type'] == "car") {
            $requestData['type_car_registration'] = $this->check_type_car_registration($text_registration);
        }elseif($requestData['car_type'] == "motorcycle"){
            $requestData['type_car_registration'] = "รถจักรยานยนต์" ;
        }else{
            $requestData['type_car_registration'] = "รถประเภทอื่นๆ" ;
        }

        Register_car::create($requestData);

        // return view('register_car.select_get')->with('flash_message', 'Register_car added!');
        return redirect('/select_get_login?openExternalBrowser=1');
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
        $user_id = Auth::id();
        // ตรวจสอบว่าใช่เจ้าของรถหรือไม่
        $check_car_user = Register_car::where('user_id',$user_id )->where('id',$id )->get();

        foreach ($check_car_user as $key ) {
            $name = $key->name ;
        }
        if (empty($name)) {

             return view('404');

        }else{

            $register_car = Register_car::findOrFail($id);

            $location_array = county::selectRaw('province')
                ->where('province', '!=',"" )
                ->groupBy('province')
                ->get();
            $type_array = CarModel::selectRaw('type,count(type) as count')
                ->orderByRaw('count DESC')
                ->where('type', '!=',"" )
                ->groupBy('type')
                ->limit(10)
                ->get();

            return view('register_car.show', compact('register_car','location_array','type_array'));
        }
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
        $user_id = Auth::id();
        // ตรวจสอบว่าใช่เจ้าของรถหรือไม่
        $check_car_user = Register_car::where('user_id',$user_id )->where('id',$id )->get();

        foreach ($check_car_user as $key ) {
            $name = $key->name ;
        }
        if (empty($name)) {

             return view('/errors/404');

        }else{

            $register_car = Register_car::findOrFail($id);

            $location_array = county::selectRaw('province')
                ->groupBy('province')
                ->get();

            $data_car_old = Register_car::where('id',$id )->get();

            foreach ($data_car_old as $item) {
                $car_type_old =  $item->car_type;
                $brand_old  = $item->brand;
                $generation_old  = $item->generation;
                $province_old  =  $item->province;
                $name_insurance_old  =  $item->name_insurance;

                $juristicNameTH = $item->juristicNameTH;
                $juristicMail = $item->organization_mail ;
                $juristicProvince = $item->branch_province ;
                $juristicDistrict = $item->branch_district ;

            }

            $juristicID = "";
            $juristicPhone = "";

            $data_juristicNameTH = Organization::where('juristicNameTH', $juristicNameTH )->get();
            foreach ($data_juristicNameTH as $key_data) {
                $juristicID = $key_data->juristicID ;
                $juristicPhone = $key_data->phone ;
            }

            $car_brand = CarModel::selectRaw('brand,count(brand) as count')
                ->orderByRaw('count DESC')
                ->where('brand', '!=',"" )
                ->groupBy('brand')
                ->limit(10)
                ->get();

            $user = Auth::user();

            $car = Register_car::select('brand', 'generation', 'registration_number', 'province')
                ->where('user_id', $user->id)
                ->where('car_type', 'car')
                ->get();

            $motorcycle = Register_car::select('brand', 'generation', 'registration_number', 'province')
                ->where('user_id', $user->id)
                ->where('car_type', 'motorcycle')
                ->get();

            $name_insurance = Insurance::where('company', '!=',"" )
                ->groupBy('company')
                ->get();

            return view('register_car.edit', compact('register_car' , 'data_car_old','location_array','car_brand','user','car','motorcycle' ,'car_type_old','brand_old','generation_old','province_old','name_insurance_old','name_insurance','juristicNameTH', 'juristicID', 'juristicMail', 'juristicPhone', 'juristicProvince', 'juristicDistrict'));
        }
    }
    public function edit_act($id)
    {
        $register_car = Register_car::findOrFail($id);

        $name_insurance = Insurance::where('company', '!=',"" )
            ->groupBy('company')
            ->orderBy('company')
            ->get();

        $data_car_old = Register_car::where('id',$id )->get();

            foreach ($data_car_old as $item) {
                $name_insurance_old  =  $item->name_insurance;

            }

        return view('register_car.edit_act', compact('register_car', 'name_insurance','name_insurance_old'));
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
        
        $register_car = Register_car::findOrFail($id);

        $register_car->update($requestData);
        
        DB::table('register_cars')
                ->where('id', $id)
                ->update(['alert_act' => null]);
        DB::table('register_cars')
                ->where('id', $id)
                ->update(['alert_insurance' => null]);

        if (!empty($register_car['juristicNameTH'])) {
            return redirect('register_car_organization')->with('flash_message', 'Register_car updated!');
        }else {
            return redirect('register_car')->with('flash_message', 'Register_car updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id , Request $request)
    {
        Register_car::destroy($id);

        $requestData = $request->all();

        if (!empty($requestData)) {
            switch ($requestData['type']) {
                case 'person':
                    return redirect('register_car')->with('flash_message', 'Register_car deleted!');
                    break;
                case 'organization':
                    return redirect('register_car_organization')->with('flash_message', 'Register_car deleted!');
                    break;
                case 'admin-partner':
                    return redirect('register_cars_partner')->with('flash_message', 'Register_car deleted!');
                    break;
                default:
                    return redirect('register_car')->with('flash_message', 'Register_car deleted!');
                    break;
            }
        }else{
            return redirect('register_car')->with('flash_message', 'Register_car deleted!');
        }
    }

    public function welcome_line()
    {
        if(Auth::check()){
            return redirect('register_car/create');
        }else{
            return redirect('/login/line?redirectTo=register_car/create');
        }
    }

    public function welcome_facebook()
    {
        if(Auth::check()){
            return redirect('register_car/create');
        }else{
            return redirect('/login/facebook?redirectTo=register_car/create');
        }
    }

    public function edit_act_login(Request $request , $car_id)
    {
        if(Auth::check()){
            return redirect('register_car/' . $car_id . '/edit_act');
        }else{
            return redirect('login/line?redirectTo=register_car/' . $car_id . '/edit_act');
        }
    }

    public function select_get()
    {
        if(Auth::check()){
            return redirect('/select_get');
        }else{
            return redirect('login/line?redirectTo=select_get');
        }
    }

    // นับตัวอักษร
    function utf8_strlen($s) {
        $c = strlen($s); $l = 0;
        for ($i = 0; $i < $c; ++$i)
            if ((ord($s[$i]) & 0xC0) != 0x80) ++$l;
        return $l;
    }

    public function check_type_car_registration($text_registration)
    {
        preg_match_all('/./u',$text_registration,$text);
        
        if (!empty($text[0][0])) {
            // echo "อักษรนำ >> " . $text[0][0];

            if ( $text[0][0] == "ก" or $text[0][0] == "ข" or $text[0][0] == "จ" or $text[0][0] == "ฉ" or $text[0][0] == "ช" or $text[0][0] == "ฌ" or $text[0][0] == "ญ" or $text[0][0] == "ฐ" or $text[0][0] == "ธ" or $text[0][0] == "พ" or $text[0][0] == "ภ" or $text[0][0] == "ษ" or $text[0][0] == "ฆ" ) {

                $type_car_registration = "รถยนต์นั่งส่วนบุคคลไม่เกิน 7 คน" ;

            }elseif ( $text[0][0] == "น" or $text[0][0] == "ฬ" or$text[0][0] == "อ" or$text[0][0] == "ฮ") {
                
                $type_car_registration = "รถยนต์นั่งส่วนบุคคลเกิน 7 คน" ;
                
            }elseif ( $text[0][0] == "ฒ" or $text[0][0] == "ณ" or $text[0][0] == "ต" or $text[0][0] == "ถ" or $text[0][0] == "บ" or $text[0][0] == "ผ" or $text[0][0] == "ย" or $text[0][0] == "ร" or $text[0][0] == "ล" ) {
                
                $type_car_registration = "รถยนต์บรรทุกส่วนบุคคล" ;
                
            }elseif ( $text[0][0] == "ศ" ) {
                
                $type_car_registration = "รถยนต์นั่งส่วนบุคคลไม่เกิน 7 คน,รถยนต์สามล้อส่วนบุคคล" ;
                
            }elseif ( $text[0][0] == "ว" ) {
                
                $type_car_registration = "รถยนต์นั่งส่วนบุคคลไม่เกิน 7 คน,รถยนต์รับจ้างระหว่างจังหวัด" ;
                
            }elseif ( $text[0][0] == "ท" or $text[0][0] == "ม" ) {
                
                $type_car_registration = "รถยนต์รับจ้างบรรทุกโดยสารไม่เกิน 7 คน (รถแท็กซี่)" ;
                
            }elseif ( $text[0][0] == "ฟ" ) {
                
                $type_car_registration = "รถยนต์สี่ล้อรับจ้างเล็ก" ;
                
            }elseif ( $text[0][0] == "ส" ) {
                
                $type_car_registration = "รถยนต์นั่งส่วนบุคคลไม่เกิน 7 คน,รถยนต์รับจ้างสามล้อ" ;
                
            }elseif ( $text[0][0] == "ฎ" ) {
                
                $type_car_registration = "รถยนต์นั่งส่วนบุคคลไม่เกิน 7 คนรถยนต์,บริการเช่า" ;
                
            }else{
                $type_car_registration = null ;
            }

        }else{
            $type_car_registration = null ;
        }

        return $type_car_registration ;
    }

}