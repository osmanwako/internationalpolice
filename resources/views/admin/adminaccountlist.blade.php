@extends('admin.admin_app')

@section('title', 'Admin View Member list')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          @if (Auth::guard('admin')->check())
            <div class="table-responsive">
                <div class="table-header-flex">
                <span class="header-flex"> Account List</span>
                <span class="header-flex">
                  <a href="{{route('admincreateaccount')}}" class="btn btn-md btn-success">
                    Create Account
                  </a>
                </span>    
                </div>
                @if(isset($accountlist))
                    <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID No_</th>
                                <th scope="col">Title</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Email</th>
                                 <th>
                                    Action
                                 </th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($accountlist as $account)
                                <tr>
                                    <td scope="col">{{ $loop->index+1 }}</td>
                                    <td scope="col">{{ $account->idno }}</td>
                                    <td scope="col">{{ $account->title }}</td>
                                    <td scope="col">{{ $account->fullname }}</td>
                                    <td scope="col">{{ $account->username }}</td>
                                    <td scope="col">{{ $account->email }}</td>
                                     {{-- <td>
                                        <div class="dropdown">
                                            <button class="btn btn-link" type="button" id="memberoptionid" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="memberoptionid">
                                                <li><a class="dropdown-item" href="{{route('adminmemberedit',$member->id)}}">Edit</a></li>
                                                <li>
                                                  <button type="button" class="dropdown-item btn btn-link" data-bs-toggle="modal" data-bs-target="#memberdeletemodal{{$member->id}}">
                                                    Delete
                                                  </button>  
                                                </li>
                                            </ul>
                                            <div class="modal fade" id="memberdeletemodal{{$member->id}}" tabindex="-1" aria-labelledby="memberdeletemodalLabel{{$member->id}}" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Member</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                    Are you sure to delete <strong>{{$account->fullname}}</strong>?
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                                                    <form action="{{route("adminmemberdelete")}}" method="POST">
                                                      @csrf
                                                    <button type="submit" class="btn btn-primary" name="id" value="{{$member->id}}">Yes</button>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          @endif
                                          </div>
                                     </td> --}}
                                  </tr>
                                  @endforeach
                            </tbody>
                          </table>
                          @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
