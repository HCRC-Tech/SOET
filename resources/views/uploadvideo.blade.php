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
<div class="container">
      <button style='width: 3.5cm;margin-left:1050px' class='btn btn-danger' onclick="location.href='{{route('/logout')}}'"      
      type="button"><span><img
        src="{{asset('assets/images/logout.png')}}" width="25" height="25"
        class="d-inline-block align-right">Logout</span>
      </button>
</div>

<h5 style = "text-align:center;color:blue">Tutorial Name: {{$tutorialName ?? 'Unknown'}},  Total Number of Steps: {{$numSteps ?? '?'}}</h5>


<br>
<h6 style = "text-align:center;color:blue">Upload: Step No:{{ $stepNumber ?? '?'}}</h6>
<div class = "video">
<video id = "thumbnail" class = "" width='320' style = "margin-left:110px" data-full="{{ asset($path ?? '') }}" controls autoplay>
	<source class="video-box" src="{{ asset($path ?? '') }}" type="video/mp4"/>
</video>

</div>
<div class = "formfield" style = "margin-top:-150px">
<form method="POST" action="{{ url('/uploadVideo') }}" enctype="multipart/form-data">
{{ csrf_field() }}
<div class = "center">
	<label for="story">Scripts:</label>
	<textarea id="form16" name = "script" class="md-textarea form-control" rows="3">
                {{$script ?? ' '}}
	</textarea>
</div>
<br><br>
<!--- 
	<div class = "center" style = "margin-top:-150px">
	<label>Title</label>
	<input class = "input" type="text" name="title" placeholder="Video Title">
  <br><br>
 -->
  <br>
  <div style = "margin-left:160px; margin-top:-30px">
	<div class ="custom-file">
	<div class=" row justify-content-center">
	<input type="file" class="custom-file-input" name="video" id="video-upload" accept="video/mp4,video/mpeg,video/x-matroska" onchange="updateVideoLabel();">
	<label class="custom-file-label" for="video" id="file-label" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
	@if($path ?? '')
		<!--- If path isn't null, then there is already a video so a new video will replace the old one -->
		Change File
	@else
		Choose File
	@endif
	</label>
	</div>
	</div>
</div>
  
  <!--- State Information -->
  <div class = "center">
      <input type="hidden" name="tutorialID" value="{{$tutorialID ?? ''}}">
	  
      <input type="hidden" name="stepID" value="{{$stepID ?? ''}}">
	  
      <input type="hidden" name="stepNumber" value="{{$stepNumber ?? ''}}">
	  
	  <!--- for debugging -->
      <input type="hidden" name="tutorialName" value="{{$tutorialName ?? ''}}">
      <input type="hidden" name="numSteps" value="{{$numSteps ?? ''}}">
  </div>
	
	
	<div class = "center">
		<input type="submit" name="upload_button" value="Upload" class="btn btn-danger" id="upload-button">
	</div>
	@if($path ?? '')
    <input type="hidden" name="path" value="{{$path ?? ''}}">
		@if(($stepNumber ?? '') && ($numSteps ?? '') && $stepNumber == $numSteps)
	<div class = "center">
		<input type="submit" name="next_button" value="Finish" class="btn btn-danger" id="next-button">
	</div>
		@else
	<div class = "center">
		<input type="submit" name="next_button" value="Next" class="btn btn-danger" id="next-button">
	</div>
		@endif
	@endif
  </form>


  <!--Another form--->
    
    <!--<div class = "center">
        <button onclick="location.href='{{route('/uploadVideoPage')}}'">
          Next
        </button>
    </div>-->


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
    ?? 2021 Copyright:
    <a class="text-white" href="https://projects.upei.ca/hcrc/">UPEI Health Centred Research Clinic</a>
  </div>
  <!-- Copyright -->
</footer>
</body>
</div>
</html>