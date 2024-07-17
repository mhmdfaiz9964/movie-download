<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadLinksHasTypeHasLink extends Model
{
    protected $fillable = [
        'download_links_has_types_id', 'url', 'link_type', 
    ];

    public function type()
    {
        return $this->belongsTo(DownloadLinksHasType::class, 'download_links_has_types_id', 'id');
    }
}
