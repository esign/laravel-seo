<?php

namespace Esign\Seo\Contracts;

interface SeoAble
{
    public function getSeoTitle(): ?string;

    public function getSeoDescription(): ?string;

    public function getSeoUrl(): ?string;

    public function getSeoImage(): ?string;

    public function getSeoAlternateUrls(): array;
}
