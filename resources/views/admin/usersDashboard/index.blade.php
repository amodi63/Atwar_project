@extends('layouts.admin')
@section('title')
    {{__('admin/sidebar.users_dashboard')}}
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> {{__('admin/sidebar.users_dashboard')}} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/sidebar.main')}} </a></li>
                                <li class="breadcrumb-item active">  {{__('admin/sidebar.users_dashboard')}}</li>
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
                                    <a class="btn btn-outline-success float-left" href="javascript:void(0)"
                                       id="addNewUser"><i class="la la-plus"></i>  {{__('admin/dashboard.add_a_new_user')}}</a>
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

                                <div class="card-content collapse show" id="viewCustomers">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table user-table">
                                            <thead>
                                            <tr>
                                                <th>{{__('admin/dashboard.name')}}</th>
                                                <th>{{__('admin/dashboard.email')}}</th>
                                                <th>{{__('admin/dashboard.process')}}</th>

                                            </tr>
                                            </thead>
                                            <tbody></tbody>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Begin Form Add Main Category -->

    <div class="modal fade modal-open" id="user-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-800">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i> {{__('admin/dashboard.add_a_new_user')}}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="userForm" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <div class="form-group">
                                        <label> {{__('admin/dashboard.image')}} </label>
                                        <label id="projectinput7" class="file center-block">
                                            <input type="file" id="image" name="image">
                                            <span class="file-custom"></span>
                                        </label>
                                        <span id="image_error" class="text-danger"></span>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> {{__('admin/dashboard.name')}} </label>
                                                <input type="text" id="name" class="form-control" placeholder=""
                                                       name="name" value="{{old('name')}}">
                                                <span id="name_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> {{__('admin/dashboard.email')}} </label>
                                                <input type="email" id="email" class="form-control" placeholder=""
                                                       name="email" value="{{old('email')}}">
                                                <span id="email_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> {{__('admin/dashboard.password')}} </label>
                                                <input type="password" id="password" class="form-control" placeholder=""
                                                       name="password" value="{{old('password')}}">
                                                <span id="password_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> {{__('admin/dashboard.confirm_password')}} </label>
                                                <input type="password" id="password_confirmation" class="form-control" placeholder=""
                                                       name="password_confirmation" value="{{old('password_confirmation')}}">
                                                <span id="password_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i> {{__('admin/dashboard.retreat')}}
                                    </button>
                                    <button class="btn btn-primary" id="addUser"><i class="la la-save"></i> {{__('admin/dashboard.save')}}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Form Add Main Category -->



    <!-- // Basic form layout section end -->



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
                        <h5>{{__('admin/dashboard.alert_delete_user')}}</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">{{__('admin/dashboard.cancel')}}</button>
                        <button type="submit" class="btn btn-danger" id="delete">{{__('admin/dashboard.delete')}}</button>
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

            //Show Table
            var userTable = $('.user-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.users")}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],

                @if(app()-> getLocale() == 'ar')
                language: {"url": "{{asset('assets/admin/js/dataTableArabic.json')}}"},
                @endif
            });


            //Show Form
            $('#addNewUser').click(function () {
                $('#userForm').trigger('reset');
                $('#user-modal').modal('show');

            });


            //Add Or Update
            $(document).on('click', '#addUser', function (e) {
                e.preventDefault();
                var formData = new FormData($('#userForm')[0]);
                $('#image_error').text('');
                $('#name_error').text('');
                $('#email_error').text('');
                $('#password_error').text('');
                $('#role_id_error').text('');
                $.ajax({
                    type: 'post',
                    url: "{{ route('save.user') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('#userForm').trigger('reset');
                            $('#user-modal').modal('hide');
                            userTable.draw();
                        } else {
                            toastr.error(data.msg);
                            $('#userForm').trigger('reset');
                            $('#user-modal').modal('hide');
                            userTable.draw();
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

            //Delete

            $('body').on('click', '.deleteUser', function () {
                var id = $(this).data('id');
                $('#delete-modal').modal('show');

                $('#delete').click(function (e) {
                    e.preventDefault();
                    $.ajax({

                        url: "{{route('delete.user')}}",
                        data: {id: id},

                        success: function (data) {
                            console.log('success:', data);
                            if (data.status == true) {
                                $('#delete-modal').modal('hide');
                                toastr.warning(data.msg);
                                userTable.draw();
                            } else {
                                $('#delete-modal').modal('hide');
                                toastr.error(data.msg);
                                userTable.draw();
                            }

                        }

                    });
                });

                $('#cancel').click(function () {
                    $('#delete-modal').modal('hide');
                });
            });

        });
    </script>
@endsection
