<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'email',
        'image',
        'address',
        'no_employees'
    ];

    public function jobs(){
        // hasMany because company can have many jobs
        return $this->hasMany(Job::class);
    }
}
