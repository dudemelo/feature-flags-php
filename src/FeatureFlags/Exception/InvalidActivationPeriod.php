<?php

namespace FeatureFlags\Exception;

use InvalidArgumentException;

final class InvalidActivationPeriod extends InvalidArgumentException implements Exception
{
    public static function deactivationEarlierThanActivation() : Exception
    {
        return new self('The deactivation date cannot be earlier than the activation date');
    }
}
