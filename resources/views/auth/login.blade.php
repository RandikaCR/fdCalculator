@section('page_title')
    Sign In
    @endsection
    <!doctype html>
    <html lang="en" data-layout="vertical" data-topbar="dark" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
    <head>
        @include('partials.backend.head')
    </head>

    <body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="{{ url('/') }}" class="d-inline-block auth-logo">
                                    <img src="{{ asset('assets/common/images/logo.png') }}" alt="" height="60">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">FD Calculator Admin System</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to FD Calculator Admin System.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    @if($errors->any())
                                        <div class="row">
                                            <div class="col-sm-12">
                                                @foreach ($errors->all() as $error)
                                                    <div class="alert alert-danger">
                                                        {{$error}}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" name="password" id="password" class="form-control pe-5" placeholder="Enter password">
                                                <a class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted shadow-none pw-visibility" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></a>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" value="1" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-info w-100 app-login" type="submit">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        @include('partials.backend.footer')
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->
    <input type="hidden" id="routeSiteUrl" value="{{ url('') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function setMainSiteUrl($url){
            var $siteUrl = $('#routeSiteUrl').val();
            return $siteUrl +'/'+ $url;
        }
        const $siteMainUrlForAssets = setMainSiteUrl('');
    </script>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/backend/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/sweetalert2/sweetalert2.min.js') }}"></script>


    <!-- particles js -->
    <script src="{{ asset('assets/backend/libs/particles.js/particles.js') }}"></script>
    <!-- particles app js -->
    <script src="{{ asset('assets/backend/js/pages/particles.app.js') }}"></script>
    <!-- password-addon init -->
    <script src="{{ asset('assets/backend/js/pages/password-addon.init.js') }}"></script>

    <script src="{{ asset('assets/common/js/app.js') }}"></script>
    <script src="{{ asset('assets/common/js/common.js') }}"></script>

    <script>
        $(document).ready(function (){
            $('.pw-visibility').on('click', function ($e){
                if($('#password').attr('type') === 'password'){
                    $('#password').attr('type', 'text');
                }else{
                    $('#password').attr('type', 'password');
                }
            });
        });
    </script>

    </body>

    </html>
