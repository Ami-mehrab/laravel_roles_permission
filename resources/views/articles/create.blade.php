<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                Articles/Create
            </h2>
            <a href="{{ route('permissions.index') }}"
                class="px-4 py-2 text-sm text-white bg-slate-700 rounded-md hover:bg-slate-800">
                List
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-blue-600 px-6 py-4 text-white">
                <h1 class="text-lg font-semibold">Create New Article</h1>
            </div>
            <div class="p-6">
                <form action="{{ route('articles.store') }}" method="POST" id="permissionForm">
                    @csrf


                    <!-- title -->
                    <div class="mb-5">
                        <label for="articletitle" class="block mb-2 font-medium text-gray-700">Title *</label>
                        <input type="text" value="{{old('title')}}" name="title" id="articletitle"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter Article title">
                        @error('title')

                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror

                    </div>
                    <!-- CONTENT FIELD -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                        <textarea
                            id="content"
                            name="text"
                            value="{{old('text')}}"
                            class="input-focus content-textarea w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 transition-colors duration-200"
                            placeholder="Write your article content here..."></textarea>
                    </div>
                    <!-- AUTHOR -->
                    <div class="mb-5">
                        <label for="" class="block mb-2 font-medium text-gray-700">Author</label>
                        <input type="text" value="{{old('author')}}" name="author" id=""
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Write Author">
                        @error('title')

                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition duration-200">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Tailwind-friendly client-side validation
        document.getElementById('permissionForm').addEventListener('submit', function(e) {
            const nameInput = document.getElementById('permissionName');
            const nameError = document.getElementById('nameError');

            if (!nameInput.value.trim()) {
                e.preventDefault();
                nameInput.classList.add('border-red-500');
                nameError.classList.remove('hidden');
            } else {
                nameInput.classList.remove('border-red-500');
                nameError.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>