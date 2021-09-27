<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1,   shrink-to-fit=no">
<title>Tutorial Steps</title>
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

<h4 style = "text-align:center;color:black">Hello {{$name ?? 'unknown'}}</h4>
<h6 style = "text-align:center;color:black">Here are the steps for your tutorial</h6>
 <!--<p><a class="text-dark nav-link active" aria-current="page"
        href="{{ url('/logout')}}"><img src="{{asset('assets/images/key.png')}}" width="25"
         height="25" class="d-inline-block align-right"> Logout</a>
    </p>-->
    
@forelse($steps as $step)
<video id = "thumbnail" class = "" width='320' style = "margin-left:110px" data-full="{{ asset($step->video ?? '') }}" controls autoplay>
	<source class="video-box" src="{{ asset($step->video ?? '') }}" type="video/mp4"/>
</video>

<p> 
	#{{$step->step_number ?? '?'}}: {{$step->script ?? ' '}}
</p>
@empty
<p> 
	There are no steps for this tutorial at the moment.
</p>
@endforelse

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
