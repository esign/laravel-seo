<?php

namespace Esign\Seo\Tests;

use Esign\Seo\SeoServiceProvider;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use InteractsWithViews;

    protected function getPackageProviders($app)
    {
        return [SeoServiceProvider::class];
    }

    protected function assertEqualsMany($expected, array $actual): void
    {
        foreach ($actual as $item) {
            $this->assertEquals($expected, $item);
        }
    }

    protected function assertSeeInView(
        string $value,
        string $view = 'seo',
        bool $escaped = false
    ): void {
        $view = $this->view("seo::$view");
        $view->assertSee($value, $escaped);
    }
}
