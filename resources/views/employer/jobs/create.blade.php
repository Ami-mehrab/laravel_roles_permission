<x-app-layout>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Job Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <h2 class="mb-4">Post a New Job</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('jobs.store') }}" method="POST">
            @csrf
           
            <div class="mb-3">
                <label class="form-label">Job Category</label>
                <input type="text" name="job_category" class="form-control" required value="{{ old('job_category') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Job Title</label>
                <input type="text" name="job_title" class="form-control" required value="{{ old('job_title') }}">
            </div>
             <!-- Company Name -->
             <div class="mb-3">
                <label class="form-label">Company Name</label>
                <input type="text" name="company_name" class="form-control" required value="{{ old('company_name') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Job Description</label>
                <textarea name="job_description" class="form-control" rows="4" required>{{ old('job_description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Key Responsibilities</label>
                <textarea name="key_responsibilities" class="form-control" rows="3">{{ old('key_responsibilities') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Skill Requirements</label>
                <textarea name="skill_requirement" class="form-control" rows="3">{{ old('skill_requirement') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Educational Requirements</label>
                <textarea name="educational_requirements" class="form-control" rows="3">{{ old('educational_requirements') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Experience Requirements</label>
                <textarea name="experience_requirements" class="form-control" rows="3">{{ old('experience_requirements') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Salary</label>
                <input type="text" name="salary" class="form-control" value="{{ old('salary') }}">
            </div>


            <!-- Status -->
            <div class="mb-3">
                <label class="form-label d-block">Status</label>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="statusActive" value="active"
                        {{ old('status') == 'active' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="statusActive">Active</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="statusInactive" value="inactive"
                        {{ old('status') == 'inactive' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="statusInactive">Inactive</label>
                </div>
            </div>

            @can('create jobs')
            <button type="submit" class="btn btn-primary">Post Job</button>
            @endcan
            <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>

</html>
</x-app-layout>