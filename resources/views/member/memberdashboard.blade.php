@extends('member.member_app')
@section('title', 'Member Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <!-- ///////////////////////////////////////////////////////////////////////// -->
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('asset/images/interpol/EAPCCO.jpg') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Ethiopian federal police commissioner with EAPCCO members.</h5>
                                <p>Ethiopian federal police Commissioner General Demelash Gebremikeal discuss with EAPCCO
                                    members about 24th East African Police Command (EAPCCO) meeting.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('asset/images/interpol/flag.jpg') }}" class="d-block w-100"
                                alt="CCTV Camera in ethiopia">
                            <div class="carousel-caption d-none d-md-block" style="color: black;">
                                <h5>Flag of INTERPOL</h5>
                                <p></p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('asset/images/interpol/discussion.jpg') }}" class="d-block w-100"
                                alt="Ethiopian Federal Police commando">
                            <div class="carousel-caption d-none d-md-block" style="color: black;">
                                <h5>Discussion Commissioner General Demelash Gebremikeal With EAPCCO </h5>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- ////////////////////////////////////////////////////////////////////////// -->
            </div>
        </div>
    </div>
@endsection
