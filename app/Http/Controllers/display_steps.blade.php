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
<h4 style = "text-align:center;color:blue">Hello {{$name ?? 'unknown'}}</h4>
<h6 style = "text-align:center;color:blue">Here are the steps for your tutorial</h6>
 <!--<p><a class="text-dark nav-link active" aria-current="page"
        href="{{ url('/logout')}}"><img src="{{asset('assets/images/key.png')}}" width="25"
         height="25" class="d-inline-block align-right"> Logout</a>
    </p>-->
    
@forelse($steps as $step)

<div class = "parentDiv">
  <video controls width="250" id = "step_video_{{$step->step_number ?? ''}}" class = "" width='320' style = "margin-left:110px" data-full="{{ asset($step->video ?? '') }}" controls>
	  <source class="video-box" src="{{ asset($step->video ?? '') }}" type="video/mp4"/>
  </video>
</div>

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

<script>
	//let vid;
	
	async function sendInteraction(type, now, delta, event_count, session_count, step_id, tutorial_id, video_id, path, meta_data) {
		const rawResponse = await fetch('{{route('/tutorialData')}}',
			{
				method: 'POST',
				headers: {
					'Accept': 'tutorialData/json',
					'Content-Type': 'tutorialData/json'
				},
				body: JSON.stringify({ 
					session_count: session_count,
					event_number: event_count,
					tutorial_id: tutorial_id,
					step_id: step_id,
					event_type: type,
					video_path: path,
					user_time: Math.floor(now/1000),
					username:"{{$username}}",
					time_spent: Math.floor(delta/1000),
					metaData: meta_data,
					"_token":"{{ csrf_token() }}" }
				)
			}
		);

		//const content = await rawResponse.json();
		//console.log(content);
	}

	@forelse($steps as $step)
	(async () => {
		const rawResponse = await fetch('{{route('/tutorialData')}}',
			{
				method: 'POST',
				headers: {
					'Accept': 'tutorialData/json',
					'Content-Type': 'tutorialData/json'
				},
				body: JSON.stringify({
					tutorial_id: {{$step->tutorial_id}},
					step_id: {{$step->id}},
					event_type: 'page_load',
					video_path: "{{$step->video}}",
					user_time: Math.floor(Date.now()/1000),
					username:"{{$username}}",
					metaData: {
						video_id:"step_video_{{$step->step_number ?? ''}}"
					},
					"_token":"{{ csrf_token() }}" }
				)
			}
		);//*/

		//const content = await rawResponse.json();
		//console.log(content);
	})();
	
	// TODO look into https://www.w3schools.com/tags/av_prop_played.asp

	let vid_{{$step->step_number ?? ' '}} = document.getElementById("step_video_{{$step->step_number ?? ''}}");
	
	// Event documentation:
	// https://www.w3schools.com/tags/ref_av_dom.asp
	
	// Variables used to calculate time_spent / time_delta for each video
	let last_start_{{$step->step_number ?? '_'}} = 0;
	let last_end_{{$step->step_number ?? '_'}} = 0;
	let suspended_{{$step->step_number ?? '_'}} = 0;
	
	// For counting events for extra help with ordering
	let event_count_{{$step->step_number ?? '_'}} = 0;
	
	function sendTimedEvent_{{$step->step_number ?? '_'}}(function_now, last_time, type, session_counter, meta_data) {
		return () => {
			var event_count = event_count_{{$step->step_number ?? '_'}};
			event_count_{{$step->step_number ?? '_'}} += 1;
			var session_count = session_counter();
			
			//last_start_{{$step->step_number ?? '_'}} = function_now; // for time_spent in other functions
			let time_delta = function_now - last_time;
			if (suspended_{{$step->step_number ?? '_'}} > 0) { time_delta -= function_now - suspended_{{$step->step_number ?? '_'}}; } // try to subtract off time suspended, experimental
			suspended_{{$step->step_number ?? '_'}} = 0; // no longer suspended
			//if (time_delta < 0) { time_delta = 0 }
			
			console.log("Video #{{$step->step_number ?? '?'}} event="+type);

			sendInteraction(type, function_now, time_delta, event_count, session_count, {{$step->id}}, {{$step->tutorial_id}}, "{{$step->video}}", "step_video_{{$step->step_number ?? ''}}", meta_data);
		};
	}
	
	function makeOnStart_{{$step->step_number ?? '_'}}(type, session_counter, meta_data) {
		return () => {
			var function_now = last_start_{{$step->step_number ?? '_'}} = Date.now();
			
			sendTimedEvent_{{$step->step_number ?? '_'}}(function_now, last_end_{{$step->step_number ?? '_'}}, type, session_count, meta_data);
		};
	}
	
	function makeOnEnd_{{$step->step_number ?? '_'}}(type, session_counter, meta_data) {
		return () => {
			var function_now = last_end_{{$step->step_number ?? '_'}} = Date.now();
			
			sendTimedEvent_{{$step->step_number ?? '_'}}(function_now, last_start_{{$step->step_number ?? '_'}}, type, session_count, meta_data);
		};
	}
	
	function makeOnContinue_{{$step->step_number ?? '_'}}(type, session_counter, meta_data) {
		return () => {
			var function_now = Date.now();
			
			sendTimedEvent_{{$step->step_number ?? '_'}}(function_now, last_start_{{$step->step_number ?? '_'}}, type, session_count, meta_data);
		};
	}
	
	// Function to listen for 'play' events for the current step's video
	// https://www.w3schools.com/tags/av_event_play.asp
	let session_count_{{$step->step_number ?? '_'}}_play = 0;
	vid_{{$step->step_number ?? '_'}}.onplay = makeOnStart_{{$step->step_number ?? '_'}}('play',
		() => {
			var temp = session_count_{{$step->step_number ?? '_'}}_play;
			session_count_{{$step->step_number ?? '_'}}_play += 1;
			return temp;
		},
		{
			video_id: "step_video_{{$step->step_number ?? ''}}",
			autoplay: vid_{{$step->step_number ?? '_'}}.autoplay,
			muted: vid_{{$step->step_number ?? '_'}}.muted
		});
	
	// Function to listen for 'playing' events for the current step's video
	// https://www.w3schools.com/tags/av_event_playing.asp
	let session_count_{{$step->step_number ?? '_'}}_playing = 0;
	vid_{{$step->step_number ?? '_'}}.onplaying = makeOnStart_{{$step->step_number ?? '_'}}('playing',
		() => {
			var temp = session_count_{{$step->step_number ?? '_'}}_playing;
			session_count_{{$step->step_number ?? '_'}}_playing += 1;
			return temp;
		},
		{
			video_id: "step_video_{{$step->step_number ?? ''}}",
			muted: vid_{{$step->step_number ?? '_'}}.muted
		});
	
	// Function to listen for 'pause' events for the current step's video
	// https://www.w3schools.com/tags/av_event_pause.asp
	let session_count_{{$step->step_number ?? '_'}}_pause = 0;
	vid_{{$step->step_number ?? '_'}}.onpause = makeOnEnd_{{$step->step_number ?? '_'}}('pause',
		() => {
			var temp = session_count_{{$step->step_number ?? '_'}}_pause;
			session_count_{{$step->step_number ?? '_'}}_pause += 1;
			return temp;
		},
		{
			video_id: "step_video_{{$step->step_number ?? ''}}",
			played_data: vid_{{$step->step_number ?? '_'}}.played,
			muted: vid_{{$step->step_number ?? '_'}}.muted,
			suspend_count: session_count_{{$step->step_number ?? '_'}}_suspend
		});
	
	// Function to listen for 'ended' events for the current step's video
	// https://www.w3schools.com/tags/av_event_ended.asp
	let session_count_{{$step->step_number ?? '_'}}_ended = 0;
	vid_{{$step->step_number ?? '_'}}.onended = makeOnEnd_{{$step->step_number ?? '_'}}('ended',
		() => {
			var temp = session_count_{{$step->step_number ?? '_'}}_ended;
			session_count_{{$step->step_number ?? '_'}}_ended += 1;
			return temp;
		},
		{
			video_id: "step_video_{{$step->step_number ?? ''}}",
			played_data: vid_{{$step->step_number ?? '_'}}.played,
			muted: vid_{{$step->step_number ?? '_'}}.muted,
			suspend_count: session_count_{{$step->step_number ?? '_'}}_suspend
		});
	
	// Function to listen for 'abort' events for the current step's video
	// https://www.w3schools.com/tags/av_event_abort.asp
	let session_count_{{$step->step_number ?? '_'}}_abort = 0;
	vid_{{$step->step_number ?? '_'}}.onabort = makeOnEnd_{{$step->step_number ?? '_'}}('abort',
		() => {
			var temp = session_count_{{$step->step_number ?? '_'}}_abort;
			session_count_{{$step->step_number ?? '_'}}_abort += 1;
			return temp;
		},
		{
			video_id: "step_video_{{$step->step_number ?? ''}}",
			played_data: vid_{{$step->step_number ?? '_'}}.played,
			muted: vid_{{$step->step_number ?? '_'}}.muted
		});
	
	// Function to listen for 'error' events for the current step's video
	// https://www.w3schools.com/tags/av_event_error.asp
	let session_count_{{$step->step_number ?? '_'}}_error = 0;
	vid_{{$step->step_number ?? '_'}}.onerror = makeOnEnd_{{$step->step_number ?? '_'}}('error',
		() => {
			var temp = session_count_{{$step->step_number ?? '_'}}_error;
			session_count_{{$step->step_number ?? '_'}}_error += 1;
			return temp;
		},
		{
			video_id: "step_video_{{$step->step_number ?? ''}}",
			played_data: vid_{{$step->step_number ?? '_'}}.played,
			error: vid_{{$step->step_number ?? '_'}}.error
		});
		
	// Function to listen for 'stalled' events for the current step's video
	// https://www.w3schools.com/tags/av_event_stalled.asp
	let session_count_{{$step->step_number ?? '_'}}_stalled = 0;
	vid_{{$step->step_number ?? '_'}}.onstalled = makeOnEnd_{{$step->step_number ?? '_'}}('stalled',
		() => {
			var temp = session_count_{{$step->step_number ?? '_'}}_stalled;
			session_count_{{$step->step_number ?? '_'}}_stalled += 1;
			return temp;
		},
		{
			video_id: "step_video_{{$step->step_number ?? ''}}",
			played_data: vid_{{$step->step_number ?? '_'}}.played,
			error: vid_{{$step->step_number ?? '_'}}.muted
		});
	
	// Function to listen for 'seeking' events for the current step's video
	// https://www.w3schools.com/tags/av_event_seeking.asp
	let session_count_{{$step->step_number ?? '_'}}_seeking = 0;
	vid_{{$step->step_number ?? '_'}}.onseeking = makeOnEnd_{{$step->step_number ?? '_'}}('seeking',
		() => {
			var temp = session_count_{{$step->step_number ?? '_'}}_seeking;
			session_count_{{$step->step_number ?? '_'}}_seeking += 1;
			return temp;
		},
		{
			video_id: "step_video_{{$step->step_number ?? ''}}",
			error: vid_{{$step->step_number ?? '_'}}.muted
		});
	
	// Function to listen for 'seeked' events for the current step's video
	// https://www.w3schools.com/tags/av_event_seeked.asp
	let session_count_{{$step->step_number ?? '_'}}_seeked = 0;
	vid_{{$step->step_number ?? '_'}}.onseeked = makeOnStart_{{$step->step_number ?? '_'}}('seeked',
		() => {
			var temp = session_count_{{$step->step_number ?? '_'}}_seeked;
			session_count_{{$step->step_number ?? '_'}}_seeked += 1;
			return temp;
		},
		{
			video_id: "step_video_{{$step->step_number ?? ''}}",
			muted: vid_{{$step->step_number ?? '_'}}.muted
		});
	
	// Function to listen for 'waiting' events for the current step's video
	// https://www.w3schools.com/tags/av_event_waiting.asp
	let session_count_{{$step->step_number ?? '_'}}_waiting = 0;
	vid_{{$step->step_number ?? '_'}}.onwaiting = makeOnEnd_{{$step->step_number ?? '_'}}('waiting',
		() => {
			var temp = session_count_{{$step->step_number ?? '_'}}_waiting;
			session_count_{{$step->step_number ?? '_'}}_waiting += 1;
			return temp;
		},
		{
			video_id: "step_video_{{$step->step_number ?? ''}}",
			error: vid_{{$step->step_number ?? '_'}}.muted
		});
		
		
		
	
	// Function to listen for 'suspend' events for the current step's video
	// https://www.w3schools.com/tags/av_event_suspend.asp
	let session_count_{{$step->step_number ?? '_'}}_suspend = 0;
	vid_{{$step->step_number ?? '_'}}.onsuspend = function() {
		var function_now = Date.now();
		if (suspended_{{$step->step_number ?? '_'}} === 0) { suspended_{{$step->step_number ?? '_'}} = function_now; }
		
		session_count_{{$step->step_number ?? '_'}}_suspend += 1;
		console.log("The video {{$step->step_number ?? ''}} has now been suspended");
	};
	
	
	
	// Function to listen for 'ratechange' events for the current step's video
	// https://www.w3schools.com/tags/av_event_ratechange.asp
	let session_count_{{$step->step_number ?? '_'}}_ratechange = 0;
	vid_{{$step->step_number ?? '_'}}.onratechange = makeOnContinue_{{$step->step_number ?? '_'}}('ratechange',
		() => {
			var temp = session_count_{{$step->step_number ?? '_'}}_ratechange;
			session_count_{{$step->step_number ?? '_'}}_ratechange += 1;
			return temp;
		},
		{
			video_id: "step_video_{{$step->step_number ?? ''}}",
			playback_rate:this_vid.playbackRate,
			error: vid_{{$step->step_number ?? '_'}}.muted
		});

	@empty
	console.log("The steps list for this tutorial was empty.");
	@endforelse
</script>

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
