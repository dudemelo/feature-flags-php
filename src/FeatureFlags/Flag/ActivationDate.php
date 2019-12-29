<?php

declare(strict_types=1);

namespace FeatureFlags\Flag;

use DateTimeImmutable;
use DateTimeInterface;

final class ActivationDate implements FeatureFlag
{
    /**
     * @var DateTimeInterface
     */
    private $activation;

    public function __construct(DateTimeInterface $activation)
    {
        $this->activation = $activation;
    }

    public function activated() : bool
    {
        return $this->activation <= new DateTimeImmutable();
    }
}
