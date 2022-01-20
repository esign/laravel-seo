<?php

namespace Esign\Seo\Tests\Tags;

use Esign\Seo\Facades\Tags\OpenGraph;
use Esign\Seo\Tests\TestCase;

class OpenGraphViewTest extends TestCase
{
    /** @test */
    public function it_can_render_a_type()
    {
        OpenGraph::setType('website');
        $this->assertSeeInView('<meta property="og:type" content="website">', 'open-graph');
    }

    /** @test */
    public function it_can_render_a_site_name()
    {
        OpenGraph::setSiteName('My fancy website');
        $this->assertSeeInView('<meta property="og:site_name" content="My fancy website">', 'open-graph');
    }

    /** @test */
    public function it_can_render_a_title()
    {
        OpenGraph::setTitle('Esign, hét creatieve digital agency');
        $this->assertSeeInView('<meta property="og:title" content="Esign, hét creatieve digital agency">', 'open-graph');
    }

    /** @test */
    public function it_can_render_a_description()
    {
        OpenGraph::setDescription('Esign helpt jouw merk met zijn online aanwezigheid ...');
        $this->assertSeeInView('<meta property="og:description" content="Esign helpt jouw merk met zijn online aanwezigheid ...">', 'open-graph');
    }

    /** @test */
    public function it_can_render_a_canonical_url()
    {
        OpenGraph::setUrl('https://esign.eu');
        $this->assertSeeInView('<meta property="og:url" content="https://esign.eu">', 'open-graph');
    }

    /** @test */
    public function it_can_render_an_image()
    {
        OpenGraph::setImage('https://esign.eu/share-image.jpg');
        $this->assertSeeInView('<meta property="og:image" content="https://esign.eu/share-image.jpg">', 'open-graph');
    }
}
