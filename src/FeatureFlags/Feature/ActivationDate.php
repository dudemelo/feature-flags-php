<?php

namespace FeatureFlags\Feature;

use DateTimeImmutable;
use DateTimeInterface;
use FeatureFlags\Exception\InvalidFeatureName;

final class ActivationDate implements Feature
{
    private $name;
    private $activation;

    public function __construct(string $name, DateTimeInterface $activation)
    {
        if ($name === '') {
            throw InvalidFeatureName::emptyName();
        }

        $this->name = $name;
        $this->activation = $activation;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function enabled() : bool
    {
        return $this->activation <= new DateTimeImmutable();
    }
}
