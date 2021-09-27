<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Participant extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'PARTICIPANT_PROFILE';    
    protected $primaryKey = 'username';
    protected $keyType = 'string';
    protected $hidden = ['password'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "username",
        "password",
        "FirstName",
        "LastName",
        "DOB",
    ];
}