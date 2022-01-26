<?php

namespace Esign\Seo\Concerns;

trait HasSeoDefaults
{
    public function getSeoTitle(): ?string
    {
        return $this->seo_title ?: $this->title ?: $this->name ?: null;
    }

    public function getSeoDescription(): ?string
    {
        return $this->seo_description ?: $this->body ?: $this->description ?: null;
    }

    public function getSeoImage(): ?string
    {
        return null;
    }

    public function getSeoUrl(): ?string
    {
        return null;
    }

    public function getSeoAlternateUrls(): array
    {
        return [];
    }
}
