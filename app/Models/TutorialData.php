<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorialData extends Model
{
    use HasFactory;
    protected $table = "tutorial_data";
    protected $fillable = [
        'event_number','username','tutorial_id','step_id','event_type','video_path','user_time','time_spent','session_count','meta_data',
    ];
}