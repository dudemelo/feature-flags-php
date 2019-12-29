<?php

declare(strict_types=1);

namespace FeatureFlagsTest\Flag;

use DateTimeImmutable;
use FeatureFlags\Flag\ActivationDate;
use PHPUnit\Framework\TestCase;

final class ActivationDateTest extends TestCase
{
    public function testEnabled() : void
    {
        self::assertTrue((new ActivationDate(new DateTimeImmutable()))->activated());
    }

    public function testDisabled() : void
    {
        self::assertFalse((new ActivationDate(new DateTimeImmutable('+1 day')))->activated());
    }
}
