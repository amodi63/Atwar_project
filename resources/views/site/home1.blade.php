@extends('layouts.site')
@section('title')
    {{__('site/site.home')}}
@endsection
@section('content')



  <div dir="ltr" id="my-slider" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol id="carousel-indicators-main" class="carousel-indicators">
        @isset($sliders)
            @foreach($sliders as $index => $slider)
                <li data-target="#my-slider{{$index}}" data-slide-to="{{$index}}" class="active"></li>

            @endforeach
        @endisset

    </ol>

    <div class="carousel-inner" role="listbox">
        @isset($sliders)
            @foreach($sliders as $index =>$slider)
                <div class="item @if($index == 0)active @endif">
                    <img class="img-responsive" src="{{$slider->getPhoto($slider->photo)}}" alt="mainSlider">
                </div>
            @endforeach
        @endisset

    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#my-slider" role="button" data-slide="prev">
      <!-- <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> -->
      <!-- <i  class="fa fa-home"></i> -->
      <div class="next-btn">
        <img class="icon-slider" src="{{asset('assets/front/images/home/arrow-left.png')}}" alt="">
      </div>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#my-slider" role="button" data-slide="next">
      <!-- <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> -->
      <div class="prev-btn">
        <img class="icon-slider" src="{{asset('assets/front/images/home/arrow-right.png')}}" alt="">
      </div>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <div class="onoffswitch4">
    <span class="onoffswitch4-active">
      <marquee class="scroll-text">
        @isset($news_tap)
              {{$news_tap->description}}
          @endisset
        <img src="{{asset('assets/front/images/home/seperator.png')}}" class="quots-seperator" alt="">
        <!-- <i class="fa fa-calculator quots-seperator"></i> -->

           @isset($news_tap)
                {{$news_tap->description}}
            @endisset

      </marquee>
    </span>


  </div>
  <section class="about">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8 col-xs-12 col-md-8 ">
          <h1 class="heading-h1 add-thickness  margin-49">ABOUT US</h1>
            @isset($about_us)
                <h1  class="sub-heading-font brand-name add-thickness mt-23  margin-76">{{$about_us->title}}</h1>
                <div class=" margin-76">
                    <p  class="mt-25 lead-home">{!! $about_us->description !!}
                    </p>
                </div>
            @endisset

          <a href="{{route('about_us')}}"   class="btn btn-default no-radius btn-lg defualt-btn mt-40  margin-76"> read
            more

            <img class="reverse-icon" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt="">
          </a>
        </div>

        <div class="col-lg-4 col-xs-12 col-md-4 left-border about-col2 ">
          <div class="text-center nmt-40" >

            <img centrlize-item="centrlize-item" width="325px" height="240px"
            style="margin-top: 20px;" src="{{asset('assets/front/images/home/homeAbout.png')}}" alt="">
            <a href="{{route('shop')}}"  class="btn btn-default no-radius btn-lg defualt-btn mt-35"> CHECK
              OUT
              <img class="reverse-icon" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt="">
            </a>
          </div>
        </div>
      </div>
    </div>

  </section>


  <section class="our-partners-grey">
    <div class="container-fluid">
      <h1 class="heading-h1 add-thickness  margin-49">OUR PARTNERS</h1>
      <div  dir="ltr" class="row big-slider">

        <div class="col-sm-12">
          <div class="row">
            <div class="col-lg-7 col-sm-12 ">
              <div class="banner">
                <section id="dg-container" class="dg-container">
                    <div class="dg-wrapper">
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider1.png')}}">
                        </a>
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider2.png')}}">
                        </a>
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider3.png')}}">
                        </a>
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider1.png')}}">
                        </a>
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider2.png')}}">
                        </a>
                    </div>
                  <ol class="button" id="lightButton">
                    <li index="0">
                    <li index="1">
                    <li index="2">
                    <li index="3">
                    <li index="4">
                  </ol>
                  <nav>
                    <span class="dg-prev"></span>
                    <span class="dg-next"></span>
                  </nav>
                </section>
              </div>
            </div>
            <div class="col-lg-5 col-sm-12 ">
              <img class=" img-responsive img-slider-partnars" src="{{asset('assets/front/images/home/logo.png')}}" alt="logo">
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-7 col-sm-12 ">
              <div class="banner">
                <section id="dg-container2" class="dg-container">
                    <div class="dg-wrapper">
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider1.png')}}">
                        </a>
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider2.png')}}">
                        </a>
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider3.png')}}">
                        </a>
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider1.png')}}">
                        </a>
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider2.png')}}">
                        </a>
                    </div>
                  <ol class="button" id="lightButton">
                    <li index="0">
                    <li index="1">
                    <li index="2">
                    <li index="3">
                    <li index="4">
                  </ol>
                  <nav>
                    <span class="dg-prev"></span>
                    <span class="dg-next"></span>
                  </nav>
                </section>
              </div>
            </div>

              <div class="col-lg-5 col-sm-12 ">
              <img class=" img-responsive img-slider-partnars" src="{{asset('assets/front/images/home/logo.png')}}" alt="logo">
            </div>

            <!-- images/home/logo.png -->


          </div>
        </div>

        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-7 col-sm-12 ">
              <div class="banner">
                <section id="dg-container3" class="dg-container">
                    <div class="dg-wrapper">
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider1.png')}}">
                        </a>
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider2.png')}}">
                        </a>
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider3.png')}}">
                        </a>
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider1.png')}}">
                        </a>
                        <a href="#">
                            <img src="{{asset('assets/front/images/home/3dslider2.png')}}">
                        </a>
                    </div>
                  <ol class="button" id="lightButton">
                    <li index="0">
                    <li index="1">
                    <li index="2">
                    <li index="3">
                    <li index="4">
                  </ol>
                  <nav>
                    <span class="dg-prev"></span>
                    <span class="dg-next"></span>
                  </nav>
                </section>
              </div>
            </div>

            <div class="col-lg-5 col-sm-12 ">
              <img class=" img-responsive img-slider-partnars" src="{{asset('assets/front/images/home/logo.png')}}" alt="logo">
            </div>

            <!-- images/home/logo.png -->


          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="our-service">
    <div class="container-fluid">
      <span class="heading-h1 add-thickness margin-49"> OUR SERVICE</span>
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <h1 class="brand-name   brand-margin text-theckness">
              Check out our latest
              medical service
            </h1>
          </div>
        </div>
        <div class="our-services-home">
          <div class=" service ">
            <div class="row service1">
              <div class="nopadding  col-lg-4">
                <img src="{{asset('assets/front/images/home/services.png')}}" alt="">
              </div>
              <div class="col-lg-8">
                <h5>HEARING CLEAN</h5>
                <h4>Fresh fish and onions</h4>
                <p>Fresh food directly from our restaurant ready coocked for you and you familly</p>
              </div>
              <a type="button" href="#">
                <div class="a-btn">
                  <img class="icon-slider" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt="">
                </div>
              </a>
            </div>
          </div>

            <div class=" service ">
                <div class="row service1">
                    <div class="nopadding  col-lg-4">
                        <img src="{{asset('assets/front/images/home/services.png')}}" alt="">
                    </div>
                    <div class="col-lg-8">
                        <h5>HEARING CLEAN</h5>
                        <h4>Fresh fish and onions</h4>
                        <p>Fresh food directly from our restaurant ready coocked for you and you familly</p>
                    </div>
                    <a type="button" href="#">
                        <div class="a-btn">
                            <img class="icon-slider" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt="">
                        </div>
                    </a>
                </div>
            </div>

            <div class=" service ">
                <div class="row service1">
                    <div class="nopadding  col-lg-4">
                        <img src="{{asset('assets/front/images/home/services.png')}}" alt="">
                    </div>
                    <div class="col-lg-8">
                        <h5>HEARING CLEAN</h5>
                        <h4>Fresh fish and onions</h4>
                        <p>Fresh food directly from our restaurant ready coocked for you and you familly</p>
                    </div>
                    <a type="button" href="#">
                        <div class="a-btn">
                            <img class="icon-slider" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt="">
                        </div>
                    </a>
                </div>
            </div>

            <div class=" service ">
                <div class="row service1">
                    <div class="nopadding  col-lg-4">
                        <img src="{{asset('assets/front/images/home/services.png')}}" alt="">
                    </div>
                    <div class="col-lg-8">
                        <h5>HEARING CLEAN</h5>
                        <h4>Fresh fish and onions</h4>
                        <p>Fresh food directly from our restaurant ready coocked for you and you familly</p>
                    </div>
                    <a type="button" href="#">
                        <div class="a-btn">
                            <img class="icon-slider" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt="">
                        </div>
                    </a>
                </div>
            </div>

        </div>
      </div>
    </div>
  </section>

  <section dir="ltr" class="blog ">
    <div class="fill">
      <div   class="container-fluid blog-contant p-60-0">
        <div  class="rtl-dir">

          <h1 class="big-heading add-thickness margin-49 block-header-color">
            BLOG
          </h1>
        </div>
        <div class="container">
          <div class="rtl-dir">

            <h1 class="brand-name text-theckness  pb-29 white-color m-">
              Check out our latest
              medical service
            </h1>
          </div>
          <div class="row blog-slider text-center">
            <div  class="col-md-3 ">
              <div class="details-p ">
                <img class="img-responsive img-rounded slider-round-img" src="{{asset('assets/front/images/home/blogSlider.png')}}" alt="photo">
                <h4>Free Wifi
                  to stay connected</h4>
                <p>
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                  ad!\</p>
                <a  class="btn btn-default no-radius btn-lg defualt-btn rtl-dir">
                  <span class="col-lg-push-7">read more </span>&nbsp;
                  <span class="mt-5"  > <img class="reverse-icon" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt=""></span>
                </a>
              </div>
            </div>
              <div  class="col-md-3 ">
                  <div class="details-p ">
                      <img class="img-responsive img-rounded slider-round-img" src="{{asset('assets/front/images/home/blogSlider.png')}}" alt="photo">
                      <h4>Free Wifi
                          to stay connected</h4>
                      <p>
                          Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                          ad!\</p>
                      <a  class="btn btn-default no-radius btn-lg defualt-btn rtl-dir">
                          <span class="col-lg-push-7">read more </span>&nbsp;
                          <span class="mt-5"  > <img class="reverse-icon" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt=""></span>
                      </a>
                  </div>
              </div>
              <div  class="col-md-3 ">
                  <div class="details-p ">
                      <img class="img-responsive img-rounded slider-round-img" src="{{asset('assets/front/images/home/blogSlider.png')}}" alt="photo">
                      <h4>Free Wifi
                          to stay connected</h4>
                      <p>
                          Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                          ad!\</p>
                      <a  class="btn btn-default no-radius btn-lg defualt-btn rtl-dir">
                          <span class="col-lg-push-7">read more </span>&nbsp;
                          <span class="mt-5"  > <img class="reverse-icon" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt=""></span>
                      </a>
                  </div>
              </div>
              <div  class="col-md-3 ">
                  <div class="details-p ">
                      <img class="img-responsive img-rounded slider-round-img" src="{{asset('assets/front/images/home/blogSlider.png')}}" alt="photo">
                      <h4>Free Wifi
                          to stay connected</h4>
                      <p>
                          Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                          ad!\</p>
                      <a  class="btn btn-default no-radius btn-lg defualt-btn rtl-dir">
                          <span class="col-lg-push-7">read more </span>&nbsp;
                          <span class="mt-5"  > <img class="reverse-icon" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt=""></span>
                      </a>
                  </div>
              </div>
              <div  class="col-md-3 ">
                  <div class="details-p ">
                      <img class="img-responsive img-rounded slider-round-img" src="{{asset('assets/front/images/home/blogSlider.png')}}" alt="photo">
                      <h4>Free Wifi
                          to stay connected</h4>
                      <p>
                          Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                          ad!\</p>
                      <a  class="btn btn-default no-radius btn-lg defualt-btn rtl-dir">
                          <span class="col-lg-push-7">read more </span>&nbsp;
                          <span class="mt-5"  > <img class="reverse-icon" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt=""></span>
                      </a>
                  </div>
              </div>

          </div>
        </div>
      </div>
    </div>

    </div>

  </section>
  @endsection

  @section('script')



@endsection
