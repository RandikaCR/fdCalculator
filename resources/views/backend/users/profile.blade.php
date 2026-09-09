@extends('layouts.backend')

@section('page_title')
    Hello {{ Auth::user()->name }}
@endsection

@section('breadcrumb')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Hello {{ Auth::user()->name }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

@endsection

@section('header_buttons')

@endsection

@section('content')

    @if($errors->any())
        <div class="row">
            <div class="col-sm-12">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible alert-label-icon rounded-label shadow fade show mb-xl-0" role="alert">
                        <i class="ri-error-warning-line label-icon"></i><strong>Error! </strong>
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


    <div class="row mt-5">
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            <img src="{{ asset('assets/common/images/user.png') }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
                        </div>
                        <p class=" mb-2"></p>
                        <h5 class="fs-16 fw-bold mb-1">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i> Personal Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i> Privacy
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <div class="row">
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name*</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter your Name" value="{{ $user->name }}">
                                    </div>
                                </div>

                                <div class="col-sm-12" id="form-alert-area-personal">
                                </div>

                                <!--end col-->
                                <div class="col-lg-12 mt-4">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="{{ url('/admin/my-profile') }}" class="btn btn-outline-dark waves-effect waves-light me-2"><i class="mdi mdi-restore me-1"></i>Reset</a>
                                        <button type="button" class="btn btn-secondary waves-effect waves-light save-user-personal"><i class="mdi mdi-content-save me-1"></i>SAVE</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="pw-current" class="form-label">Current Password*</label>
                                        <input type="password" class="form-control" id="pw-current" placeholder="Enter here...">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="pw-new" class="form-label">New Password*</label>
                                        <input type="password" class="form-control" id="pw-new" placeholder="Enter here...">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="pw-new-confirm" class="form-label">Confirm New Password*</label>
                                        <input type="password" class="form-control" id="pw-new-confirm" placeholder="Enter here...">
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-2 mb-4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-info alert-dismissible alert-label-icon rounded-label shadow fade show mb-xl-0" role="alert">
                                                <i class="ri-error-warning-line label-icon"></i><strong>Alert! </strong>
                                                Changes will affect on your next login afterwards!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12" id="form-alert-area-security">
                                </div>

                                <!--end col-->
                                <div class="col-lg-12 mt-4">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="{{ url('/admin/my-profile') }}" class="btn btn-outline-dark waves-effect waves-light me-2"><i class="mdi mdi-restore me-1"></i>Reset</a>
                                        <button type="button" class="btn btn-secondary waves-effect waves-light save-user-security"><i class="mdi mdi-content-save me-1"></i>SAVE</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>

@endsection


@section('js')
@endsection

@section('custom_scripts')
    <script>

        $(document).ready(function(){

            $('.save-user-personal').on('click', function (){
                $this = $(this);
                $($this).prop('disabled', true);

                $name = $('#name').val();

                if($name != ''){
                    $.ajax({
                        url: "{{ route('backend.users.saveMyProfilePersonal') }}",
                        dataType: 'json',
                        data: {
                            name: $name,
                            mode: 'personal',
                            _token: csrf_token()
                        },
                        method: 'POST',
                        beforeSend: function ($jqXHR, $obj) {
                            $('#form-alert-area-personal').html('');
                            $('#form-alert-area-personal').html(alertProcessing());
                        },
                        success: function ($res, $textStatus, $jqXHR) {

                            if($res.status == 'success'){

                                $('#form-alert-area-personal').html('');
                                $alert = alertSuccess($res.message_text, $res.message_title);
                                $('#form-alert-area-personal').html($alert);
                                $($this).prop('disabled', false);

                                setTimeout(function (){
                                    location.reload();
                                }, 1000);


                            }else if($res.status == 'error'){
                                $('#form-alert-area-personal').html('');
                                $alert = alertDanger($res.message_text, $res.message_title);
                                $('#form-alert-area-personal').html($alert);
                                $($this).prop('disabled', false);

                            }


                        },
                        error: function ($jqXHR, $textStatus, $errorThrown) {

                        }
                    });
                }else{
                    $('#form-alert-area-personal').html('');
                    $alert = alertDanger('Name can not be empty!', 'Error');
                    $('#form-alert-area-personal').html($alert);
                    $($this).prop('disabled', false);
                }

            });


            $('.save-user-security').on('click', function (){
                $this = $(this);
                $($this).prop('disabled', true);

                $currentPassword = $('#pw-current').val();
                $newPassword = $('#pw-new').val();
                $newPasswordConfirm = $('#pw-new-confirm').val();

                if($currentPassword != '' && $newPassword != '' && $newPasswordConfirm != ''){
                    $.ajax({
                        url: "{{ route('backend.users.saveMyProfilePersonal') }}",
                        dataType: 'json',
                        data: {
                            current_password: $currentPassword,
                            password: $newPassword,
                            password_confirmation: $newPasswordConfirm,
                            mode: 'security',
                            _token: csrf_token()
                        },
                        headers: { 'Accept': 'application/json' },
                        method: 'POST',
                        beforeSend: function ($jqXHR, $obj) {
                            $('#form-alert-area-security').html('');
                            $('#form-alert-area-security').html(alertProcessing());
                        },
                        success: function ($res, $textStatus, $jqXHR) {

                            if($res.status == 'success'){

                                $('#pw-current').val('');
                                $('#pw-new').val('');
                                $('#pw-new-confirm').val('');

                                $('#form-alert-area-security').html('');
                                $alert = alertSuccess($res.message_text, $res.message_title);
                                $('#form-alert-area-security').html($alert);
                                $($this).prop('disabled', false);


                            }else if($res.status == 'error'){
                                $('#form-alert-area-security').html('');

                                if(Object.keys($res.errors).length > 0){
                                    alertDangerMultiple($res.errors, '#form-alert-area-security');
                                }else{
                                    $alert = alertDanger($res.message_text, $res.message_title);
                                    $('#form-alert-area').html($alert);
                                }
                                $($this).prop('disabled', false);

                            }


                        },
                        error: function ($res, $textStatus, $errorThrown) {
                            $('#form-alert-area-security').html('');
                            if(Object.keys($res.responseJSON).length > 0 && Object.keys($res.responseJSON.errors).length > 0){
                                alertDangerMultiple($res.responseJSON.errors, '#form-alert-area-security');
                            }
                            $($this).prop('disabled', false);
                        }
                    });
                }else{
                    $('#form-alert-area-security').html('');
                    $alert = alertDanger('Passwords can not be empty!', 'Error');
                    $('#form-alert-area-security').html($alert);
                    $($this).prop('disabled', false);
                }

            });


        });




    </script>
@endsection

