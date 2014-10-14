<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace fixture\Gnugat\Medio;

use fixture\Gnugat\Medio\SubDir\Dependency;
use fixture\Gnugat\Medio\SubDir\OtherDependency;

class NotEmptyServiceWithConstants
{
    const GREAT_KING_RAT = 'I would you like to know';
    const BOHEMIAN_RAPSODY = 'Is this real life?';

    private $otherDependency;

    private $dependency;

    public function __construct(OtherDependency $otherDependency, Dependency $dependency)
    {
        $this->otherDependency = $otherDependency;
        $this->dependency = $dependency;
    }
}
