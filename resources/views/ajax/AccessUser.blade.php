<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>

    function samandar() {
//    $('#frm-update').find('#nac').val('');
//    $('.user_image').find('#userimage').val('');
//
        $('.cropit-preview-image').attr('src','');

        $("input#image-data").cropit('destroy');


        $('#user-access')
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();


        $('#user-access').modal('hide');
    }

    $(document).on('show.bs.modal','#user-access', function () {
        $("#userimagee").value = "";
        $("input#image-data").cropit('destroy');
        $("input#usercropedimage").cropit('destroy');
        $('#user-access')
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
    });

    $(document).on('hidden.bs.modal','#user-access', function () {
        $("#userimagee").value = "";
        $("input#image-data").cropit('destroy');
        $("input#usercropedimage").cropit('destroy');
        $('#user-access')
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
    });

    //    $('[data-dismiss=modal]').on('click', function (e) {
    //        var $t = $(this),
    //            target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
    //
    //        $(target)
    //            .find("input,textarea,select")
    //            .val('')
    //            .end()
    //            .find("input[type=checkbox], input[type=radio]")
    //            .prop("checked", "")
    //            .end();
    //    })

</script>


<div id="user-access" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" dir="rtl">
            <div class="modal-header">
                <h4 class="modal-title">مدیریت دسترسی ها</h4>
            </div>

            <form id="frm-access" role="form" method="post" action="{{ URL::to('student/changaccess') }}">
                <input type="hidden" name="id" id="id" />
                <div class="row"  style="clear: both">
                    <div>
                        <div class="form-group">
                            <br>
                            <div dir="rtl" style="margin-right: 50px;font-size: 18px;">
                                <span  >نام کاربری : </span>
                                <span id="thisusername" style="padding-left: 100px;font-size: 18px"></span>
                                <span  >نام : </span>
                                <span style="font-size: 18px" id="thisuser_name"></span>
                                <span style="padding-left: 100px;font-size: 18px" id="thisuser_family"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row"  style="clear: both">
                    <div>
                        <div class="form-group">
                            <br><br>
                            <div dir="rtl" style="margin-right: 50px;font-size: 18px;">
                                <input type="checkbox" id="access_admin_area" value="enter_admin_area">
                                <label for="access_admin_area">ورود به قسمت مدیریت</label><br>

                                <input type="checkbox" id="managing_users" value="enter_managing_users_area">
                                <label for="managing_users">مدیریت کاربران</label>

                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row modal-footer" style="margin: 30px;">

                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="button" value="بازگشت" onclick="samandar()" class="btn btn-danger btn-block"  />
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