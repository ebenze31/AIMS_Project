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

    // Line login
    public function redirectToLine(Request $request)
    {
        return Socialite::driver('line')->redirect();
    }

    // Line callback
    public function handleLineCallback(Request $request)
    {
        $user = Socialite::driver('line')->stateless()->user();

        // register general
        $this->_registerOrLoginUser($user, "line");

        return redirect()->intended('/');

    }

    protected function _registerOrLoginUser($data, $type)
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

        if( empty($data_user->role) ){
            DB::table('users')
                ->where('provider_id', $data->id)
                ->update([
                    'status' => 'active',
                    'role' => 'officer-area',
                ]);
        }
        else{
            DB::table('users')
                ->where('provider_id', $data->id)
                ->update([
                    'status' => 'active',
                ]);
        }

    }

}
