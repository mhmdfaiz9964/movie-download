<?php

namespace App\Services;

use Google\Cloud\Translate\V2\TranslateClient;

class SubtitleConversionService
{
    protected $translateClient;

    public function __construct()
    {
        $this->translateClient = new TranslateClient([
            'key' => env('GOOGLE_TRANSLATE_API_KEY'), 
        ]);
    }

    public function translateSubtitle($subtitleText, $targetLanguage)
    {
        $result = $this->translateClient->translate($subtitleText, [
            'target' => $targetLanguage,
        ]);

        return $result['text'];
    }
}
