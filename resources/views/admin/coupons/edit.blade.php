@extends('layouts.admin')
@section('title')
    {{__('admin/dashboard.edit_coupon')}} -{{$coupon->code}}
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"></h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.dashboard')}}">{{__('admin/sidebar.main')}}  </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('index.coupon')}}">{{__('admin/sidebar.coupon')}}</a>

                                </li>
                                <li class="breadcrumb-item active"> {{__('admin/dashboard.edit_product')}} -
                                    {{$coupon->code}}</li>
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


                                <!--  Begin Form Edit -->

                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" method="post"
                                              action="{{route('update.coupon',$coupon->id)}}"
                                              id="offerForm" enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i> {{__('admin/dashboard.edit_product')}} - {{$coupon->code}}
                                            </h4>
                                            <input type="hidden" name="id" value="{{$coupon->id}}">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> {{__('admin/dashboard.products')}}</label>
                                                            <select name="products[]" id="products" class="select2 form-control " multiple>
                                                                <optgroup label="{{__('admin/dashboard.please_select_the_product')}}">
                                                                    @isset($products)
                                                                        @foreach($products as $product)
                                                                            <option value="{{$product->id}}" @if($coupon_products->contains('id', $product->id) ==   $product->id) selected @endif>{{$product->name}}</option>
                                                                        @endforeach
                                                                    @endisset
                                                                </optgroup>
                                                            </select>
                                                            @error('products')
                                                            <span id="products_error" class="text-danger">{{$message}}</span>
                                                            @enderror

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> {{__('admin/dashboard.code')}} </label>
                                                            <input type="text" id="code" class="form-control"
                                                                   placeholder="a@#$12c"
                                                                   name="code" value="{{$coupon->code}}">

                                                            @error('code')
                                                            <span id="code" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{__('admin/dashboard.type')}}</label>
                                                            <select name="type" id="type" class="select2 form-control">
                                                                <optgroup label="{{__('admin/dashboard.please_select_a_coupon_type')}}">
                                                                    <option value="1" @if($coupon->type == 1) selected @endif>{{__('admin/dashboard.percentage')}}</option>
                                                                    <option value="2" @if($coupon->type  == 2) selected @endif>{{__('admin/dashboard.fixed_value')}}</option>
                                                                </optgroup>
                                                            </select>
                                                            <span id="type_error" class="text-danger"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.discount_percentage')}}</label>
                                                            <input type="text" id="percent_discount" class="form-control"
                                                                   name="percent_discount" value="{{$coupon->percent_discount}}">

                                                            @error('percent_discount')
                                                            <span id="percent_discount" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{__('admin/dashboard.start_date')}}</label>
                                                            <input type="datetime-local" name="start_datetime" id="start_datetime" class="form-control" value="{{date('Y-m-d\TH:i', strtotime($coupon->start_datetime))}}">
                                                            @error('start_datetime')
                                                            <span id="start_datetime_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.end_date')}}</label>
                                                            <input type="datetime-local" name="end_datetime" id="end_datetime" class="form-control" value="{{date('Y-m-d\TH:i', strtotime($coupon->end_datetime))}}">

                                                            @error('end_datetime')
                                                            <span id="end_datetime_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group mt-1">
                                                            <label for="switcheryColor4" class="card-title ml-1">{{__('admin/dashboard.status')}}</label>
                                                            <input type="checkbox" name="status" value="1" id="switcheryColor4"
                                                                   class="switchery active" data-color="success" @if($coupon->status == 1) checked @endif/>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions">
                                                <a href="{{route('index.coupon')}}" class="btn btn-warning mr-1"
                                                   data-dismiss="modal">
                                                    <i class="la la-undo"></i> {{__('admin/dashboard.retreat')}}</a>
                                                <button class="btn btn-primary" id="updateCopon"><i
                                                        class="la la-edit"></i>  {{__('admin/dashboard.update')}}
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
@endsection


