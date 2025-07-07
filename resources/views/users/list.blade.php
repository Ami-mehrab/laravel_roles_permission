<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                User/List
            </h2>
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
                         <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
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

    </x-slot>

</x-app-layout>