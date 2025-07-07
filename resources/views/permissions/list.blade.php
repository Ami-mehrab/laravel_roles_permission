<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                Permissions List
            </h2>
            <a href="{{ route('permissions.create') }}"
                class="px-4 py-2 text-sm text-white bg-slate-700 rounded-md hover:bg-slate-800">
                Create
            </a>
        </div>
    </x-slot>

    <head>
        <meta charset="UTF-8">
        <title>Permission Listing</title>

        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <div class="container mt-5">
            <h2 class="mb-4 text-center">Permission Listing</h2>
            <x-message></x-message>

            @if($permissions->isEmpty())
            <h3> No Permission Created</h3>
            @else
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="60">#</th>
                        <th width="800">Permission Name</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->created_at->format('F j, Y') }}</td>
                        <td>

                        @can('delete permissions')
                            <a href="javascript:void(0);" onclick="deletepermission({{ $permission->id }})" class="btn btn-danger btn-sm me-1">Delete</a>
                          @endcan
                            
                          @can('edit permissions')
                            
                             <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                              @endcan
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $permissions->links() }}
            @endif

        </div>

        <!-- Bootstrap JS (optional, for interactive elements) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    <x-slot name="script">
        <script type="text/javascript">
            function deletepermission(id) {
                if (confirm("Are you sure you want to delete?")) {
                    $.ajax({
                        url: '{{ route("permissions.destroy") }}',
                        type: 'delete',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        headers: {
                            'x-csrf-token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            window.location.href = '{{ route("permissions.index") }}';
                        }
                    });
                }
            }
        </script>
    </x-slot>

</x-app-layout>