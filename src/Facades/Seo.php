<?php

namespace Esign\Seo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Esign\Seo\Meta
 */
class Seo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Esign\Seo\Seo::class;
    }
}