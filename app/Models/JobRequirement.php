<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobRequirement extends Model
{
    //
    protected $fillable = [
        'job_id',
        'name',
        'description'
    ];
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
