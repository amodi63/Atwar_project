@extends('layouts.site')
@section('title')
    {{__('site/site.products')}}
@endsection
@section('content')


    <section class="shop">
        <div class="container sec-rtl">
            <div class="fs-65 colored add-thickness text-uppercase">
                {{__('site/site.products')}}
            </div>
            <div class="sub-heading-font  add-thickness brand-name  pl-65">
                {{__('site/site.read_our_newest_blog_post_right_away')}}
            </div>
        </div>
        <div class="padding-rl-39">
            <div class="container-fluid add-padding rtl-breadcrumb pr-75 pm-35 ">
                <span class="gray-color"> <img src="{{asset('assets/front/images/shop/home.png')}}" alt=""> / {{__('site/site.ALL_PRODUCTS')}} </span>
            </div>
            <div class="container-fluid  ">
                <div class="row col-cust">


                    <div class="col-lg-3 col-p-cust col-md-12 col-sm-12 mb-50 filter-box">

                        <button type="button" class="collapsible fs-12   fw-bold thick fs-12 collapse-menu">
                            <span>

                               {{__('site/site.category')}}
                            </span>
                        </button>
                        <div  class="content">


                                @isset($categories)
                                    @foreach($categories as $index =>$category)
                                    <input type="checkbox" class="check-type category" id="second-choice{{$index}}" data-type="{{$category->name}}" data-cid="{{$category->id}}" name="categories[]" value="{{$category->id}}">&nbsp;
                                    <label for="second-choice{{$index}}"><span class=".revers-float-r"> {{$category->name}} </span> &nbsp; <span   class=" revers-float-l gray-color"> ({{$category->products->count()}})</span></label><br>

                                    @endforeach
                                @endisset



                        </div>
                        <button type="button" class="collapsible mt-13 fw-bold thick fs-12 collapse-menu text-uppercase">
                            <span>
                                 {{__('site/site.price')}}
                            </span>

                        </button>
                        <div class="content">
                            <div dir="" class="p-20">

                                <p dir="" class="textimg">

                                    <input class="text-center right-amount" type="text" id="amount2" value="@if($product_max_price != null) {{$product_max_price}} @else 0 @endif">

                                    <input class="text-center left-amount" type="text" id="amount1" value="0">
                                </p>

                                <div id="slider-range">

                                </div>
                            </div>
                        </div>
                        <button type="button" class="collapsible  mt-13 fw-bold thick fs-12 collapse-menu">
                            <span>

                                {{__('site/site.company')}}
                            </span>

                        </button>
                        <div class="content">
                            @isset($companies)
                                @foreach($companies as $index => $company)
                                    <input  style="float: right;" type="checkbox" class="check-type company" id="first-choice{{$index}}" data-type="{{$company->name}}" data-id="{{$company->id}}" name="companies[]" value="{{$company->id}}">
                                    &nbsp;
                                    <label for="first-choice{{$index}}"><span class=".revers-float-r"> {{$company->name}} </span> &nbsp; <span   class=" revers-float-l gray-color"> ({{$company->products->count()}})</span></label><br>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 col-sm-12">
                        <div class="d-flex filters-row">
                            <div class="products-count">
                                <span>  {{__('site/site.ALL_PRODUCTS')}}</span> <span class="gray-color ">({{count($all_products)}})</span>
                            </div>
                            <div class="filters">
                                <span class="fs-13"> {{__('site/site.show_products')}} &nbsp;</span>
                                <select class="rounded mr-42 height-50 selectHight select-arrow" name="paginate" >
{{--                                    <option value="1" selected>1</option>--}}
{{--                                    <option value="2">2</option>--}}
{{--                                    <option value="3">3</option>--}}
{{--                                    <option value="6">6</option>--}}

                                    <option value="6" selected>6</option>
                                    <option value="12">12</option>
                                    <option value="24">24</option>
                                    <option value="30">30</option>
                                </select>

                            </div>
                        </div>

                        <div id="tag_container">
                            @include('site._shopPaginate')

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" style="margin-top: 200px" id="store-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <h1 class="text-center">{{__('site/site.prices_do_not_include_delivery')}}</h1>
                    </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>

        $(document).ready(function () {
            $('#store-modal').modal('show');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var categories = [];
            var companies = [];
            var min_val = 0;
            var max_val = $('#amount2').val();
            var type;

            $('select[name="paginate"]').on('change',function(e){
                e.preventDefault();
                var paginate = $('select[name="paginate"]').val();

                type = 'paginate';
                console.log(paginate)
                $.ajax({
                    type: 'get',
                    url: '{{route('shop')}}',
                    data: {
                        'categories': categories.length > 0 ? categories : null,
                        'companies': companies.length > 0 ? companies : null,
                        'min_val': min_val ,
                        'max_val': max_val,
                        'paginate': paginate,
                    },
                    success: function (data) {
                        $('#tag_container').html('');
                        $('#tag_container').append(data);

                    }
                });
            });

            $(window).on('hashchange', function() {
                if (window.location.hash) {
                    var page = window.location.hash.replace('#', '');
                    if (page == Number.NaN || page <= 0) {
                        return false;
                    }else{
                        getData(page);
                    }
                }
            });

            $(document).ready(function()
            {
                $(document).on('click', '.pagination a',function(event)
                {
                    event.preventDefault();

                    $('li').removeClass('active');
                    $(this).parent('li').addClass('active');

                    var myurl = $(this).attr('href');
                    var page=$(this).attr('href').split('page=')[1];


                    getData(page);
                });

            });

            function getData(page){
                var paginate = $('select[name="paginate"]').val();


                $('input[name="categories[]"]:checked').each(function () {
                    categories.push(parseInt($('input[name="categories[]"]:checked').attr('data-cid')));
                });

                let data = {
                    page: page,
                    paginate: paginate,
                    categories: categories,
                    companies: companies,
                    min_val: min_val,
                    max_val: max_val,
                }
                console.log(categories)


                $.ajax(
                    {
                        url: '{{route('shop')}}',
                        data: data,
                        type: "get",
                        datatype: "html"
                    }).done(function(data){
                    $("#tag_container").empty().html(data);
                    location.hash = page;
                }).fail(function(jqXHR, ajaxOptions, thrownError){
                    alert('No response from server');
                });
            }



            //var paginate = $('select[name="paginate"]').val();

            $(document).on('change', '.category', function (e) {
                e.preventDefault();
                var paginate = $('select[name="paginate"]').val();
                categories = [];
                $('input[name="categories[]"]:checked').each(function () {
                    categories.push(parseInt($(this).data('cid')));
                });

                console.log(categories)

                $.ajax({
                    type: 'get',
                    url: '{{route('shop')}}',
                    data: {
                        'categories': categories.length > 0 ? categories : null,
                        'companies': companies.length > 0 ? companies : null,
                        'min_val': min_val ,
                        'max_val': max_val,
                        'paginate': paginate,
                        'page': parseInt(1),
                    },
                    success: function (data) {
                        $('#tag_container').html('');
                        $('#tag_container').append(data);


                    }
                });
            });

            $(document).on('change', '.company', function (e) {
                e.preventDefault();
                var paginate = $('select[name="paginate"]').val();
                companies = [];
                $('input[name="companies[]"]:checked').each(function () {
                    companies.push(parseInt($(this).data('id')));
                });

                $.ajax({
                    type: 'get',
                    url: '{{route('shop')}}',
                    data: {
                        'categories': categories.length > 0 ? categories : null,
                        'companies': companies.length > 0 ? companies : null,
                        'min_val': min_val ,
                        'max_val': max_val,
                        'paginate': paginate,
                        'page': parseInt(1),

                    },
                    success: function (data) {
                        $('#tag_container').html('');
                        $('#tag_container').append(data);

                    }
                });
            });


            $(function() {
                $( "#slider-range" ).slider({
                    range: true,
                    min: 0,
                    max: parseInt(max_val),
                    values: [ 0, parseInt(max_val) ],
                    slide: function( event, ui ) {
                        $( "#amount" ).html( "Price : $" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                        $( "#amount1" ).val(ui.values[ 0 ]);
                        $( "#amount2" ).val(ui.values[ 1 ]);
                        min_val = ui.values[ 0 ];
                        max_val = ui.values[ 1 ]
                        var paginate = $('select[name="paginate"]').val();
                        $.ajax({
                            type: 'get',
                            url: '{{route('shop')}}',
                            data: {
                                'categories': categories.length > 0 ? categories : null,
                                'companies': companies.length > 0 ? companies : null,
                                'min_val': min_val ,
                                'max_val': max_val,
                                'paginate': paginate,
                                'page': parseInt(1),
                            },
                            success: function (data) {
                                $('#tag_container').html('');
                                $('#tag_container').append(data);

                            }
                        });
                    }

                });



                $( "#amount" ).html( "Price : $" + $( "#slider-range" ).slider( "values", 0 ) +
                    " - $" + $( "#slider-range" ).slider( "values", 1 ) );

                $( "#amount1" ).val($( "#slider-range" ).slider( "values", 0 ));
                $( "#amount2" ).val($( "#slider-range" ).slider( "values", 1 ));
            });



        });

    </script>
@endsection
