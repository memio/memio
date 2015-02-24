<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio;

use Gnugat\Medio\ValueObject\FullyQualifiedName;
use Twig_Environment;

/**
 * Renders the template associated to the given model.
 *
 * The rules are the following:
 *
 * + the template is named after the model's class name, in snake_case
 * + the template only accepts only one parameter: the given model
 * + the parameter must be named after the model's class name, in snake_case
 *
 * @api
 */
class PrettyPrinter
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @param Twig_Environment $twig
     *
     * @api
     */
    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param mixed $model
     * @param array $parameters
     *
     * @return string
     *
     * @api
     */
    public function generateCode($model, array $parameters = array())
    {
        if (is_array($model)) {
            if (empty($model)) {
                return '';
            }
            $firstElement = current($model);
            $fqcn = get_class($firstElement);
            $suffix = '_collection';
            $directory = 'collection/';
        } else {
            $fqcn = get_class($model);
            $suffix = '';
            $directory = '';
        }
        $name = FullyQualifiedName::make($fqcn)->getName();
        $modelName = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $name)).$suffix;
        $parameters[$modelName] = $model;

        return $this->twig->render($directory.$modelName.'.twig', $parameters);
    }
}
