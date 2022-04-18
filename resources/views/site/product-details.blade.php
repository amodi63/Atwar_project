@extends('layouts.site')
@section('title')
    {{__('site/site.product_details')}} {{$product->name}}
@endsection
@section('content')




    <section class="product-details">
        <div class="container-fluid pl-15 pr-37">
            <div class="fs-36 colored add-thickness">{{__('site/site.product_details')}}</div>
            <div class="row mt-33 mb-50">
                <div class="col-lg-6 col-sm-12">

                    <img id="set-new-img" width="565px" height="488px" class="img-responsive radius-10 "
                        src="{{$product->getPhoto($product->images[0]->photo)}}" alt="">

                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="row">

                        <div class="col-lg-6 fw-bold fs-35">
                            <div dir="ltr" class="product-name">

                                <span class="thick1"> {{$product->name}} </span> &nbsp;&nbsp;
{{--                                <span class="fs-20 roboto gray-color butm-line">Hone fur co </span>--}}
                            </div>
                            <span class="Description">
                                {{__('site/site.description')}}
                            </span>
                        </div>
                        <div>
                            <div class="product-price col-lg-6  "> ${{$product->price}} </div>
                        </div>
                    </div>
                    <p class="lead">
                        {!! $product->description !!}
                    </p>

                    @isset($product)

                    <div class="product-imgs">
                        @foreach($product->images as $product_images)
                            <a class="button-show" type="button"> <img class="img-responsive" width="148px" height="128px"
                                    src="{{$product_images->getPhotoProduct($product_images->photo)}}" alt="product">
                            </a>
                        @endforeach

                    </div>

                    @endisset
                    <div>
                        @if( session('fromHeaderProduct') == true)

                            @else
                            <button class="centrlize-item add-tocart mt-17 addProductToCart"  data-product-id="{{$product->id}}" type="button">
                                <span class="fs-34 "> {{__('site/site.add_to_cart')}} +</span>
                            </button>
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="most-product">
        <div class="container">

            <span class="colored fs-26 meduim-roboto">{{__('site/site.must_product_sale')}} </span>
            <div class="most-product-imgs">
                @isset($products_related)
                    @foreach($products_related as $product)
                        <div class="text-center">
                            <img class="rounded " width="270px" height="270px" src="{{$product->getPhoto($product->images[0]->photo)}}" alt="product">
                            <br><span class="fs-16 thick pro-t"> {{$product->name}} </span> </span><br> <span class="badge price-baner">
                        ${{$product->price}}</span>
                        </div>
                        @endforeach
                    @endisset


            </div>
        </div>

    </section>




@endsection

@section('script')
    <script>

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.addProductToCart', function (e) {
                e.preventDefault();
                @guest('customer')
                toastr.warning('{{__('site/site.you_are_not_logged_into_the_system')}}')
                @endguest

                $.ajax({
                    type: 'post',
                    url: "{{ route('addProductToCart') }}",
                    enctype: 'multipart/form-data',
                    data: {'product_id' : $(this).attr('data-product-id'),

                    },
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                        } else {
                            toastr.info(data.msg);
                        }
                    },
                });
            });



        });

    </script>
@endsection
