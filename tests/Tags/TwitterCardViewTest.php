<?php

namespace Esign\Seo\Tests\Tags;

use PHPUnit\Framework\Attributes\Test;
use Esign\Seo\Facades\Tags\TwitterCard;
use Esign\Seo\Tests\TestCase;

final class TwitterCardViewTest extends TestCase
{
    #[Test]
    public function it_can_render_a_type(): void
    {
        TwitterCard::setType('summary');
        $this->assertSeeInView('<meta name="twitter:card" content="summary">', 'twitter-card');
    }

    #[Test]
    public function it_can_render_a_title(): void
    {
        TwitterCard::setTitle('Esign, hét creatieve digital agency');
        $this->assertSeeInView('<meta name="twitter:title" content="Esign, hét creatieve digital agency | Esign">', 'twitter-card');
    }

    #[Test]
    public function it_will_use_the_app_name_if_no_title_has_been_set(): void
    {
        $this->assertSeeInView('<meta name="twitter:title" content="Esign">', 'twitter-card');
    }

    #[Test]
    public function it_can_render_a_description(): void
    {
        TwitterCard::setDescription('Esign helpt jouw merk met zijn online aanwezigheid ...');
        $this->assertSeeInView('<meta name="twitter:description" content="Esign helpt jouw merk met zijn online aanwezigheid ...">', 'twitter-card');
    }

    #[Test]
    public function it_can_render_an_image(): void
    {
        TwitterCard::setImage('https://esign.eu/share-image.jpg');
        $this->assertSeeInView('<meta name="twitter:image" content="https://esign.eu/share-image.jpg">', 'twitter-card');
    }

    #[Test]
    public function it_wont_render_if_given_falsy_values(): void
    {
        TwitterCard::setType(null)
            ->setTitle(null)
            ->setDescription(null)
            ->setImage(null);

            // Some attributes will still be visible due to defaults.
            $this->assertSeeInView('<meta name="twitter:card"', 'twitter-card');
            $this->assertSeeInView('<meta name="twitter:title"', 'twitter-card');
            $this->assertDontSeeInView('<meta name="twitter:description"', 'twitter-card');
            $this->assertDontSeeInView('<meta name="twitter:image"', 'twitter-card');
    }
}
