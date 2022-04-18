@extends('layouts.admin')
@section('title')
    {{__('admin/dashboard.image_product')}} - {{$product->name}}
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
                                        href="{{route('admin.dashboard')}}">{{__('admin/sidebar.main')}}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('index.product')}}"> {{__('admin/sidebar.products')}} </a>

                                </li>
                                <li class="breadcrumb-item active"> {{__('admin/dashboard.image_product')}} - {{$product->name}}
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
                                    <h4 class="card-title text-center">
                                        <strong>{{__('admin/dashboard.image_product')}} - {{$product->name}}
                                        </strong></h4>
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
                                              action="{{route('save.images.inDB')}}"
                                              id="addImagesForm" enctype="multipart/form-data">
                                            @csrf

                                            <div id="photo">
                                                <div class="form-body">

                                                    <h4 class="form-section"><i class="ft-home"></i> {{__('admin/dashboard.image_product')}} - {{$product->name}} </h4>
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <div class="form-group">
                                                        <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                                            <div class="dz-message"  style="position: absolute; top: 35%">{{__('admin/dashboard.can_upload_image')}} </div>
                                                        </div>
                                                        <br><br>
                                                    </div>
                                                    @error('images')
                                                    <span id="images_error" class="text-danger">{{$message}}</span>
                                                    @enderror


                                                </div>
                                            </div>


                                            <div class="form-actions">
                                                <a href="{{route('index.product')}}" type="button"
                                                   class="btn btn-warning mr-1"
                                                   data-dismiss="modal"><i
                                                        class="ft-x"></i> {{__('admin/dashboard.retreat')}}
                                                </a>
                                                <button type="submit" class="btn btn-primary"
                                                        id="updateCategory">  {{__('admin/dashboard.save')}}
                                                </button>
                                            </div>

                                        </form>


                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        @isset($product)
                            @foreach($product->images as $product_images)

                                <div class="col-md-4 mt-2 imageProduct">
                                    <div class="text-center">
                                        <img src="{{$product_images->getPhotoProduct($product_images->photo)}}" alt="photo" class="img-thumbnail height-150 width-300">

                                        @if(count($product->images) <= 1)

                                        @else
                                            <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$product_images->id}}" data-product-id="{{$product->id}}"
                                               data-original-title="Delete" class="danger box-shadow-3 mb-1 deleteProductImages"
                                               style="width: 80px; margin-top: 1em"><i class="la la-trash font-large-1 mt-1"></i></a>
                                        @endif

                                    </div>
                                </div>

                            @endforeach
                        @endisset
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
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
                        <h5>{{__('admin/dashboard.alert_delete_image')}}</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">{{ __('admin/dashboard.cancel')}}</button>
                        <button type="submit" class="btn btn-danger" id="delete">{{ __('admin/dashboard.delete')}}</button>
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

            //Delete
            $('body').on('click', '.deleteProductImages', function () {
                var image_id =  $(this).data('id');
                var Clickedthis = $(this);
                var id = $(Clickedthis).closest('.imageProduct').attr('data-id');
                $('#delete-modal').modal('show');

                $('#delete').click(function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: "{{route('delete.image')}}",
                        data: {
                            'image_id': image_id,
                        },

                        success: function (data) {
                            console.log('success:', data);
                            if (data.status == true) {
                                $('#delete-modal').modal('hide');
                                $(Clickedthis).closest('.imageProduct').remove();
                                if (data.image_count == 1){
                                    window.location.reload();
                                }
                                toastr.success(data.msg);
                            }

                        }

                    });
                });

                $('#cancel').click(function () {
                    $('#delete-modal').modal('hide');
                });
            });

        });

        var uploadedDocumentMap = {}

        Dropzone.options.dpzMultipleFiles = {
            paramName: "dzfile", // The name that will be used to transfer the file
            //autoProcessQueue: false,
            maxFilesize: 5, // MB
            clickable: true,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            dictFallbackMessage: " المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات ",
            dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
            dictCancelUpload: "{{ __('admin/dashboard.cancel_upload')}}",
            dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
            dictRemoveFile: " {{ __('admin/dashboard.delete')}}",
            dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من هضا ",
            headers: {
                'X-CSRF-TOKEN':
                    "{{ csrf_token() }}"
            }
            ,
            url: "{{ route('save.images.inFolder') }}", // Set the url
            success:
                function (file, response) {
                    $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
                    uploadedDocumentMap[file.name] = response.name
                }
            ,

            removedfile: function(file)
            {
                var name = file.upload.filename;

                $.ajax({
                    type: 'POST',
                    url: '{{ route('delete.image.fromFolder') }}',
                    data: {filename:name},

                    success: function(file, name)
                    {
                        console.log(name);
                       file.upload.filename=name;
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },

            // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
            init: function () {
                    @if(isset($event) && $event->images)
                var files;
                {!! json_encode($event->images) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    console.log(file)
                    $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
                }
                @endif
            }
        }
    </script>
@endsection


