
@include('ajax.NewContentAdd')
@include('ajax.UpdateContent')
@include('ajax.AddContentImages')
@extends('Layouts.UpdeRegis')

@section('URS')

    <div class="alert alert-success" id="success-alert" style="display: none">
        <strong>عملیات با موفقیت انجام شد</strong>
    </div>

    <div class="alert alert-danger" id="warning-alert" style="display: none">
        <strong>محتوای مورد نظر یافت نشد</strong>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2 " style="margin: 0 auto;padding-top: 30px"><br>
                <div class="panel panel-default border text-right">
                    <div class="panel-heading text-center border body">محتوا</div>
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
                                <th class="text-center" style="font-size: 12px;font-weight: bold">تاریخ خاتمه</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">تاریخ شروع</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">آدرس صفحه</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">محل درج</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">خلاصه</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">عنوان</th>






                            </tr>
                            </thead>
                            <tbody id="content-info" class="text-center" style="font-size: 12px;">
                            @foreach($contents as $value)

                                <tr id="{{$value->id}}">

                                    <td>

                                        <a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="{{$value->id}}">ویرایش</a>
                                        <a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="{{$value->id}}">حذف</a>

                                    </td>

                                    <td style="font-size: 12px">{{$value->End_at}}</td>
                                    <td style="font-size: 12px">{{$value->Begin_at}}</td>
                                    <td style="font-size: 12px">{{$value->page_address}}</td>
                                    <td style="font-size: 12px">{{$value->input_at}}</td>
                                    <td style="font-size: 12px">{{$value->brief}}</td>
                                    <td style="font-size: 12px">{{$value->title}}</td>



                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <div class="input-group">
                            <div style="float: left">
                                {{ $contents->render() }}
                            </div>
                            <span class="input-group-btn">
                              <button class="btn btn-success" data-toggle="modal" data-target="#modal-newcontent">محتوای جدید</button>
                           </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('contents')}});</script>

    <script type="text/javascript">
        $(function () {
            $("#success-alert").hide();
        });

        $('#add_content_images').click(function (e) {
            $('#addcontentimages').modal('show');
        });

//        $('#add_content_imagess').click(function (e) {
//            $('#addcontentimages').modal('show');
//        });

        $('#add_content_imagess').click(function (e) {

            var id = $('#frm-updatecontentform').find('#id').val();

            {{--if(id !== "") {--}}
                {{--$('#newid').val(id);--}}
                {{--$.get("{{ URL::to('/content/showcontentimage') }}", {id: id}, function (data) {--}}
                    {{--universal = data[0].imageone;--}}

                    {{--$('#user_content_image').attr('src', data[0].imageone);--}}
                    {{--$('#user_content_image_small').attr('src', data[0].imagetwo);--}}
                    {{--$('#user_content_image_verysmall').attr('src', data[0].imagethree);--}}


                    $('#addcontentimages').modal('show');
//                });
//            }

        });

        //-------------------------------------Show User Password------------------------------------

        $('body').delegate('#content-info #view','click',function (e) {
            var id = $(this).data('id');

            $.get("{{ URL::to('student/showpassword') }}", {id: id}, function (data) {
                $('#changingpass').find('#id').val(data.id);
                $('#changingpass').find('#passs').val(data.name);
                $('#changingpass').find('#passconff').val(data.name);
                $('#changingpass').modal('show');
            });
        });

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

        $('#frm-newcontentform').on('submit',function (e) {
            var imageData = null;
            var imageData2 = null;
            var imageData3 = null;


                $('#cropcontentimages').on('submit', function (e) {
                    e.preventDefault();
                });
                $('#cropcontentimages').submit(function (e) {
                    imageData = $('.image-editor').cropit('export');
                    imageData2 = $('#second-image-editor').cropit('export');
                    imageData3 = $('#third-image-editor').cropit('export');
                    $('.hidden-image-data').val(imageData);
                    $('.second-hidden-image-data').val(imageData2);
                    $('.third-hidden-image-data').val(imageData3);
                });

                $('#cropcontentimages').submit();





            $("input#user_large_croped_image").val(imageData);
            $("input#user_small_croped_image").val(imageData2);
            $("input#user_verysmall_croped_image").val(imageData3);


            tinyMCE.triggerSave();
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
                        html :
                        '<a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="' + data.id + '">ویرایش</a> ' +
                        '<a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="' + data.id + '">حذف</a>'
                    })).append($('<td/>',{
                        text:data.End_at
                    })).append($('<td/>',{
                        text:data.Begin_at
                    })).append($('<td/>',{
                        text:data.page_address
                    })).append($('<td/>',{
                        text:data.input_at
                    })).append($('<td/>',{
                        text:data.brief
                    })).append($('<td/>',{
                        text:data.title
                    }));


                    $('#user_content_image').val('');
                    $('#modal-newcontent').modal('hide');
                    $('#content-info').append(tr);
                    $('#success-alert').css('display','block');
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                        $("#success-alert").slideUp(500);
                    });
                }
            })
        })

        //----------------------------------Delete User--------------------------------------



        $('body').delegate('#content-info tr #del','click',function (e) {
            var id = $(this).data('id');
            $.post('{{URL::to("content/destroy")}}',{id:id},function (data) {
                $('tr#'+id).remove();
            });
        });

        //---------------------------------Show Access User----------------------------------------

        $('body').delegate('#content-info #chaccess','click',function (e) {
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

        $('body').delegate('#content-info #edit','click',function (e) {
            var id = $(this).data('id');

            $.get("{{ URL::to('content/edit') }}",{id:id},function (data) {

                $('#frm-updatecontentform').find('#id').val(data.id);
                $('#frm-updatecontentform').find('#titlee').val(data.title);
                $('#frm-updatecontentform').find('#brieff').val(data.brief);
                $('#frm-updatecontentform').find('#inputatt').val(data.input_at);
                if(data.definition != '') {
                    tinyMCE.activeEditor.setContent(data.definition);
                }
                $('#frm-updatecontentform').find('#page_addresss').val(data.page_address);
                $('#frm-updatecontentform').find('#start_datee').val(data.Begin_at);
                $('#frm-updatecontentform').find('#end_datee').val(data.End_at);
                universal = data[0].imageone;

                    $('#large_image').attr('src', data[0].imageone);
                    $('#small_image').attr('src',data[0].imagetwo);
                    $('#verysmall_image').attr('src',data[0].imagethree);



                $('#modal-updatecontent').modal('show');
            });
        });


        //---------------------------------Do Update Content----------------------------------------


        $('#frm-updatecontentform').on('submit',function (e) {

            var imageData = null;
            var imageData2 = null;
            var imageData3 = null;




                $('#cropcontentimages').on('submit', function (e) {
                    e.preventDefault();
                });
                $('#cropcontentimages').submit(function (e) {
                    if($('#user_content_image').val() !== "") {
                        imageData = $('.image-editor').cropit('export');
                        $('.hidden-image-data').val(imageData);
                    }
                    if($('#user_content_image_small').val() !== "") {
                        imageData2 = $('#second-image-editor').cropit('export');
                    }
                    imageData3 = $('#third-image-editor').cropit('export');
                    $('.second-hidden-image-data').val(imageData2);
                    $('.third-hidden-image-data').val(imageData3);
                });

                $('#cropcontentimages').submit();

                $("input#user_large_croped_image").val(imageData);
                $("input#user_small_croped_image").val(imageData2);
                $("input#user_verysmall_croped_image").val(imageData3);


            $("input#user_large_croped_image").val(imageData);
            $("input#user_small_croped_image").val(imageData2);
            $("input#user_verysmall_croped_image").val(imageData3);

            tinyMCE.triggerSave();


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
                    $('#modal-updatecontent').modal('hide');
                    var tr = $('<tr/>',{
                        id : data.id
                    });
                    tr.append($('<td/>',{
                        html :
                        '<a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="' + data.id + '">ویرایش</a> ' +
                        '<a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="' + data.id + '">حذف</a>'
                    })).append($('<td/>',{
                        text:data.End_at
                    })).append($('<td/>',{
                        text:data.Begin_at
                    })).append($('<td/>',{
                        text:data.page_address
                    })).append($('<td/>',{
                        text:data.input_at
                    })).append($('<td/>',{
                        text:data.brief
                    })).append($('<td/>',{
                        text:data.title
                    }));

                    $('#user_content_image_small').val('');
                    $('#user_content_image').val('');
                    $('#content-info tr#' + data.id).replaceWith(tr);
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


                    $('.user_image').find('#defaultimagee').attr('src', arr[1]['image']);


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