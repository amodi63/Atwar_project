@extends('layouts.admin')
@section('title')
    {{__('admin/dashboard.edit_partner')}} - {{$partner->name}}
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
                                    <a href="{{route('index.partner')}}">{{__('admin/sidebar.partners')}}</a>

                                </li>

                                <li class="breadcrumb-item">
                                  {{__('admin/dashboard.edit_partner')}} - {{$partner->name}}

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
                                              action="{{route('update.partner',$partner->id)}}"
                                              id="vendorForm" enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i> {{__('admin/dashboard.edit_partner')}} - {{$partner->name}}
                                            </h4>
                                            <input type="hidden" name="id" value="{{$partner->id}}">
                                            <input type="hidden" name="type" value="@if($partner -> parent_id == null) 1 @else 2 @endif">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label> {{__('admin/dashboard.image')}} </label>
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
                                                        <img src="{{$partner->getPhoto($partner->photo)}}" alt="photo"
                                                             class="height-150 width-300">
                                                    </div>


                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_name_arabic')}}</label>
                                                            <input type="text" name="name_ar" id="name_ar" value="{{$partner->getTranslation('name', 'ar')}}" class="form-control">
                                                        </div>
                                                        @error('name_ar')
                                                        <span id="name_ar_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_name_english')}}</label>
                                                            <input type="text" name="name_en" id="name_en" value="{{$partner->getTranslation('name', 'en')}}" class="form-control">
                                                        </div>
                                                        @error('name_en')
                                                        <span id="name_en_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row @if($partner -> parent_id == null) hidden @endif" id="partners_list">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{__('admin/dashboard.choose_a_partner')}}</label>
                                                            <select name="parent_id" id="parent_id" class="form-control ">
                                                                <optgroup label="{{__('admin/dashboard.please_choose_a_partner')}}">
                                                                    <option value="">{{__('admin/dashboard.please_choose_a_partner')}}</option>

                                                                @isset($our_partners)
                                                                        @foreach($our_partners as $main_partner)
                                                                            <option value="{{$main_partner->id}}"  @if($main_partner -> id == $partner->parent_id) selected @endif>{{$main_partner->name}}</option>
                                                                        @endforeach
                                                                    @endisset

                                                                </optgroup>
                                                            </select>
                                                            @error('parent_id')
                                                            <span id="parent_id_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.link')}}</label>
                                                            <input type="text" name="link" id="link" value="{{$partner->link}}" class="form-control">
                                                        </div>
                                                        @error('link')
                                                        <span id="link_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <div class="row @if($partner -> parent_id == null) hidden @endif">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_description_arabic')}}</label>
                                                            <textarea name="description_ar" id="description_ar" cols="15"
                                                                      rows="15" class="form-control">{{$partner->getTranslation('description', 'ar')}}</textarea>
                                                        </div>
                                                        @error('description_ar')
                                                        <span id="description_ar_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{__('admin/dashboard.label_description_english')}}</label>
                                                            <textarea name="description_en" id="description_en" cols="15"
                                                                      rows="15" class="form-control">{{$partner->getTranslation('description', 'en')}}</textarea>
                                                        </div>
                                                        @error('description_en')
                                                        <span id="description_en_error" class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>



                                            </div>

                                            <div class="form-actions">
                                                <a href="{{route('index.partner')}}" class="btn btn-warning mr-1"
                                                   data-dismiss="modal"><i
                                                        class="la la-undo"></i> {{__('admin/dashboard.retreat')}}
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


