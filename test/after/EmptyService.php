<?php

namespace fixture\Gnugat\Medio;

use fixture\Gnugat\Medio\SubDir\Dependency;

class EmptyService
{
    private $dependency;

    public function __construct(
        Dependency $dependency
    )
    {
        $this->dependency = $dependency;
    }
}
