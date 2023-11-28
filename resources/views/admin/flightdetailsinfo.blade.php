@extends('admin.admin_app')

@section('title', 'Member Flights Connformation ')
@section('content')
    <div class="container" id="printflight">
        <div class="printline line"
            style="width:100%; padding:0;margin: 0;display: flex;align-items: center;justify-content: center;column-gap:50px;">
            <div style="display:flex;flex-direction:column">
                <img src="{{ url('asset/images/eapcco1.jpg') }}" alt="EAPCCO Logo" title="EAPCCO Logo" style="border-radius:50%"
                    width="100px">
                <h4>EAPCCO General Assembly </h4>
            </div>
            <div style="border-left:3px solid green;height:100px"></div>
            <div style="display:flex;flex-direction:column">
                <img src="{{ url('asset/images/emblem.jpg') }}" alt="EAPCCO Logo" title="EAPCCO Logo"
                    style="border-radius:50%" width="100px">
                <h4> Ababa ,Ethiopia November 2022</h4>
            </div>
        </div>
        <div
            style="border:1px solid green;background-color: #008000 !important;text-align:center;padding:5px;padding-top:7px;margin:0">
            <h3>Departure Flight Confirmation Information</h3>
        </div>
        <p style="font-size:18px;">In order to finalize transport arrangement for
            an Ethiopian airport, Please
            confirm your
            flight details below.
            Please complete this form and return to the General Assembly Information Desk located
            in
            the main entrance of the
            conference hall </p>
        <div>
            <input type="text" value="Last Name : {{ $person->lastname }}"
                style="  font-weight:bold; width: 100%;padding: 12px;border: 1px solid #ccc; 
            border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 0px;
            resize: vertical">
            <input type="text" value="First Name: {{ $person->firstname }}"
                style="font-weight:bold; width: 100%;padding: 12px;border: 1px solid #ccc; 
        border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 0px;
        resize: vertical">
            <input type="text" value="Middle Name: {{ $person->secondname }}"
                style="font-weight:bold; width: 100%;padding: 12px;border: 1px solid #ccc; 
        border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 0px;
        resize: vertical">
            <input type="text" value="Country/Organization : {{ $person->countrycode }}"
                style="  font-weight:bold; width: 100%;padding: 12px;border: 1px solid #ccc; 
            border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 0px;
            resize: vertical">
            <input type="text" value="Hotel : {{ $flight->hotelname }}"
                style="  font-weight:bold; width: 100%;padding: 12px;border: 1px solid #ccc; 
            border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 0px;
            resize: vertical">
            <input type="text" value="Room Number : {{ $flight->roomno }}"
                style="  font-weight:bold; width: 100%;padding: 12px;border: 1px solid #ccc; 
            border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 0px;
            resize: vertical">
            <input type="text" value="Departure Date : {{ $flight->departdate }}"
                style="  font-weight:bold; width: 100%;padding: 12px;border: 1px solid #ccc; 
            border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 0px;
            resize: vertical">
            <input type="text" value="Flight Number : {{ $flight->flightnum }}"
                style="  font-weight:bold; width: 100%;padding: 12px;border: 1px solid #ccc; 
            border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 0px;
            resize: vertical">
            <input type="text" value="Flight Time : {{ $flight->flighttime }}"
                style="  font-weight:bold; width: 100%;padding: 12px;border: 1px solid #ccc; 
            border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 0px;
            resize: vertical">
            <input type="text" value="Contact Cell Phone : {{ $flight->telephone }}"
                style="  font-weight:bold; width: 100%;padding: 12px;border: 1px solid #ccc; 
            border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 0px;
            resize: vertical">
        </div>
        <div style="text-align: center">
            <p>Transport will organized by Ethiopian Federal police Organizing Committee.</p>
            <p> Thank You! From Organizing Committee</p>
        </div>
    </div>
    <div style="text-align: center"><button class="btn btn-primary"
            onclick="pringflight('{{ $person->firstname }}','{{ $person->lastname }}')">Print</button>
    </div>
    <script>
        function pringflight(firstname, lastname) {
            var printContents = document.getElementById("printflight").innerHTML;
            var title = document.title;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            document.title = firstname + "_" + lastname;
            window.print();
            document.title = title;
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
