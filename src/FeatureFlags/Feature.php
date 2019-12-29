<?php

declare(strict_types=1);

namespace FeatureFlags;

use FeatureFlags\Flag\FeatureFlag;

interface Feature
{
    public function name() : string;
    public function enabled() : bool;
    public function enable() : void;
    public function disable() : void;
    public function addFlag(FeatureFlag $flag) : void;
}
