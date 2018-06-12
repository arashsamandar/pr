<?php

//namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use laravel\Contact;
use Illuminate\Support\Facades\DB;
use App\User;
use Hekmatinasser\Verta\Verta;
use App\Logs;
use App\UserImages;
use Imgs;

class AjaxController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $request->input('name');
        return view('ajax.index');
    }

    public function readData() {
        $contacts = DB::table('users')->selectRaw('users.id,users.name,users.family,users.username,
        users.gender,users.created_at_shamsi,users.email,users.cell_phone')->get();
        return view('ajax.studentlist',compact('contacts'));
    }


    public function store(Request $request) {
        if($request->ajax()) {
            $v = new Verta();

            $userid = \Auth::user()->id;

            $contact = User::create([
                'name' => $request->input('name'),
                'family' => $request->input('family'),
                'national_code' => $request->input('national_code'),
                'gender' => $request->input('gender'),
                'birth_date' => $request->input('birth_date'),
                'username' =>$request->input('username'),
                'password' => bcrypt($request->input('password')),
                'cell_phone' => $request->input('cell_phone'),
                'email' => $request->input('email'),
                'created_at_shamsi' => $v->formatDate(),
            ]);

            if($request->get('usercropedimage')) {
                $imageData = $request->get('usercropedimage');
                $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                $img = Imgs::make($info);
                $img->encode('jpg',80);
                $final_image = base64_encode($img);

                UserImages::create([
                    'user_id' => $contact->id,
                    'image' => $final_image,
                ]);

            }

            Logs::create([
                'logDate' => $v->formatDate(),
                'logTime' => $v->formatTime(),
                'user_id' => $contact->id,
                'logCode' => '010',
                'log_desc' => 'حساب با موفقیت ایجاد شد',
                'Reserved1' => $userid,
                'Reserved2' => $contact->id,
            ]);






            return response($contact);
        }
    }

    public function find($id) {
        return DB::table('users')->selectRaw('users.id')
            ->where('users.id',$id)->first();
    }

    public function destroy(Request $request) {
        if($request->ajax()) {

            $contact1 = User::find($request->id);
            $userid = \Auth::user()->id;
//            User::destroy($request->id);
//            return response(['message'=>'Contact Deleted Successfully']);

//            $image = UserImages::with('users')->find($request->id);
//            if($image) {
//                $image->delete();
//            }

            // Destroy The User Created Content Too .
            $images = \DB::table('user_images')->where('user_id','=',$request->id)->delete();

            User::destroy($request->id);

            $v = new Verta();

            Logs::create([
                'logDate' => $v->formatDate(),
                'logTime' => $v->formatTime(),
                'user_id' => $contact1->id,
                'logCode' => '014',
                'log_desc' => 'حساب با موفقیت حذف شد',
                'Reserved1' => $userid,
                'Reserved2' => $contact1->id,
            ]);

            return response(['message'=>'Contact Deleted Successfully']);
        }
    }

    public function edit(Request $request) {
        if($request->ajax()) {
            $contact1 = User::find($request->id);


                if(!empty(\DB::table('user_images')->select('image')->where('user_id','=',$request->id)->first()->image)) {
                    $imageData = \DB::table('user_images')->select('image')->where('user_id','=',$request->id)->first()->image;
                    $arr = json_decode($contact1,true);
                    $arrne['image'] = 'data:image/png;base64,' . $imageData;
                    array_push($arr,$arrne);
                    return response($arr);
                } else {
                    $arr = json_decode($contact1,true);
                    array_push($arr,['image' => 'data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/4QMtaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjMtYzAxMSA2Ni4xNDU2NjEsIDIwMTIvMDIvMDYtMTQ6NTY6MjcgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKE1hY2ludG9zaCkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6Q0U5QUVCNjBBOEE5MTFFNDgxRjM5MUNFREY4NjlCNzgiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6Q0U5QUVCNjFBOEE5MTFFNDgxRjM5MUNFREY4NjlCNzgiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpDRTlBRUI1RUE4QTkxMUU0ODFGMzkxQ0VERjg2OUI3OCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpDRTlBRUI1RkE4QTkxMUU0ODFGMzkxQ0VERjg2OUI3OCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pv/uAA5BZG9iZQBkwAAAAAH/2wCEAAYEBAQFBAYFBQYJBgUGCQsI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']);
                    return response($arr);
                }


            return response($contact1);
        }
    }

    public function update(Request $request) {
        if($request->ajax()) {
//            $contact = Contact::find($request->all()); //use this
            $contact = User::find($request->id);

            $userid = \Auth::user()->id;

            if($imageData = $request->get('usercropedimagee') && !strpos($request->get('usercropedimagee'),'REeAAAAAAAAAAAC/7KzM3dG+XM8ti5VRH0ThVH9yifFAAAAAAAAAAAAAAAAAAAAAAAcjuVzXcqrnjVMzPrlEYgAAAAAAAAAAAuOwK5m3naOaJtz7Yq/')  ) {
                $imageData = $request->get('usercropedimagee');
                $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                $img = Imgs::make($info);
                $img->encode('jpg', 80);
                $final_image = base64_encode($img);

                if(empty($contact->hasOne('App\UserImages','user_id',$contact->id)->first())) {

                    $images = \DB::table('user_images')->where('user_id','=',$contact->id)->delete();

                    UserImages::create([
                        'user_id' => $contact->id,
                        'image' => $final_image,
                    ]);

                } else {
                    $userimage = UserImages::find($request->id);
                    $userimage->user_id = $request->id;
                    $userimage->image = $final_image;
                    $userimage->update();
                }

            }


            $contact->update($request->all());

            $v = new Verta();

            Logs::create([
                'logDate' => $v->formatDate(),
                'logTime' => $v->formatTime(),
                'user_id' => $contact->id,
                'logCode' => '011',
                'log_desc' => 'حساب با موفقیت ویرایش شد',
                'Reserved1' => $userid,
                'Reserved2' => $contact->id,
            ]);


            return response($contact);

    }
}


    public function showName(Request $request) {
        if($request->ajax()) {

            $contact = User::find($request->name);
            return response($contact);

        }
    }


    public function saveimage(Request $request) {
        if($request->ajax()) {
                $imageData = $request->get('userimagedata');
                $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                $img = Imgs::make($info);
                $img->encode('jpg',80);
                $final_image = base64_encode($img);

                UserImages::create([
                    'user_id' => $request->id,
                    'image' => $final_image,
                ]);
        }
    }

    public function showpassword(Request $request) {
        if($request->ajax()) {
            $contact1 = User::find($request->id);
            return response($contact1);
        }
    }

    public function changepass(Request $request) {

        $v = new Verta();

        $userid = \Auth::user()->id;
            $myuserpass = bcrypt($_POST['mypass']);
            $myuserid = $_POST['myid'];
            $passchanged = \DB::table('users')->where('id',$myuserid )->update(['password' => $myuserpass]);

        Logs::create([
            'logDate' => $v->formatDate(),
            'logTime' => $v->formatTime(),
            'user_id' => $myuserid,
            'logCode' => '013',
            'log_desc' => 'رمز عبور با موفقیت تغییر کرد',
            'Reserved1' => $userid,
            'Reserved2' => $myuserid,
        ]);

    }

    public function searchNames(Request $request) {

        $arash = $_POST['name'];
        $gotyou = DB::select("SELECT * FROM users WHERE name = '$arash'");

        $imagecheck = \DB::table('user_images')->select('image')->where('user_id','=',$gotyou[0]->id)->get();

        if($imagecheck->count()) {
            $imageData = \DB::table('user_images')->select('image')->where('user_id','=',$gotyou[0]->id)->first()->image;
            $image = 'data:image/png;base64,' . $imageData;
            array_push($gotyou,['image' => $image]);
        } else {
            array_push($gotyou,['image' => 'data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/4QMtaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjMtYzAxMSA2Ni4xNDU2NjEsIDIwMTIvMDIvMDYtMTQ6NTY6MjcgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKE1hY2ludG9zaCkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6Q0U5QUVCNjBBOEE5MTFFNDgxRjM5MUNFREY4NjlCNzgiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6Q0U5QUVCNjFBOEE5MTFFNDgxRjM5MUNFREY4NjlCNzgiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpDRTlBRUI1RUE4QTkxMUU0ODFGMzkxQ0VERjg2OUI3OCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpDRTlBRUI1RkE4QTkxMUU0ODFGMzkxQ0VERjg2OUI3OCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pv/uAA5BZG9iZQBkwAAAAAH/2wCEAAYEBAQFBAYFBQYJBgUGCQsI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']);
        }

        return response($gotyou);

    }

    public function findpage() {
        return DB::table('users')->selectRaw('users.id,users.name,users.family,users.username,users.gender,users.created_at_shamsi,users.email,users.cell_phone')
            ->paginate(5);
    }

    public function pagination() {
        $contacts = $this->findpage();
        return view('ajax.pagination',compact('contacts'));
    }


    public function show_access(Request $request) {
        if($request->ajax()) {
            $user = User::find($request->id);

            return response($user);
        }
    }

    public function change_access(Request $request) {
        $v = new Verta();
        $myuserid = \Auth::user()->id;
        if($request->ajax()) {
            $contact = User::find($request->id);

            Logs::create([
                'logDate' => $v->formatDate(),
                'logTime' => $v->formatTime(),
                'user_id' => $myuserid,
                'logCode' => '012',
                'log_desc' => 'دسترسی کاربر تغییر کرد',
                'Reserved1' => $contact->id,
                'Reserved2' => $myuserid,
            ]);

            return response($contact);
        }
    }





//    public function scopeSearch($query,$name) {
//
//        $myquery = $query->where('name','like','%' . $name . '%')
//            ->orWhere('family','like','%' . $name . '%')
//            ->orWhere('phone','like','%' . $name . '%')->get();
//
//        $imageData = \DB::table('user_images')->select('image')->where('user_id','=',$myquery->id)->first()->image;
////        $arr = json_decode($myquery,true);
////        $arrne['image'] = 'data:image/png;base64,' . $imageData;
////        array_push($arr,$arrne);
//        $myquery->image = 'data:image/png;base64,' . $imageData;
//        return response($myquery);
//    }


}
