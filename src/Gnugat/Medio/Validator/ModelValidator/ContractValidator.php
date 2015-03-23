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
use Gnugat\Medio\Validator\Constraint\ContractMethodsCanOnlyBePublic;
use Gnugat\Medio\Validator\Constraint\ContractMethodsCannotBeFinal;
use Gnugat\Medio\Validator\Constraint\ContractMethodsCannotBeStatic;
use Gnugat\Medio\Validator\Constraint\ContractMethodsCannotHaveBody;
use Gnugat\Medio\Validator\ModelValidator;

class ContractValidator implements ModelValidator
{
    /**
     * @var ConstraintValidator
     */
    private $constraintValidator;

    public function __construct()
    {
        $this->constraintValidator = new ConstraintValidator();
        $this->constraintValidator->add(new ContractMethodsCanOnlyBePublic());
        $this->constraintValidator->add(new ContractMethodsCannotBeFinal());
        $this->constraintValidator->add(new ContractMethodsCannotBeStatic());
        $this->constraintValidator->add(new ContractMethodsCannotHaveBody());
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
        return $this->constraintValidator->validate($model);
    }
}
