<?php

namespace Esign\Seo\Tests\Tags;

use Esign\Seo\Facades\Tags\TwitterCard;
use Esign\Seo\Tests\TestCase;

class TwitterCardViewTest extends TestCase
{
    /** @test */
    public function it_can_render_a_type()
    {
        TwitterCard::setType('summary');
        $this->assertSeeInView('<meta name="twitter:card" content="summary">', 'twitter-card');
    }

    /** @test */
    public function it_can_render_a_title()
    {
        TwitterCard::setTitle('Esign, hét creatieve digital agency');
        $this->assertSeeInView('<meta name="twitter:title" content="Esign, hét creatieve digital agency">', 'twitter-card');
    }

    /** @test */
    public function it_can_render_a_description()
    {
        TwitterCard::setDescription('Esign helpt jouw merk met zijn online aanwezigheid ...');
        $this->assertSeeInView('<meta name="twitter:description" content="Esign helpt jouw merk met zijn online aanwezigheid ...">', 'twitter-card');
    }

    /** @test */
    public function it_can_render_an_image()
    {
        TwitterCard::setImage('https://esign.eu/share-image.jpg');
        $this->assertSeeInView('<meta name="twitter:image" content="https://esign.eu/share-image.jpg">', 'twitter-card');
    }
}
