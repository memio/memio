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

use Gnugat\Medio\Validator\Violation\NoViolation;
use Gnugat\Medio\Validator\Violation\OneViolation;
use Gnugat\Medio\Validator\Violation\ManyViolations;

class ConstraintValidator
{
    /**
     * @var array
     */
    private $constraints = array();

    /**
     * @param Constraint $constraint
     */
    public function add(Constraint $constraint)
    {
        $this->constraints[] = $constraint;
    }

    /**
     * @param mixed $model
     *
     * @return Violation
     */
    public function validate($model)
    {
        $violations = new ManyViolations();
        foreach ($this->constraints as $constraint) {
            $violations->add($constraint->validate($model));
        }

        return $violations->get();
    }
}
