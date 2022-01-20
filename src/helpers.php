<?php

use Esign\Seo\Seo;

if (! function_exists('seo')) {
    function seo(): Seo
    {
        return app('seo');
    }
}
