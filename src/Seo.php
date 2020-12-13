<?php

namespace Esign\Seo;

use Esign\Seo\Contracts\SeoAbleInterface;
use Esign\Seo\Contracts\UrlTranslatableInterface;

class Seo
{
    protected array $data = [];

    public function __construct()
    {
        $this->set('titleSeparator', config('seo.defaults.title_separator'));
        $this->set('titleSuffix', config('seo.defaults.title_suffix'));
        $this->set('canonical', url()->current());
        $this->set('robots', config('seo.defaults.robots'));
        $this->set('alternateUrls', []);
    }

    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }

    public function get(string $key)
    {
        return $this->data[$key] ?? '';
    }

    public function set(string $key, $value): self
    {
        $this->data[$key] = $value;

        return $this;
    }

    public function setSeoForModel(SeoAbleInterface $model): self
    {
        return $this
            ->set('title', $model->seoTitle)
            ->set('description', $model->seoDescription);
    }

    public function setAlternateUrlsForModel(UrlTranslatableInterface $model): self
    {
        return $this->set('alternateUrls', $model->alternateUrls);
    }
}