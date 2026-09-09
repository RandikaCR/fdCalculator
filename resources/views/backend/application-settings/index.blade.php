@extends('layouts.backend')

@php
    $pageTitle = 'Application Settings';
    $singlePageTitle = 'Application Settings';
    $routePrefix = 'applicationSettings';
    $pageUrl = 'application-settings';
@endphp

@section('page_title')
    {{ $pageTitle }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/packages/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/css/select2.min.css') }}">
@endsection

@section('css')
    <style type="text/css">
        .scrollspy-example-2 {
            height: 70vh;
        }
    </style>
@endsection


@section('header_buttons')

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-sm-12">
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="live-preview">
                <div class="row gy-4">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <nav id="navbar-application-settings" class="navbar navbar-light bg-light flex-column">
                                    <nav class="nav nav-pills flex-column p-3 w-100">

                                        <a class="nav-link active" href="#wht-rate"><i class="ri-pencil-ruler-2-line align-middle me-2 fs-16"></i> <span>Fees</span></a>
                                        {{--<a class="nav-link active" href="#as-general-settings"><i class="ri-pencil-ruler-2-line align-middle me-2 fs-16"></i> <span>General Settings</span></a>--}}
                                        {{--<a class="nav-link" href="#item-1"><i class="ri-dashboard-2-line align-middle me-2 fs-16"></i> <span>Dashboards</span></a>
                                        <nav class="nav nav-pills flex-column">
                                            <a class="nav-link" href="#item-1-1"><i class="ri-subtract-fill align-middle me-2 fs-15"></i> <span>Ecommerce</span></a>
                                            <a class="nav-link" href="#item-1-2"><i class="ri-subtract-fill align-middle me-2 fs-15"></i> <span>Analytics</span></a>
                                        </nav>
                                        <a class="nav-link active" href="#item-2"><i class="ri-pencil-ruler-2-line align-middle me-2 fs-16"></i> <span>Base UI</span></a>
                                        <a class="nav-link" href="#item-3"><i class="ri-apps-2-line align-middle me-2 fs-16"></i> <span>Apps</span></a>
                                        <nav class="nav nav-pills flex-column">
                                            <a class="nav-link" href="#item-3-1"><i class="ri-subtract-fill align-middle me-2 fs-15"></i> <span>Chat</span></a>
                                            <a class="nav-link" href="#item-3-2"><i class="ri-subtract-fill align-middle me-2 fs-15"></i> <span>Email</span></a>
                                        </nav>--}}
                                    </nav>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-9">
                        <div data-bs-spy="scroll" data-bs-target="#navbar-application-settings" data-bs-offset="0" class="scrollspy-example-2">
                            <div class="">

                                <div class="card" id="wht-rate">
                                    <form method="POST" action="{{ route('backend.applicationSettings.whtRate') }}">
                                        @csrf
                                        <div class="card-header">
                                            <h5 class="card-title">Default Rates</h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <div>
                                                        <label for="setup_fee" class="form-label">WHT Rate</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control text-end decimal-only" id="wht_rate" name="wht_rate" value="{{ isset($app) ? $app->wht_rate : '' }}" placeholder="Enter here...">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">SAVE</button>
                                        </div>
                                    </form>
                                </div>

                                {{--<div class="card" id="item-1-1">
                                    <div class="card-header">
                                        <h5 class="card-title">Item 1-1</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-primary">SAVE</button>
                                    </div>
                                </div>
                                <div class="card" id="item-1-2">
                                    <div class="card-header">
                                        <h5 class="card-title">Item 1-2</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-primary">SAVE</button>
                                    </div>
                                </div>


                                <div class="card" id="item-2">
                                    <div class="card-header">
                                        <h5 class="card-title">Item 2</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-primary">SAVE</button>
                                    </div>
                                </div>

                                <div class="card" id="item-3">
                                    <div class="card-header">
                                        <h5 class="card-title">Item 3</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-primary">SAVE</button>
                                    </div>
                                </div>

                                <div class="card" id="item-3-1">
                                    <div class="card-header">
                                        <h5 class="card-title">Item 3-1</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-primary">SAVE</button>
                                    </div>
                                </div>

                                <div class="card" id="item-3-2">
                                    <div class="card-header">
                                        <h5 class="card-title">Item 3-2</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat
                                            ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco
                                            cillum consectetur ut et aute consectetur labore. Fugiat laborum
                                            incididunt tempor eu consequat enim dolore proident. Qui laborum do
                                            non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua
                                            officia quis et incididunt voluptate non anim reprehenderit
                                            adipisicing dolore ut consequat deserunt mollit dolore. Aliquip
                                            nulla enim veniam non fugiat id cupidatat nulla elit cupidatat
                                            commodo velit ut eiusmod cupidatat elit dolore.</p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-primary">SAVE</button>
                                    </div>
                                </div>--}}

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>

        </div>
        <!-- end col -->
    </div>
@endsection




@section('scripts')
    <script src="{{ asset('assets/backend/packages/code.jquery.com/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/backend/packages/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/select2.init.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/prismjs/prism.js') }}"></script>
@endsection

@section('custom_scripts')
    <script>

        $(document).ready(function (){

        });
    </script>


@endsection
