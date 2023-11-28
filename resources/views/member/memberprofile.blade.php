@extends('member.member_app')
@section('title', 'Member Profile Connformation ')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Member Information</div>

                    <div class="card-body alert alert-success">
                        @if (isset($profile))
                            <div style="text-align: right;margin:5px;">
                                <button class="btn btn-sm btn-primary"
                                    onclick="printmemberprofile('{{ $profile->firstname }}','{{ $profile->lastname }}')">Print</button>
                            </div>
                            {{-- ///////////////////// --}}
                            <div class="alert-success"
                                style="color:black;font-size:20px; text-align: center;margin:5px; background-color: #808080;">
                                <span>Successfull !!!</span>
                            </div>
                            <div style="text-align: center;margin:5px;">
                                <span>We Recommend to you that pleace Print Your registration profile Information</span>
                            </div>
                            {{-- //////////////////// --}}
                            <div id="printprofile">
                                <div class="alert alert-success text-center" role="alert">
                                    @if (isset($profile->profile) && $profile->profile != '')
                                        <img src="{{ url('storage/image/profile/member/' . $profile->profile) }}"
                                            class="rounded-circle" alt="Member Profile" style="width:160px;height:160px;">
                                    @else
                                        <img src="{{ url('storage/image/profile/member/avatar.png') }}"
                                            class="rounded-circle" alt="Member Profile" style="width:160px;height:160px;">
                                    @endif
                                </div>
                                <div class="alert alert-success" role="alert">
                                    Passport Number: {{ $profile->idno }}
                                </div>
                                <div class="alert alert-success" role="alert">
                                    Title: {{ $profile->title }}
                                </div>
                                <div class="alert alert-success" role="alert">
                                    Last Name : {{ $profile->lastname }}
                                    {{-- First Name: {{ $profile->firstname }} --}}
                                </div>
                                <div class="alert alert-success" role="alert">
                                    First Name: {{ $profile->firstname }}
                                    {{-- Middle Name: {{ $profile->secondname }} --}}
                                </div>
                                <div class="alert alert-success" role="alert">
                                    Middle Name: {{ $profile->secondname }}
                                    {{-- Last Name : {{ $profile->lastname }} --}}
                                </div>

                                <div class="alert alert-success" role="alert">
                                    Gender: {{ $profile->gender }}
                                </div>
                                <div class="alert alert-success" role="alert">
                                    Email: {{ $profile->email }}
                                </div>
                                <div class="alert alert-success" role="alert">
                                    Country: {{ $profile->countrycode }}
                                </div>
                            </div>
                        @else
                            <h3>No Your Profile currently.</h3>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printmemberprofile(firstname, lastname) {
            var printContents = document.getElementById("printprofile").innerHTML;
            var title = document.title;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            document.title = firstname + " " + lastname;
            window.print();
            document.title = title;
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
