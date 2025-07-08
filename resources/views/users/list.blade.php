<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                User/List
            </h2>
                @can('create users')
                 <a href="{{ route('users.create') }}"
                class="px-4 py-2 text-sm text-white bg-slate-700 rounded-md hover:bg-slate-800">
                Create
            </a>
            @endcan
        </div>
    </x-slot>

    <head>
        <title>Users </title>

        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <x-message></x-message>
          @if($users->isEmpty())
            <h3> No User  Created</h3>
            @else

        <div class="container mt-5">
            <h2 class="mb-4 text-center">Listing</h2>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="20">#</th>
                        <th width="300">Name</th>
                        <th width="">Email</th>
                        <th width="">Roles</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email}}</td>
                         <td>{{ $user->roles->pluck('name')->implode(',')}}</td>
                        <td>{{ $user->created_at->format('F j, Y') }}</td>
                        <td>
                        @can('delete users')
                         <a href="javascript:void(0);" onclick="deleteUser({{$user->id}})" class="btn btn-danger btn-sm me-1">Delete</a>
                         @endcan
                          @can('edit users')
                           <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                      @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{$users->links()}}
            @endif
        </div>


        <!-- Bootstrap JS (optional, for interactive elements) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
     <x-slot name="script">
        <script type="text/javascript">
            function deleteUser(id) {
                if (confirm("Are you sure you want to delete?")) {
                    $.ajax({
                        url: '{{ route("users.destroy") }}',
                        type: 'delete',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        headers: {
                            'x-csrf-token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            window.location.href = '{{ route("users.index") }}';
                        }
                    });
                }
            }
        </script>
    
    </x-slot>

</x-app-layout>