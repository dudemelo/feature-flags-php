<?php

declare(strict_types=1);

namespace FeatureFlags;

use FeatureFlags\Flag\FeatureFlag;

final class FeatureGroup implements Feature
{
    /**
     * @var Feature
     */
    private $default;

    /**
     * @var Feature[]
     */
    private $features;

    public function __construct(string $name, bool $enabled)
    {
        $this->default = new FeatureToggle($name, $enabled);
        $this->features = [];
    }

    public function name(): string
    {
        return $this->default->name();
    }

    public function enabled(): bool
    {
        $disabled = array_filter($this->features, function (Feature $feature) {
            return false === $feature->enabled();
        });

        return $this->default->enabled() && count($disabled) === 0;
    }

    public function enable(): void
    {
        $this->default->enable();

        array_map(function (Feature $feature) {
            $feature->enable();
        }, $this->features);
    }

    public function disable(): void
    {
        $this->default->disable();

        array_map(function (Feature $feature) {
            $feature->disable();
        }, $this->features);
    }

    public function addFeature(Feature $feature) : void
    {
        $this->features[] = $feature;
    }

    public function addFlag(FeatureFlag $flag): void
    {
        $this->default->addFlag($flag);
    }
}
