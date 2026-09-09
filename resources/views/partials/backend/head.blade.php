<meta charset="utf-8" />
<title>@yield('page_title') :: JP Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="title" content="ONCAS Cricket Academy Official Website." />
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="www.oncas.lk">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- App favicon -->
<link rel="icon" href="{{ asset('assets/common/images/favicon.png') }}" type="image/png"/>

@yield('styles')

<!-- Sweet Alert css-->
<link href="{{ asset('assets/backend/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{ asset('assets/backend/libs/jquery-toast-plugin-master/src/jquery.toast.css') }}">



<!-- Layout config Js -->
<script src="{{ asset('assets/backend/js/layout.js') }}"></script>
<!-- Bootstrap Css -->
<link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ asset('assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset('assets/backend/css/app.min.css') }}" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{ asset('assets/backend/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

@yield('css')
