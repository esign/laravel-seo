<?php

use Esign\Seo\Seo;

if (! function_exists('seo')) {
    function seo()
    {
        return app(Seo::class);
    }
}