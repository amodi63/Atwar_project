@extends('layouts.admin')
@section('title')
    {{__('admin/sidebar.main')}}
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div id="crypto-stats-3" class="row">
                    <div class="col-xl-3 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-2">
                                            <h1><i class="cc BTC warning font-large-2" title="BTC"></i></h1>
                                        </div>
                                        <div class="col-5 pl-2">
                                            <h5 class="text-muted">{{__('admin/dashboard.total_sale')}}</h5>
                                        </div>
                                        <div class="col-5 text-right">
                                            <h4>{{$total}}$</h4>
                                            <h6 class="success darken-4"></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="btc-chartjs" class="height-75"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-2">
                                            <h1><i class="cc ETH blue-grey lighten-1 font-large-2" title="ETH"></i></h1>
                                        </div>
                                        <div class="col-5 pl-2">
                                            <h5 class="text-muted">{{__('admin/dashboard.order_no')}}</h5>
                                        </div>
                                        <div class="col-5 text-right">
                                            <h4>{{\App\Models\Order::count()}}</h4>
                                            <h6 class="success darken-4"></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="eth-chartjs" class="height-75"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-2">
                                            <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>
                                        </div>
                                        <div class="col-6 pl-2">
                                            <h4></h4>
                                            <h5 class="text-muted">{{__('admin/dashboard.product_no')}}</h5>
                                        </div>
                                        <div class="col-4 text-right">
                                            <h4>{{\App\Models\Product::count()}}</h4>
                                            <h6 class="danger"></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="xrp-chartjs" class="height-75"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Candlestick Multi Level Control Chart -->

                <!-- Sell Orders & Buy Order -->
                <div class="row match-height">
                    <div class="col-12 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{__('admin/dashboard.latest_orders')}}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <p class="text-muted"></p>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-de mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('admin/dashboard.customer')}}</th>
                                            <th>{{__('admin/dashboard.total')}}</th>
                                            <th>{{__('admin/dashboard.status_order')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @isset($orders)
                                            @foreach($orders as $order)
                                                <tr class="bg-success bg-lighten-5">
                                                    <td>{{$order->id}}</td>
                                                    <td>{{$order->customer->first_name}} {{$order->customer->last_name}}</td>
                                                    <td>{{$order->total_price}}$</td>
                                                    <td> @if($order->status == 0) <span class="text-danger">{{__('admin/dashboard.pending')}}</span> @else <span class="text-success">{{__('admin/dashboard.completed')}}</span> @endif</td>
                                                </tr>
                                            @endforeach
                                        @endisset

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Sell Orders & Buy Order -->
                <!-- Active Orders -->

                <!-- Active Orders -->
            </div>
        </div>
    </div>
@endsection
