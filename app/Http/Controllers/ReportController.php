<?php

namespace App\Http\Controllers;

use App\Models\Medication_List;
use App\Models\Survey_Questions;
use App\Models\Survey_Responses;
use Illuminate\Support\Facades\DB;
use App\Models\Participant;
use Illuminate\Http\Request;
use \Datetime;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{

    public function create(...$message)
    {
        if (!Auth::guard('admin')->check() && !Auth::guard('caregiver')) {
            if (Auth::guard('participant')->check()) {
                return redirect('/');
            }
            return redirect('/adminlogin');
        }

        //get a list of the available surveys
        $surveys = Survey_Questions::select('SurveyName')->get();
        $surveyList = [];
        foreach ($surveys as $survey) {
            $surveyList[] = $survey["SurveyName"];
        }

        //get a list of the available medications
        // $medications = Medication_List::select('MedicationName')->orderBy('MedicationName')->get();
        // $medicationList = [];
        // foreach ($medications as $medication) {
        //     $medicationList[] = $medication["MedicationName"];
        // }

        //pass the list of survey names and medications to the view be displayed in the form (to be listed in the drop-down menus)
        if (count($message) == 0) {
            return view('GeneratReport', ["surveys" => $surveyList]);
        } else {
            return view('GeneratReport', ["surveys" => $surveyList,"message" => $message[0]]);
        }
    }

    public function store()
    {
        Log::debug("ReportController.store() function gets called");
        if (!Auth::guard('admin')->check() && !Auth::guard('caregiver')) {
            if (Auth::guard('participant')->check()) {
                return redirect(' /');
            }
            return redirect('/adminlogin');
        }

        $submittedData = $_POST;
        Log::debug($submittedData);
        unset($submittedData["_token"]);

        //finding the patients that match the given filters
        
        //create a query to filter patients from the Patient-Profile table
        $queryParticipants = DB::table('PARTICIPANT_PROFILE');

        //get the selected gender option from the survey's response
        $gender = $_POST["gender"];

        //if a specific gender is selected (not any), then filter the patients based on the selected option
        if ($gender != 'all') {
            $queryParticipants->where('Gender', 'LIKE', $_POST["gender"]);
        }


        // $weight = $_POST["weight"];

        // if ($weight == 'above') {
        //     $queryParticipnats->where('Weight', '>', $_POST["weightAbove"]);
        // } else if ($weight == 'below') {
        //     $queryPatients->where('Weight', '<', $_POST["weightBelow"]);
        // } else if ($weight == 'equals') {
        //     $queryPatients->where('Weight', '=', $_POST["weightEquals"]);
        // }


        // $height = $_POST["height"];

        // if ($height == 'above') {
        //     $queryPatients->where('Height', '>', $_POST["heightAbove"]);
        // } else if ($height == 'below') {
        //     $queryPatients->where('Height', '<', $_POST["heightBelow"]);
        // } else if ($height == 'equals') {
        //     $queryPatients->where('Height', '=', $_POST["heightEquals"]);
        // }

        //get the email, medications, and date of birth of the filtered patients
        $filteredParticipants = $queryParticipants->get(["username","DOB"]);
        Log::debug($filteredParticipants);

        //$medicationUsage = $_POST["medicationUsage"];

        $matchedParticipantsUsernames = [];
        $matchedParticipantsDOB = [];

        //if the patient selected 'includes medication', then filter patients based on whether they use ANY (union) of the selected medications
         

            //if no filtering based on medications is required "None", then get all the previously filtered patients
            for ($i = 0; $i < count($filteredParticipants); $i++) {
                Log::debug($filteredParticipants);
                $row = json_encode($filteredParticipants[$i], true);
                $rowArray = json_decode($row, true);
                Log::debug($rowArray);
                $matchedParticipantsUsernames[] = $rowArray['username'];
                Log::debug($matchedParticipantsUsernames);
                $matchedParticipantsDOB[] = $rowArray['DOB'];
                Log::debug($matchedParticipantsDOB);
            }
        

        $finalParticipants = [];
        
        Log::debug("Matched Participant User name from Line 128 Below:");
        Log::debug($matchedParticipantsUsernames);
        //filter based on age
        $age = $_POST["age"];

        if ($age == 'all') {
            $finalPartcipants = $matchedParticipantsUsernames;
            Log::debug("Final Participants for Line 135 below:");
            Log::debug($finalPartcipants);
        } else {
            for ($i = 0; $i < count($matchedParticipantsUsernames); $i++) {

                //convert DOB to unix time in seconds
                $date = strtotime($matchedParticipantsDOB[$i]);
                $now = time();
                $diff = abs($date - $now);
                $ageYears = floor($diff / (365 * 60 * 60 * 24));

                if ($age == 'above') {
                    $above = $_POST["ageAbove"];

                    //get all the patients that are older or have the same age as the one specified
                    if ($ageYears > $above) {
                        $finalParticipants[] = $matchedParticipantsUsernames[$i];
                    }
                } else if ($age == 'below') {
                    $below = $_POST["ageBelow"];
                    if ($ageYears < $below) {
                        $finalParticipants[] = $matchedParticipantsUsernames[$i];
                    }
                } else if ($age == 'equals') {
                    $equals = $_POST["ageEquals"];
                    if ($ageYears == $equals) {
                        $finalParticipants[] = $matchedParticipantsUsernames[$i];
                    }
                }
            }
        }


        $finalPartcipants = array_values($finalParticipants);
        
        Log::debug("Final Participant before exiting line 169:");
        Log::debug($finalPartcipants);
        Log::debug("Final Participants Number:");
        Log::debug(count($finalParticipants));

        if ($finalParticipants){
            return $this->create("No records match.");
        }
        
        Log::debug($finalPartcipants);
        Log::debug("Unable to reach this line");
        Log::debug(gettype($finalParticipants));

        Log::debug($_POST["surveyName"]);
        //Get the responses of the patients that match the required filters
        $query = DB::table('SURVEY_RESPONSES')
            ->where('SurveyName', "LIKE", $_POST["surveyName"])
            // ->whereIn('username', $finalParticipants)
            //->where('username','=', 'Participant2021')
            //For some reason whereIn is treating non-empty arrays as empty. This is a work arround(Below).
            ->where(function ($query) use (&$finalParticipants){ 
                $first = 1; 
                foreach($finalParticipants as $participant) 
                { 
                    if($first) {
                        $query->where('username', '=', $participant); 
                        $first = 0;
                    } 
                    else{ 
                        $query->orWhere('username', '=', $participant); 
                    }
                }
            })
            ->get();
        
        
        Log::debug("Query...");
        Log::debug($query);
        
        $responses = json_decode($query, true);
        Log::debug($responses);

        //an array of arrays of strings (an array of records from the Survey_Responses table, which store attributes are Strings)
        $responsesArray = [];

        //an array of emails of the selected patients
        $participantsUsername = [];
        $participantsName = [];
        $dateCompleted = [];

        
        for ($i = 0; $i < count($responses); $i++) {
            $responsesArray[] = json_decode($responses[$i]["Responses"], true);
            $participantsUsername[] = $responses[$i]["username"];
            $dateCompleted[] = $responses[$i]["DateCompleted"];
            $participantsName[] = $responses[$i]["FirstName"] . " " . $responses[$i]["LastName"];
        }

        // if (count($participantsName) == 0) {
        //     return $this->create("No records match the specified data.");
        // }

        //Get the questions of the current version of the survey (as column headers)
        $surveyName = $_POST["surveyName"];
        $survey = Survey_Questions::query()->where("SurveyName", $surveyName)->first();
        $surveyArray = json_decode($survey, true);
        $surveyArray = json_decode($surveyArray["SurveyQuestions"], true);

        $responsesAr = [];

        //convert underscore characters to space characters
        for ($i = 0; $i < count($responsesArray); $i++) {
            foreach ($responsesArray[$i] as $key => $value) {
                $question = str_replace("_", " ", $key);
                $responsesAr[$i][$question] = $responsesArray[$i][$key];
            }
        }

        //reformat responses that are stored as arrays to strings
        for ($i = 0; $i < count($responsesAr); $i++) {
            foreach ($responsesAr[$i] as $key => $value) {
                if (is_array($responsesAr[$i][$key])) {
                    $responsesAr[$i][$key] = implode(", ", $responsesAr[$i][$key]);
                }
            }
        }

        //get all the files in the storage/app directory, to remove any old report files
        $files = Storage::allFiles();
        $csvFiles = [];

        for ($i = 0; $i < count($files); $i++) {
            //if the name of the file contains the word 'report'
            if (str_contains($files[$i], 'survey_data_report')) {
                $csvFiles[] = $files[$i];
            }
        }
        Storage::delete($csvFiles);


        $header = "Name|username Address|Date Completed";

        foreach ($surveyArray as $q) {
            $header .= "|" . ($q["Text"]);
        }

        $list = [explode("|", $header)];
        for ($i = 0; $i < count($participantsUsername); $i++) {
            $row = $participantsName[$i] . "|" . $participantsUsername[$i] . "|" . $dateCompleted[$i];
            foreach ($surveyArray as $q) {
                if (array_key_exists($q['Text'], $responsesAr[$i])) {
                    $row .= "|" . $responsesAr[$i][$q['Text']];
                } else {
                    $row .= "|N/A";
                }
            }
            $list[] = explode("|", $row);
        }

        $path = storage_path('app/');

        $date = new DateTime("now", new \DateTimeZone('America/Halifax'));

        $name = "survey_data_report[" . $date->format('d-m-Y@H-i-s') . "].csv";

        $file = fopen($path . $name, "w");

        foreach ($list as $line) {
            fputcsv($file, $line);
        }

        //a new CSV file is created in storage/ReportCSVs
        fclose($file);

        return view("report_result_page", ["responses" => $responsesAr, "username" => $participantsUsername, "names" => $participantsName, "dates" => $dateCompleted, "questions" => $surveyArray, "fileName" => $name]);
    }

    public function download()
    {

        return Storage::download($_POST['fileName']);
    }
}