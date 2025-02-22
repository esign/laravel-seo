<?php

namespace Esign\Seo\Tests\Tags;

use PHPUnit\Framework\Attributes\Test;
use Esign\Seo\Facades\Tags\OpenGraph;
use Esign\Seo\Tests\TestCase;

final class OpenGraphViewTest extends TestCase
{
    #[Test]
    public function it_can_render_a_type(): void
    {
        OpenGraph::setType('website');
        $this->assertSeeInView('<meta property="og:type" content="website">', 'open-graph');
    }

    #[Test]
    public function it_can_render_a_site_name(): void
    {
        OpenGraph::setSiteName('My fancy website');
        $this->assertSeeInView('<meta property="og:site_name" content="My fancy website">', 'open-graph');
    }

    #[Test]
    public function it_can_render_a_title(): void
    {
        OpenGraph::setTitle('Esign, hét creatieve digital agency');
        $this->assertSeeInView('<meta property="og:title" content="Esign, hét creatieve digital agency | Esign">', 'open-graph');
    }

    #[Test]
    public function it_will_use_the_app_name_if_no_title_has_been_set(): void
    {
        $this->assertSeeInView('<meta property="og:title" content="Esign">', 'open-graph');
    }

    #[Test]
    public function it_can_render_a_description(): void
    {
        OpenGraph::setDescription('Esign helpt jouw merk met zijn online aanwezigheid ...');
        $this->assertSeeInView('<meta property="og:description" content="Esign helpt jouw merk met zijn online aanwezigheid ...">', 'open-graph');
    }

    #[Test]
    public function it_can_render_a_canonical_url(): void
    {
        OpenGraph::setUrl('https://esign.eu');
        $this->assertSeeInView('<meta property="og:url" content="https://esign.eu">', 'open-graph');
    }

    #[Test]
    public function it_can_render_an_image(): void
    {
        OpenGraph::setImage('https://esign.eu/share-image.jpg');
        $this->assertSeeInView('<meta property="og:image" content="https://esign.eu/share-image.jpg">', 'open-graph');
    }

    #[Test]
    public function it_wont_render_if_given_falsy_values(): void
    {
        OpenGraph::setType(null)
            ->setSiteName(null)
            ->setTitle(null)
            ->setDescription(null)
            ->setImage(null)
            ->setUrl(null);

            // Some attributes will still be visible due to defaults.
            $this->assertSeeInView('<meta property="og:type"', 'open-graph');
            $this->assertSeeInView('<meta property="og:site_name"', 'open-graph');
            $this->assertSeeInView('<meta property="og:title"', 'open-graph');
            $this->assertSeeInView('<meta property="og:url"', 'open-graph');
            $this->assertDontSeeInView('<meta property="og:description"', 'open-graph');
            $this->assertDontSeeInView('<meta property="og:image"', 'open-graph');
    }
}
