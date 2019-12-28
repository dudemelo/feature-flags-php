<?php

declare(strict_types=1);

namespace FeatureFlagsTest\Feature;

use FeatureFlags\Exception\InvalidFeatureName;
use FeatureFlags\Feature\Toggle;
use PHPUnit\Framework\TestCase;

final class ToggleTest extends TestCase
{
    public function testInvalidName() : void
    {
        $this->expectException(InvalidFeatureName::class);

        new Toggle('', true);
    }

    public function testEnabled() : void
    {
        self::assertTrue((new Toggle('enabled-feature', true))->enabled());
    }

    public function testDisabled() : void
    {
        self::assertFalse((new Toggle('disabled-feature', false))->enabled());
    }
}
