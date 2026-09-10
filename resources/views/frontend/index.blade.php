@extends('layouts.frontend')

@section('page_title')
    Welcome
@endsection

@section('css')
@endsection

@section('style')

@endsection

@section('content')
    <!-- page-title -->
    <section class="page-title">
        <div class="bg-layer" style="background-image: url({{ asset('assets/frontend/images/background/page-title.jpg') }});"></div>
        <div class="pattern-layer" style="background-image: url({{ asset('assets/frontend/images/shape/shape-32.png') }});"></div>
        <div class="auto-container">
            <div class="content-box">
                <h1>Get in Touch</h1>
            </div>
        </div>
    </section>
    <!-- page-title end -->


    <!-- corporate-section -->
    <section class="corporate-section sec-pad-2">
        <div class="auto-container">
            <div class="sec-title centred">
                <span class="sub-title">Contact Me</span>
                <h2>For Realtime solutions</h2>
            </div>
            <div class="row clearfix justify-content-center">
                <div class="col-lg-6 col-md-12 col-sm-12 corporate-block">
                    <div class="corporate-block-one">
                        <div class="inner-box">
                            <div class="icon-box">
                                <div class="icon"><img src="{{ asset('assets/frontend/images/icons/icon-227.png') }}" alt=""></div>
                                <div class="overlay-icon"><img src="{{ asset('assets/frontend/images/icons/icon-228.png') }}" alt=""></div>
                            </div>
                            <h4>Dial Me</h4>
                            <p>For Instant Help and Friendly Service.</p>
                            <h5><a href="tel:{{ myNumber()['link'] }}">{{ myNumber()['display'] }}</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
@endsection

@section('script')
@endsection
