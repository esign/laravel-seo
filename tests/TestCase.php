<?php

namespace Esign\Seo\Tests;

use Esign\Seo\SeoServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [SeoServiceProvider::class];
    }
}