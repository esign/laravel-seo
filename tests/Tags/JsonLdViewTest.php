<?php

namespace Esign\Seo\Tests\Tags;

use Esign\Seo\Facades\Tags\JsonLd;
use Esign\Seo\Tests\TestCase;
use Spatie\SchemaOrg\Schema;

class JsonLdViewTest extends TestCase
{
    /** @test */
    public function it_can_add_a_type()
    {
        JsonLd::addType(Schema::localBusiness()->name('Esign')->email('hello@esign.eu'));
        $this->assertSeeInView('<script type="application/ld+json">{"@context":"https:\/\/schema.org","@type":"LocalBusiness","name":"Esign","email":"hello@esign.eu"}</script>', 'json-ld');
    }

    /** @test */
    public function it_can_add_multiple_types()
    {
        JsonLd::addType([
            Schema::localBusiness()->name('Esign')->email('hello@esign.eu'),
            Schema::article()->headline('My article')->description('My article description'),
        ]);
        $this->assertSeeInView('<script type="application/ld+json">{"@context":"https:\/\/schema.org","@type":"LocalBusiness","name":"Esign","email":"hello@esign.eu"}</script>', 'json-ld');
        $this->assertSeeInView('<script type="application/ld+json">{"@context":"https:\/\/schema.org","@type":"Article","headline":"My article","description":"My article description"}</script>', 'json-ld');
    }

    /** @test */
    public function it_can_set_types()
    {
        JsonLd::setTypes([
            Schema::localBusiness()->name('Esign')->email('hello@esign.eu'),
            Schema::article()->headline('My article')->description('My article description'),
        ]);
        $this->assertSeeInView('<script type="application/ld+json">{"@context":"https:\/\/schema.org","@type":"LocalBusiness","name":"Esign","email":"hello@esign.eu"}</script>', 'json-ld');
        $this->assertSeeInView('<script type="application/ld+json">{"@context":"https:\/\/schema.org","@type":"Article","headline":"My article","description":"My article description"}</script>', 'json-ld');
    }
}
