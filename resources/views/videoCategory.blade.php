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
	<h4 style = "text-align:center;color:blue">Create Tutorial</h4>
	<br>
	<!--<div class = "video">
		<video id = "thumbnail" class = "" width='320' style = "margin-left:110px" data-full="{{asset($video ?? '')}}" controls autoplay>
		<source class="video-box" src="{{ asset($video ?? '') }}" type="video/mp4"/>
		</video>action="{{ url('/createTutorial') }}"
	</div>-->
        <div class = "center">
            <form style="margin-top:2.5%;" method = "POST" action = "{{ url('/createTutorial')}}">
                @csrf
                <!-- box for Tutorial Title-->
                <div class="form-outline mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tutorial Title</label>
                    <input type="text" class="form-control form-control-lg"
                           id="title" aria-describedby="title" name = "title" placeholder="Enter the tutorial title"
			   required>
                </div>

		
                    <!-- box for Number of steps-->
                    <div class="form-outline mb-3">
                    <label for="exampleInputPassword1" class="form-label">Number of Tutorial Steps</label>
                    <input type="text" class="form-control form-control-lg"
                           id="numSteps" name = "numSteps" placeholder = "Number of Steps in tutorial" required>
		    <br>
                        <!-- the paragraph under password if the admin forgot their passwords-->
                    <!--<p class="text-center h6">Click <a href="{{url('/adminreset')}}">here</a> to reset your password
                    </p>-->

                        <!-- sign in button-->
                    <div class="col-md-12 text-center">
                    <button class="btn btn-danger btn-lg btn-block">Proceed</button>
                    </div>

                </div>
            </form>
	</div>
		<!--<div class = "footer">
		<footer>
			    <p>Special Olympics PEI<br>
			    <p>Project Partner: University of Prince Edward Island</p>
		</footer>
		</div>-->
	
	@section('end-body-scripts')
	    {{-- All ajax related scripts should be moved to the end-body-scripts section --}}
	    <script src="{{ asset('/javascript/create_quiz.js') }}"></script>
	    <script type="text/javascript" src="{{ URL::asset('javascript/admin_create_quiz.js') }}"></script>
	@endsection
	
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
	</div>
		{{-- <script>
		document.getElementById("username").setAttribute('size', '20');
		</script> --}}
	</html>