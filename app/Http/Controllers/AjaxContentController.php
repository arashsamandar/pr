<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use laravel\Contact;
use Illuminate\Support\Facades\DB;
use App\User;
use Hekmatinasser\Verta\Verta;
use App\Logs;
use App\Content;
use App\ImageOne;
use App\ImageTwo;
use App\ImageThree;
use App\UserImages;
use Imgs;

class AjaxContentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function addContent() {
        return view('ajax.AddContent');
    }

    public function saveContent(Request $request) {
          if($request->ajax()) {

              $date_created = new Verta(); //date created
              $user_id = \Auth::user()->id;

              $content = Content::create([

                  'user_id' => $user_id,
                  'title' => $request->input('title'),
                  'brief' => $request->input('brief'),
                  'page_address' => $request->input('page_address'),
                  'input_at' => $request->input('inputat'),
                  'definition' => $request->input('input_definition'),
                  'End_at' => $request->input('end_date'),
                  'Begin_at' => $request->input('start_date'),
                  'created_at' => $date_created->formatDate(),

              ]);

              if($request->get('user_large_croped_image')) {
                  $imageData = $request->get('user_large_croped_image');
                  $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                  $img = Imgs::make($info);
                  $img->encode('jpg',80);
                  $final_image = base64_encode($img);

                  ImageOne::create([
                      'content_id' => $content->id,
                      'user_id' => $user_id,
                      'imageone' => $final_image,
                  ]);

              }

              if($request->get('user_small_croped_image')) {
                  $smallimageData = $request->get('user_small_croped_image');
                  $small_info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $smallimageData));
                  $small_img = Imgs::make($small_info);
                  $small_img->encode('jpg',80);
                  $small_final_image = base64_encode($small_img);

                  ImageTwo::create([
                      'content_id' => $content->id,
                      'user_id' => $user_id,
                      'imagetwo' => $small_final_image,
                  ]);

              }



              if($request->get('user_verysmall_croped_image')) {
                  $verysmallimageData = $request->get('user_verysmall_croped_image');
                  $verysmall_info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $verysmallimageData));
                  $verysmall_img = Imgs::make($verysmall_info);
                  $verysmall_img->encode('jpg',80);
                  $verysmall_final_image = base64_encode($verysmall_img);

                  ImageThree::create([
                      'content_id' => $content->id,
                      'user_id' => $user_id,
                      'imagethree' => $verysmall_final_image,
                  ]);

              }

              return response($content);

          }
    }

    public function editContent(Request $request) {
        if($request->ajax()) {
            $content = Content::find($request->id);

            if(isset(\DB::table('image_ones')->select('imageone')->where('content_id','=',$content->id)->first()->imageone)) {
                $imageData = \DB::table('image_ones')->select('imageone')->where('content_id','=',$content->id)->first()->imageone;
            } else {
                $imageData = base64_encode(asset('/public/images/pr.png'));
            }

            if(isset(\DB::table('image_twos')->select('imagetwo')->where('content_id','=',$content->id)->first()->imagetwo)) {
                $imageDatasmall = \DB::table('image_twos')->select('imagetwo')->where('content_id','=',$content->id)->first()->imagetwo;
            } else {
                $imageDatasmall = base64_encode(asset('public/images/pr.png'));
            }

            if(isset(\DB::table('image_threes')->select('imagethree')->where('content_id','=',$content->id)->first()->imagethree)) {
                $imageDataverysmall = \DB::table('image_threes')->select('imagethree')->where('content_id','=',$content->id)->first()->imagethree;
            } else {

                $imageDataverysmall = base64_encode(asset(public_path('public/images/pr.png')));
            }
            if(!isset($content->definition)) {
                $content->definition = '';
            }

                $arr = json_decode($content,true);
                $arrne['imageone'] = 'data:image/png;base64,' . $imageData;
                $arrne['imagetwo'] = 'data:image/png;base64,' . $imageDatasmall;
                $arrne['imagethree'] = 'data:image/png;base64,' . $imageDataverysmall;

                array_push($arr,$arrne);
                return response($arr);
        }
    }

    // I think this function is not used anywhere , as you see one exact similar is above;
    public function showContentImages(Request $request) {
        if($request->ajax()) {
            $content = Content::find($request->id); // Learn How Do I pass ID From My Modal Content To The AddContentImage -- To show The Images That User Already Set

            $imageData = \DB::table('image_ones')->select('imageone')->where('content_id','=',$request->id)->first()->imageone;
            $imageDatasmall = \DB::table('image_twos')->select('imagetwo')->where('content_id','=',$request->id)->first()->imagetwo;
            $imageDataverysmall = \DB::table('image_threes')->select('imagethree')->where('content_id','=',$request->id)->first()->imagethree;
            $arr = json_decode($content,true);
            $arrne['imageone'] = 'data:image/png;base64,' . $imageData;
            $arrne['imagetwo'] = 'data:image/png;base64,' . $imageDatasmall;
            $arrne['imagethree'] = 'data:image/png;base64,' . $imageDataverysmall;
            array_push($arr,$arrne);
            return response($arr);
        }
    }



    public static function checkContent_Image_Number() {

        //-------------------------- Warning ------------------------
        //---- This Is Not The Correct Way Of How Relations Work In Laravel -----
        $v = new Verta();
        $contents_querybuiler_array = \DB::table('contents')
            ->select('id','title','brief','page_address')
            ->where('input_at','=',1)
            ->where('End_at','>=',$v->formatDate())
            ->get(); // Where Image Should Be ( Look in the Content Table
        $arr = [];
        foreach ($contents_querybuiler_array as $objectType) {
                if(isset(\DB::table('image_ones')->select('imageone')->where('content_id', '=', $objectType->id)->first()->imageone)) {
                    $arr[0][] = $objectType->id;
                    $arr[1][] = $objectType->title;
                    $arr[2][] = $objectType->brief;
                    $arr[3][] = 'data:image/png;base64,' . \DB::table('image_ones')->select('imageone')->where('content_id', '=', $objectType->id)->first()->imageone;
                    $arr[4][] = $objectType->page_address;
                }
        }
        return $arr;
    }

    public function testFunction() {
        $thedefult = asset(public_path('images/Atehran.jpg'));
        $imageData =  base64_encode($thedefult);
        dd($imageData);
    }


    public static function checkContent_Image_Number_Bellow_Slider() {

        $v = new Verta();
        //-------------------------- Warning ------------------------
        //---- This Is Not The Correct Way Of How Relations Work In Laravel -----
        $contents_querybuiler_array = \DB::table('contents')
            ->select('id','title','brief','page_address')
            ->where('input_at','=',2)
            ->where('End_at','>=',$v->formatDate())
            ->get(); // Where Image Should Be ( Look in the Content Table

        $arr = [];
        foreach ($contents_querybuiler_array as $objectType) {
            if(isset(\DB::table('image_twos')->select('imagetwo')->where('content_id','=',$objectType->id)->first()->imagetwo)) {
                $arr[0][] = $objectType->id;
                $arr[1][] = $objectType->title;
                $arr[2][] = $objectType->brief;
                $arr[3][] = 'data:image/png;base64,' . \DB::table('image_twos')->select('imagetwo')->where('content_id', '=', $objectType->id)->first()->imagetwo;
                $arr[4][] = $objectType->page_address;
            }
        }
        return $arr;
    }










    public function UpdateContent(Request $request) {
        if($request->ajax()) {
            $content = Content::find($request->id);
            $user_id = \Auth::user()->id;

            if (isset(\DB::table('image_ones')->select('imageone')->where('content_id','=',$content->id)->first()->imageone)) {
                if($request->get('user_large_croped_image')) {
                    \DB::table('image_ones')->where('content_id', '=', $content->id)->delete();
                }
            }
                if($request->get('user_large_croped_image')) {

                    $imageData = $request->get('user_large_croped_image');
                    $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                    $img = Imgs::make($info);
                    $img->encode('jpg',80);
                    $final_image = base64_encode($img);

                    ImageOne::create([
                        'content_id' => $content->id,
                        'user_id' => $user_id,
                        'imageone' => $final_image,
                    ]);

                }


            if (isset(\DB::table('image_twos')->select('imagetwo')->where('content_id','=',$content->id)->first()->imagetwo)) {
                if($request->get('user_small_croped_image')) {
                    \DB::table('image_twos')->where('content_id', '=', $content->id)->delete();
                }
            }

                if($request->get('user_small_croped_image')) {
                    $imageData = $request->get('user_small_croped_image');
                    $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                    $img = Imgs::make($info);
                    $img->encode('jpg',80);
                    $final_image = base64_encode($img);

                    ImageTwo::create([
                        'content_id' => $content->id,
                        'user_id' => $user_id,
                        'imagetwo' => $final_image,
                    ]);

                }

            if (isset(\DB::table('image_threes')->select('imagethree')->where('content_id','=',$content->id)->first()->imagethree)) {
                if($request->get('user_verysmall_croped_image')) {
                    \DB::table('image_threes')->where('content_id', '=', $content->id)->delete();
                }
            }
                if($request->get('user_verysmall_croped_image')) {
                    $imageData = $request->get('user_verysmall_croped_image');
                    $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                    $img = Imgs::make($info);
                    $img->encode('jpg',80);
                    $final_image = base64_encode($img);

                    ImageThree::create([
                        'content_id' => $content->id,
                        'user_id' => $user_id,
                        'imagethree' => $final_image,
                    ]);

                }


            $content->update($request->all());
            $content->definition = $request->input('input_definition');
            $content->save();



            return response($content);

        }
    }

    public function DestroyContent(Request $request) {
        if($request->ajax()) {
            $content1 = Content::find($request->id);
            Content::destroy($content1->id);
            $image_ones = \DB::table('image_ones')->where('content_id','=',$content1->id)->delete();
            $image_twos = \DB::table('image_twos')->where('content_id','=',$content1->id)->delete();
            $image_threes = \DB::table('image_threes')->where('content_id','=',$content1->id)->delete();

            return response(['message'=>'Contact Deleted Successfully']);
        }
    }


    public function findpage() {
        return DB::table('contents')->selectRaw('contents.id,contents.created_at,contents.title,contents.brief,contents.input_at,contents.page_address,contents.Begin_at,contents.End_at')
            ->paginate(5);
    }

    public function pagination() {
        $contents = $this->findpage();
        return view('ajax.AddContent',compact('contents'));
    }

}
