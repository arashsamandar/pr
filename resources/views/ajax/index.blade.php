@include('ajax.updateStudent')
@include('ajax.addStudent')
@include('ajax.updatepass')
@extends('Layouts.UpdeRegis')

@section('URS')

    <div class="alert alert-success" id="success-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>عملیات با موفقیت انجام شد</strong>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2" style="margin: 0 auto;padding-top: 30px"><br>
                <div class="panel panel-default border text-right">
                    <div class="panel-heading text-center border body">کاربران</div>
                    <button class="btn btn-success pull-right" data-toggle="modal" data-target="#myModal">اضافه کردن کانتکت</button>
                    <div dir="rtl">
                        <form method="post" action="{{route('searchName')}}" class="form-horizontal" id="formSearch">
                        <span class="input-group-btn">
                            <input type="text" name="contactname" id="txtSearch" class="form-control text-right"/>
                            <button class="btn btn-info pull-right" id="btnSearch" style="display: none" type="submit">
                                <i class="glyphicon glyphicon-search " style="display:none;">Search</i> </button>
                        </span>
                        </form>
                    </div>
                    <div class="panel-body" id="posts">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">شماره تلفن</th>
                                <th class="text-center">پست الکترونیکی</th>
                                <th class="text-center">تاریخ ایجاد</th>
                                <th class="text-center">جنسیت</th>
                                <th class="text-center">نام کاربری</th>
                                <th class="text-center">نام خانوادگی</th>
                                <th class="text-center">نام</th>
                                <th class="text-center">انجام عملیات</th>
                            </tr>
                            </thead>
                            <tbody id="student-info" class="text-center">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});</script>

    <script type="text/javascript">
        $(function () {
            $("#success-alert").hide();
        });

        $(function () {
            $.get("{{URL::to('student/read-data')}}",function (data) {

                $('#student-info').empty().html(data);
            })
        })
        //-------------------------------------Add Contact------------------------------------

        $('body').delegate('#student-info #view','click',function (e) {
            var id = $(this).data('id');

            $.get("{{ URL::to('student/showpassword') }}", {id: id}, function (data) {
                $('#changingpass').find('#id').val(data.id);
                $('#changingpass').find('#passs').val(data.name);
                $('#changingpass').find('#passconff').val(data.name);
                $('#changingpass').modal('show');
            });
        });


        $('#changepass').on('submit',function (e) {
            var userpass = $('#password').val();
            var userid = $('#changingpass').find('#id').val();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            e.preventDefault();
            $.ajax({
                type:post,
                url:url,
                data:{mypass : userpass,myid : userid},
                dataty:'json',
                success:function (data) {
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                        $("#success-alert").slideUp(500);
                    });
                }
            });
        });




        $('#frm-insert').on('submit',function (e) {
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            e.preventDefault();
            $.ajax({
                type:post,
                url:url,
                data:data,
                dataty:'json',
                success:function (data) {
                    var tr = $('<tr/>',{
                        id : data.id
                    });
                    tr.append($('<td/>',{
                        text:data.id
                    })).append($('<td/>',{
                        text:data.cell_phone
                    })).append($('<td/>',{
                        text:data.email
                    })).append($('<td/>',{
                        text:data.created_at_shamsi
                    })).append($('<td/>',{
                        text:data.gender
                    })).append($('<td/>',{
                        text:data.username
                    })).append($('<td/>',{
                        text:data.family
                    })).append($('<td/>',{
                        text:data.name
                    })).append($('<td/>',{


                        html : '<a href="#" class="btn btn-info btn-sm" id="view" data-id="' + data.id + '">تغییر رمز</a> '
                        + '<a href="#" class="btn btn-success btn-sm" id="edit" data-id="' + data.id + '">ویرایش</a> ' +
                        '<a href="#" class="btn btn-danger btn-sm" id="del" data-id="' + data.id + '">حذف</a>'
                    }));


                    $("input#image-data").cropit('destroy');
                    $('#student-info').append(tr);
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                        $("#success-alert").slideUp(500);
                    });
                }
            })
        })

        //----------------------------------Delete Contact--------------------------------------



        $('body').delegate('#student-info tr #del','click',function (e) {
            var id = $(this).data('id');
            $.post('{{URL::to("student/destroy")}}',{id:id},function (data) {
                $('tr#'+id).remove();
            })
        })

        //---------------------------------Student Update----------------------------------------

        $('body').delegate('#student-info #edit','click',function (e) {
            var id = $(this).data('id');

            $.get("{{ URL::to('users/edit') }}",{id:id},function (data) {

                $('#frm-update').find('#id').val(data.id);
                $('#frm-update').find('#namee').val(data.name);
                $('#frm-update').find('#familyy').val(data.family);
                $('#frm-update').find('#usernamee').val(data.username);
                $('#frm-update').find('#bdd').val(data.birth_date);
                $('#frm-update').find('#celll').val(data.cell_phone);
                $('#frm-update').find('#nacc').val(data.national_code);

                $('#frm-update').find('#emaill').val(data.email);
                $('#frm-update').find('#genderr').val(data.gender);


                if(typeof data[0] !== 'undefined') {

                    $('.user_image').find('#defaultimagee').attr('src', data[0].image);

                }



                $('#student-update').modal('show');

            })


        })


        //---------------------------------Student Update----------------------------------------


        $('#frm-update').on('submit',function (e) {
            var communication;
            $('#frm-insert').find("input#image-data").value = '';
            $('#frm-insert').find("input#usercropedimage").value = '';
            $('#frm-insert').passdata = null;
            $('#cropitbabyy').on('submit',function (e) {
                e.preventDefault();
            });
            $('#cropitbabyy').submit();
            var passdata = $("input#image-dataa").val();
            console.log(passdata);
            $("input#usercropedimagee").val(passdata);
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            e.preventDefault();
            $.ajax({
                type: post,
                url: url,
                data: data,
                dataty:'json',
                success: function (data) {
                    console.log(data.name);
                    var tr = $('<tr/>',{
                        id : data.id
                    });
                    tr.append($('<td/>',{
                        text:data.id
                    })).append($('<td/>',{
                        text:data.cell_phone
                    })).append($('<td/>',{
                        text:data.email
                    })).append($('<td/>',{
                        text:data.created_at_shamsi
                    })).append($('<td/>',{
                        text:data.gender
                    })).append($('<td/>',{
                        text:data.username
                    })).append($('<td/>',{
                        text:data.family
                    })).append($('<td/>',{
                        text:data.name
                    })).append($('<td/>',

                        {
                            html : '<a href="#" class="btn btn-info btn-sm" id="view" data-id="' + data.id + '">تغییر رمز</a> '
                            + '<a href="#" class="btn btn-success btn-sm" id="edit" data-id="' + data.id + '">ویرایش</a> ' +
                            '<a href="#" class="btn btn-danger btn-sm" id="del" data-id="' + data.id + '">حذف</a>'
                        }))



                    $('#student-info tr#' + data.id).replaceWith(tr);
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                        $("#success-alert").slideUp(500);
                    });
                }
            });
        });


        $('#formSearch').on('submit', function (e) {
            e.preventDefault();
            var name = $('#txtSearch').val();
            var url = $('#formSearch').attr('action');
            var post = $('#formSearch').attr('method');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: post,
                url: url,
                data: {name: name},
                success: function (data) {
                    var arr = Object.values(data);
                    console.log(arr);
                    $('#frm-update').find('#id').val(arr[0]['id']);
                    $('#frm-update').find('#namee').val(arr[0]['name']);
                    $('#frm-update').find('#familyy').val(arr[0]['family']);
                    $('#frm-update').find('#bdd').val(arr[0]['birth_date']);
                    $('#frm-update').find('#usernamee').val(arr[0]['username']);
                    $('#frm-update').find('#nacc').val(arr[0]['national_code']);
                    $('#frm-update').find('#emaill').val(arr[0]['email']);
                    $('#frm-update').find('#genderr').val(arr[0]['gender']);
                    $('#frm-update').find('#celll').val(arr[0]['cell_phone']);

                    if(typeof arr[0] !== 'undefined') {

                        $('.user_image').find('#defaultimagee').attr('src', arr[1]['image']);

                    }

                    $('#student-update').modal('show');
                }
            })
        })

    </script>


@endsection
