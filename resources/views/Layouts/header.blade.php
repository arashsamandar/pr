<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=433px, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/header.css')}}" />
    <link rel="stylesheet" href="{{asset('css/mainpage.css')}}" />
    <link rel="stylesheet" href="{{asset('css/footer.css')}}" />
    <link rel="stylesheet" href="{{asset('css\localcss\bootstrap.min.css')}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="{{asset('js\localones\jquery-2.0.0.min.js')}}"></script>
    <script src="{{asset('js\localones\bootstrap.min.js')}}"></script>
    <title>پیام رهپاد</title>
    <style type="text/css">
        @font-face{
            font-family:'Yekan';
            src:url("{{asset('fonts/BYekan.ttf')}}") format('truetype'),
            url("{{asset('fonts/BYekan.eot?#')}}") format('eot'),
            url("{{asset('fonts/BYekan.woff')}}") format('woff');}

        .carousel-caption {
            top: 82%;
            right: 0;
            bottom: auto;
        }
    </style>

    <script
            src="http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&amp;language=fa-IR&key=AIzaSyBPE7WWdaSiKs5_qtd4U7agoJ1jmCJ6XbE">
    </script>

</head>
<body dir="rtl" style="text-align: right;font-family: Yekan;margin: 0;padding: 0;width: 100%;">

{{--@if(Auth::user())--}}

    {{--<div class="usersettings">--}}

        {{--<img class="userImage" src="{{ route('userimage',['id' => Auth::user()->id  ])}}" />--}}


        {{--<span class="glyphicon glyphicon-option-horizontal dropDown" aria-hidden="true" onclick="openUserNav()"></span>--}}

        {{--<div id="userSideNav" class="usersidenav" style="text-align: center">--}}
            {{--<a href="javascript:void(0)" class="closebtn" onclick="closeUserNav()">&times;</a>--}}

            {{--<a href="{{route('update')}}" class="sbtn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;بروز رسانی</a>--}}
            {{--<a href="{{route('uppass')}}">تغییر پسورد</a>--}}
            {{--<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="sbtn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;خروج</a>--}}
        {{--</div>--}}


    {{--</div>--}}


{{--@endif--}}

@if(Auth::user())


<span class="dropDown" aria-hidden="true" onclick="openUserNav()">...</span>

        <div id="userSideNav" class="usersidenav" style="text-align: center">
            <a href="javascript:void(0)" class="closebtn" onclick="closeUserNav()">&times;</a>
            <a href="{{route('userspagination')}}" class="sbtn">کاربران</a>
            <a href="{{route('addcontent')}}" class="sbtn">محتوا</a>
        </div>


@endif


<div id="header">
    <div class="treedash" onclick="openNav()">&#9776;</div>
    <div id="prlogo"> <img src="{{asset('images/pr.png')}}" class="sitelogo" /></div>

    @if(Auth::user())
        @if(Auth::user()->hasOne('App\UserImages','user_id','id')->first())
            <a href="{{route('update')}}"><img class="userImage" src="{{ route('userimage',['id' => Auth::user()->id  ])}}" /></a>
        @else
            <a href="{{route('update')}}"><img class="userImage" src="{{asset('images/default1.jpg')}}" /></a>
        @endif
            <a href="{{route('update')}}"><div class="userNameandFamily">{{Auth::user()->name}} {{Auth::user()->family}}</div></a>
    @endif

    <nav id="navigation">
        <a href="{{route('home')}}"><input type="button" value="صفحه اصلی" class="btns"  /></a>
        <a href="{{route('ourServices')}}"><input type="button" value="خدمات" class="btns" /></a>
        <a href="{{route('aboutUs')}}"><input type="button" value="درباره ما" class="btns" /></a>
        <a href="{{route('contactUs')}}"><input type="button" value="تماس با ما" class="btns" /></a>
    @if(Auth::user())
            @if(Auth::user()->hasOne('App\UserImages','user_id','id')->first())
                <a href="{{route('update')}}"><img class="userImage" src="{{ route('userimage',['id' => Auth::user()->id  ])}}" /></a>
            @else
                <a href="{{route('update')}}"><img class="userImage" src="{{asset('images/default1.jpg')}}" /></a>
            @endif
            <a href="{{route('update')}}"><div class="userNameandFamily">{{Auth::user()->name}}  {{Auth::user()->family}}</div></a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><input type="button" value="خروج از سایت" class="btns" style="float: left;" /></a>
            <a href="{{route('uppass')}}"><input type="button" value="رمز عبور" class="btns" style="float: left;" /></a>
        @else
            <a href="{{route('login')}}"><input type="button" value="ورود به سایت" class="btns" style="float: left;" /></a>
            <a href="{{route('register')}}"><input type="button" value="ثبت نام" class="btns" style="float: left;" /></a>
        @endif
    </nav>

</div>

<div id="mySidenav" class="sidenav" style="text-align: center">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="{{route('home')}}" class="sbtn">صفحه اصلی</a>
    <a href="{{route('ourServices')}}" class="sbtn">خدمات</a>
    <a href="{{route('aboutUs')}}" class="sbtn">درباره ما</a>
    <a href="{{route('contactUs')}}" class="sbtn">تماس با ما</a>
    <br>
    @if(Auth::user())
        <a href="{{route('update')}}">ویرایش</a>
        <a href="{{route('uppass')}}">رمز عبور</a>
        <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">خروج</a>
    @else
        <a href="{{route('login')}}">ورود</a>
        <a href="{{route('register')}}">ثبت نام</a>
    @endif
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

@yield('contents')

@extends('Layouts.footer')




<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "170px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

    function openUserNav() {
        document.getElementById("userSideNav").style.width = "170px";
    }

    function closeUserNav() {
        document.getElementById("userSideNav").style.width = "0";
    }
</script>

</body>
</html>