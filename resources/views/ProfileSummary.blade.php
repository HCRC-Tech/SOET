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
<h4 style = "text-align:center;color:blue;">Participant Data Search</h4>
<p style = "text-align:center;color:red;">Search for a participant to view data</p>    

<form method="post" action="{{route('/profilereport')}}" enctype="multipart/form-data"
          style="width: 600px; margin-left:15%; margin-top:1.5%">
    @csrf
    <!-- Text box for a patient email that admins will look for -->
        <div class="mb-3 row">
            <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control shadow p-2  bg-body rounded" name="inputUsername" required>
                <div style="margin-left:110%; margin-top:-9.5%; width: 150Px">
                    <button style="width: 200px;" type="submit" class="btn btn-danger btn-lg btn-block">Search 
                    </button>
                </div>
            </div>
        </div>
    </form>
    <!-- Text box for a patient first name that admins will look for -->
    {{-- <div id="wrapper">
        <h5 style = "text-align:center;color:red">Search By Participant Name (Optional)</h5>
        <br>
    <div> --}}
    
    <form method="post" action="{{route('/profilereportName')}}" enctype="multipart/form-data"
          style="width: 455px; margin-left:15%; margin-top: 1.5cm">
        @csrf
        <h5 style = "text-align:center;color:blue;margin-left:-230%;margin-top:2cm">Search By Participant Name (Optional)</h5>
        <hr style="text-align:center;margin-left:-250%;width: 1500px;border: 1px solid green">

        <div style ="width:455px; margin-left:-190%; margin-top: 1cm" class="mb-3 row">
            <label for="inputFirstName" class="col-sm-2 col-form-label">First Name </label>
            <div class="col-sm-10">
                <input type="text" class="form-control shadow p-2  bg-body rounded" name="inputFirstName">
                {{-- <div style="margin-left:130%; margin-top:-7%; margin-down: -7% width: 150Px">
                    <button style="width: 100px;" type="submit" class="btn btn-danger btn-lg btn-block">Search
                    </button>
                </div> --}}
            </div>
        </div>
        <!-- Text box for a last first name that admins will look for -->
        <div style ="width:455px; margin-left:-190%; margin-top: 0cm" class="mb-3 row">
            <label for="inputLastName" class="col-sm-2 col-form-label ">Last Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control shadow p-2  bg-body rounded" name="inputLastName">
            </div>
        </div>

        <div style="margin-left:-80%; margin-top:-7%;width: 150Px">
                    <button style="width: 100px;" type="submit" class="btn btn-danger btn-lg btn-block">Search
                    </button>
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
