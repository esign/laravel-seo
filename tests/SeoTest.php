<?php

namespace Esign\Seo\Tests;

use Esign\Seo\Facades\Seo;
use Esign\Seo\Facades\Tags\Meta;
use Esign\Seo\Facades\Tags\OpenGraph;
use Esign\Seo\Facades\Tags\TwitterCard;
use Esign\Seo\Seo as BaseSeo;

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
}
