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

use Gnugat\Medio\Exception\InvalidModelException;
use Gnugat\Medio\Model\Contract;
use Gnugat\Medio\Validator\Constraint;
use Gnugat\Medio\Validator\ConstraintValidator;
use Gnugat\Medio\Validator\ModelValidator;

class ContractValidator implements ModelValidator
{
    /**
     * @var ConstraintValidator
     */
    private $constraintValidator;

    /**
     * @var MethodValidator
     */
    private $methodValidator;

    /**
     * @param MethodValidator $methodValidator
     */
    public function __construct(MethodValidator $methodValidator)
    {
        $this->constraintValidator = new ConstraintValidator();
        $this->methodValidator = $methodValidator;
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
        return $model instanceof Contract;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($model)
    {
        $violationCollection = $this->constraintValidator->validate($model);
        foreach ($model->allMethods() as $method) {
            $violationCollection->merge($this->methodValidator->validate($method));
        }

        return $violationCollection;
    }
}
