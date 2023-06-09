<?php

namespace Esign\Seo\Tags;

use Esign\Seo\Concerns\HasAttributes;

class Meta
{
    use HasAttributes;

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

    public function setPrev(?string $prev): self
    {
        return $this->set('prev', $prev);
    }

    public function getPrev(): ?string
    {
        return $this->get('prev');
    }

    public function setNext(?string $next): self
    {
        return $this->set('next', $next);
    }

    public function getNext(): ?string
    {
        return $this->get('next');
    }

    public function setRobots(?string $robots): self
    {
        return $this->set('robots', $robots);
    }

    public function getRobots(): ?string
    {
        return $this->get('robots');
    }

    public function setAlternateUrls(array $alternateUrls): self
    {
        return $this->set('alternateUrls', $alternateUrls);
    }

    public function addAlternateUrls(array $alternateUrls): self
    {
        return $this->setAlternateUrls(array_merge(
            $this->getAlternateUrls(),
            $alternateUrls,
        ));
    }

    public function getAlternateUrls(): array
    {
        return $this->get('alternateUrls', []);
    }
}
