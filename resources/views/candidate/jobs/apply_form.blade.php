<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Apply for: {{ $job->job_title }}
            </h2>
            <a href="{{ route('jobs.show', $job->id) }}"
               class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Back</a>
        </div>
    </x-slot>

    <div class="flex items-center justify-center min-h-[70vh] py-10">
        <div class="w-full max-w-xl bg-white shadow p-6 rounded-lg">
            @if (session('error'))
                <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('jobs.apply.submit', $job->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block font-medium mb-1">Full Name</label>
                    <input type="text" name="name" class="w-full border rounded p-2" value="{{ old('name', auth()->user()->name) }}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block font-medium mb-1">Email</label>
                    <input type="email" name="email" class="w-full border rounded p-2" value="{{ old('email', auth()->user()->email) }}" required>
                </div>

                <div class="mb-4">
                    <label for="document" class="block font-medium mb-1">Upload Document (PDF)</label>
                    <input type="file" name="document" accept=".pdf" class="w-full border rounded p-2" required>
                </div>

                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Submit Application
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
