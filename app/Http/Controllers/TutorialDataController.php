<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TutorialData;
use Illuminate\Support\Facades\Log;

class TutorialDataController extends Controller
{
    public function storeInteractionData(Request $request)
	{    
        // Log::debug("TutorialDataController.storeInteractionData(): request contains...");
		// Log::debug($request);
        
        $td = new TutorialData;
        
        $tutorial_id = $request->tutorial_id;
        $step_id = $request->step_id;
        $event_type = $request->event_type;
        $video_path = $request->video_path;
        $user_time = $request->user_time;
        $time_spent = $request->time_spent;
        $meta_data = $request->meta_data;
        $session_count = $request->session_count;
        $event_number = $request->event_number;
        $username = $request->username;

        $td->tutorial_id = $tutorial_id;
        $td->step_id = $step_id ?? null;
        $td->event_type = $event_type ?? null;
        $td->video_path = $video_path ?? null;
        $td->user_time = date('Y-m-d H:i:s', $user_time) ?? null;
        $td->time_spent = $time_spent ?? null;
        $td->meta_data = $meta_data ?? null;
        $td->session_count = $session_count ?? null;
        $td->event_number = $event_number ?? null;
        $td->username = $username ?? null;

        $td->save();
    }
}