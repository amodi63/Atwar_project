
<div class="modal fade" id="optionModal" tabindex="-1" role="dialog" aria-labelledby="optionModal">
    <div class="modal-dialog modal-lg modal-cust" role="document">
        <div class="modal-content modal-content-width">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                @isset($our_partner1)

                <h4 class="modal-title-register color-header mt-48" id="myModalLabel">{{__('site/site.our_partners')}} - {{$our_partner1->name}}</h4>
                    @endisset
            </div>
            <div class="modal-body cust">
                <div dir="ltr" id="my-slider" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol id="carousel-indicators-main" class="carousel-indicators">
                        @isset($content_partners)
                            @foreach($content_partners as $index => $content_partner)
                                <li data-target="#my-slider" data-slide-to="{{$index}}" class="active"></li>

                            @endforeach
                        @endisset

                    </ol>
                    <div class="carousel-inner carousel-inner-cust" role="listbox">
                        @isset($content_partners)
                            @foreach($content_partners as $index => $content_partner)
                                <div class="item @if($index == 0) active @endif">
                                    <div class="card" >
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <img class="card-img img-responsive shadow popup-img"   src="{{$content_partner->getPhoto($content_partner->photo)}}" alt="Card image"/>
                                            </div>
                                            <div class="col-lg-8 col-md-12 col-sm-12">
                                                <div class="card-body-right">
                                                    <p class="card-text card-text-heigh"> {{$content_partner->description}}</p>
                                                    <a href="{{$content_partner->link}}" target="_blank"   class="btn btn-default no-radius btn-lg defualt-btn mt-40 mc"> {{__('site/site.CHECK_SITE')}}
                                                        <img class="reverse-icon" src="{{asset('assets/front/images/home/white-arrow-right.png')}}" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset


                    </div>
                </div>
                <!-- Controls -->
                <a class="left carousel-control cust-car" href="#my-slider" role="button" data-slide="prev">
                    <div class="next-btn cust-bord">
                        <img class="icon-slider" src="{{asset('assets/front/images/home/arrow-left.png')}}" alt="">
                    </div>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control cust-car" href="#my-slider" role="button" data-slide="next">
                    <div class="prev-btn cust-bord">
                        <img class="icon-slider" src="{{asset('assets/front/images/home/arrow-right.png')}}" alt="">
                    </div>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="modal-footer">
        </div>
    </div>
</div>
