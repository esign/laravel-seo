<?php

namespace Esign\Seo\Tests\Tags;

use PHPUnit\Framework\Attributes\Test;
use Esign\Seo\Facades\Tags\JsonLd;
use Esign\Seo\Tests\TestCase;
use Spatie\SchemaOrg\Schema;

final class JsonLdViewTest extends TestCase
{
    #[Test]
    public function it_can_add_a_type(): void
    {
        JsonLd::addType(Schema::localBusiness()->name('Esign')->email('hello@esign.eu'));
        $this->assertSeeInView('<script type="application/ld+json">{"@context":"https://schema.org","@type":"LocalBusiness","name":"Esign","email":"hello@esign.eu"}</script>', 'json-ld');
    }

    #[Test]
    public function it_can_add_multiple_types(): void
    {
        JsonLd::addType([
            Schema::localBusiness()->name('Esign')->email('hello@esign.eu'),
            Schema::article()->headline('My article')->description('My article description'),
        ]);
        $this->assertSeeInView('<script type="application/ld+json">{"@context":"https://schema.org","@type":"LocalBusiness","name":"Esign","email":"hello@esign.eu"}</script>', 'json-ld');
        $this->assertSeeInView('<script type="application/ld+json">{"@context":"https://schema.org","@type":"Article","headline":"My article","description":"My article description"}</script>', 'json-ld');
    }

    #[Test]
    public function it_can_set_types(): void
    {
        JsonLd::setTypes([
            Schema::localBusiness()->name('Esign')->email('hello@esign.eu'),
            Schema::article()->headline('My article')->description('My article description'),
        ]);
        $this->assertSeeInView('<script type="application/ld+json">{"@context":"https://schema.org","@type":"LocalBusiness","name":"Esign","email":"hello@esign.eu"}</script>', 'json-ld');
        $this->assertSeeInView('<script type="application/ld+json">{"@context":"https://schema.org","@type":"Article","headline":"My article","description":"My article description"}</script>', 'json-ld');
    }
}
