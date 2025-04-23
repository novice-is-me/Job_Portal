<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApplication extends Model
{
    //
    use HasFactory;
    
    protected $fillable = [
        'job_id',
        'user_id',
        'is_applied',
    ];

    public function user(){
        // belongs to because user_application belongs to a user
        return $this->belongsTo(User::class);
    }

    public function job(){
        // belongs to because user_application belongs to a job
        return $this->belongsTo(Job::class);
    }
}
