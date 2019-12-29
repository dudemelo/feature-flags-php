<?php

declare(strict_types=1);

namespace FeatureFlagsTest;

use DateTimeImmutable;
use FeatureFlags\Exception\InvalidFeatureName;
use FeatureFlags\FeatureToggle;
use FeatureFlags\Flag\ActivationDate;
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

    public function testEnabledWithActivatedFlag() : void
    {
        $feature = new FeatureToggle('enabled-feature', true);
        $feature->addFlag(new ActivationDate(new DateTimeImmutable()));

        self::assertTrue($feature->enabled());
    }

    public function testDisabled() : void
    {
        $feature = new FeatureToggle('enabled-feature', true);
        $feature->disable();

        self::assertFalse($feature->enabled());
    }

    public function testEnabledWithDeactivatedFlag() : void
    {
        $feature = new FeatureToggle('enabled-feature', true);
        $feature->addFlag(new ActivationDate(new DateTimeImmutable('+1 second')));

        self::assertFalse($feature->enabled());
    }
}
