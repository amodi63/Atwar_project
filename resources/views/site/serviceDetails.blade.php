@extends('layouts.site')
@section('title')
    {{__('site/site.our_service')}} {{$service->title}}
@endsection
@section('content')

    <section class="blog-page pb-35">
        <h1 class="brand-name add-thickness text-nowrap fs-31 pt-48 pb-18 colored margin-left-right">{{$service->title}}</h1>

        <div class="container img-padding">

                <div style="width: 100%; height: 398.03px">
                    <div class="img_details" style="background-image: url('{{$service->getPhoto($service->photo)}}')">

                    </div>

                </div>
{{--                                <img class="img-responsive" src="{{$service->getPhoto($service->photo)}}" alt="blog">--}}
            <div class="lead-padding">
                <p class="lead fw-reg mt-50  fs-28">{!! $service->description !!}</p>

            </div>





        </div>

    </section>

@endsection

@section('script')

@endsection
