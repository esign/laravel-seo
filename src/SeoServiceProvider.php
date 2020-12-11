<?php

namespace Esign\Seo;

use Illuminate\Support\ServiceProvider;

class SeoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'seo');
        $this->publishes([$this->configPath() => config_path('seo.php')], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'seo');

        $this->app->singleton(Seo::class);
    }

    protected function configPath(): string
    {
        return __DIR__ . '/../config/seo.php';
    }
}