@extends('layouts.site')
@section('title')
    {{__('site/site.bill_bending')}}
@endsection
@section('content')
    <section class="bill-pending">
        <div class="container table-responsive table-warper table-mobile-padding">
            <table class="table-responsive bill-table">
                @isset($orders_binding)
                    @foreach($orders_binding as $order_binding)

                <thead>
                    <tr>
                        <th class="colored-table-head fs-31  th-font-proxima table-first-col ">
                            <span class="revers-float-r text-uppercase"> {{__('site/site.order_no')}} # {{$order_binding->id}} </span>
                        </th>
                        <th class="th-font-proxima">
                            {{__('site/site.price')}}
                        </th>
                        <th class="text-center text-nowrap th-font-proxima">
                            &nbsp; &nbsp; {{__('site/site.qty')}} &nbsp; &nbsp;
                        </th>
                        <th class="text-right text-nowrap th-font-proxima">
                            {{__('site/site.unit_price')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($order_binding->purchase as $purchase_product)

                        <tr>
                            <td>
                                <div>
                                    <div class="container-fluid">
                                        <div class="d-flex">
                                            <img height="130px" width="130px" src="{{$purchase_product->product->getPhoto($purchase_product->product->images[0]->photo)}}" alt="">
                                            <p class="pt-15pt fw-bold">
                                                {{$purchase_product->product->name}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{$purchase_product->product->price * $purchase_product->quantity}}$
                            </td>
                            <td class="text-center">
                                {{$purchase_product->quantity}}
                            </td>
                            <td class="text-right">
                                {{$purchase_product->product->price}}$
                            </td>
                        </tr>

                 @endforeach
                </tbody>

                @endforeach
                @endisset
            </table>
        </div>
    </section>
    <section class="bill-totals">
        <div class="container">
            <div class="row columns-reverse">
                <div class="col-lg-7">
                    <img class="img-responsive centrlize-item" src="{{asset('assets/front/images/home/logoPlus.png')}}" alt="">
                </div>
                <div class=" col-lg-3 col-sm-12 col-lg-offset-2 table-responsive">
                    <table class="full-width totals-table table-mobile-center">
                        <tr>
                            <td class="fs-16">{{__('site/site.subtotal')}}</td>
                            <td class="fs-16">{{$subtotal}}$</td>
                        </tr>
                        <tr>
                            <td class="fs-16">{{__('site/site.shipping_fee')}}</td>
                            <td class="fs-16">0$</td>
                        </tr>
                        <tr>
                            <td class="fs-16">{{__('site/site.coupon')}}</td>
                            <td class="fs-16"> {{__('site/site.no')}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold fs-31"> {{__('site/site.total')}}</td>
                            <td class="fw-bold fs-31">{{$subtotal}}$</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection
