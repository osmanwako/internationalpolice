@extends('member.member_app')
@section('title', 'Departure Flight')
@section('content')
    <div class="container">
        <div class="text-center alert alert-warning " role="alert">
            <strong>Dear member, we respectfully request . </strong> In order to finalize transport arrangement for an
            airport, Please
            confirm your flight
            details below.
        </div>
        <div class="text-center"></div>
        <div class="row justify-content-center">{{-- start of row div --}}
            <div class="col-md-8">
                @if (Auth::guard('member'))
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title" style="text-alignment:right;">Departure Flight Confirmation of
                                EAPCCO.</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if (Session::get('failed'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('failed') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('flight.addin', $flightin->id) }}">
                                    @csrf
                                    <input type="hidden" value="{{ $flightin->idno }}" name="idno_">
                                    {{-- //start form here --------------------------------------------------------------------------------- --}}
                                    <div class="col-md-11 mb-3">
                                        <div class="form-group">
                                            <input type="text" id="fullnameid" placeholder="Full name"
                                                class="form-control @error('title') is-invalid @enderror" name="fullname"
                                                value="{{ $flightin->title }} {{ $flightin->lastname }} {{ $flightin->firstname }} {{ $flightin->secondname }} "
                                                readonly>

                                            @error('fullname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    @php
                                        if (isset($departure)) {
                                            $departdate = $departure->departdate;
                                            $flighttime = $departure->flighttime;
                                        } else {
                                            $departdate = old('departdate');
                                            $flighttime = old('flighttime');
                                        }
                                        
                                    @endphp

                                    <div class="col-md-11 mb-3">
                                        <div class="form-group">
                                            <label for="hotelid" class="form-label">Hotel Name</label>
                                            <input type="text" id="hotelid" name="hotelname"
                                                placeholder="Enter Hotel name here"
                                                class="form-control @error('hotelname') 
                                                is-invalid @enderror"
                                                value="@if (isset($departure)) {{ $departure->hotelname }} @else {{ old('hotelname') }} @endif"
                                                autofocus>
                                            @error('hotelname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-11 mb-3">
                                        <div class="form-group">
                                            <label for="hotelid" class="form-label">Room N<sub><u>O</u></sub></label>
                                            <input type="text" id="roomno" name="roomno"
                                                placeholder="Enter Hotel room Number here"
                                                class="form-control @error('roomno') 
                                                is-invalid @enderror"
                                                value="@if (isset($departure)) {{ $departure->roomno }} @else{{ old('roomno') }} @endif"
                                                autofocus>
                                            @error('roomno')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-11 mb-3">
                                        <div class="form-group">
                                            <label for="departdateid" class="form-label">Departure
                                                Date:</label>
                                            <input type="date" id="departdateid" name="departdate"
                                                placeholder="Enter departure date here"
                                                class="form-control @error('departdate') 
                                                is-invalid @enderror"
                                                value="{{ $departdate }}" autofocus>
                                            @error('departdate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-11 mb-3">
                                        <div class="form-group">
                                            <label for="flightnumid" class="form-label">Flight Number</label>
                                            <input type="text" id="flightnumid" name="flightnum"
                                                placeholder="Enter flight Number here"
                                                class="form-control @error('flightnum') 
                                                is-invalid @enderror"
                                                value="@if (isset($departure)) {{ $departure->flightnum }} @else{{ old('flightnum') }} @endif"
                                                autofocus>
                                            @error('flightnum')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-11 mb-3">
                                        <div class="form-group">
                                            <label for="flighttimeid" class="form-label">Flight Time</label>
                                            <input type="time" id="flighttimeid" name="flighttime"
                                                placeholder="Enter flight time here"
                                                class="form-control @error('flighttime') 
                                                is-invalid @enderror"
                                                value="{{ $flighttime }}" autofocus>
                                            @error('flighttime')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-11 mb-3">
                                        <div class="form-group">
                                            <label for="telephoneid" class="form-label">Contact Cell Phone
                                                N<sub><u>O</u></sub></label>
                                            <input type="tel" id="telephoneid" name="telephone"
                                                placeholder="Enter flight time here"
                                                class="form-control @error('telephone') 
                                                is-invalid @enderror"
                                                value="@if (isset($departure)) {{ $departure->telephone }} @else{{ old('telephone') }} @endif"
                                                autofocus>
                                            @error('telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-11 mb-3">
                                        <div class="form-group">
                                            <label class="form-label" style="visibility: hidden;">Next</label>
                                            <button type="submit" class="form-control btn"
                                                style="background-color: #0b2c4b; text-align: center; color:#ecd08a;">Confirm</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> {{-- end of card div --}}
                @endif
            </div>{{-- end of column div --}}
        </div>{{-- end of row div --}}
    </div>{{-- end of container div  --}}
@endsection
