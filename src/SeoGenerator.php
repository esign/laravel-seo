<?php

namespace Esign\Seo;

abstract class SeoGenerator
{
    protected Seo $seo;

    public function __construct(Seo $seo)
    {
        return $this->seo = $seo;
    }

    abstract public function generate(): void;
}