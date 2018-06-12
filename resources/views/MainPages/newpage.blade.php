@extends('Layouts.UpdeRegis')

@section('URS')


    <br><br><br>
    <div class="container">
        <div class="row text-center">
            <div class="col-xs-10 col-xs-offset-1">
                <form action="{{route('submit')}}" method="post">
                    <div class="form-group">
                        <textarea class="form-control" name="content" id="input" rows="10"></textarea>
                        <div style="display: none">{{$pastcontent = '<p>hello my name is arash</p>'}}</div>
                        <script>
                            $('#input').html('{{$pastcontent}}');
                        </script>
                    </div>
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-success">save</button>
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

@endsection