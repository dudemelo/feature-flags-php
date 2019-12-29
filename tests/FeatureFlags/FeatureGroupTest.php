<?php

declare(strict_types=1);

namespace FeatureFlagsTest;

use DateTimeImmutable;
use FeatureFlags\Exception\InvalidFeatureName;
use FeatureFlags\FeatureGroup;
use FeatureFlags\FeatureToggle;
use FeatureFlags\Flag\ActivationDate;
use PHPUnit\Framework\TestCase;

final class FeatureGroupTest extends TestCase
{
    public function testInvalidName() : void
    {
        $this->expectException(InvalidFeatureName::class);

        new FeatureGroup('', true);
    }

    public function testDefaultFeatureEnabled() : void
    {
        $feature = new FeatureGroup('disabled-feature-group', false);
        $feature->enable();

        self::assertTrue($feature->enabled());
    }

    public function testDefaultfeatureEnabledWitthFlagActivated() : void
    {
        $feature = new FeatureGroup('enabled-feature-group', true);
        $feature->addFlag(new ActivationDate(new DateTimeImmutable()));

        self::assertTrue($feature->enabled());
    }

    public function testDefaultFeatureDisabled() : void
    {
        $feature = new FeatureGroup('enabled-feature-group', true);
        $feature->disable();

        self::assertFalse($feature->enabled());
    }

    public function testDefaultfeatureEnabledWitthFlagDeactivated() : void
    {
        $feature = new FeatureGroup('enabled-feature-group', true);
        $feature->addFlag(new ActivationDate(new DateTimeImmutable('+1 second')));

        self::assertFalse($feature->enabled());
    }

    public function testDefaultEnabledAndFeatureDisabled() : void
    {
        $group = new FeatureGroup('enabled-feature-group', true);
        $group->addFeature(new FeatureToggle('disabled-feature', false));

        self::assertFalse($group->enabled());
    }
}
