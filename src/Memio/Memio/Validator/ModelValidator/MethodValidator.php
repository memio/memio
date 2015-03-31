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

use Memio\Memio\Model\Method;
use Memio\Memio\Validator\Constraint;
use Memio\Memio\Validator\ConstraintValidator;
use Memio\Memio\Validator\Constraint\MethodCannotBeAbstractAndHaveBody;
use Memio\Memio\Validator\Constraint\MethodCannotBeBothAbstractAndFinal;
use Memio\Memio\Validator\Constraint\MethodCannotBeBothAbstractAndPrivate;
use Memio\Memio\Validator\Constraint\MethodCannotBeBothAbstractAndStatic;
use Memio\Memio\Validator\ModelValidator;
use Memio\Memio\Validator\ViolationCollection;

class MethodValidator implements ModelValidator
{
    /**
     * @var ArgumentValidator
     */
    private $argumentValidator;

    /**
     * @var CollectionValidator
     */
    private $collectionValidator;

    /**
     * @var ConstraintValidator
     */
    private $constraintValidator;

    /**
     * @param ArgumentValidator   $argumentValidator
     * @param CollectionValidator $collectionValidator
     */
    public function __construct(ArgumentValidator $argumentValidator, CollectionValidator $collectionValidator)
    {
        $this->argumentValidator = $argumentValidator;
        $this->collectionValidator = $collectionValidator;

        $this->constraintValidator = new ConstraintValidator();
        $this->constraintValidator->add(new MethodCannotBeAbstractAndHaveBody());
        $this->constraintValidator->add(new MethodCannotBeBothAbstractAndFinal());
        $this->constraintValidator->add(new MethodCannotBeBothAbstractAndPrivate());
        $this->constraintValidator->add(new MethodCannotBeBothAbstractAndStatic());
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
        if (!$this->supports($model)) {
            return new ViolationCollection();
        }
        $violationCollection = $this->constraintValidator->validate($model);
        $arguments = $model->allArguments();
        $violationCollection->merge($this->collectionValidator->validate($arguments));
        foreach ($arguments as $argument) {
            $violationCollection->merge($this->argumentValidator->validate($argument));
        }

        return $violationCollection;
    }
}
