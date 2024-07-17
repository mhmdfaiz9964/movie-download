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
                <h4 class="card-title">Create Download Link</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('download-links.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-select" required>
                            <option value="movies">Movies</option>
                            <option value="tv_series">TV Series</option>
                            <option value="subtitles">Subtitles</option>
                            <option value="videos">Videos</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control-file" onchange="previewImage(event)">
                        <img id="image-preview" class="preview-image d-none">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="mb-3" id="types-container">
                        <label for="types" class="form-label">Types</label>
                        <div class="input-group">
                            <input type="text" name="types[]" class="form-control" placeholder="Enter type" required>
                            <button class="btn btn-outline-secondary" type="button" id="add-type">Add</button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for adding/removing types
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('add-type').addEventListener('click', function () {
                var container = document.getElementById('types-container');
                var inputGroup = document.createElement('div');
                inputGroup.classList.add('input-group', 'mb-3');

                var input = document.createElement('input');
                input.type = 'text';
                input.name = 'types[]';
                input.classList.add('form-control');
                input.placeholder = 'Enter type';
                input.required = true;

                var appendDiv = document.createElement('div');
                appendDiv.classList.add('input-group-append');

                var deleteBtn = document.createElement('button');
                deleteBtn.classList.add('btn', 'btn-outline-danger');
                deleteBtn.type = 'button';
                deleteBtn.innerHTML = 'Delete';
                deleteBtn.addEventListener('click', function () {
                    inputGroup.remove();
                });

                appendDiv.appendChild(deleteBtn);
                inputGroup.appendChild(input);
                inputGroup.appendChild(appendDiv);
                container.appendChild(inputGroup);
            });
        });

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
    </script>
</body>

</html>
