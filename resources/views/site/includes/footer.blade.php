<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 p-20">
                <img width="255" height="79" class="img-responsive " src="{{asset('assets/front/images/home/logoPlus.png')}}" alt="">
                <h2 class="big-heading add-thickness nmt-50 mt-0">
                    {{__('site/site.atwar_medical_care')}}
                </h2>
                @isset($contact_information)
                    <p>{{$contact_information->description}}</p>
                    @endisset

                <ul class="list-unstyled social-list">
                    @isset($social_links)
                        @foreach($social_links as $social_link)
                            <li> <a href="{{$social_link->link}}"> <img src="{{$social_link->getPhoto($social_link->photo)}}" width="35px" height="35px" alt="{{$social_link->name}}"> </a> </li>
                        @endforeach
                    @endisset

                </ul>
            </div>
            <div class="col-lg-4 p-50">
                <h3 class="footer-headrs">{{__('site/site.useful_links')}}</h3>
                <ul class="list-unstyled two-col">
                    @isset($useful_links)
                        @foreach($useful_links as $link)
                            <li class="footer-useful-links text-uppercase"> <a href="{{$link->link}}"> {{$link->name}} </a></li>
                        @endforeach
                    @endisset
                    
                </ul>
            </div>
            <div class="col-lg-4 p-50">
                <h3 class="footer-headrs">{{__('site/site.contact_Info')}}</h3>
                @isset($contact_information)
                    <ul class="list-unstyled ">
                        <li class="contact-info"> <img src="{{asset('assets/front/images/social/mail.png')}}" alt="">&nbsp; {{$contact_information->email}}
                        </li><br>
                        <li class="contact-info"> <img src="{{asset('assets/front/images/social/phone.png')}}" alt=""> {{$contact_information->phone}}</li>
                        <br>
                        <li class="contact-info"> <img src="{{asset('assets/front/images/social/map.png')}}" alt=""> {{$contact_information->address}}&nbsp;
                            </li>
                    </ul>
                @endisset

            </div>
            <div class="container">

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-7 col-sm-12">
                            <p>{{__('site/site.copy_right')}} <a href="#" class="colored">
                                    {{__('site/site.alawael_alwatania')}} </a></p>

                        </div>
                        <div class="col-lg-4 col-sm-12">
                        <a class=" float-r colored" href="{{route('home')}}">www.ATWARMWDICAL.com</a>
                    </div>


                </div>
            </div>
        </div>
    </div>



    </div>

</section>




