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

use Gnugat\Medio\Model\Contract;
use Gnugat\Medio\Model\File;
use Gnugat\Medio\Model\Object;
use Gnugat\Medio\Validator\Constraint;
use Gnugat\Medio\Validator\ConstraintValidator;
use Gnugat\Medio\Validator\ModelValidator;
use Gnugat\Medio\Validator\ViolationCollection;

class FileValidator implements ModelValidator
{
    /**
     * @var CollectionValidator
     */
    private $collectionValidator;

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
