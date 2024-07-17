<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadLinksHasType extends Model
{
    protected $fillable = [
        'download_links_id', 'type',
    ];

    public function links()
    {
        return $this->hasMany(DownloadLinksHasTypeHasLink::class, 'download_links_has_types_id', 'id');
    }

    public function downloadLink()
    {
        return $this->belongsTo(DownloadLink::class, 'download_links_id', 'id');
    }
}
