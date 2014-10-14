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

class EmptyServiceWithConstants
{
    const GREAT_KING_RAT = 'I would you like to know';
    const BOHEMIAN_RAPSODY = 'Is this real life?';

    private $dependency;

    public function __construct(Dependency $dependency)
    {
        $this->dependency = $dependency;
    }
}
