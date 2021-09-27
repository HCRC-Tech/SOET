<?php

namespace App\Http\Controllers;

use App\Models\Survey_Questions;
use Illuminate\Http\Request;
use App\Models\Survey_Responses;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Tutorial;
use Illuminate\Support\Facades\Storage;
use \Datetime;

class SurveyController extends Controller
{

    /**
     * This method that will create the form
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function surveyselection()
    {
		Log::debug("SurveyController@surveyselection()");

        //Check if Patient is logged in.
        if (!Auth::guard('caregiver')->check()) {
            if (Auth::guard('admin')->check()) {

				Log::debug("SurveyController@surveyselection(): admin >redirect /");
                return redirect('/');
            }

            if (Auth::guard('participant')->check()) {

				Log::debug("SurveyController@surveyselection(): participant >redirect /");
                return redirect('/');
            }
            
			Log::debug("SurveyController@surveyselection(): guest >redirect /, No Caregiver Logged in");
            return redirect('/')->with('message', 'No Caregiver Logged in');
        }
        //Check if password is temporary redirect to password change if so.
        $tempPassCheck = Auth::guard('participant')->user()->PasswordReset;
        if ((strcmp($tempPassCheck, "pending")) === 0) {
			Log::debug("SurveyController@surveyselection(): caregiver >redirect /passwordchangeparticipant, Temporary password detected please change below; ".$tempPassCheck);
            return redirect('/passwordchangeparticipant')->with('message', 'Temporary password detected please change below.');
        }

        //Check Condition and only provide survey names that serve the authenticaticated users condition
        //$userCondition = Auth::guard('participant')->user()->Condition;
		Log::debug("SurveyController@surveyselection(): caregiver; accessing survey database...; ".$tempPassCheck);
        $surveyList = Survey_Questions::select('SurveyName')
            //->where('ConditionServed', $userCondition)
            ->pluck('SurveyName');

		Log::debug("SurveyController@surveyselection(): caregiver >view survey_select, surveyList=".json_encode($surveyList));
        return view('survey_select')->with('surveys', $surveyList);
    }


    public function create(Request $request)
    {
		Log::debug("SurveyController@create()");

        //Check if Patient is logged in.
        if (!Auth::guard('participant')->check()) {
            if (Auth::guard('admin')->check()) {

                return redirect('/');
            }

            if (Auth::guard('caregiver')->check()) {

                return redirect('/');
            }
            
            return redirect('/')->with('message', 'No Participant Logged in');
        }
        //Check if password is temporary redirect to password change if so.
        $tempPassCheck = Auth::guard('participant')->user()->PasswordReset;
        if ((strcmp($tempPassCheck, "pending")) === 0) {
            return redirect('/passwordchangeparticipant')->with('message', 'Temporary password detected please change below.');

        }

        $this->validate($request, [
            'surveyName' => 'required',
        ]);

        //Check Condition and only provide survey names that serve the authenticaticated users condition.
        $userCondition = Auth::guard('participant')->user()->Condition;

        $surveyIndex = $request->input('surveyName');
        $surveyList = Survey_Questions::select('SurveyName')
            ->where('ConditionServed', $userCondition)
            ->pluck('SurveyName');

        //Match the input dropdown index to get the survey name selected.
        $surveyName = $surveyList[$surveyIndex];


        //check whether the patient has already submitted the survey on the same day
        $responses = DB::table('SURVEY_RESPONSES')
            ->where('Username', 'LIKE', Auth::guard('participant')->user()->username)
            ->where('DateCompleted', 'LIKE', date("Y-m-d"))
            ->where('SurveyName', 'LIKE', $surveyName)->count();

        if ($responses > 0) {
            return redirect('/')->with('message', 'Sorry, you cannot resubmit the same survey on the same day');
        }


        $survey = Survey_Questions::query()->where("SurveyName", $surveyName)->first();
        $surveyArray = json_decode($survey, true);
        $surveyArray = json_decode($surveyArray["SurveyQuestions"], true);


        //convert dot characters to | character
        for ($i = 0; $i < count($surveyArray); $i++) {
            $surveyArray[$i]["Text"] = str_replace(".", "|", $surveyArray[$i]["Text"]);
        }

        return view('survey', ["questions" => $surveyArray, "name" => $surveyName]);
    }


    /**
     * This method that will store the response to the form
     */
    public function store()
    {
		Log::debug("SurveyController@store()");
        //Check if Patient is logged in.
        if (!Auth::guard('participant')->check()) {
            if (Auth::guard('admin')->check()) {
                return redirect('/');
            }

            if (Auth::guard('caregiver')->check()) {
                return redirect('/');
            }
            
            return redirect('/')->with('message', 'No Participant Logged in');
        }

        //Check if password is temporary redirect to password change if so.
        $tempPassCheck = Auth::guard('participant')->user()->PasswordReset;
        if ((strcmp($tempPassCheck, "pending")) === 0) {
            return redirect('/passwordchangeparticipant')->with('message', 'Temporary password detected please change below.');
        }

        //the fields of the table: id, Email, DateCompleted, SurveyName, FirstName, LastName, Responses


        $submittedData = $_POST;

        //print_r($_POST);

        //remove the first element of the submitted form (the token)
        unset($submittedData["_token"]);

        $surveyName = $submittedData['surveyname'];

        unset($submittedData["surveyname"]);

        //same as $submittedData, but | characters in the questions are converted into dots
        $submittedSurvey = [];

        //convert | characters back to dot characters
        foreach ($submittedData as $question => $answer) {
            $submittedSurvey[str_replace("|", ".", $question)] = $answer;
        }

        $submittedSurveyAr = [];

        //remove empty text area responses
        foreach ($submittedSurvey as $question => $answer) {
            if ((is_string($answer) and strlen($answer) > 0) or !is_string($answer)) {
                $submittedSurveyAr[$question] = $answer;
            }
        }

        $responses = json_encode($submittedSurveyAr);

        $firstName = Auth::guard('participant')->user()->FirstName;
        $lastName = Auth::guard('participant')->user()->LastName;
        $username = Auth::guard('participant')->user()->username;


        $survey_response = new SURVEY_RESPONSES;

        $survey_response->Username = $username; //the same email is allowed to submit the same survey only once a day
        $survey_response->DateCompleted = date("Y-m-d");
        $survey_response->SurveyName = $surveyName;
        $survey_response->FirstName = $firstName;
        $survey_response->LastName = $lastName;
        $survey_response->Responses = $responses;

        $survey_response->save();

        return redirect('/')->with('message', 'Thank you for submitting the survey!');

    }

	// Route::get('/tutorials', 'App\Http\Controllers\SurveyController@displayTutorial')->name('/tutorials');
    public function displayTutorial(Request $request){
        Log::debug("SurveyController@displayTutorial(): request contains...");
		Log::debug($request);
		
		if (!Auth::guard('admin')->check() && !Auth::guard('caregiver')->check() && !Auth::guard('participant')->check()) {
			Log::debug("SurveyController@displayTutorial: unauthorized or unknown >redirect /");
			return redirect('/');
		}
        Log::debug("SurveyController@displayTutorial: video list contains...");
        $videoList = Tutorial::all();
		Log::debug($videoList);
            
		Log::debug("SurveyController@displayTutorial: >view display_tutorial, tutorials=above");
		return view('display_tutorial', ["tutorials" => $videoList]);
    }

    public function displaySteps(Request $request){
        Log::debug("SurveyController@displaySteps(): request contains...");
		Log::debug($request);
		
        if (!Auth::guard('admin')->check() && !Auth::guard('caregiver')->check() && !Auth::guard('participant')->check()) {
			Log::debug("SurveyController@displaySteps: unauthorized or unknown >redirect /");
            return redirect('/');
        }
        $tutorialID = $request->tutorial_id; //$request->input('tutorial_id');
		
        Log::debug("SurveyController@displaySteps: searching for steps of tutorial id=".$tutorialID);
        $steps = DB::table('steps')
        -> where ('tutorial_id','=',$tutorialID)
        -> get();
        Log::debug($steps);
        
        $username = null;

        if (Auth::guard('admin')->check()) {
        $username = Auth::guard('admin')->user()->username;
        }
        else if (Auth::guard('caregiver')->check()) {
        $username = Auth::guard('caregiver')->user()->username;
        }
        else if (Auth::guard('participant')->check()) {
        $username = Auth::guard('participant')->user()->username;
        }

        $FirstName = null;

        if (Auth::guard('admin')->check()) {
        $FirstName = Auth::guard('admin')->user()->FirstName;
        }
        else if (Auth::guard('caregiver')->check()) {
        $FirstName = Auth::guard('caregiver')->user()->FirstName;
        }
        else if (Auth::guard('participant')->check()) {
        $FirstName = Auth::guard('participant')->user()->FirstName;
        }

        $files = Storage::allFiles();
        $textFiles = [];

        for ($i = 0; $i < count($files); $i++) {
            //if the name of the file contains the word 'report'
            if (str_contains($files[$i], 'tutorial_script')) {
                $textFiles[] = $files[$i];
            }
        }
        Storage::delete($textFiles);

        $path = storage_path('app/');

        $date = new DateTime("now", new \DateTimeZone('America/Halifax'));

        $name = "tutorial_script[" . $date->format('d-m-Y@H-i-s') . "].txt";

        $file = fopen($path . $name, "w");

        foreach ($steps as $step) {
            fwrite($file, $step->script);
        }
        fclose($file);
	Log::debug("SurveyController@displaySteps: >view display_steps, steps=above");
    return view('display_steps',['steps' => $steps,'username'=>$username,'name'=>$FirstName,'scriptFile'=>$name]);

    }
     
    public function downloadScript(Request $request){
        Log::debug("Accessing Download Function:");
        Log::debug($request);
        return Storage::download($request->input('scriptFile'));
    }

}