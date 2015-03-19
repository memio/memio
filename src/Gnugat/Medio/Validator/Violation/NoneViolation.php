<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Validator\Violation;

use Gnugat\Medio\Validator\Violation;

class NoneViolation implements Violation
{
    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        return '';
    }
}
