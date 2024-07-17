<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'image', 'position', 'url',
    ];

    /**
     * Get the formatted position for display.
     *
     * @return string
     */
    public function formattedPosition()
    {
        switch ($this->position) {
            case 'home_page':
                return 'Home Page';
            case 'download_time':
                return 'Download Time';
            case 'single_download_page_bottom':
                return 'Single Download Page Bottom';
            case 'single_download_page_sidebar':
                return 'Single Download Page Sidebar';
            case 'single_download_page_top':
                return 'Single Download Page Top';
            case 'home_bottom':
                return 'Home Bottom';
            case 'home_top':
                return 'Home Top';
            case 'home_sidebar':
                return 'Home Sidebar';
            case 'home_after_movies':
                return 'Home After Movies';
            default:
                return 'Unknown Position';
        }
    }
}
