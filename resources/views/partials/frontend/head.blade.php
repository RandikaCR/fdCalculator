<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>@yield('page_title') :: FD Calculator</title>
<meta name="description" content="">
<link rel="icon" href="{{ asset('assets/common/images/favicon.png') }}" type="image/png"/>

@yield('meta_info')

@php
    $setMetaTitle = !empty($metaTitle) ? $metaTitle : 'FD Calculator';
    $setMetaDescription = !empty($metaDescription) ? $metaDescription : "Assuring you a best service at all time";
    $setMetaImage = !empty($metaImage) ? $metaImage : asset('assets/common/images/meta-image.jpg');
@endphp

<meta property="title" content="{{ $setMetaTitle }}" />
<meta name="description" content="{{ $setMetaDescription }}">
<meta name="keywords" content="">
<meta name="author" content="Jeewantha Perera">

<meta property="og:title" content="{{ $setMetaTitle }}" />
<meta property="og:description" content="{{ $setMetaDescription }}" />
<meta property="og:image" content="{{ $setMetaImage }}" />
<meta property="og:url" content="fdcalculator.idealmart.lk" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="FD Calculator" />

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">

<!-- Stylesheets -->
<link href="{{ asset('assets/frontend/css/font-awesome-all.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/flaticon_flexibank.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/owl.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/jquery.fancybox.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/nice-select.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/elpath.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/color1.css') }}" id="jssDefault" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/odometer.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/responsive.css') }}" rel="stylesheet">


<link href="{{ asset('assets/backend/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@yield('css')

@yield('style')

