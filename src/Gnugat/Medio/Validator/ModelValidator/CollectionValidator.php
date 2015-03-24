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

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Constant;
use Gnugat\Medio\Model\FullyQualifiedName;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\Property;
use Gnugat\Medio\Validator\Constraint;
use Gnugat\Medio\Validator\ConstraintValidator;
use Gnugat\Medio\Validator\Constraint\CollectionCannotHaveNameDuplicates;
use Gnugat\Medio\Validator\ModelValidator;

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
        return $this->constraintValidator->validate($model);
    }
}
