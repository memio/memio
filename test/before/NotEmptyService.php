<?php

namespace fixture\Gnugat\Medio;

use fixture\Gnugat\Medio\SubDir\OtherDependency;

class EmptyService
{
    private $otherDependency;

    public function __construct(OtherDependency $otherDependency)
    {
        $this->otherDependency = $otherDependency;
    }
}
