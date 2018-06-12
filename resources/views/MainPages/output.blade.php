@extends('Layouts.UpdeRegis')
@section('URS')

    <div class="container">
        <br><br><br>
        <div class="text-center">
                <a href="{{route('welcome')}}" class="btn btn-default">go back</a>
        </div>
        <div style="margin:0 auto">
                {!! $content !!}
        </div>
    </div>

@endsection