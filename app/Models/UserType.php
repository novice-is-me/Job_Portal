<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    // 
    protected $fillable = [
        'name',
    ];

    public function users(){
        // hasMany because user_type can have many users
        return $this->hasMany(User::class);
    }
}
