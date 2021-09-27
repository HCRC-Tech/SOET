<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantReport extends Model
{
    use HasFactory;

    protected $table = 'Participant_Report';
    public $timestamps = false;

    protected $casts = [
        'cost' => 'float'
    ];

    protected $fillable = [
        'firstName',
        'lastName',
        'username',
    ];
}