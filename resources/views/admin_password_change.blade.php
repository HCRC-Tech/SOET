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

<h4 style = "text-align:center; color:blue">Change Password</h4>
<p style = "text-align:center;color:red">Change your current password</p>
        <!--the form where Admin have to change the password-->
            <form onSubmit="return checkPassword(this)" method="POST" action="{{ url('/passwordchangeadminsave')}}"
                  style="margin-left: -60px">
            @csrf
            <!-- the box for current password-->
                <div style="width: 550px; margin-left:15cm; margin-top:0.5%">
                    <div class="mb-7 row">
                        <label for="inputFirstName" class="col-sm-4 col-form-label">Current Password: </label>
                        <div class="col-sm-5">
                            <input type="password" style="width:7cm"
                                   class="form-control shadow-lg p-2 mb-3 bg-white rounded"
                                   id="curpass" name="currentpass" required>
                        </div>
                    </div>
                    <!-- the box for new password-->
                    <div class="mb-7 row">
                        <label for="inputFirstName" class="col-sm-4 col-form-label">New Password: </label>
                        <div class="col-sm-5">
                            <input type="password" style="width:7cm"
                                   class="form-control shadow-lg p-2 mb-3 bg-white rounded"
                                   id="pass1" name="password" pattern="^[A-Za-z\d@$!%*+-:,;.?&~/\()=_]{6,}$"
                                   title="Password must include at least 6 characters" required>
                        </div>
                    </div>
                    <!-- the box for new password conformation -->
                    <div class="mb-7 row">
                        <label for="inputFirstName" class="col-sm-4 col-form-label">Confirm New Password: </label>
                        <div class="col-sm-5">
                            <input type="password" style="width:7cm"
                                   class="form-control shadow-lg p-2 mb-3 bg-white rounded"
                                   id="pass2" name="password2" required>
                        </div>
                    </div>
                </div>
                <!-- the panel where the rule of the password creation should achieve-->
            {{--     <div class="card panel-body shadow p-3"--}}
            {{--          style="width: 25rem;height: 15rem;;margin-left: 29cm; margin-top: -6cm;">--}}
            {{--         <div class="card-body">--}}
            {{--             <h6 class="card-subtitle mb-2 text-muted">Password needs to be between 6 and 20 characters</h6>--}}
            {{--             <br><br>--}}
            {{--             <h6 class="card-subtitle mb-2 text-muted">Password Must Contain:</h6>--}}
            {{--             <h6 class="card-subtitle mb-2 text-muted">-At least 1 Uppercase Letter</h6>--}}
            {{--             <h6 class="card-subtitle mb-2 text-muted">-At least 1 Lowercase Letter</h6>--}}
            {{--             <h6 class="card-subtitle mb-2 text-muted">-At least 1 Number</h6>--}}
            {{--         </div>--}}
            {{--     </div>--}}
            {{--     <br><br>--}}
            <!-- the submit button-->
                <div style="margin-left:20cm; margin-top:-1cm">
                    <button class="btn btn-danger btn-lg btn-block"
                            style="width: 200px; margin-top: 1cm; margin-left: 1cm">Change
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
</div>
</html>
