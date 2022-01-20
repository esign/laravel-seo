<?php

namespace Esign\Seo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static self|mixed when(mixed $value, callable $callback, callable|null $default)
 * @method static self|mixed unless(mixed $value, callable $callback, callable|null $default)
 * @method static self setTitle(?string $title)
 * @method static self setDescription(?string $title)
 * @method static self setUrl(?string $title)
 * @method static self setImage(?string $title)
 * @method static \Esign\Seo\Tags\Meta meta()
 * @method static \Esign\Seo\Tags\OpenGraph og()
 * @method static \Esign\Seo\Tags\TwitterCard twitter()
 * 
 * @see \Esign\Seo\Seo
 */
class Seo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seo';
    }
}
