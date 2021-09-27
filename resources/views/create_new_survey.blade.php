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
    <link rel="stylesheet" href="{{ URL::asset('css/admin_create_quiz.css')}}">

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
    <!-- the body has the content of the page  -->
    <body style="margin-top: 1cm; margin-left: -2cm; overflow-x: hidden">
    <section class="container-fluid">
        @isset($message)
            <p class="alert alert-info" style="text-align:center; margin-top: -1cm; margin-left: 200px; width: 91%">{{ $message}}</p>
    @endisset


    <!-- the title in the top  -->
        
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

<h4 style = "text-align:center;color:blue">Create Survey</h4>
            
            <div class = "center">
            <form style="margin-top:2.5%;" method = "POST" action = "{{ url('/addsurvey')}}">
                @csrf
                <!-- box for email-->
                <div class="form-outline mb-3">
                    <label class="col-sm-9 col-form-label">Survey Name</label>
                    <input type="text" class="form-control shadow-sm" name="SurveyName"
                               Placeholder="Enter the Name of your Survey" required>
                </div>
                    <!-- box for password-->
                    <div class="form-outline mb-3">
                        <!-- the paragraph under password if the admin forgot their passwords-->
                    <!--<p class="text-center h6">Click <a href="{{url('/adminreset')}}">here</a> to reset your password.-->

                        <!-- Create button-->
                    <div class="col-md-12 text-center">
                    <button class="btn btn-danger btn-lg btn-block">Create</button>
                    </div>

                </div>
            </form>
        </div>
        </div>

    </section>
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
