<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\MyJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Pest\Laravel\get;

class JobController extends Controller
{
  public function index()
    {
        $jobs = MyJob::latest()->get();
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
                'employer_id' => auth()->id(),
                'job_category' => $request->job_category,
                'job_title' => $request->job_title,
                'job_description' => $request->job_description,
                'key_responsibilities' => $request->key_responsibilities,
                'skill_requirement' => $request->skill_requirement,
                'educational_requirements' => $request->educational_requirements,
                'experience_requirements' => $request->experience_requirements,
                'salary' => $request->salary,
            ]);

            return redirect()->route('jobs.index')->with('success', 'Job posted successfully.');
        }

        return redirect()->route('jobs.create')->withErrors($validation)->withInput();
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    
    {
         $jobs=MyJob::findorFail($id);
        return view('employer.jobs.edit',compact('jobs'));
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
