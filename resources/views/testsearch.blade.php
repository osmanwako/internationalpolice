<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EAPCCO | @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('asset/style/css/custom.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container mt-3">
        <h2>Filterable List</h2>
        <p>Type something in the input field to search the list for specific items:</p>
        <input class="form-control" id="intblsearch" type="text" placeholder="Search.." onkeyup="getdata(event)">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody id="tablebody">
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        function getdata(event) {
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
</body>

</html>
