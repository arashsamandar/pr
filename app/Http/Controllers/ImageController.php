<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\UserImages;
use Imgs;

class ImageController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function showimage($id) {
        $imageData = \DB::table('user_images')->select('image')->where('user_id','=',$id)->first()->image;

            $info = $info = base64_decode($imageData);
            $img = Imgs::make($info);
            $img->encode('jpg',80);
            return $img;
    }

    public function showimageform()
    {
        $imagetype = ['.jpg', '.jpeg', '.png'];
        return view('imageform', ['imagetypes' => $imagetype]);
    }

    public function processimageform()
    {
        $rules = array(
            'image' => 'required|mimes:jpeg,jpg|max:10000'
        );

        $validation = \Validator::make(Input::all(), $rules);

        if ($validation->fails()) {
            return \Redirect::action('ImageController@showimageform')->withErrors($validation);
        } else {
            $file = $this->request->file('image');
            $file_name = $file->getClientOriginalName();
            if ($file->move('images', $file_name)) {
                return view('jcrop', ['image' => 'images/' . $file_name]);
            } else {
                return "Error uploading file";
            }
        }
    }

    public function showjcrop()
    {
        return view('jcrop', ['image' => '/images' . Session::get('image')]);
    }

    public function jcropprocess()
    {

        $src = Input::get('image');
        $img = imagecreatefromjpeg($src);
        $dest = ImageCreateTrueColor(Input::get('w'),
            Input::get('h'));

            imagecopyresampled($dest, $img, 0, 0, Input::get('x'),
            Input::get('y'), Input::get('w'), Input::get('h'),
            Input::get('w'), Input::get('h'));

        return "<img src='" . $src . "'>";
    }

    public function cropimages()
    {
        $file = $_FILES['file']['tmp_name'];
        \Storage::disk('uploads')->put('havij.jpg', \File::get($file));
        return response($file);
        $mytype = $file->getClientOriginalExtension();

    }


    public function showcropimages()
    {
        return view('crop');
    }
}





//return view('crop', compact('displayname', $displayname), compact('src', $src),
//    compact('imgSrc', $imgSrc)
//);
