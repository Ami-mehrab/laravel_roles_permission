<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyJob extends Model
{
  protected $fillable = [
    'employer_id',
    'job_category',
    'job_title',
    'company_name',
    'status',
    'job_description',
    'key_responsibilities',
    'skill_requirement',
    'educational_requirements',
    'experience_requirements',
    'salary',
    'created_by_id',
    'created_by_name',
    'employer_id',
  ];

 public function applicants()
{
    return $this->belongsToMany(User::class, 'job_applications', 'job_id', 'user_id')
        ->withPivot(['applicant_name', 'applicant_email', 'resume_path'])
        ->withTimestamps();
}


}
