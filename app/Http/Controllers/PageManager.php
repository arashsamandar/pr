<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;

class PageManager extends Controller
{
    public function makePages($pagename) {

        $verta_object = new Verta();
        $today_date = $verta_object->formatDate();
        $contents = \DB::table('contents')->select('title','brief','definition','page_address')
            ->where('title','=',$pagename)
            ->where('End_at','>=',$today_date)->get();

        $page_title = null;
        $page_brief = null;
        $page_content = null;
        $page_address = null;
        foreach ($contents as $content) {
            $page_title = $content->title;
            $page_brief = $content->brief;
            $page_content = $content->definition;
            $page_address = $content->page_address;
        }

        if($page_address != null) {
            $address = 'http://' . $page_address;
            return redirect($address);
        }
        elseif($page_content != null) {
            return view('dynamicPages',compact(['page_title','page_brief','page_content']));
        } else {
            $page_title = 'Error';
            $page_brief = 'صفحه ی مورد نظر یافت نشد';
            $page_content = 'محتوایی که به دنبال آن هستید در این سایت وجود ندارد';
            return view('dynamicPages',compact(['page_title','page_brief','page_content']));
//            dd($contents);
        }
    }

    public function goToAddress($website) {
        $verta_object = new Verta();
        $today_date = $verta_object->formatDate();
        $address = \DB::table('contents')->select('page_address')->where('page_address','=',$website)
            ->where('End_at','>=',$today_date)->get();
        $page_address = null;

        foreach ($address as $address_object) {
            $page_address = $address_object->page_address;
        }
        if($page_address != null) {
            return \Redirect::to('http://' . $page_address);
        } else {
            return view('MainPages.aboutUs');
        }


    }
}
