@extends('admin.admin_app')
@section('title', 'Create Account')
@section('content')
<div class="container"> 
  {{-- start of container div  --}}
  <div class="row justify-content-center">
    {{-- start of row div --}}
    <div class="col-md-8">
      @if (Auth::guard('admin'))
      <div class="card">
        <div class="card-header">
          <h5 class="card-title" style="text-alignment:right;">Create Account</h5>
      </div>
      <div class="card-body">
        <div class="row">
          @if(Session::get('failed'))
          <div class="alert alert-danger" role="alert">
            {{Session::get('failed')}}
          </div>
          @endif
          @if(Session::get('success'))
          <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
          </div>
          @endif
        <form method="POST" action="{{route('admininsertaccount')}}" enctype="multipart/form-data">
          @csrf
          {{-- //start form here -----------------------------------------------------------------------------------}}
            <div class="col-md-11 mb-3">
              <div class="form-group">
                <label for="idnoid" class="form-label">Id NO</label>
                <input type="text" id="idnoid" placeholder="Enter ID Number" class="form-control @error('idno') is-invalid @enderror"  
                name="idno" value="{{ old('idno') }}">
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
                <input type="text"  id="titleid" placeholder="Enter Your Title" class="form-control @error('title') is-invalid @enderror"
                 name="title" value="{{ old('title') }}">
      
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
            </div>

          <div class="col-md-11 mb-3">
            <div class="form-group">
              <label for="fullnameid" class="form-label">Full Name</label>
              <input type="text" id="firstname" placeholder="Enter user name upto grandfather name" class="form-control @error('fullname') is-invalid @enderror"  name="fullname" 
              value="{{ old('fullname')}}">
    
              @error('fullname')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              </div>
          </div>

          <div class="col-md-11 mb-3">
              <div class="form-group">
                <label for="usernameid" class="form-label">Username</label>
                <input type="text" id="usernameid" placeholder="Enter Member's Father Name"  class="form-control @error('username') is-invalid @enderror"  name="username" 
                value="{{  old('username')}}">
      
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
          </div>
          <div class="col-md-11 mb-3">
            <div class="form-group">
              <label for="newpasswordid" class="form-label">New Password</label>
              <input type="text" id="newpasswordid" placeholder="Enter Member's Father Name"  class="form-control @error('newpassword') is-invalid @enderror"  name="newpassword" 
              value="{{  old('newpassword')}}">
    
              @error('newpassword')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
        </div>
        <div class="col-md-11 mb-3">
          <div class="form-group">
            <label for="confirmpasswordid" class="form-label">Confirm Password</label>
            <input type="text" id="confirmpasswordid" placeholder="Enter Member's Father Name"  class="form-control @error('confirmpassword') is-invalid @enderror"  name="confirmpassword" 
            value="{{  old('confirmpassword')}}">
  
            @error('confirmpassword')
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
                     class="form-control @error('email') is-invalid @enderror"  name="email" value="{{old('email')}}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
        </div>


          <div class="col-md-11 mb-3">
            <div class="form-group">
              <label class="form-label">User Profile</label>
              <input type="file" id="profileid" class="form-control @error('profile') is-invalid @enderror" 
               name="profile"  style="display: none" onchange="changeimage(event)">
              <label for="profileid" class="form-control" style="white-space: nowrap;overflow: hidden; text-overflow: ellipsis"><i class="bi bi-image"></i> Select Profile
              <span style="color: green;" id="spanfilenameid">{{ old('profile')}}</span></label>
               @error('profile')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              <div class="alert alert-success text-center" role="alert">
                <img src="{{url('asset/images/nophoto.png')}}" class="rounded-circle" alt="Member Profile"
                style="width:160px;height:160px;" id="profile_img">
                 </div>
              </div>
        </div>
    
        <div class="col-md-11 mb-3">
          <div class="form-group">
            <label for="roleid" class="form-label">Role</label>
            <select type="text" id="roleid" class="form-control @error('role') is-invalid @enderror"  onchange="selectrole()" name="role">
              @if (old('role'))
              <option value="{{old('role')}}" selected>{{old('role')}}</option>
              @else
              <option value="" selected>Select Role</option>
              <option value="0" >Generic User</option>
              <option value="1">Admin User</option>
              @endif
            </select>
            @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </div>

            {{-- ------------------------------- --}}
<!-- ///////////////////////////////////////////////////////////// --> 
<div class="col-md-11 mb-3"> 
  <div class="form-group"> 
  <label class="form-label" >Types of Role</label> 
  <br> 
    <div class="form-check form-check-inline"> 
      <input class="form-check-input" type="checkbox" id="createid"   
         class="form-control @error('create') is-invalid @enderror"  name="create" value="1" disabled> 
        @error('create') 
            <span class="invalid-feedback" role="alert"> 
                <strong>{{ $message }}</strong> 
            </span> 
        @enderror 
      <label class="form-label" for="createid"> 
        Create 
      </label> 
    </div> 
    <!-- //////////////////for edit///////////////// --> 
    <div class="form-check form-check-inline"> 
      <input class="form-check-input" type="checkbox" id="editid" class="form-control @error('edit') is-invalid @enderror" 
       name="edit" value="1"> 
      @error('edit') 
            <span class="invalid-feedback" role="alert"> 
                <strong>{{ $message }}</strong> 
            </span> 
        @enderror 
      <label class="form-label" for="editid">Edit</label> 
    </div> 
    <!-- ////////for badge////////////// --> 
    <div class="form-check form-check-inline"> 
      <input class="form-check-input" type="checkbox" id="badgeid"   
         class="form-control @error('badge') is-invalid @enderror"  name="badge" value="1"> 
        @error('badge') 
            <span class="invalid-feedback" role="alert"> 
                <strong>{{ $message }}</strong> 
            </span> 
        @enderror 
      <label class="form-label" for="badgeid"> 
        Badge Prepare 
      </label> 
    </div> 
     
    <!-- ////////for search////////////// --> 
    <div class="form-check form-check-inline"> 
      <input class="form-check-input" type="checkbox" id="searchid"   
         class="form-control @error('search') is-invalid @enderror"  name="search" value="1" checked disabled> 
        @error('search') 
            <span class="invalid-feedback" role="alert"> 
                <strong>{{ $message }}</strong> 
            </span> 
        @enderror 
      <label class="form-label" for="searchid"> 
        Search 
      </label> 
    </div> 
    <!-- ////////for delete////////////// --> 
    <div class="form-check form-check-inline"> 
      <input class="form-check-input" tabindex="1" type="checkbox" id="deleteid"   
         class="form-control @error('delete') is-invalid @enderror"  name="delete" value="1" disabled> 
        @error('delete') 
            <span class="invalid-feedback" role="alert"> 
                <strong>{{ $message }}</strong> 
            </span> 
        @enderror 
      <label class="form-label" for="deleteid"> 
        Delete 
      </label> 
    </div> 
  </div> 
</div> 
<!-- //////////////////////////////////////////////////////////// --> 
<div class="col-md-11"> 
  <div class="form-group"> 
    <label class="form-label" style="visibility: hidden;">Create</label> 
    <button type="submit" class="form-control btn" style="background-color: #0b2c4b; text-align: center; color: white;">Create</button> 
  </div></div>
            {{-- -------------------------------------------- --}}

        </form>
        </div>
      </div>
      </div>  {{-- end of card div --}}
          @endif
     </div>{{-- end of column div --}}
    </div>{{-- end of row div --}}
  </div>{{-- end of container div  --}}
  <script>
    function changeimage(event){
         var image=document.getElementById('profile_img');
        image.src=URL.createObjectURL(event.target.files[0]);
        document.getElementById("spanfilenameid").innerHTML=document.getElementById('profileid').files[0].name;
    }
</script>
<script>
function selectrole(){
  var role=document.getElementById("roleid").value;
  if(role=="0"){
    document.getElementById("createid").checked=false;
    document.getElementById("deleteid").checked=false;
  } 
  if(role=="1"){
    document.getElementById("createid").checked=true;
    document.getElementById("deleteid").checked=true;
  }

    }  
</script>
@endsection
