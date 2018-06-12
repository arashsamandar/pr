<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Logs;
use App\UserImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Imgs;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest');
        $this->request = $request;

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegistrationForm() {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|regex:/^[آ ا ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی]+$/u|max:25',
            'family' => 'required|regex:/^[آ ا ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی]+$/u|max:25',
            'password' => 'required|confirmed',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'birth_date' => 'required|date',
            'national_code' => 'required|unique:users|numeric|max:9999999999',
            'gender' => 'required|max:4',
            'cell_phone' => 'required|numeric|max:99999999999',
            'userimage' => 'image|mimes:jpeg,png,jpg,svg|max:6000',
        ],
            [
                'name.required' => 'وارد کردن نام الزامیست',
                'name.regex' => 'نام را به فارسی وارد کنید',


                'userimage.image' => 'تصاویر مجاز : jpg jpeg png',
                'userimage.mimes' => 'تصاویر مجاز : jpg jpeg png',

                'family.required' => 'وارد کردن نام خانوادگی الزامیست',
                'family.regex' => 'نام خانوادگی را به فارسی وارد کنید',

                'username.required' => 'وارد کردن نام کاربری الزامیست',
                'username.unique' => 'نام کاربری قبلا در سیستم ثبت شده',

                'birth_date.required' => 'وارد کردن تاریخ تولد الزامیست',
                'birth_date.date' => 'لطفا تاریخ را صحیح وارد کنید',

                'national_code.required' => 'وارد کردن کد ملی الزامیست',
                'national_code.unique' => 'کد ملی وارد شده قبلا در سیستم ثبت شده',
                'national_code.max' => 'کد ملی نمی تواند بیش از 10 عدد باشد',
                'national_code.numeric' => 'کد ملی نمیتواند دارای حروف یا کاراکتر باشد',

                'cell_phone.required' => 'وارد کردن شماره ی تلفن الزامیست',
                'cell_phone.numeric' => 'شماره ی تلفن نمیتواند دارای حروف باشد',
                'cell_phone.max' => 'شماره ی تلفن نمیتواند بیش از 11 عدد باشد',

                'gender.max' => 'جنسیت نمیتواند بیش از 4 کاراکتر باشد',
                'gender.required' => 'وارد کردن جنسیت الزامیست',

                'password.required' => 'پسورد را وارد کنید',
                'password.confirmed' => 'تکرار پسورد با پسورد وارد شده یکسان نیستند',

                'email.required' => 'وارد کردن آدرس پست الکترونیکی الزامیست',
                'email.unique' => 'آدرس پست الکترونیکی قبلا در سیستم ثبت شده',
                'email.email' => 'لطفا آدرس پست الکترونیکی را به دقت وارد کنید',

            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */


    protected function create(array $data)
    {

        $v = new Verta();




        $user = User::create([
            'name' => $data['name'],
            'family' => $data['family'],
            'national_code' => $data['national_code'],
            'gender' => $data['gender'],
            'birth_date' => $data['birth_date'],
            'username' =>$data['username'],
            'password' => bcrypt($data['password']),
            'cell_phone' => $data['cell_phone'],
            'email' => $data['email'],
            'created_at_shamsi' => $v->formatDate(),
        ]);

        if($this->request->get('image-data')) {
            $imageData = $this->request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
            $img = Imgs::make($info);
            $img->encode('jpg',80);
            $final_image = base64_encode($img);

            UserImages::create([
                'user_id' => $user->id,
                'image' => $final_image,
            ]);
        }



        //_____________________End Saving user image___________________

        Logs::create([
            'logDate' => $v->formatDate(),
            'logTime' => $v->formatTime(),
            'user_id' => $user->id,
            'logCode' => '010',
            'log_desc' => 'حساب با موفقیت ایجاد شد',
            'Reserved1' => 'userid',
            'Reserved2' => $user->id,
        ]);

        \Auth::logout();
        return redirect()->route('login');

//        return $user;

    }
}
