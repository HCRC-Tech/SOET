<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ParticipantRegAccept;

class AcceptanceController extends Controller
{
    public function create()
    {

//         //Checking if an Admin is not logged in if they are not redirect to adminlogin page.
         if(!Auth::guard('admin')->check() && !Auth::guard('caregiver')){

            if(Auth::guard('participant')->check()){
                 //If Participant logged in Redirect to Participant Dashboard.
                 return redirect('/');
            }
            return redirect('/adminlogin');
        }

        //get a list of the newly registered participant
        $newParticipants = Participant::select(['FirstName', 'LastName', 'Username'])->where("NewAccount", true)->get();

        $newParticipantsInfo = [];
        for ($i = 0; $i < count($newParticipants); $i++) {
            $participant = $newParticipants->all()[$i]->toArray();
            $participant = $participant["FirstName"] . " " . $participant["LastName"] . " (" . $participant["Username"] . ")";
            $newParticipantsInfo[] = $participant;
        }

        //pass the list of new participants to be displayed in the list
        return view('new_participant_registeration', ["participant" => $newParticipantsInfo]);
    }

    public function store()
    {

        //Checking if an Admin is not logged in if they are not redirect to adminlogin page.
         if(!Auth::guard('admin')->check()){

            if(Auth::guard('participant')->check()){
                 //If Particpant logged in Redirect to Participant Dashboard.
                 return redirect('/');
            }
            return redirect('/adminlogin');
        }

        if (!isset($_POST['data'])) {
            return view("Admin_dashboard_page");
        }


        $submittedData = $_POST['data'];
        unset($submittedData["_token"]);

        //dd($submittedData);

        $accepted = [];
        $removed = [];

        //iterate over each returned element in the form, and check whether this participant was accepted or removed
        foreach ($submittedData as $key => $value) {
            $username = substr(explode(" (", $key)[1],0,-1);
            if ($value == "Accept") {
                $accepted[] = $username;
            } else {
                $removed[] = $username;
            }
        }


        //for each accepted participant, change the value of its corresponding "New Account" attribute to false
        foreach ($accepted as $acceptedUsername) {
            Participant::where('Username', $acceptedUsername)->update(array('NewAccount' => false));


            //Mail::to($acceptedUsername)->send(new ParticipantRegAccept());

        }

        foreach ($removed as $removedUsername) {
            Participant::where('Username', '=', $removedUsername)->delete();
        }

        return redirect('/');
    }
}