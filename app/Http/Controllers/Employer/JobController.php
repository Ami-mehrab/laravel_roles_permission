<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\MyJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function Pest\Laravel\get;

class JobController extends Controller
{
   public function index()
{
    $user = auth()->user();

    if ($user->hasRole('Super Admin')) {

        $jobs = MyJob::latest()->get();
    }
     elseif ($user->hasRole('Employer')) {

        $jobs = MyJob::where('created_by_id', $user->id)->latest()->get();
    } 
    elseif ($user->hasRole('Candidate')) {

        $jobs = MyJob::latest()->get();  //  Candidate sees all jobs
    } 
    else {
        abort(403);
    }

    return view('employer.jobs.list', compact('jobs'));
}


    public function create()
    {
        return view('employer.jobs.create');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'job_category' => 'required',
            'job_title' => 'required',
            'job_description' => 'required',

        ]);

        if ($validation->passes()) {
            MyJob::create([

                'job_category' => $request->job_category,
                'job_title' => $request->job_title,
                'job_description' => $request->job_description,
                'key_responsibilities' => $request->key_responsibilities,
                'skill_requirement' => $request->skill_requirement,
                'educational_requirements' => $request->educational_requirements,
                'experience_requirements' => $request->experience_requirements,
                'salary' => $request->salary,
                'created_by_id' => Auth::id(),
                'created_by_name' => Auth::user()->name,
                'employer_id' => Auth::id(),
            ]);

            return redirect()->route('jobs.index')->with('success', 'Job posted successfully.');
        }

        return redirect()->route('jobs.create')->withErrors($validation)->withInput();
    }

    public function show(string $id)
    {
        $user = auth()->user();

        if (!$user->hasRole('Candidate')) {
            abort(403, 'Only candidates can view job details.');
        }

        $job = MyJob::findOrFail($id);

        return view('candidate.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)

    {
        $jobs = MyJob::findorFail($id);
        return view('employer.jobs.edit', compact('jobs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_category' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string',
        ]);

        if ($validator->passes()) {
            $job = myjob::findOrFail($id);

            $job->job_category = $request->job_category;
            $job->job_title = $request->job_title;
            $job->job_description = $request->job_description;
            $job->key_responsibilities = $request->key_responsibilities;
            $job->skill_requirement = $request->skill_requirement;
            $job->educational_requirements = $request->educational_requirements;
            $job->experience_requirements = $request->experience_requirements;
            $job->salary = $request->salary;
            $job->save();

            return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
        } else {
            return redirect()->route('jobs.edit', $id)->withInput()->withErrors($validator);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $job = myjob::findOrFail($id);
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}
