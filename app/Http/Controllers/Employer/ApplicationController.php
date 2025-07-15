<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\MyJob;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
     public function index($id)
    {
        $job = MyJob::with('applicants')->findOrFail($id);
    

       

        return view('employer.jobs.application', compact('job'));
    }
}
