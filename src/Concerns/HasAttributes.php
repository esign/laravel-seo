<?php

namespace Esign\Seo\Concerns;

use Illuminate\Support\Str;

trait HasAttributes
{
    protected array $attributes = [];

    public function set(string $key, mixed $value): self
    {
        if ($this->hasSetMutator($key)) {
            $value = $this->mutateAttribute($key, $value);
        }

        $this->attributes[$key] = $value;

        return $this;
    }

    public function setRaw(string $key, mixed $value): self
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $value = $this->attributes[$key] ?? null;

        return $value ?: $default;
    }

    public function has(string $key): bool
    {
        return ! empty($this->get($key));
    }

    protected function hasSetMutator($key): bool
    {
        return method_exists($this, 'set' . Str::studly($key) . 'Attribute');
    }

    protected function mutateAttribute(string $key, mixed $value): mixed
    {
        return $this->{'set' . Str::studly($key) . 'Attribute'}($value);
    }
}
