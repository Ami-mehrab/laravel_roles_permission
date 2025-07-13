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
        $user = auth()->user();

        // Access Control
        // if ($user->hasRole('Employer') && $job->created_by_id !== $user->id) {
        //     abort(403, 'You do not own this job.');
        // }

        return view('employer.jobs.application', compact('job'));
    }
}
