@extends('admin.admin_app')
@section('title', 'Admin Badge prepare')

@section('content')
    <div id="printbothbadge" class="d-none">
        <img src="" id="frontbadgeimageid" width="100%" height="100%">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <canvas id="frontbagdecanvas" width="415" height="660" style="border:1px solid #000000;">
                </canvas>
            </div>
            <div class="col-md-4 text-center">
                <table style="width: 100%">
                    <tr id="trid1">
                        <td>
                            <select class="form-control" onchange="membertype(this.value)">
                                <option value="Delegations">Delegations</option>
                                <option value="Coordinator">Coordinator</option>
                                <option value="Participant">Participant</option>
                                <option value="Protocol">Protocol</option>
                                <option value="Protocol Head">Protocol Head</option>
                                <option value="Medical Service">Medical Service</option>
                                <option value="Driver">Driver</option>
                                <option value="VIP Driver">VIP Driver</option>
                                <option value="Invited Midea">Invited Midea</option>
                                <option value="Midea Coordinator">Midea Coordinator</option>
                                <option value="Midea Head">Midea Head</option>
                                <option value="Delegation Head">Delegation Head</option>
                            </select>
                        </td>
                        <td style="width: 10%"><button class="btn btn-primary" onclick="printbadge()">Print</button></td>
                        <td style="width: 10%"><button class="btn btn-xm btn-primary"
                                onclick="trdisplay('trid2','trid1')"><i class="bi bi-display"></i></button>
                        </td>
                    </tr>
                    <tr id="trid2" style="display: none">
                        <td><input type="text" value="" class="form-control" id="newtypeid"></td>
                        <td style="width: 10%"><button class="btn btn-primary" onclick="inputnewtype()">add</button></td>
                        <td style="width: 10%"><button class="btn btn-primary"
                                onclick="trdisplay('trid1','trid2')">Cancel</button></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            var type = "{{ $membtype }}".toUpperCase();
            createbadge(type);
        };

        function createbadge(membtype) {
            var frontcanvas = document.getElementById("frontbagdecanvas").getContext("2d");
            frontcanvas.reset();
            var frontimage = new Image();
            var profileimage = new Image();
            var bothareloaded = false;
            var fullname = "{{ $badge->lastname }} {{ $badge->firstname }} {{ $badge->secondname }} ".toUpperCase();
            var title = "{{ $badge->title }}".toUpperCase();
            var country = "{{ $badge->countrycode }}".toUpperCase();

            frontimage.onload = function() {
                if (bothareloaded) {
                    loadbadge();
                } else {
                    bothareloaded = true;
                }
            };
            profileimage.onload = function() {
                if (bothareloaded) {
                    loadbadge();
                } else {
                    bothareloaded = true;
                }
            };

            function loadbadge() {
                frontcanvas.drawImage(frontimage, 4, 4, 415, 650);

                frontcanvas.lineWidth = 1;
                frontcanvas.arc(220, 292, 115, 0, Math.PI * 2, true); // you can use any shape
                frontcanvas.stroke();
                frontcanvas.textAlign = "center";

                frontcanvas.font = "italic bold 20px Arial";
                frontcanvas.fillStyle = "#fff";
                frontcanvas.fillText(fullname, 200, 455);

                frontcanvas.font = "Italic normal 15px Arial";
                frontcanvas.fillStyle = "#fff";
                frontcanvas.fillText(title, 200, 495);

                frontcanvas.font = "italic bold 15px Arial";
                frontcanvas.fillStyle = "#fff";
                frontcanvas.fillText(country, 200, 550);

                frontcanvas.font = "italic bold 30px Arial";
                frontcanvas.fillStyle = "#000";
                frontcanvas.fillText(membtype, 200, 630);

                frontcanvas.clip();
                frontcanvas.drawImage(profileimage, 107, 182, 223, 222);
            }
            profileimage.src = "{{ url('storage/image/profile/member/' . $badge->profile) }}";
            frontimage.src = "{{ url('asset/images/badge/frontbadge.jpg') }}";
        }

        function membertype(type) {
            type = type.toUpperCase();
            createbadge(type);
        }

        function inputnewtype() {
            var type = document.getElementById("newtypeid").value.toUpperCase();
            createbadge(type);
            trdisplay("trid1", "trid2");
        }

        function trdisplay(idone, idtwo) {
            document.getElementById(idone).style.display = "";
            document.getElementById(idtwo).style.display = "none";
        }
    </script>
    <script>
        function printbadge() {

            var frontbadgecanvas = document.getElementById("frontbagdecanvas").toDataURL("image/jpeg",
                1.0);
            var frontbadgeimage = document.getElementById("frontbadgeimageid");
            frontbadgeimage.onload = function() {
                createpdf();
            };
            frontbadgeimage.src = frontbadgecanvas;
        }

        function createpdf() {
            var printContents = document.getElementById("printbothbadge").innerHTML;
            var title = document.title;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            document.title = "{{ $badge->firstname }} {{ $badge->lastname }}";
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection
