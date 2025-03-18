<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'status',
        'work_setup',
        'address',
        'company_id',
        'salary',
        'type',
        'category_id',
        'recruiter_id',
        'experience_id',
        'about_role',
        'responsibilities',
        'requirements',
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

    public function company(){
        // belongs to because job belongs to a company
        return $this->belongsTo(Company::class);
    }

    public function skills(){
        return $this->belongsToMany(Skill::class);
    }
}
