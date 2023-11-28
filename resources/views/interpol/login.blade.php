@extends('interpol.header')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4" style="margin-top:30px;">
        @if (Route::currentRouteName()=="adminlogin")
        <h4> Login Admin</h4>
        @endif
        @if (Route::currentRouteName()=="memberlogin")
        <h4> Login Member</h4>
        @endif
        <hr>
        @if (Route::has('adminlogin') && Route::has('memberlogin'))
        @if(Route::currentRouteName()=="adminlogin")
          <form method="POST" action="{{ route('adminlogincheck') }}">
            @else
            <form method="POST" action="{{ route('memberlogincheck') }}">
        @endif
        @csrf
                  <div class="form-group p-2">
                  <label for="usernameid" class="form-label">Username </label>
                  <input id="username" type="email" class="form-control
                  @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autofocus>
                 @error('username')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                 @enderror

                </div>
                <div class="form-group p-2">
                    <label for="password">Password </label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autofocus>
                   @error('password')
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>
                   @enderror
                  </div>
                  <div class="form-group p-2">
                    <button type="submit" class="btn btn-primary"> Login</button>
                  </div>

            </form>
         @endif
        </div>
    </div>
   </div>
@endsection
