<?php

namespace Esign\Seo\Tests;

use Esign\Seo\Facades\Seo;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class SeoViewTest extends TestCase
{
    use InteractsWithViews;

    protected function assertSeeInView(
        string $value,
        string $view = 'seo',
        bool $escaped = false
    ): void
    {
        $view = $this->view("seo::$view");
        $view->assertSee($value, $escaped);
    }

    /** @test */
    public function it_can_render_a_title()
    {
        Seo::set('title', 'Esign, hét creatieve digital agency');
        $this->assertSeeInView('<title>Esign, hét creatieve digital agency - Laravel</title>');
        $this->assertSeeInView('<meta property="og:title" content="Esign, hét creatieve digital agency - Laravel">');
        $this->assertSeeInView('<meta name="twitter:title" content="Esign, hét creatieve digital agency - Laravel">');
    }

    /** @test */
    public function it_can_render_a_title_separator()
    {
        Seo::set('title', 'Esign, hét creatieve digital agency');
        Seo::set('titleSeparator', ' | ');
        $this->assertSeeInView('<title>Esign, hét creatieve digital agency | Laravel</title>');
        $this->assertSeeInView('<meta property="og:title" content="Esign, hét creatieve digital agency | Laravel">');
        $this->assertSeeInView('<meta name="twitter:title" content="Esign, hét creatieve digital agency | Laravel">');
    }

    /** @test */
    public function it_can_render_a_title_suffix()
    {
        Seo::set('title', 'Esign, hét creatieve digital agency');
        Seo::set('titleSuffix', 'Esign');
        $this->assertSeeInView('<title>Esign, hét creatieve digital agency - Esign</title>');
        $this->assertSeeInView('<meta property="og:title" content="Esign, hét creatieve digital agency - Esign">');
        $this->assertSeeInView('<meta name="twitter:title" content="Esign, hét creatieve digital agency - Esign">');
    }

    /** @test */
    public function it_can_render_a_title_without_separator_and_suffix()
    {
        Seo::set('title', 'Esign, hét creatieve digital agency');
        Seo::set('titleSeparator', '');
        Seo::set('titleSuffix', '');
        $this->assertSeeInView('<title>Esign, hét creatieve digital agency</title>');
        $this->assertSeeInView('<meta property="og:title" content="Esign, hét creatieve digital agency">');
        $this->assertSeeInView('<meta name="twitter:title" content="Esign, hét creatieve digital agency">');
    }

    /** @test */
    public function it_can_render_a_description()
    {
        Seo::set('description', 'Esign helpt jouw merk met zijn online aanwezigheid ...');
        $this->assertSeeInView('<meta name="description" content="Esign helpt jouw merk met zijn online aanwezigheid ...">');
        $this->assertSeeInView('<meta property="og:description" content="Esign helpt jouw merk met zijn online aanwezigheid ...">');
        $this->assertSeeInView('<meta name="twitter:description" content="Esign helpt jouw merk met zijn online aanwezigheid ...">');
    }

    /** @test */
    public function it_can_render_a_share_image()
    {
        Seo::set('image', 'https://esign.eu/share-image.jpg');
        $this->assertSeeInView('<meta property="og:image" content="https://esign.eu/share-image.jpg">');
        $this->assertSeeInView('<meta name="twitter:image" content="https://esign.eu/share-image.jpg">');
    }

    /** @test */
    public function it_can_render_robots()
    {
        Seo::set('robots', 'all,index');
        $this->assertSeeInView('<meta name="robots" content="all,index">');
    }

    /** @test */
    public function it_can_render_a_prev_link()
    {
        Seo::set('prev', 'https://esign.eu/blog?page=1');
        $this->assertSeeInView('<link rel="prev" href="https://esign.eu/blog?page=1">');
    }

    /** @test */
    public function it_can_render_a_next_link()
    {
        Seo::set('next', 'https://esign.eu/blog?page=2');
        $this->assertSeeInView('<link rel="next" href="https://esign.eu/blog?page=2">');
    }
}