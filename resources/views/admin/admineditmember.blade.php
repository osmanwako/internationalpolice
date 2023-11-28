@extends('admin.admin_app')
@section('title', 'Admin Edit Member Profile')
@section('content')
    <div class="container"> {{-- start of container div  --}}
        <div class="row justify-content-center">{{-- start of row div --}}
            <div class="col-md-8">
                @if (Auth::guard('member'))
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title" style="text-alignment:right;">Edit Member Profile</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if (Session::get('failed'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('failed') }}
                                    </div>
                                @endif
                                @if (isset($profile) && $profile != '')
                                    <form method="POST" action="{{ route('adminmemberupdate', $profile->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $profile->id }}">
                                        {{-- //start form here --------------------------------------------------------------------------------- --}}
                                        <div class="col-md-11 mb-3">
                                            <div class="form-group">
                                                <label for="idnoid" class="form-label">Passport NO</label>
                                                <input type="text" id="idnoid" placeholder="Enter ID Number"
                                                    class="form-control @error('idno') is-invalid @enderror" name="idno"
                                                    value="{{ $profile->idno }}">
                                                @error('idno')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-11 mb-3">
                                            <div class="form-group">
                                                <label for="titleid" class="form-label">Title</label>
                                                <input type="text" id="titleid" placeholder="Enter Your Title"
                                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                                    value="{{ $profile->title }}">

                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-11 mb-3">
                                            <div class="form-group">
                                                <label for="lastnameid" class="form-label">Last Name</label>
                                                <input type="text" id="lastnameid"
                                                    placeholder="Enter Member's Grandfather Name"
                                                    class="form-control @error('lastname') is-invalid @enderror"
                                                    name="lastname" value="{{ $profile->lastname }}">

                                                @error('lastname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-11 mb-3">
                                            <div class="form-group">
                                                <label for="firstnameid" class="form-label">First Name</label>
                                                <input type="text" id="firstname" placeholder="Enter Member's Name"
                                                    class="form-control @error('firstname') is-invalid @enderror"
                                                    name="firstname" value="{{ $profile->firstname }}">

                                                @error('firstname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-11 mb-3">
                                            <div class="form-group">
                                                <label for="secondnameid" class="form-label">Middle Name</label>
                                                <input type="text" id="secondnameid"
                                                    placeholder="Enter Member's Father Name"
                                                    class="form-control @error('secondname') is-invalid @enderror"
                                                    name="secondname" value="{{ $profile->secondname }}">

                                                @error('secondname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-11 mb-3">
                                            <div class="form-group">
                                                <label for="genderid" class="form-label">Gender</label>
                                                <div class="form-check form-check-inline">
                                                    @if ($profile->gender == 'Male')
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="maleid" value="Male" checked>
                                                    @else
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="maleid" value="Male">
                                                    @endif
                                                    <label class="form-check-label" for="maleid">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    @if ($profile->gender == 'Female')
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="femaleid" value="Female" checked>
                                                    @else
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="femaleid" value="Female">
                                                    @endif
                                                    <label class="form-check-label" for="femaleid">Female</label>
                                                </div>
                                                <input class="form-check-input  @error('gender') is-invalid @enderror"
                                                    type="hidden" name="other">
                                                @error('gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-11 mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Member Profile</label>
                                                <input type="file" id="profileid"
                                                    class="form-control @error('profile') is-invalid @enderror"
                                                    name="profile" style="display: none" onchange="changeimage(event)">
                                                <label for="profileid" class="form-control"
                                                    style="white-space: nowrap;overflow: hidden; text-overflow: ellipsis"><i
                                                        class="bi bi-image"></i> Select Profile
                                                    <span style="color: green;"
                                                        id="spanfilenameid">{{ $profile->profile }}</span></label>
                                                @error('profile')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="alert alert-success text-center" role="alert">
                                                    @if ($profile->profile)
                                                        <img src="{{ url('storage/image/profile/member/' . $profile->profile) }}"
                                                            class="rounded-circle" alt="Member Profile"
                                                            style="width:160px;height:160px;" id="profile_img">
                                                    @else
                                                        <img src="{{ url('asset/images/nophoto.png') }}"
                                                            class="rounded-circle" alt="Member Profile"
                                                            style="width:160px;height:160px;" id="profile_img">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-11 mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Passport Copy</label>
                                                <input type="file" id="passportid"
                                                    class="form-control @error('passport') is-invalid @enderror"
                                                    name="passport" value="{{ old('passport') }}" autofocus
                                                    style="display: none" onchange="changepassport(event)"
                                                    accept="application/pdf,image/*">
                                                <label for="passportid" class="form-control"
                                                    style="white-space: nowrap;overflow: hidden; text-overflow: ellipsis">
                                                    <i class="bi bi-file-pdf"></i>&nbsp;<i class="bi bi-image"></i>&nbsp;
                                                    <span style="color: green;" id="spanpassportid">
                                                        {{ $profile->passport }}
                                                    </span></label>
                                                @error('passport')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-11 mb-3">
                                            <div class="form-group">
                                                <label for="countrycodeid" class="form-label">Country</label>
                                                <select type="text" id="countrycodeid"
                                                    class="form-control @error('countrycode') is-invalid @enderror"
                                                    name="countrycode">
                                                    @if ($profile->countrycode)
                                                        <option value="{{ $profile->countrycode }}" selected>
                                                            {{ $profile->countrycode }}</option>
                                                    @else
                                                        <option value="" selected>Enter Member's Country</option>
                                                    @endif
                                                    @if (is_array($countries))
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country['name'] }}">{{ $country['name'] }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('countrycode')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-11 mb-3">
                                            <div class="form-group">
                                                <label for="emailid" class="form-label">Email</label>
                                                <input type="text" id="emailid" placeholder="example@abcd.com"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ $profile->email }}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-11 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" style="visibility: hidden;">Register</label>
                                                <button type="submit"
                                                    class="form-control btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div> {{-- end of card div --}}
                @endif
            </div>{{-- end of column div --}}
        </div>{{-- end of row div --}}
    </div>{{-- end of container div  --}}
    <script>
        function changeimage(event) {
            var image = document.getElementById('profile_img');
            image.src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("spanfilenameid").innerHTML = document.getElementById('profileid').files[0].name;
            // document.getElementById('profilediv').style.display='block';
        }

        function changepassport(event) {
            document.getElementById("spanpassportid").innerHTML = document.getElementById('passportid').files[0].name;
        }
    </script>

@endsection
