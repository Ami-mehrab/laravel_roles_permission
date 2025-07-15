<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\MyJob;
use Illuminate\Http\Request;

class JobController extends Controller
{


    public function showApplyForm($id)
    {
        $job = MyJob::findOrFail($id);
        $user = auth()->user();

        if (!$user->hasRole('Candidate')) {
            abort(403, 'Only candidates can apply.');
        }
        //if status inactive apply button is invisible in the show.blade 
        if ($job->status === 'inactive') {
            return redirect()->back()->with('error', 'This job is no longer accepting applications.');
        }

        return view('candidate.jobs.apply_form', compact('job'));
    }
    public function submitApplication(Request $request, $id)
    {
        $user = auth()->user();

        if (!$user->hasRole('Candidate')) {
            abort(403, 'Only candidates can apply.');
        }


        $job = MyJob::findOrFail($id);

        if ($job->status === 'inactive') {
            return redirect()->back()->with('error', 'This job is no longer accepting applications.');
        }

        // Allow applying to different jobs, but not the same one twice
        $alreadyApplied = $job->applicants()->where('user_id', $user->id)->exists();

        if ($alreadyApplied) {
            return redirect()->back()->with('error', 'You have already applied for this job.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'document' => 'required|mimes:pdf|max:2048',
        ]);

        $resumePath = $request->file('document')->store('applications', 'public');

        $job->applicants()->attach($user->id, [
            'applicant_name' => $validated['name'],
            'applicant_email' => $validated['email'],
            'resume_path' => $resumePath,
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        return redirect()->route('candidate.applications', $job->id)
            ->with('success', 'Application submitted successfully!');
    }

    // showing applied jobs

    public function myApplications()
    {
        $user = auth()->user();

        if (!$user->hasRole('Candidate')) {
            abort(403);
        }

        $appliedJobs = $user->appliedJobs()->latest()->get();

        return view('candidate.jobs.dashboard', compact('appliedJobs'));
    }
}
