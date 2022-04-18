@extends('layouts.admin')
@section('title')
    {{__('admin/dashboard.edit_user')}} | {{$user->name}}
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
                                        href="{{route('admin.dashboard')}}">{{__('admin/sidebar.main')}}  </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('index.users')}}"> {{__('admin/sidebar.users_dashboard')}}</a>

                                </li>
                                <li class="breadcrumb-item active"> {{__('admin/dashboard.edit_user')}} -
                                    {{$user->name}}</li>
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
                                                  action="{{route('update.user',$user->id)}}"
                                                  id="userForm" enctype="multipart/form-data">
                                                @csrf
                                                <h4 class="form-section"><i
                                                        class="ft-home"></i> {{__('admin/dashboard.edit_user')}} - {{$user->name}}
                                                </h4>
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label> {{__('admin/dashboard.image')}} </label>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" id="image" name="image">
                                                            <span class="file-custom"></span>
                                                        </label>
                                                        @error('image')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-body">

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">{{__('admin/dashboard.name')}} </label>
                                                                    <input type="text" id="name" class="form-control" placeholder="" name="name" value="{{$user->name}}">

                                                                    @error('name')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">{{__('admin/dashboard.email')}}</label>
                                                                    <input type="email" id="email" class="form-control" placeholder="" name="email" value="{{$user->email}}">

                                                                    @error('email')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>



                                                </div>

                                                <div class="form-actions">
                                                    <a href="{{route('index.users')}}" class="btn btn-warning mr-1" data-dismiss="modal">
                                                        <i class="la la-undo"></i> {{__('admin/dashboard.retreat')}}</a>
                                                    <button class="btn btn-primary" id="updateUser"><i class="la la-edit"></i>  {{__('admin/dashboard.update')}}</button>
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


