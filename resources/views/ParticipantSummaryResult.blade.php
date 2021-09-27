<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1,   shrink-to-fit=no">
<title>Special Olympics</title>
 <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css')}}"
          rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
          crossorigin="anonymous">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin_dashboard_page.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin-reset_password.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/buttons.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/admin_create_quiz.css') }}">

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   <!--
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    -->
    <!--Get your own code at fontawesome.com
        Here is the link to find all the important icons
    https://www.w3schools.com/icons/icons_reference.asp
    -->
    <style>
        #wrapper {
            margin-left: auto;
            margin-right: auto;
            width: 1519px;
        }
    </style>
</head>

<div id="wrapper">
    <section class="container-fluid">

        @if(Session::has('message'))
            <p class="alert alert-info" style="text-align:center; width:94%; margin-left:110px">{{ Session::get('message') }}</p>
        @endif

        <!--<div style="margin-left: 10px">
            <p class="text-center h1" style="color:red;margin-left: 4cm; margin-top: 2%">SOET</p>
            <p class="text-center h6" style="color:#CB2B46;margin-left:2cm; margin-top:1.5">Special Olympics Education Tool</p>

            <p class="text-center h4" style="margin-left: 4cm;margin-top: 5%; text-align:center">Choose your Credential </p> -->

<div class="row justify-content-center">
	<h3 style="text-align:center;background-color:red; color:white">SOET</h3>
	<p style="text-align:center;color:#C53838"><strong>Special Olympics Eduation Tool</strong></p>
<hr>

<div class="container">
      <button style='width: 3.5cm;margin-left:1050px' class='btn btn-danger' onclick="location.href='{{route('/report/create')}}'"      
      type="button"><span><img
        src="{{asset('assets/images/download.png')}}" width="25" height="25"
        class="d-inline-block align-right">Download</span>
      </button>
</div>

<div id="wrapper">

    <!-- the body has the content of the page  -->
    <body>

    <!-- the title in the top  -->
    <div style=" margin-top:0.5%; margin-left:35%">
        <p style = "color:blue"class="h5">Summary for Participant: {{$Summary['FirstName']}} {{$Summary['LastName']}}</p>
    </div>
    <div style=" margin-left:17%; margin-top:3%;">
        <!-- text box -->
        <h2 class="form-control shadow-lg" style="margin-top:0.3cm;width: 7cm;"
            id="exampleFormControlInput1"><strong>First Name: </strong>{{$Summary['FirstName']}}</h2>

        <h2 class="form-control shadow-lg" style="margin-top:0.3cm;width: 7cm;"
            id="exampleFormControlInput1"><strong>Last Name: </strong>{{$Summary['LastName']}}</h2>

        <h2 class="form-control shadow-lg" style="margin-top:0.3cm;width: 7cm;"
            id="exampleFormControlInput1"><strong>Username: </strong>{{$Summary['username']}}</h2>

        <h2 class="form-control shadow-lg" style="margin-top:0.3cm;width: 7cm;"
            id="exampleFormControlInput1"><strong>Date of Birth: </strong>{{$Summary['DOB']}}</h2>

        <h2 class="form-control shadow-lg" style="margin-top:0.3cm;width: 7cm;"
            id="exampleFormControlInput1"><strong>Gender: </strong>{{$Summary['Gender']}}</h2>

        {{-- <h2 class="form-control shadow-lg" style="margin-top:0.3cm;width: 7cm;"
            id="exampleFormControlInput4"><strong>Condition: </strong>{{$Summary['Condition']}}</h2> --}}

        {{-- @isset($medications)
            <h2 class="form-control shadow-lg" style="margin-top:0.3cm;width: 7cm;"
                id="exampleFormControlInput4"><strong>Medication: </strong>{{$medications}}</h2>
        @endisset --}}


        <!--<div style="margin-left:25%;margin-top: -300px">-->
            <!-- card that have an image and text box to show the weight -->
            {{-- <div class="card" style="width: 17rem;height: 16rem;">
                <div class="rounded mx-auto d-block">
                    <!-- Image in the middle of the card -->
                    <img src="{{asset('assets/images/Scale.png')}}" class="card-img-top" alt="Scale"
                         style="width: 4cm;height: 4cm;margin-top:0.5cm;">
                </div> --}}
                <!-- the text box and the label n the card -->
                {{-- <div class="card-body shadow-lg p-3 mb-5 bg-body rounded2">
                    <div class="mb-1 row">
                        <label for="inputLastName" class="col-sm-5 col-form-label "
                               style="margin-top:0.3cm;">Weight (lb):</label>
                        <!-- text box -->
                        <div class="col-sm-3">
                            <h2 type="text" class="form-control shadow-lg" style="margin-top:0.3cm; width: 150%;"
                                id="exampleFormControlInput4">{{$Summary['Weight']}}</h2>
                        </div>
                    </div>
                </div> --}}
            <!--</div>
        </div>-->

        <div style="margin-left: 55%; margin-top:-255px;">
            <!-- card that have an image and text box to show the height -->
            {{-- <div class="card" style="width: 17rem;height: 16rem;">
                <div class="rounded mx-auto d-block">
                    <!-- Image in the middle of the card -->
                    <img src="{{asset('assets/images/Meter.png')}}" class="card-img-top" alt="Scale"
                         style="width: 4cm;height: 4cm;margin-top:0.5cm;">
                </div> --}}

                <!-- the two text boxes and the label n the card -->
                {{-- <div class="shadow-lg p-3 mb-5 bg-body rounded card-body">
                    <div class="mb-1 row">
                        <label for="inputLastName" class="col-sm-6 col-form-label "
                               style="margin-top:0.3cm;">Height (cm):</label>

                        <div class="col-sm-3">
                            <h2 type="text" class="form-control shadow-lg" style="margin-top:0.3cm; width: 150%;"
                                id="exampleFormControlInput4">{{$Summary['Height']}} </h2>

                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Area to show the Surveys -->
    <div style="margin-left:15%; margin-top:290px; margin-bottom: -20px">
       @isset($responses)
            <h4 style=" text-align:center;margin-left: -40%;margin-bottom:10px;color:blue">Submitted Surveys</h4>
            <table>
                <tr>
                    <th>Survey Name</th>
                    <th>Date Completed</th>
                    <th style="width:50%">Responses</th>
                </tr>

                @forelse($names as $p)
                    <tr>
                        <td>{{ $names[$loop->index] }}</td>
                        <td>{{ $dates[$loop->index] }}</td>

                        <td ><form method="post" action="{{route('/preview')}}" enctype="multipart/form-data">
                            @csrf
                                <input type="hidden" name="participant" value="{{$Summary['FirstName']}} {{$Summary['LastName']}}">
                                <input type="hidden" name="responses" value="{{ json_encode($responses[$loop->index],TRUE)}}">
                                <input type="hidden" name="name" value="{{ $names[$loop->index] }}">
                                <input type="hidden" name="date" value="{{ $dates[$loop->index] }}">
                                <input type="hidden" name="username" value="{{ $Summary['username'] }}">

                                <button class="btn btn-danger" type="submit" style="padding: 5px 10px"><span>View Survey</span></button>
                            </form>

                        </td>
                    </tr>
                @empty
                    Theere are no survey data to shows.  
                @endforelse
            </table>
             <hr>
            <h4 style="  text-align: center; margin-left: -40%; margin-bottom: 10px">Tutorial Data</h4>
            <table>

                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Tutorial Name</th>
                    <th>Times Accessed</th>
                    <th style="width:30%">Time Spent Watching(Seconds)</th>
                </tr>
                 @forelse($tutorialNames as $tutorial_id => $tutorialName)
                    <tr>
                        <td>{{$Summary['FirstName']}}</td>
                        <td>{{$Summary['LastName']}}</td>
                        <td>{{ $tutorialName }}</td>
                        <td>{{ $counts[$tutorial_id] }}</td>
                        <td>{{ $tutorialTimes[$tutorial_id] }}</td>
                    </tr>
                @empty
                    Theere are no tutorials data to shows.  
                @endforelse
            </table>
            <div class="container">
      <form method="post" action="{{route('/download')}}" enctype="multipart/form-data">
                            @csrf
                                <input type="hidden" name="fileName" value="{{$fileName}}">

            <button class="btn btn-danger" type="submit" style="padding: 5px 10px; margin-left:850px;margin-top:-5cm">
                
                <img src="{{asset('assets/images/download.png')}}" width="25" height="25">Download</span></button>
    </form>
      </div>
        @endisset
    </div>
</body>
</div>

</html>
