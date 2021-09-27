<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\ParticipantReport;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParticipantLoginController extends Controller
{
    public function index()
    {
		//Log::debug("ParticipantLoginController.index()");
        //Checking if there is an Authenticated user and redirecting to dashboard as they do not need to login.

        if (Auth::guard('admin')->check()) {
			Log::debug("ParticipantLoginController.index(): admin >redirect /");

            return redirect('/');
            
        } 
        
        else if (Auth::guard('participant')->check()) {
			Log::debug("ParticipantLoginController.index(): participant >redirect /");
			
            return redirect('/');
        }
		Log::debug("ParticipantLoginController.index(): none >view Participant_Login");

        return view('Participant_Login');
    }

    // Below is the newly added function for participant login
    // Working Version

    public function login(Request $request)
    {
		//Log::debug("ParticipantLoginController.login()");

         //Checking if there is an Authenticated user and redirecting to dashboard as they do not need to login Even thou this.
         //THis is a POST method however user cannot get here without the Login Pages Sign in Button.

        if(Auth::guard('admin')->check()){
			Log::debug("ParticipantLoginController.login(): admin >redirect /");

            return redirect('/');
        }

        else if(Auth::guard('caregiver')->check()){
			Log::debug("ParticipantLoginController.login(): caregiver >redirect /");
			
            return redirect('/');
        }
        
        else if(Auth::guard('participant')->check()){
			Log::debug("ParticipantLoginController.login(): participant >redirect /");
			
            return redirect('/');
        }

		Log::debug("ParticipantLoginController.login(): other: Validating");
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);


		//Log::debug("ParticipantLoginController.login(): If");
        if(!Auth::guard('participant')->attempt(['username' => $request->input('username') , 'password' => $request->input('password')])) {
			Log::debug("ParticipantLoginController.login(): If=True >back()=Invalid login details");
            return back()->with('message', 'Invalid login details');
        }
		Log::debug("ParticipantLoginController.login(): If=False >redirect /");
		
        return redirect('/');

    }

    /*public function login(Request $request)
    {

        //Checking if there is an Authenticated user and redirecting to dashboard as they do not need to login Even though this.
        //THis is a POST method however user cannot get here without the Login Pages Sign in Button.

        if (Auth::guard('admin')->check()) {

            return redirect('/');
        } else if (Auth::guard('participant')->check()) {
            return redirect('/');
        }


        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);


        //Check if Registration has been accepted if not redirect to'/' with alert.
        $acceptanceCheck = Participant::select('NewAccount')->where('username', $request->input('username'))->first();
        
        
        if($acceptanceCheck['NewAccount']){
            return redirect('/')->with('message', 'Account registration not yet reviewed.');
        }    
        //Attempt auth if password is incorrect redirect bacsk to page.
        if(!Auth::guard('admin')->attempt(['username' => $request->input('username') , 'password' => $request->input('password')])) {
            return back()->with('message', 'Invalid login details');
        }
        return redirect('/');

    }**/
}