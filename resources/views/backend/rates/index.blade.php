@extends('layouts.backend')

@php
    $pageTitle = 'Rates';
    $singlePageTitle = 'Rates';
    $routePrefix = 'rates';
    $pageUrl = 'rates';
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

@if(!empty($user_access))

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
                <form method="POST" action="{{ route('backend.rates.store') }}">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title">Rates & Ceiling Rates</h5>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary">SAVE</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @foreach($rates as $rate)
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <input type="hidden" name="id[]" value="{{ !empty($rate) ? $rate->id : '' }}">
                                            <div class="col-sm-2 mb-3">
                                                <div class="mb-4">
                                                    <label class="form-label">Period</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="period[]" value="{{ !empty($rate) ? $rate->period : '' }}" placeholder="Enter here...">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="form-label">Months*</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control decimal-only" name="months[]" value="{{ !empty($rate) ? $rate->months : '' }}" placeholder="Enter here...">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-10 mb-0">
                                                <div class="row">
                                                    <div class="col-sm-6 border border-1 mb-3 p-3">
                                                        <label class="mb-1 text-primary text-uppercase">SENIOR MATURITY - <span class="fw-bold text-danger">{{ !empty($rate) ? $rate->period : '' }}</span></label>
                                                        <div class="row border-top border-1 pt-1">
                                                            <div class="col-sm-4 mb-2">
                                                                <label class="form-label mb-1 fs-10">Interest Paid</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control text-end decimal-only" name="senior_maturity_ip[]" value="{{ !empty($rate) ? $rate->senior_maturity_ip : '' }}" placeholder="Enter here...">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 mb-2">
                                                                <label class="form-label mb-1 fs-10">AER</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control text-end decimal-only" name="senior_maturity_aer[]" value="{{ !empty($rate) ? $rate->senior_maturity_aer : '' }}" placeholder="Enter here...">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 mb-2">
                                                                <label class="form-label mb-1 fs-10">CBSL Ceiling Rate</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control text-end decimal-only" name="senior_maturity_cbsl_ceiling_rate[]" value="{{ !empty($rate) ? $rate->senior_maturity_cbsl_ceiling_rate : '' }}" placeholder="Enter here...">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 border border-1 mb-3 p-3">
                                                        <label class="mb-1 text-primary text-uppercase">SENIOR MONTHLY - <span class="fw-bold text-danger">{{ !empty($rate) ? $rate->period : '' }}</span></label>
                                                        <div class="row border-top border-1 pt-1">
                                                            <div class="col-sm-4 mb-2">
                                                                <label class="form-label mb-1 fs-10">Interest Paid</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control text-end decimal-only" name="senior_monthly_ip[]" value="{{ !empty($rate) ? $rate->senior_monthly_ip : '' }}" placeholder="Enter here...">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 mb-2">
                                                                <label class="form-label mb-1 fs-10">AER</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control text-end decimal-only" name="senior_monthly_aer[]" value="{{ !empty($rate) ? $rate->senior_monthly_aer : '' }}" placeholder="Enter here...">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 mb-2">
                                                                <label class="form-label mb-1 fs-10">CBSL Ceiling Rate</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control text-end decimal-only" name="senior_monthly_cbsl_ceiling_rate[]" value="{{ !empty($rate) ? $rate->senior_monthly_cbsl_ceiling_rate : '' }}" placeholder="Enter here...">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 border border-1 p-3">
                                                        <label class="mb-1 text-primary text-uppercase">NON SENIOR MATURITY - <span class="fw-bold text-danger">{{ !empty($rate) ? $rate->period : '' }}</span></label>
                                                        <div class="row border-top border-1 pt-1">
                                                            <div class="col-sm-4 mb-2">
                                                                <label class="form-label mb-1 fs-10">Interest Paid</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control text-end decimal-only" name="non_senior_maturity_ip[]" value="{{ !empty($rate) ? $rate->non_senior_maturity_ip : '' }}" placeholder="Enter here...">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 mb-2">
                                                                <label class="form-label mb-1 fs-10">AER</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control text-end decimal-only" name="non_senior_maturity_aer[]" value="{{ !empty($rate) ? $rate->non_senior_maturity_aer : '' }}" placeholder="Enter here...">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 mb-2">
                                                                <label class="form-label mb-1 fs-10">CBSL Ceiling Rate</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control text-end decimal-only" name="non_senior_maturity_cbsl_ceiling_rate[]" value="{{ !empty($rate) ? $rate->non_senior_maturity_cbsl_ceiling_rate : '' }}" placeholder="Enter here...">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 border border-1 p-3">
                                                        <label class="mb-1 text-primary text-uppercase">NON SENIOR MONTHLY - <span class="fw-bold text-danger">{{ !empty($rate) ? $rate->period : '' }}</span></label>
                                                        <div class="row border-top border-1 pt-1">
                                                            <div class="col-sm-4 mb-2">
                                                                <label class="form-label mb-1 fs-10">Interest Paid</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control text-end decimal-only" name="non_senior_monthly_ip[]" value="{{ !empty($rate) ? $rate->non_senior_monthly_ip : '' }}" placeholder="Enter here...">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 mb-2">
                                                                <label class="form-label mb-1 fs-10">AER</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control text-end decimal-only" name="non_senior_monthly_aer[]" value="{{ !empty($rate) ? $rate->non_senior_monthly_aer : '' }}" placeholder="Enter here...">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 mb-2">
                                                                <label class="form-label mb-1 fs-10">CBSL Ceiling Rate</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control text-end decimal-only" name="non_senior_monthly_cbsl_ceiling_rate[]" value="{{ !empty($rate) ? $rate->non_senior_monthly_cbsl_ceiling_rate : '' }}" placeholder="Enter here...">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </form>

            </div>
            <!-- end col -->
        </div>
    @endsection
@else
    @section('content')
        @include('partials.backend.no-access')
    @endsection
@endif




@section('scripts')
    <script src="{{ asset('assets/backend/packages/code.jquery.com/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/backend/packages/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/select2.init.js') }}"></script>
@endsection

@section('custom_scripts')
    <script>

        $(document).ready(function (){

        });
    </script>


@endsection
