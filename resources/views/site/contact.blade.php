@extends('layouts.site')
@section('title')
    {{__('site/site.contact')}}
@endsection
@section('content')
    <section class="contact">
        <div  class="fs-46 colored add-thickness ml-15 mt-35 fw-bold text-uppercase">
            {{__('site/site.contact')}}
        </div>
        <div class="container">

            <div class="sub-heading-font   brand-name pl-28">
                {{__('site/site.contact_us_to_get_free_support')}}
            </div>
            <div  class="map pl-13">
                <iframe  width="100%" class="centrlize-item pt-30" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3921925.2203491856!2d34.20343459934126!3d31.216666058923987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1633049643043!5m2!1sen!2s" width="1309" height="389" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>



        <div class="contact-form">

            <div class="container">
                <div class="row pl-28">
                    <form id="contactForm">
                        @csrf
                        @auth('customer')
                            <input type="hidden" name="customer_id" value="{{auth('customer')->user()->id}}">
                        @endauth
                        <div class="col-lg-6">
                            <textarea placeholder=" {{__('site/site.description')}}" name="description" id="w3review" rows="12" cols="50"></textarea>
                            <span id="description_error" class="text-danger"></span>
                        </div>
                        <div class="col-lg-6">
                            <input placeholder="{{__('site/site.subject')}}" name="subject" type="text">
                            <span id="subject_error" class="text-danger"></span>
                            <input placeholder="{{__('site/site.name')}}" name="name" type="text">
                            <span id="name_error" class="text-danger"></span>
                            <input placeholder="{{__('site/site.email')}}" name="email1" type="text">
                            <span id="email1_error" class="text-danger"></span>
                            <button type="submit" id="send">{{__('site/site.send')}} <img src="{{asset('assets/front/images/contact/send.png')}}" alt=""></button>
                        </div>
                    </form>
                </div>
            </div>

            <div  class="container">
                <div class="contents text-center " >
                    @isset($contacts_informations)
                        @foreach($contacts_informations as  $contact)
                            <div> <img src="{{asset('assets/front/images/contact/email-icon.png')}}" alt="">    <br> <span> {{__('site/site.email')}} </span> <br> <span class="span2"> {{$contact->email}} </span></div>
                            <div> <img src="{{asset('assets/front/images/contact/phone-icon.png')}}" alt="">    <br> <span> {{__('site/site.phone')}} </span> <br> <span class="span2"> {{$contact->phone}}</span></div>
                            <div> <img src="{{asset('assets/front/images/contact/location-icon.png')}}" alt=""> <br> <span> {{__('site/site.location')}} </span> <br><span class="span2" >{{$contact->address}}</span></div>
                        @endforeach

                    @endisset

                </div>
            </div>

        </div>

    </section>




@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            //Add Or Update

            $(document).on('click', '#send', function (e) {
                e.preventDefault();
                @guest('customer')
                toastr.warning('انت غير مسجل دخول في النظام')
                    @endguest
                var formData = new FormData($('#contactForm')[0]);
                $('#description_error').text('');
                $('#subject_error').text('');
                $('#name_error').text('');
                $('#email_error').text('');
                $.ajax({
                    type: 'post',
                    url: "{{ route('sendContactUs') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            setTimeout(location.reload.bind(location), 3000);
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
