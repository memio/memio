<?php

namespace fixture\Gnugat\Medio;

use fixture\Gnugat\Medio\SubDir\Dependency;

class EmptyServiceSpec
{
    function let(
        Dependency $dependency
    )
    {
        $this->beConstructedWith(
            $dependency
        );
    }
}
