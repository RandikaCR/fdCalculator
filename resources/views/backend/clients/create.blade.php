@extends('layouts.backend')

@php
    $pageTitle = 'Create a Client';
    $singlePageTitle = 'Create a Client';
    $routePrefix = 'clients';
    $pageUrl = 'clients';
@endphp

@section('page_title')
    {{ $pageTitle }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/packages/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/css/select2.min.css') }}">
@endsection

@section('css')

@endsection

@section('header_buttons')
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-end mb-3">
            <a href="{{ route('backend.clients.index') }}" class="btn btn-primary me-3">
                <span class="mdi mdi-plus-box me-2"></span>
                All Clients
            </a>
        </div>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ route('backend.clients.store') }}">
        @csrf
        <input type="hidden" name="id" value="{{ isset($client) ? $client->id : 0 }}">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible alert-label-icon rounded-label shadow fade show mb-xl-2" role="alert">
                            <i class="ri-error-warning-line label-icon"></i><strong>Required field: </strong>
                            {{$error}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Client Details <span class="fw-bold">{{ !empty($client) ? ' - '. $client->name : '' }}</span></h4>
                        <div class="flex-shrink-0">
                            <button type="submit" class="btn btn-secondary waves-effect waves-light"><i class="mdi mdi-content-save me-1"></i>SAVE</button>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div>
                                        <label for="name" class="form-label">Client Name*</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ !empty($client) ? $client->name : '' }}" placeholder="Enter here....">
                                    </div>
                                </div>


                                <div class="col-md-3 mb-4">
                                    <div>
                                        <label for="rate_id" class="form-label">Period</label>
                                        <select class="form-control js-example-basic-single get-ceiling-rate" name="rate_id" id="rate_id">
                                            @foreach($rates as $rate)
                                                <option value="{{ $rate->id }}" {{ !empty($client) && $client->rate_id == $rate->id ? 'selected' : '' }}>{{ $rate->period }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div>
                                        <label for="amount" class="form-label">FD Amount</label>
                                        <input type="text" class="form-control text-end decimal-only" id="amount" name="amount" value="{{ !empty($client) ? $client->amount : '' }}" placeholder="Enter here....">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Interest Payment Frequency</label>
                                    <div class="mt-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input get-ceiling-rate" type="radio" name="ip_frequency" id="ip_frequency_1" value="1" {{ !empty($client) && $client->ip_frequency == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="ip_frequency_1">Maturity</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input get-ceiling-rate" type="radio" name="ip_frequency" id="ip_frequency_2" value="2" {{ !empty($client) && $client->ip_frequency == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="ip_frequency_2">Monthly</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-4">
                                    <label class="form-label">Age Group</label>
                                    <div class="mt-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input get-ceiling-rate" type="radio" name="age_group" id="age_group_1" value="1" {{ !empty($client) && $client->age_group == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="age_group_1">Senior</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input get-ceiling-rate" type="radio" name="age_group" id="age_group_2" value="2" {{ !empty($client) && $client->age_group == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="age_group_2">Non Senior</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-4">
                                    <label class="form-label">TAX Status</label>
                                    <div class="mt-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input check-rate-on-change" type="radio" name="is_tax" id="is_tax_1" value="1" {{ !empty($client) && $client->is_tax == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_tax_1">Applicable</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input check-rate-on-change" type="radio" name="is_tax" id="is_tax_2" value="2" {{ !empty($client) && $client->is_tax == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_tax_2">Not Applicable</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-4">
                                    <div>
                                        <label for="rate" class="form-label">Rate</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control text-end decimal-only" id="rate" name="rate" value="{{ isset($client) ? $client->rate : '' }}" placeholder="Enter here..." data-max="0">
                                            <span class="input-group-text">%</span>
                                            <input type="hidden" id="max_rate" value="{{ $ceiling_rate }}">
                                        </div>
                                        <p class="fs-12 fw-medium text-info mt-2 mb-1 ip-rate-label">IP Rate: {{ number_format($ip_rate, 2) }}%</p>
                                        <p class="fs-12 fw-medium text-primary mb-1 aer-label">AER: {{ number_format($aer, 2) }}%</p>
                                        <p class="fs-12 fw-medium text-danger mb-1 ceiling-rate-label">Ceiling: {{ number_format($ceiling_rate, 2) }}%</p>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Summary</h4>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="btn btn-info waves-effect waves-light check-rate"><i class="mdi mdi-reload me-1"></i>Check</a>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row" id="summary-area">
                                <div class="col-md-12 mb-4">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr>
                                                <td class="fw-medium text-secondary">IP Frequency</td>
                                                <td class="text-end fw-medium text-secondary label-ip-frequency"></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-medium">Amount</td>
                                                <td class="text-end fw-bold label-amount"></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-medium">Rate</td>
                                                <td class="text-end fw-medium label-rate"></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-medium">Period</td>
                                                <td class="text-end fw-medium label-period"></td>
                                            </tr>
                                            <tr class="gross-area">
                                                <td class="fw-medium label-gross-interest"></td>
                                                <td class="text-end fw-medium label-gross"></td>
                                            </tr>
                                            <tr class="wht-area">
                                                <td class="fw-medium">WHT</td>
                                                <td class="text-end fw-medium label-wht"></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-medium label-nett-interest">Nett Interest</td>
                                                <td class="text-end fw-medium label-nett"></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-medium text-primary fs-14">Maturity Value</td>
                                                <td class="text-end text-primary fw-bold fs-14 label-maturity"></td>
                                            </tr>
                                            <tr class="tot-interest-area">
                                                <td class="fw-medium text-danger">Total Interest for the period</td>
                                                <td class="text-end fw-medium text-danger label-tot-interest"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center d-none" id="summary-loading-img">
                                <div class="col-sm-4">
                                    <img class="img-fluid" src="{{ asset('assets/common/images/ajax-loader.gif') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
        </div>
    </form>

@endsection


@section('scripts')
    <script src="{{ asset('assets/backend/packages/code.jquery.com/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/backend/packages/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/select2.init.js') }}"></script>
@endsection

@section('custom_scripts')
    <script>

        var $isCeilingSending = false;
        var $isSending = false;
        var $lastActivityTime = 0;
        var $timer = null;

        function lastActivityTimer(){

            if( typeUnd($timer) && $timer !== null ){
                clearInterval($timer);
                $lastActivityTime = 0;
            }

            $timer = setInterval(function(){
                $lastActivityTime++;
            }, 1000);

        }

        function getCalculation(){
            $rateId = $('#rate_id').val();
            $amount = $('#amount').val().trim();
            $rate = $('#rate').val().trim();
            $ipFrequency = $('input[name="ip_frequency"]:checked').val();
            $ageGroup = $('input[name="age_group"]:checked').val();
            $isTax = $('input[name="is_tax"]:checked').val();

            $isInvalid = 0;

            if(!typeUnd($amount) || $amount === ''){
                $isInvalid++;
                Swal.fire('Error!', 'Amount is required!', 'error');
            }
            else if(!typeUnd($ipFrequency)){
                $isInvalid++;
                Swal.fire('Error!', 'Interest Payment Frequency is required!', 'error');
            }
            else if(!typeUnd($ageGroup)){
                $isInvalid++;
                Swal.fire('Error!', 'Age Group is required!', 'error');
            }
            else if(!typeUnd($isTax)){
                $isInvalid++;
                Swal.fire('Error!', 'TAX status required!', 'error');
            }

            if($isInvalid === 0 && !$isSending){
                $('#summary-loading-img').removeClass('d-none');
                $('#summary-area').addClass('d-none');
                setTimeout(function() {
                    $.ajax({
                        url: "{{ route('backend.clients.rateCalculator') }}",
                        type: 'POST',
                        data: {
                            rate_id: $rateId,
                            rate: $rate,
                            amount: $amount,
                            ip_frequency: $ipFrequency,
                            age_group: $ageGroup,
                            is_tax: $isTax,
                            _token: csrf_token()
                        },
                        dataType: 'json',
                        beforeSend: function ($jqXHR, $obj) {
                            $isSending = true;
                            $('.label-ip-frequency').html('');
                            $('.label-gross-interest').html('');
                            $('.label-nett-interest').html('');

                            $('.tot-interest-area').hide();
                            $('.wht-area').hide();


                            $('.label-amount').html('');
                            $('.label-rate').html('');
                            $('.label-period').html('');
                            $('.label-gross').html('');
                            $('.label-wht').html('');
                            $('.label-nett').html('');
                            $('.label-maturity').html('');
                            $('.label-tot-interest').html('');
                        },
                        success: function ($response, $textStatus, $jqXHR) {
                            $isSending = false;
                            $('#summary-loading-img').addClass('d-none');
                            $('#summary-area').removeClass('d-none');

                            $('.label-ip-frequency').html($response.ip_frequency_label);
                            $('.label-gross-interest').html($response.gross_label);
                            $('.label-nett-interest').html($response.nett_label);

                            $('.gross-area').show();

                            if($response.is_tot_interest == 1){
                                $('.tot-interest-area').show();
                            }
                            if($response.is_wht == 1){
                                $('.wht-area').show();
                            }



                            $('.label-amount').html($response.amount);
                            $('.label-rate').html($response.rate);
                            $('.label-period').html($response.period);
                            $('.label-gross').html($response.gross);
                            $('.label-wht').html($response.wht);
                            $('.label-nett').html($response.nett);
                            $('.label-maturity').html($response.maturity);
                            $('.label-tot-interest').html($response.tot_interest);

                        },
                        error: function ($jqXHR, $textStatus, $errorThrown) {
                            Swal.fire('Oops...', 'Something went wrong with the System!', 'error');
                        }
                    });

                }, 50);
            }
        }

        function getCeilingRate(){
            $rateId = $('#rate_id').val();
            $ipFrequency = $('input[name="ip_frequency"]:checked').val();
            $ageGroup = $('input[name="age_group"]:checked').val();
            $('#rate').prop('disabled', true);

            if(typeUnd($ipFrequency) && typeUnd($ageGroup)){
                setTimeout(function() {
                    $.ajax({
                        url: "{{ route('backend.clients.getCeilingRate') }}",
                        type: 'POST',
                        data: {
                            rate_id: $rateId,
                            ip_frequency: $ipFrequency,
                            age_group: $ageGroup,
                            _token: csrf_token()
                        },
                        dataType: 'json',
                        beforeSend: function ($jqXHR, $obj) {
                            $isCeilingSending = true;
                            $('.ip-rate-label').html('<div class="spinner-border text-info" role="status" style="width: 14px; height: 14px;"><span class="sr-only">Loading...</span></div>');
                            $('.aer-label').html('<div class="spinner-border text-primary" role="status" style="width: 14px; height: 14px;"><span class="sr-only">Loading...</span></div>');
                            $('.ceiling-rate-label').html('<div class="spinner-border text-danger" role="status" style="width: 14px; height: 14px;"><span class="sr-only">Loading...</span></div>');

                        },
                        success: function ($response, $textStatus, $jqXHR) {
                            $isCeilingSending = false;
                            $('#rate').prop('disabled', false);
                            $('.ip-rate-label').html('IP Rate: ' + $response.ip_rate_label);
                            $('.aer-label').html('AER: ' + $response.aer_label);
                            $('.ceiling-rate-label').html('Ceiling: ' + $response.ceiling_rate_label);
                            $('#max_rate').val(getDecimalValue($response.ceiling_rate));

                            if (getDecimalValue($response.ip_rate) > 0){
                                $('#rate').val($response.ip_rate);
                            }

                            @if(!empty($client))
                            getCalculation();
                            @endif

                        },
                        error: function ($jqXHR, $textStatus, $errorThrown) {
                        }
                    });

                }, 50);
            }

        }

        $(document).ready(function (){

            $('.gross-area').hide();
            $('.wht-area').hide();
            $('.tot-interest-area').hide();

            @if(!empty($client))
            getCalculation();

            $('.check-rate-on-change').on('change', function ($e){
                getCalculation();
            });

            $('#amount').on('keyup change', function ($e){
                lastActivityTimer();

                setInterval(function(){
                    if ($timer !== null) {
                        if ($lastActivityTime >= 1) {
                            clearInterval($timer);
                            $lastActivityTime = 0;
                            $timer = null;
                            getCalculation();
                        }
                    }
                }, 1000);
            });

            @else

            $('#rate').prop('disabled', true);

            @endif

            $('.check-rate').on('click', function ($e){
                getCalculation();
            });

            $('.get-ceiling-rate').on('change', function ($e){
                getCeilingRate();
            });

            $('#rate').on('keyup change', function ($e){
                $e.preventDefault();
                $thisVal = getDecimalValue($(this).val());
                $maxVal = getDecimalValue($('#max_rate').val());
                $(this).css({'color': '#212529', 'border': '1px solid #ced4da'});

                if ($maxVal > 0){
                    if ($thisVal > $maxVal){
                        $(this).val($maxVal);
                        $(this).css({'color': '#f06548', 'border': '1px solid #f06548'});
                    }
                }

                lastActivityTimer();
                setInterval(function(){
                    if ($timer !== null) {
                        if ($lastActivityTime >= 1) {
                            clearInterval($timer);
                            $lastActivityTime = 0;
                            $timer = null;
                            getCalculation();
                        }
                    }
                }, 1000);

            });

        });
    </script>


@endsection
