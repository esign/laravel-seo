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
 * @method static self addType(iterable|\Spatie\SchemaOrg\Type $type)
 * @method static self setTypes(array $types)
 * @method static array getTypes()
 *
 * @see \Esign\Seo\Tags\JsonLd
 */
class JsonLd extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seo.json-ld';
    }
}
