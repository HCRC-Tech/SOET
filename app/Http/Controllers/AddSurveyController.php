<?php

namespace App\Http\Controllers;

use App\Models\Condition_List;
use App\Models\Survey_Questions;
use Illuminate\Http\Request;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Log;

class AddSurveyController extends Controller
{
    public function create()
    {
		Log::debug("AddSurveyController@create()");
		
        if (!Auth::guard('admin')->check() && !Auth::guard('caregiver')) {
            if (Auth::guard('participant')->check()) {
				Log::debug("AddSurveyController@create(): participant >redirect /");
                return redirect('/');
            }
			Log::debug("AddSurveyController@create(): !admin >redirect /adminlogin");
            return redirect('/adminlogin');
        }

        //get a list of the conditions to be displayed in the dropdown of Condition Served
        //$conditionList = Condition_List::select("Condition")->get()->toArray();

        /*$conditions = [];
        for ($i = 0; $i < count($conditionList); $i++) {
            $conditions[] = $conditionList[$i]['Condition'];
        }*/

		Log::debug("AddSurveyController@create(): admin >view create_new_survey");
        return view('create_new_survey');
    }

	//Used in view('create_new_survey')
	//Route::post('/addsurvey', 'App\Http\Controllers\AddSurveyController@store');
    public function store(Request $request)
    {
		Log::debug("AddSurveyController@store()");

        if (!Auth::guard('admin')->check()) {
            if (Auth::guard('participant')->check()) {
				Log::debug("AddSurveyController@store(): participant >redirect /");
                return redirect('/');
            }
			Log::debug("AddSurveyController@store(): !admin >redirect /adminlogin");
            return redirect('/adminlogin');
        }

		Log::debug("AddSurveyController@store(): admin: Validating");
        //retrieve the submitted data
        $this->validate($request, [
            'SurveyName' => 'required',
            //'ConditionServed' => 'required',
            //'SurveyType' => 'required',
        ]);

        //a list of two questions to be stored as dummy questions in the new survey
        $testQuestions = array(array('Text' => 'Text for test question 1', 'Type' => 'DropDown', 'PossibleResponses' => 'Option1,Option2,Option3,Option4'));

		Log::debug("AddSurveyController@store(): table count of ".$request->input('SurveyName'));
        $num = DB::table('SURVEY_QUESTIONS')
            ->where('SurveyName', 'LIKE', $request->input('SurveyName'))->count();


        if ($num > 0) {

           /* $conditionList = Condition_List::select("Condition")->get()->toArray();

            $conditions = [];
            for ($i = 0; $i < count($conditionList); $i++) {
                $conditions[] = $conditionList[$i]['Condition'];
            }*/

			Log::debug("AddSurveyController@store(): $num=".$num.">0 >view create_new_survey)=Already exists");
            return view('create_new_survey', ['message' => 'There already exists a survey with the same name. Please change the given Survey Name.']); //['conditions' => $conditions, 'message' => 'There already exists a survey with the same name. Please change the given Survey Name.']
        }

		Log::debug("AddSurveyController@store(): storing ".$request->input('SurveyName').": ".json_encode($testQuestions)); // (".$request->input('SurveyType').")
        DB::table('SURVEY_QUESTIONS')->insert([
            'SurveyName' => $request->input('SurveyName'),
            //'ConditionServed' => 'NA',//$request->input('ConditionServed'),
            //'SurveyType' => $request->input('SurveyType'),
            'SurveyQuestions' => json_encode($testQuestions)
        ]);

		Log::debug("AddSurveyController@store(): stored >redirect /, success");
        return redirect('/')->with('message', 'New survey has been created successfully.');
    }
}