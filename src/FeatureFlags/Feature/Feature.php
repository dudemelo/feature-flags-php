<?php

declare(strict_types=1);

namespace FeatureFlags\Feature;

interface Feature
{
    public function name(): string;
    public function enabled() : bool;
}
