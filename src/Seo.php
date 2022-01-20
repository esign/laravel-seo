<?php

namespace Esign\Seo;

use Esign\Seo\Tags\Meta;
use Esign\Seo\Tags\OpenGraph;
use Esign\Seo\Tags\TwitterCard;
use Illuminate\Support\Traits\Conditionable;

class Seo
{
    use Conditionable;

    public function setTitle(?string $title): self
    {
        $this->meta()->setTitle($title);
        $this->og()->setTitle($title);
        $this->twitter()->setTitle($title);

        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->meta()->setDescription($description);
        $this->og()->setDescription($description);
        $this->twitter()->setDescription($description);

        return $this;
    }

    public function setUrl(?string $url): self
    {
        $this->meta()->setUrl($url);
        $this->og()->setUrl($url);

        return $this;
    }

    public function setImage(?string $image): self
    {
        $this->meta()->setImage($image);
        $this->og()->setImage($image);
        $this->twitter()->setImage($image);

        return $this;
    }

    public function meta(): Meta
    {
        return app('seo.meta');
    }

    public function og(): OpenGraph
    {
        return app('seo.open-graph');
    }

    public function twitter(): TwitterCard
    {
        return app('seo.twitter-card');
    }
}
