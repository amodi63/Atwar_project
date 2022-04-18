@extends('layouts.admin')
@section('title')
   - {{$service->title}} {{__('admin/dashboard.edit_service')}}
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
                                        href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{route('index.service')}}"> {{__('admin/sidebar.service')}} </a>

                                </li>

                                <li class="breadcrumb-item active">   - {{$service->title}} {{__('admin/dashboard.edit_service')}}</li>

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
                                              action="{{route('update.service',$service->id)}}"
                                              id="vendorForm" enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i> - {{$service->title}} {{__('admin/dashboard.edit_service')}}
                                            </h4>
                                            <input type="hidden" name="id" value="{{$service->id}}">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>  {{__('admin/dashboard.image')}} </label>
                                                            <label id="projectinput7" class="file center-block">
                                                                <input type="file" id="file" name="photo">
                                                                <span class="file-custom"></span>
                                                            </label>
                                                            @error('photo')
                                                            <span id="photo_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8">
                                                        <img src="{{$service->getPhoto($service->photo)}}" alt="photo"
                                                             class="height-150 width-300">
                                                    </div>


                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_title_arabic')}}</label>
                                                            <input type="text" name="title_ar" id="title_ar" value="{{$service->getTranslation('title', 'ar')}}" class="form-control">
                                                        </div>
                                                        @error('title_ar')
                                                        <span id="title_ar_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_title_english')}}</label>
                                                            <input type="text" name="title_en" id="title_en" value="{{$service->getTranslation('title', 'en')}}" class="form-control">
                                                        </div>
                                                        @error('title_en')
                                                        <span id="title_en_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_short_description_arabic')}}</label>
                                                            <textarea name="short_description_ar" id="short_description_ar" cols="15"
                                                                      rows="15" class="form-control">{{$service->getTranslation('short_description', 'ar')}}</textarea>
                                                        </div>
                                                        @error('short_description_ar')
                                                        <span id="short_description_ar" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_short_description_english')}}</label>
                                                            <textarea name="short_description_en" id="short_description_en" cols="15"
                                                                      rows="15" class="form-control">{{$service->getTranslation('short_description', 'en')}}</textarea>
                                                        </div>
                                                        @error('short_description_en')
                                                        <span id="short_description_en_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_description_arabic')}}</label>
                                                            <textarea name="description_ar" id="description_ar" cols="15"
                                                                      rows="15" class="ckeditor">{{$service->getTranslation('description', 'ar')}}</textarea>
                                                        </div>
                                                        @error('description_ar')
                                                        <span id="description_ar_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_description_english')}}</label>
                                                            <textarea name="description_en" id="description_en" cols="15"
                                                                      rows="15" class="ckeditor"> {{$service->getTranslation('description', 'en')}}</textarea>
                                                        </div>
                                                        @error('description_en')
                                                        <span id="description_en_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="form-actions">
                                                <a href="{{route('index.service')}}" class="btn btn-warning mr-1"
                                                   data-dismiss="modal"><i
                                                        class="la la-undo"></i>  {{__('admin/dashboard.retreat')}}
                                                </a>
                                                <button class="btn btn-primary" id="updateBlog"><i
                                                        class="la la-edit"></i> {{__('admin/dashboard.update')}}
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


