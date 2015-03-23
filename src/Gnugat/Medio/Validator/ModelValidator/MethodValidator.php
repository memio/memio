<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Validator\ModelValidator;

use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Validator\Constraint;
use Gnugat\Medio\Validator\ConstraintValidator;
use Gnugat\Medio\Validator\Constraint\MethodCannotBeAbstractAndHaveBody;
use Gnugat\Medio\Validator\Constraint\MethodCannotBeBothAbstractAndPrivate;
use Gnugat\Medio\Validator\Constraint\MethodCannotBeBothAbstractAndFinal;
use Gnugat\Medio\Validator\ModelValidator;

class MethodValidator implements ModelValidator
{
    /**
     * @var ConstraintValidator
     */
    private $constraintValidator;

    public function __construct()
    {
        $this->constraintValidator = new ConstraintValidator();
        $this->constraintValidator->add(new MethodCannotBeAbstractAndHaveBody());
        $this->constraintValidator->add(new MethodCannotBeBothAbstractAndFinal());
        $this->constraintValidator->add(new MethodCannotBeBothAbstractAndPrivate());
    }

    /**
     * {@inheritDoc}
     */
    public function add(Constraint $constraint)
    {
        $this->constraintValidator->add($constraint);
    }

    /**
     * {@inheritDoc}
     */
    public function supports($model)
    {
        return $model instanceof Method;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($model)
    {
        return $this->constraintValidator->validate($model);
    }
}
