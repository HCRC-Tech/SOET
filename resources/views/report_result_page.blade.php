<!DOCTYPE html>
<html>
<head>
    <title>Report Result</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css')}}"
          rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin-reset_password.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/report_result_page.css')}}">

    <style>
        table, th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            white-space:normal;
            font-size: 13px;
        }

        #wrapper {
            margin-left: auto;
            margin-right: auto;
            width: 1519px;
        }

        body{
            overflow: hidden;
        }

    </style>
    <!--
    <script src="{{ URL::asset('https://kit.fontawesome.com/a076d05399.js') }}" crossorigin='anonymous'></script>
    -->
</head>
<div id="wrapper">
    <body>

    <section class="container-fluid" style="margin-top: 1cm">

        <!--The page header -->
        <div id="wrapper">


<div class="row justify-content-center">
	<h3 style="text-align:center;background-color:red; color:white">SOET</h3>
	<p style="text-align:center;color:#C53838"><strong>Special Olympics Eduation Tool</strong></p>
<hr>
            <p class="text-center h2" style="margin-top: 0px; margin-right: -95px; color: blue">Report Result</p>


            <div class="cent" style="top: 450px; width:100em;overflow-x: auto;white-space: nowrap; margin-left: -350px; margin-top: -5.8cm; margin-bottom: 10px">
                <table>
                    <tr>
                        <th><div style="width: 130px">Name</div></th>
                        <th>Username</th>
                        <th style="width:100px">Date Completed</th>

                    @foreach ($questions as $q)
                            <th style = "min-width: 300px; max-width: 300px;">{{$q["Text"]}}</th>
                        @endforeach
                    </tr>


                    @foreach ($username as $p)
                        <tr>
                            <td>{{ $names[$loop->index] }}</td>
                            <td>{{ $username[$loop->index] }}</td>
                            <td>{{ $dates[$loop->index] }}</td>

                        @foreach ($questions as $q)
                                @if(array_key_exists($q['Text'],$responses[$loop->parent->index]))
                                    <td>{{$responses[$loop->parent->index][$q['Text']]}}</td>
                                @else
                                    <td>N/A</td>

                                @endif
                            @endforeach
                        </tr>
                    @endforeach

                </table>
            </div>
            <div>
            <form method="post" action="{{route('/report/download')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="fileName" value="{{$fileName}}">
                <button style="width: 4cm; margin-left: 70%; margin-top: -70px; "
                        class="btn btn-danger btn-lg btn-block"><img
                            src="{{asset('assets/images/save.png')}}" width="25" height="25"
                            class="d-inline-block align-right" style="margin-left: -10px">Save</button>

            </form>
        </div>

        </div>

    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
            integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
            integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
            crossorigin="anonymous"></script>

            
    </body>
</div>
</html>

