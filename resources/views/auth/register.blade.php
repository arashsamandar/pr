@extends('Layouts.UpdeRegis')
@section('URS')

    <br><br><br>
    @if(isset($aka))
        <div class="alert alert-success" style="text-align: center">
            <strong>حساب کاربری با موفقیت ایجاد شد</strong>
        </div>
    @endif

    <div class="container" style="clear:both;margin-top: 10px">
        <div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="form1" role="form" method="post" enctype="multipart/form-data" action="">

                        {{--<input type="file" id="userimage"  name="userimage" style="display: none" />--}}
                        {{--<small style="color: red;">@foreach($errors->get('userimage') as $message ) {{$message}}   @endforeach</small>--}}
                        <div class="image-editor" style="float: right">
                            <input type="file" id="userimage" name="userimage" class="cropit-image-input">
                            <div class="cropit-preview"><img src="{{asset('images/default1.jpg')}}" id="defaultimage" style="cursor:pointer;width:248px;height: 248px;" /></div>
                            <small style="color: red;">@foreach($errors->get('userimage') as $message ) {{$message}}   @endforeach</small>
                            <div class="image-size-label">

                                برش تصویر
                            </div>
                            <input type="range" class="cropit-image-zoom-input">
                            <input type="hidden" name="image-data" class="hidden-image-data" />
                        </div>
                        <div id="result" style="display: none">
                            <code>$form.serialize() =</code>
                            <code id="result-data"></code>
                        </div>
                        <div class="row" dir="rtl" style="clear: both">
                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="2" maxlength="25" type="text" id="family" name="family" value="{{old('family')}}"  class="txtOnly form-control input-md" placeholder="نام خانوادگی">
                                    <small style="color: red;">@foreach($errors->get('family') as $message ) {{$message}}   @endforeach</small>
                                    <small id="familywarn" style="display: none;color: red;">نام خانوادگی را به فارسی وارد کنید</small>
                                </div>
                            </div>

                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="1" maxlength="25" type="text" id="name" name="name" value="{{old('name')}}"  class="form-control input-md floatlabel" placeholder="نام">
                                    <small style="color: red;">@foreach($errors->get('name') as $message ) {{$message}}   @endforeach</small>
                                    <small id="namewarn" style="display: none;color: red;">نام را به فارسی وارد کنید</small>
                                </div>
                            </div>

                        </div>
                        <style>
                            .datepicker thead tr:first-child th {
                                color: #5bc0de;
                            }

                            .datepicker th.next {
                            .glyphicon .glyphicon-chevron-left;
                            }
                            .prev {
                            .glyphicon .glyphicon-chevron-left;
                            }
                        </style>

                        <div class="row" dir="rtl">

                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="4" type="text" name="birth_date" id="bd" value="{{old('birth_date')}}"  class="form-control input-md floatlabel" placeholder="تاریخ تولد">
                                    <small style="color: red;">@foreach($errors->get('birth_date') as $message ) {{$message}}   @endforeach</small>
                                    <small id="bdwarn" style="display: none;color: red;">فرمت تاریخ صحیح نیست</small>
                                </div>
                            </div>

                            <div class="col-md-6 col-md-6 col-md-6" dir="rtl">
                                <div class="form-group">
                                    <input tabindex="3" id="username" type="text" maxlength="25" name="username" value="{{old('username')}}" class="form-control input-md" placeholder="نام کاربری">
                                    <small style="color: red;">@foreach($errors->get('username') as $message ) {{$message}}   @endforeach</small>
                                    <small id="usernamewarn" style="display: none;color: red;">****</small>
                                </div>
                            </div>

                        </div>

                        <div class="row" dir="rtl">

                            <div class="col-md-4 col-md-4 col-md-4">
                                <div class="form-group">
                                    <select name="gender" id="gen" tabindex="6" class="form-control" placeholder="جنسیت">
                                        <option value="آقا">آقا</option>
                                        <option value="خانم">خانم</option>
                                        <option selected disabled value="">جنسیت</option>
                                    </select>
                                    <small style="color: red;">@foreach($errors->get('gender') as $message ) {{$message}}   @endforeach</small>
                                    <small id="genwarn" style="display: none;color: red;">جنسیت خود را انتخاب کنید</small>
                                </div>
                            </div>

                            <div class="col-md-8 col-md-8 col-md-8" dir="rtl">
                                <div class="form-group">
                                    <input tabindex="5" id="nac" type="number" min="0" step="1" data-bind="value:nac" name="national_code" value="{{old('national_code')}}" class="form-control input-md floatlabel" placeholder="کد ملی">
                                    <small style="color: red;">@foreach($errors->get('national_code') as $message ) {{$message}}   @endforeach</small>
                                    <small id="nacwarn" style="display: none;color: red;">کد ملی نمی تواند کمتر از 10 رقم باشد</small>
                                    <small id="nacwarnmore" style="display: none;color: red;">کد ملی نمی تواند بیشتر از 10 رقم باشد</small>
                                </div>
                            </div>

                        </div>

                        <div class="row" dir="rtl">

                            <div class="col-md-4 col-md-4 col-md-4">
                                <div class="form-group">
                                    <input tabindex="8" id="cell" type="number" min="0" step="1" data-bind="value:cell" maxlength="11" name="cell_phone"  value="{{old('cell_phone')}}" class="form-control input-md" placeholder="تلفن همراه">
                                    <small style="color: red;">@foreach($errors->get('cell_phone') as $message ) {{$message}}   @endforeach</small>
                                    <small id="cellwarn" style="display: none;color: red;">شماره تلفن نمی تواند کمتر از 11 رقم باشد</small>
                                    <small id="cellwarnmore" style="display: none;color: red;">شماره تلفن نمی تواند بیشتر از 11 رقم باشد</small>
                                </div>
                            </div>

                            <div class="col-md-8 col-md-8 col-md-8" dir="rtl">
                                <div class="form-group">
                                    <input tabindex="7" id="email" type="email" maxlength="40" name="email" value="{{old('email')}}" class="form-control input-md floatlabel" placeholder="آدرس پست الکترونیکی">
                                    <small style="color: red;">@foreach($errors->get('email') as $message ) {{$message}}   @endforeach</small>
                                    <small id="emailwarn" style="display: none;color: red;">****</small>
                                </div>
                            </div>

                        </div>

                        <div class="row" dir="rtl">
                            <div class="col-xs-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="10" id="passconf" maxlength="60" type="password" name="password_confirmation" class="form-control input-md" placeholder="تکرار رمز عبور">
                                    <small id="passconfwarn" style="display: none;color: red;">****</small>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="9" id="pass" type="password" maxlength="60" name="password" value="{{old('password')}}" class="form-control input-md" placeholder="رمز عبور">
                                    <small style="color: red;">@foreach($errors->get('password') as $message ) {{$message}}   @endforeach</small>
                                    <small id="passwarn" style="display: none;color: red;">****</small>
                                </div>
                            </div>
                        </div>

                        <input type="submit" name="submit" value="ثبت نام" class="btn btn-info btn-block">

                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection