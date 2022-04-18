
@isset($products)
    @foreach($products as $product)
        <div class="text-center "><a href="{{route('product_details', $product)}}"> <img
                    class=" img-responsive radius-10" width="229px" height="229px"
                    src="{{$product->getPhoto($product->images[0]->photo)}}" alt="product"></a><span class="fs-13 thick">
                                    {{$product->name}}</span>
            <br><span class="badge price-baner"> {{$product->price}}$</span>
        </div>
    @endforeach
@endisset

{{--<div class="row pt-30 pb-40 " id="ppp">--}}
{{--    <div class="col-lg-offset-4">--}}
{{--        <div class="pagination pa">--}}
{{--            <span style="margin-top: 4%">{{__('site/site.page')}}</span> {!! $products->links() !!}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
