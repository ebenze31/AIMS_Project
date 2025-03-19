<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Revolution\Line\Facades\Bot;
use Illuminate\Http\Request;
use Redirect;
use App\Http\Controllers\API\LineApiController;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
        // if(!isset($_SESSION["backurl"]) )
        //     $_SESSION["backurl"] = $_SERVER['HTTP_REFERER'] ;
        //     $backurl = $_SESSION["backurl"];
        //     // echo "backurl >> ". parse_url($backurl, PHP_URL_QUERY);
        //     // exit();

        $backurl = $_SERVER['HTTP_REFERER'] ;

        $redirectTo = parse_url($backurl, PHP_URL_QUERY);

        if (!empty($redirectTo)) {
            $backurl_split = explode('redirectTo=', $redirectTo, 2);
            $back = $backurl_split[1];
            return $back;
        }else{
            return $backurl;
        }

    }

    // protected function redirectTo()
    // {
    //     return $_SERVER['HTTP_REFERER'];
    // }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username(){
        return 'username';
    }

    // Google login
    public function redirectToGoogle(Request $request)
    {
        $request->session()->put('redirectTo', $request->get('redirectTo'));

        return Socialite::driver('google')->redirect();
    }

    // Google callback
    public function handleGoogleCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginUser($user, "google",null,null, null);

        $value = $request->session()->get('redirectTo');
        $request->session()->forget('redirectTo');

        // Return home after login
        return redirect()->intended($value);
    }

    // Facebook login
    public function redirectToFacebook(Request $request)
    {   
        return Socialite::driver('facebook')->redirect();
    }

    // Facebook callback
    public function handleFacebookCallback(Request $request)
    {
        // $user = Socialite::driver('facebook')->user();
        $user = Socialite::driver('facebook')->stateless()->user();
        // print_r($user);
        $this->_registerOrLoginUser($user,"facebook",null,null, null);

        $value = $request->session()->get('redirectTo');
        $request->session()->forget('redirectTo');

        return redirect()->intended($value);
    }

    // Line login
    public function redirectToLine(Request $request)
    {
        $request->session()->put('Student', $request->get('Student'));
        $request->session()->put('redirectTo', $request->get('redirectTo'));
        $request->session()->put('from', $request->get('from'));

        return Socialite::driver('line')->redirect();
    }

    // Line login TU
    public function redirectToLine_TU_SOS(Request $request)
    {
        $request->session()->put('Student', $request->get('Student'));
        $request->session()->put('redirectTo', 'https://www.viicheck.com/sos_map/create');

        return Socialite::driver('line')->redirect();
    }

    // Line login other_app
    public function redirectToLine_other_app_SOS(Request $request, $user_from)
    {
        $request->session()->put('from', $user_from);
        $request->session()->put('redirectTo', 'https://www.viicheck.com/sos_map/create');

        return Socialite::driver('line')->redirect();
    }

    // VOTE KAN
    public function redirectToLine_vote_kan_login(Request $request, $user_from)
    {
        $request->session()->put('from', $user_from);
        $request->session()->put('redirectTo', 'https://www.viicheck.com/vote_kan_stations/create');

        return Socialite::driver('line')->redirect();
    }
    
    // Line login kmutnbs
    public function redirectToLine_check_in(Request $request)
    {
        $request->session()->put('check_in_at', $request->get('check_in_at'));

        return Socialite::driver('line')->redirect();
    }

    // Line login API
    public function register_api(Request $request)
    {
        $requestData = $request->all();

        echo ">>> : register_api";
        echo "<br>";
        echo "<pre>";
        print_r($requestData);
        echo "<pre>";
        // exit();

        $this->redirectToLine_By_api($requestData);
    }

    public function redirectToLine_By_api($requestData)
    {   
        // $request->session()->put('redirectTo', 'https://www.viicheck.com');

        // $redirectTo = $request->session()->get('redirectTo');
        
        echo "<br>";
        echo ">>> : redirectToLine_By_api";
        echo "<br>";
        // echo $redirectTo ;
        echo "<br>";
        

        // exit(); 

        return Socialite::driver('line')->redirect();
    }

    // Line callback
    public function handleLineCallback(Request $request)
    {
        // $user = Socialite::driver('line')->user();
        $user = Socialite::driver('line')->stateless()->user();

        // try {
        //     $user = Socialite::driver('line')->user();
        // } catch (InvalidStateException $e) {
        //     $user = Socialite::driver('line')->stateless()->user();
        // }

        // echo "<pre>";
        // print_r($user);
        // echo "<pre>";
        // exit();

        $by_api = $request->session()->get('by_api');

        if (!empty($by_api)) {
            // register api

            $data_register_api = [] ;
            $data_register_api['name'] = $request->session()->get('name'); 
            $data_register_api['phone'] = $request->session()->get('phone'); 
            $data_register_api['tambon_th'] = $request->session()->get('tambon_th'); 
            $data_register_api['amphoe_th'] = $request->session()->get('amphoe_th'); 
            $data_register_api['changwat_th'] = $request->session()->get('changwat_th'); 
            $data_register_api['by_api'] = $request->session()->get('by_api'); 

            $this->_register_API($user , "line" , $data_register_api );

        }else{
            $student = $request->session()->get('Student');
            $from = $request->session()->get('from');
            $check_in_at = $request->session()->get('check_in_at');
            // register general
            $this->_registerOrLoginUser($user,"line",$student , $from , $check_in_at );
        }


        $value = $request->session()->get('redirectTo');
        $request->session()->forget('redirectTo');

        return redirect()->intended($value);

    }

    protected function _registerOrLoginUser($data, $type , $student , $from , $check_in_at)
    {
        //GET USER 
        $user = User::where('provider_id', '=', $data->id)->first();
        // print_r($data) ;

        if (!$user) {
            //CREATE NEW USER
            $user = new User();
            $user->name = $data->name;
            $user->provider_id = $data->id;
            $user->type = $type;
            $user->username = $data->name;
            $user->status = "active";

            if (!empty($data->email)) {
                $user->email = $data->email;
            }

            if (empty($data->email)) {
                $user->email = "กรุณาเพิ่มอีเมล";
            }

            // AVATAR
            if (!empty($data->avatar)) {
                $user->avatar = $data->avatar;

                $url = $data->avatar;
                $img = storage_path("app/public")."/uploads". "/" . 'photo' . $data->id . '.png';
                // Save image
                file_put_contents($img, file_get_contents($url));
                $user->photo = "uploads". "/" . 'photo' . $data->id . '.png';
            }
            else if (empty($data->avatar)) {
                $user->avatar = null;
                $user->photo = null ;
            }

            $user->save();
        }else{
            // AVATAR
            if (!empty($data->avatar)) {
                $user->avatar = $data->avatar;

                $url = $data->avatar;
                $img = storage_path("app/public")."/uploads". "/" . 'photo' . $data->id . '.png';
                // Save image
                file_put_contents($img, file_get_contents($url));
                $user->photo = "uploads". "/" . 'photo' . $data->id . '.png';
            }
            else if (empty($data->avatar)) {
                $user->avatar = null;
                $user->photo = null ;
            }
            
            DB::table('users')
                ->where('provider_id', $data->id)
                ->update([
                    'name' => $data->name,
                    'photo' => $user->photo,
                    'avatar' => $user->avatar,
                ]);
        }

        //LOGIN
        Auth::login($user);
        $data_user = Auth::user();

        DB::table('users')
            ->where('provider_id', $data->id)
            ->update([
                'status' => 'active',
            ]);

        DB::table('news')
                ->where('user_id', $data_user->id)
                ->update([
                    'active' => "Yes",
                ]);

        DB::table('register_cars')
                ->where('user_id', $data_user->id)
                ->update([
                    'active' => "Yes",
                ]);

        if ($type == "line") {

            $provider_id = $user->provider_id ;

            $data_users = DB::table('users')
                ->where('provider_id', $provider_id)
                ->get();

            $lineAPI = new LineApiController();
            $lineAPI->check_language_user($data_users);

        }

        if (!empty($student)) {
            $student_split = explode("_",$student);
            $student_name = $student_split[0];
            $student_id = $student_split[1];

            if ($student_name == "tu") {
                DB::table('d_p_tu_students')
                    ->where('student_id', $student_id)
                    ->update([
                        'status_line' => 'Yes',
                        'user_id' => $data_user->id,
                    ]);

                DB::table('users')
                    ->where('id', $data_user->id)
                    ->update([
                        'std_of' => 'TU',
                    ]);
            }

            // if ($student_name == "kmutnbs") {

            //     DB::table('users')
            //         ->where('id', $data_user->id)
            //         ->update([
            //             'std_of' => 'kmutnbs',
            //         ]);
            // }
        }

        if (!empty($from)) {

            if ($from == "line_oa") {

                DB::table('users')
                    ->where([ 
                            ['type', 'line'],
                            ['provider_id', $user->provider_id],
                        ])
                    ->update(['add_line' => 'Yes']);

            }else if($from == "re_to_line_oa"){

                DB::table('users')
                    ->where([ 
                            ['type', 'line'],
                            ['provider_id', $user->provider_id],
                        ])
                    ->update([
                        'nationalitie' => 'Thai',
                        'language' => 'th',
                    ]);

                $users_re_to_line_oa = DB::table('users')
                    ->where('provider_id', $user->provider_id)
                    ->get();

                $line_API = new LineApiController();
                $line_API->check_language_user($users_re_to_line_oa);

            }else{

                if ( !empty($data_user->user_from) ){

                    $check_user_from = explode(",",$data_user->user_from);

                    if (in_array( $from , $check_user_from )){
                        $update_user_from = $data_user->user_from ;
                    }else{
                        $update_user_from = $data_user->user_from .','. $from ;
                    }

                }else{
                    $update_user_from = $from ;
                }

                DB::table('users')
                    ->where([ 
                            ['type', 'line'],
                            ['provider_id', $user->provider_id],
                        ])
                    ->update(['user_from' => $update_user_from]);
                }
        }

    }

    protected function _register_API($data, $type , $data_register_api)
    {
        echo "_register_API" ; 
        echo "<br>" ; 

        echo "<pre>";
        print_r($data_register_api);
        echo "<pre>";

        exit();
    }
}
