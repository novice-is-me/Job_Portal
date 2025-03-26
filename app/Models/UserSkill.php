<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    //

    protected $fillable = [
        'user_id',
        'skills_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
