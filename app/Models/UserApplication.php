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
        'status',
        'interview_at',
    ];

    public function user(){
        // belongs to because user_application belongs to a user
        return $this->belongsTo(User::class);
    }

    public function job(){
        // belongs to because user_application belongs to a job
        return $this->belongsTo(Job::class);
    }

    public function jobStatus()
    {
        // hasMany because job status can have many application status
        return $this->belongsTo(JobStatus::class, 'status');
    }
}
