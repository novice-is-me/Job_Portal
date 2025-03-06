<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'name',
    ];

    public function jobs(){
        // hasMany because category can have many jobs
        return $this->hasMany(Job::class);
    }

}
