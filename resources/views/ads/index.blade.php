@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            <!-- Main content area -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Ads List') }}</span>
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#createAdModal">
                        <i class="fas fa-plus me-2"></i> Create Ad
                    </button>
                </div>

                <div class="card-body">
                    <!-- Display ads list -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ads as $ad)
                            <tr>
                                <td>{{ $ad->title }}</td>
                                <td>
                                    <img src="{{ asset($ad->image) }}" alt="Image" style="max-width: 100px;">
                                </td>
                                <td>
                                    @php
                                        $labelClass = '';
                                        switch($ad->position) {
                                            case 'home_page':
                                                $labelClass = 'badge bg-primary';
                                                break;
                                            case 'download_time':
                                                $labelClass = 'badge bg-secondary';
                                                break;
                                            case 'single_download_page_bottom':
                                                $labelClass = 'badge bg-success';
                                                break;
                                            case 'single_download_page_sidebar':
                                                $labelClass = 'badge bg-danger';
                                                break;
                                            case 'single_download_page_top':
                                                $labelClass = 'badge bg-warning';
                                                break;
                                            case 'home_bottom':
                                                $labelClass = 'badge bg-info';
                                                break;
                                            case 'home_top':
                                                $labelClass = 'badge bg-light text-dark';
                                                break;
                                            case 'home_sidebar':
                                                $labelClass = 'badge bg-dark';
                                                break;
                                            case 'home_after_movies':
                                                $labelClass = 'badge bg-dark text-white';
                                                break;
                                            default:
                                                $labelClass = 'badge bg-secondary';
                                        }
                                    @endphp
                                    <span class="badge {{ $labelClass }}">{{ $ad->position }}</span>
                                </td>
                                <td>
                                    <!-- Edit Ad Button -->
                                    <button type="button" class="btn btn-sm btn-success edit-ad-btn" data-ad-id="{{ $ad->id }}" data-toggle="modal" data-target="#editAdModal{{ $ad->id }}" title="Edit Ad">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <!-- Delete Ad Form -->
                                    <form id="delete-form-{{ $ad->id }}" action="{{ route('ads.destroy', $ad->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger delete-ad-btn" data-ad-id="{{ $ad->id }}" title="Delete Ad">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createAdModal" tabindex="-1" role="dialog" aria-labelledby="createAdModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAdModalLabel">Create Ad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- Add your form fields here -->
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required onchange="previewImage(event)">
                    </div>
                    <div class="form-group">
                        <img id="imagePreview" src="https://t4.ftcdn.net/jpg/02/51/13/11/360_F_251131195_YKAgbS5YEeDSUmNg69MtEOV3OYxrM2ml.jpg" alt="Image Preview" style="max-width: 150px;">
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <select class="form-control" id="position" name="position" required>
                            <option value="home_page">Home Page</option>
                            <option value="download_time">Download Time</option>
                            <option value="single_download_page_bottom">Single Download Page Bottom</option>
                            <option value="single_download_page_sidebar">Single Download Page Sidebar</option>
                            <option value="single_download_page_top">Single Download Page Top</option>
                            <option value="gomne_bottom">Gomne Bottom</option>
                            <option value="home_top">Home Top</option>
                            <option value="home_sidebar">Home Sidebar</option>
                            <option value="home_after_movies">Home After Movies</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="url" class="form-control" id="url" name="url" placeholder="https://example.com" pattern="https://.*" title="Include http:// or https:// in the URL" required>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
    }
</script>


@foreach ($ads as $ad)
      <!-- Edit Ad Modal -->
      <div class="modal fade" id="editAdModal{{ $ad->id }}" tabindex="-1" role="dialog" aria-labelledby="editAdModalLabel{{ $ad->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAdModalLabel{{ $ad->id }}">Edit Ad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('ads.update', $ad->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_title{{ $ad->id }}">Title</label>
                            <input type="text" class="form-control" id="edit_title{{ $ad->id }}" name="title" value="{{ $ad->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="edit_image{{ $ad->id }}" name="image"  accept="image/*" onchange="previewImage(event)">
                        </div>
                        <div class="form-group">
                            <img id="edit_image_preview{{ $ad->id }}" src="{{ asset($ad->image) }}" alt="Preview" class="img-fluid" style="max-width: 100px;">
                        </div>
                        <div class="form-group">
                            <label for="edit_position{{ $ad->id }}">Position</label>
                            <select class="form-control" id="edit_position{{ $ad->id }}" name="position" required>
                                <option value="home_page" {{ $ad->position == 'home_page' ? 'selected' : '' }}>Home Page</option>
                                <option value="download_time" {{ $ad->position == 'download_time' ? 'selected' : '' }}>Download Time</option>
                                <option value="single_download_page_bottom" {{ $ad->position == 'single_download_page_bottom' ? 'selected' : '' }}>Single Download Page Bottom</option>
                                <option value="single_download_page_sidebar" {{ $ad->position == 'single_download_page_sidebar' ? 'selected' : '' }}>Single Download Page Sidebar</option>
                                <option value="single_download_page_top" {{ $ad->position == 'single_download_page_top' ? 'selected' : '' }}>Single Download Page Top</option>
                                <option value="home_bottom" {{ $ad->position == 'home_bottom' ? 'selected' : '' }}>Home Bottom</option>
                                <option value="home_top" {{ $ad->position == 'home_top' ? 'selected' : '' }}>Home Top</option>
                                <option value="home_sidebar" {{ $ad->position == 'home_sidebar' ? 'selected' : '' }}>Home Sidebar</option>
                                <option value="home_after_movies" {{ $ad->position == 'home_after_movies' ? 'selected' : '' }}>Home After Movies</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="edit_url{{ $ad->id }}">URL</label>
                            <input type="url" class="form-control" id="edit_url{{ $ad->id }}" name="url" value="{{ $ad->url }}" placeholder="https://example.com">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-ad-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const adId = this.getAttribute('data-ad-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + adId).submit();
                    }
                });
            });
        });
    });
</script>
<style>
    img#imagePreview {
    margin: 10px;
    height: 100px;
    border-radius: 5px;
    border: 1px solid #dbd2d27a;
    padding: 5px;
}
</style>
@endsection
