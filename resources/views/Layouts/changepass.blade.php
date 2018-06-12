@extends('Layouts.UpdeRegis')
@section('URS')

    <div class="container" style="padding-top: 200px">
        <div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="passchangeform" role="form" method="post" enctype="multipart/form-data" action="">

                        <div class="row" dir="rtl">
                            <div class="col-xs-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="10" id="passconf" maxlength="60" type="password" name="password_confirmation" class="form-control input-md" placeholder="تکرار رمز عبور">
                                    <small id="passconfwarn" style="display: none;color: red;">رمز عبور با تکرار آن برابر نیست</small>
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

                        <input type="submit" name="submit" value="تغییر پسورد" class="btn btn-info btn-block">

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection