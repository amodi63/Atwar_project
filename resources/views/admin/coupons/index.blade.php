@extends('layouts.admin')
@section('title')
    {{__('admin/sidebar.coupon')}}
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin/sidebar.coupon')}} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/sidebar.main')}} </a></li>
                                <li class="breadcrumb-item active">  {{__('admin/sidebar.coupon')}}</li>
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
                                    <a class="btn btn-outline-success float-left" href="javascript:void(0)"
                                       id="addNewCopon"><i class="la la-plus"></i> {{__('admin/dashboard.add_a_new_coupon')}}</a>
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

                                <div class="card-content collapse show" id="viewCopons">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table copon-table">
                                            <thead>
                                            <tr>
                                                <th>{{__('admin/dashboard.products')}}</th>
                                                <th>{{__('admin/dashboard.code')}}</th>
                                                <th>{{__('admin/dashboard.type')}}</th>
                                                <th>{{__('admin/dashboard.discount_percentage')}}</th>
                                                <th>{{__('admin/dashboard.end_date')}}</th>
                                                <th>{{__('admin/dashboard.status')}}</th>
                                                <th>{{__('admin/dashboard.process')}}</th>

                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
{{--                                        <div class="row mt-1">--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <select name="vendor" data-vendor="0" id="vendor_id" class="form-control">--}}
{{--                                                    <optgroup label="الرجاء اختر التاجر">--}}
{{--                                                        <option value="">اختر التاجر</option>--}}
{{--                                                        @isset($vendors)--}}
{{--                                                            @foreach($vendors as $vendor)--}}
{{--                                                                <option value="{{$vendor->name}}">{{$vendor->name}}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        @endisset--}}
{{--                                                    </optgroup>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <input type="text" data-code="1" name="code" id="code_filter" class="form-control" placeholder="الكود">--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <select name="type" data-type="2" id="type_filter" class="select2 form-control">--}}
{{--                                                    <optgroup label="الرجاء اختر نوع الكوبون">--}}
{{--                                                        <option value="">نوع الكوبون</option>--}}
{{--                                                        <option value="نسبة">نسبة</option>--}}
{{--                                                        <option value="قيمة ثابتة">قيمة ثابتة</option>--}}
{{--                                                    </optgroup>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <input type="text" data-percent_discount="3" name="percent_discount" id="percent_discount_filter" class="form-control" placeholder="نسبة الخصم">--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-3 mt-1">--}}
{{--                                                <input type="date" data-end="4" name="end_datetime" id="end_datetime_filter" class="form-control">--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-3 mt-1">--}}
{{--                                                <select  data-status="5" name="status" id="status_filter" class="select2 form-control">--}}
{{--                                                    <optgroup label="الرجاء اختر الحالة">--}}
{{--                                                        <option value="">الحالة</option>--}}
{{--                                                        <option value="1">مفعل</option>--}}
{{--                                                        <option value="0">غير مفعل</option>--}}
{{--                                                    </optgroup>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
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

    <div class="modal fade modal-open" id="copon-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-800">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i>{{__('admin/dashboard.add_a_new_coupon')}}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="coponForm" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2"> {{__('admin/dashboard.products')}}</label>
                                                <select name="products[]" id="products" class="select2 form-control width-350" multiple>
                                                    <optgroup label="{{__('admin/dashboard.please_select_the_product')}}">
                                                        @isset($products)
                                                            @foreach($products as $product)
                                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </optgroup>
                                                </select>
                                                <span id="products_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> {{__('admin/dashboard.code')}} </label>
                                                <input type="text" id="code" class="form-control" placeholder="a@#$12c"
                                                       name="code" value="{{old('code')}}">
                                                <span id="code_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2">{{__('admin/dashboard.type')}}</label>
                                                <select name="type" id="type" class="select2 form-control width-350">
                                                    <optgroup label="{{__('admin/dashboard.please_select_a_coupon_type')}}">
                                                        <option value="1">{{__('admin/dashboard.percentage')}}</option>
                                                        <option value="2">{{__('admin/dashboard.fixed_value')}}</option>
                                                    </optgroup>
                                                </select>
                                                <span id="type_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">{{__('admin/dashboard.discount_percentage')}}</label>
                                                <input type="text" id="percent_discount" class="form-control"
                                                       name="percent_discount" value="{{old('percent_discount')}}">
                                                <span id="percent_discount_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2">{{__('admin/dashboard.start_date')}}</label>
                                                <input type="datetime-local" name="start_datetime" id="start_datetime" class="form-control" value="{{old('start_datetime')}}">
                                                <span id="start_datetime_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">{{__('admin/dashboard.end_date')}}</label>
                                                <input type="datetime-local" name="end_datetime" id="end_datetime" class="form-control" value="{{old('end_datetime')}}">
                                                <span id="end_datetime_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mt-1">
                                                <label for="switcheryColor4" class="card-title ml-1">{{__('admin/dashboard.status')}}</label>
                                                <input type="checkbox" name="status" value="1" id="switcheryColor4"
                                                       class="switchery active" data-color="success" checked/>

                                                <span id="status_error" class="text-danger"></span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i> {{__('admin/dashboard.retreat')}}
                                    </button>
                                    <button class="btn btn-primary" id="addCopon"><i class="la la-save"></i> {{__('admin/dashboard.save')}}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <h5>{{__('admin/dashboard.alert_delete_coupon')}}</h5>
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

            //Show Table
            var coponTable = $('.copon-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.coupon")}}",
                columns: [
                    {data: 'products', name: 'products'},
                    {data: 'code', name: 'code'},
                    {data: 'type', name: 'type'},
                    {data: 'percent_discount', name: 'percent_discount'},
                    {data: 'end_datetime', name: 'end_datetime'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                @if(app()-> getLocale() == 'ar')
                language: {"url": "{{asset('assets/admin/js/dataTableArabic.json')}}"},
                @endif
            });

            // $('select[name="vendor"]').on('change',function(){
            //     coponTable.column($(this).data('vendor')).search($(this).val()).draw();
            //
            // });
            //
            // $('#code_filter').on('keyup',function(){
            //     coponTable.column($(this).data('code')).search($(this).val()).draw();
            //
            // });
            //
            // $('select[name="type"]').on('change',function(){
            //     coponTable.column($(this).data('type')).search($(this).val()).draw();
            //
            // });
            //
            // $('#percent_discount_filter').on('keyup',function(){
            //     coponTable.column($(this).data('percent_discount')).search($(this).val()).draw();
            //
            // });
            //
            // $('#end_datetime_filter').on('change',function(){
            //     coponTable.column($(this).data('end')).search($(this).val()).draw();
            //
            // });
            //
            // $('select[name="status"]').on('change',function(){
            //     coponTable.column($(this).data('status')).search($(this).val()).draw();
            //
            // });



            //Show Form
            $('#addNewCopon').click(function () {
                $('#coponForm').trigger('reset');
                $('#copon-modal').modal('show');

            });


            //Add Or Update
            $(document).on('click', '#addCopon', function (e) {
                e.preventDefault();
                var formData = new FormData($('#coponForm')[0]);
                $('#products_error').text('');
                $('#code_error').text('');
                $('#type-error').text('');
                $('#percent_discount_error').text('');
                $('#start_datetime_error').text('');
                $('#end_datetime_error').text('');

                $.ajax({
                    type: 'post',
                    url: "{{ route('save.coupon') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('#coponForm').trigger('reset');
                            $('#copon-modal').modal('hide');
                            coponTable.draw();
                        } else {
                            toastr.error(data.msg);
                            $('#coponForm').trigger('reset');
                            $('#copon-modal').modal('hide');
                            coponTable.draw();
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

            $('body').on('click', '.deleteCopon', function () {
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
                                coponTable.draw();
                            }

                        }

                    });
                });

                $('#cancel').click(function () {
                    $('#delete-modal').modal('hide');
                });
            });

            $(document).on('change', '.is_active', function () {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let coupon_id = $(this).data('id');
                console.log(status);
                console.log(coupon_id);
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: '{{ route('updateStatus.coupon') }}',
                    data: {'status': status, 'coupon_id': coupon_id},
                    success: function (data) {
                        toastr.success(data.msg);
                    }
                });
            });



        });
    </script>
@endsection
