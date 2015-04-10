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
use Memio\Model\File;
use Memio\Model\Object;
use Memio\Memio\Validator\Constraint;
use Memio\Memio\Validator\ConstraintValidator;
use Memio\Memio\Validator\ModelValidator;
use Memio\Memio\Validator\ViolationCollection;

class FileValidator implements ModelValidator
{
    /**
     * @var ContractValidator
     */
    private $contractValidator;

    /**
     * @var ObjectValidator
     */
    private $objectValidator;

    /**
     * @param ContractValidator $contractValidator
     * @param ObjectValidator   $objectValidator
     */
    public function __construct(
        ContractValidator $contractValidator,
        ObjectValidator $objectValidator
    ) {
        $this->contractValidator = $contractValidator;
        $this->objectValidator = $objectValidator;

        $this->constraintValidator = new ConstraintValidator();
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
        return $model instanceof File;
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
        $structure = $model->getStructure();
        if ($structure instanceof Contract) {
            $violationCollection->merge($this->contractValidator->validate($structure));
        }
        if ($structure instanceof Object) {
            $violationCollection->merge($this->objectValidator->validate($structure));
        }

        return $violationCollection;
    }
}
