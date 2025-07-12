

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Job Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Job Posts</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-dark">Go to Dashboard</a>
        </div>

        <!-- <h2 class="mb-4">Job Posts</h2> -->

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @can('create jobs')
        <a href="{{ route('jobs.create') }}" class="btn btn-success mb-3">+ New Job Post</a>
        @endcan

        <!-- filter by cat -->
        <div class="mb-4">
            <h5>Filter by Category:</h5>
            @php
            $categories = \App\Models\MyJob::select('job_category')->distinct()->pluck('job_category');
            @endphp

            @foreach ($categories as $cat)
            <a href="{{ route('jobs.category', $cat) }}"
                class="btn btn-outline-primary btn-sm me-1 {{ (isset($category) && $category == $cat) ? 'active' : '' }}">
                {{ ucfirst($cat) }}
            </a>
            @endforeach

            <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary btn-sm">All Jobs</a>
        </div>
        <!-- end of cat part -->

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Company Name</th>
                        <th>Salary</th>
                        <th>Created By</th>
                        <th>Posted At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $job->job_title }}</td>
                        <td>{{ $job->job_category }}</td>
                        <td>{{ $job->company_name }}</td>
                        <td>{{ $job->salary ?? 'N/A' }}</td>
                        <td>{{ $job->created_by_name ?? 'Unknown' }} (ID: {{ $job->created_by_id ?? 'N/A' }})</td>
                        <td>{{ $job->created_at->format('F j, Y') }}</td>
                        <td>
                            @if($job->status == 'active')
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            @role('candidate')
                            <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-info btn-sm me-1">View</a>
                            @endrole
                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                @csrf
                                @method('DELETE')

                                @can('delete jobs')
                                <button type="submit" class="btn btn-danger btn-sm me-1">Delete</button>
                                @endcan
                            </form>

                            @can('edit jobs')
                            <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                            @endcan
                    </tr>
                    @endforeach

                    @if ($jobs->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">
                            <h3>No job posts found.</h3>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>