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
<hr>

<div class="container">
      <button style='width: 3.5cm;margin-left:1050px' class='btn btn-danger' onclick="location.href='{{route('/logout')}}'"      
      type="button"><span><img
        src="{{asset('assets/images/logout.png')}}" width="25" height="25"
        class="d-inline-block align-right">Logout</span>
      </button>
</div>

<h4 style = "text-align:center;color:blue">Edit Survey</h4>
<p style = "text-align:center;color:red">Survey Name: {{$name}}
</head>
<!-- the body has the content of the page  -->

    <body>
    <!-- the Dashboard of the page that has different options-->

    <!-- an example on how to add or remove survey questions-->

    <div style="width: 1200px; margin-left:-10%; " class="shadow-lg p-3 mb-5 bg-white rounded">

        @foreach ($questions as $q)
            <form name="deleteQuestion" method="post" action="{{url('/deletion-confirmation')}}"
                  enctype="multipart/form-data" style="margin-left: 0px">
                @csrf
                <input type="hidden" id="SurveyName" name="SurveyName" value="{{$name}}">
                <input type="hidden" id="QuestionIndex" name="QuestionIndex" value="{{$loop->iteration}}">
                <div>
{{--                    <button type="submit" style="width: 25px; height: 24px;"><img--}}
{{--                            style="margin-left: -7px; margin-top: -11px" width="22" height="22"--}}
{{--                            src="{{asset('assets/images/redX.png')}}">--}}
{{--                    </button>--}}

                    <input type="image" name="imgbtn" style="width: 25px; height: 24px;"
                           src="{{asset('assets/images/x.png')}}">

                </div>
            </form>

            <p class="h6" style="font-size: 18px"> {{$loop->index+1}}) {{str_replace("|",".",$q["Text"])}}</p>
            <!--Display the question-->

            @if ( $q["Type"]  == "DropDown")
                <select name="{{$q["Text"]}}">

                    <!--iterate over the options-->
                    @foreach(explode(",",$q['PossibleResponses']) as $option)
                        <div class="btn btn-secondary dropdown-toggle" style=" margin-left: 310px">
                            <option value="{{$option}}">{{$option}}</option>
                        </div>
                    @endforeach
                </select>
                <br> <br>

            @elseif ($q["Type"]  == "Checkbox")

                <div style="width:77em;word-wrap: break-word">

                @foreach(explode(",",$q['PossibleResponses']) as $option)
                        <label class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="{{$q["Text"]}}[]" value="{{$option}}"> {{$option}}</label>

                    @endforeach
                </div>
                <br>

            @elseif ($q["Type"]  == "RadioButtons")

                <div style="width:77em;word-wrap: break-word">

                    @foreach(explode(",",$q['PossibleResponses']) as $option)
                        <label><input type="radio" name="{{$q["Text"]}}" value="{{$option}}" checked> {{$option}}</label>&nbsp;&nbsp;&nbsp;
                    @endforeach
                </div>
                <br>

            @elseif ($q["Type"]  == "Text")
                <input type="text" name="{{$q["Text"]}}"> <br>

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
    </div>
    <div style="margin:15%; margin-top:2% ;">
        <form name="addQuestion" method="post" action="{{url('/addQuestion')}}" enctype="multipart/form-data"
              style="margin-left: 0px">
            @csrf
            <input type="hidden" id="SurveyName" name="SurveyName" value="{{$name}}">
            <br>
            <p style="margin-left: 45%;" class="h5">Add Question:</p>
            <!-- question position in a survey-->
            <label for="input" style=" width: 220px" class="col-sm-2 col-form-label">New Question Number:</label>
            <input type="number" style=" width: 100px; margin-left: -20px" class=" shadow  bg-body rounded" id="qNumber"
                   name="qNumber"
                   min="1" max="{{(count($questions) + 1)}}" required>

            <!-- question type in a survey-->
            <br><label for="input" style=" width: 200px" class="col-sm-2 col-form-label">Question Type:</label>
            <select style=" width: 200px" class="shadow  bg-body rounded" id="qType" name="qType">
                <option value="FreeText" selected>FreeText</option>
                <option value="DropDown">DropDown</option>
                <option value="Checkbox">Checkbox</option>
                <option value="RadioButtons">RadioButtons</option>
            </select>
            <div style="width: 400px; margin-left:70%; margin-top:-8%; height: 20px;">
                <!--  text of the question that needs to be added in a survey-->
                <label for="input" style=" width: 200px" class="col-sm-2 col-form-label">Question text:</label>
                <div class="form-floating">
                    <!-- text area-->
                    <textarea style="height: 2cm; " class="shadow-sm form-control" placeholder=""
                              id="qText" name="qText" required></textarea>
                </div>
                <!-- how the answer of the question would be-->
                <br><label for="input" style=" width: 500px" class="col-sm-2 col-form-label">Question Responses (If
                    required. Separate with commas, No Spaces)</label>
                <div class="form-floating">
                    <!-- text area-->
                    <textarea style="height: 2cm; " class="shadow-sm form-control"
                              id="qResponses" name="qResponses"></textarea>
                </div>
            </div>
    </div>
    <!-- a submit button-->
    <div style=" height: 4cm;">
        <button style="width: 5cm; margin-left: 40%; margin-top:1cm; " type="submit"
                class="btn btn-danger btn-lg btn-block">Save
        </button>
    </div>
    </form>
</div>

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
</html>
