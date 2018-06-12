@extends('Layouts.UpdeRegis')

@section('URS')

<div style="width: 100%;height: auto;margin: 50px auto;border:#eee solid 1px;border-radius: 5px;">
        <h2
        style="margin-left:100px;margin-right:50px;padding:10px;border:#eee solid 1px;border-radius: 5px;">
            {{$page_brief}}
        </h2>

<div style=" margin-left:100px;margin-right:50px;margin-bottom:30px;padding:10px;border-radius: 5px;">
      @php
      echo htmlspecialchars_decode($page_content)
      @endphp
</div>
</div>
@endsection