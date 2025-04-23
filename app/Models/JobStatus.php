<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    //

    protected $table = 'job_status';

    protected $fillable = [
        'name',
    ];
    public function jobs()
    {
        // hasMany because job status can have many jobs
        return $this->hasMany(Job::class);
    }

    public function userApplications()
    {
        // hasMany because job status can have many user applications
        return $this->hasMany(UserApplication::class);
    }

    
}
