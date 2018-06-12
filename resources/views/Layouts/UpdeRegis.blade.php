<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    {{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}


    <script>
        $(function () {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#defaultimage').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#userimage").change(function(){
                readURL(this);
            });
        })

    </script>
    <title>
        @if(isset($page_title))
            {{$page_title}}
        @else
            پیام رهپاد
        @endif
    </title>
    <style>
        @font-face{
            font-family:'Yekan';
            src:url("{{asset('fonts/BYekan.ttf')}}") format('truetype'),
            url("{{asset('fonts/BYekan.eot?#')}}") format('eot'),
            url("{{asset('fonts/BYekan.woff')}}") format('woff');}

        /*.ui-datepicker .ui-datepicker-title select {*/
        /*color: #000;*/
        /*}*/
        .btn-info {
            background-color: #002A39 !important;
        }
        .btn-info:hover {
            background-color: #17a2b8 !important;
        }
        .cropit-preview {
            background-color: #f8f8f8;
            background-size: cover;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-top: 7px;
            width: 250px;
            height: 250px;
        }

        .cropit-preview-image-container {
            cursor: move;
        }

        .image-size-label {
            margin-top: 10px;
        }

        #result {
            margin-top: 10px;
            width: 900px;
        }

        #result-data {
            display: block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            word-wrap: break-word;
        }
    </style>
</head>
<body style="text-align: right;font-family: Yekan;margin: 0;padding: 0;width: 100%;">

@if(Auth::user())


    <span style="position: absolute;top:50px;left: 35px;color:black;cursor: pointer;font-weight: bold;font-size: x-large;" aria-hidden="true" onclick="openUserNav()">...</span>

    <div id="userSideNav" class="usersidenav" style="text-align: center">
        <a href="javascript:void(0)" class="closebtn" onclick="closeUserNav()">&times;</a>
        <a href="{{route('userspagination')}}" class="sbtn">کاربران</a>
        <a href="{{route('addcontent')}}" class="sbtn">محتوا</a>
    </div>


@endif

<div dir="rtl" id="header">
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
            <a href="{{route('update')}}"><div class="userNameandFamily">{{Auth::user()->name}} {{Auth::user()->family}}</div></a>
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

@yield('URS')

<script>
    $(function() {
        $('.image-editor').cropit();

        $('form').submit(function() {
            // Move cropped image data to hidden input
            var imageData = $('.image-editor').cropit('export');
            $('.hidden-image-data').val(imageData);

            // Print HTTP request params
            var formValue = $(this).serialize();
            $('#result-data').text(formValue);
        });
    });
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

<div style="margin-top: 50px;width: 100%;background-color: #002A3A;text-align: center;color: white;clear: both">
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
</body>
</html>