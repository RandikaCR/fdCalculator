@extends('layouts.backend')

@php
    $pageTitle = 'Players';
    $singlePageTitle = 'Player';
    $routePrefix = 'players';
    $pageUrl = 'players';
@endphp

@section('page_title')
    {{ $pageTitle }}
@endsection

@section('styles')

@endsection

@section('css')

@endsection

@if(!empty($user_access))

    @section('header_buttons')
        <div class="row">
            <div class="col-sm-12 mb-3">
                <div class="d-sm-flex justify-content-end">
                    <a class="btn btn-info me-3 mb-2 add-attendance-btn" data-bs-toggle="modal" data-bs-target="#editFormModal">
                        <span class="d-flex align-items-center">
                            <span class="flex-grow-1">
                                Add Attendance
                            </span>
                        </span>
                    </a>
                    <a href="{{ route('backend.players.edit', $player->id) }}" class="btn btn-primary mb-2 me-3">
                        <span class="mdi mdi-pencil me-2"></span>
                        Edit
                    </a>
                    <a href="{{ route('backend.players.index') }}" class="btn btn-primary mb-2 me-3">
                        <span class="mdi mdi-plus-box me-2"></span>
                        All Players
                    </a>
                </div>
            </div>
        </div>
    @endsection

    @section('content')

        <div class="row">
            <div class="col-lg-3 col-12">
                <div class="card">
                    <div class="card-header align-items-center justify-content-between d-flex">
                        <div>
                            <h4 class="card-title mb-0 flex-grow-1">General Details</h4>
                        </div>
                        <div>
                            <span class="badge {{ $player->status_label }}">{{ $player->player_status }}</span>
                        </div>

                    </div><!-- end card header -->

                    <div class="card-body p-4 text-center">
                        <div class="mb-3 px-5">
                            <img src="{{ asset('assets/common/images/players/' . $player->image) }}" alt="{{ $player->first_name .' '.$player->last_name }}" class="img-fluid">
                        </div>
                        <h5 class="card-title mb-1">{{ $player->first_name .' '.$player->last_name }}</h5>
                        <p class="text-info fw-medium mb-3 fs-14">{{ generatePlayerID($player->registration_number) }}</p>
                        @if(!empty($player->is_foc))
                            <p class="text-muted mb-2"><span class="badge badge-gradient-danger fs-12">FOC Player</span></p>
                        @endif

                        @if(!empty($player->last_activity_at))
                            <p class="text-muted mb-2 fs-11">
                                Last activity <span class="text-dark">{{ dateTimeFullFormat($player->last_activity_at) }}</span>
                                @if(!empty($player->last_activity_venue_id))
                                    at <span class="text-dark">{{ $player->last_activity_venue }}</span>
                                @endif
                            </p>
                        @endif

                        <div class="row mt-3 py-2 border-bottom align-items-center">
                            <div class="col-sm-5 text-start">
                                <span class="text-muted">Role</span>
                            </div>
                            <div class="col-sm-7 text-start">
                                <span class="fw-medium mb-0">{{ $player->player_role }}</span>
                            </div>
                        </div>
                        <div class="row py-2 border-bottom align-items-center">
                            <div class="col-sm-5 text-start">
                                <span class="text-muted">Style</span>
                            </div>
                            <div class="col-sm-7 text-start">
                                <p class="fw-medium mb-1">{{ $player->batting_style }}</p>
                                <p class="fw-medium mb-0">{{ $player->bowling_style }}</p>
                            </div>
                        </div>
                        <div class="row py-2 border-bottom align-items-center">
                            <div class="col-sm-5 text-start">
                                <span class="text-muted">Level</span>
                            </div>
                            <div class="col-sm-7 text-start">
                                <span class="fw-medium mb-0">{{ $player->player_level }}</span>
                            </div>
                        </div>
                        <div class="row py-2 border-bottom align-items-center">
                            <div class="col-sm-5 text-start">
                                <span class="text-muted">Date of Birth</span>
                            </div>
                            <div class="col-sm-7 text-start">
                                <span class="fw-medium mb-0">{{ dateFormat($player->date_of_birth) }}</span>
                            </div>
                        </div>
                        <div class="row py-2 border-bottom align-items-center">
                            <div class="col-sm-5 text-start">
                                <span class="text-muted">School</span>
                            </div>
                            <div class="col-sm-7 text-start">
                                <span class="fw-medium mb-0">{{ $player->school }}</span>
                            </div>
                        </div>

                        <div class="row py-2 border-bottom align-items-center">
                            <div class="col-sm-5 text-start">
                                <span class="text-muted">Sizes</span>
                            </div>
                            <div class="col-sm-7 text-start">
                                <p class="fw-medium mb-1"><span class="text-muted">T-Shirt - </span>{{ $player->tshirt_size }}</p>
                                <p class="fw-medium mb-0"><span class="text-muted">Bottom - </span>{{ $player->bottom_size }}</p>
                            </div>
                        </div>


                        <div class="row py-2 border-bottom align-items-center">
                            <div class="col-sm-5 text-start">
                                <span class="text-muted">Contact</span>
                            </div>
                            <div class="col-sm-7 text-start">
                                <p class="text-muted mb-1"><a href="tel:{{ $player->contact_1 }}">{{ $player->contact_1 }}</a></p>
                                <p class="text-muted mb-0"><a href="tel:{{ $player->contact_2 }}">{{ $player->contact_2 }}</a></p>
                            </div>
                        </div>

                        <div class="row py-2 border-bottom align-items-center">
                            <div class="col-sm-5 text-start">
                                <span class="text-muted">Emergency</span>
                            </div>
                            <div class="col-sm-7 text-start">
                                <p class="text-muted mb-1">{{ $player->emergency_contact_1_name }}</p>
                                <p class="text-muted mb-0"><a href="tel:{{ $player->emergency_contact_1 }}">{{ $player->emergency_contact_1 }}</a></p>
                            </div>
                        </div>

                        @if(!empty($player->emergency_contact_2_name))
                            <div class="row py-2 border-bottom align-items-center">
                                <div class="col-sm-5 text-start">
                                    <span class="text-muted">Emergency 2</span>
                                </div>
                                <div class="col-sm-7 text-start">
                                    <p class="text-muted mb-1">{{ $player->emergency_contact_2_name }}</p>
                                    <p class="text-muted mb-0"><a href="tel:{{ $player->emergency_contact_2 }}">{{ $player->emergency_contact_2 }}</a></p>
                                </div>
                            </div>
                        @endif


                    </div>
                    <div class="card-footer">
                        <a class="btn btn-secondary d-grid btn-sm mb-2" href="{{ url('assets/common/images/qr/' . $player->qr_code) }}" download>DOWNLOAD QR</a>
                        @if(isOnlyAdmins())
                            <a class="btn btn-danger d-grid btn-sm re-generate-qr" href="javascript:void(0);">RE-GENERATE QR</a>
                        @endif
                    </div>
                </div><!-- end card -->
            </div>
            <div class="col-lg-9 col-12">
                <div class="card mb-1">
                    <div class="card-body">
                        <ul class="nav nav-pills animation-nav nav-justified" role="tablist" id="tab-list">
                            <li class="nav-item">
                                <a class="nav-link waves-effect waves-light active" data-bs-toggle="tab" data-tab="attendances" href="#tab-attendances" role="tab">Attendances</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link waves-effect waves-light" data-bs-toggle="tab" data-tab="payments" href="#tab-payments" role="tab">Payments</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content text-muted mb-5">
                    <div class="tab-pane active" id="tab-attendances" role="tabpanel">
                        <div class="card" id="attendances-table-area">
                            <div class="card-body">
                                <div class="card-header align-items-center justify-content-between d-md-flex">
                                    <div class="">
                                        <h4 class="card-title flex-grow-1 mb-2">Attendances</h4>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="mb-2 me-2">
                                            <input class="form-control form-control-sm keyword" type="text" placeholder="Enter keyword here..." autocomplete="off">
                                        </div>
                                        <div class="mb-2">
                                            <button class="btn btn-sm btn-primary btn-load search-btn">
                                                <span class="d-flex align-items-center">
                                                    <span class="spinner-border flex-shrink-0 me-2 search-btn-loading d-none" role="status"></span>
                                                    <span class="flex-grow-1 search-btn-text">
                                                        Search
                                                    </span>
                                                </span>
                                            </button>
                                            <button class="btn btn-sm btn-outline-dark waves-effect waves-light shadow-none search-clear-btn">
                                                <span class="d-flex align-items-center">
                                                    <span class="flex-grow-1">
                                                        Clear
                                                    </span>
                                                </span>
                                            </button>


                                        </div>

                                    </div>
                                </div>
                                <div class="live-preview table-area">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-nowrap align-middle mb-0">
                                            <thead>
                                            <tr>
                                                <th scope="col">
                                                    <div>
                                                        <p class="mb-0">Event</p>
                                                        <p class="mb-0 text-muted">Venue</p>
                                                    </div>
                                                </th>
                                                <th class="text-center" scope="col">
                                                    <div>
                                                        <p class="mb-0">Start Time</p>
                                                        <p class="mb-0 text-muted">End Time</p>
                                                    </div>
                                                </th>
                                                <th class="text-end" scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-body">

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-2 d-flex justify-content-end">
                                        <span class="text-muted"> Showing<span class="mx-1 records-showing-first-count">0</span>to<span class="mx-1 records-showing-last-count">0</span>of<span class="mx-1 records-total-count">0</span>records</span>
                                    </div>
                                    <div class="mt-3 pagination-area">

                                    </div>
                                </div>
                            </div><!-- end card-body -->
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-payments" role="tabpanel">
                        <div class="card" id="payments-table-area">
                            <div class="card-body">
                                <div class="card-header align-items-center justify-content-between d-md-flex">
                                    <div class="">
                                        <h4 class="card-title flex-grow-1 mb-2">Recent Payments</h4>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="mb-2 me-2">
                                            <input class="form-control form-control-sm keyword" type="text" placeholder="Enter keyword here..." autocomplete="off">
                                        </div>
                                        <div class="mb-2">
                                            <button class="btn btn-sm btn-primary btn-load search-btn">
                                            <span class="d-flex align-items-center">
                                                <span class="spinner-border flex-shrink-0 me-2 search-btn-loading d-none" role="status"></span>
                                                <span class="flex-grow-1 search-btn-text">
                                                    Search
                                                </span>
                                            </span>
                                            </button>
                                            <button class="btn btn-sm btn-outline-dark waves-effect waves-light shadow-none search-clear-btn">
                                            <span class="d-flex align-items-center">
                                                <span class="flex-grow-1">
                                                    Clear
                                                </span>
                                            </span>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                <div class="live-preview table-area">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-nowrap align-middle mb-0">
                                            <thead>
                                            <tr>
                                                <th scope="col">
                                                    <div>
                                                        <p class="mb-0">Invoice Number</p>
                                                    </div>
                                                </th>
                                                <th class="text-end" scope="col">
                                                    <div>
                                                        <p class="mb-0 fw-medium">Amount</p>
                                                    </div>
                                                </th>
                                                <th class="text-center" scope="col">
                                                    <div>
                                                        <p class="mb-0">Created By</p>
                                                        <p class="mb-0 text-muted">Created At</p>
                                                    </div>
                                                </th>
                                                <th class="text-center" scope="col">
                                                    <div>
                                                        <p class="mb-0">Status</p>
                                                    </div>
                                                </th>
                                                <th class="text-end" scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-body">

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-2 d-flex justify-content-end">
                                        <span class="text-muted"> Showing<span class="mx-1 records-showing-first-count">0</span>to<span class="mx-1 records-showing-last-count">0</span>of<span class="mx-1 records-total-count">0</span>records</span>
                                    </div>
                                    <div class="mt-3 pagination-area">

                                    </div>
                                </div>
                            </div><!-- end card-body -->
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <div id="review-loading-img">
                            <img src="{{ asset('assets/common/images/ajax-loader.gif') }}" alt="loading">

                            <div class="hstack gap-2 justify-content-center mt-5">
                                <a href="javascript:void(0);" class="btn btn-dark fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                            </div>
                        </div>

                        <div id="review-content-area">
                            <h4 class="mb-2" id="review-name"></h4>
                            <h5 class="mb-4" id="review-email"></h5>
                            <p class="text-muted mb-5" id="review-message"></p>
                            <input type="hidden" id="review-id" value="">
                            <div class="hstack gap-2 justify-content-center">
                                <a href="javascript:void(0);" class="btn btn-dark fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                <a href="javascript:void(0);" class="btn btn-success" id="review-approve">Approve</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editFormModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content" id="save-form-area">
                    <div class="modal-header">
                        <h5 class="modal-title"><span class="me-1" id="save-form-title">Add Attendance</span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0);">
                            <div class="row">
                                <div class="col-9 mb-3">
                                    <div>
                                        <label for="name-input" class="form-label">Search</label>
                                        <input type="text" class="form-control" id="name-input" placeholder="Enter here....">
                                    </div>
                                </div>
                                <div class="col-3 mb-3 d-flex justify-content-end align-items-end">
                                    <button type="button" class="btn btn-info w-100 search-events"><i class="mdi mdi-magnify"></i></button>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-nowrap align-middle mb-0">
                                            <thead>
                                            <tr>
                                                <th class="" scope="col">
                                                    <div>
                                                        <p class="mb-0">Event</p>
                                                        <p class="mb-0 text-muted">Venue</p>
                                                    </div>
                                                </th>
                                                <th class="text-end" scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-body" id="events-listing-area">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-12" id="form-alert-area">

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <input type="hidden" id="edit-id" value="0">
                        <a href="javascript:void(0);" class="btn btn-outline-dark waves-effect waves-light close-attendance-form me-2" data-bs-dismiss="modal"><i class="mdi mdi-restore me-1"></i>Close</a>
                    </div>
                </div>
            </div>
        </div>

    @endsection

@else
    @section('content')
        @include('partials.backend.no-access')
    @endsection
@endif


@section('scripts')
    <script src="{{ asset('assets/backend/packages/code.jquery.com/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection

@section('custom_scripts')
    <script>

        var $playerId = "{{ $player->id }}";
        var $currentTab = 'attendance';

        var $attendancesTableArea = $('#attendances-table-area');
        var $paymentsTableArea = $('#payments-table-area');

        function getAttendances($pageNo = 1){
            $keyword = $($attendancesTableArea).find('.keyword').val().trim();

            $.ajax({
                url: "{{ route('backend.players.getAttendancesViaAjax') }}",
                type: 'POST',
                data: {
                    player_id: $playerId,
                    keyword: $keyword,
                    page: $pageNo,
                    _token: csrf_token()
                },
                dataType: 'json',
                beforeSend: function ($jqXHR, $obj) {

                    $($attendancesTableArea).find('.search-btn').prop('disabled', true);
                    $($attendancesTableArea).find('.search-btn-loading').removeClass('d-none');
                    $($attendancesTableArea).find('.search-btn-text').text('Loading....');
                    $($attendancesTableArea).find('.pagination-area').html('');
                    $($attendancesTableArea).find('.table-body').html('');
                    $($attendancesTableArea).find('.table-body').html(ajaxLoader(6));
                    $($attendancesTableArea).find('.records-showing-first-count').text(0);
                    $($attendancesTableArea).find('.records-showing-last-count').text(0);
                    $($attendancesTableArea).find('.records-total-count').text(0);

                },
                success: function ($res, $textStatus, $jqXHR) {
                    $($attendancesTableArea).find('.table-body').html('');

                    $($attendancesTableArea).find('.search-btn').prop('disabled', false);
                    $($attendancesTableArea).find('.search-btn-loading').addClass('d-none');
                    $($attendancesTableArea).find('.search-btn-text').text('Search');
                    $($attendancesTableArea).find('.pagination-area').html($res.pagination);
                    $($attendancesTableArea).find('.table-body').html($res.body);
                    $($attendancesTableArea).find('.records-showing-first-count').text($res.showing_first_item);
                    $($attendancesTableArea).find('.records-showing-last-count').text($res.showing_last_item);
                    $($attendancesTableArea).find('.records-total-count').text($res.total_count);

                },
                error: function ($jqXHR, $textStatus, $errorThrown) {
                }
            });
        }

        function getPayments($pageNo = 1){
            $keyword = $($paymentsTableArea).find('.keyword').val().trim();

            $.ajax({
                url: "{{ route('backend.players.getPaymentsViaAjax') }}",
                type: 'POST',
                data: {
                    player_id: $playerId,
                    page: $pageNo,
                    _token: csrf_token()
                },
                dataType: 'json',
                beforeSend: function ($jqXHR, $obj) {

                    $($paymentsTableArea).find('.search-btn').prop('disabled', true);
                    $($paymentsTableArea).find('.search-btn-loading').removeClass('d-none');
                    $($paymentsTableArea).find('.search-btn-text').text('Loading....');
                    $($paymentsTableArea).find('.pagination-area').html('');
                    $($paymentsTableArea).find('.table-body').html('');
                    $($paymentsTableArea).find('.table-body').html(ajaxLoader(5));
                    $($paymentsTableArea).find('.records-showing-first-count').text(0);
                    $($paymentsTableArea).find('.records-showing-last-count').text(0);
                    $($paymentsTableArea).find('.records-total-count').text(0);

                },
                success: function ($res, $textStatus, $jqXHR) {
                    $($paymentsTableArea).find('.table-body').html('');

                    $($paymentsTableArea).find('.search-btn').prop('disabled', false);
                    $($paymentsTableArea).find('.search-btn-loading').addClass('d-none');
                    $($paymentsTableArea).find('.search-btn-text').text('Search');
                    $($paymentsTableArea).find('.pagination-area').html($res.pagination);
                    $($paymentsTableArea).find('.table-body').html($res.body);
                    $($paymentsTableArea).find('.records-showing-first-count').text($res.showing_first_item);
                    $($paymentsTableArea).find('.records-showing-last-count').text($res.showing_last_item);
                    $($paymentsTableArea).find('.records-total-count').text($res.total_count);

                },
                error: function ($jqXHR, $textStatus, $errorThrown) {
                }
            });
        }

        function event($item){

            $tr = $('<tr></tr>').attr('id', 'event-row-' + $item.id);

            $('<td></td>').append($('<div></div>')
                .append($('<p></p>').addClass('mb-0 fw-medium').text($item.event))
                .append($('<p></p>').addClass('mb-0 text-muted').text($item.venue))
                .append($('<p></p>').addClass('mb-0 fs-12 text-primary').text(formatDate($item.start_time)))
            ).appendTo($tr);

            $('<td></td>').addClass('text-end').append($('<div></div>').addClass('d-flex justify-content-end align-items-center')
                .append($('<div></div>')
                    .append($('<a></a>').addClass('btn btn-primary btn-sm waves-effect waves-light add-attendance').attr('href', 'javascript:void(0);').attr('data-id', $item.id).text('Add'))
                )
            ).appendTo($tr);

            return $tr;

        }


        $(document).ready(function (){

            getAttendances();

            $('.re-generate-qr').on('click', function ($e){

                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to re-generate a new QR Code!",
                    icon: "warning",
                    showCancelButton: !0,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes, Generate!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-info w-xs me-2 mt-2",
                    cancelButtonClass: "btn btn-danger w-xs mt-2",
                    buttonsStyling: !1,
                    showCloseButton: !0,
                }).then((result) => {
                    if (result.isConfirmed) {

                        setTimeout(function() {
                            $.ajax({
                                url: "{{ route('backend.players.reGenerateQRCode') }}",
                                type: 'POST',
                                data: {
                                    player_id: $playerId,
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
                                    Swal.fire('Done!', $response.message, 'success');
                                    setTimeout(function(){
                                        location.reload();
                                    }, 2000);
                                },
                                error: function ($jqXHR, $textStatus, $errorThrown) {
                                    Swal.fire('Oops...', 'Something went wrong with the System!', 'error');
                                }
                            });

                        }, 50);
                    }
                });

            });


            $('#tab-list').on('click', '.nav-link', function ($e){
                $e.preventDefault();

                $thisTab = $(this).data('tab');
                if($thisTab != $currentTab){
                    if($thisTab == 'attendances'){
                        getAttendances(1);
                    }else if($thisTab == 'payments'){
                        getPayments(1);
                    }
                }
                $currentTab = $thisTab;
            });


            /*START - ORDERS RELATED SCRIPTS*/
            $($attendancesTableArea).on('click', '.pagination a', function($e) {
                $e.preventDefault();
                var $url = $(this).attr('href');
                var $startIndex = $url.indexOf('page');
                if ($startIndex !== -1) {
                    $startOfValueIndex = $startIndex + 5;
                    $pageNo = $url.substring($startOfValueIndex).trim();
                    getOrders($pageNo);
                }
            });
            $($attendancesTableArea).on('keydown', '.keyword', function($e) {
                if ($e.which === 13) {
                    $e.preventDefault();
                    getOrders(1);
                }
            });
            $($attendancesTableArea).on('click', '.search-btn', function($e) {
                getOrders(1);
            });
            $($attendancesTableArea).on('click', '.search-clear-btn', function($e) {
                $($attendancesTableArea).find('.keyword').val('');
                getOrders(1);
            });
            /*END - ORDERS RELATED SCRIPTS*/


            $('.close-attendance-form').on('click', function (){
                $('#name-input').val('');
                $('#events-listing-area').html('');
            });


            $('.search-events').on('click', function ($e){
                $e.preventDefault();
                $this = $(this);
                $($this).prop('disabled', true);
                $('#events-listing-area').html('');

                $keyword = $('#name-input').val().trim();

                if($keyword != ''){
                    $.ajax({
                        url: "{{ route('backend.'.$routePrefix.'.getEvents') }}",
                        dataType: 'json',
                        data: {
                            keyword: $keyword,
                            _token: csrf_token()
                        },
                        method: 'POST',
                        beforeSend: function ($jqXHR, $obj) {
                            $($this).html('Loading...');
                            $('#events-listing-area').html(ajaxLoader(6));
                        },
                        success: function ($res, $textStatus, $jqXHR) {
                            $($this).html('Search');
                            $($this).prop('disabled', false);
                            $('#events-listing-area').html('');

                            if(Object.keys($res).length > 0){
                                $.each($res, function ($index, $item){
                                    $r = event($item);
                                    $('#events-listing-area').append($r);
                                });
                            }
                        },
                        error: function ($res, $textStatus, $errorThrown) {
                        }
                    });
                }else{
                    Swal.fire('Error!', 'Search field can not be empty!', 'error');
                    $($this).prop('disabled', false);
                }
            });


            $('#events-listing-area').on('click', '.add-attendance', function ($e){
                $e.preventDefault();
                $eventId = $(this).data('id');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to add this player as attended!",
                    icon: "warning",
                    showCancelButton: !0,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes, Add!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-info w-xs me-2 mt-2",
                    cancelButtonClass: "btn btn-danger w-xs mt-2",
                    buttonsStyling: !1,
                    showCloseButton: !0,
                }).then((result) => {
                    if (result.isConfirmed) {

                        setTimeout(function() {
                            $.ajax({
                                url: "{{ route('backend.events.setAttendance') }}",
                                type: 'POST',
                                data: {
                                    player_id: $playerId,
                                    event_id: $eventId,
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
                                    if($response.status == 'success'){
                                        getAttendances(1);
                                        Swal.fire('Done!', $response.message, 'success');
                                    }else{
                                        Swal.fire('Error!', $response.message, 'error');
                                    }
                                },
                                error: function ($jqXHR, $textStatus, $errorThrown) {
                                    Swal.fire('Oops...', 'Something went wrong with the System!', 'error');
                                }
                            });

                        }, 50);
                    }
                });

            });

            /*START - REVIEWS RELATED SCRIPTS*/
            $($paymentsTableArea).on('click', '.pagination a', function($e) {
                $e.preventDefault();
                var $url = $(this).attr('href');
                var $startIndex = $url.indexOf('page');
                if ($startIndex !== -1) {
                    $startOfValueIndex = $startIndex + 5;
                    $pageNo = $url.substring($startOfValueIndex).trim();
                    getReviews($pageNo);
                }
            });
            $($paymentsTableArea).on('keydown', '.keyword', function($e) {
                if ($e.which === 13) {
                    $e.preventDefault();
                    getReviews(1);
                }
            });
            $($paymentsTableArea).on('click', '.search-btn', function($e) {
                getReviews(1);
            });
            $($paymentsTableArea).on('click', '.search-clear-btn', function($e) {
                $($paymentsTableArea).find('.keyword').val('');
                getReviews(1);
            });

            $('.table').on('click', '.view-review', function (){
                $id = $(this).data('id');
                $rowId = '#review-row-' + $id;

                $('#review-loading-img').show();

                $('#review-content-area').hide();
                $('#review-name').html('');
                $('#review-email').html('');
                $('#review-message').html('');
                $('#review-id').val(0);

                $('#staticBackdrop').modal('show');


                $.ajax({
                    url: "{{--{{ route('backend.userReviews.view') }}--}}",
                    dataType: 'json',
                    data: {
                        "id": $id,
                        "_token": csrf_token()
                    },
                    method: 'POST',
                    beforeSend: function ($jqXHR, $obj) {

                    },
                    success: function ($res, $textStatus, $jqXHR) {
                        $('#review-loading-img').hide();

                        $('#review-content-area').show();
                        $('#review-name').html($res.review.name);
                        $('#review-email').html($res.review.email);
                        $('#review-message').html($res.review.message);
                        $('#review-id').val($res.review.id);
                    },
                    error: function ($jqXHR, $textStatus, $errorThrown) {

                    }
                });
            });
            /*END - REVIEWS RELATED SCRIPTS*/


        });
    </script>
@endsection
