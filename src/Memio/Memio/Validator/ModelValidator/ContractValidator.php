<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Validator\ModelValidator;

use Memio\Model\Contract;
use Memio\Memio\Validator\Constraint;
use Memio\Memio\Validator\ConstraintValidator;
use Memio\Memio\Validator\Constraint\ContractMethodsCanOnlyBePublic;
use Memio\Memio\Validator\Constraint\ContractMethodsCannotBeFinal;
use Memio\Memio\Validator\Constraint\ContractMethodsCannotBeStatic;
use Memio\Memio\Validator\Constraint\ContractMethodsCannotHaveBody;
use Memio\Memio\Validator\ModelValidator;
use Memio\Memio\Validator\ViolationCollection;

class ContractValidator implements ModelValidator
{
    /**
     * @var CollectionValidator
     */
    private $collectionValidator;

    /**
     * @var ConstraintValidator
     */
    private $constraintValidator;

    /**
     * @var MethodValidator
     */
    private $methodValidator;

    /**
     * @param CollectionValidator $collectionValidator
     * @param MethodValidator     $methodValidator
     */
    public function __construct(
        CollectionValidator $collectionValidator,
        MethodValidator $methodValidator
    ) {
        $this->collectionValidator = $collectionValidator;
        $this->methodValidator = $methodValidator;

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
        if (!$this->supports($model)) {
            return new ViolationCollection();
        }
        $violationCollection = $this->constraintValidator->validate($model);
        $violationCollection->merge($this->collectionValidator->validate($model->allConstants()));
        $violationCollection->merge($this->collectionValidator->validate($model->allContracts()));
        $methods = $model->allMethods();
        $violationCollection->merge($this->collectionValidator->validate($methods));
        foreach ($methods as $method) {
            $violationCollection->merge($this->methodValidator->validate($method));
        }

        return $violationCollection;
    }
}
