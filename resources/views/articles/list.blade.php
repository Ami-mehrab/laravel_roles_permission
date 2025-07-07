<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                Article List
            </h2>
            <a href="{{ route('articles.create') }}"
                class="px-4 py-2 text-sm text-white bg-slate-700 rounded-md hover:bg-slate-800">
                Create
            </a>
        </div>
    </x-slot>

    <head>
        <meta charset="UTF-8">
        <title>Article Listing</title>

        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <div class="container mt-5">
            <h2 class="mb-4 text-center">Article Listing</h2>
            <x-message></x-message>

            @if($articles->isEmpty())
            <h3> No Article Created</h3>
            @else
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="30">#</th>
                        <th width="400">Article Title</th>
                        <th width="">author</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->id}}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->author }}</td>
                        <td>{{ $article->created_at->format('F j, Y') }}</td>
                        <td>
                             <!-- using can method it will only visible to allowed roles -->
                        @can ('delete articles') 
                        <a href="javascript:void(0);" onclick="deleteArticle({{$article->id}})" class="btn btn-danger btn-sm me-1">Delete</a>

                        @endcan 

                         @can ('edit articles')
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                         @endcan
                       
                        </td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{$articles->links() }}
            @endif

        </div>

        <!-- Bootstrap JS (optional, for interactive elements) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    <x-slot name="script">
        <script type="text/javascript">
            function deleteArticle(id) {
                if (confirm("Are you sure you want to delete?")) {
                    $.ajax({
                        url: '{{ route("articles.destroy") }}',
                        type: 'delete',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        headers: {
                            'x-csrf-token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            window.location.href = '{{ route("articles.index") }}';
                        }
                    });
                }
            }
        </script>
    </x-slot>

</x-app-layout>