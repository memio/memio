<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Validator;

use Gnugat\Medio\Validator\Violation\SomeViolation;

class ViolationCollection
{
    /**
     * @var array
     */
    private $violations = array();

    /**
     * @param Violation $violation
     */
    public function add(Violation $violation)
    {
        if ($violation instanceof SomeViolation) {
            $this->violations[] = $violation->getMessage();
        }
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->violations;
    }

    /**
     * @param ViolationCollection $violationCollection
     */
    public function merge(ViolationCollection $violationCollection)
    {
        $this->violations = array_merge($this->violations, $violationCollection->all());
    }
}
