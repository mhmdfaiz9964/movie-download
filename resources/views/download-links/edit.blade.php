<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Download Link</title>
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
        @if($errors->any())
        <div id="error-box" class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card shadow">
            <div class="card-header bg-white">
                <h4 class="card-title">Edit Download Link</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('download-links.update', $downloadLink->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $downloadLink->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-select" required>
                            <option value="movies" {{ $downloadLink->type === 'movies' ? 'selected' : '' }}>Movies</option>
                            <option value="tv_series" {{ $downloadLink->type === 'tv_series' ? 'selected' : '' }}>TV Series</option>
                            <option value="subtitles" {{ $downloadLink->type === 'subtitles' ? 'selected' : '' }}>Subtitles</option>
                            <option value="videos" {{ $downloadLink->type === 'videos' ? 'selected' : '' }}>Videos</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control-file" onchange="previewImage(event)">
                        @if ($downloadLink->image)
                        <img src="{{ asset('storage/' . $downloadLink->image) }}" id="image-preview" class="preview-image">
                        @else
                        <img id="image-preview" class="preview-image d-none">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $downloadLink->description) }}</textarea>
                    </div>

                    <div class="mb-3" id="types-container">
                        <label for="types" class="form-label">Types</label>
                        @foreach ($downloadLink->types as $type)
                        <div class="input-group mb-3">
                            <label for="type">Type:</label>
                            <input type="text" name="types[]" id="type" class="form-control" placeholder="Enter type">
                            
                            <button type="button" class="btn btn-danger delete-type">Delete</button>
                        </div>
                        @endforeach
                        <div class="input-group mb-3" id="type-template" style="display: none;">
                            <input type="text" name="types[]" class="form-control" placeholder="Enter type" >
                            <button class="btn btn-outline-secondary delete-type" type="button">Delete</button>
                        </div>
                        <button class="btn btn-secondary" type="button" id="add-type">Add Type</button>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for previewing image
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function () {
                var imgElement = document.getElementById('image-preview');
                imgElement.src = reader.result;
                imgElement.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
        document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('add-type').addEventListener('click', function () {
            var container = document.getElementById('types-container');
            var template = document.getElementById('type-template');
            var clone = template.cloneNode(true);
            clone.style.display = 'flex'; // Ensure the cloned template is visible
            container.appendChild(clone);
        });

        // Delete type functionality
        document.querySelectorAll('.delete-type').forEach(function (button) {
            button.addEventListener('click', function () {
                button.closest('.input-group').remove();
            });
        });
    });
    </script>
    
    
</body>

</html>
