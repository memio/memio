<?php

namespace Memio\Memio\Config;

use Memio\PrettyPrinter\PrettyPrinter;
use Memio\Validator\Validator;

class Build
{
    /**
     * @return Validator
     */
    public static function linter()
    {
        $argumentValidator = new \Memio\Validator\ModelValidator\ArgumentValidator();
        $argumentValidator->add(new \Memio\Linter\ArgumentCannotBeScalar());

        $collectionValidator = new \Memio\Validator\ModelValidator\CollectionValidator();
        $collectionValidator->add(new \Memio\Linter\CollectionCannotHaveNameDuplicates());

        $methodValidator = new \Memio\Validator\ModelValidator\MethodValidator($argumentValidator, $collectionValidator);
        $methodValidator->add(new \Memio\Linter\MethodCannotBeAbstractAndHaveBody());
        $methodValidator->add(new \Memio\Linter\MethodCannotBeBothAbstractAndFinal());
        $methodValidator->add(new \Memio\Linter\MethodCannotBeBothAbstractAndPrivate());
        $methodValidator->add(new \Memio\Linter\MethodCannotBeBothAbstractAndStatic());

        $contractValidator = new \Memio\Validator\ModelValidator\ContractValidator($collectionValidator, $methodValidator);
        $contractValidator->add(new \Memio\Linter\ContractMethodsCanOnlyBePublic());
        $contractValidator->add(new \Memio\Linter\ContractMethodsCannotBeFinal());
        $contractValidator->add(new \Memio\Linter\ContractMethodsCannotBeStatic());
        $contractValidator->add(new \Memio\Linter\ContractMethodsCannotHaveBody());

        $objectValidator = new \Memio\Validator\ModelValidator\ObjectValidator($collectionValidator, $methodValidator);
        $objectValidator->add(new \Memio\Linter\ConcreteObjectMethodsCannotBeAbstract());
        $objectValidator->add(new \Memio\Linter\ObjectArgumentCanOnlyDefaultToNull());

        $fileValidator = new \Memio\Validator\ModelValidator\FileValidator($contractValidator, $objectValidator);

        $linter = new Validator();
        $linter->add($argumentValidator);
        $linter->add($collectionValidator);
        $linter->add($methodValidator);
        $linter->add($contractValidator);
        $linter->add($objectValidator);
        $linter->add($fileValidator);

        return $linter;
    }

    /**
     * @return PrettyPrinter
     */
    public static function prettyPrinter()
    {
        $loader = new \Twig_Loader_Filesystem(\Memio\PrettyPrinter\Config\Locate::templates());
        $twig = new \Twig_Environment($loader);

        $line = new \Memio\PrettyPrinter\TwigExtension\Line\Line();
        $line->add(new \Memio\PrettyPrinter\TwigExtension\Line\ContractLineStrategy());
        $line->add(new \Memio\PrettyPrinter\TwigExtension\Line\FileLineStrategy());
        $line->add(new \Memio\PrettyPrinter\TwigExtension\Line\MethodPhpdocLineStrategy());
        $line->add(new \Memio\PrettyPrinter\TwigExtension\Line\ObjectLineStrategy());
        $line->add(new \Memio\PrettyPrinter\TwigExtension\Line\StructurePhpdocLineStrategy());

        $twig->addExtension(new \Memio\PrettyPrinter\TwigExtension\Type());
        $twig->addExtension(new \Memio\PrettyPrinter\TwigExtension\Whitespace($line));

        $templateEngine = new \Memio\PrettyPrinter\TwigTemplateEngine($twig);
        $prettyPrinter = new PrettyPrinter($templateEngine);

        return $prettyPrinter;
    }
}
