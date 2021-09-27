<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caregiver;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Log;

class CaregiverLoginController extends Controller
{
    public function index()
    {
		//Log::debug("CaregiverLoginController@index()");
        //Checking if there is an Authenticated user and redirecting to dashboard as they do not need to login.

        if(Auth::guard('caregiver')->check() ){
			Log::debug("CaregiverLoginController@index(): caregiver >redirect /");

            return redirect('/');
        }
        else if(Auth::guard('participant')->check()){
			Log::debug("CaregiverLoginController@index(): participant >redirect /");
			
            return redirect('/');
        }
		Log::debug("CaregiverLoginController@index(): none >view CaregiverLogin");

        return view('CaregiverLogin');
    }

    public function login(Request $request)
    {
		//Log::debug("CaregiverLoginController@login()");

         //Checking if there is an Authenticated user and redirecting to dashboard as they do not need to login Even thou this.
         //THis is a POST method however user cannot get here without the Login Pages Sign in Button.

        if(Auth::guard('caregiver')->check() ){
			Log::debug("CaregiverLoginController@login(): caregiver >redirect /");

            return redirect('/');
        }
        else if(Auth::guard('participant')->check()){
			Log::debug("CaregiverLoginController@login(): participant >redirect /");
			
            return redirect('/');
        }

		Log::debug("CaregiverLoginController@login(): other: Validating");
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);


		//Log::debug("CaregiverLoginController@login(): If");
        if(!Auth::guard('caregiver')->attempt(['username' => $request->input('username') , 'password' => $request->input('password')])) {
			Log::debug("CaregiverLoginController@login(): If=True >back()=Invalid login details");
            return back()->with('message', 'Invalid login details');
        }
		Log::debug("CaregiverLoginController@login(): If=False >redirect /");
		
        return redirect('/');

    }
}