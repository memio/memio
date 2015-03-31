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

use Memio\Memio\Model\Object;
use Memio\Memio\Validator\Constraint;
use Memio\Memio\Validator\Constraint\ConcreteObjectMethodsCannotBeAbstract;
use Memio\Memio\Validator\ConstraintValidator;
use Memio\Memio\Validator\ModelValidator;
use Memio\Memio\Validator\ViolationCollection;

class ObjectValidator implements ModelValidator
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
        $this->constraintValidator->add(new ConcreteObjectMethodsCannotBeAbstract());
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
        return $model instanceof Object;
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
        $violationCollection->merge($this->collectionValidator->validate($model->allProperties()));
        $methods = $model->allMethods();
        $violationCollection->merge($this->collectionValidator->validate($methods));
        foreach ($methods as $method) {
            $violationCollection->merge($this->methodValidator->validate($method));
        }

        return $violationCollection;
    }
}
