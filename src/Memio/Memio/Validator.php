<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio;

use Memio\Memio\Validator\ModelValidator;
use Memio\Memio\Validator\ModelValidator\ArgumentValidator;
use Memio\Memio\Validator\ModelValidator\CollectionValidator;
use Memio\Memio\Validator\ModelValidator\ContractValidator;
use Memio\Memio\Validator\ModelValidator\FileValidator;
use Memio\Memio\Validator\ModelValidator\MethodValidator;
use Memio\Memio\Validator\ModelValidator\ObjectValidator;
use Memio\Memio\Validator\ViolationCollection;

class Validator
{
    /**
     * @var array
     */
    private $modelValidators = array();

    public function __construct()
    {
        $argumentValidator = new ArgumentValidator();
        $collectionValidator = new CollectionValidator();
        $methodValidator = new MethodValidator($argumentValidator, $collectionValidator);
        $contractValidator = new ContractValidator($collectionValidator, $methodValidator);
        $objectValidator = new ObjectValidator($collectionValidator, $methodValidator);
        $fileValidator = new FileValidator($contractValidator, $objectValidator);

        $this->modelValidators[] = $argumentValidator;
        $this->modelValidators[] = $collectionValidator;
        $this->modelValidators[] = $contractValidator;
        $this->modelValidators[] = $fileValidator;
        $this->modelValidators[] = $methodValidator;
        $this->modelValidators[] = $objectValidator;
    }

    /**
     * @param ModelValidator $modelValidator
     */
    public function add(ModelValidator $modelValidator)
    {
        $this->modelValidators[] = $modelValidator;
    }

    /**
     * @param mixed $model
     *
     * @throws \Memio\Memio\Exception\InvalidModelException If model is invalid
     */
    public function validate($model)
    {
        $violations = new ViolationCollection();
        foreach ($this->modelValidators as $modelValidator) {
            if ($modelValidator->supports($model)) {
                $violations->merge($modelValidator->validate($model));
            }
        }
        $violations->raise();
    }
}
