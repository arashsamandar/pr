@extends('Layouts.header')
@section('contents')

    <div class="container">
        <br><br><br>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            {{--<ol class="carousel-indicators">--}}
                {{--<li data-target="#myCarousel" data-slide-to="0" class="active"></li>--}}
                {{--<li data-target="#myCarousel" data-slide-to="1"></li>--}}
                {{--<li data-target="#myCarousel" data-slide-to="2"></li>--}}
                {{--<li data-target="#myCarousel" data-slide-to="3"></li>--}}
                {{--@php $global_imageItterator = \App\Http\Controllers\AjaxContentController::checkContent_Image_Number() @endphp--}}
                {{--@if(!empty($global_imageItterator))--}}
                    {{--@for ($i = 0; $i < count($global_imageItterator[0]); $i++)--}}
                        {{--<li data-target="#myCarousel" data-slide-to="{{4 + $i}}"></li>--}}
                    {{--@endfor--}}
                {{--@endif--}}
            {{--</ol>--}}

        @php $global_imageItterator = \App\Http\Controllers\AjaxContentController::checkContent_Image_Number() @endphp
            <!-- Wrapper for slides -->
            <div class="carousel-inner" style="position: relative;width: 100%">

                @if(!empty($global_imageItterator))
                    @for ($i = 0; $i < count($global_imageItterator[0]); $i++)

                        <figure class="item" style="background-color: rgba(0, 0, 0, 0.6);color: white;width: 100%">
                            <a href="{{route('page_caller',['page_address' => $global_imageItterator[1][$i]])}}">
                                <img src="{{ $global_imageItterator[3][$i]  }}" style="width:100%;" />
                                <div class="carousel-caption" style="background-color: rgba(0, 0, 0, 0.6);color: white;width: 100%;text-align: right;padding-right: 20px">
                                    <h3>{{ $global_imageItterator[1][$i]  }}</h3>
                                    <p>{{ $global_imageItterator[2][$i]  }}</p>
                                </div>
                            </a>
                        </figure>

                    @endfor
                @endif


                <figure class="item">
                    <a href="#"><img src="{{asset('images/Atehran.jpg')}}"  style="width:100%;"></a>
                </figure>

                <figure class="item active">
                    <a href="#"><img src="{{asset('images/Bwebdesign.jpg')}}" title="ارائه خدمات طراحی، راه اندازی و پشتیبانی سایت های اینترنتی با استفاده از فناوری های روز دنیا از قبیل PHP، MySQL، Bootstrap، Jscript، Ajax و ..."  style="width:100%;"></a>
                </figure>

                <figure class="item">
                    <a href="#"><img src="{{asset('images/offices.jpg')}}"  style="width:100%;"></a>
                </figure>

                <figure class="item">
                    <a href="#"><img src="{{asset('images/zolo.jpg')}}"  style="width:100%;"></a>
                </figure>

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control"  href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>

    </div>
    <br><br><br>

    <div  style="width: 100%;margin: 0 auto;">

        <figure style="width: 30%;margin-left:2%;margin-right: 3.3%;height: auto;float:right;position: relative;margin-bottom: 20px;color: white"  >
            <a href="{{route('page_caller',['page_address' => 'ShahrPaad'])}}"><img src="{{asset('images/ntwo.jpg')}}" class="img-responsive" /></a>
            <figcaption class="figcap" style="position: absolute;top: 82%;right: 0;padding-top:10px;padding-bottom:10px;background: rgba(0, 0, 0, 0.6);width: 100%">پروژه شهرپاد</figcaption>

        </figure>

        <figure style="width: 30%;margin-left:2%;height: auto;float: right;position: relative;margin-bottom: 20px;color: white;"  >
            <a href="{{route('page_caller',['page_address' => 'aboutUs'])}}"><img src="{{asset('images/none.jpg')}}" class="img-responsive" /></a>
            <figcaption class="figcap" style="position: absolute;top: 82%;right: 0;padding-top:10px;padding-bottom:10px;background: rgba(0, 0, 0, 0.6);width: 100%">طراحی و پشتیبانی سایت های اینترنتی
            </figcaption>
        </figure>
        <figure style="width: 30%;height: auto;float:right;position: relative;margin-bottom: 20px;color:white;"  >
            <a href="{{route('page_caller',['page_address' => 'aboutUs'])}}"><img src="{{asset('images/nthree.jpg')}}" class="img-responsive" /></a>
            <figcaption class="figcap" style="position: absolute;top: 82%;right: 0;padding-top:10px;padding-bottom:10px;background: rgba(0, 0, 0, 0.6);width: 100%">آگهی نامه مدیریت شهری</figcaption>
        </figure>

    </div>

    @php
        $global_imageIterator_bellowSlider = \App\Http\Controllers\AjaxContentController::checkContent_Image_Number_Bellow_Slider();
        if(!empty($global_imageIterator_bellowSlider)) {
            $number_ofImages = count($global_imageIterator_bellowSlider[0]);
            $counter = 0;
        }
    //    $how_many_chunk_of_3_do_we_have = 0;
    //    $the_remaining_of_Images = $number_ofImages % 3;
    //    for($j = 1;$j< $number_ofImages + 1;$j++) {
    //        if($j % 3 == 0) {
    //          $how_many_chunk_of_3_do_we_have++;
    //        }
    //    }
    @endphp

    @if(!empty($global_imageIterator_bellowSlider))
        @while($counter < $number_ofImages)
            <div  style="width: 100%;">
                @if(isset($global_imageIterator_bellowSlider[0][$counter]))
                    <figure style="width: 30%;margin-left:2%;margin-right: 3.3%;height: auto;float:right;position: relative;margin-bottom: 20px"  >
                        <a href="{{route('page_caller',['page_address' => $global_imageIterator_bellowSlider[1][$counter]])}}"><img src="{{$global_imageIterator_bellowSlider[3][$counter++]}}" class="img-responsive" /></a>
                        <figcaption class="figcap" style="position: absolute;top: 82%;right: 0;padding-top:10px;padding-bottom:10px;background: rgba(0, 0, 0, 0.6);color: white;width: 100%">{{$global_imageIterator_bellowSlider[1][$counter -1]}}</figcaption>
                    </figure>
                @endif
                @if(isset($global_imageIterator_bellowSlider[0][$counter]))
                    <figure style="width: 30%;margin-left:2%;height: auto;float: right;position: relative;color: white;margin-bottom: 20px"  >
                        <a href="{{route('page_caller',['page_address' => $global_imageIterator_bellowSlider[1][$counter]])}}"><img src="{{$global_imageIterator_bellowSlider[3][$counter++]}}" class="img-responsive" /></a>
                        <figcaption class="figcap" style="position: absolute;top: 82%;right: 0;padding-top:10px;padding-bottom:10px;background: rgba(0, 0, 0, 0.6);color: white;width: 100%">{{$global_imageIterator_bellowSlider[1][$counter -1]}}</figcaption>
                    </figure>
                @endif
                @if(isset($global_imageIterator_bellowSlider[0][$counter]))
                    <figure style="width: 30%;height: auto;float:right;position: relative;color: white;margin-bottom: 20px"  >
                        <a href="{{route('page_caller',['page_address' => $global_imageIterator_bellowSlider[1][$counter]])}}"><img src="{{$global_imageIterator_bellowSlider[3][$counter++]}}" class="img-responsive" /></a>
                        <figcaption class="figcap" style="position: absolute;top: 82%;right: 0;padding-top:10px;padding-bottom:10px;background: rgba(0, 0, 0, 0.6);width: 100%">{{$global_imageIterator_bellowSlider[1][$counter -1]}}</figcaption>
                    </figure>
                @endif
            </div>
        @endwhile
    @endif


    {{--@if(0 < $the_remaining_of_Images)--}}

        {{--@for($m = 0;$m < $the_remaining_of_Images;$m++)--}}

        {{--@endfor--}}

    {{--@endif--}}








@endsection