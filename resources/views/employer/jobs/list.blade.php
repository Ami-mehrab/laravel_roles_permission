<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Job Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <h2 class="mb-4">My Job Posts</h2>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('jobs.create') }}" class="btn btn-success mb-3">+ New Job Post</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Salary</th>
                        <th>Posted At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $job->job_title }}</td>
                        <td>{{ $job->job_category }}</td>
                        <td>{{ $job->salary ?? 'N/A' }}</td>
                        <td>{{ $job->created_at->format('F j, Y') }}</td>
                        <td>


                        <td>
                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm me-1">Delete</button>
                            </form>

                            <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                        </td>


                        </td>
                    </tr>
                    @endforeach

                    @if ($jobs->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">No job posts found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>