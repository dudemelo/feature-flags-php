<?php

declare(strict_types=1);

namespace FeatureFlags;

use FeatureFlags\Exception\InvalidFeatureName;
use FeatureFlags\Flag\FeatureFlag;

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

    /**
     * @var FeatureFlag[]
     */
    private $flags;

    public function __construct(string $name, bool $enabled)
    {
        if ($name === '') {
            throw InvalidFeatureName::emptyName();
        }

        $this->name = $name;
        $this->enabled = $enabled;
        $this->flags = [];
    }

    public function name(): string
    {
        return $this->name;
    }

    public function enabled(): bool
    {
        $deactivated = array_filter($this->flags, function (FeatureFlag $flag) {
            return false === $flag->activated();
        });

        return $this->enabled && count($deactivated) === 0;
    }

    public function enable(): void
    {
        $this->enabled = true;
    }

    public function disable(): void
    {
        $this->enabled = false;
    }

    public function addFlag(FeatureFlag $flag): void
    {
        $this->flags[] = $flag;
    }
}
