<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Caregiver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminReg;
use App\Mail\CaregiverReg;
use App\Models\Caregiver;

class CaregiverRegistrationController extends Controller
{

    public function index()
    {

        //Checking if an Caregiver is not logged in if they are not redirect to adminlogin page.
        if(!Auth::guard('admin')->check()){
          if(Auth::guard('participant')->check()){
                //If Patient logged in Redirect to Patient Dashboard.
                return redirect('/');
            }
            return redirect('/adminlogin');
        }

        //Check Authenticated Administrator type redirect to dashboard if authenticated admin is not Root.
        //$caregiverType = Auth::guard('')->user()->RootCarevier;
        // if(!$caregiverType){
        //     return redirect('/')->with('message', 'Unauthorized Caregiver');
        // }
      return view ('RegisterCaregiver');

    }

    public function register(Request $request)
    {

        //Checking if an Admin is not logged in if they are not redirect to adminlogin page.

        if(!Auth::guard('admin')->check()){
            if(Auth::guard('participant')->check()){
                 //If Patient logged in Redirect to Patient Dashboard.
                 return redirect('/');
            }
            return redirect('/adminlogin');
        }

        //Check Authenticated Administrator type redirect to dashboard if authenticated admin is not Root.
        // $caregiverType = Auth::guard('caregiver')->user()->RootCaregiver;
        // if(!$caregiverType){
        //     return redirect('/')->with('message', 'Unauthorized Caregiver');
        //}

        $this->validate($request, [
            'firstname' => 'required',
            'password' => 'required|min:6',
            'lastname' => 'required',
            'username' => 'required',
        ]);


        $existanceTest = Caregiver::where('Username', $request->input('username'))->first();

        if($existanceTest)
        {
            return redirect('/')->with('message', 'Caregiver registration failed Username already exists.');
        }


        $caregiver = new Caregiver();

        $caregiver->username = $request->input('username');
        $caregiver->password = Hash::make($request->input('password'));
        $caregiver->firstname = $request->input('firstname');
        $caregiver->lastname = $request->input('lastname');

        $caregiver->save();

        // $details = [
        //     'temppass' => $request->input('password')
        // ];

        // Mail::to($request->input('username'))->send(new AdminReg($details));


        return redirect('/')->with('message', 'Caregiver registration successful.');
    }
}