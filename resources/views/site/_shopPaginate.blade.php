<div class="products-section viewProduct">
    @isset($products)
        @foreach($products as $product)

            <div class="text-center "><a href="{{route('product_details',$product->id)}}">
{{--                    <div style="width: 229px; height: 229px">--}}
{{--                        <div class="img_details" style="background-image: url('{{$product->getPhoto($product->images[0]->photo)}}')">--}}

{{--                        </div>--}}
{{--                    </div>--}}
                    <img
                        class=" img-responsive radius-10" width="229px" height="229px"
                        src="{{$product->getPhoto($product->images[0]->photo)}}" alt="product">
                </a><span class="fs-13 thick">
                                    {{$product->name}}</span>
                <br><span class="badge price-baner"> {{$product->price}}$</span>
            </div>
        @endforeach
    @endisset

</div>
<div class="row pt-30 pb-40 " >
    <div class="col-lg-offset-4">
        <div class="pagination pa">
            <span style="margin-top: 4%">{{__('site/site.page')}}</span> {!! $products->links() !!}
        </div>
    </div>
</div>
