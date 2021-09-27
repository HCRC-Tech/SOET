<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\DashboardController@index')->name('/');



Route::get('/participantregistration', 'App\Http\Controllers\ParticipantRegistrationController@index')->name('/participantregistration');
Route::post('/participantregistration', 'App\Http\Controllers\ParticipantRegistrationController@register');
//Route::post('/verifyemail', 'App\Http\Controllers\ParticipantRegistrationController@emailverification');
//Route::post('/participantregistration', 'App\Http\Controllers\ParticipantRegistrationController@register');
Route::get('/adminregistration', 'App\Http\Controllers\AdminRegistrationController@index')->name('/adminregistration');
Route::post('/adminregistration', 'App\Http\Controllers\AdminRegistrationController@register');

//Caregiver Registration Route 
Route::get('/caregiverregistration', 'App\Http\Controllers\CaregiverRegistrationController@index')->name('/caregiverregistration');
Route::post('/caregiverregistration', 'App\Http\Controllers\CaregiverRegistrationController@register');

Route::get('/profilesearch', 'App\Http\Controllers\ParticipantProfileSummaryController@index')->name('/profilesearch');

Route::post('/profilereport', 'App\Http\Controllers\ParticipantProfileSummaryController@search')->name('/profilereport');
Route::post('/profilereportName', 'App\Http\Controllers\ParticipantProfileSummaryController@nameSearch')->name('/profilereportName');

Route::get('/surveyselection', 'App\Http\Controllers\SurveyController@surveyselection')->name('/surveyselection');
Route::post('/form/create', 'App\Http\Controllers\SurveyController@create');
Route::post('/form', 'App\Http\Controllers\SurveyController@store')->name('/form');
Route::get('/adminlogin', 'App\Http\Controllers\AdminLoginController@index')->name('/adminlogin');
Route::post('/adminloginpage', 'App\Http\Controllers\AdminLoginController@login');

// For displaying video to participant
Route::get('/tutorials', 'App\Http\Controllers\SurveyController@displayTutorial')->name('/tutorials');

// Route for displaying all the steps
Route::get('/steps/{tutorial_id}','App\Http\Controllers\SurveyController@displaySteps')->name('/steps/tutorial_id');


//Caregiver Login 
Route::get('/caregiverlogin', 'App\Http\Controllers\CaregiverLoginController@index')->name('/caregiverlogin');
Route::post('/caregiverloginpage', 'App\Http\Controllers\CaregiverLoginController@login');

Route::get('/participantlogin', 'App\Http\Controllers\ParticipantLoginController@index')->name('/participantlogin');
Route::post('/participantloginpage', 'App\Http\Controllers\ParticipantLoginController@login');
Route::get('/editSurvey/create', 'App\Http\Controllers\EditSurveyController@create')->name('/editSurvey/create');
Route::get('/editSurvey/recreate', 'App\Http\Controllers\EditSurveyController@createStr')->name('/editSurvey/recreate');
Route::post('/editSurvey', 'App\Http\Controllers\EditSurveyController@store');
Route::delete('surveyquestions/{id}', 'App\Http\Controllers\EditSurveyController@destroy');
Route::post('/report', 'App\Http\Controllers\ReportController@store')->name('/report');
Route::get('/report/create', 'App\Http\Controllers\ReportController@create')->name('/report/create');
Route::post('/accept', 'App\Http\Controllers\AcceptanceController@store');
Route::get('/accept/create', 'App\Http\Controllers\AcceptanceController@create')->name('/accept/create');
Route::get('/resetreview/create', 'App\Http\Controllers\PasswordController@create')->name('/resetreview/create');
Route::post('/resetreview/store', 'App\Http\Controllers\PasswordController@store');
Route::get('/passwordchangeparticipant', 'App\Http\Controllers\PasswordController@participantchange')->name('/passwordchangeparticipant');
Route::post('/passwordchangeparticipantsave', 'App\Http\Controllers\PasswordController@participantsave');
Route::get('/passwordchangeadmin', 'App\Http\Controllers\PasswordController@adminchange')->name('/passwordchangeadmin');
// For caregiver
Route::get('/passwordchangecaregiver', 'App\Http\Controllers\PasswordController@caregiverchange')->name('/passwordchangecaregiver');
Route::post('/passwordchangeadminsave', 'App\Http\Controllers\PasswordController@adminsave');
// For Caregiver
Route::post('/passwordchangecaregiversave', 'App\Http\Controllers\PasswordController@caregiversave');
Route::post('/passwordreset', 'App\Http\Controllers\PasswordController@store');
Route::get('/passwordreset/create', 'App\Http\Controllers\PasswordController@create')->name('/passwordreset/create');
Route::get('/adminreset', 'App\Http\Controllers\PasswordController@adminresetindex')->name('/adminreset');

// For Participant by Admin or Caregiver
Route::post('/participantpasswordreset','App\Http\Controllers\PasswordController@ParticipantPasswordChange')->name('/participantpasswordreset');
// For Caregiver
Route::get('/caregiverreset', 'App\Http\Controllers\PasswordController@caregiverresetindex')->name('/caregiverreset');
Route::get('/participantreset', 'App\Http\Controllers\PasswordController@participantresetindex')->name('/participantreset');
Route::post('/adminresetmail', 'App\Http\Controllers\PasswordController@adminresetemail');
// For Caregiver
Route::post('/caregiverresetmail', 'App\Http\Controllers\PasswordController@caregiverresetemail');
Route::post('/participantresetrequest', 'App\Http\Controllers\PasswordController@participantresetrequest');
Route::get('/logout', 'App\Http\Controllers\LogoutController@logout')->name('/logout');
Route::post('/deletion-confirmation', 'App\Http\Controllers\EditSurveyController@deletionConfirmation');
Route::post('/delete', 'App\Http\Controllers\EditSurveyController@deleteQuestion');
Route::post('/addQuestion', 'App\Http\Controllers\EditSurveyController@addQuestion');

Route::get('/addsurvey/create', 'App\Http\Controllers\AddSurveyController@create')->name('/addsurvey/create');
Route::post('/addsurvey', 'App\Http\Controllers\AddSurveyController@store');
Route::get('/editSurveySelect', 'App\Http\Controllers\EditSurveyController@surveyselection')->name('/editSurveySelect');
Route::post('/report/download', 'App\Http\Controllers\ReportController@download')->name('/report/download');

Route::get('/adminsurveyselection', 'App\Http\Controllers\AdminSurveyController@surveyselection')-> name('/adminsurveyselection');
// For Caregiver
Route::get('/caregiversurveyselection', 'App\Http\Controllers\CaregiverSurveyController@surveyselection')-> name('/caregiversurveyselection');
Route::post('/adminform/create', 'App\Http\Controllers\AdminSurveyController@create');
// For Caregiver
Route::post('/caregiverform/create', 'App\Http\Controllers\CaregiverSurveyController@create');
Route::post('/adminform', 'App\Http\Controllers\AdminSurveyController@store')->name('/adminform');
// For Caregiver
Route::post('/caregiverform', 'App\Http\Controllers\CaregiverSurveyController@store')->name('/caregiverform');
Route::get('/adminhelp', 'App\Http\Controllers\AdminHelpController@index')->name('/adminhelp');
Route::post('/preview', 'App\Http\Controllers\ViewResponseController@create')->name('/preview');

Route::get('/medication', 'App\Http\Controllers\MedicationController@create')->name('/medication');
Route::post('/addmedication', 'App\Http\Controllers\MedicationController@add');

Route::get('/condition', 'App\Http\Controllers\ConditionController@create')->name('/condition');
Route::post('/addcondition', 'App\Http\Controllers\ConditionController@add');
 
 //Video Related API
//Route::get('videos', [VideoController::class, 'getAllVideos']);
//Route::get('videos/{id}', [VideoController::class, 'getVideo']);
//Route::post('videos/upload', [VideoController::class, 'uploadVideo']);
//Route::delete('videos/{id}', [VideoController::class, 'deleteVideo']);

// Testing route for video
Route::post('/uploadVideo', 'App\Http\Controllers\StepController@uploadVideo')->name('/uploadVideo');
Route::get('/uploadVideo', 'App\Http\Controllers\StepController@uploadVideoPage')->name('/uploadVideoPage');

// Video Category testing route
Route::post('/videoCategory','App\Http\Controllers\VideoCategoryController@index')->name('/videoCategory');
Route::get('/videoCategory','App\Http\Controllers\VideoCategoryController@show')->name('/videoCategoryPage');

//Route for create tutorial.
Route::post('/createTutorial','App\Http\Controllers\VideoCategoryController@createTutorial')->name('/createTutorial');


//Route for tutorial_data
Route::post('/tutorialData','App\Http\Controllers\TutorialDataController@storeInteractionData')->name('/tutorialData');

//Route for downloading data
Route::post('/download','App\Http\Controllers\ParticipantProfileSummaryController@download')->name('/download');

//Route for downloading data
Route::post('/scriptDownload','App\Http\Controllers\SurveyController@downloadScript')->name('/scriptDownload');