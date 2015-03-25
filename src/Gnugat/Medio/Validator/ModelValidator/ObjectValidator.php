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

use Gnugat\Medio\Model\Object;
use Gnugat\Medio\Validator\Constraint;
use Gnugat\Medio\Validator\ConstraintValidator;
use Gnugat\Medio\Validator\Constraint\ContractMethodsCanOnlyBePublic;
use Gnugat\Medio\Validator\Constraint\ContractMethodsCannotBeFinal;
use Gnugat\Medio\Validator\Constraint\ContractMethodsCannotBeStatic;
use Gnugat\Medio\Validator\Constraint\ContractMethodsCannotHaveBody;
use Gnugat\Medio\Validator\ModelValidator;
use Gnugat\Medio\Validator\ViolationCollection;

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
    )
    {
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
