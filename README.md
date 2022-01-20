# Easily manage SEO within your laravel application.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/esign/laravel-seo.svg?style=flat-square)](https://packagist.org/packages/esign/laravel-seo)
[![Total Downloads](https://img.shields.io/packagist/dt/esign/laravel-seo.svg?style=flat-square)](https://packagist.org/packages/esign/laravel-seo)
[![Github Workflow Status](https://img.shields.io/github/workflow/status/esign/laravel-seo/run-tests?label=tests)](https://github.com/esign/laravel-seo/actions)

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

The config file will be published as `config/redirects.php` with the following content:
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

### Defining mutators
This package allows you to define [mutators](https://laravel.com/docs/8.x/eloquent-mutators#defining-a-mutator) like Laravel's model attributes:
```php
use Esign\Seo\Tags\Meta as EsignMeta;

class Meta extends EsignMeta
{
    public function setTitleAttribute(?string $value): string
    {
        return $value ' - Suffix';
    }
}
```

### Seo API
```php
use Esign\Seo\Facades\Seo;

Seo::when(mixed $value, callable $callback, callable|null $default);
Seo::unless(mixed $value, callable $callback, callable|null $default);
Seo::setTitle(?string $title);
Seo::setDescription(?string $title);
Seo::setUrl(?string $title);
Seo::setImage(?string $title);
Seo::meta();
Seo::og();
Seo::twitter();
```
### Meta API
```php
use Esign\Seo\Facades\Tags\Meta;

// Conditions
Meta::when(mixed $value, callable $callback, callable|null $default);
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
```
### Open Graph API
```php
use Esign\Seo\Facades\Tags\OpenGraph;

// Conditions
OpenGraph::when(mixed $value, callable $callback, callable|null $default);
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
