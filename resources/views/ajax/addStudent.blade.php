
<script>

    //    $(document).on('show.bs.modal','#student-update', function () {
    //        $("input#image-data").cropit('destroy');
    //        $("input#usercropedimage").cropit('destroy');
    //    });
    //
    //    $(document).on('hidden.bs.modal','#myModal', function () {
    //        $("#userimage").value = "";
    //        $("input#image-data").cropit('destroy');
    //        $("input#usercropedimage").cropit('destroy');
    //    });

    function closestore() {
        $('#myModal').modal('hide');

    }

</script>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="padding: 50px;">
            <div class="modal-header">
                {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                <h4 class="modal-title">اضافه کردن کانتکت</h4>
            </div>

            <a class="btn btn-default" id="add_new_image">اضافه کردن عکس</a>
            <br><br>
            <form id="frm-insert" role="form" method="post" action="{{ URL::to('student/store') }}">

                <input type="hidden" name="usercropedimage" id="usercropedimage" class="usercropedimage" />
                <div class="row"  style="clear: both">
                    <div class="col-md-6 col-md-6 col-md-6">
                        <div class="form-group">

                            <input tabindex="2" maxlength="25" type="text" id="family" name="family" value="{{old('family')}}"  class="txtOnly form-control input-md" dir="rtl" placeholder="نام خانوادگی">
                            <small style="color: red;">@foreach($errors->get('family') as $message ) {{$message}}   @endforeach</small>
                            <small id="familywarn" style="display: none;color: red;">نام خانوادگی را به فارسی وارد کنید</small>
                        </div>
                    </div>

                    <div class="col-md-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="1" maxlength="25" type="text" id="name" name="name" value="{{old('name')}}"  class="form-control input-md floatlabel" dir="rtl" placeholder="نام">
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

                <div class="row">

                    <div class="col-md-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="4" type="text" name="birth_date" id="bd" value="{{old('birth_date')}}"  class="form-control input-md floatlabel" dir="rtl" placeholder="تاریخ تولد">
                            <small style="color: red;">@foreach($errors->get('birth_date') as $message ) {{$message}}   @endforeach</small>
                            <small id="bdwarn" style="display: none;color: red;">فرمت تاریخ صحیح نیست</small>
                        </div>
                    </div>

                    <div class="col-md-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="3" id="username" type="text" maxlength="25" name="username" value="{{old('username')}}" class="form-control input-md" dir="rtl" placeholder="نام کاربری">
                            <small style="color: red;">@foreach($errors->get('username') as $message ) {{$message}}   @endforeach</small>
                            <small id="usernamewarn" style="display: none;color: red;">****</small>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 col-md-4 col-md-4">
                        <div class="form-group">
                            <select name="gender" id="gen" tabindex="6" class="form-control" dir="rtl" placeholder="جنسیت">
                                <option value="آقا">آقا</option>
                                <option value="خانم">خانم</option>
                                <option selected disabled value="">جنسیت</option>
                            </select>
                            <small style="color: red;">@foreach($errors->get('gender') as $message ) {{$message}}   @endforeach</small>
                            <small id="genwarn" style="display: none;color: red;">جنسیت خود را انتخاب کنید</small>
                        </div>
                    </div>

                    <div class="col-md-8 col-md-8 col-md-8">
                        <div class="form-group">
                            <input tabindex="5" id="nac" type="number" min="0" step="1" data-bind="value:nac" name="national_code" value="{{old('national_code')}}" class="form-control input-md floatlabel" dir="rtl" placeholder="کد ملی">
                            <small style="color: red;">@foreach($errors->get('national_code') as $message ) {{$message}}   @endforeach</small>
                            <small id="nacwarn" style="display: none;color: red;">کد ملی نمی تواند کمتر از 10 رقم باشد</small>
                            <small id="nacwarnmore" style="display: none;color: red;">کد ملی نمی تواند بیشتر از 10 رقم باشد</small>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 col-md-4 col-md-4">
                        <div class="form-group">
                            <input tabindex="8" id="cell" type="number" min="0" step="1" data-bind="value:cell" maxlength="11" name="cell_phone"  value="{{old('cell_phone')}}" class="form-control input-md" dir="rtl" placeholder="تلفن همراه">
                            <small style="color: red;">@foreach($errors->get('cell_phone') as $message ) {{$message}}   @endforeach</small>
                            <small id="cellwarn" style="display: none;color: red;">شماره تلفن نمی تواند کمتر از 11 رقم باشد</small>
                            <small id="cellwarnmore" style="display: none;color: red;">شماره تلفن نمی تواند بیشتر از 11 رقم باشد</small>
                        </div>
                    </div>

                    <div class="col-md-8 col-md-8 col-md-8">
                        <div class="form-group">
                            <input tabindex="7" id="email" type="email" maxlength="40" name="email" value="{{old('email')}}" class="form-control input-md floatlabel" dir="rtl" placeholder="آدرس پست الکترونیکی">
                            <small style="color: red;">@foreach($errors->get('email') as $message ) {{$message}}   @endforeach</small>
                            <small id="emailwarn" style="display: none;color: red;">****</small>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-xs-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="10" id="passconf" maxlength="60" type="password" name="password_confirmation" class="form-control input-md" dir="rtl" placeholder="تکرار رمز عبور">
                            <small id="passconfwarn" style="display: none;color: red;">****</small>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="9" id="pass" type="password" maxlength="60" name="password" value="{{old('password')}}" class="form-control input-md" dir="rtl" placeholder="رمز عبور">
                            <small style="color: red;">@foreach($errors->get('password') as $message ) {{$message}}   @endforeach</small>
                            <small id="passwarn" style="display: none;color: red;">****</small>
                        </div>
                    </div>
                </div>

                <div class="row modal-footer">

                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="submit" name="submit" value="ذخیره" class="btn btn-default btn-block">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="button" value="بازگشت" onclick="closestore()" data-backdrop="false" class="btn btn-default btn-block"  />
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>