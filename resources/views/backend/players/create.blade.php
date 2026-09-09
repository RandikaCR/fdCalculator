@extends('layouts.backend')

@php
    $pageTitle = 'Create a Player';
    $singlePageTitle = 'Create a Player';
    $routePrefix = 'players';
    $pageUrl = 'players';
@endphp

@section('page_title')
    {{ $pageTitle }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/packages/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/libs/croppie/croppie.min.css') }}">
@endsection

@section('css')

@endsection

@if(!empty($user_access))

    @section('header_buttons')
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-end mb-3">
                @if(!empty($player))
                    <a href="{{ route('backend.players.view', $player->id) }}" class="btn btn-primary me-3">
                        <span class="mdi mdi-magnify me-2"></span>
                        View
                    </a>
                @endif
                <a href="{{ route('backend.players.index') }}" class="btn btn-primary me-3">
                    <span class="mdi mdi-plus-box me-2"></span>
                    All Players
                </a>
            </div>
        </div>
    @endsection

    @section('content')
        <form method="POST" action="{{ route('backend.players.store') }}">
            @csrf
            <input type="hidden" name="id" value="{{ isset($player) ? $player->id : 0 }}">
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

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Player Details <span class="fw-bold">{{ !empty($player) ? ' - '. generatePlayerID($player->registration_number) : '' }}</span></h4>
                            <div class="flex-shrink-0">
                                <button type="submit" class="btn btn-secondary waves-effect waves-light"><i class="mdi mdi-content-save me-1"></i>SAVE</button>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="first_name" class="form-label">First Name*</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ !empty($player) ? $player->first_name : '' }}" placeholder="Enter here....">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="last_name" class="form-label">Last Name*</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ !empty($player) ? $player->last_name : '' }}" placeholder="Enter here....">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <div>
                                            <label for="gender" class="form-label">Gender</label>
                                            <select class="form-control js-example-basic-single" name="gender" id="gender">
                                                <option value="">Select Gender</option>
                                                <option value="male" {{ !empty($player) && $player->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ !empty($player) && $player->gender == 'female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div>
                                            <label class="form-label">Date of Birth*</label>
                                            <input type="text" class="form-control" data-provider="flatpickr" id="date_of_birth" name="date_of_birth" data-date-format="d-M-Y" value="{{ !empty($player) && date('Y', strtotime($player->date_of_birth)) > 1970 ? date('d-M-Y', strtotime($player->date_of_birth)) : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <div>
                                            <label for="player_status_id" class="form-label">Player Status</label>
                                            <select class="form-control js-example-basic-single" name="player_status_id" id="player_status_id">
                                                <option value="">Select Status</option>
                                                @foreach($player_statuses as $playerStatus)
                                                    <option value="{{ $playerStatus->id }}" {{ !empty($player) && $player->player_status_id == $playerStatus->id ? 'selected' : '' }}>{{ $playerStatus->player_status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="school_id" class="form-label">School</label>
                                            <select class="form-control js-example-basic-single" name="school_id" id="school_id">
                                                <option value="">Select School</option>
                                                @foreach($schools as $school)
                                                    <option value="{{ $school->id }}" {{ !empty($player) && $player->school_id == $school->id ? 'selected' : '' }}>{{ $school->school }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label class="form-label">Date of Join</label>
                                            <input type="text" class="form-control" data-provider="flatpickr" id="date_of_join" name="date_of_join" data-date-format="d-M-Y" value="{{ !empty($player) && date('Y', strtotime($player->date_of_join)) > 1970 ? date('d-M-Y', strtotime($player->date_of_join)) : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="contact_1" class="form-label">Contact</label>
                                            <input type="text" class="form-control" id="contact_1" name="contact_1" value="{{ !empty($player) ? $player->contact_1 : '' }}" placeholder="Enter here....">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="contact_2" class="form-label">Contact 2</label>
                                            <input type="text" class="form-control" id="contact_2" name="contact_2" value="{{ !empty($player) ? $player->contact_2 : '' }}" placeholder="Enter here....">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="emergency_contact_1_name" class="form-label">Emergency Contact Person (WhatsApp)</label>
                                            <input type="text" class="form-control" id="emergency_contact_1_name" name="emergency_contact_1_name" value="{{ !empty($player) ? $player->emergency_contact_1_name : '' }}" placeholder="Enter here....">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="emergency_contact_1" class="form-label">Emergency Contact Number (WhatsApp)</label>
                                            <input type="text" class="form-control" id="emergency_contact_1" name="emergency_contact_1" value="{{ !empty($player) ? $player->emergency_contact_1 : '' }}" placeholder="Enter here....">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="emergency_contact_2_name" class="form-label">Emergency Contact Person 2</label>
                                            <input type="text" class="form-control" id="emergency_contact_2_name" name="emergency_contact_2_name" value="{{ !empty($player) ? $player->emergency_contact_2_name : '' }}" placeholder="Enter here....">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="emergency_contact_2" class="form-label">Emergency Contact Number 2</label>
                                            <input type="text" class="form-control" id="emergency_contact_2" name="emergency_contact_2" value="{{ !empty($player) ? $player->emergency_contact_2 : '' }}" placeholder="Enter here....">
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="player_level_id" class="form-label">Player Level</label>
                                            <select class="form-control js-example-basic-single" name="player_level_id" id="player_level_id">
                                                <option value="">Select Player Level</option>
                                                @foreach($player_levels as $playerLevel)
                                                    <option value="{{ $playerLevel->id }}" {{ !empty($player) && $player->player_level_id == $playerLevel->id ? 'selected' : '' }}>{{ $playerLevel->player_level }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="player_role_id" class="form-label">Player Role</label>
                                            <select class="form-control js-example-basic-single" name="player_role_id" id="player_role_id">
                                                <option value="">Select Player Role</option>
                                                @foreach($player_roles as $playerRole)
                                                    <option value="{{ $playerRole->id }}" {{ !empty($player) && $player->player_role_id == $playerRole->id ? 'selected' : '' }}>{{ $playerRole->player_role }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="batting_style_id" class="form-label">Batting Style</label>
                                            <select class="form-control js-example-basic-single" name="batting_style_id" id="batting_style_id">
                                                <option value="">Select Batting Style</option>
                                                @foreach($batting_styles as $battingStyle)
                                                    <option value="{{ $battingStyle->id }}" {{ !empty($player) && $player->batting_style_id == $battingStyle->id ? 'selected' : '' }}>{{ $battingStyle->batting_style }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="bowling_style_id" class="form-label">Bowling Style</label>
                                            <select class="form-control js-example-basic-single" name="bowling_style_id" id="bowling_style_id">
                                                <option value="">Select Bowling Style</option>
                                                @foreach($bowling_styles as $bowlingStyle)
                                                    <option value="{{ $bowlingStyle->id }}" {{ !empty($player) && $player->bowling_style_id == $bowlingStyle->id ? 'selected' : '' }}>{{ $bowlingStyle->bowling_style }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="jersey_number" class="form-label">Jersey Number</label>
                                            <input type="text" class="form-control" id="jersey_number" name="jersey_number" value="{{ !empty($player) ? $player->jersey_number : '' }}" placeholder="Enter here....">
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="jersey_name" class="form-label">Jersey Name</label>
                                            <input type="text" class="form-control" id="jersey_name" name="jersey_name" value="{{ !empty($player) ? $player->jersey_name : '' }}" placeholder="Enter here....">
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="tshirt_size" class="form-label">T Shirt Size</label>
                                            <select class="form-control js-example-basic-single" name="tshirt_size" id="tshirt_size">
                                                <option value="">Select T Shirt Size</option>
                                                @foreach($sizes as $size)
                                                    <option value="{{ $size }}" {{ !empty($player) && $player->tshirt_size == $size ? 'selected' : '' }}>{{ $size }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div>
                                            <label for="bottom_size" class="form-label">Bottom Size</label>
                                            <select class="form-control js-example-basic-single" name="bottom_size" id="bottom_size">
                                                <option value="">Select Bottom Size</option>
                                                @foreach($sizes as $size)
                                                    <option value="{{ $size }}" {{ !empty($player) && $player->bottom_size == $size ? 'selected' : '' }}>{{ $size }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <div>
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="description" rows="6">{{ !empty($player) ? $player->description : '' }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <div class="row">
                                            <div class="col-sm-6 mb-4">
                                                <label>Images</label>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="file">
                                                                <input type="file" accept="image/*" class="file-styled-primary" id="thumb_image" >
                                                            </label>
                                                        </div>
                                                        <div class="row" style="">
                                                            <div class="col-12" id="uploaded_thumb">
                                                                <div id="thumb_image_demo" style=""></div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 d-flex justify-content-center">
                                                                <span class="btn btn-info btn-sm thumb_crop">Apply</span>
                                                            </div>
                                                            <div class="col-sm-12 d-flex justify-content-center mt-2">
                                                                <p class="text-success mb-0" id="image-status"></p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row" id="uploaded_image">
                                                    @if(!empty($player) && !empty($player->image))
                                                        <div class="d-flex align-items-center justify-content-center img-action">
                                                            <img class="img-fluid img-bordered" src="{{ asset('assets/common/images/players/' . $player->image ) }}">
                                                        </div>
                                                    @endif
                                                </div>
                                                <input type="hidden" name="image" id="image" value="{{ !empty($player) ? $player->image : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!-- end card -->
                </div>
            </div>
        </form>

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
    <script src="{{ asset('assets/backend/libs/croppie/croppie.min.js') }}"></script>
@endsection

@section('custom_scripts')
    <script>

        function appendImage($img){

            $image = "{{ url('assets/common/images/players') }}/" + $img;

            $item = $('<div></div>').addClass('col-md-12 mb-3');

            $('<div></div>').addClass('d-flex align-items-center justify-content-center img-action')
                .append($('<img>').addClass('img-fluid img-bordered').attr('src', $image)).appendTo($item);

            return $item;
        }

        $(document).ready(function (){
            $image_thumb = $('#thumb_image_demo').croppie({
                enableExif: true,
                viewport: {
                    width:239,
                    height:280,
                    type:'square' //circle
                },
                boundary:{
                    width:300,
                    height:300
                }
            });

            $('#thumb_image').on('change', function(){
                var reader = new FileReader();
                reader.onload = function (event) {
                    $image_thumb.croppie('bind', {
                        url: event.target.result
                    });
                };
                reader.readAsDataURL(this.files[0]);
                $('#uploaded_thumb').show();
            });

            $('.thumb_crop').click(function(event){

                $image_thumb.croppie('result', {
                    type: 'canvas',
                    /*size: 'original'*/
                    size: {
                        width: 820,
                        height: 960
                    }
                }).then(function(response){

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('backend.players.imageUpload') }}",
                        type: "POST",
                        data: {
                            image:response,
                        },
                        beforeSend: function (){
                            $('#image-status').html('Uploading....');
                            $('#image').val('');
                        },
                        success: function ($data) {
                            $('#image').val($data.filename);
                            $('#image-status').html($data.status);
                            $img = appendImage($data.filename);
                            $('#uploaded_image').html($img);
                        }
                    });

                })
            });
        });
    </script>


@endsection
