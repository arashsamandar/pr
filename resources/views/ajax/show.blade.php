<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}"/>
<script src="{{asset('js/bootstrap.bundle.js')}}" ></script>


<div id="student-show" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">اضافه کردن کانتکت</h4>
            </div>
            <form action="{{ URL::to('/student/show ') }}" method="get" id="frm-show">
                <div class="modal-body">


                    <div class="col-4-md text-right">
                        <div class="form-group">
                            <label class="text-right">نام</label>
                            <input type="hidden" name="id" id="id" >
                            <input type="text" name="name" id="name" class="form-control text-right">
                        </div>
                    </div>
                    <div class="col-4-md text-right">
                        <div class="form-group">
                            <label>نام خانوادگی</label>
                            <input type="text" name="family" id="family" class="form-control text-right">

                        </div>
                    </div>
                    <div class="col-4-md text-right">
                        <div class="form-group">
                            <label>تلفن</label>
                            <input type="text" name="phone" id="phone" class="form-control text-right">

                        </div>
                    </div>





                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Update">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>