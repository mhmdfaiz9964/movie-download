<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadLink extends Model
{
    protected $fillable = [
        'title', 'type', 'image', 'description',
    ];

    // Relationships
    public function types()
    {
        return $this->hasMany(DownloadLinksHasType::class, 'download_links_id', 'id');
    }

    public function subtitles()
    {
        return $this->hasMany(Subtitle::class);
    }
}
