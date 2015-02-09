<?php

namespace Gnugat\Medio;

use Twig_Environment;

/**
 * Renders the template associated to the given model.
 *
 * The rules are the following:
 *
 * + the template is named after the model's class name, in snake_case
 * + the template only accepts only one parameter: the given model
 * + the parameter must be named after the model's class name, in snake_case
 */
class PrettyPrinter
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @param Twig_Environment $twig
     */
    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param mixed $model
     *
     * @return string
     */
    public function generateCode($model)
    {
        $fqcn = get_class($model);
        $className = end(explode('\\', $fqcn));
        $modelName = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $className));

        return $this->twig->render($modelName.'.twig', array($modelName => $model));
    }
}
