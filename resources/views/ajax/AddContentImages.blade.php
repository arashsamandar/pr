<div id="addcontentimages"  class="modal fade" role="dialog" >
    <div class="modal-dialog" style="width: 900px;margin:0 auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h4>اضافه کردن تصاویر</h4>
                <input type="hidden" id="newid" name="newid" />
            </div>
            <form method="post" action="" enctype="multipart/form-data" id="cropcontentimages" class="user_image">
                <div class="image-editor" style="margin-left: 50px;margin-right: 50px">
                    <label for="user_content_image">انتخاب تصویر برای اسلایدر :</label>
                    <input type="file" id="user_content_image" name="user_content_image" class="cropit-image-input" style="margin-right: 50px;">
                    <div class="cropit-preview" style="width: 800px;height: 500px;margin-right: 50px"></div>
                    <small style="color: red;">@foreach($errors->get('userimage') as $message ) {{$message}}   @endforeach</small>
                    <div class="image-size-label">

                        برش تصویر
                    </div>
                    <input type="range" class="cropit-image-zoom-input">
                    <input type="hidden" name="image-data" id="image-data" class="hidden-image-data" />
                </div>

                <br>


                <div class="image-editor" id="second-image-editor" style="padding-top:15px;float: right;margin-right: 50px">
                    <label for="user_content_image_small">انتخاب تصویر برای پایین صفحه :</label>
                    <input type="file" id="user_content_image_small" name="user_content_image_small" class="cropit-image-input" style="margin-left: 50px">
                    <div class="cropit-preview" style="cursor:pointer;width:640px;height: 400px;margin-left: 50px;" ></div>
                    <small style="color: red;">@foreach($errors->get('userimage') as $message ) {{$message}}   @endforeach</small>
                    <div class="image-size-label">

                        برش تصویر
                    </div>
                    <input type="range" class="cropit-image-zoom-input" style="margin-left: 50px">
                    <input type="hidden" name="second-image-data" id="second-image-data" class="second-hidden-image-data" />
                </div>

                <br>


                <div class="image-editor" id="third-image-editor" style="padding-top:15px;float: right;margin-right: 50px">
                    <label for="user_content_image_verysmall">تصویر بند انگشتی :</label>
                    <input type="file" id="user_content_image_verysmall" name="user_content_image_verysmall" class="cropit-image-input" style="margin-right: 50px;margin-left: 50px">
                    <div class="cropit-preview" style="width: 100px;height: 100px;margin-left: 50px;margin-right: 50px"></div>
                    <small style="color: red;">@foreach($errors->get('userimage') as $message ) {{$message}}   @endforeach</small>
                    <div class="image-size-label">

                        برش تصویر
                    </div>
                    <input type="range" class="cropit-image-zoom-input">
                    <input type="hidden" name="image-data3" id="image-data3" class="third-hidden-image-data" />
                </div>


                <div class="row modal-footer" style="margin-top:15px;margin-right: 50px;margin-left:50px;font-size: 18px;">

                    <div class="col-md-9" style="margin-top: 50px">
                        <div class="form-group">
                            <input type="button" value="بازگشت" data-dismiss="modal" class="btn btn-danger btn-block"  />
                        </div>
                    </div>

                    <div class="col-md-3" style="margin-top: 50px">
                        <div class="form-group">
                            <input type="button" value="ذخیره" data-dismiss="modal" class="btn btn-success btn-block"  />
                        </div>
                    </div>

                </div>
            </form>
            <div id="result" style="display: none">
                <code>$form.serialize() =</code>
                <code id="result-data"></code>
            </div>
        </div>
    </div>
</div>