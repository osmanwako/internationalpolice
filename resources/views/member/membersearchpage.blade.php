@extends('member.member_app')
@section('title', 'Member Search')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (Auth::guard('member'))
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title" style="text-alignment:right;">Search Your Passport Number Here</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if (Session::get('failed'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('failed') }}
                                    </div>
                                @endif
                                <form method="post" action="{{ route('membersearch') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label for="idnoid" class="form-label">Please Insert Your Passport
                                                    Number:</label>
                                                <input class="form-control @error('search_idno') is-invalid @enderror me-2"
                                                    type="search" name="search_idno" value="{{ old('search_idno') }}"
                                                    maxlength="23" placeholder="Enter Your passport ID" aria-label="Search">
                                                @error('search_idno')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label class="form-label" style="visibility: hidden;">Next</label>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div> {{-- end of card div body --}}
                        </div> {{-- end of card div --}}
                @endif
            </div>{{-- end of column div --}}
        </div>{{-- end of row div --}}
    </div>{{-- end of container div  --}}
@endsection
