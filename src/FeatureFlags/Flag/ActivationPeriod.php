<?php

declare(strict_types=1);

namespace FeatureFlags\Flag;

use DateTimeImmutable;
use DateTimeInterface;
use FeatureFlags\Exception\InvalidActivationPeriod;

final class ActivationPeriod implements FeatureFlag
{
    /**
     * @var DateTimeInterface
     */
    private $activation;

    /**
     * @var DateTimeInterface
     */
    private $deactivation;

    public function __construct(
        DateTimeInterface $activation,
        DateTimeInterface $deactivation
    ) {
        if ($activation > $deactivation) {
            throw InvalidActivationPeriod::deactivationEarlierThanActivation();
        }

        $this->activation = $activation;
        $this->deactivation = $deactivation;
    }

    public function activated() : bool
    {
        $now = new DateTimeImmutable();

        return $this->activation <= $now
            &&  $this->deactivation > $now;
    }
}
