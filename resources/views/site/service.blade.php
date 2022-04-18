@extends('layouts.site')
@section('title')
    {{__('site/site.our_service')}}
@endsection
@section('content')



  <section class="our-service add-background">
    <div class="container-fluid pt-93">
      <span class="heading-h1 add-thickness head-service text-uppercase"> {{__('site/site.our_service')}}</span>
      <div class="container">

        <div class="row">
          <div class="col-lg-8 col-xs-12">
            <h1 class="brand-name text-theckness service-subtitle">
                {{__('site/site.check_out_the_latest_medical_service')}}
            </h1>
          </div>
          <div class=" col-lg-4 col-xs-12">
            <img class="img-responsive visible-lg service-img" src="{{asset('assets/front/images/service/Doctor.png')}}" alt="">
          </div>
        </div>

        <div class="our-services">

            @isset($services)
                @foreach($services as $service)
                    <div class=" service ">
                        <div class="row">
                            <div class="nopadding  col-lg-4">
                                <img src="{{$service->getPhoto($service->photo)}}" class="img-service" alt="">
                            </div>
                            <div class="col-lg-8">
                                <h5>{{$service->title}}</h5>
                                @if(app()-> getLocale() == 'ar')
                                    <h4>{{\Illuminate\Support\Str::limit($service->short_description, 30)}}</h4>
                                    <p>{!! \Illuminate\Support\Str::words($service->description, 8) !!}</p>
                                @else
                                    <h4>{{\Illuminate\Support\Str::limit($service->short_description, 25)}}</h4>
                                    <p>{!! \Illuminate\Support\Str::words($service->description, 6) !!}</p>
                                @endif

                            </div>
                            <a type="button" href="{{route('service.details', $service->id)}}">
                                <div class="a-btn-full">
                                    <img class="icon-slider" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endisset


        </div>



      </div>
    </div>
    </div>
  </section>

@endsection

@section('script')

@endsection
