@extends('layouts.admin')
@section('title')
    {{__('admin/dashboard.edit_company')}} -{{$model->name}}
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
                                    <a href="{{route('index.model')}}"> {{__('admin/sidebar.models')}}</a>

                                </li>
                                <li class="breadcrumb-item active">{{__('admin/dashboard.edit_company')}} -
                                    {{$model->name}}</li>
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
                                                  action="{{route('update.model',$model->id)}}"
                                                  id="categoryForm" enctype="multipart/form-data">
                                                @csrf
                                                <h4 class="form-section"><i
                                                        class="ft-home"></i>{{__('admin/dashboard.edit_company')}} -  {{$model->name}}
                                                </h4>
                                                <input type="hidden" name="id" value="{{$model->id}}">

                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">{{__('admin/dashboard.label_name_arabic')}}</label>
                                                                <input type="text" id="name_ar" class="form-control"
                                                                       name="name_ar" value="{{$model->getTranslation('name', 'ar')}}">
                                                                @error('name_ar')
                                                                <span id="name_ar_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">{{__('admin/dashboard.label_name_english')}}</label>
                                                                <input type="text" id="name_en" class="form-control"
                                                                       name="name_en" value="{{$model->getTranslation('name', 'en')}}">
                                                                @error('name_en')
                                                                <span id="name_en_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-actions">
                                                    <a href="{{route('index.model')}}" type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                                                        <i class="la la-undo"></i>  {{__('admin/dashboard.retreat')}}</a>

                                                    <button class="btn btn-primary" id="updateModel"> <i class="la la-edit"></i> {{__('admin/dashboard.update')}}</button>
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


