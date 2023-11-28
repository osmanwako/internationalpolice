@extends('admin.admin_app')

@section('title', 'Admin View Member list')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (Auth::guard('admin')->check())
                    <div class="table-responsive">
                        <div class="table-header-flex">
                            <span class="header-flex"> EAPCCO Member List</span>
                            <span class="header-flex">
                                <input class="form-control" id="intblsearch" type="text" placeholder="Search.."
                                    onkeyup="getdata()">
                            </span>
                            @if (Auth::guard('admin')->user()->create)
                                <span class="header-flex">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#addmembermodelid">
                                        Add Member
                                    </button>
                                </span>
                            @endif


                        </div>
                        @if (Session::get('failed'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('failed') }}
                            </div>
                        @endif
                        @if (Session::get('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (isset($memberlist))

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Passport Number</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Surename</th>
                                        <th scope="col">Given Name</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Passport</th>
                                        @if (Auth::guard('admin')->user()->edit ||
                                            Auth::guard('admin')->user()->badge ||
                                            Auth::guard('admin')->user()->delete)
                                            <th>
                                                Action
                                            </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="tablebody">
                                    @foreach ($memberlist as $member)
                                        <tr>
                                            <td scope="col">{{ $loop->index + 1 }}</td>
                                            <td scope="col">{{ $member->idno }}</td>
                                            <td scope="col">{{ $member->title }}</td>
                                            <td scope="col">{{ $member->lastname }}</td>
                                            <td scope="col">{{ $member->firstname }} {{ $member->secondname }}</td>
                                            <td scope="col">{{ $member->gender }}</td>
                                            <td scope="col">{{ $member->countrycode }}</td>
                                            <td scope="col">
                                                @if ($member->passport == 'nopassport.jpg')
                                                    <button class="btn btn-md btn-link" disabled>
                                                        <i class="bi bi-file-pdf"></i>
                                                    </button>
                                                @else
                                                    <a href="{{ route('passportpdf', $member->passport) }}"
                                                        class="btn btn-md btn-link"
                                                        style="border-radius:50%;background-color:white">
                                                        <i class="bi bi-download"></i></a>
                                                @endif
                                            </td>
                                            @if (Auth::guard('admin')->user()->edit ||
                                                Auth::guard('admin')->user()->badge ||
                                                Auth::guard('admin')->user()->delete)
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-link" type="button" id="memberoptionid"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-three-dots"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="memberoptionid">
                                                            @if (Auth::guard('admin')->user()->edit)
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('adminmemberedit', $member->id) }}">Edit</a>
                                                                </li>
                                                            @endif
                                                            @if (Auth::guard('admin')->user()->badge)
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('adminmemberbadge', $member->id) }}">Badge</a>
                                                                </li>
                                                            @endif
                                                            @if (Auth::guard('admin')->user()->delete)
                                                                <li>
                                                                    <button type="button"
                                                                        class="dropdown-item btn btn-link"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#memberdeletemodal{{ $member->id }}">
                                                                        Delete
                                                                    </button>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                        @if (Auth::guard('admin')->user()->delete)
                                                            <div class="modal fade"
                                                                id="memberdeletemodal{{ $member->id }}" tabindex="-1"
                                                                aria-labelledby="memberdeletemodalLabel{{ $member->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                                Delete Member</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Are you sure to delete
                                                                            <strong>{{ $member->lastname }}
                                                                                {{ $member->firstname }}
                                                                                {{ $member->secondname }} </strong>?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">NO</button>
                                                                            <form action="{{ route('adminmemberdelete') }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <button type="submit"
                                                                                    class="btn btn-primary" name="id"
                                                                                    value="{{ $member->id }}">Yes</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Modal -->

                        @endif

                        <div class="modal fade" id="addmembermodelid" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="addmembermodelidLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addmembermodelidLabel">Register EAPCCO
                                            Members' Form.</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="memberprofile">
                                            <img src="{{ url('asset/images/nophoto.png') }}" class="rounded-circle"
                                                alt="Member Profile" style="width:160px;height:160px;display: none"
                                                id="profile_img">
                                        </div>
                                        {{-- //start form here --------------------------------------------------------------------------------- --}}
                                        <form method="POST" action="{{ route('adminmregister') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row md-form mb-3 ">
                                                <hr>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="idnoid" class="form-label">Passport Number</label>
                                                        <input type="text" id="idnoid"
                                                            placeholder="Enter ID Number"
                                                            class="form-control @error('idno') is-invalid @enderror"
                                                            name="idno" value="{{ old('idno') }}" autofocus>

                                                        @error('idno')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="titleid" class="form-label">Title</label>
                                                        <input type="text" id="titleid"
                                                            placeholder="Enter Your Title"
                                                            class="form-control @error('title') is-invalid @enderror"
                                                            name="title" value="{{ old('title') }}" autofocus>

                                                        @error('title')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lastnameid" class="form-label">Last Name</label>
                                                        <input type="text" id="lastnameid"
                                                            placeholder="Enter Member's Grandfather Name"
                                                            class="form-control @error('lastname') is-invalid @enderror"
                                                            name="lastname" value="{{ old('lastname') }}" autofocus>

                                                        @error('lastname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firstnameid" class="form-label">First Name</label>
                                                        <input type="text" id="firstname"
                                                            placeholder="Enter Member's Name"
                                                            class="form-control @error('firstname') is-invalid @enderror"
                                                            name="firstname" value="{{ old('firstname') }}" autofocus>

                                                        @error('firstname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="secondnameid" class="form-label">Middle Name</label>
                                                        <input type="text" id="secondnameid"
                                                            placeholder="Enter Member's Father Name"
                                                            class="form-control @error('secondname') is-invalid @enderror"
                                                            name="secondname" value="{{ old('secondname') }}" autofocus>

                                                        @error('secondname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="genderid" class="form-label">Gender</label>
                                                        <div>
                                                            <div class="form-check form-check-inline">
                                                                @if (old('gender') == 'Male')
                                                                    <input class="form-check-input " type="radio"
                                                                        name="gender" id="maleid" value="Male"
                                                                        checked>
                                                                @else
                                                                    <input
                                                                        class="form-check-input @error('gender') is-invalid @enderror"
                                                                        type="radio" name="gender" id="maleid"
                                                                        value="Male">
                                                                @endif
                                                                <label class="form-check-label"
                                                                    for="maleid">Male</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                @if (old('gender') == 'Female')
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gender" id="femaleid" value="Female"
                                                                        checked>
                                                                @else
                                                                    <input
                                                                        class="form-check-input  @error('gender') is-invalid @enderror"
                                                                        type="radio" name="gender" id="femaleid"
                                                                        value="Female">
                                                                @endif
                                                                <label class="form-check-label"
                                                                    for="femaleid">Female</label>
                                                            </div>
                                                        </div>
                                                        @error('gender')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Member Profile</label>
                                                        <input type="file" id="profileid"
                                                            class="form-control @error('profile') is-invalid @enderror"
                                                            name="profile" value="{{ old('profile') }}" autofocus
                                                            style="display: none" onchange="changeimage(event)">
                                                        <div>
                                                            <label for="profileid" class="form-control"
                                                                style="white-space: nowrap;overflow: hidden; text-overflow: ellipsis"><i
                                                                    class="bi bi-image"></i> Select Profile
                                                                <span style="color: green;"
                                                                    id="spanfilenameid"></span></label>
                                                        </div>
                                                        @error('profile')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Passport Copy</label>
                                                        <input type="file" id="passportid"
                                                            class="form-control @error('passport') is-invalid @enderror"
                                                            name="passport" value="{{ old('passport') }}" autofocus
                                                            style="display: none" onchange="changepassport(event)"
                                                            accept="application/pdf,image/*">
                                                        <label for="passportid" class="form-control"
                                                            style="white-space: nowrap;overflow: hidden; text-overflow: ellipsis">
                                                            <i class="bi bi-file-pdf"></i>&nbsp;<i
                                                                class="bi bi-image"></i>&nbsp;
                                                            <span style="color: green;" id="spanpassportid">
                                                                Select Your Passport Copy by PDF or image format.
                                                            </span></label>
                                                        @error('passport')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @if (is_array($countries))
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="countrycodeid" class="form-label">Country</label>
                                                            <select type="text" id="countrycodeid"
                                                                class="form-control @error('countrycode') is-invalid @enderror"
                                                                name="countrycode">
                                                                @if (old('countrycode'))
                                                                    <option value="{{ old('countrycode') }}" selected>
                                                                        {{ old('countrycode') }}</option>
                                                                @else
                                                                    <option value="" selected>Enter Member's Country
                                                                    </option>
                                                                @endif
                                                                @foreach ($countries as $country)
                                                                    <option value="{{ $country['name'] }}">
                                                                        {{ $country['name'] }}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('countrycode')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        {{-- {{$countries}} --}}
                                                    </div>
                                                @endif

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="emailid" class="form-label">Email</label>
                                                        <input type="text" id="emailid"
                                                            placeholder="example@abcd.com"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}" autofocus>

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div div class="form-group">
                                                        <label class="form-label"
                                                            style="visibility: hidden;">Register</label>
                                                        <button type="submit"
                                                            class="form-control btn btn-primary">Create</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        {{-- //end form here --------------------------------------------------------------------------------- --}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
        <script>
            function getdata() {
                var str = document.getElementById("intblsearch").value;
                var data = document.getElementById("tablebody");
                if (str.length == 0) {
                    for (let i = 0; i < data.rows.length; i++) {
                        document.getElementById("tablebody").rows[i].style.display = "";
                    }
                    return;
                }
                for (let i = 0; i < data.rows.length; i++) {
                    let status = findrow(data.rows[i], str);
                    if (status)
                        document.getElementById("tablebody").rows[i].style.display = "";
                    else
                        document.getElementById("tablebody").rows[i].style.display = "none";

                }

            }

            function findrow(rows, str) {
                let content;
                for (let i = 0; i < rows.cells.length; i++) {
                    content = rows.cells[i].textContent;
                    if (content.toLowerCase().includes(str.toLowerCase()))
                        return true;
                }
                // console.log(rows.cells.length, rows);
                return false;
            }
        </script>
        <script>
            function changeimage(event) {

                var image = document.getElementById('profile_img');
                image.src = URL.createObjectURL(event.target.files[0]);
                document.getElementById("spanfilenameid").innerHTML = document.getElementById('profileid').files[0].name;
                document.getElementById('profile_img').style.display = 'inline';
            }

            function changepassport(event) {
                document.getElementById("spanpassportid").innerHTML = document.getElementById('passportid').files[0].name;
            }
        </script>
    </div>
@endsection
