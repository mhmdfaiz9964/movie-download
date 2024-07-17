<!-- Sidebar -->
<div class="card">
    <div class="card-header">{{ __('Sidebar') }}</div>

    <div class="card-body">
         <!-- Sidebar content -->
         <ul class="list-group">
            <!-- Dashboard Menu Item -->
            <li class="list-group-item">
                <a href="{{ route('home') }}" class="text-dark text-decoration-none">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <!-- Other Menu Items -->
            <li class="list-group-item">
                <a href="{{ route ('download-links.create')}}" class="text-dark text-decoration-none">
                    <i class="fas fa-download me-2"></i> Create Download Link
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('subtitles.index') }}" class="text-dark text-decoration-none">
                    <i class="fas fa-file-video me-2"></i> Upload Subtitle
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('ads.index') }}" class="text-dark text-decoration-none">
                    <i class="fas fa-ad me-2"></i> Ad
                </a>
            </li>
            <li class="list-group-item">
                <a href="#" class="text-dark text-decoration-none">
                    <i class="fas fa-cog me-2"></i> Settings
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('users.index') }}" class="text-dark text-decoration-none">
                    <i class="fas fa-users me-2"></i> Users
                </a>
            </li>

        </ul>
    </div>
</div>
