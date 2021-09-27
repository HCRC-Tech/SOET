<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;
    protected $table = "steps";
    protected $fillable = [
        'tutorial_id','step_number', 'script', 'video'
    ];

    public function tutorial(){
        return $this->belongsTo(Tutorial::class);
    }
}