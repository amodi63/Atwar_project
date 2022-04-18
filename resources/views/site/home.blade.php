@extends('layouts.site')
@section('title')
    {{__('site/site.title_home')}}
@endsection
@section('content')




  <div dir="ltr" id="my-slider22" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol id="carousel-indicators-main" class="carousel-indicators">
        @isset($sliders)
            @foreach($sliders as $index => $slider)
                <li data-target="#my-slider22" data-slide-to="{{$index}}" class="active"></li>

            @endforeach
        @endisset
    </ol>

    <div class="carousel-inner" role="listbox">
        @isset($sliders)
            @foreach($sliders as $index =>$slider)
                <div class="item @if($index == 0)active @endif">
                    <img class="img-responsive custom-image-slider-home-page" src="{{$slider->getPhoto($slider->photo)}}" alt="mainSlider">
                </div>
            @endforeach
        @endisset
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#my-slider22" role="button" data-slide="prev">
      <div class="next-btn">
        <img class="icon-slider" src="{{asset('assets/front/images/home/arrow-left.png')}}" alt="">
      </div>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#my-slider22" role="button" data-slide="next">
      <div class="prev-btn">
        <img class="icon-slider" src="{{asset('assets/front/images/home/arrow-right.png')}}" alt="">
      </div>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <div class="onoffswitch4">
    <span class="onoffswitch4-active">
      <marquee class="scroll-text" @if(app()-> getLocale() == 'ar') direction="right" @endif>
      @isset($news_taps)
          @foreach($news_taps as $news_tap)
                  {{$news_tap->description}}
              @if(!$loop ->last)
                  <img src="{{asset('assets/front/images/home/seperator.png')}}" class="quots-seperator" alt="">
                  @endif

              @endforeach

          @endisset
          <!-- <i class="fa fa-calculator quots-seperator"></i> -->

{{--           @isset($news_tap)--}}
{{--              {{$news_tap->description}}--}}
{{--          @endisset--}}

      </marquee>
    </span>


  </div>
  <section class="about">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-xs-12 col-md-8 ">
          <h1 class="heading-h1 add-thickness  margin-49 text-uppercase">{{__('site/site.about_us')}}</h1>
            @isset($about_us)
                <h1  class="sub-heading-font brand-name add-thickness mt-23  margin-76 text-uppercase">{{$about_us->title}}</h1>
                <div class=" margin-76">
                    <p  class="mt-25 lead-home">{!! \Illuminate\Support\Str::limit($about_us->description, 300) !!}
                        <a href="{{route('about_us')}}"   class=""> {{__('site/site.read_more')}}
                            <img class="reverse-icon" src="{{asset('assets/front/images/home/image1.jpeg')}}" alt="">
                        </a>
            @endisset

             </p>
          </div>
        </div>
      </div>
    </div>

  </section>


  <section class="shop-now d-flex">
    <div class="img-phar">
      <img src="{{asset('assets/front/images/home/pharmacy-ma.png')}}" alt="">
    </div>
    <div class="text-phar text-center">
      <h3 class="sub-heading-font">{{__('site/site.ONLINE_SHOP')}}</h3>
      <p class="add-thickness" style="font: 18px;">{{__('site/site.check_our_product_u_can_sale_it_from_site')}}</p>
    </div>
    <div class="button-phar">
      <a href="{{route('shop' , ['fromHeaderProduct' => false])}}"  class="btn btn-default no-radius btn-lg defualt-btn "> {{__('site/site.check_out')}}
        <img class="reverse-icon" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt="">
      </a>
    </div>
  </section>

  <section class="partner">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center">
          <div class="text-auto" style="height: 278px; text-align: center;">
            <h3 class="our-partner">{{__('site/site.our_partners')}}</h3>
            <h4 class="check-partner">{{__('site/site.check_our_partner')}} </h4>
          </div>
        </div>
          @isset($our_partners)
              @foreach($our_partners as $index =>$our_partner)
                  <div class="col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center p-3" data-id="{{$index+1}}">
                      <button class=" card bg-terq our_partner"  data-our_partner="{{$our_partner->id}}">
                          <img src="{{$our_partner->getPhoto($our_partner->photo)}}" style="margin: 0 auto;" alt="">
                      </button>
                  </div>
                  @endforeach
              @endisset

{{--        <div class="col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center p-3">--}}
{{--          <button class=" card bg-terq" data-toggle="modal" data-target="#optionModal2">--}}
{{--            <img src="{{asset('assets/front/images/home/hearingcarestages.png')}}" style="margin: 0 auto;" alt="">--}}
{{--            <div class="text-center" style="margin: 0 auto;">--}}
{{--              <h4 class="hearning">اطوار للعناية بالسمع</h4>--}}
{{--              <p class="health-care">ATWAR FOR HEARING CARE</p>--}}
{{--            </div>--}}
{{--          </button>--}}
{{--        </div>--}}
      </div>
    </div>
  </section>

  <section class="@if($main_partners -> count() > 0) main-partners @endif text-center">
    <h4 class="our-partner">{{__('site/site.MAIN_PARTNERS')}}</h4>
    <div class="container">
      <div class="row d-flex">

                  <div class="col-lg-12 wrapper" >

                      <div class="carousel2 owl-carousel">
                          @isset($main_partners)
                              @foreach($main_partners as $main_partner)
                                  <div class="card">
                                      <a href="{{$main_partner->link}}" target="_blank">
                                          <img src="{{$main_partner->getPhoto($main_partner->photo)}}" class="" alt="">
                                      </a>
                                  </div>
                              @endforeach
                          @endisset

                      </div>


                  </div>




{{--        <div class="col-lg-2 col-md-4 col-sm-6">--}}
{{--          <img src="{{asset('assets/front/images/home/3dslider2.png')}}" class="w-100" alt="">--}}
{{--        </div>--}}
{{--        <div class="col-lg-2 col-md-4 col-sm-6">--}}
{{--          <img src="{{asset('assets/front/images/home/3dslider3.png')}}" class="w-100" alt="">--}}
{{--        </div>--}}
{{--        <div class="col-lg-2 col-md-4 col-sm-6">--}}
{{--          <img src="{{asset('assets/front/images/home/3dslider1.png')}}" class="img_semins w-100" alt="">--}}
{{--        </div>--}}
{{--        <div class="col-lg-2 col-md-4 col-sm-6">--}}
{{--          <img src="{{asset('assets/front/images/home/3dslider2.png')}}" class="w-100" alt="">--}}
{{--        </div>--}}
{{--        <div class="col-lg-2 col-md-4 col-sm-6">--}}
{{--          <img src="{{asset('assets/front/images/home/3dslider3.png')}}" class="w-100" alt="">--}}
{{--        </div>--}}
      </div>
    </div>
  </section>


  <div class="main_partner">
      @include('site._partnerModal')
  </div>
@endsection

@section('script')

    <script>

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".carousel2").owlCarousel({
                margin: 20,
                loop: true,
                autoplay: true,
                nav:true,
                rtl:true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                responsive: {
                    0:{
                        items:1,
                        nav:false
                    },
                    600:{
                        items:3,
                        nav:false
                    },
                    1000:{
                        items:5,
                        nav:true
                    }
                }
            });


            $('.our_partner').click(function () {
                var our_partner = $(this).data('our_partner');
                console.log(our_partner)

                $.ajax({
                    type: 'get',
                    url: "{{ route('openModal') }}",
                    data: {'our_partner': our_partner},

                    success: function (data) {

                            $('.main_partner').html('');
                            $('.main_partner').append(data);
                            $('#optionModal').modal('show');


                    },



                });


            });



        });

    </script>


@endsection
