<!DOCTYPE html>
<html lang="en" data-textdirection="{{app() -> getLocale() === 'ar' ? 'rtl' : 'ltr'}}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile mtea -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
    @if(app() -> getLocale() == 'ar')
        <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap-rtl.css')}}">
    @endif
    <link rel="stylesheet" href="{{asset('assets/front/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/slick-theme.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets/front/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
    @if(app() -> getLocale() == 'ar')
        <link rel="stylesheet" href="{{asset('assets/front/css/rtl.css')}}">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


</head>

<body>

@include('site.includes.header')
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">{{__('site/site.login')}}</h4>
                <p class="text-center centrlize-item">
                    Lorem Ipsum is simply dummy text of the printing
                    Lorem Ipsum is simply dummy text of the printing

                </p>
            </div>
            <div class="modal-body">
                <div class="login-inputs">

                    <form id="loginForm">
                        <div class="form-group">
                            <input placeholder="{{__('site/site.email')}}" type="email" name="email" class="form-control input-cust  fs-20  pl-32 fw-bold pl-63">
                            <span id="login_email_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <input id="password-field" placeholder="{{__('site/site.password')}}" name="password" type="password" class="form-control input-cust fs-20  pl-32 fw-bold pl-63">
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            <span id="login_password_error" class="text-danger"></span>
                        </div>
                        <div class="modal-checkbox">
                            <input  type="checkbox" id="first-choice" name="remember"> &nbsp;
                            <label for="fs-20 fw-bold"> {{__('site/site.keep_me_signed_in')}}</label>
                            <a href="#" class="float-r fs-20 gray-color "style="margin-top: 0.6rem;" >  {{__('site/site.forgot_password')}}</a>
                        </div>
                        <button class="submit-login" type="submit" id="sign_in">{{__('site/site.sign_in')}}</button>
                    </form>

                </div>
            </div>
            <div class="modal-footer">

                <span class="fs-22"> {{__('site/site.not_a_member_yet?')}}</span> <br class="hidden-lg">
                <a  data-dismiss="modal" type="button" class="btn-lg modal-btn" data-toggle="modal" data-target="#registerModal">{{__('site/site.sign_up')}}</a>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg modal-cust" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                <h4 class="modal-title-register" id="myModalLabel">{{__('site/site.create_account')}} </h4>

                <p class="text-center centrlize-item-p">
                    Lorem Ipsum is simply dummy text of the printing
                    Lorem Ipsum is simply dummy text of the printing
                </p>
            </div>
            <div class="modal-body custt">
                <div class="sign-inputs">
                    <form id="registerForm">
                        <div class="form-group">
                            <input   placeholder="{{__('site/site.first_name')}}" type="text" name="first_name" type="text" value="{{old('first_name')}}" class="form-control input-cust fs-20   pl-32 fw-bold" id="first_name">
                            <span id="first_name_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <input placeholder="{{__('site/site.last_name')}}" name="last_name" type="text" value="{{old('last_name')}}" class="form-control input-cust fs-20   pl-32 fw-bold  pl-63" id="last_name">
                            <span id="last_name_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <input placeholder="{{__('site/site.email')}}" name="email" type="email" value="{{old('email')}}" class="form-control input-cust fs-20  pl-32 fw-bold pl-63">
                            <span id="email_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <input id="password-field1" placeholder="{{__('site/site.password')}}" name="password" value="{{old('password')}}" type="password" class="form-control input-cust fs-20   pl-32 fw-bold pl-63" >
                            <span toggle="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            <span id="password_error" class="text-danger"></span>
                        </div>
                        <div class="modal-checkbox">
                            <input type="checkbox" id="first-choice" name="terms_conditions"> &nbsp;
                            <label style="width: 89%;" for="mb-50 fw-bold"> {{__('site/site.i_agree_terms')}}</label>
                            <span id="terms_conditions_error" class="text-danger" style="position: relative; top: 12px"></span>
                        </div>

                        <button class="submit-login" type="submit" id="sign_up">{{__('site/site.sign_up')}}</button>

                    </form>
                </div>
            </div>
            <div class="modal-footer">

                <a  data-dismiss="modal" type="button" class="btn-lg modal-btn" data-toggle="modal" data-target="#loginModal" style="position: relative; top: 5px">{{__('site/site.are_you_already_a_member')}}</a>

            </div>
        </div>
    </div>
</div>
@yield('content')


@include('site.includes.footer')


<script src="{{asset('assets/front/js/jquery.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('assets/front/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/front/js/owl-carousel.min.js')}}"></script>
<script src="{{asset('assets/front/js/slick.min.js')}}"></script>
<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/front/js/main.js')}}"></script>

@yield('script')
<script type="text/javascript">

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        //Add Or Update
        $(document).on('click', '#sign_up', function (e) {
            e.preventDefault();
            var formData = new FormData($('#registerForm')[0]);
            $('#first_name_error').text('');
            $('#last_name_error').text('');
            $('#email_error').text('');
            $('#password_error').text('');
            $('#terms_conditions_error').text('');
            $.ajax({
                type: 'post',
                url: "{{ route('customer.register') }}",
                enctype: 'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',

                success: function (data) {
                    if (data.status == true) {
                        toastr.success(data.msg);
                        $('#registerForm').trigger('reset');
                        $('#registerModal').modal('hide');
                        $('#loginModal').modal('show');
                    } else {
                        toastr.error(data.msg);
                        $('#registerForm').trigger('reset');
                        $('#registerModal').modal('hide');
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

        $(document).on('click', '#sign_in', function (e) {
            e.preventDefault();
            var formData = new FormData($('#loginForm')[0]);
            $('#login_email_error').text('');
            $('#login_password_error').text('');
            $.ajax({
                type: 'post',
                url: "{{ route('check.customer.login') }}",
                enctype: 'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',

                success: function (data) {
                    if (data.status == true) {
                        toastr.success(data.msg);
                        $('#loginForm').trigger('reset');
                        $('#loginModal').modal('hide');
                        setTimeout(location.reload.bind(location), 3000);
                    } else {
                        toastr.error(data.msg);
                        $('#loginForm').trigger('reset');
                        $('#loginModal').modal('hide');
                    }

                },

                error: function (reject) {
                    console.log('Error: not added', reject);
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#login_" + key + "_error").text(val[0]);


                    });

                }

            });
        });


    });
</script>
<script type="text/javascript">
        @if(Session::has('message'))
    var type="{{Session::get('alert-type','info')}}"


    switch(type){
        case 'info':
            toastr.info("{{Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{Session::get('message') }}");
            break;
    }
    @endif
</script>
</body>

</html>
