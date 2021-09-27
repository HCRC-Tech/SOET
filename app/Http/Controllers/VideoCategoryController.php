<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Tutorial;
use Illuminate\Support\Facades\Log;


class VideoCategoryController extends Controller
{
    public function index(){
		Log::debug("VideoCategoryController.index()");
        return view('videoCategory');
    }

    public function show(){
		Log::debug("VideoCategoryController.show()");
        return view('videoCategory');
    }

    public function createTutorial(Request $request){
        Log::debug("VideoCategoryController.createTutorial()");
        //Read Request and add tutorial to database.
        $tutorial = new Tutorial; // Create Tutorial model to fill it with info
        $tutorial->number_of_steps = $request->numSteps;
        $tutorial->group_title = $request->title;
        
        $path = htmlspecialchars($request->title);
        $path = stripslashes($path);
        $path = trim($path);
        
        $tutorial->folder_path = "videos"."/".$path;
        $tutorial->save();
        return view('uploadvideo',['path'=>'', 'tutorialID'=>$tutorial->id, 'tutorialName'=>$request->title, 'numSteps'=>$request->numSteps, 'stepID'=>'', 'stepNumber'=>'1']);
    }
}