<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Log;

class AdminLoginController extends Controller
{
    public function index()
    {
		//Log::debug("AdminLoginController@index()");
        //Checking if there is an Authenticated user and redirecting to dashboard as they do not need to login.

        if(Auth::guard('admin')->check() ){
			Log::debug("AdminLoginController@index(): admin >redirect /");

            return redirect('/');
        }
        
        else if(Auth::guard('participant')->check()){
			Log::debug("AdminLoginController@index(): participant >redirect /");
			
            return redirect('/');
        }
		Log::debug("AdminLoginController@index(): none >view AdminLogin");

        return view('AdminLogin');
    }

    public function login(Request $request)
    {
		//Log::debug("AdminLoginController@login()");

         //Checking if there is an Authenticated user and redirecting to dashboard as they do not need to login Even thou this.
         //THis is a POST method however user cannot get here without the Login Pages Sign in Button.

        if(Auth::guard('admin')->check() ){
			Log::debug("AdminLoginController@login(): admin >redirect /");

            return redirect('/');
        }
        else if(Auth::guard('participant')->check()){
			Log::debug("AdminLoginController@login(): participant >redirect /");
			
            return redirect('/');
        }

		Log::debug("AdminLoginController@login(): other: Validating");
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);


		//Log::debug("AdminLoginController@login(): If");
        if(!Auth::guard('admin')->attempt(['username' => $request->input('username') , 'password' => $request->input('password')])) {
			Log::debug("AdminLoginController@login(): If=True >back()=Invalid login details");
            return back()->with('message', 'Invalid login details');
        }
		Log::debug("AdminLoginController@login(): If=False >redirect /");
		
        return redirect('/');

    }
}