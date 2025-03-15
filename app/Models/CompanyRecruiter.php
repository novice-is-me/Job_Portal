<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRecruiter extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'company_id',
        'recruiter_id'
    ];
}
