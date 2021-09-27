<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Participant;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(){
		Log::debug("DashboardController@index()");

        if(Auth::guard('admin')->check()){
			//Log::debug("DashboardController@index(): admin");
               
            $adminType = Auth::guard('admin')->user()->RootAdmin;
            $adminName = Auth::guard('admin')->user()->FirstName;
			
            //Conditional for Root Admin Dashboard instead to Admin Dashboard.
            if($adminType){
				Log::debug("DashboardController@index(): root admin >view rootadmin_dashboard_page, name=".$adminName);
                return view('rootadmin_dashboard_page')->with('name', $adminName);
            }       

			Log::debug("DashboardController@index(): admin >view admin_dashboard_page, name=".$adminName);
            //Otherwise Return admin dashboard.
            return view('admin_dashboard_page')->with('name', $adminName);
        }

        else if (Auth::guard('caregiver')->check()){
			//Log::debug("DashboardController@index(): caregiver");
            
            $caregiverType = Auth::guard('caregiver')->user()->RootCaregiver;
            $caregiverName = Auth::guard('caregiver')->user()->FirstName;
			
            //Conditional for Root caregiver Dashboard instead to Admin Dashboard.
            if($caregiverType){
				Log::debug("DashboardController@index(): root caregiver >view rootcaregiver_dashboard_page, name=".$caregiverName);
                return view('rootcaregiver_dashboard_page')->with('name', $caregiverName);
            }       

			Log::debug("DashboardController@index(): caregiver >view caregiver_dashboard_page, name=".$caregiverName);
            //Otherwise Return caregiver dashboard.
            return view('caregiver_dashboard_page')->with('name', $caregiverName);
        }
        
        else if(Auth::guard('participant')->check()){
			//Log::debug("DashboardController@index(): participant");
            //Get Authenticated Participant First name to display on dashboard.
            $participantName = Auth::guard('participant')->user()->FirstName;
            $tempPassCheck = Auth::guard('participant')->user()->PasswordReset;
			
			Log::debug("DashboardController@index(): admin name=".$participantName.", tempPassCheck=".$tempPassCheck);
            
            if((strcmp($tempPassCheck, "pending") === 0)){
				Log::debug("DashboardController@index(): pass. pending participant >redirect /passwordchangeparticipant; name=".$participantName.", tempPassCheck=".$tempPassCheck);
                return redirect('/passwordchangeparticipant')->with('message', 'Temporary password detected please change below.');
            }
			Log::debug("DashboardController@index(): participant >view participant_dashboard_page, name=".$participantName."; tempPassCheck=".$tempPassCheck);
            return  view('participant_dashboard_page')->with('name', $participantName);
        }
		//Log::debug("DashboardController@index(): guest");

		Log::debug("DashboardController@index(): guest >view guest_home_page");
        //Return view for application landing page if no user is logged in.
        return view('guest_home_page');

    }
}