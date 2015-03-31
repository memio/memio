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

use Memio\Memio\Exception\InvalidArgumentException;
use Memio\Memio\PrettyPrinter\EmptyCollectionPrettyPrinter;
use Memio\Memio\PrettyPrinter\ModelCollectionPrettyPrinter;
use Memio\Memio\PrettyPrinter\ModelPrettyPrinter;
use Memio\Memio\PrettyPrinter\PhpdocCollectionPrettyPrinter;
use Memio\Memio\PrettyPrinter\PhpdocPrettyPrinter;
use Memio\Memio\TwigExtension\Line\ContractLineStrategy;
use Memio\Memio\TwigExtension\Line\FileLineStrategy;
use Memio\Memio\TwigExtension\Line\Line;
use Memio\Memio\TwigExtension\Line\MethodPhpdocLineStrategy;
use Memio\Memio\TwigExtension\Line\ObjectLineStrategy;
use Memio\Memio\TwigExtension\Line\StructurePhpdocLineStrategy;
use Memio\Memio\TwigExtension\Type;
use Memio\Memio\TwigExtension\Whitespace;
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
