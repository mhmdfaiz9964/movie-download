<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Download Link</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            padding: 20px;
            background-color: #f3f4f6;
        }

        .card {
            border-radius: 10px;
        }

        .input-group {
            margin-bottom: 10px;
        }

        .preview-image {
            max-width: 100px;
            height: auto;
            border-radius: 10px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container mx-auto">
        <div class="bg-white p-6 shadow-md rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('home') }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Home
                </a>
                <a href="{{ route('subtitles.create') }}" class="flex items-center bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V8.414a1 1 0 00-.293-.707l-4-4a1 1 0 00-.707-.293H5zM4 4a1 1 0 011-1h7.586a1 1 0 01.707.293l4 4a1 1 0 01.293.707V16a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" clip-rule="evenodd" />
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                    Create Subtitle
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($subtitles->isEmpty())
                <p>No subtitles found.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Movie Name</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Subtitle File</th>
                            <th class="px-6 py-3 bg-gray-50"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($subtitles as $subtitle)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $subtitle->id }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $subtitle->downloadLink->title }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $subtitle->filename }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <button class="bg-transparent hover:bg-red-500 text-red-500 hover:text-white border border-red-500 hover:border-transparent rounded-lg px-4 py-2 delete-subtitle" data-id="{{ $subtitle->id }}">
                                        <svg class="w-4 h-4 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Delete
                                    </button>
                                    <form id="delete-form-{{ $subtitle->id }}" action="{{ route('subtitles.destroy', $subtitle->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
         document.addEventListener('DOMContentLoaded', function() {
            // Delete subtitle action
            const deleteButtons = document.querySelectorAll('.delete-subtitle');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const subtitleId = this.dataset.id;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this subtitle!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit the form
                            document.getElementById(`delete-form-${subtitleId}`).submit();
                        }
                    });
                });
            });
        });
    </script>

    <!-- Include Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
</body>

</html>
