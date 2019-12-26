<?php

namespace FeatureFlags\Feature;

use FeatureFlags\Exception\InvalidFeatureName;

final class Toggle implements Feature
{
    private $name;
    private $enabled;

    public function __construct(string $name, bool $enabled)
    {
        if ($name === '') {
            throw InvalidFeatureName::emptyName();
        }

        $this->name = $name;
        $this->enabled = $enabled;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function enabled() : bool
    {
        return $this->enabled;
    }
}
