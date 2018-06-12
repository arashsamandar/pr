@include('ajax.updateStudent')
@include('ajax.addStudent')
@include('ajax.updatepass')
@include('ajax.AccessUser')
@include('ajax.cheangeimage')
@extends('Layouts.UpdeRegis')

@section('URS')

    <div class="alert alert-success" id="success-alert" style="display: none">
        <strong>عملیات با موفقیت انجام شد</strong>
    </div>

    <div class="alert alert-danger" id="warning-alert" style="display: none">
        <strong>کاربر مورد نظر یافت نشد</strong>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2 " style="margin: 0 auto;padding-top: 30px"><br>
                <div class="panel panel-default border text-right">
                    <div class="panel-heading text-center border body">کاربران</div>
                    <div dir="rtl">
                        <form method="post" action="{{route('searchName')}}" class="form-horizontal" id="formSearch">
                            <div class="input-group">
                                <input type="text" class="form-control" name="contactname" id="txtSearch">
                               <span class="input-group-btn">
                                   <button id="btnSearch" type="submit" style="border: none">
                                <i class="btn btn-info btn-md" style="width: 70px;font-size: 12px">جستجو</i> </button>
                               </span>
                            </div>
                        </form>
                    </div>
                    <div class="panel-body" id="posts">
                        <table class="table table-bordered">
                            <thead>
                            <tr>

                                <th class="text-center" style="font-size: 12px;font-weight: bold">انجام عملیات</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">شماره تلفن</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">پست الکترونیکی</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">تاریخ ایجاد</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">جنسیت</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">نام کاربری</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">نام خانوادگی</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">نام</th>

                            </tr>
                            </thead>
                            <tbody id="student-info" class="text-center" style="font-size: 12px">
                            @foreach($contacts as $value)

                                <tr id="{{$value->id}}">

                                    <td>

                                        <a href="#" class="btn btn-info btn-sm" style="width: 70px;font-size: 12px" id="view" data-id="{{$value->id}}">تغییر رمز</a>
                                        <a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="{{$value->id}}">ویرایش</a>
                                        <a href="#" class="btn btn-warning btn-sm" style="width: 70px;font-size: 12px" id="chaccess" data-id="{{$value->id}}">دسترسی ها</a>
                                        <a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="{{$value->id}}">حذف</a>

                                    </td>

                                    <td style="font-size: 12px">{{$value->cell_phone}}</td>
                                    <td style="font-size: 12px">{{$value->email}}</td>
                                    <td style="font-size: 12px">{{$value->created_at_shamsi}}</td>
                                    <td style="font-size: 12px">{{$value->gender}}</td>
                                    <td style="font-size: 12px">{{$value->username}}</td>
                                    <td style="font-size: 12px">{{$value->family}}</td>
                                    <td style="font-size: 12px">{{$value->name}}</td>



                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <div class="input-group">
                            <div style="float: left">
                                {{ $contacts->render() }}
                            </div>
                            <span class="input-group-btn">
                              <a href="#" class="btn btn-success" id="addoneuser">کاربر جدید</a>
                           </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});</script>

    <script type="text/javascript">
        var universal = null;
        $(function () {
            $("#success-alert").hide();
        });

        $('#add_new_image').click(function (e) {
            $('#changeimage').modal('show');
        });

        $('#add_new_imagee').click(function (e) {
            $('#changeimage').modal('show');
        });

        //-------------------------------------Show User Password------------------------------------

        $('body').delegate('#student-info #view','click',function (e) {
            var id = $(this).data('id');

            $.get("{{ URL::to('student/showpassword') }}", {id: id}, function (data) {
                $('#changingpass').find('#id').val(data.id);
                $('#changingpass').find('#passs').val(data.name);
                $('#changingpass').find('#passconff').val(data.name);
                $('#changingpass').modal('show');
            });
        });

        $('#addoneuser').click(function () {
            $('#myModal').modal('show');
        })

        //-----------------------------Do User Password------------------------------------

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
                    $('#changingpass').modal('hide');
                    $('#success-alert').css('display','block');
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                        $("#success-alert").slideUp(500);
                    });
                }
            });
        });


        //------------------------------------Add New User-----------------------------------

        $('#frm-insert').on('submit',function (e) {
            universal = null;
            if($('#userimage').val() !== "") {
                universal = null;

                $('#frm-insert').passdata = null;
                $('#cropitbaby').on('submit', function (e) {
                    e.preventDefault();
                });
                $('#cropitbaby').submit();
                universal = $("input#image-data").val();

                console.log(universal);

            }
            $("input#usercropedimage").val(universal);
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
                    $('#myModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    var tr = $('<tr/>',{
                        id : data.id
                    });
                    tr.append($('<td/>',{
                        html : '<a href="#" class="btn btn-info btn-sm" style="width: 70px;font-size: 12px" id="view" data-id="' + data.id + '">تغییر رمز</a> '
                        + '<a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="' + data.id + '">ویرایش</a> ' +
                        '<a href="#" class="btn btn-warning btn-sm" style="width: 70px;font-size: 12px" id="chaccess" data-id="' + data.id + '">دسترسی ها</a> ' +
                        '<a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="' + data.id + '">حذف</a>'
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
                    }));
                    $('#userimage').val('');
                    universal = null;

                    $('#student-info').append(tr);
                    $('#success-alert').css('display','block');
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                        $("#success-alert").slideUp(500);
                    });
                }
            })
        })

        //----------------------------------Delete User--------------------------------------



        $('body').delegate('#student-info tr #del','click',function (e) {
            var id = $(this).data('id');
            $.post('{{URL::to("student/destroy")}}',{id:id},function (data) {
                $('tr#'+id).remove();
            })
        })
        
        //---------------------------------Show Access User----------------------------------------
        
        $('body').delegate('#student-info #chaccess','click',function (e) {
           var id = $(this).data('id');
           $.get("{{URL::to('student/showaccess')}}",{id:id},function (data) {
               $('#frm-access').find('#id').val(data.id);
               $('#frm-access').find('#thisusername').text(data.username);
               $('#frm-access').find('#thisuser_name').text(data.name + ' ' + data.family);


               $('#user-access').modal('show');
           })
        });

        //---------------------------------Do Update User------------------------------------------

        $('#frm-access').on('submit',function (e) {
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
                    $('#user-access').modal('hide');
                    $('#success-alert').css('display','block');
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                        $("#success-alert").slideUp(500);
                    });
                }
            });
        });

        //---------------------------------Show Update User----------------------------------------

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
                universal = data[0].image;

                if(typeof data[0] !== 'undefined') {

                    $('#defaultimagee').attr('src', data[0].image);

                }

                $('#student-update').modal('show');
            })
        })


        //---------------------------------Do Update User----------------------------------------


        $('#frm-update').on('submit',function (e) {
            if($("#userimage").val() !== "") {
                universal = null;
                $('#frm-insert').passdata = null;
                $('#cropitbaby').on('submit',function (e) {
                    e.preventDefault();
                });
                $('#cropitbaby').submit();
                universal = $("input#image-data").val();
//                console.log(universal);
                $("input#usercropedimagee").val(universal);
            }

            $("input#usercropedimagee").val(universal);
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
                    $('#student-update').modal('hide');
                    var tr = $('<tr/>',{
                        id : data.id
                    });
                    tr.append($('<td/>',{
                        html : '<a href="#" class="btn btn-info btn-sm" style="width: 70px;font-size: 12px" id="view" data-id="' + data.id + '">تغییر رمز</a> '
                        + '<a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="' + data.id + '">ویرایش</a> ' +
                        '<a href="#" class="btn btn-warning btn-sm" style="width: 70px;font-size: 12px" id="chaccess" data-id="' + data.id + '">دسترسی ها</a> ' +
                        '<a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="' + data.id + '">حذف</a>'
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
                    }));

                    $('#userimage').val('');
                    universal = null;

                    $('#student-info tr#' + data.id).replaceWith(tr);
                    $('#success-alert').css('display','block');
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                        $("#success-alert").slideUp(500);
                    });
                }
            });
        });

        //------------------------------------Search User-----------------------------------

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
                    $('#success-alert').css('display','block');
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                        $("#success-alert").slideUp(500);
                    });
                    var arr = Object.values(data);
                    
                    $('#frm-update').find('#id').val(arr[0]['id']);
                    $('#frm-update').find('#namee').val(arr[0]['name']);
                    $('#frm-update').find('#familyy').val(arr[0]['family']);
                    $('#frm-update').find('#bdd').val(arr[0]['birth_date']);
                    $('#frm-update').find('#usernamee').val(arr[0]['username']);
                    $('#frm-update').find('#nacc').val(arr[0]['national_code']);
                    $('#frm-update').find('#emaill').val(arr[0]['email']);
                    $('#frm-update').find('#genderr').val(arr[0]['gender']);
                    $('#frm-update').find('#celll').val(arr[0]['cell_phone']);

                    universal = data[1]['image'];

                    if(typeof data[0] !== 'undefined') {

                        $('#defaultimagee').attr('src', data[1]['image']);

                    }

                    $('#student-update').modal('show');

                }
                ,error :function (e) {
                    $('#warning-alert').css('display','block');
                    $("#warning-alert").fadeTo(2000, 500).slideUp(500, function() {
                        $("#warning-alert").slideUp(500);
                    });
                }
            })
        })

    </script>



    <script>
        //---------------------------------------Relates to Pagination part-----------------------------------
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});</script>

@endsection