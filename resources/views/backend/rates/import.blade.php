@extends('layouts.backend')

@php
    $pageTitle = 'Import Rates';
    $singlePageTitle = 'Import Rates';
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
        <div class="row">

            <div class="col-sm-12 d-flex justify-content-end mb-3">
                @if(!$rates->isEmpty())
                    <a href="javascript:void(0);" class="btn btn-success me-3 process">
                        <span class="mdi mdi-content-save me-2"></span>
                        Process Imported Records
                    </a>
                    <a href="javascript:void(0);" class="btn btn-danger me-3 clear">
                        <span class="mdi mdi-delete me-2"></span>
                        Clear Imported Records
                    </a>
                @endif
                <a href="{{ url('assets/common/files/sample_rates_import_file.csv') }}" class="btn btn-info me-3" download>
                    <span class="mdi mdi-download me-2"></span>
                    Download Sample File
                </a>
                <a href="{{ route('backend.rates.index') }}" class="btn btn-primary me-3">
                    <span class="mdi mdi-plus-box me-2"></span>
                    Rates
                </a>
            </div>
        </div>
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

                @if(!$rates->isEmpty())

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Imported Rates</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Period</th>
                                                        <th class="text-center">Months</th>
                                                        <th class="text-center text-primary">Non Senior - Maturity - IP</th>
                                                        <th class="text-center text-primary">Non Senior - Maturity - AER</th>
                                                        <th class="text-center text-primary">Non Senior - Maturity - Ceiling</th>
                                                        <th class="text-center text-info">Non Senior - Monthly - IP</th>
                                                        <th class="text-center text-info">Non Senior - Monthly - AER</th>
                                                        <th class="text-center text-info">Non Senior - Monthly - Ceiling</th>
                                                        <th class="text-center text-primary">Senior - Maturity - IP</th>
                                                        <th class="text-center text-primary">Senior - Maturity - AER</th>
                                                        <th class="text-center text-primary">Senior - Maturity - Ceiling</th>
                                                        <th class="text-center text-info">Senior - Monthly - IP</th>
                                                        <th class="text-center text-info">Senior - Monthly - AER</th>
                                                        <th class="text-center text-info">Senior - Monthly - Ceiling</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($rates as $r)
                                                        <tr>
                                                            <td class="fw-bold">{{ $r->period }}</td>
                                                            <td class="text-center fw-medium">{{ $r->months }}</td>
                                                            <td class="text-end text-primary fw-medium">{{ rateWithPercentage($r->senior_maturity_ip) }}</td>
                                                            <td class="text-end text-primary fw-medium">{{ rateWithPercentage($r->senior_maturity_aer) }}</td>
                                                            <td class="text-end text-primary fw-medium">{{ rateWithPercentage($r->senior_maturity_cbsl_ceiling_rate) }}</td>
                                                            <td class="text-end text-info fw-medium">{{ rateWithPercentage($r->senior_monthly_ip) }}</td>
                                                            <td class="text-end text-info fw-medium">{{ rateWithPercentage($r->senior_monthly_aer) }}</td>
                                                            <td class="text-end text-info fw-medium">{{ rateWithPercentage($r->senior_monthly_cbsl_ceiling_rate) }}</td>
                                                            <td class="text-end text-primary fw-medium">{{ rateWithPercentage($r->non_senior_maturity_ip) }}</td>
                                                            <td class="text-end text-primary fw-medium">{{ rateWithPercentage($r->non_senior_maturity_aer) }}</td>
                                                            <td class="text-end text-primary fw-medium">{{ rateWithPercentage($r->non_senior_maturity_cbsl_ceiling_rate) }}</td>
                                                            <td class="text-end text-info fw-medium">{{ rateWithPercentage($r->non_senior_monthly_ip) }}</td>
                                                            <td class="text-end text-info fw-medium">{{ rateWithPercentage($r->non_senior_monthly_aer) }}</td>
                                                            <td class="text-end text-info fw-medium">{{ rateWithPercentage($r->non_senior_monthly_cbsl_ceiling_rate) }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @else

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('backend.'.$routePrefix .'.importStore') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-2 mb-3">
                                                <label for="file" class="form-label">Select CSV</label>
                                                <input class="form-control" id="file" name="file" type="file" placeholder="Select File..." accept=".csv">
                                            </div>
                                            <div class="col-sm-5 mb-3 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary">
                                                    <span class="mdi mdi-file-import me-2"></span>
                                                    Import
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif

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
            $('.clear').on('click', function ($e){
                $e.preventDefault();

                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to clear all the imported records!",
                    icon: "warning",
                    showCancelButton: !0,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes, Clear all!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-danger w-xs me-2 mt-2",
                    cancelButtonClass: "btn btn-secondary w-xs mt-2",
                    buttonsStyling: !1,
                    showCloseButton: !0,
                }).then((result) => {
                    if (result.isConfirmed) {

                        setTimeout(function() {
                            $.ajax({
                                url: "{{ route('backend.rates.ClearImportedRates') }}",
                                type: 'POST',
                                data: {
                                    _token: csrf_token()
                                },
                                dataType: 'json',
                                beforeSend: function ($jqXHR, $obj) {
                                    Swal.fire({
                                        title: "Processing...",
                                        text: "Please wait",
                                        imageUrl: "{{ asset('assets/common/images/ajax-loader.gif') }}",
                                        showConfirmButton: false,
                                        allowOutsideClick: false
                                    });
                                },
                                success: function ($response, $textStatus, $jqXHR) {
                                    Swal.fire('Done!', $response.message_text, 'success');
                                    setTimeout(function(){
                                        location.reload();
                                    },1000);
                                },
                                error: function ($jqXHR, $textStatus, $errorThrown) {
                                    Swal.fire('Oops...', 'Something went wrong with the System!', 'error');
                                }
                            });

                        }, 50);
                    }
                });


            });

            $('.process').on('click', function ($e){
                $e.preventDefault();

                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to Process and update all the imported records!",
                    icon: "warning",
                    showCancelButton: !0,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes, Update all!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-success w-xs me-2 mt-2",
                    cancelButtonClass: "btn btn-secondary w-xs mt-2",
                    buttonsStyling: !1,
                    showCloseButton: !0,
                }).then((result) => {
                    if (result.isConfirmed) {

                        setTimeout(function() {
                            $.ajax({
                                url: "{{ route('backend.rates.importProcess') }}",
                                type: 'POST',
                                data: {
                                    _token: csrf_token()
                                },
                                dataType: 'json',
                                beforeSend: function ($jqXHR, $obj) {
                                    Swal.fire({
                                        title: "Processing...",
                                        text: "Please wait",
                                        imageUrl: "{{ asset('assets/common/images/ajax-loader.gif') }}",
                                        showConfirmButton: false,
                                        allowOutsideClick: false
                                    });
                                },
                                success: function ($response, $textStatus, $jqXHR) {
                                    Swal.fire('Done!', $response.message_text, 'success');
                                    setTimeout(function(){
                                        location.reload();
                                    },1000);
                                },
                                error: function ($jqXHR, $textStatus, $errorThrown) {
                                    Swal.fire('Oops...', 'Something went wrong with the System!', 'error');
                                }
                            });

                        }, 50);
                    }
                });


            });
        });
    </script>


@endsection
