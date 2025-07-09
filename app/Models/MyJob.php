<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyJob extends Model
{
      protected $fillable = [
        'employer_id',
        'job_category',
        'job_title',
        'job_description',
        'key_responsibilities',
        'skill_requirement',
        'educational_requirements',
        'experience_requirements',
        'salary',
    ];
}
