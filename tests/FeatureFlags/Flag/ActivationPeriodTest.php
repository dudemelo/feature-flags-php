<?php

declare(strict_types=1);

namespace FeatureFlagsTest\Flag;

use DateTimeImmutable;
use FeatureFlags\Exception\InvalidActivationPeriod;
use FeatureFlags\Flag\ActivationPeriod;
use PHPUnit\Framework\TestCase;

final class ActivationPeriodTest extends TestCase
{
    public function testInvalidDeactivationDate() : void
    {
        $this->expectException(InvalidActivationPeriod::class);

        new ActivationPeriod(
            new DateTimeImmutable(),
            new DateTimeImmutable('-1 seconds')
        );
    }

    public function testEnabled() : void
    {
        self::assertTrue(
            (new ActivationPeriod(
                new DateTimeImmutable('-1 day'),
                new DateTimeImmutable('+1 second')
            ))
                ->activated()
        );
    }

    public function testDisabled() : void
    {
        self::assertFalse(
            (new ActivationPeriod(
                new DateTimeImmutable('-1 day'),
                new DateTimeImmutable('-1 second')
            ))
                ->activated()
        );
    }
}
