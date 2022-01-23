<?php

namespace Esign\Seo\Tests;

use Esign\Seo\Facades\Seo;
use Esign\Seo\Facades\Tags\Meta;
use Esign\Seo\Facades\Tags\OpenGraph;
use Esign\Seo\Facades\Tags\TwitterCard;
use Esign\Seo\Seo as BaseSeo;
use Esign\Seo\Tags\Meta as MetaTag;
use Esign\Seo\Tags\OpenGraph as OpenGraphTag;
use Esign\Seo\Tags\TwitterCard as TwitterCardTag;

class SeoTest extends TestCase
{
    /** @test */
    public function it_can_set_the_title()
    {
        Seo::setTitle('Esign, hét creatieve digital agency');

        $this->assertEqualsMany('Esign, hét creatieve digital agency', [
            Meta::getTitle(),
            OpenGraph::getTitle(),
            TwitterCard::getTitle(),
        ]);
    }

    /** @test */
    public function it_can_set_the_description()
    {
        Seo::setDescription('Esign helpt jouw merk met zijn online aanwezigheid ...');

        $this->assertEqualsMany('Esign helpt jouw merk met zijn online aanwezigheid ...', [
            Meta::getDescription(),
            OpenGraph::getDescription(),
            TwitterCard::getDescription(),
        ]);
    }

    /** @test */
    public function it_can_set_the_image()
    {
        Seo::setImage('https://esign.eu/share-image.jpg');

        $this->assertEqualsMany('https://esign.eu/share-image.jpg', [
            Meta::getImage(),
            OpenGraph::getImage(),
            TwitterCard::getImage(),
        ]);
    }

    /** @test */
    public function it_can_set_the_url()
    {
        Seo::setUrl('https://esign.eu');

        $this->assertEqualsMany('https://esign.eu', [
            Meta::getUrl(),
            OpenGraph::getUrl(),
        ]);
    }

    /** @test */
    public function it_can_use_the_helper_method()
    {
        $this->assertInstanceOf(BaseSeo::class, seo());
    }

    /** @test */
    public function it_can_do_stuff_conditionally()
    {
        Seo::when(true, fn (BaseSeo $seo) => $seo->setTitle('Title A'));
        Seo::when(false, fn (BaseSeo $seo) => $seo->setTitle('Title B'));

        $this->assertEqualsMany('Title A', [
            Meta::getTitle(),
            OpenGraph::getTitle(),
            TwitterCard::getTitle()
        ]);
    }

    /** @test */
    public function it_can_set_alternate_urls()
    {
        Seo::setAlternateUrls(['nl' => 'https://esign.eu/nl', 'en' => 'https://esign.eu/en']);

        $this->assertEquals(
            ['nl' => 'https://esign.eu/nl', 'en' => 'https://esign.eu/en'],
            Meta::getAlternateUrls(),
        );
    }

    /** @test */
    public function it_can_get_the_meta_tag()
    {
        $this->assertInstanceOf(MetaTag::class, Seo::meta());
    }

    /** @test */
    public function it_can_get_the_opengraph_tag()
    {
        $this->assertInstanceOf(OpenGraphTag::class, Seo::og());
    }

    /** @test */
    public function it_can_get_the_twitter_card_tag()
    {
        $this->assertInstanceOf(TwitterCardTag::class, Seo::twitter());
    }

    /** @test */
    public function it_can_pass_a_callback_to_the_meta_tag()
    {
        Seo::meta(fn (MetaTag $meta) => $meta->setTitle('Title A'));

        $this->assertEquals('Title A', Meta::getTitle());
    }

    /** @test */
    public function it_can_pass_a_callback_to_the_opengraph_tag()
    {
        Seo::og(fn (OpenGraphTag $openGraph) => $openGraph->setTitle('Title A'));

        $this->assertEquals('Title A', OpenGraph::getTitle());
    }

    /** @test */
    public function it_can_pass_a_callback_to_the_twitter_card_tag()
    {
        Seo::twitter(fn (TwitterCardTag $twitterCard) => $twitterCard->setTitle('Title A'));

        $this->assertEquals('Title A', TwitterCard::getTitle());
    }
}
