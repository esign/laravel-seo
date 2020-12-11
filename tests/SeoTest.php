<?php

namespace Esign\Seo\Tests;

use Esign\Seo\Facades\Seo;
use Esign\Seo\Tests\Models\TestModel;

class SeoTest extends TestCase
{
    /** @test */
    public function it_can_set_seo_for_a_model()
    {
        Seo::setSeoForModel(new TestModel);
        $this->assertEquals('Test Model Title', Seo::get('title'));
        $this->assertEquals('Test Model Description', Seo::get('description'));
    }

    /** @test */
    public function it_can_set_alternate_urls_for_a_model()
    {
        Seo::setAlternateUrlsForModel(new TestModel);
        $this->assertEquals(
            [
                'nl' => 'https://esign.eu/nl',
                'en' => 'https://esign.eu/en',
            ],
            Seo::get('alternateUrls'),
        );
    }
}