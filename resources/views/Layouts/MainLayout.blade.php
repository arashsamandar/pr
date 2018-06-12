<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=300px, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/header.css')}}" />
    <link rel="stylesheet" href="{{asset('css/mainpage.css')}}" />
    <link rel="stylesheet" href="{{asset('css/footer.css')}}" />
    <link rel="stylesheet" href="{{asset('css\localcss\bootstrap.min.css')}}" />
    <script src="{{asset('js\localones\jquery-2.0.0.min.js')}}"></script>
    <script src="{{asset('js\localones\bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css\jquery-ui.min.css')}}" />
    <script src="{{asset('js\jquery-ui.min.js')}}"></script>
    <script src="{{asset('js\rejs.js')}}"></script>
    <script src="{{asset('js\cropit.js')}}"></script>
    <title>پیام رهپاد</title>
    <style type="text/css">
        @font-face{
            font-family:'Yekan';
            src:url("{{asset('fonts/BYekan.ttf')}}") format('truetype'),
            url("{{asset('fonts/BYekan.eot?#')}}") format('eot'),
            url("{{asset('fonts/BYekan.woff')}}") format('woff');}
    </style>
    {{--<script--}}
            {{--src="http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&amp;language=fa-IR&key=AIzaSyBPE7WWdaSiKs5_qtd4U7agoJ1jmCJ6XbE">--}}
    {{--</script>--}}
</head>
<body dir="rtl" style="text-align: right;font-family: Yekan;margin: 0;padding: 0;width: 100%;">


@if(Auth::user())

    <div class="usersettings">
        {{--@for($i=0;$i<3;$i++)--}}
            {{--@if(Storage::disk('local')->has(Auth::user()->username . Auth::user()->id  . $imagetypes[$i]))--}}
                {{--<img class="userImage" src="{{route('account.image',['filename' => Auth::user()->username . Auth::user()->id  . $imagetypes[$i]])}}" />--}}
            {{--@endif--}}
        {{--@endfor--}}


        <span class="glyphicon glyphicon-option-horizontal dropDown" aria-hidden="true" onclick="openUserNav()"></span>

        <div id="userSideNav" class="usersidenav" style="text-align: center">
            <a href="javascript:void(0)" class="closebtn" onclick="closeUserNav()">&times;</a>
            @for($i=0;$i<3;$i++)
                @if(Storage::disk('local')->has(Auth::user()->username . Auth::user()->id  . $imagetypes[$i]))
                    <img class="userImage2" src="{{route('account.image',['filename' => Auth::user()->username . Auth::user()->id  . $imagetypes[$i]])}}" />
                @endif
            @endfor
            <a href="{{route('update')}}" class="sbtn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;بروز رسانی</a>
            <a href="{{route('uppass')}}" class="sbtn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;تغییر رمز عبور</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="sbtn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;خروج</a>
        </div>


    </div>


@endif


<div id="header">
    <div class="treedash" onclick="openNav()">&#9776;</div>
    <div id="prlogo"> <img src="{{asset('images/pr.png')}}" class="sitelogo" /></div>


    <nav id="navigation">
        <a href="{{route('home')}}"><input type="button" value="صفحه اصلی" class="btns"  /></a>
        <input type="button" value="خدمات" class="btns" />
        <input type="button" value="درباره ما" class="btns" />
        <input type="button" value="تماس با ما" class="btns" />
        @if(Auth::user())
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><input type="button" value="خروج از سایت" class="btns" style="float: left;" /></a>
        @else
            <a href="{{route('login')}}"><input type="button" value="ورود به سایت" class="btns" style="float: left;" /></a>
            <a href="{{route('register')}}"><input type="button" value="ثبت نام" class="btns" style="float: left;" /></a>
        @endif
    </nav>

</div>

<div id="mySidenav" class="sidenav" style="text-align: center">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="{{route('home')}}" class="sbtn">صفحه اصلی</a>
    <a href="#" class="sbtn">خدمات</a>
    <a href="#" class="sbtn">درباره ما</a>
    <a href="#" class="sbtn">تماس با ما</a>
    <br>
    @if(Auth::user())
        <a href="">خروج</a>
    @else
        <a href="#">ورود</a>
    @endif
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>






@yield('pagecnt')














<div style="margin-top: 50px;width: 100%;background-color: #002A3A;text-align: center;color: white;">
    کلیه حقوق مادی و معنوی این سایت متعلق به کانون تبلیغاتی <a style="color: #F26622">پیام رهپاد</a> می باشد
    <br>
    <a href="https://www.facebook.com/PayameRahpad/">
        <img src="{{asset('images/005-facebook.png')}}" style="width: 60px;height: 60px;padding: 10px" />
    </a>
    <a href="http://instagram.com/rahpadads">
        <img src="{{asset('images/002-instagram-1.png')}}" style="width: 60px;height: 60px;padding: 10px" />
    </a>
    <a href="https://t.me/Payam_e_Rahpad">
        <img src="{{asset('images/001-telegram.png')}}" style="width: 60px;height: 60px;padding: 10px" />
    </a>
    <br>
    طراحی و راه اندازی پایگاه اینترنتی <a style="color:#F26622;">گروه رهپاد</a>
</div>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

    function openUserNav() {
        document.getElementById("userSideNav").style.width = "250px";
    }

    function closeUserNav() {
        document.getElementById("userSideNav").style.width = "0";
    }
</script>
</body>
</html>