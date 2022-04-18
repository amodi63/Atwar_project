@extends('layouts.admin')
@section('title')
    {{__('admin/sidebar.orders')}}
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
                                <li class="breadcrumb-item active"> {{__('admin/sidebar.orders')}}</li>
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
                                        <table class="table  orders-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{__('admin/dashboard.customer')}}</th>
                                                <th>{{__('admin/dashboard.product')}}</th>
                                                <th>{{__('admin/dashboard.date_of_sale')}}</th>
                                                <th>{{__('admin/dashboard.quantity')}}</th>
                                                <th>{{__('admin/dashboard.unit_price')}}</th>
                                                <th>{{__('admin/dashboard.price')}}</th>
                                                <th>{{__('admin/dashboard.status')}}</th>
                                                <th>{{__('admin/dashboard.process')}}</th>

                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="8" style="text-align:right;  white-space: nowrap;">{{__('admin/dashboard.total')}} : </th>
                                                <th></th>
                                            </tr>
                                            </tfoot>
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

            //Show Table
            var ordersTable = $('.orders-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: "{{route("orders")}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'customer', name: 'customer'},
                    {data: 'product', name: 'product'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'price', name: 'price'},
                    {data: 'total_price', name: 'total_price'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                @if(app()-> getLocale() == 'ar')
                language: {"url": "{{asset('assets/admin/js/dataTableArabic.json')}}"},
                @endif
               // "dom":  '<"rt-buttons"Bf><"clear">ltip',
                "paging": true,
                "autoWidth": true,
                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column( 6 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 8, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    // Update footer
                    $( api.column( 8 ).footer() ).html(
                        '$'+pageTotal +' ( $'+ {{$total_price}} +' {{__('admin/dashboard.total')}})'
                    );

                },


            });

            $(document).on('click', '.changeStatus', function (e) {
                e.preventDefault();

                var status = $(this).data('status');
                var order_id = $(this).data('id');

                $.ajax({
                    type: 'post',
                    url: "{{ route('changeStatus.order') }}",
                    data: {'order_id': order_id, 'status': status},
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true){
                            toastr.success(data.msg);
                            if (data.order_status == 1) {
                                    $('#pending_'+order_id).addClass('display');
                                    $('#pending_'+order_id).removeClass('hidden');
                                    $('#pending_'+order_id).attr('data-status', data.order_status);
                                    $('#completed_'+order_id).attr('data-status', data.order_status);
                                    $('#completed_'+order_id).addClass('hidden');


                            } else if(data.order_status == 0) {
                                    $('#pending_'+order_id).addClass('hidden');
                                    $('#completed_'+order_id).addClass('display');
                                    $('#completed_'+order_id).removeClass('hidden');
                                    $('#pending_'+order_id).attr('data-status', data.order_status);
                                    $('#completed_'+order_id).attr('data-status', data.order_status);



                            }
                        }



                    },


                });
            });



        });
    </script>
@endsection
