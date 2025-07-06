<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                Role/List
            </h2>
            <a href="{{ route('roles.create') }}"
                class="px-4 py-2 text-sm text-white bg-slate-700 rounded-md hover:bg-slate-800">
                Create
            </a>
        </div>
    </x-slot>

    <head>
        <meta charset="UTF-8">
        <title>Role Listing</title>

        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
    <x-message></x-message >

        <div class="container mt-5">
            <h2 class="mb-4 text-center">Role Listing</h2>
            

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