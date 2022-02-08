<?php

namespace Esign\Seo\Tests\Support\Models;

use Esign\Seo\Contracts\SeoContract;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements SeoContract
{
    public $timestamps = false;
    protected $guarded = [];

    public function getSeoTitle(): ?string
    {
        return 'Esign, hét creatieve digital agency';
    }

    public function getSeoDescription(): ?string
    {
        return 'Esign helpt jouw merk met zijn online aanwezigheid ...';
    }

    public function getSeoUrl(): ?string
    {
        return 'https://esign.eu/en';
    }

    public function getSeoImage(): ?string
    {
        return 'https://esign.eu/share-image.jpg';
    }

    public function getSeoAlternateUrls(): array
    {
        return [
            'en' => 'https://esign.eu/en',
            'nl' => 'https://esign.eu/nl',
        ];
    }
}
