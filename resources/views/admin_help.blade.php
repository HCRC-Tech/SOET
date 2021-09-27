<!DOCTYPE html>
<html>
<head>
    <title>Admin Help</title>
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css')}}"
          rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin-reset_password.css')}}">

<!--
    <script src="{{ URL::asset('https://kit.fontawesome.com/a076d05399.js') }}" crossorigin='anonymous'></script>
    -->

    <style>
        [type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        [type=radio] + img {
            cursor: pointer;
        }

        [type=radio]:checked + img {
            outline: 2px solid #f00;
        }

        li {
            list-style-type: circle;
            display: list-item
        }

        #wrapper {
            margin-left: auto;
            margin-right: auto;
            width: 1519px;
        }

        body {
            overflow: initial;
        }
    </style>

</head>

<div id="wrapper">
    <body style="margin-top: 1cm">
    <div style="margin-left:8.5%">

    <div class="row justify-content-center">
	<h3 style="text-align:center;background-color:red; color:white">SOET</h3>
	<p style="text-align:center;color:#C53838"><strong>Special Olympics Eduation Tool</strong></p>

<div class="container">
      <button style='width: 3.5cm;margin-left:1175px;margin-top:-1.5cm' class='btn btn-danger' onclick="location.href='{{route('/logout')}}'"      
      type="button"><span><img
        src="{{asset('assets/images/logout.png')}}" width="25" height="25"
        class="d-inline-block align-right">Logout</span>
      </button>
</div>

        <hr size = "6" noshade>
        <h2 style="text-align:center; color:blue">Admin Help Information</h2>
        <br>
         
   
        <div>

            <ul class="list-group" style="margin-left: 100px">
        <center>
                <li><a href="#create">Upload Tutorial</a></li>
                <li><a href="#modify">Add Participant</a></li>
                <li><a href="#delete">Create Survey</a></li>
                <li><a href="#add">Reset Password</a></li>
                <li><a href="#survey">Edit Survey</a></li>
                <li><a href="#generate">Fill Survey</a></li>
                <li><a href="#profile">Participant Password Reset</a></li>
                <li><a href="#registerAdmin">Create Admin</a></li>
                <li><a href="#changePassword">Add Caregiver</a></li>
                <li><a href="#accept">View Participant</a></li>
                <li><a href="#password">Notification</a></li>
        </center>
            </ul>
            <br>
            <hr size = "6" noshade>

            <div style="margin-left: 100px">

                <h4 style="margin-top: 30px; color:blue" id="create">Upload Tutorial</h4><br>
                <h6>
                    Instructions:
                </h6>
                <br><br>

                <h4 style="margin-top: 30px; color:blue" id="modify">Add Participant</h4><br>
                <h6>
                    Instructions: <br><br>

                    
                </h6>
                <br><br>

                <h4 style="margin-top: 30px; color:blue" id="delete">Create Survey</h4><br>
                <h6>

                    Instructions:
                    <br><br>
                   
                </h6>
                <br><br>

                <h4 style="margin-top: 30px; color:blue" id="add">Reset Password</h4><br>
                <h6>

                    Instructions: <br><br>

                </h6>
                <br><br>

                <h4 style="margin-top: 30px; color:blue" id="survey">Edit Survey</h4><br>
                <h6>
                    Instructions:
                </h6>
                <br><br>

                <h4 style="margin-top: 30px; color:blue" id="generate">Fill Survey</h4><br>
                <h6>
                    Instructions:
                </h6>
                <br><br>

                <h4 style="margin-top: 30px; color:blue" id="profile">Participant Password Reset</h4><br>
                <h6>
                    Instructions:
                </h6>
                <br><br>

                <h4 style="margin-top: 30px; color:blue" id="registerAdmin">Create Admin</h4><br>
                <h6>
                    Instructions:
                </h6>
                <br><br>

                <h4 style="margin-top: 30px; color:blue" id="changePassword">Add Caregiver</h4><br>
                <h6>
                    Instructions:
                </h6>
                <br><br>

                <h4 style="margin-top: 30px; color:blue" id="accept">View Participant</h4><br>
                <h6>

                    <!--Accepting new patient instruction-->
                    Instructions: <br><br>

                    
                </h6>
                <br><br>

                <h4 style="margin-top: 30px; color:blue" id="password">Notification</h4><br>
                <h6>

                    Instructions:<br><br>

                </h6>
                <br>
            </div>
        </div>
    </div>

    
    <div style="margin-left: 300px; position:absolute; top:205px">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
                integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
                integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
                crossorigin="anonymous"></script>

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

</div></html>
