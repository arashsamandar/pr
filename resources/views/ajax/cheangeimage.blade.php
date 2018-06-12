<div id="changeimage" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="padding: 50px">
            <div class="modal-header">
                <h4 class="modal-title">اضافه کردن عکس</h4>
            </div>
            <form method="post" action="" enctype="multipart/form-data" id="cropitbaby" class="user_image">
                <div class="image-editor" style="float: right">
                    <input type="file" id="userimage" name="userimage" class="cropit-image-input">
                    <div class="cropit-preview"><img src="" alt="" id="defaultimage" name="defaultimage" style="cursor:pointer;width:248px;height: 248px;" /></div>
                    <small style="color: red;">@foreach($errors->get('userimage') as $message ) {{$message}}   @endforeach</small>
                    <div class="image-size-label">

                        برش تصویر
                    </div>
                    <input type="range" class="cropit-image-zoom-input">
                    <input type="hidden" name="image-data" id="image-data" class="hidden-image-data" />
                </div>
                <div id="result" style="display: none">
                    <code>$form.serialize() =</code>
                    <code id="result-data"></code>
                </div>
                <div class="row modal-footer">

                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="button" value="بازگشت" data-dismiss="modal" class="btn btn-danger btn-block"  />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="button" name="button" value="ذخیره" data-dismiss="modal" class="btn btn-success btn-block">
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>