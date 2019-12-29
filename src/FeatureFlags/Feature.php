<?php

declare(strict_types=1);

namespace FeatureFlags;

interface Feature
{
    public function name() : string;
    public function enabled() : bool;
    public function enable() : void;
    public function disable() : void;
}
