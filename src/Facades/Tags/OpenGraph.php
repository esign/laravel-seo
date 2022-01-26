<?php

namespace Esign\Seo\Facades\Tags;

use Illuminate\Support\Facades\Facade;

/**
 * @method static self|mixed when(mixed $value, callable $callback, callable|null $default)
 * @method static self|mixed whenEmpty(string $key, callable $callback, callable|null $default)
 * @method static self|mixed unless(mixed $value, callable $callback, callable|null $default)
 * @method static self set(string $key, mixed $value)
 * @method static mixed setRaw(string $key, mixed $value)
 * @method static mixed get(string $key, mixed $default = null)
 * @method static bool has(string $key)
 * @method static self setType(?string $type)
 * @method static ?string getType()
 * @method static self setSiteName(?string $siteName)
 * @method static ?string getSiteName()
 * @method static self setTitle(?string $title)
 * @method static ?string getTitle()
 * @method static self setDescription(?string $description)
 * @method static ?string getDescription()
 * @method static self setImage(?string $image)
 * @method static ?string getImage()
 * @method static self setUrl(?string $url)
 * @method static ?string getUrl()
 *
 * @see \Esign\Seo\Tags\OpenGraph
 */
class OpenGraph extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seo.open-graph';
    }
}
