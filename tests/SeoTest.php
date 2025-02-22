<?php

namespace Esign\Seo\Tests;

use PHPUnit\Framework\Attributes\Test;
use Esign\Seo\Facades\Seo;
use Esign\Seo\Facades\Tags\Meta;
use Esign\Seo\Facades\Tags\OpenGraph;
use Esign\Seo\Facades\Tags\TwitterCard;
use Esign\Seo\Seo as BaseSeo;
use Esign\Seo\Tags\Meta as MetaTag;
use Esign\Seo\Tags\OpenGraph as OpenGraphTag;
use Esign\Seo\Tags\TwitterCard as TwitterCardTag;
use Esign\Seo\Tests\Support\Models\Post;
use Esign\Seo\Tests\Support\Models\PostWithDefaults;

class SeoTest extends TestCase
{
    #[Test]
    public function it_can_set_the_title(): void
    {
        Seo::setTitle('Esign, hét creatieve digital agency');

        $this->assertEqualsMany('Esign, hét creatieve digital agency | Esign', [
            Meta::getTitle(),
            OpenGraph::getTitle(),
            TwitterCard::getTitle(),
        ]);
    }

    #[Test]
    public function it_can_set_the_description(): void
    {
        Seo::setDescription('Esign helpt jouw merk met zijn online aanwezigheid ...');

        $this->assertEqualsMany('Esign helpt jouw merk met zijn online aanwezigheid ...', [
            Meta::getDescription(),
            OpenGraph::getDescription(),
            TwitterCard::getDescription(),
        ]);
    }

    #[Test]
    public function it_can_set_the_image(): void
    {
        Seo::setImage('https://esign.eu/share-image.jpg');

        $this->assertEqualsMany('https://esign.eu/share-image.jpg', [
            Meta::getImage(),
            OpenGraph::getImage(),
            TwitterCard::getImage(),
        ]);
    }

    #[Test]
    public function it_can_set_the_url(): void
    {
        Seo::setUrl('https://esign.eu');

        $this->assertEqualsMany('https://esign.eu', [
            Meta::getUrl(),
            OpenGraph::getUrl(),
        ]);
    }

    #[Test]
    public function it_can_use_the_helper_method(): void
    {
        $this->assertInstanceOf(BaseSeo::class, seo());
    }

    #[Test]
    public function it_can_do_stuff_conditionally(): void
    {
        Seo::when(true, fn (BaseSeo $seo) => $seo->setDescription('Title A'));
        Seo::when(false, fn (BaseSeo $seo) => $seo->setDescription('Title B'));

        $this->assertEqualsMany('Title A', [
            Meta::getDescription(),
            OpenGraph::getDescription(),
            TwitterCard::getDescription(),
        ]);
    }

    #[Test]
    public function it_can_set_alternate_urls(): void
    {
        Seo::setAlternateUrls(['nl' => 'https://esign.eu/nl', 'en' => 'https://esign.eu/en']);

        $this->assertEquals(
            ['nl' => 'https://esign.eu/nl', 'en' => 'https://esign.eu/en'],
            Meta::getAlternateUrls(),
        );
    }

    #[Test]
    public function it_can_get_the_meta_tag(): void
    {
        $this->assertInstanceOf(MetaTag::class, Seo::meta());
    }

    #[Test]
    public function it_can_get_the_opengraph_tag(): void
    {
        $this->assertInstanceOf(OpenGraphTag::class, Seo::og());
    }

    #[Test]
    public function it_can_get_the_twitter_card_tag(): void
    {
        $this->assertInstanceOf(TwitterCardTag::class, Seo::twitter());
    }

    #[Test]
    public function it_can_pass_a_callback_to_the_meta_tag(): void
    {
        Seo::meta(fn (MetaTag $meta) => $meta->setDescription('Description A'));

        $this->assertEquals('Description A', Meta::getDescription());
    }

    #[Test]
    public function it_can_pass_a_callback_to_the_opengraph_tag(): void
    {
        Seo::og(fn (OpenGraphTag $openGraph) => $openGraph->setDescription('Description A'));

        $this->assertEquals('Description A', OpenGraph::getDescription());
    }

    #[Test]
    public function it_can_pass_a_callback_to_the_twitter_card_tag(): void
    {
        Seo::twitter(fn (TwitterCardTag $twitterCard) => $twitterCard->setDescription('Description A'));

        $this->assertEquals('Description A', TwitterCard::getDescription());
    }

    #[Test]
    public function it_can_set_an_seo_contract(): void
    {
        $post = new Post();

        Seo::set($post);

        $this->assertEquals('Esign, hét creatieve digital agency | Esign', Meta::getTitle());
        $this->assertEquals('Esign helpt jouw merk met zijn online aanwezigheid ...', Meta::getDescription());
        $this->assertEquals('https://esign.eu/en', Meta::getUrl());
        $this->assertEquals('https://esign.eu/share-image.jpg', Meta::getImage());
        $this->assertEquals([
            'en' => 'https://esign.eu/en',
            'nl' => 'https://esign.eu/nl',
        ], Meta::getAlternateUrls());
    }

    #[Test]
    public function it_can_set_an_seo_contract_with_defaults(): void
    {
        $post = new PostWithDefaults();
        $post->title = 'My Post Title';
        $post->body = 'My Post Body';

        Seo::set($post);

        $this->assertEquals('My Post Title | Esign', Meta::getTitle());
        $this->assertEquals('My Post Body', Meta::getDescription());
        $this->assertNull(Meta::getImage());
        $this->assertEquals('http://localhost', Meta::getUrl());
        $this->assertEmpty(Meta::getAlternateUrls());
    }
}
