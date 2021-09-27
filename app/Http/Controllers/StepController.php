<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\VideoCategoryController;
use Illuminate\Support\Facades\DB;
use App\Models\Video;
use App\Models\Step;
use App\Models\Tutorial;
use Storage;
use Illuminate\Support\Facades\Log;

class StepController extends Controller
{
	protected $stepNumber;
	protected $script;
	protected $step;

	public function uploadVideo(Request $request){
		Log::debug("StepController.uploadVideo(): request contains...");
		Log::debug($request);
		//Log::debug($request->allFiles());
		
		//    $this->validate($request, [
		//       'title' => 'required|string|max:255',
		//       'video' => 'required|file|mimetypes:video/mp4',
		// ]);
		
		$file = $request->file('video');
		
		$tutorialID = $request->tutorialID;
		$tutorialName = $request->tutorialName;
		$numSteps = $request->numSteps;
		
		$stepID = $request->stepID;
		$stepNumber = $request->stepNumber;
		$script = $request->script;
		$path = $request->path;
		
		$uploadButton = $request->upload_button;
		$nextButton = $request->next_button;
		
		$saveStep = False;
		
		// For errors
		// TODO use the Laravel message system for errors, etc.
		$errors = [];
		
		if (!$tutorialID) {
			Log::debug("StepController.uploadVideo: Tutorial not supplied >redirect /");
			return redirect('/');
		}
		
		Log::debug("StepController.uploadVideo: Finding tutorial id=".$tutorialID);
		$tutorial = Tutorial::find($tutorialID);
		// TODO see if documentation has a better way to deal with missing tutorials (like error data or a different find function)
		if (!$tutorial) {
			//Tutorial not found, send to tutorial page
			Log::debug("StepController.uploadVideo: Tutorial id=".$tutorialID." not found >redirect /");
			return redirect('/');
			//return view('videoCategory');
		}
		$numSteps = $tutorial->number_of_steps;
		$tutorialName = $tutorial->group_title;
		
		if ($stepID) {
			Log::debug("StepController.uploadVideo: Finding step id=".$stepID);
			$step = Step::find($stepID);
			
			// TODO If the earlier tutorial find check was updated to a better method, update this part too. 
			if (!$step) {
				//Step not found
				Log::debug("StepController.uploadVideo: Step id=".$stepID." not found.");
				$stepID = null;
				// This forces a new step below
			}
			// If script is not empty, update it
			else if ($script) {
				Log::debug("StepController.uploadVideo: Step id=".$stepID." found; updating script=".$script);
				$step->script = $script;
				$saveStep = True;
			}
			else {
				Log::debug("StepController.uploadVideo: Step id=".$stepID." found;");
			}
		}
		// Can't be else due to possible change in above if
		if (!$stepID) {
			Log::debug("StepController.uploadVideo: Creating new step #".$stepNumber." for tutorial id=".$tutorialID."...");
			$step = new Step;
			$step->step_number = $stepNumber ?? 0;
			$step->script = $script ?? '';
			// TODO add foreign key tp tutorial
			// $step->tutorial_id = $tutorialID;
			$step->video = ''; // null path
			$step->tutorial_id = $tutorialID;
			
			
			// TODO add code to handle database errors in Step creation
			
			//$stepID = $step->id; Invalid?
			$saveStep = True;
		}
		
		if(!$file){
			if(!$path) {
				Log::debug("StepController.uploadVideo: Video issue: File Null");
			}
			else { // The video was already uploaded
				Log::debug("StepController.uploadVideo: Previous video uploaded to: ".$path);
			}
		}
		else if ($file->isValid()){
			Log::debug("StepController.uploadVideo: Storing video to: 'my_files':".$tutorial->folder_path." / ".$tutorialName."_".$stepNumber.".".$file->getClientOriginalExtension());
			$path = $file->storeAs($tutorial->folder_path,$tutorialName."_".$stepNumber.".".$file->getClientOriginalExtension(), 'my_files');
			//$path = $file->store('videos', 'my_files');
			//Log::debug("StepController.uploadVideo: video path: ".$path);
			$step->video = $path;
			Log::debug("StepController.uploadVideo: video path (".$path.") added to model");
			$saveStep = True;
		}
		else {
			Log::debug("StepController.uploadVideo: Video issue: ".$file->getErrorMessage());
			array_push($errors, $file->getErrorMessage());
		}
		
		if ($saveStep) {
			$step->save();
			$stepID = $step->id;
			Log::debug("StepController.uploadVideo: Database updated for step id=".$step->id." (was ".$stepID.")");
		}
		
		// A valid path means we can have them move to the next if desired
		if ($nextButton && $path) {
			// Video has been uploaded to $path & $next button was pressed
			if ($stepNumber == $numSteps) {
				// Last step finished, go to new page
				Log::debug("StepController.uploadVideo: >view rootadmin_dashboard_page (nextButton=".$nextButton.", path=".$path.", #".$stepNumber." of ".$numSteps.")");
				return view('rootadmin_dashboard_page'); // TODO decide where to go
			}
			else {
				// Set data for new step upload page
				$stepNumber++;
				$stepID = null; // TODO Change this if updating previously existing steps, as if we are updating/changing already created steps, then the next step exists and has an ID so we need to search for that.
				// CONSIDER adding a "next_step_id" field to the steps table that you can make point to the next step (like a linked list) for efficiency
				// CONSIDER enforcing that tutorial_id & step_number be unique TOGETHER in the steps table
				
				$script = null;
				$path = null;
			}
		}
		$viewData = ['path'=>$path, 'errors'=>$errors, 'tutorialID'=>$tutorialID, 'tutorialName'=>$tutorialName, 'numSteps'=>$numSteps, 'stepID'=>$stepID, 'stepNumber'=>$stepNumber, 'script'=>$script];
		
		Log::debug("StepController.uploadVideo: >view uploadvideo (nextButton=".$nextButton.", path=".$path.", #".$stepNumber." of ".$numSteps.")...");
		Log::debug($viewData);
		
		return view('uploadvideo', $viewData);
	}

	/**
	* Function to show the video upload page
	*/

	public function uploadVideoPage(){
		Log::debug("StepController.uploadVideoPage() >view uploadvideo");
		return view ('uploadvideo');
	}
}