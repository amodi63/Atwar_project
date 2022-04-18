@extends('layouts.site')
@section('title')
    {{__('site/site.orders')}}
@endsection
@section('content')

    <section class="user-order">
            <button   class="tablink tablink1 revers-float-r text-uppercase" onclick="openPage('orders', this, '#856fff')" id="defaultOpen">{{__('site/site.orders')}}</button>
            <button class="tablink tablink2 text-uppercase" onclick="openPage('adresses', this, '#856fff')" >{{__('site/site.addresses')}}</button>

        <div class="container-fluid add-lr-and-padding">

            <div id="orders" class="tabcontent">
                <h3 class="colored fw-bold fs-20 margin-bottom-18 margin-top-46">{{__('site/site.YOUR_ORDER_SUMMARY')}}</h3>
                <div class="table-responsive">
                    @isset($orders)
                        @foreach($orders as $order)
                            <table class="full-width orders-table  ">

                                    <thead>
                                    <tr>
                                        <th>{{__('site/site.item')}}</th>
                                        <th class="font-16 text-uppercase">{{__('site/site.quantity')}}</th>
                                        <th class="font-16 text-uppercase">{{__('site/site.unit_price')}}</th>
                                        <th class="text-uppercase">{{__('site/site.shipping')}}</th>
                                        <th class="border-top-none font-16 text-uppercase">{{__('site/site.tax')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><img class="img-responsive radius-10 centrlize-item " width="132" height="132"
                                                 src="{{$order->product->getPhoto($order->product->images[0]->photo)}}" alt=""></td>
                                        <td>{{$order->quantity}}</td>
                                        <td>${{$order->product->price}}</td>
                                        <td>$0</td>
                                        <td>${{(($tax->amount / 100) * ($order->product->price * $order->quantity))}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fs-18 fw-bold">{{$order->product->name}}</td>
                                        <td></td>
                                        <td></td>
                                        <td class="fs-15">{{__('site/site.total')}}</td>
                                        <td>${{(($tax->amount / 100) * ($order->product->price * $order->quantity)) + ($order->product->price * $order->quantity)}}</td>
                                    </tr>
                                    </tbody>


                        </table>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>

        <div id="adresses" class="tabcontent tabcontent2">
            <div class="container-flui add-lr-and-padding">

                <h3 class="colored fw-bold fs-20 margin-bottom-18 margin-top-80">{{__('site/site.REVIEW_SHIPPING_AND_BILLING_ADDRESS')}}</h3>
                <div class="container-fluid">
                    <div class="row address-info">

                        <div class="col-lg-6">
                            <h3 class="fs-17 fw-bold margin-bottom-18 padding-bottom-5">{{__('site/site.shipping_address')}}</h3>
                            <ul class="list-unstyled mt-13">
                                @isset($shipping)
                                    <li>{{$shipping->first_name}} {{$shipping->last_name }}</li>
                                    <li>{{$shipping->address}}</li>
                                    <li>{{$shipping->city}}</li>
                                    <li>{{$shipping->postal_code}}</li>
                                    <li>{{$shipping->phone}}</li>
                                    <li>{{$shipping->country}}</li>
                                @endisset

                            </ul>
                            <a style="position: absolute;bottom: 17px;" href="#">{{__('site/site.change_shipping_address')}}</a>
                        </div>
                        <div class="col-lg-6">
                            <h3 class="fs-17 fw-bold margin-bottom-18 padding-bottom-5"> {{__('site/site.billing_address')}}</h3>
                            <ul class="list-unstyled">
                                <li>{{__('site/site.same_as_shipping_address')}}</li>


                            </ul>
                            <a style="position: absolute;bottom: 17px;" href="#">{{__('site/site.edit_billing_address')}}</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>


    </section>



@endsection

@section('script')

@endsection
