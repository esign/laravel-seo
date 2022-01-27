<?php

namespace Esign\Seo\Tags;

use Esign\Seo\Concerns\HasAttributes;

class OpenGraph
{
    use HasAttributes;

    public function setType(?string $type): self
    {
        return $this->set('type', $type);
    }

    public function getType(): ?string
    {
        return $this->get('type', 'website');
    }

    public function setSiteName(?string $siteName): self
    {
        return $this->set('siteName', $siteName);
    }

    public function getSiteName(): ?string
    {
        return $this->get('siteName', config('app.name'));
    }

    public function setTitle(?string $title): self
    {
        return $this->set('title', $title);
    }

    public function setTitleAttribute(?string $title): ?string
    {
        return sprintf('%s | %s', $title, config('app.name'));
    }

    public function getTitle(): ?string
    {
        return $this->get('title', config('app.name'));
    }

    public function setDescription(?string $description): self
    {
        return $this->set('description', $description);
    }

    public function getDescription(): ?string
    {
        return $this->get('description');
    }

    public function setImage(?string $image): self
    {
        return $this->set('image', $image);
    }

    public function getImage(): ?string
    {
        return $this->get('image');
    }

    public function setUrl(?string $url): self
    {
        return $this->set('url', $url);
    }

    public function getUrl(): ?string
    {
        return $this->get('url', url()->current());
    }
}
