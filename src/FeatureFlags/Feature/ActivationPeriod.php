<?php

declare(strict_types=1);

namespace FeatureFlags\Feature;

use DateTimeImmutable;
use DateTimeInterface;
use FeatureFlags\Exception\InvalidActivationPeriod;
use FeatureFlags\Exception\InvalidFeatureName;

final class ActivationPeriod implements Feature
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var DateTimeInterface
     */
    private $activation;

    /**
     * @var DateTimeInterface
     */
    private $deactivation;

    public function __construct(
        string $name,
        DateTimeInterface $activation,
        DateTimeInterface $deactivation
    ) {
        if ($name === '') {
            throw InvalidFeatureName::emptyName();
        }

        if ($activation > $deactivation) {
            throw InvalidActivationPeriod::deactivationEarlierThanActivation();
        }

        $this->name = $name;
        $this->activation = $activation;
        $this->deactivation = $deactivation;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function enabled() : bool
    {
        $now = new DateTimeImmutable();

        return $this->activation <= $now
            &&  $this->deactivation > $now;
    }
}
