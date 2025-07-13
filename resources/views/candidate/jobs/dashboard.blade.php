<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 text-center">My Applied Jobs</h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="w-full max-w-6xl px-4">
            @if($appliedJobs->isEmpty())
                <div class="text-center text-gray-600 text-lg">
                    You haven't applied to any jobs yet.
                </div>
            @else
                <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
                    <table class="min-w-full table-auto text-left">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3">Job Title</th>
                                <th class="px-6 py-3">Company</th>
                                <th class="px-6 py-3">Applied At</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Resume</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appliedJobs as $job)
                            <tr class="border-t">
                                <td class="px-6 py-4">{{ $job->job_title }}</td>
                                <td class="px-6 py-4">{{ $job->company_name }}</td>
                                <td class="px-6 py-4">{{ $job->pivot->created_at->format('d M, Y') }}</td>
                                <td class="px-6 py-4">
                                    @if($job->status == 'active')
                                        <span class="text-green-600 font-semibold">Active</span>
                                    @else
                                        <span class="text-gray-500">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if(Storage::disk('public')->exists($job->pivot->resume_path))
                                        <a href="{{ asset('storage/' . $job->pivot->resume_path) }}"
                                           target="_blank"
                                           class="text-blue-600 underline">View Resume</a>
                                    @else
                                        <span class="text-red-600">Missing File</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
