<?php

namespace App\Http\Controllers;

use App\Models\ParticipantReport;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use \Datetime;



class ParticipantProfileSummaryController extends Controller
{
    public function index()
    {
		Log::debug("ParticipantProfileSummaryController@index()");

        //Checking if an Admin is not logged in if they are not redirect to adminlogin page.
        if (!Auth::guard('admin')->check()) {
            if (Auth::guard('participant')->check()) {
                //If Patient logged in Redirect to Patient Dashboard.
                return redirect('/');
            }

            else if (Auth::guard('caregiver')->check()) {
                //If Patient logged in Redirect to Patient Dashboard.
                return redirect('/');
            }
            
            return redirect('/adminlogin');
        }

        $data = Participant::paginate(10);

        return view('ProfileSummary')->with('data', $data);
    }

    public function search(Request $request)
    {
		Log::debug("ParticipantProfileSummaryController@search(): request contains...");
		Log::debug($request);
		
        if (!Auth::guard('admin')->check() && !Auth::guard('caregiver')) {

            if (Auth::guard('participant')->check()) {
				Log::debug("ParticipantProfileSummaryController@search(): participant >redirect /");
                return redirect('/');
            }
            
			Log::debug("ParticipantProfileSummaryController@search(): not admin or caregiver >redirect /");
            return redirect('/adminlogin');
        }

		Log::debug("ParticipantProfileSummaryController@search(): validating...");
        $this->validate($request, [
            'inputUsername' => 'required',
        ]);


		Log::debug("ParticipantProfileSummaryController@search(): accessing PARTICIPANT_PROFILE table...");
        $data = DB::table('PARTICIPANT_PROFILE');
        if (!empty($request->inputUsername)) { // TYPO????
			Log::debug("ParticipantProfileSummaryController@search(): input username not empty");
            if ($request->inputUsername) {
				Log::debug("ParticipantProfileSummaryController@search(): inputUsername=".$request->inputUsername);
                $data = $data->where('username', 'LIKE', "%" . $request->inputUsername . "%")->get();//->where('NewAccount', 'false')->get();
            }
        }


        //if there are no registered patients with the given name/email
        if (count($data) == 0) {
			Log::debug("ParticipantProfileSummaryController@search(): no data >view ProfileSummary; No records match the specified data.");
            return view('ProfileSummary', ['message' => "No records match the specified data."]);
        }
		Log::debug("ParticipantProfileSummaryController@search(): data contains...");
		Log::debug($data);

        $data = (array)$data[0];

        //if the patient uses any medications
        /*if (strlen($data["Medications"]) > 4) {

            //create a string of the medications (instead of an array)remove the first character "[" and last one "]" from the "Medications" column
            $medArray = explode(",", substr($data["Medications"], 1, -1));

            //remove the first character " and last one " for each medication string
            for ($j = 0; $j < count($medArray); $j++) {
                $medArray[$j] = str_replace("\\", "", substr($medArray[$j], 1, -1));
            }
        }*/

		Log::debug("ParticipantProfileSummaryController@search(): accessing SURVEY_RESPONSES table...");
        $responses = DB::table('SURVEY_RESPONSES');

        $responses = $responses->where('username', 'LIKE', "%" . $request->inputUsername . "%")->get();
		Log::debug("ParticipantProfileSummaryController@search(): responses contains...");
		Log::debug($responses);

        $responses = (array)$responses->toArray();

        //if the patient has not submitted any surveys yet
        /*if (count($responses) == 0 & isset($medArray)) {
            return view('PatientSummaryResult', ["Summary" => $data, "medications" => implode(", ", $medArray)]);
        } //if the patient has not submitted any surveys yet and does not use any medications
        elseif (count($responses) == 0 & !isset($medArray) == 0) {
            return view('PatientSummaryResult', ["Summary" => $data]);
        }*/

        // if (isset($medArray)) {
        //     $medArray = implode(", ", $medArray);
        // }

		Log::debug("ParticipantProfileSummaryController@search(): JSON conversion...");
        //convert Stdclass to array
        for ($i = 0; $i < count($responses); $i++) {
            $responses[$i] = json_decode(json_encode($responses[$i]), true);
        }


		Log::debug("ParticipantProfileSummaryController@search(): filling response array...");
        $responsesArray = [];
        for ($i = 0; $i < count($responses); $i++) {
            $responsesArray[] = json_decode($responses[$i]["Responses"], true);
        }

        $dateCompleted = [];
        $surveyName = [];

		Log::debug("ParticipantProfileSummaryController@search(): getting servey types with date...");
        //get date completed and survey type for each submitted survey
        for ($i = 0; $i < count($responses); $i++) {
            $dateCompleted[] = $responses[$i]["DateCompleted"];
            $surveyName[] = $responses[$i]["SurveyName"];
        }

		Log::debug("ParticipantProfileSummaryController@search(): getting question data...");
        $responsesAr = [];
        //convert underscore characters to space characters
        for ($i = 0; $i < count($responsesArray); $i++) {
            foreach ($responsesArray[$i] as $key => $value) {
                $question = str_replace("_", " ", $key);
                $responsesAr[$i][$question] = $responsesArray[$i][$key];
            }
        }

		Log::debug("ParticipantProfileSummaryController@search(): response reformatting...");
        //reformat responses that are stored as arrays to strings
        for ($i = 0; $i < count($responsesAr); $i++) {
            foreach ($responsesAr[$i] as $key => $value) {
                if (is_array($responsesAr[$i][$key])) {
                    $responsesAr[$i][$key] = implode(", ", $responsesAr[$i][$key]);
                }
            }
        }

		Log::debug("ParticipantProfileSummaryController@search(): response conversion...");
        $responsesString = [];
        //convert responses array to string
        for ($i = 0; $i < count($responsesAr); $i++) {
            $res = "";
            $quesNum = 1;
            foreach ($responsesAr[$i] as $key => $value) {
                $res .= $quesNum . ") " . $key . ":: " . $value . "| ";
                $quesNum += 1;
            }
            $responsesString[] = $res;
        }
        
        // Get the step data from table and printed in the log.

        $user = null;

        if (Auth::guard('admin')) {
        $user = Auth::guard('admin')->user();
        }
        else if (Auth::guard('caregiver')) {
        $user = Auth::guard('caregiver')->user();
        }
        else if (Auth::guard('participant')) {
        $user = Auth::guard('participant')->user();
        }

        $username = $user->username ?? 'unknown';
        $FirstName = $user->FirstName ?? 'missing';
        $LastName = $user->LastName ?? 'missing';
        
        Log::debug("ParticipantProfileSummaryController@search(): accessing tutorial_data table... and getting the data");
        $tutorialData = DB::table('tutorial_data')
                        ->join('tutorials','tutorial_id', '=','tutorials.id')
                        -> select('username','tutorial_id','step_id','event_type','time_spent','group_title')
                        ->where('username','=',$username)
                        //->groupby('step_id')
                        -> get();
                        
                        $counts = [];
                        $tutorialNames = [];
                        $tutorialTimes = [];
                    
                        for($i = 0; $i < count($tutorialData); $i++){
                            // if($tutorialData[$i]->event_type=='page_load'){
                            //     $count[$tutorialData[$i]->tutorial_id] = 0;
                            // }

                             if($tutorialData[$i]->event_type== 'page_load'){
                                
                                if(!array_key_exists($tutorialData[$i]->tutorial_id,$counts)){
                                    $counts[$tutorialData[$i]->tutorial_id] = 1;
                                    
                                }
                                else{
                                    $counts[$tutorialData[$i]->tutorial_id]++;
                                }
                            }
                         
                            
                            //$tutorialData[$i] -> tutorial_id = 'tutorial_id';
                            if(!array_key_exists($tutorialData[$i]->tutorial_id,$tutorialNames)){
                                
                                $tutorialNames[$tutorialData[$i]->tutorial_id] = $tutorialData[$i]->group_title;
                            }

                            
        
                            
                            if($tutorialData[$i]->event_type== 'pause'){
                                
                                if(!array_key_exists($tutorialData[$i]->tutorial_id,$tutorialTimes)){
                                    $tutorialTimes[$tutorialData[$i]->tutorial_id] = $tutorialData[$i]->time_spent;
                                    
                                }
                                else{
                                    $tutorialTimes[$tutorialData[$i]->tutorial_id] += $tutorialData[$i]->time_spent;
                                }
                            }
                        
                        }


        $files = Storage::allFiles();
        $csvFiles = [];

        for ($i = 0; $i < count($files); $i++) {
            //if the name of the file contains the word 'report'
            if (str_contains($files[$i], 'tutorial_data_report')) {
                $csvFiles[] = $files[$i];
            }
        }
        Storage::delete($csvFiles);

        
        $header = "First Name|Last Name|Tutorial Name|Time Accessed|Time Spent Watching(Seconds)";
        $list = [explode("|", $header)];
        
        foreach($tutorialNames as $tutorial_id => $tutorialName){
            $t_name = $tutorialName;
            $count = $counts[$tutorial_id];
            $times = $tutorialTimes[$tutorial_id];
            $row = $FirstName."|".$LastName."|".$t_name."|".$count."|".$times;
            $list[] = explode("|", $row);
        }
        
        // for ($i = 0; $i < count($tutorialNames); $i++) {
        //     $row = $participantsName[$i] . "|" . $participantsUsername[$i] . "|" . $dateCompleted[$i];
            // foreach ($surveyArray as $q) {
            //     if (array_key_exists($q['Text'], $responsesAr[$i])) {
            //         $row .= "|" . $responsesAr[$i][$q['Text']];
            //     } else {
            //         $row .= "|N/A";
            //     }
            // }
        $path = storage_path('app/');

        $date = new DateTime("now", new \DateTimeZone('America/Halifax'));

        $name = "tutorial_data_report[" . $date->format('d-m-Y@H-i-s') . "].csv";

        $file = fopen($path . $name, "w");

        foreach ($list as $line) {
            fputcsv($file, $line);
        }

        //a new CSV file is created in storage/ReportCSVs
        fclose($file);


                        
        Log::debug($counts);
        Log::debug("ParticipantProfileSummaryController@search(): Getting the Following Tutorial Data");
        Log::debug($tutorialData);
        Log::debug($tutorialNames);
        Log::debug($tutorialTimes);

        /*if (isset($medArray) and count($responsesString) > 0) {
            return view('PatientSummaryResult', ["Summary" => $data, "medications" => $medArray, "responses" => $responsesString, "dates" => $dateCompleted, "names" => $surveyName]);
        } else if (isset($medArray) and count($responsesString) == 0) {
            return view('PatientSummaryResult', ["Summary" => $data, "medications" => $medArray]);
        } else if (!isset($medArray) and count($responsesString) > 0) {
            return view('PatientSummaryResult', ["Summary" => $data, "responses" => $responsesString, "dates" => $dateCompleted, "names" => $surveyName]);
        } else {*/
			Log::debug("ParticipantProfileSummaryController@search(): no data >view ParticipantSummaryResult; Summary contains...");
			Log::debug($data);
            return view('ParticipantSummaryResult', ["Summary" => $data,"responses"=> $responsesString,"dates" => $dateCompleted,"names" => $surveyName,"tutorialNames"=>$tutorialNames,"counts"=>$counts,"tutorialTimes"=> $tutorialTimes,"fileName"=>$name]);
        //}
    }

    public function download(Request $request){
        Log::debug("Accessing Download Function:");
        Log::debug($request);
        return Storage::download($request->input('fileName'));
        //return Storage::download($_POST['fileName']);
    }

    public function nameSearch(Request $request)
    {
		Log::debug("ParticipantProfileSummaryController@nameSearch(): request contains...");
		Log::debug($request);
		
        if (!Auth::guard('admin')->check()) {

            if (Auth::guard('participant')->check()) {
                return redirect('/');
            }

            if (Auth::guard('caregiver')->check()) {
                return redirect('/');
            }
            
            return redirect('/adminlogin');
        }

        $this->validate($request, [
            'inputFirstName' => '',
            'inputLastName' => '',
        ]);


        $data = DB::table('PARTICIPANT_PROFILE');
        if (!empty($request->inputFirstName)) {
            if ($request->inputFirstName) {
                $data = $data->where('FirstName', 'LIKE', "%" . $request->inputFirstName . "%");
            }
        }
        
        if (!empty($request->inputLastName)) {
            if ($request->inputLastName) {
                $data = $data->where('LastName', 'LIKE', "%" . $request->inputLastName);
            }
        }


        $data = $data->get()->toArray(); //>where('NewAccount', 'true')

        //if there are no registered patients with the given name
        if (count($data) == 0) {
            return view('ProfileSummary', ['message' => "No records match the specified data."]);
        }

        //an array of arrays (each element represents a patient, with an array of the patient's info)
        $participants = [];
        $age = [];
        for ($i = 0; $i < count($data); $i++) {
            $row = json_encode($data[$i], true);
            $rowArray = json_decode($row, true);
            $participants[] = $rowArray;
            $date = strtotime($rowArray["DOB"]);
            $now = time();
            $diff = abs($date - $now);
            $ageYears = floor($diff / (365 * 60 * 60 * 24));
            $age[] = $ageYears;
        }

        return view('ReportSearchByName', ["data" => $participants, "age" => $age]);
    }

    

}