<script src="{{asset('js\localones\jquery-2.0.0.min.js')}}"></script>
<script>
    function closecontent() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('#modal-newcontent').modal('hide');
    }
</script>


<div id="modal-newcontent" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 1000px;">
        <!-- Modal content-->
        <div class="modal-content" dir="rtl">
            <div class="modal-header">
                <h4 class="modal-title">ایجاد محتوای جدید</h4>
            </div>

            <form id="frm-newcontentform" action="{{route('saveContent')}}" method="post">

                <input type="hidden" name="user_small_croped_image" id="user_small_croped_image" class="usercropedimage" />
                <input type="hidden" name="user_large_croped_image" id="user_large_croped_image" class="usercropedimage" />
                <input type="hidden" name="user_verysmall_croped_image" id="user_verysmall_croped_image" class="usercropedimage" />

                <input type="hidden" name="id" id="id" />
                <div class="row"  style="clear: both">
                    {{--<div class="form-group">--}}
                    <br>
                    <div dir="rtl" style="margin-right: 50px;margin-left:50px;font-size: 18px;">
                        <label for="title" >عنوان :</label>
                        <input type="text" id="title" name="title" class="form-control input-md"  placeholder="عنوان را وارد کنید" maxlength="30" />
                    </div>
                    {{--</div>--}}
                </div>

                <div class="row"  style="clear: both">
                    {{--<div class="form-group">--}}
                    <div dir="rtl" style="margin-right: 50px;margin-left:50px;font-size: 18px;">
                        <label for="brief" style="margin-top: 10px" >خلاصه :</label>
                        <input type="text" id="brief" name="brief" class="form-control input-md"  placeholder="خلاصه را وارد کنید" maxlength="300" />
                    </div>
                    {{--</div>--}}
                </div>

                <div class="row" style="clear: both;">
                    <div dir="rtl" style="margin-right: 50px;margin-left:50px;font-size: 18px">
                        <label for="inputat" style="margin-top: 10px">محل درج :</label>
                        <select name="inputat" id="inputat" class="form-control" dir="rtl">
                            <option value="1">اسلایدر صفحه ی اول</option>
                            <option value="2">پایین صفحه</option>
                            <option selected disabled value="">محل درج آگهی خود را انتخاب کنید</option>
                        </select>
                        <small style="color: red;">@foreach($errors->get('inputat') as $message ) {{$message}}   @endforeach</small>
                        <small style="display: none;color: red;">محل درج آگهی خود را انتخاب کنید</small>
                    </div>
                </div><br><br>

                <div class="row">
                    <div style="width:925px;margin-right: 50px;margin-left:50px;margin-top:0;font-size: 18px;">
                            <label for="input_definition">شرح :</label>
                                <textarea class="form-control" style="margin-top: 0;" name="input_definition" id="input_definition" rows="10"></textarea>
                                {{--<div style="display: none">{{$arash = '<p>hello my name is arash</p>'}}</div>--}}
                                {{--<script>--}}
                                    {{--$('#input').html('{{$arash}}');--}}
                                {{--</script>--}}
                            {{--{{csrf_field()}}--}}
                    </div>
                </div>

                <div class="row"  style="clear: both">
                    {{--<div class="form-group">--}}
                    <div dir="rtl" style="margin-right: 50px;margin-left:50px;font-size: 18px;">
                        <label for="page_address" style="margin-top: 30px" >آدرس صفحه :</label>
                        <input type="text" id="page_address" name="page_address" class="form-control input-md"  placeholder="آدرس صفحه را وارد کنید" maxlength="30" />
                    </div>
                    {{--</div>--}}
                </div>

                <div class="row" style="width:850px;margin-right: 20px;margin-left:30px;margin-top:10px;font-size: 18px;">

                    <div class="col-md-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <label for="end_date">تاریخ پایان :</label>
                            <input tabindex="4" type="text" name="end_date" id="end_date" value="{{old('end_date')}}"  class="form-control input-md floatlabel" dir="rtl" placeholder="تاریخ پایان">
                            <small style="color: red;">@foreach($errors->get('birth_date') as $message ) {{$message}}   @endforeach</small>
                            <small id="end_date_warn" style="display: none;color: red;">فرمت تاریخ صحیح نیست</small>
                        </div>
                    </div>

                    <div class="col-md-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <label for="start_date">تاریخ شروع :</label>
                            <input tabindex="4" type="text" name="start_date" id="start_date" value="{{old('start_date')}}"  class="form-control input-md floatlabel" dir="rtl" placeholder="تاریخ شروع">
                            <small style="color: red;">@foreach($errors->get('birth_date2') as $message ) {{$message}}   @endforeach</small>
                            <small id="bdwarn" style="display: none;color: red;">فرمت تاریخ صحیح نیست</small>
                        </div>
                    </div>
                </div>

                <div class="row" style="width:850px;margin-right: 35px;margin-left:30px;margin-top:10px;font-size: 18px;">
                     <a class="btn btn-success" id="add_content_images">اضافه کردن عکس ها</a>
                </div>
<br>



                <div class="row modal-footer" style="margin-right: 50px;margin-left:50px;font-size: 18px;">

                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="button" value="بازگشت" onclick="closecontent()" class="btn btn-danger btn-block"  />
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

<script src="{{URL::to('src/js/vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>
{{--<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>--}}

<script>
    var editor_config = {
        path_absolute : "/",
        selector: "textarea",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };
    tinymce.init(editor_config);
</script>