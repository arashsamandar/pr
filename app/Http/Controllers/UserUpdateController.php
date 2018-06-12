<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;
use App\Logs;
use Validator;
use Illuminate\Http\UploadedFile;
use Imgs;
use App\User;
use App\UserImages;

class UserUpdateController extends Controller
{

    public function __construct(Request $request)
    {

        $this->request = $request;

    }

    public function updatepass() {
        $imagetype = ['.jpg','.jpeg','.png'];
        return view('Layouts.changepass',['imagetypes' => $imagetype]);
    }

    public function changepass() {
        $pass = $this->request->get('password');
        $passconf = $this->request->get('password_confirmation');

        if(trim($pass) === trim($passconf)) {
            \Auth::user()->password = \Hash::make($pass);
            \Auth::user()->save();
            \Auth::logout();
            return redirect('login');
        } else {
            return false;
        }
    }


    public function showUpdate() {
        $imagetype = ['.jpg','.jpeg','.png'];
        return view('auth.update',['imagetypes' => $imagetype]);
    }


    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|regex:/^[آ ا ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی]+$/u|max:25',
            'family' => 'required|regex:/^[آ ا ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی]+$/u|max:25',
            'email' => 'required|email|max:40',
            'birth_date' => 'required|date',
            'national_code' => 'required|numeric|max:9999999999',
            'gender' => 'required|max:4',
            'cell_phone' => 'required|numeric|max:99999999999',
            'userimage' => 'image|mimes:jpeg,png,jpg|max:2048'
        ],
            [
                'name.required' => 'وارد کردن نام الزامیست',
                'name.regex' => 'نام را به فارسی وارد کنید',
                'name.max' => 'نام نمیتواند بیش از 25 کاراکتر باشد',

                'family.required' => 'وارد کردن نام خانوادگی الزامیست',
                'family.regex' => 'نام خانوادگی را به فارسی وارد کنید',
                'family.max' => 'نام خانوادگی نمیتواند بیش از 25 کاراکتر باشد',

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

                'email.required' => 'وارد کردن آدرس پست الکترونیکی الزامیست',
                'email.unique' => 'آدرس پست الکترونیکی قبلا در سیستم ثبت شده',
                'email.email' => 'لطفا آدرس پست الکترونیکی را به دقت وارد کنید',
                'email.max' => 'پست الکترونیکی نمیتواند بیش از 40 طول داشته باشد',

                'userimage.image' => 'تصاویر مجاز : jpg jpeg png',
                'userimage.mimes' => 'تصاویر مجاز : jpg jpeg png',
            ]);

        \Auth::user()->name = $request->input('name');
        \Auth::user()->family = $request->input('family');
        \Auth::user()->birth_date = $request->input('birth_date');
        \Auth::user()->gender = $request->input('gender');
        \Auth::user()->national_code = $request->input('national_code');
        \Auth::user()->cell_phone = $request->input('cell_phone');
        \Auth::user()->email = $request->input('email');

        if($this->request->get('image-data')) {
            $checkforimage = UserImages::selectuserimage(\Auth::user()->id);
            if($checkforimage) {
                $imageData = $this->request->get('image-data');
                $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                $img = Imgs::make($info);
                $img->encode('jpg', 80);
                $final_image = base64_encode($img);

                $userimage = UserImages::find(\Auth::user()->id);
                $userimage->user_id = \Auth::user()->id;
                $userimage->image = $final_image;
                $userimage->update();

            } else {

                $images = \DB::table('user_images')->where('user_id','=',\Auth::user()->id)->delete();

                $imageData = $this->request->get('image-data');
                $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                $img = Imgs::make($info);
                $img->encode('jpg', 80);
                $final_image = base64_encode($img);

                UserImages::create([
                    'user_id' => \Auth::user()->id,
                    'image' => $final_image,
                ]);
            }

        }


        \Auth::user()->save();




        $v = new Verta();

        Logs::create([
            'logDate' => $v->formatDate(),
            'logTime' => $v->formatTime(),
            'user_id' => \Auth::user()->id,
            'logCode' => '011',
            'log_desc' => 'حساب با موفقیت ویرایش شد',
            'Reserved1' => 'userid',
            'Reserved2' => \Auth::user()->id,
        ]);

        $imagetype = ['.jpg','.jpeg','.png'];
        return view('home',['imagetypes' => $imagetype]);

    }

}
