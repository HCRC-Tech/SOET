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
    <body>


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
<hr><!-- this page is for the admin to login where they are going to put their email and password -->
<h4 style = "text-align:center">Fill Survey</h4>
<h5 style="text-align:center;color:blue">Survey Name: {{$name}}</h5>
<p style="text-align:center; color:red">Please fill out the form correctly and press Submit</p>
</head>

<div id="wrapper">
    <body>

    <form name="surveyForm" method="post" action="{{route('/adminform')}}" enctype="multipart/form-data" style="margin-left: 0px">
        <br style="line-height:100;">

        @csrf
        <input type="hidden" id="surveyname" name="surveyname" value="{{$name}}">

        <div style="width: 1270px; margin-left:-0.1%; " class="shadow-lg p-3 mb-5 bg-white rounded">
            <label class="h6" for="username" style="font-size: 18px">Participant's Username: </label> <input type="username" id="username"
                                                                                  name="username" size="35" style="margin-left: 10px" required>

            <br><br>

            <p class="double"></p>

            @foreach ($questions as $q)
                <p class="h4" style="font-size: 18px"> {{str_replace("|",".",$q["Text"])}}</p> <!--Display the question-->

                @if ( $q["Type"]  == "DropDown")
                    <select name="{{$q["Text"]}}">

                        <!--iterate over the options-->
                        @foreach(explode(",",$q['PossibleResponses']) as $option)
                            <div  class="btn btn-secondary dropdown-toggle" style=" margin-left: 310px">
                                <option value="{{$option}}">{{$option}}</option>
                            </div>
                        @endforeach
                    </select>
                    <br> <br>

                @elseif ($q["Type"]  == "Checkbox")

                    <div style="width:77em;word-wrap: break-word">
                        {{--                <input class="form-check-input" type="checkbox" name="{{$q["Text"]}}[]" value="Prefer not to answer" checked>--}}
                        {{--                <label class="form-check form-check-inline">Prefer not to answer</label>--}}

                        @foreach(explode(",",$q['PossibleResponses']) as $option)
                            <label class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="{{$q["Text"]}}[]" value="{{$option}}"> {{$option}}</label>

                        @endforeach
                    </div>
                    <br>

                @elseif ($q["Type"]  == "RadioButtons")

                    <div style="width:77em;word-wrap: break-word">
                        {{--                <input type="radio" name="{{$q["Text"]}}" value="Prefer not to answer" checked>--}}
                        {{--                        <label>Prefer not to answer</label>&nbsp;&nbsp;&nbsp;--}}
                        @foreach(explode(",",$q['PossibleResponses']) as $option)
                            <label><input type="radio" name="{{$q["Text"]}}" value="{{$option}}"> {{$option}}</label>&nbsp;&nbsp;&nbsp;
                        @endforeach
                    </div>
                    <br>

                @elseif ($q["Type"]  == "Text")
                    <input type="text" name="{{$q["Text"]}}">
                    <br>

                @elseif ($q["Type"]  == "FreeText")
                    <div class="mb-3">
                        <div class="form-check form-check-inline" style=" margin-left: -10px">
                            <textarea class="form-control" name="{{$q["Text"]}}" rows="3" cols="300"></textarea>
                        </div>
                    </div>
                    <br>

                @endif
                <p class="double"></p>

            @endforeach

            <div style=" height: 3cm; margin-left: 1.5cm">
                <button style="width: 3cm; margin-left: 40%; margin-top:-2cm; " type="submit"
                        class="btn btn-danger">Submit
                </button>
            </div>
        </div> 
    </form>

    <footer class="text-center text-white" style="background-color:white;">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    
    <div class="container">
    <div class="row">
    <div class = "col col-lg-2">
        <img style= "margin-top:-1.5cm" src="{{asset('assets/images/SOP.png')}}" width="200">
    </div>

    <div class = "col">
        <img style= "margin-top:-1.5cm" src="{{asset('assets/images/upei.png')}}" width="200">
    </div>
</div>
</div>
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a
        class="btn btn-primary btn-floating m-1"
        style="background-color:white;"
        onclick="location.href='{{route('/adminlogin')}}'"
        role="button"
        ><i class=""></i
      ></a>
    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color:#147228 ">
    © 2021 Copyright:
    <a class="text-white" href="https://projects.upei.ca/hcrc/">UPEI Health Centred Research Clinic</a>
  </div>
  <!-- Copyright -->
</footer>
</body>
    
</div>

</html>
