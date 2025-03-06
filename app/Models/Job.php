<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $fillable = [
        'name',
        'content',
        'status',
        'address',
        'company',
        'salary',
        'type',
        'category_id',
        'recruiter_id',
    ];

    public function category(){
        // belongs to because job belongs to a category
        return $this->belongsTo(Category::class);
    }

    public function recruiter(){
        // belongs to because job belongs to a recruiter
        return $this->belongsTo(User::class);
    }

    public function applications(){
        // hasMany because job can have many applications
        return $this->hasMany(UserApplication::class);
    }
}
