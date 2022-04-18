@extends('layouts.admin')
@section('title')
    {{__('admin/dashboard.add_a_new_product')}}
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
                                <li class="breadcrumb-item active"> {{__('admin/dashboard.add_a_new_product')}}
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
                                              action="{{route('save.product')}}"
                                              id="vendorForm" enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i> {{__('admin/dashboard.add_a_new_product')}}
                                            </h4>
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_name_arabic')}}</label>
                                                            <input type="text" name="name_ar" id="name_ar" value="{{old('name_ar')}}" class="form-control">
                                                            @error('name_ar')
                                                            <span id="name_ar_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>


                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_name_english')}}</label>
                                                            <input type="text" name="name_en" id="name_en" value="{{old('name_en')}}" class="form-control">
                                                            @error('name_en')
                                                            <span id="name_en_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.price')}}</label>
                                                            <input type="number" step="any" name="price" id="price" value="{{old('price')}}" class="form-control">
                                                            @error('price')
                                                            <span id="price_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>


                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.category')}}</label>
                                                            <select name="category_id" id="category_id" class="form-control">
                                                                <optgroup label="{{__('admin/dashboard.category')}}">
                                                                    @isset($categories)
                                                                        @foreach($categories as $category)
                                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                                        @endforeach
                                                                    @endisset

                                                                </optgroup>
                                                            </select>
                                                            @error('category_id')
                                                            <span id="category_id_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

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
                                                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                                                        @endforeach
                                                                    @endisset
                                                                </optgroup>
                                                            </select>
                                                            @error('company_id')
                                                            <span id="company_id_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.model')}}</label>
                                                            <select name="model_id" id="model_id" class="form-control">
                                                                <optgroup label="{{__('admin/dashboard.model')}}">
                                                                    @isset($models)
                                                                        @foreach($models as $model)
                                                                            <option value="{{$model->id}}">{{$model->name}}</option>
                                                                        @endforeach
                                                                    @endisset
                                                                </optgroup>
                                                            </select>
                                                            @error('model_id')
                                                            <span id="model_id_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.sku')}}</label>
                                                            <input type="text" name="sku" id="sku" value="{{old('sku')}}" class="form-control">
                                                            @error('sku')
                                                            <span id="sku_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.in_stock')}}</label>
                                                            <select name="in_stock" id="in_stock" class="form-control">
                                                                <optgroup label="{{__('admin/dashboard.please_select_a_product_status')}}">
                                                                    <option value="">{{__('admin/dashboard.please_select_a_product_status')}}</option>
                                                                    <option value="1">{{__('admin/dashboard.available')}}</option>
                                                                    <option value="0">{{__('admin/dashboard.unavailable')}}</option>
                                                                </optgroup>
                                                            </select>
                                                            @error('in_stock')
                                                            <span id="in_stock_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6" style="display:none"  id="qtyDiv">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.quantity')}}</label>
                                                            <input type="number" name="quantity" id="quantity" value="{{old('quantity')}}" class="form-control">
                                                            @error('quantity')
                                                            <span id="quantity_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_description_arabic')}}</label>
                                                            <textarea name="description_ar" id="description_ar" cols="15"
                                                                      rows="15" class="ckeditor">{{old('description_ar')}}</textarea>
                                                            @error('description_ar')
                                                            <span id="description_ar_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_description_english')}}</label>
                                                            <textarea name="description_en" id="description_en" cols="15"
                                                                      rows="15" class="ckeditor"> {{old('description_en')}}</textarea>
                                                            @error('description_en')
                                                            <span id="description_en_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="photo">
                                                            <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                                                <div class="dz-message" style="position: absolute; top: 17%">{{__('admin/dashboard.can_upload_image')}} </div>
                                                            </div>
                                                            <br>
                                                                @error('images')
                                                                <span id="images_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="form-actions">
                                                <a href="{{route('index.product')}}" class="btn btn-warning mr-1"
                                                   data-dismiss="modal"><i
                                                        class="la la-undo"></i> {{__('admin/dashboard.retreat')}}
                                                </a>
                                                <button class="btn btn-primary" id="addProduct"><i
                                                        class="la la-edit"></i> {{__('admin/dashboard.save')}}
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


