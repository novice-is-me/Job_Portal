<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWorkExperience extends Model
{
    //

    protected $fillable = [
        'user_id',
        'name',
        'company',
        'address',
        'start_date',
        'end_date'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
