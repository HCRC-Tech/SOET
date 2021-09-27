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
<h4 style = "text-align:center">Question Deletion Confirmation</h4>
<h5 style = "text-align:center;color:blue">Survey Name:{{$name}}</h5>
</head>

{{-- <div style=" margin-top:1cm; margin-left:8%">
    <h2 style="color:seagreen; text-align:center;">Deletion Confirmation</h2>
    <p class="text-center h4">{{$name}} Survey</p>
</div> --}}

<div style="width: 1200px; margin-left:-8%; margin-top: 20px"  class="shadow-lg p-3 mb-5 bg-white rounded">

    <form method="get" action="{{url('/editSurvey/recreate')}}">
        @csrf
        <input type="hidden" id="SurveyName" name="name" value="{{$name}}">
        <input type="hidden" id="SurveyName" name="message" value="Deletion Cancelled">

        <input type="image" name="imgbtn" style="margin-left: 1207px; margin-top: -19px; width: 50px; height: 50px"
               src="{{asset('assets/images/cancelRed.png')}}"  alt="Tool Tip">
    </form>

    <form name="surveyForm" method="post" action="{{url('/delete')}}" style="margin-left: 0px">
    <br style="line-height:100;">

    @csrf
    <input type="hidden" id="SurveyName" name="SurveyName" value="{{$name}}">
    <input type="hidden" id="QuestionIndex" name="QuestionIndex" value="{{$questionIndex}}">

        @foreach ($questions as $q)
            <p class="h5"> {{str_replace("|",".",$q["Text"])}}</p> <!--Display the question-->

            @if ( $q["Type"]  == "DropDown")
                <select name="{{$q["Text"]}}">

                    <!--iterate over the options-->
                    @foreach(explode(",",$q['PossibleResponses']) as $option)
                        <div  class="btn btn-secondary dropdown-toggle" style=" margin-left: 310px">
                            <option value="{{$option}}">{{$option}}</option>
                        </div>
                    @endforeach
                    <br>
                </select>
                <br> <br>

            @elseif ($q["Type"]  == "Checkbox")

            <div style="width:60em;overflow-x: auto;white-space: nowrap;">

                @foreach(explode(",",$q['PossibleResponses']) as $option)
                    <input class="form-check-input" type="checkbox" name="{{$q["Text"]}}[]" value="{{$option}}" checked>
                        <label class="form-check form-check-inline">{{$option}}</label>

                @endforeach
            </div>
                <br>
                <br> <br>

            @elseif ($q["Type"]  == "RadioButtons")

            <div style="width:60em;overflow-x: auto;white-space: nowrap;">
                @foreach(explode(",",$q['PossibleResponses']) as $option)
                    <input type="radio" name="{{$q["Text"]}}" value="{{$option}}" checked>
                        <label>{{$option}}</label>&nbsp;&nbsp;&nbsp;
                @endforeach
            </div>

                <br>
                <br> <br>

            @elseif ($q["Type"]  == "Text")
                    <input type="text" name="{{$q["Text"]}}"><br>
                <br>
                <br> <br>

            @elseif ($q["Type"]  == "FreeText")
                <div class="mb-3">
                    <div class="form-check form-check-inline" style=" margin-left: -10px">
                        <textarea class="form-control" name="{{$q["Text"]}}" rows="3" cols="300"></textarea>
                    </div>
                </div>
                <br> <br>

            @endif
            <p class="double"></p>

        @endforeach

        <h4 style="text-align:center; margin-left: -100px">Deletion Confirmation</h4>
        <p style="text-align:center; color:red; font-size: 15pt; margin-left: -100px">Caution: this cannot be undone</p>


        <input class="form-check-input" type="checkbox" name="Confirmation" value="True">
                        <label style = "color:blue" class="form-check form-check-inline">I confirm deletion of the above question.</label>

        <div style=" height: 4cm;">
            <button style="width: 5cm; margin-left: 40%; margin-top:2cm; " type="submit"
                    class="btn btn-danger">Confirm
            </button>
        </div>
        </form>
</div>
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
