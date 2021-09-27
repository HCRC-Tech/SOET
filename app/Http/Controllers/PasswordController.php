<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetMail;
use Illuminate\Support\Facades\Log;

class PasswordController extends Controller
{
    public function create()
    {

        //Checking if an Admin is not logged in if they are not redirect to adminlogin page.
        if(!Auth::guard('admin')->check() && !Auth::guard('caregiver')){
                if(Auth::guard('participant')->check()){
                        //If Patient logged in Redirect to Patient Dashboard.
                    return redirect('/');
                }
           return redirect('/adminlogin');
       }


       //Checking If an caregiver is not logged in if they are not redirect to caregiver login page


        //get a list of the patients that submitted a request to reset their password
        $passwordResetRequests = Participant::select(['FirstName', 'LastName', 'Username'])->where('NewAccount', 'false')->where("PasswordReset", "true")->get();

        $participantsInfo = [];
        for ($i = 0; $i < count($passwordResetRequests); $i++) {
            $participant = $passwordResetRequests->all()[$i]->toArray();
            $participant = $participant["FirstName"] . " " . $participant["LastName"] . " (" . $participant["Username"] . ")";
            $participantsInfo[] = $participant;
        }

        return view('PasswordReset', ["participants" => $participantsInfo]);
    }

    public function store()
    {

        //Checking if an Admin is not logged in if they are not redirect to adminlogin page.
        if(!Auth::guard('admin')->check()){
                if(Auth::guard('participant')->check()){
                    //If Patient logged in Redirect to Patient Dashboard.
                    return redirect('/');
               }
            return redirect('/adminlogin');
        }

        

        // checking for caregiver
        

        if (!isset($_POST['data'])) {
            return view("Admin_dashboard_page");
        }

        $submittedData = $_POST['data'];
        unset($submittedData["_token"]);



        $accepted = [];
        $removed = [];

        //iterate over each returned element in the form, and check whether this patient was accepted or removed
        foreach ($submittedData as $key => $value) {
            $username = substr(explode(" (", $key)[1],0,-1);
            if ($value == "Accept") {
                $accepted[] = $username;

            } else {
                $removed[] = $username;
            }
        }


        //for each accepted password-reset request, create a temporary password ("pending" indicates that the patient has not set a permanent password yet)
        foreach ($accepted as $acceptedUsername) {
            $tempPassword = Str::random(8);

            $details = [
                'temppass' => $tempPassword
            ];

            Mail::to($acceptedUsername)->send(new ResetMail($details));
            Participant::where('username', $acceptedUsername)->update(array('PasswordReset' => "pending", "password" => Hash::make($tempPassword)));
        }

        foreach ($removed as $removedUsername) {
            Participant::where('username', $removedUsername)->update(array('PasswordReset' => "false"));
        }

        return redirect('/');
    }

    public function participantchange(){

          //Check if Patient is logged in.
        if(!Auth::guard('admin')->check() && !Auth::guard('caregiver')){
            return redirect('/');
        }
            //return redirect('/')->with('message', 'No user logged in.');

            return view('participant_password_change');
    }

    public function participantsave(Request $request){

        //Check if Patient is logged in.
           if(!Auth::guard('participant')->check()){
            if(Auth::guard('admin')->check() || Auth::guard('caregiver')->check()){
                return redirect('/');
            }
            return redirect('/')->with('message', 'No user logged in.');
        }



        //Password Requirements and Confirmation.
        $this->validate($request, [
            'currentpass' => 'required',
            'password' => 'required|min:6',
            'password2' => 'same:password',
        ]);

        //As user is currently logged in get the currently authenticated user and change their password.
        $currentUser = Auth::guard('participant')->user();
        $currentUsername = $currentUser->username;

        if(!Auth::guard('participant')->validate(['username' => $currentUsername , 'password' => $request->input('currentpass')])){
            return redirect('/passwordchangeparticipant')->with('message', 'Current Password is incorrect.');
        }

        $currentUser->password = Hash::make($request->input('password'));


        //Check if current password is temprary and turn flag to false if so.
        $tempPassCheck = Auth::guard('participant')->user()->PasswordReset;

        if((strcmp($tempPassCheck, "pending") === 0)){
            $currentUser->PasswordReset = "false";
        }

        $currentUser->save();

        //Redirect to dash with success message.
        return redirect('/')->with('message', 'Password changed successfully.');
    }

    public function adminchange(){

          //Check if Admin is logged in.
          if(!Auth::guard('admin')->check()){
            if(Auth::guard('participant')->check()){
                return redirect('/');
            }
            return redirect('/')->with('message', 'No user logged in.');
        }

        return view('admin_password_change');


    }
    
    // for caregiver change
    
    public function caregiverchange(){

          //Check if Admin is logged in.
          if(!Auth::guard('caregiver')->check()){
            if(Auth::guard('participant')->check()){
                return redirect('/');
            }
            return redirect('/')->with('message', 'No user logged in.');
        }

        return view('caregiver_password_change');


    }

    public function adminsave(Request $request){
    //Check if Admin is logged in.
    if(!Auth::guard('admin')->check()){
        if(Auth::guard('participant')->check()){
            return redirect('/');
        }
        return redirect('/')->with('message', 'No user logged in.');
    }



    //Password Requirements and Confirmation.
    $this->validate($request, [
        'currentpass' => 'required',
        'password' => 'required|min:6',
        'password2' => 'same:password',
    ]);

    //As user is currently logged in get the currently authenticated user and change their password.
    $currentUser = Auth::guard('admin')->user();
    $currentUsername = $currentUser->username;

    if(!Auth::guard('admin')->validate(['username' => $currentUsername , 'password' => $request->input('currentpass')])){
        return redirect('/passwordchangeparticipant')->with('message', 'Current Password is incorrect.');
    }

    $currentUser->password = Hash::make($request->input('password'));
    $currentUser->save();

    //Redirect to dash with success message.
    return redirect('/')->with('message', 'Password changed successfully.');
    }

    // For caregiver

    public function caregiversave(Request $request){
    //Check if Admin is logged in.
    if(!Auth::guard('caregiver')->check()){
        if(Auth::guard('participant')->check()){
            return redirect('/');
        }
        return redirect('/')->with('message', 'No user logged in.');
    }



    //Password Requirements and Confirmation.
    $this->validate($request, [
        'currentpass' => 'required',
        'password' => 'required|min:6',
        'password2' => 'same:password',
    ]);

    //As user is currently logged in get the currently authenticated user and change their password.
    $currentUser = Auth::guard('caregiver')->user();
    $currentUsername = $currentUser->username;

    if(!Auth::guard('caregiver')->validate(['username' => $currentUsername , 'password' => $request->input('currentpass')])){
        return redirect('/passwordchangeparticipant')->with('message', 'Current Password is incorrect.');
    }

    $currentUser->password = Hash::make($request->input('password'));
    $currentUser->save();

    //Redirect to dash with success message.
    return redirect('/')->with('message', 'Password changed successfully.');
    }

    public function adminresetindex(){

     //Checking if there is an Authenticated user and redirecting to dashboard as they do not need to reset password.
    if (Auth::guard('admin')->check()) {

        return redirect('/');
    } else if (Auth::guard('participant')->check()) {
        return redirect('/');
    }

    return view('admin_reset');
    }

    // For caregiver

    public function caregiverresetindex(){

     //Checking if there is an Authenticated user and redirecting to dashboard as they do not need to reset password.
    if (Auth::guard('caregiver')->check()) {

        return redirect('/');
    } else if (Auth::guard('participant')->check()) {
        return redirect('/');
    }

    return view('caregiver_reset');
    }

    public function adminresetusername(Request $request){
        //Checking if there is an Authenticated user and redirecting to dashboard as they do not need to reset password.

        if (Auth::guard('admin')->check()) {
            return redirect('/');
        } else if (Auth::guard('participant')->check()) {
            return redirect('/');
        }

        $this->validate($request, [
            'username' => 'required|username',
        ]);


        //Check if Admin profile with input email exists.
        $existanceTest = Admin::where('Username', $request->input('username'))->first();

        if(!$existanceTest)
        {
            return redirect('/adminreset')->with('message', 'Request Failed. Administrator Profile with username does not exist');
        }

        $tempPassword = Str::random(8);

        $details = [
            'temppass' => $tempPassword
        ];

        Mail::to($request->input('username'))->send(new ResetMail($details));

        Admin::where('Username', $request->input('username'))->update(array("password" => Hash::make($tempPassword)));

        return redirect('/')->with('message', 'Administrator password reset successful please check username.');
        }


        // For caregiver
        public function caregiverresetusername(Request $request){
        //Checking if there is an Authenticated user and redirecting to dashboard as they do not need to reset password.

        if (Auth::guard('caregiver')->check()) {
            return redirect('/');
        } else if (Auth::guard('participant')->check()) {
            return redirect('/');
        }

        $this->validate($request, [
            'username' => 'required|username',
        ]);


        //Check if Admin profile with input email exists.
        $existanceTest = Admin::where('Username', $request->input('username'))->first();

        if(!$existanceTest)
        {
            return redirect('/caregiverreset')->with('message', 'Request Failed. Administrator Profile with username does not exist');
        }

        $tempPassword = Str::random(8);

        $details = [
            'temppass' => $tempPassword
        ];

        //Mail::to($request->input('username'))->send(new ResetMail($details));

        Admin::where('Username', $request->input('username'))->update(array("password" => Hash::make($tempPassword)));

        return redirect('/')->with('message', 'Administrator password reset successful please check username.');
        }
    public function participantresetindex(){

        //Checking if there is an Authenticated user and redirecting to dashboard as they do not need to reset password.
       if (Auth::guard('admin')->check()) {

           return redirect('/');
       } else if (Auth::guard('participant')->check()) {
           return redirect('/');
       }

       return view('participant_reset');
    }

    public function participantresetrequest(Request $request){


        if (Auth::guard('admin')->check()) {
            return redirect('/');
        } else if (Auth::guard('participant')->check()) {
            return redirect('/');
        }

        $this->validate($request, [
            'username' => 'required|username',
        ]);


        //Check if Patient profile with input email exists.
        $existanceTest = Participant::where('Username', $request->input('username'))->first();

        if(!$existanceTest)
        {
            return redirect('/participantreset')->with('message', 'Request Failed. Participant Profile with  does not exist');
        }

        Participant::where('username', $request->input('username'))->update(array('PasswordReset' => "true",));

        return redirect('/')->with('message', 'Password reset request sent for Administrator review. Response will be sent to Admin.');

    }

    /*
       Function to chnage password for Participant.
       Action performed by Admin or Caregiver.
       @param $request
    */
    public function participantPasswordChange(Request $request){
        
        Log::debug("PasswordController.ParticipantPasswordChange() gets called");
        if(!Auth::guard('admin')->check() && !Auth::guard('caregiver')->check()){
            Log::debug("!Admin || !Caregiver redirected to root");
            return redirect('/');
        }
        
       $this->validate($request, [
        'username' => 'required',
        'password' => 'required|min:6',
        'password2' => 'same:password',
        ]);
        Log::debug("username validated");

        
        
        $existanceTest = Participant::where('Username', $request->input('username'))->first();
        Log::debug("Participant existence checked");

        if(!$existanceTest)
        {
            Log::debug("Participant Does Not Exist");
            return redirect('/participantpasswordreset')->with('message', 'Request Failed. Participant Profile does not exist');
        }
        
        $currentUser= $existanceTest;
        $currentUsername = $request->input('username');

    // if(!Auth::guard('participant')->validate(['username' => $currentUsername , 'password' => $request->input('currentpass')])){
    //     return redirect('/passwordchangeparticipant')->with('message', 'Current Password is incorrect.');
    // }

        $currentUser->password = Hash::make($request->input('password'));
        $currentUser->save();
        
        Participant::where('username', $request->input('username'))->update(array('PasswordReset' => "true",));
        Log::debug("Password updated");
        return redirect('/')->with('message', 'Password Successfully Changed for the User.');
    }
}