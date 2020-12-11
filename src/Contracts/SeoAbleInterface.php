<?php

namespace Esign\Seo\Contracts;

interface SeoAbleInterface
{
    public function getSeoTitleAttribute(): string;
    public function getSeoDescriptionAttribute(): string;
}
