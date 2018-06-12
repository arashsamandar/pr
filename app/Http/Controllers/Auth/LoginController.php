<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User as User;
use App\Logs;
use Hekmatinasser\Verta\Verta as Verta;

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


    protected $redirectTo = '/home';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginshow() {
        return view('auth.login');
    }

    public function login(Request $request, Logs $logs)
    {

        $username = $request->input('username');
        $password = $request->input('password');


        $message = array(
            'username.required' => 'نام کاربری را وارد کنید',
            'password.required' => 'رمز عبور را وارد کنید'
        );


        $this->validate(
            $request,
            [
                'username' => 'required',
                'password' => 'required'
            ],$message
        );

        $myuser1 = User::where('username',$username)->first();

        if (\Auth::attempt(['username' => $username, 'password' => $password])) {

            $logdata = [];
            $v = new Verta();
            $logdata['logDate'] = $v->formatDate();
            $logdata['logTime'] = $v->formatTime();
            $logdata['user_id'] = $myuser1->id;
            $logdata['logCode'] = '001';
            $logdata['log_desc'] = 'ورود موفقیت آمیز کاربر به سیستم';
            $logdata['Reserved1'] = 'userid';
            $logdata['Reserved2'] = $myuser1->id;
            $logs->insert($logdata);
            return redirect()->intended('home');

        } elseif ( !empty($myuser1) && $myuser1->username == $username) {

            $logdata = [];
            $v = new Verta();
            $logdata['logDate'] = $v->formatDate();
            $logdata['logTime'] = $v->formatTime();
            $logdata['user_id'] = $myuser1->id;
            $logdata['logCode'] = '002';
            $logdata['log_desc'] = 'عدم ورود موفق کاربر به دلیل رمز عبور اشتباه';
            $logdata['Reserved1'] = 'userid';
            $logdata['Reserved2'] = $myuser1->id;
            $logs->insert($logdata);
            return view('auth.login',['usincorrect' => 'رمز عبور اشتباه است']);

        } elseif(empty($myuser1)) {

            return view('auth.login',['paincorrect' => 'نام کاربری اشتباه است']);

        }

        return view('auth.login',['usincorrect' => 'نام کاربری و رمز عبور اشتباه است']);

    }
}
