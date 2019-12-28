<?php

declare(strict_types=1);

namespace FeatureFlags\Feature;

use FeatureFlags\Exception\InvalidFeatureName;

final class Toggle implements Feature
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
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
