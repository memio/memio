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
use Gnugat\Medio\Validator\ViolationCollection;

class MethodValidator implements ModelValidator
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
     * @param CollectionValidator $collectionValidator
     */
    public function __construct(CollectionValidator $collectionValidator)
    {
        $this->collectionValidator = $collectionValidator;

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
        if (!$this->supports($model)) {
            return new ViolationCollection();
        }
        $violationCollection = $this->constraintValidator->validate($model);
        $violationCollection->merge($this->collectionValidator->validate($model->allArguments()));

        return $violationCollection;
    }
}
