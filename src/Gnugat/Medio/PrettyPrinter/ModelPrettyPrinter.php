<?php

namespace Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\ValueObject\FullyQualifiedName;
use Twig_Environment;

class ModelPrettyPrinter
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @param Twig_Environment $twig_Environment
     */
    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * {@inheritDoc}
     */
    public function supports($model)
    {
        if (!is_object($model)) {
            return false;
        }
        $fqcn = get_class($model);

        return 1 === preg_match('/^Gnugat\\\\Medio\\\\Model\\\\/', $fqcn);
    }

    /**
     * {@inheritDoc}
     */
    public function generateCode($model, array $parameters = array())
    {
        $fqcn = get_class($model);
        $name = FullyQualifiedName::make($fqcn)->getName();
        $modelName = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $name));
        $parameters[$modelName] = $model;

        return $this->twig->render($modelName.'.twig', $parameters);
    }
}
