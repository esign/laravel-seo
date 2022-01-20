<?php

namespace Esign\Seo\Tests\Concerns;

use Esign\Seo\Concerns\HasAttributes;

class TestTag
{
    use HasAttributes;

    public function setTitleAttribute(?string $value): string
    {
        return $value . ' - Suffix';
    }
}
