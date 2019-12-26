<?php

namespace FeatureFlags\Feature;

interface Feature
{
    public function name(): string;
    public function enabled() : bool;
}
