<?php

namespace Esign\Seo\Tags;

use Esign\Seo\Concerns\HasAttributes;
use Spatie\SchemaOrg\Type;

class JsonLd
{
    use HasAttributes;

    public function addType(iterable | Type $type): self
    {
        if (is_iterable($type)) {
            foreach ($type as $item) {
                $this->addType($item);
            }

            return $this;
        }

        return $this->set('types', [...$this->getTypes(), $type]);
    }

    public function setTypes(array $types): self
    {
        return $this->set('types', $types);
    }

    public function getTypes(): array
    {
        return $this->get('types', []);
    }
}