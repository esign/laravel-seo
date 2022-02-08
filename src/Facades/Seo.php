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
 * @method static self setAlternateUrls(array $alternateUrls)
 * @method static self set(\Esign\Seo\Contracts\SeoContract $seoContract)
 * @method static self|\Esign\Seo\Tags\Meta meta(?callable $callback = null)
 * @method static self|\Esign\Seo\Tags\OpenGraph og(?callable $callback = null)
 * @method static self|\Esign\Seo\Tags\TwitterCard twitter(?callable $callback = null)
 * @method static self|\Esign\Seo\Tags\JsonLd jsonLd(?callable $callback = null)
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
