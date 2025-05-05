<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'address',
        'phone',
        'resume',
        'user_type',
        'headline',
        'introduction',
        'website', 
        'linkedin', 
        'github',
        'portfolio',
        'resume',
        'cover_letter',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // User to user_application relationship
    public function applications()
    {
        // hasMany because user can have many applications
        return $this->hasMany(UserApplication::class);
    } 
    
    // This is for recruiter
    public function jobs()
    {
        // hasMany because user can have many jobs
        // recuiter_id because thats the fk name in Job table
        return $this->hasMany(Job::class, 'recruiter_id');
    }

    public function userType(){
        // user_type refers to the foreign key in the user table
        return $this->belongsTo(UserType::class, 'user_type');
    }

    public function workExperiences() {
        return $this->hasMany(UserWorkExperience::class, 'user_id');
    }

    public function educations(){
        return $this->hasMany(UserEducation::class, 'user_id');
    }

    public function skills(){
        return $this->hasMany(UserSkill::class);
    }

    public function companies(){
        return $this->belongsToMany(Company::class, 'company_recruiter', 'company_id', 'recruiter_id');
    }
}
