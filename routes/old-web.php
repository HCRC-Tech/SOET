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

Route::get('/', 'App\Http\Controllers\DashboardController@index');



Route::get('/patientregistration', 'App\Http\Controllers\PatientRegistrationController@index')->name('patientregistration');
Route::post('/patientregistration', 'App\Http\Controllers\PatientRegistrationController@register');
Route::post('/verifyemail', 'App\Http\Controllers\PatientRegistrationController@emailverification');
Route::get('/adminregistration', 'App\Http\Controllers\AdminRegistrationController@index')->name('adminregistration');
Route::post('/adminregistration', 'App\Http\Controllers\AdminRegistrationController@register');
Route::get('/profilesearch', 'App\Http\Controllers\PatientProfileSummaryController@index')->name('profilesearch');

Route::post('/profilereport', 'App\Http\Controllers\PatientProfileSummaryController@search');
Route::post('/profilereportName', 'App\Http\Controllers\PatientProfileSummaryController@nameSearch');

Route::get('/surveyselection', 'App\Http\Controllers\SurveyController@surveyselection')->name('surveyselection');
Route::post('/form/create', 'App\Http\Controllers\SurveyController@create');
Route::post('/form', 'App\Http\Controllers\SurveyController@store');
Route::get('/adminlogin', 'App\Http\Controllers\AdminLoginController@index')->name('adminlogin');
Route::post('/adminloginpage', 'App\Http\Controllers\AdminLoginController@login');
Route::get('/patientlogin', 'App\Http\Controllers\PatientLoginController@index')->name('patientlogin');
Route::post('/patientloginpage', 'App\Http\Controllers\PatientLoginController@login');
Route::get('/editSurvey/create', 'App\Http\Controllers\EditSurveyController@create')->name('editSurvey/create');
Route::get('/editSurvey/recreate', 'App\Http\Controllers\EditSurveyController@createStr')->name('editSurvey/recreate');
Route::post('/editSurvey', 'App\Http\Controllers\EditSurveyController@store');
Route::delete('surveyquestions/{id}', 'App\Http\Controllers\EditSurveyController@destroy');
Route::post('/report', 'App\Http\Controllers\ReportController@store');
Route::get('/report/create', 'App\Http\Controllers\ReportController@create')->name('/report/create');
Route::post('/accept', 'App\Http\Controllers\AcceptanceController@store');
Route::get('/accept/create', 'App\Http\Controllers\AcceptanceController@create')->name('/accept/create');
Route::get('/resetreview/create', 'App\Http\Controllers\PasswordController@create')->name('resetreview/create');
Route::post('/resetreview/store', 'App\Http\Controllers\PasswordController@store');
Route::get('/passwordchangepatient', 'App\Http\Controllers\PasswordController@patientchange')->name('passwordchangepatient');
Route::post('/passwordchangepatientsave', 'App\Http\Controllers\PasswordController@patientsave');
Route::get('/passwordchangeadmin', 'App\Http\Controllers\PasswordController@adminchange')->name('passwordchangeadmin');
Route::post('/passwordchangeadminsave', 'App\Http\Controllers\PasswordController@adminsave');
Route::post('/passwordreset', 'App\Http\Controllers\PasswordController@store');
Route::get('/passwordreset/create', 'App\Http\Controllers\PasswordController@create')->name('passwordreset/create');
Route::get('/adminreset', 'App\Http\Controllers\PasswordController@adminresetindex')->name('adminreset');
Route::get('/patientreset', 'App\Http\Controllers\PasswordController@patientresetindex')->name('patientreset');
Route::post('/adminresetmail', 'App\Http\Controllers\PasswordController@adminresetemail');
Route::post('/patientresetrequest', 'App\Http\Controllers\PasswordController@patientresetrequest');
Route::get('/logout', 'App\Http\Controllers\LogoutController@logout')->name('logout');
Route::post('/deletion-confirmation', 'App\Http\Controllers\EditSurveyController@deletionConfirmation');
Route::post('/delete', 'App\Http\Controllers\EditSurveyController@deleteQuestion');
Route::post('/addQuestion', 'App\Http\Controllers\EditSurveyController@addQuestion');

Route::get('/addsurvey/create', 'App\Http\Controllers\AddSurveyController@create')->name('addsurvey');
Route::post('/addsurvey', 'App\Http\Controllers\AddSurveyController@store');
Route::get('/editSurveySelect', 'App\Http\Controllers\EditSurveyController@surveyselection')->name('editSurveySelect');
Route::post('/report/download', 'App\Http\Controllers\ReportController@download');

Route::get('/adminsurveyselection', 'App\Http\Controllers\AdminSurveyController@surveyselection')-> name('adminsurveyselection');
Route::post('/adminform/create', 'App\Http\Controllers\AdminSurveyController@create');
Route::post('/adminform', 'App\Http\Controllers\AdminSurveyController@store');
Route::get('/adminhelp', 'App\Http\Controllers\AdminHelpController@index');

Route::post('/preview', 'App\Http\Controllers\ViewResponseController@create');

Route::get('/medication', 'App\Http\Controllers\MedicationController@create')->name('medication');
Route::post('/addmedication', 'App\Http\Controllers\MedicationController@add');

Route::get('/condition', 'App\Http\Controllers\ConditionController@create')->name('condition');
Route::post('/addcondition', 'App\Http\Controllers\ConditionController@add');
