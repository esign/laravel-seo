<?php

namespace Esign\Seo\Contracts;

interface UrlTranslatableInterface
{
    public function getAlternateUrlsAttribute(): array;
}
