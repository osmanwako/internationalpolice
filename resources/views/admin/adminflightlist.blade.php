@extends('admin.admin_app')

@section('title', 'View All Flight list')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (Auth::guard('admin')->check())
                    <div class="table-responsive">
                        <div class="table-header-flex">
                            <span class="header-flex">EAPCCO General Assembly Flight List</span>
                        </div>
                        @if (isset($memberflightlist))
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ID No_</th>
                                        <th scope="col">Hotel Name</th>
                                        <th scope="col">Room Number</th>
                                        <th scope="col">Departure Date</th>
                                        <th scope="col">Flight Number</th>
                                        <th scope="col">Flight Time</th>
                                        <th scope="col">Flight Type</th>
                                        <th scope="col">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($memberflightlist as $flightlist)
                                        <tr>
                                            <td scope="col">{{ $loop->index + 1 }}</td>
                                            <td scope="col">{{ $flightlist->idno }}</td>
                                            <td scope="col">{{ $flightlist->hotelname }}</td>
                                            <td scope="col">{{ $flightlist->roomno }}</td>
                                            <td scope="col">{{ $flightlist->departdate }}</td>
                                            <td scope="col">{{ $flightlist->flightnum }}</td>
                                            <td scope="col">{{ $flightlist->flighttime }}</td>
                                            {{-- <td scope="col">{{ $flightlist->telephone }}</td> --}}
                                            <td scope="col">{{ $flightlist->flighttype }}</td>
                                            <td scope="col">
                                                <a href="{{ route('flightdetailsinfo', $flightlist->id) }}">
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        {{-- </a> --}}
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Modal -->

                        @endif
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
