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
use Gnugat\Medio\TwigExtension\Line\ContractLineStrategy;
use Gnugat\Medio\TwigExtension\Line\FileLineStrategy;
use Gnugat\Medio\TwigExtension\Line\Line;
use Gnugat\Medio\TwigExtension\Line\ObjectLineStrategy;
use Gnugat\Medio\TwigExtension\Phpdoc;
use Gnugat\Medio\TwigExtension\Type;
use Gnugat\Medio\TwigExtension\Whitespace;
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
        $line = new Line();
        $line->add(new ContractLineStrategy());
        $line->add(new FileLineStrategy());
        $line->add(new ObjectLineStrategy());

        $twig->addExtension(new Phpdoc());
        $twig->addExtension(new Type());
        $twig->addExtension(new Whitespace($line));

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
