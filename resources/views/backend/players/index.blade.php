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
            <div class="col-sm-12 d-flex justify-content-end mb-3">
                <a href="{{ route('backend.players.create') }}" class="btn btn-primary me-3">
                    <span class="mdi mdi-plus-box me-2"></span>
                    Add New
                </a>
            </div>
        </div>
    @endsection

    @section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('backend.'.$routePrefix .'.index') }}">
                                    <div class="row">
                                        <div class="col-sm-7 mb-3">
                                            <label for="keyword" class="form-label">Search</label>
                                            <input class="form-control" id="keyword" name="keyword" type="text" placeholder="Enter here..." value="{{ $keyword }}">
                                        </div>
                                        <div class="col-sm-5 mb-3 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="mdi mdi-magnify me-2"></span>
                                                Search
                                            </button>
                                            <a href="{{ url('admin/' . $pageUrl) }}" class="btn btn-outline-dark waves-effect waves-light ms-2">
                                                <span class="mdi mdi-restore me-2"></span>
                                                Clear
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">All {{ $pageTitle }}</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row">
                                <div class="col-xl-612">
                                    <div class="table-responsive mt-4 mt-xl-0">
                                        <table class="table table-hover table-striped align-middle table-nowrap mb-0">
                                            <thead>
                                            <tr>
                                                <th scope="col">
                                                    <p class="mb-0">{{ $singlePageTitle }}</p>
                                                    <p class="mb-0 text-muted">Reg #</p>
                                                </th>
                                                <th class="text-center" scope="col">
                                                    <p class="mb-0">School</p>
                                                    <p class="mb-0 text-muted">Level</p>
                                                </th>
                                                <th class="text-center" scope="col">
                                                    <p class="mb-0">Batting Style</p>
                                                    <p class="mb-0 text-muted">Bowling Style</p>
                                                </th>
                                                <th class="text-center" scope="col">
                                                    <p class="mb-0">Role</p>
                                                    <p class="mb-0 text-muted">Team</p>
                                                </th>
                                                <th class="text-center" scope="col">
                                                    <p class="mb-0">Status</p>
                                                </th>
                                                <th class="text-end" scope="col">
                                                    <p class="mb-0">Actions</p>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($records as $row)
                                                <tr id="row-{{ $row->id }}">
                                                    <td>
                                                        <p class="mb-0 fw-medium"><a href="{{ route('backend.players.view', $row->id) }}">{{ $row->first_name .' ' . $row->last_name }}</a></p>
                                                        <p class="mb-0 text-muted fw-medium">{{ generatePlayerID($row->registration_number) }}</p>

                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0">{{ $row->school }}</p>
                                                        <p class="mb-0 text-muted">{{ $row->player_level }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0">{{ $row->batting_style }}</p>
                                                        <p class="mb-0 text-muted">{{ $row->bowling_style }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0">{{ $row->player_role }}</p>
                                                        <p class="mb-0 text-muted">Active Team name goes here</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0"><span class="badge {{ $row->status_label }}">{{ $row->player_status }}</span></p>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="d-flex justify-content-end align-items-center">
                                                            <div>
                                                                <a href="{{ route('backend.players.view', $row->id) }}" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><span class="mdi mdi-magnify"></span></a>
                                                                <a href="{{ route('backend.players.edit', $row->id) }}" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="mdi mdi-pencil"></span></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                            <div class="mt-5">
                                {{--Paginaiton--}}
                                {!! $records->links('vendor.pagination.backend') !!}
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
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

        $(document).ready(function (){

        });
    </script>


@endsection
