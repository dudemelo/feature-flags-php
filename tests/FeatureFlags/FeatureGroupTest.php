<?php

declare(strict_types=1);

namespace FeatureFlagsTest;

use FeatureFlags\Exception\InvalidFeatureName;
use FeatureFlags\FeatureGroup;
use FeatureFlags\FeatureToggle;
use PHPUnit\Framework\TestCase;

final class FeatureGroupTest extends TestCase
{
    public function testInvalidName() : void
    {
        $this->expectException(InvalidFeatureName::class);

        new FeatureGroup('', []);
    }

    public function testDefaultFeatureEnabled() : void
    {
        $feature = new FeatureGroup('disabled-feature-group', []);
        $feature->enable();

        self::assertTrue($feature->enabled());
    }

    public function testDefaultFeatureDisabled() : void
    {
        $feature = new FeatureGroup('enabled-feature-group', []);
        $feature->disable();

        self::assertFalse($feature->enabled());
    }

    public function testFeatureDisabled() : void
    {
        $feature = new FeatureGroup('enabled-feature-group', [
            new FeatureToggle('disabled-feature', false)
        ]);

        self::assertFalse($feature->enabled());
    }
}
