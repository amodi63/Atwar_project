@extends('layouts.admin')
@section('title')
    {{__('admin/sidebar.products')}}
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> {{__('admin/sidebar.products')}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/sidebar.main')}} </a></li>
                                <li class="breadcrumb-item active">{{__('admin/sidebar.products')}}</li>
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
                                    <a class="btn btn-outline-success float-left" href="{{route('create.product')}}"
                                       id="addNewProduct"><i class="la la-plus"></i>{{__('admin/dashboard.add_a_new_product')}}</a>
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
                                        <table class="table product-table">
                                            <thead>
                                            <tr>
                                                <th>{{__('admin/dashboard.name')}}</th>
                                                <th>{{__('admin/dashboard.price')}}</th>
{{--                                                <th>{{__('admin/dashboard.offer')}}</th>--}}
                                                <th>{{__('admin/dashboard.category')}}</th>
                                                <th>{{__('admin/dashboard.company')}}</th>
                                                <th>{{__('admin/dashboard.model')}}</th>
                                                <th>{{__('admin/dashboard.quantity')}}</th>
                                                <th>{{__('admin/dashboard.in_stock')}}</th>
                                                <th>{{__('admin/dashboard.images')}}</th>
                                                <th>{{__('admin/dashboard.process')}}</th>

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

    <!-- Begin Form Add Main Category -->

{{--    <div class="modal fade modal-open" id="product-modal" aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content width-800">--}}
{{--                <div class="modal-header">--}}
{{--                    <h4 class="modal-title form-section" id="modalheader">--}}
{{--                        <i class="ft-home"></i> {{__('admin/dashboard.add_a_new_product')}}--}}
{{--                    </h4>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="card-content collapse show">--}}
{{--                        <div class="card-body">--}}
{{--                            <form class="form" id="productForm" enctype="multipart/form-data">--}}
{{--                                @csrf--}}

{{--                                <div class="form-body">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="projectinput1">{{__('admin/dashboard.label_name_arabic')}}</label>--}}
{{--                                                <input type="text" name="name_ar" id="name_ar" value="{{old('name_ar')}}" class="form-control">--}}
{{--                                            </div>--}}
{{--                                            <span id="name_ar_error" class="text-danger"></span>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="projectinput1">{{__('admin/dashboard.label_name_english')}}</label>--}}
{{--                                                <input type="text" name="name_en" id="name_en" value="{{old('name_en')}}" class="form-control">--}}
{{--                                            </div>--}}
{{--                                            <span id="name_en_error" class="text-danger"></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="projectinput1">{{__('admin/dashboard.price')}}</label>--}}
{{--                                                <input type="text" name="price" id="price" value="{{old('price')}}" class="form-control">--}}
{{--                                            </div>--}}
{{--                                            <span id="price_error" class="text-danger"></span>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="projectinput1">{{__('admin/dashboard.offer')}}</label>--}}
{{--                                                <input type="text" name="offer" id="offer" value="{{old('offer')}}" class="form-control">--}}
{{--                                            </div>--}}
{{--                                            <span id="offer_error" class="text-danger"></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="projectinput1">{{__('admin/dashboard.category')}}</label>--}}
{{--                                                <select name="category_id" id="category_id" class="form-control">--}}
{{--                                                    <optgroup label="{{__('admin/dashboard.category_id')}}">--}}
{{--                                                        @isset($categories)--}}
{{--                                                            @foreach($categories as $category)--}}
{{--                                                                <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        @endisset--}}

{{--                                                    </optgroup>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                            <span id="category_id_error" class="text-danger"></span>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="projectinput1">{{__('admin/dashboard.company')}}</label>--}}
{{--                                                <select name="company_id" id="company_id" class="form-control">--}}
{{--                                                    <optgroup label="{{__('admin/dashboard.company_id')}}">--}}
{{--                                                        @isset($companies)--}}
{{--                                                            @foreach($companies as $company)--}}
{{--                                                                <option value="{{$company->id}}">{{$company->name}}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        @endisset--}}
{{--                                                    </optgroup>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                            <span id="company_id_error" class="text-danger"></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="projectinput1">{{__('admin/dashboard.model')}}</label>--}}
{{--                                                <select name="model_id" id="model_id" class="form-control">--}}
{{--                                                    <optgroup label="{{__('admin/dashboard.model_id')}}">--}}
{{--                                                        @isset($models)--}}
{{--                                                            @foreach($models as $model)--}}
{{--                                                                <option value="{{$model->id}}">{{$model->name}}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        @endisset--}}
{{--                                                    </optgroup>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                            <span id="model_id_error" class="text-danger"></span>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="projectinput1">{{__('admin/dashboard.sku')}}</label>--}}
{{--                                                <input type="text" name="sku" id="sku" value="{{old('sku')}}" class="form-control">--}}
{{--                                            </div>--}}
{{--                                            <span id="sku_error" class="text-danger"></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="projectinput1">{{__('admin/dashboard.in_stock')}}</label>--}}
{{--                                                <select name="in_stock" id="in_stock" class="form-control">--}}
{{--                                                    <optgroup label="{{__('admin/dashboard.please_select_a_product_status')}}">--}}
{{--                                                        <option value="">{{__('admin/dashboard.please_select_a_product_status')}}</option>--}}
{{--                                                        <option value="1">{{__('admin/dashboard.available')}}</option>--}}
{{--                                                        <option value="0">{{__('admin/dashboard.unavailable')}}</option>--}}
{{--                                                    </optgroup>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                            <span id="in_stock_error" class="text-danger"></span>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-6" style="display:none"  id="qtyDiv">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="projectinput1">{{__('admin/dashboard.quantity')}}</label>--}}
{{--                                                <input type="text" name="quantity" id="quantity" value="{{old('quantity')}}" class="form-control">--}}
{{--                                            </div>--}}
{{--                                            <span id="quantity_error" class="text-danger"></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="projectinput1">{{__('admin/dashboard.label_description_arabic')}}</label>--}}
{{--                                                <textarea name="description_ar" id="description_ar" cols="15"--}}
{{--                                                          rows="15" class="ckeditor">{{old('description_ar')}}</textarea>--}}
{{--                                            </div>--}}
{{--                                            <span id="description_ar_error" class="text-danger"></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="projectinput1">{{__('admin/dashboard.label_description_english')}}</label>--}}
{{--                                                <textarea name="description_en" id="description_en" cols="15"--}}
{{--                                                          rows="15" class="ckeditor">{{old('description_en')}}</textarea>--}}
{{--                                            </div>--}}
{{--                                            <span id="description_en_error" class="text-danger"></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


{{--                                </div>--}}

{{--                                <div class="form-actions">--}}
{{--                                    <input type="hidden" name="action" id="action" value="Add">--}}
{{--                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i--}}
{{--                                            class="la la-undo"></i> {{__('admin/dashboard.retreat')}}--}}
{{--                                    </button>--}}
{{--                                    <button class="btn btn-primary" id="addProduct"><i class="la la-save"></i> {{__('admin/dashboard.save')}}</button>--}}
{{--                                </div>--}}

{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- End Form Add Main Category -->



    <!-- // Basic form layout section end -->



    {{-- Confirmation Modal --}}
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">{{__('admin/dashboard.confirm_delete')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="delete_modal_form">
                    @csrf
                    {{method_field('delete')}}

                    <div class="modal-body">
                        <input type="hidden" id="delete_language">
                        <h5>{{__('admin/dashboard.alert_delete_product')}}</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">{{__('admin/dashboard.cancel')}}</button>
                        <button type="submit" class="btn btn-danger" id="delete">{{__('admin/dashboard.delete')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Confirmation Modal --}}


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

            //Show Table
            var productTable = $('.product-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.product")}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    // {data: 'offer', name: 'offer'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'company_id', name: 'company_id'},
                    {data: 'model_id', name: 'model_id'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'in_stock', name: 'in_stock'},
                    {data: 'images', name: 'images'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                @if(app()-> getLocale() == 'ar')
                language: {"url": "{{asset('assets/admin/js/dataTableArabic.json')}}"},
                @endif
            });


            //Show Form
            // $('#addNewProduct').click(function () {
            //     $('#productForm').trigger('reset');
            //     $('#product-modal').modal('show');
            //
            // });


            //Add Or Update
            $(document).on('click', '#addProduct', function (e) {
                e.preventDefault();

                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                var formData = new FormData($('#productForm')[0]);
                $('#name_ar_error').text('');
                $('#name_en_error').text('');
                $('#price_error').text('');
                $('#offer_error').text('');
                $('#category_id_error').text('');
                $('#company_id_error').text('');
                $('#model_id_error').text('');
                $('#sku_error').text('');
                $('#quantity_error').text('');
                $('#in_stock_error').text('');
                $('#description_ar_error').text('');
                $('#description_en_error').text('');
                $.ajax({
                    type: 'post',
                    url: "{{ route('save.product') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('#productForm').trigger('reset');
                            $('#product-modal').modal('hide');
                            productTable.draw();
                        } else {
                            toastr.error(data.msg);
                            $('#productForm').trigger('reset');
                            $('#product-modal').modal('hide');
                            productTable.draw();
                        }

                    },

                    error: function (reject) {
                        console.log('Error: not added', reject);
                        var response = $.parseJSON(reject.responseText);
                        $.each(response.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);


                        });

                    }

                });
            });

            //Delete

            $('body').on('click', '.deleteProduct', function () {
                var id = $(this).data('id');
                $('#delete-modal').modal('show');

                $('#delete').click(function (e) {
                    e.preventDefault();
                    $.ajax({

                        url: "delete/" + id,

                        success: function (data) {
                            console.log('success:', data);
                            if (data.status == true) {
                                $('#delete-modal').modal('hide');
                                toastr.warning(data.msg);
                                productTable.draw();
                            }else{
                                $('#delete-modal').modal('hide');
                                toastr.warning(data.msg);
                                productTable.draw();
                            }

                        }

                    });
                });

                $('#cancel').click(function () {
                    $('#delete-modal').modal('hide');
                });
            });

        });
    </script>
@endsection
