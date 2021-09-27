<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Video;
use Storage;
use Illuminate\Support\Facades\Log;
class VideoController extends Controller
{
   public function uploadVideo(Request $request)
   {

      Log::debug("Debugging starting from here......");
   //    $this->validate($request, [
   //       'title' => 'required|string|max:255',
   //       'video' => 'required|file|mimetypes:video/mp4',
   // ]);
   $video = new Video;
   $video->title = $request->title;
   $video->script=$request->script;
   Log::debug($request);
   Log::debug($request->allFiles());
   $file = $request->file('video');
   Log::debug($file);
   if ($file->isValid())
   {
    
    Log::debug("Looking for path to store video");
    $path = $file->storeAs('videos', ''.$request->title.".".$file->getClientOriginalExtension(), 'my_files');
	//$path = $file->store('videos', 'my_files');
    Log::debug("Detect the folder to store video: ".$path);
    $video->video = $path;
    Log::debug("Debug Path determined and stored for storing video");
   }
   else
   {
	   Log::debug("Video issue: ".$file->getErrorMessage());
   }
   $video->save();
   Log::debug("Video saved");
   return view('uploadvideo',['video'=>$path,'script'=>$request->script]);
  }

  /**
   * Function to show the video upload page
   */

   public function uploadVideoPage(){
      return view ('uploadvideo');
   }
}