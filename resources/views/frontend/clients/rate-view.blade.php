@extends('layouts.frontend')

@section('page_title')
    Welcome
@endsection

@section('css')
@endsection

@section('style')
<style type="text/css">
    .page-title{
        padding-top: 40px;
    }

    .fs-12{
        font-size: 12px !important;
        margin-bottom: 5px !important;
    }
    .nice-select.wide .list{
        max-height: 200px;
        overflow-y: scroll;
        padding: 20px 0;
    }

    .nice-select .option{
        line-height: 32px;
    }

    .input-icon{
        position: absolute;
        bottom: 15px;
        right: 5px;
    }
</style>
@endsection

@section('content')
    <!-- page-title -->
    <section class="page-title">
        <div class="bg-layer" style="background-image: url({{ asset('assets/frontend/images/background/page-title.jpg') }});"></div>
        <div class="pattern-layer" style="background-image: url({{ asset('assets/frontend/images/shape/shape-32.png') }});"></div>
        <div class="auto-container">
            <div class="content-box">
                @if(!empty($client))
                    <h4 class="text-white">Hello, {{ !empty($client) ? $client->name : '' }}</h4>
                @else
                    <h4 class="text-white">Invalid Client Details</h4>
                @endif
            </div>
        </div>
    </section>
    <!-- page-title end -->
    @if(!empty($client))
        <section class="contact-section sec-pad" style="z-index: 1; padding-bottom: 200px;">
            <div class="pattern-layer" style="background-image: url({{ asset('assets/frontend/images/shape/shape-49.png') }});"></div>
            <div class="auto-container">
                <div class="sec-title centred">
                    <span class="sub-title label-maturity-header">
                        @if(!empty($client) && $client->ip_frequency == 1)
                            Maturity Value
                        @else
                            Monthly Interest
                        @endif
                    </span>
                    <h2 class="mb-1 label-maturity">
                        @if(!empty($client) && $client->ip_frequency == 1)
                            {{ !empty($client) && !empty($rate) ? $rate['maturity'] : priceWithCurrency(0) }}
                        @else
                            {{ !empty($client) && !empty($rate) ? $rate['nett'] : priceWithCurrency(0) }}
                        @endif

                    </h2>
                    <h6 class="text-muted">Interest Rate <span class="label-rate">{{ !empty($client) && !empty($rate) ? $rate['rate'] : '0%' }}</span></h6>
                </div>
                <div class="tabs-box">
                    <div class="tabs-content">
                        <div class="tab active-tab">
                            <div class="form-inner">
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="row justify-content-center">
                                            <div class="col-sm-6 col-lg-3">
                                                <div class="form-group">
                                                    <label class="text-uppercase fs-12">Period*</label>
                                                    <div class="select-box">
                                                        <select class="wide" id="rate_id">
                                                            @foreach($periods as $p)
                                                                <option value="{{ $p->id }}" {{ !empty($client) && $client->rate_id == $p->id ? 'selected' : '' }}>{{ $p->period }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-3">
                                                <div class="form-group">
                                                    <label class="text-uppercase fs-12">Interest Payment Frequency</label>
                                                    <div class="select-box">
                                                        <select class="wide" id="ip_frequency">
                                                            <option value="1" {{ !empty($client) && $client->ip_frequency == 1 ? 'selected' : '' }}>Maturity</option>
                                                            <option value="2" {{ !empty($client) && $client->ip_frequency == 2 ? 'selected' : '' }}>Monthly</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-3">
                                                <div class="form-group">
                                                    <label class="text-uppercase fs-12">Deposit Amount*</label>
                                                    <input class="text-end" type="text" name="amount" id="amount" placeholder="Enter here" value="{{ !empty($client) ? $client->amount : 0 }}">
                                                </div>
                                            </div>
                                            {{--<div class="col-sm-6 col-lg-3">
                                                <div class="form-group">
                                                    <label class="text-uppercase fs-12">Interest Rate*</label>
                                                    <input class="text-end" type="text" name="rate" id="rate" placeholder="Enter here" value="{{ !empty($client) ? number_format($client->rate, 2) : 0 }}" style="padding-right: 35px;">
                                                    <div class="icon-box input-icon"><img src="{{ asset('assets/frontend/images/icons/icon-percentage.png') }}" alt=""></div>
                                                </div>
                                            </div>--}}

                                            <div class="col-sm-6 col-lg-3 d-flex align-items-end">
                                                <div class="form-group message-btn w-100">
                                                    <a href="javascript:void(0);" class="theme-btn text-uppercase w-100 calculate"><span class="calculate-btn-label">Calculate</span></a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="corporate-section sec-pad-2" style="padding-bottom: 200px;">
            <div class="auto-container">
                <div class="sec-title centred">
                    <span class="sub-title">Contact Me</span>
                    <h2>Something went wrong!</h2>
                </div>
                <div class="row clearfix justify-content-center">
                    <div class="col-lg-6 col-md-12 col-sm-12 corporate-block">
                        <div class="corporate-block-one">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <div class="icon"><img src="{{ asset('assets/frontend/images/icons/icon-227.png') }}" alt=""></div>
                                    <div class="overlay-icon"><img src="{{ asset('assets/frontend/images/icons/icon-228.png') }}" alt=""></div>
                                </div>
                                <h4>Contact Me</h4>
                                <p>For Instant solution.</p>
                                <h5><a href="tel:{{ myNumber()['link'] }}">{{ myNumber()['display'] }}</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


@endsection

@section('js')
@endsection

@section('script')
    <script>

        var $isSending = false;

        var $clientId = "{{ !empty($client) ? $client->id : '' }}";

        function formatAmountInput() {
            $el = '#amount';
            let value = $($el).val().replace(/,/g, '');
            if (!isNaN(value) && value.length > 0) {
                let formattedValue = parseFloat(value).toLocaleString('en-US');
                $($el).val(formattedValue);
            }
        }

        function getCalculation(){
            $rateId = $('#rate_id').val();
            $amount = $('#amount').val().trim().replace(/,/g, '');
            // $rate = $('#rate').val().trim().replace(/,/g, '');
            $ipFrequency = $('#ip_frequency').val();

            $isInvalid = 0;

            if(!typeUnd($amount) || $amount === ''){
                $isInvalid++;
                Swal.fire('Error!', 'Amount is required!', 'error');
            }
            /*if(!typeUnd($rate) || $rate === ''){
                $isInvalid++;
                Swal.fire('Error!', 'Rate is required!', 'error');
            }*/

            if($isInvalid === 0 && !$isSending){

                setTimeout(function() {
                    $.ajax({
                        url: "{{ route('frontend.getRate') }}",
                        type: 'POST',
                        data: {
                            client_id: $clientId,
                            rate_id: $rateId,
                            amount: $amount,
                            // rate: $rate,
                            ip_frequency: $ipFrequency,
                            _token: csrf_token()
                        },
                        dataType: 'json',
                        beforeSend: function ($jqXHR, $obj) {
                            $isSending = true;
                            $('.calculate').css({'opacity': '0.5', 'cursor': 'not-allowed'});
                            $('.calculate-btn-label').html('Calculating....');
                            $('.label-rate').html('<i class="fa-solid fa-spinner fa-spin-pulse"></i>');
                            $('.label-maturity').html('<i class="fa-solid fa-spinner fa-spin-pulse"></i>');
                        },
                        success: function ($response, $textStatus, $jqXHR) {
                            $isSending = false;
                            $('.calculate').css({'opacity': '1', 'cursor': 'pointer'});
                            $('.calculate-btn-label').html('Calculate');
                            $('.label-rate').html($response.rate);

                            if($ipFrequency == 1){
                                $('.label-maturity-header').html('Maturity Value');
                                $('.label-maturity').html($response.maturity);
                            }else{
                                $('.label-maturity-header').html('Monthly Interest');
                                $('.label-maturity').html($response.nett);
                            }

                        },
                        error: function ($jqXHR, $textStatus, $errorThrown) {
                            Swal.fire('Oops...', 'Something went wrong with the System!', 'error');
                        }
                    });

                }, 50);
            }
        }

        $(document).ready(function (){
            @if(!empty($client))
            setTimeout(function (){
                formatAmountInput();
            }, 400);
            @endif

            $('.calculate').on('click', function ($e){
                $e.preventDefault();
                getCalculation();
            });

            $('#amount').on('keyup change', function ($e){
                $e.preventDefault();
                formatAmountInput();
            });

            /*$('#rate').on('keyup change', function ($e){
                $e.preventDefault();
                formatAmountInput();
            });*/

            $('#amount').on('focus', function ($e){
                $e.preventDefault();
                var $this = $(this);
                setTimeout(function() {
                    $this.select();
                }, 50);
            });

            /*$('#rate').on('focus', function ($e){
                $e.preventDefault();
                var $this = $(this);
                setTimeout(function() {
                    $this.select();
                }, 50);
            });*/



        });
    </script>
@endsection
