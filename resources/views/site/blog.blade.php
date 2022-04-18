@extends('layouts.site')
@section('title')
    {{__('site/site.blog')}}
@endsection
@section('content')



  <section class="our-service add-background">
    <div class="container-fluid pt-93">
      <span class="heading-h1 add-thickness head-service text-uppercase">{{__('site/site.blog')}}</span>
      <div class="container">

        <div class="row">
          <div class="col-lg-8 col-xs-12">
            <h1 class="brand-name text-theckness service-subtitle">
                {{__('site/site.check_out_the_latest_medical_topics')}}
            </h1>
          </div>

        </div>

          <div class="row text-center">
              @isset($blogs)
                  @foreach($blogs as $blog)
                      <div  class="col-md-3 ">
                          <div class="details-p " style="margin-top: 10%">
                              <img class="img-responsive img-rounded slider-round-img" style="height: 175px" src="{{$blog->getPhoto($blog->photo)}}" alt="photo">
                              <h4>{{$blog->title}}</h4>
                              <p>{!! \Illuminate\Support\Str::limit($blog->description, 100) !!}</p>
                              <a href="{{route('blog.details', $blog->id)}}" class="btn btn-default no-radius btn-lg defualt-btn rtl-dir" style="display: flex; justify-content: center">
                                  <span class="col-lg-push-7">{{__('site/site.read_more')}} </span>&nbsp;
                                  <span class="mt-5"  > <img class="reverse-icon" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt=""></span>
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
