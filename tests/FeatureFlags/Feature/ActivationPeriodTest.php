<?php

namespace FeatureFlagsTest\Feature;

use DateTimeImmutable;
use FeatureFlags\Exception\InvalidActivationPeriod;
use FeatureFlags\Exception\InvalidFeatureName;
use FeatureFlags\Feature\ActivationPeriod;
use PHPUnit\Framework\TestCase;

final class ActivationPeriodTest extends TestCase
{
    public function testInvalidName() : void
    {
        $this->expectException(InvalidFeatureName::class);

        new ActivationPeriod(
            '',
            new DateTimeImmutable(),
            new DateTimeImmutable()
        );
    }

    public function testInvalidDeactivationDate() : void
    {
        $this->expectException(InvalidActivationPeriod::class);

        new ActivationPeriod(
            'invalid-deactivation-date-feature',
            new DateTimeImmutable(),
            new DateTimeImmutable('-1 seconds')
        );
    }

    public function testEnabled() : void
    {
        self::assertTrue(
            (new ActivationPeriod(
                'enabled-feature',
                new DateTimeImmutable('-1 day'),
                new DateTimeImmutable('+1 second')
            ))
                ->enabled()
        );
    }

    public function testDisabled() : void
    {
        self::assertFalse(
            (new ActivationPeriod(
                'disabled-feature',
                new DateTimeImmutable('-1 day'),
                new DateTimeImmutable('-1 second')
            ))
                ->enabled()
        );
    }
}
