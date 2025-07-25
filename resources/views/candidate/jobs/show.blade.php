<x-app-layout>
    <x-slot name="header">
        @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ __('Job Post Details') }}
            </h2>

            <a href="{{ route('jobs.index') }}"
                class="px-6 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-800">

                    <div>
                        <span class="font-semibold">Job Title:</span>
                        <div>{{ $job->job_title }}</div>
                    </div>

                    <div>
                        <span class="font-semibold">Company Name:</span>
                        <div>{{ $job->company_name }}</div>
                    </div>

                    <div>
                        <span class="font-semibold">Location:</span>
                        <div>{{ $job->location }}</div>
                    </div>

                    <div>
                        <span class="font-semibold">Job Type:</span>
                        <div class="capitalize">{{ $job->job_type }}</div>
                    </div>

                    <div>
                        <span class="font-semibold">Key Responsibilities</span>
                        <div class="capitalize">{{ $job->key_responsibilities ?? 'N/A' }}</div>
                    </div>

                    <div>
                        <span class="font-semibold">Salary Range:</span>
                        <div>{{ $job->salary ?? 'N/A' }}</div>
                    </div>

                    <div>
                        <span class="font-semibold">Experience Required:</span>
                        <div>{{ $job->experience_requirements ? $job->experience_requirements . ' year(s)' : 'Not specified' }}</div>
                    </div>

                    <div>
                        <span class="font-semibold">Education Level:</span>
                        <div>{{ $job->educational_requirements ?? 'N/A' }}</div>
                    </div>

                    <div>
                        <span class="font-semibold">Application Deadline:</span>
                        <div>{{ $job->application_deadline ?? 'Not set' }}</div>
                    </div>

                    <div>
                        <span class="font-semibold">Status:</span>
                        <div>
                            <span class="px-2 py-1 rounded text-xs 
            {{ $job->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($job->status) }}
                            </span>
                        </div>
                    </div>


                    <div>
                        <span class="font-semibold">Posted At:</span>
                        <div>{{ $job->created_at->format('d-m-Y h:i A') }}</div>
                    </div>

                </div>

                <div class="mt-6">
                    <span class="font-semibold block mb-2">Job Description:</span>
                    <div class="p-4 rounded-md text-gray-700 text-sm">
                        {!! nl2br(e($job->job_description)) ?? 'No description provided.' !!}
                    </div>

                    <!-- apply button -->

                    @role('Candidate')
                    <div class="mt-6 flex justify-end">
                        @if ($job->status === 'inactive')
                        <div class="text-red-600 font-semibold mb-4">This job is inactive. Applications are closed.</div>
                        @else
                        <form action="{{ route('jobs.apply.start', $job->id) }}" method="GET">
                            @csrf
                            <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition">
                                Apply Now
                            </button>
                        </form>
                    </div>
                    @endif
                    @endrole



                </div>
            </div>
        </div>
    </div>
</x-app-layout>