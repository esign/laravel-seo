<?php

namespace Esign\Seo\Tests\Tags;

use PHPUnit\Framework\Attributes\Test;
use Esign\Seo\Exceptions\InvalidConfiguration;
use Esign\Seo\SeoServiceProvider;
use Esign\Seo\Tests\Support\CustomMetaTag;
use Esign\Seo\Tests\Support\InvalidMetaTag;
use Esign\Seo\Tests\TestCase;
use Illuminate\Support\Facades\Config;

final class CustomTagTest extends TestCase
{
    #[Test]
    public function it_can_use_a_custom_tag(): void
    {
        Config::set('seo.tags.meta', CustomMetaTag::class);

        (new SeoServiceProvider($this->app))->register();

        $this->assertInstanceOf(CustomMetaTag::class, app('seo.meta'));
    }

    #[Test]
    public function it_will_throw_an_exception_when_the_configured_tag_does_not_extend_the_default_class(): void
    {
        Config::set('seo.tags.meta', InvalidMetaTag::class);

        $this->expectException(InvalidConfiguration::class);

        (new SeoServiceProvider($this->app))->register();
    }
}
