<?php

namespace Esign\Seo\Exceptions;

use Exception;

class InvalidConfiguration extends Exception
{
    public static function invalidTag(string $configuredClass, string $packageClass): self
    {
        return new static(sprintf(
            'The configured class `%s` does not extend the required package class `%s`.',
            $configuredClass,
            $packageClass,
        ));
    }
}
