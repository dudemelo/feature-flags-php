<?php

declare(strict_types=1);

namespace FeatureFlagsTest\Feature;

use DateTimeImmutable;
use FeatureFlags\Exception\InvalidFeatureName;
use FeatureFlags\Feature\ActivationDate;
use PHPUnit\Framework\TestCase;

final class ActivationDateTest extends TestCase
{
    public function testInvalidName() : void
    {
        $this->expectException(InvalidFeatureName::class);

        new ActivationDate('', new DateTimeImmutable());
    }

    public function testEnabled() : void
    {
        self::assertTrue((new ActivationDate('enabled-feature', new DateTimeImmutable()))->enabled());
    }

    public function testDisabled() : void
    {
        self::assertFalse((new ActivationDate('disabled-feature', new DateTimeImmutable('+1 day')))->enabled());
    }
}
