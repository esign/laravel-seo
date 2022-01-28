<?php

namespace Esign\Seo;

use Esign\Seo\Exceptions\InvalidConfiguration;
use Esign\Seo\Tags\JsonLd;
use Esign\Seo\Tags\Meta;
use Esign\Seo\Tags\OpenGraph;
use Esign\Seo\Tags\TwitterCard;
use Illuminate\Support\ServiceProvider;

class SeoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom($this->viewPath(), 'seo');

        if ($this->app->runningInConsole()) {
            $this->publishes([$this->configPath() => config_path('seo.php')], 'config');
            $this->publishes([$this->viewPath() => resource_path('views/vendor/seo')], 'views');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'seo');

        $this->app->singleton('seo', config('seo.seo'));
        $this->app->singleton('seo.meta', config('seo.tags.meta'));
        $this->app->singleton('seo.open-graph', config('seo.tags.open_graph'));
        $this->app->singleton('seo.twitter-card', config('seo.tags.twitter_card'));
        $this->app->singleton('seo.json-ld', config('seo.tags.json_ld'));

        $this->guardAgainstInvalidClassDefinition(Seo::class, app('seo'));
        $this->guardAgainstInvalidClassDefinition(Meta::class, app('seo.meta'));
        $this->guardAgainstInvalidClassDefinition(OpenGraph::class, app('seo.open-graph'));
        $this->guardAgainstInvalidClassDefinition(TwitterCard::class, app('seo.twitter-card'));
        $this->guardAgainstInvalidClassDefinition(JsonLd::class, app('seo.json-ld'));
    }

    protected function configPath(): string
    {
        return __DIR__ . '/../config/seo.php';
    }

    protected function viewPath(): string
    {
        return __DIR__  . '/../resources/views';
    }

    protected function guardAgainstInvalidClassDefinition(string $packageClass, object $configuredClass): void
    {
        if (! $configuredClass instanceof $packageClass) {
            $configuredClass = get_class($configuredClass);

            throw InvalidConfiguration::invalidTag($configuredClass, $packageClass);
        }
    }
}
