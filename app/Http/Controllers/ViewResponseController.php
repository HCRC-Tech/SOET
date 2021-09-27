<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;


class ViewResponseController extends Controller
{
    public function create()
    {
        //Checking if an Admin is not logged in if they are not redirect to adminlogin page.
        if (!Auth::guard('admin')->check() && !Auth::guard('caregiver')) {

            if (Auth::guard('participant')->check()) {
                //If Patient logged in Redirect to Patient Dashboard.
                return redirect('/');
            }
            return redirect('/adminlogin');
        }

        // if (!Auth::guard('caregiver')->check()) {

        //     if (Auth::guard('participant')->check()) {
        //         //If Patient logged in Redirect to Patient Dashboard.
        //         return redirect('/');
        //     }
        //     return redirect('/caregiverlogin');
        // }

        //create an array from the responses string
        $responses = explode("|", substr($_POST['responses'], 1, -1));

        $questions = [];
        $answers = [];

        for ($i = 0; $i < count($responses) - 1; $i++) {
            $ar = explode("::", $responses[$i]);

            $questions[] = $ar[0];
            $answers[] = $ar[1];
        }

        return view('preview_responses', ['questions' => $questions, 'answers' => $answers,
            'surveyName' => $_POST['name'], 'date' => $_POST['date'], 'participant' => $_POST['participant'], 'username' => $_POST['username']]);
    }

    /**
     * Function to download data (Survey/Tutorial)
     */
    
     public function download()
    {

        return Storage::download($_POST['fileName']);
    }
}