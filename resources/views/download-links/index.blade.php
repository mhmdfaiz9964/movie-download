<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Links</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Your custom CSS styles here */
        body {
            padding: 20px;
        }

        .image-preview {
            width: 60px;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                @include('layouts.sidebar')
    
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header flex justify-between items-center">
                        <span>Download Links</span>
                        <a href="{{ route('download-links.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Create Download Link
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($downloadLinks as $downloadLink)
                                <tr>
                                    <td>{{ $downloadLink->title }}</td>
                                    <td>{{ $downloadLink->type }}</td>
                                    <td>{{ strlen($downloadLink->description) > 25 ? substr($downloadLink->description, 0, 25) . '...' : $downloadLink->description }}</td>
                                    <td>
                                        @if ($downloadLink->image)
                                        <img src="{{ asset('storage/' . $downloadLink->image) }}"
                                            alt="{{ $downloadLink->title }}" class="image-preview">
                                        @else
                                        No Image
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#downloadLinkModal{{ $downloadLink->id }}">
                                            <i class="bi bi-info-circle"></i> Show
                                        </button>
                                        {{-- <a href="{{ route('download-links.edit', $downloadLink->id) }}"
                                            class="btn btn-sm btn-outline-secondary me-2">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a> --}}
                                        <form id="deleteForm{{ $downloadLink->id }}" action="{{ route('download-links.destroy', $downloadLink->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-link"
                                                    data-id="{{ $downloadLink->id }}">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                        
                                        <!-- Additional Button for Adding Links -->
                                        <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                            data-bs-target="#addLinkModal{{ $downloadLink->id }}">
                                            <i class="bi bi-plus"></i> Add Link
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No download links found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($downloadLinks as $downloadLink)
    <div class="modal fade" id="downloadLinkModal{{ $downloadLink->id }}" tabindex="-1"
        aria-labelledby="downloadLinkModalLabel{{ $downloadLink->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-center" id="downloadLinkModalLabel{{ $downloadLink->id }}">{{ $downloadLink->title }} Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4 mt-4">
                        <h5 class="card-title"><strong>{{ $downloadLink->title }}</strong></h5>
                        <hr class="text-center mb-4 mt-4">
                        <div class="d-flex justify-content-center mb-4 mt-4">
                            @if ($downloadLink->image)
                        <img src="{{ asset('storage/' . $downloadLink->image) }}" alt="{{ $downloadLink->title }}" class="img-fluid rounded shadow-lg"  style="width: 300px; height: 150px; object-fit: cover;">
                        @else
                        <img src="placeholder.jpg" alt="Placeholder" class="img-fluid rounded-circle mb-3 shadow-lg"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                        </div>
                        <p><strong>Description:</strong> {{ $downloadLink->description }}</p>

                    </div>
    
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Type</th>
                                            <th>Link Type</th>
                                            <th>URL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($downloadLink->types as $type)
                                        @foreach ($type->links as $index => $link)
                                        <tr>
                                            @if ($index === 0)
                                            <td rowspan="{{ count($type->links) }}">{{ $type->type }}</td>
                                            @endif
                                            <td>{{ $link->link_type }}</td>
                                            <td>{{ $link->url }}</td>
                                        </tr>
                                        @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    

    <!-- Modal for Add Link -->
    <div class="modal fade" id="addLinkModal{{ $downloadLink->id }}" tabindex="-1"
        aria-labelledby="addLinkModalLabel{{ $downloadLink->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLinkModalLabel{{ $downloadLink->id }}">Add Link for {{ $downloadLink->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('download-links.storeLink', ['id' => $downloadLink->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="linkType" class="form-label">Link Type</label>
                            <select class="form-select" id="linkType" name="link_type" required>
                                <option value="">Select Type</option>
                                @foreach ($downloadLink->types as $type)
                                    <option value="{{ $type->type }}">{{ $type->type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="linkTypeInput" class="form-label">Link Type (Input)</label>
                            <input type="text" class="form-control" id="linkTypeInput" name="link_type_input" required>
                            <small id="linkTypeInputHelp" class="form-text text-muted">Enter additional link type if not in the list.</small>
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="text" class="form-control" id="url" name="url" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Select all delete buttons with class delete-link
        const deleteButtons = document.querySelectorAll('.delete-link');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                const downloadLinkId = this.getAttribute('data-id');

                // Display SweetAlert confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this download link!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form
                        document.getElementById(`deleteForm${downloadLinkId}`).submit();
                    }
                });
            });
        });
    });
</script>

</html>
