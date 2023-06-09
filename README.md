# Manage SEO tags within your Laravel application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/esign/laravel-seo.svg?style=flat-square)](https://packagist.org/packages/esign/laravel-seo)
[![Total Downloads](https://img.shields.io/packagist/dt/esign/laravel-seo.svg?style=flat-square)](https://packagist.org/packages/esign/laravel-seo)
[![Github Workflow Status](https://img.shields.io/github/workflow/status/esign/laravel-seo/run-tests?label=tests)](https://github.com/esign/laravel-seo/actions)

This package allows you to render SEO related HTML tags that can be set from anywhere in your application.
Currently Meta, Open Graph, Twitter Card and JsonLD are supported.
It also ships with some handy ways to configure SEO for your Eloquent models.

## Installation

You can install the package via composer:

```bash
composer require esign/laravel-seo
```

The package will automatically register a service provider.

Next up, you can publish the configuration file:
```bash
php artisan vendor:publish --provider="Esign\Seo\SeoServiceProvider" --tag="config"
```

The config file will be published as `config/seo.php` with the following content:
```php
return [
    /**
     * The class that will be used when you call the Seo facade or the seo helper method.
     * The configured class must extend the `Esign\Seo\Seo` class.
     */
    'seo' => \Esign\Seo\Seo::class,

    /**
     * Tags are used to represent their own set of specific attributes.
     * The configured tags must extend their corresponding base class.
     */
    'tags' => [
        'meta' => \Esign\Seo\Tags\Meta::class,
        'open_graph' => \Esign\Seo\Tags\OpenGraph::class,
        'twitter_card' => \Esign\Seo\Tags\TwitterCard::class,
        'json_ld' => \Esign\Seo\Tags\JsonLd::class,
    ],
];
```

## Usage
### Preparing your HTML
You may start off by including the seo views in the head of your HTML:
```blade
<head>
    @include('seo::seo')
</head>
```

In case you want to customize these views, you may publish them using the following command:
```bash
php artisan vendor:publish --provider="Esign\Seo\SeoServiceProvider" --tag="views"
```

### Setting attributes
To quickly set up some SEO attributes, you may use the Seo class.
This is usually done from the controller, but that shouldn't limit you from using it in other places:
```php
use Esign\Seo\Facades\Seo;

class PostController extends Controller
{
    public function show(Post $post)
    {
        Seo::setTitle($post->title)->setDescription($post->description);

        return view('posts.show', compact('post'));
    }
}
```

The SEO class will forward these to all the underlying tags. In case you want some more fine grained control over what attributes are being set you may use the individual tags:
```php
use Esign\Seo\Facades\Seo;
use Esign\Seo\Facades\Tags\Meta;
use Esign\Seo\Facades\Tags\OpenGraph;
use Esign\Seo\Facades\Tags\TwitterCard;

Seo::meta()->setTitle('My Meta Title');
Seo::og()->setTitle('My Open Graph Title');
Seo::twitter()->setTitle('My Twitter Title');

Meta::setTitle('My Meta Title');
OpenGraph::setTitle('My Open Graph Title');
TwitterCard::setTitle('My Twitter Card Title');
```

You can also use a fluent API that allows you to chain methods:
```php
use Esign\Seo\Facades\Seo;
use Esign\Seo\Tags\Meta;
use Esign\Seo\Tags\OpenGraph;
use Esign\Seo\Tags\TwitterCard;

Seo::meta(fn (Meta $meta) => $meta->setTitle('My Meta Title'))
    ->og(fn (OpenGraph $openGraph) => $openGraph->setTitle('My Open Graph Title'))
    ->twitter(fn (TwitterCard $twitterCard) => $twitterCard->setTitle('My Twitter Card Title'));
```

### Defining mutators
This package allows you to define [mutators](https://laravel.com/docs/8.x/eloquent-mutators#defining-a-mutator) like Laravel's model attributes:
```php
use Esign\Seo\Tags\Meta as EsignMeta;

class Meta extends EsignMeta
{
    public function setDescriptionAttribute(?string $value): string
    {
        return (string) Str::limit($value, 160, '');
    }
}
```

A `setTitleAttribute` has been included on all traits that will suffix your title with your app name:
```php
public function setTitleAttribute(?string $title): ?string
{
    return sprintf('%s | %s', $title, config('app.name'));
}
```

To bypass a mutator while setting an attribute, you may use the `setRaw` method:
```php
Seo::setTitle('My Normal Seo Title'); // <title>My Normal Seo Title | Esign</title>
Seo::setRaw('title', 'My Raw Seo Title'); // <title>My Raw Seo Title</title>
```


### Setting SEO for models
To set SEO for models, you may implement the `Esign\Seo\Contracts\SeoContract` interface.
A handy trait `Esign\Seo\Concerns\HasSeoDefaults` has been included that can quickly help you set up some SEO defaults for your model.
This however is not necessary, you could also implement the methods yourself:
```php
use Esign\Seo\Concerns\HasSeoDefaults;
use Esign\Seo\Contracts\SeoContract;

class Post extends Model implements SeoContract
{
    use HasSeoDefaults;

    public function getSeoUrl(): ?string
    {
        return route('posts.show', ['slug' => $this->slug]);
    }
}
```

You may set this `SeoContract` using the `set` method:
```php
use Esign\Seo\Facades\Seo;

class PostController extends Controller
{
    public function show(Post $post)
    {
        Seo::set($post);

        return view('posts.show', compact('post'));
    }
}
```


### Seo API
```php
use Esign\Seo\Facades\Seo;
use Esign\Seo\Contracts\SeoContract;

Seo::when(mixed $value, callable $callback, callable|null $default);
Seo::unless(mixed $value, callable $callback, callable|null $default);
Seo::setTitle(?string $title);
Seo::setDescription(?string $title);
Seo::setUrl(?string $title);
Seo::setImage(?string $title);
Seo::setAlternateUrls(array $alternateUrls);
Seo::set(SeoContract $seoContract)
Seo::meta();
Seo::og();
Seo::twitter();
Seo::jsonLd();
```
### Meta API
```php
use Esign\Seo\Facades\Tags\Meta;

// Conditions
Meta::when(mixed $value, callable $callback, callable|null $default);
Meta::whenEmpty(string $key, callable $callback, callable|null $default);
Meta::unless(mixed $value, callable $callback, callable|null $default);

// Getting attributes
Meta::get(string $key, mixed $default = null);
Meta::has(string $key);
Meta::getTitle();
Meta::getDescription();
Meta::getImage();
Meta::getUrl();
Meta::getPrev();
Meta::getNext();
Meta::getRobots();
Meta::getAlternateUrls();

// Setting attributes
Meta::set(string $key, mixed $value);
Meta::setRaw(string $key, mixed $value);
Meta::setTitle(?string $title);
Meta::setDescription(?string $description);
Meta::setImage(?string $image);
Meta::setUrl(?string $url);
Meta::setPrev(?string $prev);
Meta::setNext(?string $next);
Meta::setRobots(?string $robots);
Meta::setAlternateUrls(array $alternateUrls);
Meta::addAlternateUrls(array $alternateUrls);
```
### Open Graph API
```php
use Esign\Seo\Facades\Tags\OpenGraph;

// Conditions
OpenGraph::when(mixed $value, callable $callback, callable|null $default);
OpenGraph::whenEmpty(string $key, callable $callback, callable|null $default);
OpenGraph::unless(mixed $value, callable $callback, callable|null $default);

// Getting attributes
OpenGraph::get(string $key, mixed $default = null);
OpenGraph::has(string $key);
OpenGraph::getType();
OpenGraph::getSiteName();
OpenGraph::getTitle();
OpenGraph::getDescription();
OpenGraph::getImage();
OpenGraph::getUrl();

// Setting attributes
OpenGraph::set(string $key, mixed $value);
OpenGraph::setRaw(string $key, mixed $value);
OpenGraph::setType(?string $title);
OpenGraph::setSiteName(?string $title);
OpenGraph::setTitle(?string $title);
OpenGraph::setDescription(?string $description);
OpenGraph::setImage(?string $image);
OpenGraph::setUrl(?string $url);
```
### Twitter Card API
```php
use Esign\Seo\Facades\Tags\TwitterCard;

// Conditions
TwitterCard::when(mixed $value, callable $callback, callable|null $default);
TwitterCard::whenEmpty(string $key, callable $callback, callable|null $default);
TwitterCard::unless(mixed $value, callable $callback, callable|null $default);

// Getting attributes
TwitterCard::get(string $key, mixed $default = null);
TwitterCard::has(string $key);
TwitterCard::getType();
TwitterCard::getTitle();
TwitterCard::getDescription();
TwitterCard::getImage();

// Setting attributes
TwitterCard::set(string $key, mixed $value);
TwitterCard::setRaw(string $key, mixed $value);
TwitterCard::setType(?string $type);
TwitterCard::setDescription(?string $description);
TwitterCard::setImage(?string $image);
```

### JsonLd API
```php
use Esign\Seo\Facades\Tags\JsonLd;

// Conditions
JsonLd::when(mixed $value, callable $callback, callable|null $default);
JsonLd::whenEmpty(string $key, callable $callback, callable|null $default);
JsonLd::unless(mixed $value, callable $callback, callable|null $default);

// Getting attributes
JsonLd::get(string $key, mixed $default = null);
JsonLd::has(string $key);
JsonLd::getTypes();

// Setting attributes
JsonLd::set(string $key, mixed $value);
JsonLd::setRaw(string $key, mixed $value);
JsonLd::addType(iterable|Spatie\SchemaOrg\Type $type);
JsonLd::setTypes(array $types);
```

This package also ships with a nice helper method that you may use as an alternative to the facade:
```php
use Esign\Seo\Facades\Seo;

Seo::setTitle('My Title')->setDescription('My Description');
seo()->setTitle('My Title')->setDescription('My Description');
```

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
