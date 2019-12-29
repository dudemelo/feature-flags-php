<?php

declare(strict_types=1);

namespace FeatureFlags;

use FeatureFlags\Exception\InvalidFeatureName;

final class FeatureToggle implements Feature
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

    public function name(): string
    {
        return $this->name;
    }

    public function enabled(): bool
    {
        return $this->enabled;
    }

    public function enable(): void
    {
        $this->enabled = true;
    }

    public function disable(): void
    {
        $this->enabled = false;
    }
}
