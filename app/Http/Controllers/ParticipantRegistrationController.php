<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Participant;
use App\Models\Condition_List;
use App\Models\Medication_List;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
//use App\Mail\EmailVerification;
use App\Models\Participant;
use Illuminate\Support\Facades\Log;

class ParticipantRegistrationController extends Controller
{
    public function index()
    {

        //Return Redirect to Dashboard if either usertype is logged in.
        if(Auth::guard('admin')->check()){
            return redirect('/');
        }

        else if(Auth::guard('caregiver')->check()){
            return redirect('/');
        }
        
        else if(Auth::guard('participant')->check()){
            return redirect('/');
        }

        //$conditionList = Condition_List::all()->pluck('Condition')->toarray();

        //$medicationList = Medication_List::all()->pluck('MedicationName')->toarray();

        return view ('Registration');//->with('conditionList' , $conditionList)->with('medicationList', $medicationList);
    }

    public function register(Request $request)
    {
		Log::debug("ParticipantRegistrationController.register");
        // if(Auth::guard('admin')->check()){
		// 	Log::debug("ParticipantRegistrationController.register: Auth::guard('admin')->check() == True");
        //     return redirect('/');
        // }
        // else 
		if(Auth::guard('participant')->check()){
			Log::debug("ParticipantRegistrationController.register: Auth::guard('participant')->check() == True");
            return redirect(' /');
        }

        

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:6',
            'firstName' => 'required',
            'lastName' => 'required',
            'dob' => 'required',           
            ]);
		
		Log::debug("ParticipantRegistrationController.register: validated");

        //$verificationCode = $request->input('verificationCode');

        $existanceTest = Participant::where('Username', $request->input('username'))->first();

        if($existanceTest)
        {
			Log::debug("ParticipantRegistrationController.register: username found in database");
            return redirect('/')->with('message', 'Registration failed, Profile with username already exists.');
        }
        
        // if((($request->input('code')) !== 0)){
        //     return view('/')->with('username', $request->input('username'))->with('password' , $request->input('password'))
        //     ->with('firstName' , $request->input('firstName'))->with('lastName' , $request->input('lastName'))
        //     ->with('dob', $request->input('dob'))
        //     ->with('gender', $request->input('gender'));//->with('condition', $request->input('condition'))->with('medication', $request->input('medication'));
        //     //->with('verificationCode', $verificationCode)->with('message' , 'Incorrect Verification Code. Please check email.'); 
        //}

        $participant = new Participant();

        // $conditionElements = Condition_List::where('id', $request -> input('Condition') + 1)->first()->pluck('Condition');
        // $conditionValue = $conditionElements[0];


        $participant->username = $request->input('username');
        $participant->password = Hash::make($request->input('password'));
        $participant->FirstName = $request->input('firstName');
        $participant->LastName = $request->input('lastName');
        $participant->DOB = date_create($request->input('dob'));     //dd-mm-yyyy
        //$participant->Weight = $request->input('weight');
        //$participant->Height = $request->input('height');
        $participant->Gender = $request->input('gender');
        //$patient->Condition = $conditionValue;
        //$participant->Medications = json_encode($request->input('medication'));        

        $participant->save();
		
		Log::debug("ParticipantRegistrationController.register: saved");

        //Registration success redirect to homepage with message.       

        return redirect('/')->with('message', 'Participant Successfully Added to the System');

    }

    /*public function emailVerification(Request $request)
    {
        if(Auth::guard('admin')->check()){
            return redirect('/');
        }
        else if(Auth::guard('patient')->check()){

            return redirect(' /');
        }        

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
            'firstName' => 'required',
            'lastName' => 'required',
            'dob' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'gender' => 'required',
            'condition' => 'required',            
            ]);
            
        

        $existanceTest = Patient::where('Email', $request->input('email'))->first();

        if($existanceTest)
        {
            return redirect('/')->with('message', 'Registration Failed Email Profile with email already exists.');
        }

        if(($request->input('medication')) === null)
        {
            $medication = array();
        }
        else{
            $medication = $request->input('medication');
        }

        $verificationCode = Str::random(4);             

        $details = [
            'verificationCode' => $verificationCode
        ];

        Mail::to($request->input('email'))->send(new EmailVerification($details));
       
        return view('verification')->with('email', $request->input('email'))->with('password' , $request->input('password'))
        ->with('firstName' , $request->input('firstName'))->with('lastName' , $request->input('lastName'))
        ->with('dob', $request->input('dob'))->with('weight', $request->input('weight'))->with('height', $request->input('height'))
        ->with('gender', $request->input('gender'))->with('condition', $request->input('condition'))->with('medication', $medication)
        ->with('verificationCode', $verificationCode); 
        
    }*/  
}