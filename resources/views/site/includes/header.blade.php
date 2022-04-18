<nav class="navbar mt-13 mb-6 ">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar label-primary"></span>
                <span class="icon-bar label-primary"></span>
                <span class="icon-bar label-primary"></span>
            </button>
            <a class="navbar-brand text-nowrap" href="{{route('home')}}">{{__('site/site.atwar_medical_care')}}</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="active text-uppercase"><a href="{{route('home')}}"><strong>{{__('site/site.home')}} </strong> </a> </li>
                <li class="text-uppercase"><a href="{{route('about_us')}}"><strong> {{__('site/site.about_us')}} </strong></a></li>
                <li class="text-uppercase"><a href="{{route('shop', ['fromHeaderProduct' => true])}}"> <strong>{{__('site/site.products')}}</strong></a></li>
                <li class="text-uppercase"><a href="{{route('service')}}"> <strong>{{__('site/site.our_service')}}</strong></a></li>
                <li class="text-uppercase"><a href="{{route('blog')}}"> <strong>{{__('site/site.blog')}}</strong></a></li>
                <li class="text-uppercase"><a href="{{route('contact_us')}}"> <strong>{{__('site/site.contact')}}</strong></a></li>
                <li class="dropdown i-pad">
                    <!-- <span class="caret"></span> -->
                    <a href="#" class="dropdown-toggle choose-lang size_font_language" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        @if(app() -> getLocale()  == 'en')
                            English
                        @elseif(app() -> getLocale() == 'ar')
                            العربية
                        @endif
                    </a>

                    <ul class="dropdown-menu">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li><a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    @if($localeCode == 'en')
                                        English
                                    @elseif($localeCode == 'ar')
                                        العربية
                                    @endif
                                </a></li>

                        @endforeach

                    </ul>
                </li>
                <li>
                    <a class="bootstrap-off cart size_font_cart" href="{{route('cart')}}">{{__('site/site.cart')}} &nbsp;
                        <img src="{{asset('assets/front/images/home/shop.png')}}" alt=""></a>
                </li>
                @auth('customer')
                <li class="dropdown login_dropdown">


                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-right: 0; padding-left: 0">
                            <img class="img-responsive admin-img 0.5x" src="{{asset('assets/front/images/home/adminIcon.png')}}" alt="">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-custom ">
                            <li><a class="dropdown-item text-uppercase" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('site/site.logout')}}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </a></li>
                            <li><a class="dropdown-item" href="{{route('user_order')}}">{{__('site/site.orders')}}</a></li>
                            <li class="dropdown-item"><a class="dropdown-item text-uppercase" href="{{route('bill_pending')}}">{{__('site/site.bill_bending')}}</a></li>


                        </ul>
                </li>
                    @endauth

                        @guest('customer')
                    <li class="">
                            <a href=""  type="button" class="a_hover modal-btn" data-toggle="modal" data-target="#loginModal"><img class="img-responsive admin-img 0.5x" src="{{asset('assets/front/images/home/adminIcon.png')}}" alt=""></a>
                    </li>
                        @endguest

            </ul>
        </div>
    </div>
</nav>




