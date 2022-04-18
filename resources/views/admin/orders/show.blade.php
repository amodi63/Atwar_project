@extends('layouts.admin')
@section('title')
    {{__('admin/dashboard.orders_details')}}
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin/sidebar.orders')}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/sidebar.main')}} </a></li>
                                <li class="breadcrumb-item active"><a href="{{route('orders')}}">{{__('admin/sidebar.orders')}} </a> </li>
                                <li class="breadcrumb-item active"> {{__('admin/dashboard.orders_details')}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-content collapse show" id="viewAboutUs">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table table-bordered  orders-table">
                                            <thead>
                                            <tr>
                                                <th width="30%" scope="col">#</th>
                                                <td scope="row" id="id">{{$order->id}}</td>
                                            </tr>
                                            <tr>
                                                <th width="30%" scope="col">{{__('admin/dashboard.status')}}</th>
                                                <td scope="row" id="id">
                                                    @if($order->order->status == 0)
                                                        <span class="text-danger">{{__('admin/dashboard.pending')}}</span>
                                                    @else
                                                        <span class="text-success">{{__('admin/dashboard.completed')}}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%" scope="col">{{__('admin/dashboard.customer')}}</th>
                                                <td scope="row" id="first_name">{{$order->shipping->first_name}} {{$order->shipping->last_name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">{{__('admin/dashboard.address')}}</th>
                                                <th scope="row" id="address">{{$order->shipping->address}}</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">{{__('admin/dashboard.phone')}}</th>
                                                <th scope="row" id="identification_number">{{$order->shipping->phone}}</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">{{__('admin/dashboard.email')}}</th>
                                                <th scope="row" id="identification_number">{{$order->shipping->email}}</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">{{__('admin/dashboard.product')}}</th>
                                                <th scope="row" id="last_name">{{$order->product->name}}</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">{{__('admin/dashboard.unit_price')}}</th>
                                                <th scope="row" id="email">{{$order->product->price}}</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">{{__('admin/dashboard.quantity')}}</th>
                                                <th scope="row" id="country">{{$order->quantity}}</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">{{__('admin/dashboard.price')}}</th>
                                                <th scope="row" id="city">{{$order->product->price * $order->quantity}}</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">{{__('admin/dashboard.date_of_sale')}}</th>
                                                <th scope="row" id="phone">{{date('d-m-Y', strtotime($order->created_at))}}</th>
                                            </tr>


                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <div class="justify-content-center d-flex"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>




@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
    </script>
@endsection
