<?php

declare(strict_types=1);

namespace FeatureFlagsTest;

use FeatureFlags\Exception\InvalidFeatureName;
use FeatureFlags\FeatureToggle;
use PHPUnit\Framework\TestCase;

final class FeatureToggleTest extends TestCase
{
    public function testInvalidName() : void
    {
        $this->expectException(InvalidFeatureName::class);

        new FeatureToggle('', true);
    }

    public function testEnabled() : void
    {
        $feature = new FeatureToggle('disabled-feature', false);
        $feature->enable();

        self::assertTrue($feature->enabled());
    }

    public function testDisabled() : void
    {
        $feature = new FeatureToggle('enabled-feature', true);
        $feature->disable();

        self::assertFalse($feature->enabled());
    }
}
