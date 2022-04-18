@extends('layouts.site')
@section('title')
    {{__('site/site.cart')}}
@endsection
@section('content')

  <section class="cart-page">


    <div class="container-fluid">
      <div class="panel panel-default">

        <div class="panel-body">

          <div class="stepper">

            <ul class="float-r nav nav-tabs mt-50 mb-50" role="tablist">
              <li role="presentation" class="active">
                <a class="persistant-disabled" href="#stepper-step-1" data-toggle="tab" aria-controls="stepper-step-1"
                  role="tab" title="Step 1">
                  <span class="round-tab">
                    <img class="img-responsive" src="{{asset('assets/front/images/cart/cart-icon.png')}}" alt="">
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a class="persistant-disabled" href="#stepper-step-2" data-toggle="tab" aria-controls="stepper-step-2"
                  role="tab" title="Step 2">
                  <span class="round-tab"> <img class="img-responsive" src="{{asset('assets/front/images/cart/delivery.png')}}" alt=""></span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a class="persistant-disabled" href="#stepper-step-3" data-toggle="tab" aria-controls="stepper-step-3"
                  role="tab" title="Step 3">
                  <span class="round-tab"><img class="img-responsive" src="{{asset('assets/front/images/cart/paying.png')}}" alt=""></span>
                </a>
              </li>

            </ul>


              <form>
              <div class="tab-content">
                <div class="tab-pane fade in active" role="tabpanel" id="stepper-step-1">
                  <div class="fs-23 shoping-cart-panner fw-bold mt-23">
                      {{__('site/site.shopping_cart')}}
                  </div>
                  <div  class="table-responsive full-width" style="overflow-y: hidden">
                    <table id="tableid">
                      <thead class="table-head">
                        <tr>
                          <th class="padding-rl-32">{{__('site/site.product')}}</th>
                          <th>{{__('site/site.model')}}</th>
                          <th>{{__('site/site.quantity')}}</th>
                          <th>{{__('site/site.unit_price')}}</th>
                          <th>{{__('site/site.price')}}</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody class="table-body">
                      @isset($carts_products)
                              @foreach($carts_products as $index => $cart_product)
                                        <tr class="delete-product" data-id="{{$index+1}}">
                                            <td class="text-center">

                                                <div class="container-fluid">
                                                    <div class="product-row">

                                                        <img class="float-l img-responsive" src="{{$cart_product->product->getPhoto($cart_product->product->images[0]->photo)}}" alt="">
                                                        <p class="mt-16">
                                                            <span class="text-nowrap fs-18 fw-bold"> {{$cart_product->product->name}} </span> <br>
                                                            <span class="fs-15 gray-color ta-start pos-15">
                                     {{$cart_product->product->sku}}
                                    </span>
                                                        </p>
                                                    </div>
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-4">--}}
{{--                                                            <img class="float-l img-responsive" src="{{$cart_product->product->getPhoto($cart_product->product->images[0]->photo)}}" alt="">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-6 ta-start">--}}
{{--                                                            <p class="pt-15p mt-16">--}}

{{--                                                                <span class="text-nowrap fs-18 fw-bold"> {{$cart_product->product->name}} </span> <br>--}}
{{--                                                                <span class="fs-15 gray-color ta-start pos-15">{{$cart_product->product->sku}}</span>--}}
{{--                                                            </p>--}}

{{--                                                        </div>--}}
{{--                                                    </div>--}}

                                                </div>
                                            </td>
                                            <td>{{$cart_product->product->model->name}}</td>

                                            <td>
                                                <div class="spin-input nowrap fx-row fx-fill">
                                                    <div class="icon">
                                                        <span class="productQuantityMinus" data-product-id="{{$cart_product->product->id}}" data-count-product="{{$cart_product->product->quantity}}" data-product-price="{{$cart_product->product->price}}">-</span>
                                                    </div>
                                                    <div  class="icon">
                                                        <span id="quantity_span_{{$cart_product->product->id}}">{{$cart_product->quantity}}</span>
                                                        <input type="text" id="quantity_{{$cart_product->product->id}}" class="hidden" value="{{$cart_product->quantity}}"  data-product-id="{{$cart_product->product->id}}">
                                                    </div>
                                                    <div class="icon">
                                                        <span class="productQuantityPlus" data-product-id="{{$cart_product->product->id}}" data-count-product="{{$cart_product->product->quantity}}" data-product-price="{{$cart_product->product->price}}">+</span>
                                                    </div>
                                                </div>
                                            </td>


                                            <td class="fw-bold">{{$cart_product->product->price}}</td>
                                            <td class="fw-bold" id="product_price_{{$index+1}}">{{$cart_product->product->price * $cart_product->quantity}}</td>
                                            <td>
                                                <button class="delete-btn remove-from-cart" id="deleteButton" data-product-id="{{$cart_product->product -> id}}">
                                                    <i class="fa fa-times fs-23"></i>
                                                </button>
                                            </td>
                                        </tr>

                                @endforeach
                      @endisset



                      </tbody>
                    </table>
                  </div>
                  <div class="bar">
                    <div>
                      <a class="btn btn-primary @if(count($carts_products) > 0) next-step @endif no-radius nextt-btn" id="shoped">{{__('site/site.next_step')}} </a>
                    </div>
                    <div>
                      <a href="{{route('shop')}}" class="btn btn-primary  continue-btn no-radius btn-padding">{{__('site/site.continue_shopping')}}</a>
                    </div>
                    <div class="fs-18 btn-padding hide-in-small">
                        {{__('site/site.total_cost')}} : <span class="fw-bold fs-18" id="total_price"> ${{$total_price}} </span>
                    </div>
                  </div>



                </div>

                  <form id="shippingForm">
                      @csrf
                      <div class="tab-pane fade" role="tabpanel" id="stepper-step-2">
                          <div class="fs-23  fw-bold shoping-cart-panner mt-23">
                              {{__('site/site.address_data_and_type_of_delivery')}}
                          </div>
                          <input type="hidden" id="customer_id" name="customer_id" value="{{auth('customer')->user()->id}}">
                          <input type="hidden" name="price_total" value="{{$total_price}}" id="price_total">
                          <div class="container-fluid">
                              <div class="row">
                                  <div class="col-lg-8">
                                      <div class="bill-info-form">
                                          <div>
                                              <label for="fname">{{__('site/site.first_name')}}</label> <br>
                                              <input type="text" id="fname" name="first_name1"><br>
                                              <span id="first_name1_error" class="text-danger"></span>
                                          </div>

                                          <div>
                                              <label for="lname">{{__('site/site.last_name')}}</label> <br>
                                              <input type="text" id="lname" name="last_name1"><br>
                                              <span id="last_name1_error" class="text-danger"></span>
                                          </div>

                                          <div>
                                              <label for="adress">{{__('site/site.address')}}</label> <br>
                                              <input type="text" id="adress" name="address"><br>
                                              <span id="address_error" class="text-danger"></span>
                                          </div>
                                          <div>
                                              <label for="city">{{__('site/site.city')}}</label> <br>
                                              <input type="text" id="city" name="city"><br>
                                              <span id="city_error" class="text-danger"></span>
                                          </div>
                                          <div>
                                              <label for="postal">{{__('site/site.postal_code_ZIP')}}</label> <br>
                                              <input type="text" id="postal" name="postal_code"><br>
                                              <span id="postal_code_error" class="text-danger"></span>
                                          </div>
                                          <div>
                                              <label for="pnumber">{{__('site/site.phone_number')}}</label> <br>
                                              <input type="text" id="pnumber" name="phone"><br>
                                              <span id="phone_error" class="text-danger"></span>
                                          </div>
                                          <div>
                                              <label for="country">{{__('site/site.country')}}</label><br>
                                              <select id="country" name="country">
                                                  <option value="usa"> USA </option>
                                                  <option value="australia">Australia</option>
                                                  <option value="canada">Canada</option>
                                              </select><br>
                                              <span id="country_error" class="text-danger"></span>
                                          </div>
                                          <div>
                                              <label for="email">{{__('site/site.email')}}</label> <br>
                                              <input type="text" id="email" name="email1"><br>
                                              <span id="email1_error" class="text-danger"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-lg-4 pt-50 ">
                                      <div class="text-center card-border centrlize-item">
                                          <div class="card-details">
                                              <img class="img-responsive centrlize-item" src="{{asset('assets/front/images/cart/MoneyGram.png')}}" alt="">
                                              <span class="fs-17 gray-color"> Wallet No.</span> <br>
                                              <span class="fs-24"> 2652365326 </span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="bar">
                              <div>
                                  <a class="btn btn-primary  no-radius nextt-btn" id="shippingRequest">{{__('site/site.next_step')}} </a>
                              </div>
                              <div>
                                  <a href="{{route('shop')}}" class="btn btn-primary  cancel-stepper continue-btn no-radius btn-padding">{{__('site/site.continue_shopping')}}</a>
                              </div>
                              <div   class="btn-padding">
                                  <a href="#" class="hide-in-small   prev-step black-color "> {{__('site/site.back')}} <img src="{{asset('assets/front/images/cart/small-back-arrow.png')}}" alt="arrow">   </a>
                              </div>
                          </div>
                          <div   class="btn-padding">
                              <a href="#" class=" hidden-lg   prev-step black-color "> {{__('site/site.back')}} <img src="{{asset('assets/front/images/cart/small-back-arrow.png')}}" alt="arrow">   </a>
                          </div>
                      </div>

                  </form>
                <div class="tab-pane fade" role="tabpanel" id="stepper-step-3">
                  <h3 class="hs">3. {{__('site/site.review_and_submit_payment')}}</h3>
                  <p>{{__('site/site.this_is_step_3')}}</p>

                </div>

          </div>
              </form>
        </div>
      </div>
    </div>
    </div>
  </section>



@endsection

@section('script')
    <script>
        // $('body').ready(function () {
        //     $('.spin-input').spinInput({ value: 1, minimum: 1 });
        // });
        $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var isValid = false;


        $(document).on('click', '.productQuantityPlus', function(e){
            e.preventDefault();
            let product_id = $(this).attr('data-product-id');
            let count_product = parseInt($(this).data('count-product'));
            let quantity = parseInt($('#quantity_'+product_id).val());
            if(quantity < count_product) {
                let product_price_id = $(this).closest('tr').data('id');
                let product_price = parseInt($(this).attr('data-product-price'));
                $('#product_price_' + product_price_id).html(product_price * (quantity+1));
                $('#quantity_span_' + product_id).html(quantity+1);
                $('#quantity_'+product_id).val(quantity+1);

                // totalPrice();

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '{{ route('ProductUpdateQuantity') }}',
                    data: {'quantity': quantity+1, 'product_id': product_id},
                    success: function (data) {
                       // toastr.success(data.msg);
                        $('#total_price').html('$ ' + data.total_price);
                        $('#price_total').val(data.total_price);
                    },

                    error: function () {
                        toastr.error('{{__('site/site.product_quantity_has_not_been_updated')}}');
                    }
                });
            }else{
                toastr.error('{{__('site/site.out_of_stock')}}');
            }

            });

        $(document).on('click', '.productQuantityMinus', function(e){
                e.preventDefault();
                let product_id = $(this).attr('data-product-id');
                let count_product = parseInt($(this).data('count-product'));
                let quantity = parseInt($('#quantity_'+product_id).val());
                console.log(quantity)
                if(quantity <= count_product) {
                    if (quantity > 1){
                        let product_price_id = $(this).closest('tr').data('id');
                        let product_price = parseInt($(this).attr('data-product-price'));
                        $('#product_price_' + product_price_id).html(product_price * (quantity-1));
                        $('#quantity_span_' + product_id).html(quantity-1);
                        $('#quantity_'+product_id).val(quantity-1);

                        // totalPrice();

                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: '{{ route('ProductUpdateQuantity') }}',
                            data: {'quantity': quantity-1, 'product_id': product_id},
                            success: function (data) {
                                //toastr.success(data.msg);
                                $('#total_price').html('$ ' + data.total_price);
                                $('#price_total').val(data.total_price);
                                },

                            error: function () {
                                toastr.error('{{__('site/site.product_quantity_has_not_been_updated')}}');
                            }
                        });
                    }else{
                        toastr.error('{{__('site/site.the_quantity_of_the_product_must_be_greater_than_zero')}}');
                    }

                }else{
                    toastr.error('{{__('site/site.out_of_stock')}}');
                }

            });

        $(document).on('click', '.remove-from-cart', function (e) {
            e.preventDefault();
            @guest('customer')
            toastr.warning('{{__('site/site.you_are_not_logged_into_the_system')}}')
                @endguest

            var Clickedthis = $(this);
            var product_id = $(Clickedthis).closest('.delete-product').attr('data-product-id');
            $.ajax({
                type: 'delete',
                url: "{{route('ProductDelete')}}",
                data: {
                    'product_id': $(this).attr('data-product-id'),
                },
                success: function (data) {
                    $(Clickedthis).closest('.delete-product').remove();
                    toastr.success(data.msg);
                    $('#total_price').html('$' + data.total_price);
                    $('#price_total').val(data.total_price);
                }
            });
        });



        $(document).on('click', '#shippingRequest', function (e) {
                e.preventDefault();



            var total_price = $('#price_total').val();
            var customer_id = $('#customer_id').val();
            var first_name = $('#fname').val();
            var last_name = $('#lname').val();
            var address = $('#adress').val();
            var city = $('#city').val();
            var postal_code = $('#postal').val();
            var phone = $('#pnumber').val();
            var country = $('#country').val();
            var email = $('#email').val();
            console.log($('#customer_id').val())
                var formData = new FormData($('#shippingForm')[0]);
                formData.append("price_total",total_price);
                formData.append("customer_id",customer_id);
                formData.append("first_name1",first_name);
                formData.append("last_name1",last_name);
                formData.append("address",address);
                formData.append("city",city);
                formData.append("postal_code",postal_code);
                formData.append("phone",phone);
                formData.append("country",country);
                formData.append("email1",email);
            console.log(formData)
                $('#first_name_error').text('');
                $('#last_name_error').text('');
                $('#address_error').text('');
                $('#city_error').text('');
                $('#postal_code_error').text('');
                $('#phone_error').text('');
                $('#country_error').text('');
                $('#email_error').text('');
                $.ajax({
                    type: 'post',
                    url: "{{ route('shipping') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            $('#shippingRequest').addClass('next-step');
                             isValid = true;
                             if (isValid){
                                 toastr.success(data.msg);
                                 $('#shippingRequest').addClass('next-step');
                                 (function($) {
                                     'use strict';

                                     $(function() {

                                         function triggerClick(elem) {
                                             $(elem).click();
                                         }
                                         var $progressWizard = $('.stepper'),
                                             $tab_active,
                                             $tab_prev,
                                             $tab_next,
                                             $btn_prev = $progressWizard.find('.prev-step'),
                                             $btn_next = $progressWizard.find('.next-step'),
                                             $tab_toggle = $progressWizard.find('[data-toggle="tab"]'),
                                             $tooltips = $progressWizard.find('[data-toggle="tab"][title]');

                                         $tooltips.tooltip();


                                         $tab_toggle.on('show.bs.tab', function(e) {
                                             var $target = $(e.target);

                                             if (!$target.parent().hasClass('active, disabled')) {
                                                 $target.parent().prev().addClass('completed');
                                             }
                                             if ($target.parent().hasClass('disabled')) {
                                                 return false;
                                             }
                                         });

                                             //isValid = false;
                                                 $tab_active = $progressWizard.find('.active');

                                                 $tab_active.next().removeClass('disabled');

                                                 $tab_next = $tab_active.next().find('a[data-toggle="tab"]');
                                                 triggerClick($tab_next);







                                     });

                                 }(jQuery, this));
                             }



                        } else {
                            toastr.error(data.msg);

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

        });

    </script>
@endsection
