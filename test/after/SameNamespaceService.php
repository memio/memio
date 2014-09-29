<?php

namespace fixture\Gnugat\Medio;

class SameNamespaceService
{
    private $dependency;

    public function __construct(
        Dependency $dependency
    )
    {
        $this->dependency = $dependency;
    }
}
