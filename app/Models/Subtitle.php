<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subtitle extends Model
{
    protected $fillable = ['download_link_id', 'filename'];

    // Define the relationship with download link
    public function downloadLink()
    {
        return $this->belongsTo(DownloadLink::class);
    }
}
