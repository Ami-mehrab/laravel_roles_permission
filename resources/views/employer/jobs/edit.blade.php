<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Job Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2 class="mb-4">Edit Job Post</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jobs.update', $jobs->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Job Category</label>
            <input type="text" name="job_category" class="form-control" required value="{{ old('job_category', $jobs->job_category) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Job Title</label>
            <input type="text" name="job_title" class="form-control" required value="{{ old('job_title', $jobs->job_title) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Job Description</label>
            <textarea name="job_description" class="form-control" rows="4" required>{{ old('job_description', $jobs->job_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Key Responsibilities</label>
            <textarea name="key_responsibilities" class="form-control" rows="3">{{ old('key_responsibilities', $jobs->key_responsibilities) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Skill Requirements</label>
            <textarea name="skill_requirement" class="form-control" rows="3">{{ old('skill_requirement', $jobs->skill_requirement) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Educational Requirements</label>
            <textarea name="educational_requirements" class="form-control" rows="3">{{ old('educational_requirements', $jobs->educational_requirements) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Experience Requirements</label>
            <textarea name="experience_requirements" class="form-control" rows="3">{{ old('experience_requirements', $jobs->experience_requirements) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Salary</label>
            <input type="text" name="salary" class="form-control" value="{{ old('salary', $jobs->salary) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Job</button>
        <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
