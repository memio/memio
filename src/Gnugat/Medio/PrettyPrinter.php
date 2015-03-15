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
use Gnugat\Medio\PrettyPrinter\EmptyCollectionPrettyPrinter;
use Gnugat\Medio\PrettyPrinter\ModelCollectionPrettyPrinter;
use Gnugat\Medio\PrettyPrinter\ModelPrettyPrinter;
use Gnugat\Medio\PrettyPrinter\PhpdocCollectionPrettyPrinter;
use Gnugat\Medio\PrettyPrinter\PhpdocPrettyPrinter;
use Gnugat\Medio\TwigExtension\Line\ContractLineStrategy;
use Gnugat\Medio\TwigExtension\Line\FileLineStrategy;
use Gnugat\Medio\TwigExtension\Line\Line;
use Gnugat\Medio\TwigExtension\Line\MethodPhpdocLineStrategy;
use Gnugat\Medio\TwigExtension\Line\ObjectLineStrategy;
use Gnugat\Medio\TwigExtension\Line\StructurePhpdocLineStrategy;
use Gnugat\Medio\TwigExtension\Type;
use Gnugat\Medio\TwigExtension\Whitespace;
use Twig_Environment;

/**
 * @api
 */
class PrettyPrinter
{
    /**
     * @var array
     */
    private $strategies = array();

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
        $line->add(new MethodPhpdocLineStrategy());
        $line->add(new ObjectLineStrategy());
        $line->add(new StructurePhpdocLineStrategy());

        $twig->addExtension(new Type());
        $twig->addExtension(new Whitespace($line));

        $this->strategies[] = new EmptyCollectionPrettyPrinter();
        $this->strategies[] = new PhpdocCollectionPrettyPrinter($twig);
        $this->strategies[] = new ModelCollectionPrettyPrinter($twig);
        $this->strategies[] = new PhpdocPrettyPrinter($twig);
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
