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

use Gnugat\Medio\Exception\InvalidArgumentException;
use Gnugat\Medio\PrettyPrinter\ArrayPrettyPrinter;
use Gnugat\Medio\PrettyPrinter\ModelPrettyPrinter;
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
     * @var array
     */
    private $strategies = array();

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
        $this->strategies[] = new ArrayPrettyPrinter($twig);
        $this->strategies[] = new ModelPrettyPrinter($twig);
    }

    /**
     * @param mixed $model
     * @param array $parameters
     *
     * @return string
     *
     * @throws InvalidArgumentException If the given model and parameters aren't supported
     *
     * @api
     */
    public function generateCode($model, array $parameters = array())
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($model, $parameters)) {
                return $strategy->generateCode($model, $parameters);
            }
        }

        throw new InvalidArgumentException('No PrettyPrinter support the given model and parameters');
    }
}
