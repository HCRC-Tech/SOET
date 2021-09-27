<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use HasFactory;
    protected $table = "tutorials";
    protected $fillable = [
        'tutorial_id','number_of_steps', 'group_title','folder_path'
    ];

    public function steps(){
        return $this->hasMany(Step::class);
    }
}