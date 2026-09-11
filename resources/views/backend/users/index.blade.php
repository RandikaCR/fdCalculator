@extends('layouts.backend')

@php
    $pageTitle = 'Users';
    $singlePageTitle = 'User';
    $routePrefix = 'users';
    $pageUrl = 'users';
    $defaultPw = 'FDCUser@789';
@endphp

@section('page_title')
    {{ $pageTitle }}
@endsection

@section('styles')

@endsection

@section('css')

@endsection

@if(!empty($user_access))

    @section('header_buttons')
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-end mb-3">
                <a href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#editFormModal">
                    <span class="mdi mdi-plus-box me-2"></span>
                    Add New
                </a>
            </div>
        </div>
    @endsection

    @section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('backend.'.$routePrefix .'.index') }}">
                                    <div class="row">
                                        <div class="col-sm-7 mb-3">
                                            <label for="keyword" class="form-label">Search</label>
                                            <input class="form-control" id="keyword" name="keyword" type="text" placeholder="Enter here..." value="{{ $keyword }}">
                                        </div>
                                        <div class="col-sm-5 mb-3 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="mdi mdi-magnify me-2"></span>
                                                Search
                                            </button>
                                            <a href="{{ url('admin/' . $pageUrl) }}" class="btn btn-outline-dark waves-effect waves-light ms-2">
                                                <span class="mdi mdi-restore me-2"></span>
                                                Clear
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">All {{ $pageTitle }}</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row">
                                <div class="col-xl-612">
                                    <div class="table-responsive mt-4 mt-xl-0">
                                        <table class="table table-hover table-striped align-middle table-nowrap mb-0">
                                            <thead>
                                            <tr>
                                                {{--<th class="text-center" scope="col">
                                                    <p class="mb-0">ID</p>
                                                </th>--}}
                                                <th scope="col" style="width: 40%;">
                                                    <p class="mb-0">{{ $singlePageTitle }}</p>
                                                </th>
                                                <th class="text-center" scope="col">
                                                    <p class="mb-0">User Role</p>
                                                </th>
                                                <th class="text-center" scope="col">
                                                    <p class="mb-0">Email</p>
                                                </th>
                                                <th class="text-center" scope="col">
                                                    <p class="mb-0">Status</p>
                                                </th>
                                                <th class="text-end" scope="col">
                                                    <p class="mb-0">Actions</p>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($records as $row)
                                                <tr id="row-{{ $row->id }}">
                                                    {{--<td class="fw-medium text-center">
                                                        <p class="mb-0">{{ $row->id }}</p>
                                                    </td>--}}
                                                    <td>
                                                        <p class="mb-0">{{ $row->name }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0">{{ userRole($row->user_role_id) }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0">{{ $row->email }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0"><span class="badge {{ commonStatus($row->status)['class'] }}">{{ commonStatus($row->status)['text'] }}</span></p>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="d-flex justify-content-end align-items-center">
                                                            @if(Auth::user()->id != $row->id)
                                                                <div class="form-check form-switch form-switch-success form-switch-md">
                                                                    <input class="form-check-input status" data-id="{{ $row->id }}" type="checkbox" role="switch"  {{ ($row->status == 1) ? 'checked': '' }} >
                                                                </div>
                                                            @endif

                                                            <div>
                                                                <a href="javascript:void(0);" data-id="{{ $row->id }}" class="btn btn-primary btn-sm waves-effect waves-light edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="mdi mdi-pencil"></span></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                            <div class="mt-5">
                                {{--Paginaiton--}}
                                {!! $records->links('vendor.pagination.backend') !!}
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
        </div>

        <div class="modal fade" id="editFormModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content" id="save-form-area">
                    <div class="modal-header">
                        <h5 class="modal-title"><span class="me-1" id="save-form-title">Add New</span>{{ $singlePageTitle }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0);">
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <div>
                                        <label for="business-input" class="form-label">{{ $singlePageTitle }}*</label>
                                        <input type="text" class="form-control" id="name-input" placeholder="Enter here....">
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div>
                                        <label for="second-input" class="form-label">Email Address*</label>
                                        <input type="text" class="form-control" id="second-input" placeholder="Enter here....">
                                    </div>
                                </div>

                                <div class="col-sm-12 mb-3">
                                    <div>
                                        <label for="user-role-id" class="form-label">User Role*</label>
                                        <select class="form-control" id="user-role-id">
                                            <option value="2">Moderator</option>
                                            <option value="1">Admin</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 mb-3" id="password-area">
                                    <div>
                                        <label for="third-input" class="form-label">Password*</label>
                                        <input type="text" class="form-control" id="third-input" value="{{ $defaultPw }}" placeholder="Enter here....">
                                    </div>
                                </div>

                                <div class="col-sm-12" id="form-alert-area">

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <input type="hidden" id="edit-id" value="0">
                        <a href="javascript:void(0);" class="btn btn-outline-dark waves-effect waves-light close-this-form me-2" data-bs-dismiss="modal"><i class="mdi mdi-restore me-1"></i>Close</a>
                        <button type="button" class="btn btn-secondary waves-effect waves-light save-this-form"><i class="mdi mdi-content-save me-1"></i>SAVE</button>
                    </div>
                </div>
            </div>
        </div>

    @endsection

@else
    @section('content')
        @include('partials.backend.no-access')
    @endsection
@endif


@section('scripts')
    <script src="{{ asset('assets/backend/packages/code.jquery.com/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection

@section('custom_scripts')
    <script>


        $(document).ready(function (){

            $('.close-this-form').on('click', function (){

                $('#edit-id').val(0);
                $('#name-input').val('');
                $('#second-input').val('');
                $('#third-input').val('{{ $defaultPw }}');
                $('#user-role-id option[value=""]').prop('selected', true);

                $('#password-area').show();

                setEditFormModalHeaderTitle();

                $('#form-alert-area').html('');
            });

            $('.save-this-form').on('click', function (){
                $this = $(this);
                $($this).prop('disabled', true);

                $id = $('#edit-id').val();
                $name = $('#name-input').val();
                $secondInput = $('#second-input').val();
                $thirdInput = $('#third-input').val();
                $userRoleId = $('#user-role-id').val();

                if($name != '' && $secondInput != '' && $userRoleId != ''){
                    $.ajax({
                        url: "{{ route('backend.'.$routePrefix.'.store') }}",
                        dataType: 'json',
                        data: {
                            id: $id,
                            name: $name,
                            email: $secondInput,
                            password: $thirdInput,
                            user_role_id: $userRoleId,
                            _token: csrf_token()
                        },
                        method: 'POST',
                        beforeSend: function ($jqXHR, $obj) {
                            $('#form-alert-area').html('');
                            $('#form-alert-area').html(alertProcessing());
                        },
                        success: function ($res, $textStatus, $jqXHR) {
                            $('#edit-id').val(0);
                            $('#name-input').val('');
                            $('#second-input').val('');
                            $('#third-input').val('{{ $defaultPw }}');
                            $('#form-alert-area').html('');
                            $alert = alertSuccess($res.message_text, $res.message_title);
                            $('#form-alert-area').html($alert);
                            $($this).prop('disabled', false);

                            setTimeout(function (){
                                location.reload();
                            }, 1000);
                        },
                        error: function ($res, $textStatus, $errorThrown) {
                            $('#form-alert-area').html('');
                            if(Object.keys($res.responseJSON).length > 0 && Object.keys($res.responseJSON.errors).length > 0){
                                alertDangerMultiple($res.responseJSON.errors, '#form-alert-area');
                            }
                            $($this).prop('disabled', false);
                        }
                    });
                }else{
                    $('#form-alert-area').html('');
                    $alert = alertDanger('Name, User Role & Email address can not be empty!', 'Error');
                    $('#form-alert-area').html($alert);
                    $($this).prop('disabled', false);
                }

            });


            $('.table').on('click', '.edit', function (){
                $id = $(this).data('id');
                $url = "{{ route('backend.'.$routePrefix.'.get') }}";
                $('#password-area').hide();

                $('#user-role-id option[value=""]').prop('selected', true);

                $('#editFormModal').modal('show');

                $.ajax({
                    url: $url,
                    dataType: 'json',
                    data: {
                        id: $id,
                        _token: csrf_token()
                    },
                    method: 'POST',
                    beforeSend: function ($jqXHR, $obj) {
                        $('#form-alert-area').html('');
                        $('#form-alert-area').html(alertProcessing('Please Wait...', 'Getting Info'));

                        $('.save-this-form').prop('disabled', true);

                        $('#edit-id').val(0);
                        $('#name-input').val('');
                        $('#second-input').val('');
                    },
                    success: function ($res, $textStatus, $jqXHR) {
                        $('#edit-id').val($res.id);
                        $('#name-input').val($res.name);
                        $('#second-input').val($res.email);
                        $('#form-alert-area').html('');
                        $('.save-this-form').prop('disabled', false);

                        setEditFormModalHeaderTitle();

                        $('#user-role-id option[value="'+$res.user_role_id+'"]').prop('selected', true);

                    },
                    error: function ($jqXHR, $textStatus, $errorThrown) {

                    }
                });
            });

            $('.table').on('change', '.status', function (){
                $id = $(this).data('id');
                $url = "{{ route('backend.'.$routePrefix.'.status') }}";
                $rowId = '#row-' + $id;
                $.ajax({
                    url: $url,
                    dataType: 'json',
                    data: {
                        id: $id,
                        _token: csrf_token()
                    },
                    method: 'POST',
                    beforeSend: function ($jqXHR, $obj) {

                    },
                    success: function ($res, $textStatus, $jqXHR) {
                        $($rowId).find('.badge').removeClass('bg-success bg-warning').addClass($res.class);
                        $($rowId).find('.badge').html($res.text);
                    },
                    error: function ($jqXHR, $textStatus, $errorThrown) {

                    }
                });
            });
        });
    </script>


@endsection
