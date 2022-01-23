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

    public function meta(?callable $callback = null): self | Meta
    {
        $meta = app('seo.meta');

        if ($callback) {
            $callback($meta);

            return $this;
        }

        return $meta;
    }

    public function og(?callable $callback = null): self | OpenGraph
    {
        $openGraph = app('seo.open-graph');

        if ($callback) {
            $callback($openGraph);

            return $this;
        }

        return $openGraph;
    }

    public function twitter(?callable $callback = null): self | TwitterCard
    {
        $twitterCard = app('seo.twitter-card');

        if ($callback) {
            $callback($twitterCard);

            return $this;
        }

        return $twitterCard;
    }
}
