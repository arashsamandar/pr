<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    function closepass() {
//    $('#frm-update').find('#nac').val('');
//    $('.user_image').find('#userimage').val('');

        $('#student-update').modal('hide');
    }
</script>
<div id="changingpass" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="padding: 50px;">
            <div class="modal-header">
                <h4 class="modal-title">تغییر رمز عبور</h4>
            </div>
            <form method="post" action="{{ URL::to('student/changepass') }}" id="changepass">

                <div class="row">
                    <input type="hidden" name="id" id="id" />
                    <div class="col-xs-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="10" id="passconf" maxlength="60" type="password" name="password_confirmationn" class="form-control input-md" dir="rtl" placeholder="تکرار رمز عبور">
                            <small id="passconfwarn" style="display: none;color: red;">****</small>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="9" id="password" type="password" maxlength="60" name="password" value="{{old('password')}}" class="form-control input-md" dir="rtl" placeholder="رمز عبور">
                            <small style="color: red;">@foreach($errors->get('password') as $message ) {{$message}}   @endforeach</small>
                            <small id="passwarnn" style="display: none;color: red;">****</small>
                        </div>
                    </div>
                </div>

                <div class="row modal-footer">

                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="button" value="بازگشت" onclick="closepass()" data-dismiss="modal" class="btn btn-danger btn-block"  />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="submit" name="submit" value="ذخیره" class="btn btn-success btn-block">
                        </div>
                    </div>



                </div>
            </form>
        </div>
    </div>
</div>