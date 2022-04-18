@extends('layouts.site')
@section('title')
     {{__('site/site.blog_details')}} {{$blog->title}}
@endsection
@section('content')

    <section class="blog-page pb-35" style="overflow: hidden">
        <h1 class="brand-name add-thickness text-nowrap fs-31 pt-48 pb-18 colored margin-left-right">{{$blog->title}}</h1>

        <div class="container img-padding">

            <div style="width: 100%; height: 398.03px">
                <div class="img_details" style="background-image: url('{{$blog->getPhoto($blog->photo)}}')">

                </div>
{{--                <img class="img-responsive" src="{{$blog->getPhoto($blog->photo)}}" alt="blog">--}}
            </div>
            <div class="lead-padding">
                <p class="lead fw-reg mt-50  fs-28">{!! $blog->description !!}</p>

            </div>





        </div>

    </section>

@endsection

@section('script')

@endsection
