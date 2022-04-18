@extends('layouts.admin')
@section('title')
    {{__('admin/dashboard.edit_product')}} - {{$product->name}}
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
                                        href="{{route('admin.dashboard')}}">{{__('admin/sidebar.main')}} </a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{route('index.product')}}"> {{__('admin/sidebar.products')}} </a>

                                </li>
                                <li class="breadcrumb-item active"> {{__('admin/dashboard.edit_product')}} - {{$product->name}}
                                </li>

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
                                              action="{{route('update.product',$product->id)}}"
                                              id="vendorForm" enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i>   {{__('admin/dashboard.edit_product')}} - {{$product->name}}
                                            </h4>
                                            <input type="hidden" name="id" value="{{$product->id}}">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_name_arabic')}}</label>
                                                            <input type="text" name="name_ar" id="name_ar" value="{{$product->getTranslation('name', 'ar')}}" class="form-control">
                                                        </div>
                                                        @error('name_ar')
                                                        <span id="name_ar_error" class="text-danger">{{$message}}</span>
                                                        @enderror

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_name_english')}}</label>
                                                            <input type="text" name="name_en" id="name_en" value="{{$product->getTranslation('name', 'en')}}" class="form-control">
                                                        </div>
                                                        @error('name_en')
                                                        <span id="name_en_error" class="text-danger">{{$message}}</span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.price')}}</label>
                                                            <input type="number" step="any" name="price" id="price" value="{{$product->price}}" class="form-control">
                                                        </div>
                                                        @error('price')
                                                        <span id="price_error" class="text-danger">{{$message}}</span>
                                                        @enderror

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.category')}}</label>
                                                            <select name="category_id" id="category_id" class="form-control">
                                                                <optgroup label="{{__('admin/dashboard.category')}}">
                                                                    @isset($categories)
                                                                        @foreach($categories as $category)
                                                                            <option value="{{$category->id}}" @if($product->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                                                        @endforeach
                                                                    @endisset
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                        @error('category_id')
                                                        <span id="category_id_error" class="text-danger">{{$message}}</span>
                                                        @enderror

                                                    </div>

{{--                                                    <div class="col-md-6">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="projectinput1">{{__('admin/dashboard.offer')}}</label>--}}
{{--                                                            <input type="text" name="offer" id="offer" value="{{$product->offer}}" class="form-control">--}}
{{--                                                        </div>--}}
{{--                                                        @error('offer')--}}
{{--                                                        <span id="offer_error" class="text-danger">{{$message}}</span>--}}
{{--                                                        @enderror--}}

{{--                                                    </div>--}}
                                                </div>

                                                <div class="row">


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.company')}}</label>
                                                            <select name="company_id" id="company_id" class="form-control">
                                                                <optgroup label="{{__('admin/dashboard.company')}}">
                                                                    @isset($companies)
                                                                        @foreach($companies as $company)
                                                                            <option value="{{$company->id}}" @if($product->company_id == $company->id) selected @endif>{{$company->name}}</option>
                                                                        @endforeach
                                                                    @endisset
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                        @error('company_id')
                                                        <span id="company_id_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.model')}}</label>
                                                            <select name="model_id" id="model_id" class="form-control">
                                                                <optgroup label="{{__('admin/dashboard.model')}}">
                                                                    @isset($models)
                                                                        @foreach($models as $model)
                                                                            <option value="{{$model->id}}" @if($product->model_id == $model->id) selected @endif>{{$model->name}}</option>
                                                                        @endforeach
                                                                    @endisset
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                        @error('model_id')
                                                        <span id="model_id_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.sku')}}</label>
                                                            <input type="text" name="sku" id="sku" value="{{$product->sku}}" class="form-control">
                                                        </div>
                                                        @error('sku')
                                                        <span id="sku_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.in_stock')}}</label>
                                                            <select name="in_stock" id="in_stock" class="form-control">
                                                                <optgroup label="{{__('admin/dashboard.please_select_a_product_status')}}">
                                                                    <option value="">{{__('admin/dashboard.please_select_a_product_status')}}</option>
                                                                    <option value="1" @if($product->in_stock == 1) selected @endif>{{__('admin/dashboard.available')}}</option>
                                                                    <option value="0" @if($product->in_stock == 0) selected @endif>{{__('admin/dashboard.unavailable')}}</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                        @error('in_stock')
                                                        <span id="in_stock_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6"  @if($product->in_stock == 0) style="display:none" @endif  id="qtyDiv">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.quantity')}}</label>
                                                            <input type="number" name="quantity" id="quantity" value="{{$product->quantity}}" class="form-control">
                                                        </div>
                                                        @error('quantity')
                                                        <span id="quantity_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_description_arabic')}}</label>
                                                            <textarea name="description_ar" id="description_ar" cols="15"
                                                                      rows="15" class="ckeditor">{{$product->getTranslation('description', 'ar')}}</textarea>
                                                        </div>
                                                        @error('description_ar')
                                                        <span id="description_ar_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_description_english')}}</label>
                                                            <textarea name="description_en" id="description_en" cols="15"
                                                                      rows="15" class="ckeditor"> {{$product->getTranslation('description', 'en')}}</textarea>
                                                        </div>
                                                        @error('description_en')
                                                        <span id="description_en_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="form-actions">
                                                <a href="{{route('index.product')}}" class="btn btn-warning mr-1"
                                                   data-dismiss="modal"><i
                                                        class="la la-undo"></i> {{__('admin/dashboard.retreat')}}
                                                </a>
                                                <button class="btn btn-primary" id="updateProduct"><i
                                                        class="la la-edit"></i> {{__('admin/dashboard.update')}}
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

@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('change','#in_stock',function(){
                if($(this).val() == 1 ){
                    $('#qtyDiv').show();
                }else{
                    $('#qtyDiv').hide();
                }
            });


        });
    </script>
@endsection


