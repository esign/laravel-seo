<?php

namespace Esign\Seo\Tests\Tags;

use Esign\Seo\Facades\Tags\Meta;
use Esign\Seo\Tests\TestCase;

class MetaViewTest extends TestCase
{
    /** @test */
    public function it_can_render_a_title()
    {
        Meta::setTitle('Esign, hét creatieve digital agency');
        $this->assertSeeInView('<title>Esign, hét creatieve digital agency | Esign</title>', 'meta');
    }

    /** @test */
    public function it_will_use_the_app_name_if_no_title_has_been_set()
    {
        $this->assertSeeInView('<title>Esign</title>', 'meta');
    }

    /** @test */
    public function it_can_render_a_description()
    {
        Meta::setDescription('Esign helpt jouw merk met zijn online aanwezigheid ...');
        $this->assertSeeInView('<meta name="description" content="Esign helpt jouw merk met zijn online aanwezigheid ...">', 'meta');
    }

    /** @test */
    public function it_can_render_a_canonical_url()
    {
        Meta::setUrl('https://esign.eu');
        $this->assertSeeInView('<link rel="canonical" href="https://esign.eu">', 'meta');
    }

    /** @test */
    public function it_can_render_robots()
    {
        Meta::setRobots('all,index');
        $this->assertSeeInView('<meta name="robots" content="all,index">', 'meta');
    }

    /** @test */
    public function it_can_render_a_prev_link()
    {
        Meta::setPrev('https://esign.eu/blog?page=1');
        $this->assertSeeInView('<link rel="prev" href="https://esign.eu/blog?page=1">', 'meta');
    }

    /** @test */
    public function it_can_render_a_next_link()
    {
        Meta::setNext('https://esign.eu/blog?page=2');
        $this->assertSeeInView('<link rel="next" href="https://esign.eu/blog?page=2">', 'meta');
    }

    /** @test */
    public function it_can_render_alternate_urls()
    {
        Meta::setAlternateUrls(['nl' => 'https://esign.eu/nl', 'en' => 'https://esign.eu/en']);
        $this->assertSeeInView('<link rel="alternate" hreflang="nl" href="https://esign.eu/nl">', 'meta');
        $this->assertSeeInView('<link rel="alternate" hreflang="en" href="https://esign.eu/en">', 'meta');
    }
}
