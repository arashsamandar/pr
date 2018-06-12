@extends('Layouts.MainLayout')
@section('pagecnt')
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jquery.Jcrop.min.js')}}"></script>

<img src="<?php echo $image ?>" id="cropimage">

<?= Form::open() ?>
<?= Form::hidden('image', $image) ?>
<?= Form::hidden('x', '', array('id' => 'x')) ?>
<?= Form::hidden('y', '', array('id' => 'y')) ?>
<?= Form::hidden('w', '', array('id' => 'w')) ?>
<?= Form::hidden('h', '', array('id' => 'h')) ?>
<?= Form::submit('Crop it!') ?>
<?= Form::close() ?>

<script type="text/javascript">
    $(function() {
        $('#cropimage').Jcrop({
            onSelect: updateCoords
        });
    });
    function updateCoords(c) {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    };
</script>

@endsection