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

use Memio\Memio\Model\Argument;
use Memio\Memio\Model\Constant;
use Memio\Memio\Model\Method;
use Memio\Memio\Model\Property;
use Memio\Memio\Validator\Constraint;
use Memio\Memio\Validator\ConstraintValidator;
use Memio\Memio\Validator\Constraint\CollectionCannotHaveNameDuplicates;
use Memio\Memio\Validator\ModelValidator;
use Memio\Memio\Validator\ViolationCollection;

class CollectionValidator implements ModelValidator
{
    /**
     * @var ConstraintValidator
     */
    private $constraintValidator;

    public function __construct()
    {
        $this->constraintValidator = new ConstraintValidator();
        $this->constraintValidator->add(new CollectionCannotHaveNameDuplicates());
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
        if (!is_array($model) || empty($model)) {
            return false;
        }
        $firstElement = current($model);

        return (
            $firstElement instanceof Argument || $firstElement instanceof Constant
            || $firstElement instanceof Method || $firstElement instanceof Property
        );
    }

    /**
     * {@inheritDoc}
     */
    public function validate($model)
    {
        if (!$this->supports($model)) {
            return new ViolationCollection();
        }

        return $this->constraintValidator->validate($model);
    }
}
