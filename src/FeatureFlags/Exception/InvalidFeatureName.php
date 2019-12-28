<?php

declare(strict_types=1);

namespace FeatureFlags\Exception;

use InvalidArgumentException;

final class InvalidFeatureName extends InvalidArgumentException implements Exception
{
    public static function emptyName() : Exception
    {
        return new self('The feature name cannot be empty.');
    }
}
