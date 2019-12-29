<?php

declare(strict_types=1);

namespace FeatureFlags\Flag;

interface FeatureFlag
{
    public function activated() : bool;
}
