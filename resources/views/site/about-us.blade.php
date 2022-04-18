@extends('layouts.site')
@section('title')
    {{__('site/site.about_us')}}
@endsection
@section('content')
    <section class="about">
        <div  class="container">


            <h1 class="heading-h1  heading-font h-m text-uppercase">{{__('site/site.about_us')}}</h1>
            <div class="container about-us">
                @isset($about_us)

                    <h1  class="brand-name mt-12  sub-heading-font ">{{$about_us->title}}</h1>
                    <div class="about-text">
                        <p class="lead fw-reg mt-50  fs-28">{!! $about_us->description !!}</p>

                    </div>

                @endisset



            </div>

            <div class="centrlize-itemcol-lg-10 ">
                <img class="img-responsive centrlize-item " src="{{asset('assets/front/images/about-us/fullLogo.png')}}" alt="">
            </div>



        </div>

    </section>

@endsection

@section('script')

@endsection
