<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                Roles/edit
            </h2>
            <a href="{{ route('roles.index') }}"
                class="px-4 py-2 text-sm text-white bg-slate-700 rounded-md hover:bg-slate-800">
                List
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-blue-600 px-6 py-4 text-white">
                <h1 class="text-lg font-semibold">Update Roles</h1>
            </div>
            <div class="p-6">
                <form action="{{Route('roles.update',$role->id)}}" method="post" id="">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="permissionName" class="block mb-2 font-medium text-gray-700">Role Name *</label>
                        <input type="text" name="name" id="permissionName"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter Role name" value="{{old('name',$role->name)}}" required>
                        <p id="nameError" class="mt-1 text-sm text-red-500 hidden">Role name is required.</p>
                    </div>


                    <!-- form dynamic in create blade  -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Select Options
                        </label>

                        <div class="space-y-2">
                            @foreach($permissions as $permission)
                            <label class="flex items-center">
                                <input {{($haspermissions->contains($permission->name)) ? 'checked':''}}   
                                type="checkbox" name="permission[]" value="{{ $permission->name }}" class="form-checkbox h-4 w-4 text-blue-600">
                                <span class="ml-2 text-gray-700">{{ $permission->name }}</span>
                            </label>
                            @endforeach
                        </div>

                        @error('options')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit"
                                class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition duration-200 hover:bg-slate-600">
                            Update
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