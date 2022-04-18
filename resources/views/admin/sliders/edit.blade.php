@extends('layouts.admin')
@section('title')
    {{ __('admin/dashboard.edit_slider')}}
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
                                    <a href="{{route('index.sliders')}}"> {{ __('admin/sidebar.slider')}}</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ __('admin/dashboard.edit_slider')}} </li>
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
                                        <strong>  {{ __('admin/dashboard.edit_slider')}}</strong></h4>
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


                                <!-- Begin Form Edit Brand -->
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        <form class="form" id="editSliderForm" method="post" action="{{route('update.slider', $slider->id)}}" enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="id" value="{{$slider->id}}">
                                            <div class="form-group">
                                                <div class="text-center">

                                                    <img src="{{$slider->getPhoto($slider->photo)}}" alt="photo"
                                                         class="height-150">


                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="photo1">
                                                            <div class="form-body">

                                                                <div class="form-group">
                                                                    <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                                                        <div class="dz-message">{{ __('admin/dashboard.can_upload_image')}}</div>
                                                                    </div>
                                                                    <br><br>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        @error('photo')
                                                        <span id="photo_error" class="text-danger">{{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                </div>


                                            <div class="form-actions mt-5">
                                                <input type="hidden" name="action" id="action" value="Update">
                                                <a href="{{route('index.sliders')}}" type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                                                    <i
                                                        class="ft-x"></i> {{ __('admin/dashboard.retreat')}}
                                                </a>
                                                <button class="btn btn-primary" id="updateSlider"><i
                                                        class="la la-check-square-o"></i> {{ __('admin/dashboard.update')}}</button>
                                            </div>

                                        </form>


                                    </div>
                                </div>
                                <!-- End Form Edit Brand -->
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
            dictCancelUpload: "الغاء الرفع ",
            dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
            dictRemoveFile: "{{__('admin/dashboard.delete')}}",
            dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من هضا ",
            headers: {
                'X-CSRF-TOKEN':
                    "{{ csrf_token() }}"
            }
            ,
            url: "{{route('save.images.slider.inFolder')}}", // Set the url
            success:
                function (file, response) {
                    $('form').append('<input type="hidden" name="images[]" id="photo" value="' + response.name + '">')
                    uploadedDocumentMap[file.name] = response.name
                }
            ,

            removedfile: function(file)
            {
                var name = file.upload.filename;

                $.ajax({
                    type: 'POST',
                    url: '{{route('delete.slider.image')}}',
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
                    $('form').append('<input type="hidden" name="images[]" id="photo" value="' + file.file_name + '">')
                }
                @endif
            }
        }
    </script>
@endsection



