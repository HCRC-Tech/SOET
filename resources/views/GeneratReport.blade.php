<!-- this page that when admin need to generate a report for patients -->

<!DOCTYPE html>
<html>
    <?php echo
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header('Content-Type: text/html');?>
<!-- the head has the title of the page and the link for Bootstrap Framework and the link for the css file  -->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Generate Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/cssFile.css')}}">
    <style>
        #wrapper {
            margin-left: auto;
            margin-right: auto;
            width: 1519px;
        }
    </style>
</head>
<!-- the body has the content of the page  -->
<div id="wrapper">
    <body style="margin-top: 1cm">
    <!-- the navigation bar in the top-->


    @if(isset($message))
        <p class="alert alert-info" style="text-align:center; margin-top: -1cm; margin-left: 130px">{{ $message}}</p>
    @endif

    <div class="row justify-content-center">
        <h3 style="text-align:center;background-color:red; color:white">SOET</h3>
        <p style="text-align:center;color:#C53838"><strong>Special Olympics Eduation Tool</strong></p>
    <hr>

    <!-- the title in the top middle of the page -->
    <div style=" margin-left:8%">
        <p class="text-center h2 "style="color:blue">Generate Report</p>
    </div>

    <form name="surveyForm" method="post" action="{{route('/report')}}" enctype="multipart/form-data">
    @csrf
    <!-- the item to collect the report-->
        <div style=" margin-left:38%; margin-top:3%;">
            <div class="panel panel-default">
                <div style="width: 500px;margin-bottom: 1cm;" class="panel-body shadow p-3">

                    <div class="container">
            <br>
            <!-- choose what survey PREMS or PROMS-->
            <p class="h6">Survey Desired:</p>
            <select class="shadow  bg-body rounded" aria-label="Default select example" name="surveyName">
                @foreach ($surveys as $s)
                    <option value="{{$s}}">{{$s}}</option>
                @endforeach
            </select>
            <br> <br>
            <br>
            <!-- choose Gender form-->
            <p class="h6">Gender:</p>
            <div class="form-check form-check-inline">
                <label><input type="radio" name="gender" value="all" checked> Any</label>
            </div>
            <div class="form-check form-check-inline">
                <label><input type="radio" name="gender" value="male"> Male</label>
            </div>
            <div class="form-check form-check-inline">
                <label><input type="radio" name="gender" value="female"> Female</label>
            </div>
            <br>

            <br>
            <!-- choose Age form-->
            <p class="h6">Age:</p>
            <input type="radio" name="age" value="all" checked>All<br>
            <br><input type="radio" name="age" value="above"> Above: <input type="text" class="shadow  bg-body rounded"
                                                                            name="ageAbove" style="width: 50px ">
            <br><br><input type="radio" name="age" value="below"> Below: <input type="text"
                                                                                class="shadow  bg-body rounded"
                                                                                name="ageBelow"
                                                                                style="width: 50px "/><br>
            <br><input type="radio" name="age" value="equals"> Equals: <input type="text"
                                                                              class="shadow  bg-body rounded"
                                                                              name="ageEquals" style="width: 50px"/><br>

            <br>
            <!-- Panel that has the Medications that patients are taken-->
            <div class="panel panel-default">
                <div style="width: 330px;margin-right: 35px;" class="panel-body shadow p-3">

                    <div class="container">
                        <div style="max-width:300px; overflow-x:auto; whitespace:nowrap;">


                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                        <button style="width: 5cm; margin-bottom:.5cm;margin-top:1cm; " type="submit"
                    class="btn btn-danger btn-lg btn-block">Submit
            </button>
            </div>
                        </div>
                    </div>
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
