<?php

namespace Memio\Memio\Config;

use Memio\Validator\Constraint\ArgumentCannotBeScalar;
use Memio\Validator\Constraint\CollectionCannotHaveNameDuplicates;
use Memio\Validator\Constraint\ConcreteObjectMethodsCannotBeAbstract;
use Memio\Validator\Constraint\ContractMethodsCanOnlyBePublic;
use Memio\Validator\Constraint\ContractMethodsCannotBeFinal;
use Memio\Validator\Constraint\ContractMethodsCannotBeStatic;
use Memio\Validator\Constraint\ContractMethodsCannotHaveBody;
use Memio\Validator\Constraint\MethodCannotBeAbstractAndHaveBody;
use Memio\Validator\Constraint\MethodCannotBeBothAbstractAndFinal;
use Memio\Validator\Constraint\MethodCannotBeBothAbstractAndPrivate;
use Memio\Validator\Constraint\MethodCannotBeBothAbstractAndStatic;
use Memio\Validator\Constraint\ObjectArgumentCanOnlyDefaultToNull;
use Memio\Validator\ModelValidator\ArgumentValidator;
use Memio\Validator\ModelValidator\CollectionValidator;
use Memio\Validator\ModelValidator\MethodValidator;
use Memio\Validator\ModelValidator\ContractValidator;
use Memio\Validator\ModelValidator\ObjectValidator;
use Memio\Validator\ModelValidator\FileValidator;
use Memio\Validator\Validator;

class Build
{
    /**
     * @return Validator
     */
    public static function linter()
    {
        $argumentValidator = new ArgumentValidator();
        $argumentValidator->add(new ArgumentCannotBeScalar());

        $collectionValidator = new CollectionValidator();
        $collectionValidator->add(new CollectionCannotHaveNameDuplicates());

        $methodValidator = new MethodValidator($argumentValidator, $collectionValidator);
        $methodValidator->add(new MethodCannotBeAbstractAndHaveBody());
        $methodValidator->add(new MethodCannotBeBothAbstractAndFinal());
        $methodValidator->add(new MethodCannotBeBothAbstractAndPrivate());
        $methodValidator->add(new MethodCannotBeBothAbstractAndStatic());

        $contractValidator = new ContractValidator($collectionValidator, $methodValidator);
        $contractValidator->add(new ContractMethodsCanOnlyBePublic());
        $contractValidator->add(new ContractMethodsCannotBeFinal());
        $contractValidator->add(new ContractMethodsCannotBeStatic());
        $contractValidator->add(new ContractMethodsCannotHaveBody());

        $objectValidator = new ObjectValidator($collectionValidator, $methodValidator);
        $objectValidator->add(new ConcreteObjectMethodsCannotBeAbstract());
        $objectValidator->add(new ObjectArgumentCanOnlyDefaultToNull());

        $fileValidator = new FileValidator($contractValidator, $objectValidator);

        $linter = new Validator();
        $linter->add($argumentValidator);
        $linter->add($collectionValidator);
        $linter->add($methodValidator);
        $linter->add($contractValidator);
        $linter->add($objectValidator);
        $linter->add($fileValidator);

        return $linter;
    }
}
