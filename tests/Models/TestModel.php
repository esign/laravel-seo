<?php

namespace Esign\Seo\Tests\Models;

use Esign\Seo\Contracts\SeoAbleInterface;
use Esign\Seo\Contracts\UrlTranslatableInterface;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model implements SeoAbleInterface, UrlTranslatableInterface
{
    public function getSeoTitleAttribute(): string
    {
        return 'Test Model Title';
    }

    public function getSeoDescriptionAttribute(): string
    {
        return 'Test Model Description';
    }

    public function getAlternateUrlsAttribute(): array
    {
        return [
            'nl' => 'https://esign.eu/nl',
            'en' => 'https://esign.eu/en',
        ];
    }
}