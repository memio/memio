<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\MethodPhpdoc;
use PhpSpec\ObjectBehavior;
use Twig_Environment;

class PrettyPrinterSpec extends ObjectBehavior
{
    function let(Twig_Environment $twig)
    {
        $this->beConstructedWith($twig);
    }

    function it_handles_one_worded_model_class_names(Twig_Environment $twig)
    {
        $argument = new Argument('string', 'filename');
        $twig->render('argument.twig', array('argument' => $argument))->shouldBeCalled();

        $this->generateCode($argument);
    }

    function it_handles_many_worded_model_class_names(Twig_Environment $twig)
    {
        $methodPhpdoc = new MethodPhpdoc(new Method('__construct'));
        $twig->render('method_phpdoc.twig', array('method_phpdoc' => $methodPhpdoc))->shouldBeCalled();

        $this->generateCode($methodPhpdoc);
    }

    function it_passes_extra_parameters_to_template(Twig_Environment $twig)
    {
        $argument = new Argument('int', 'total');
        $twig->render('argument.twig', array('extra' => 'parameter', 'argument' => $argument))->shouldBeCalled();

        $this->generateCode($argument, array('extra' => 'parameter'));
    }

    function it_handles_collections(Twig_Environment $twig)
    {
        $collection = array(new Argument('bool', 'isObject'));
        $twig->render('collection/argument_collection.twig', array('argument_collection' => $collection))->shouldBeCalled();

        $this->generateCode($collection);
    }

    function it_handles_empty_collections()
    {
        $this->generateCode(array())->shouldBe('');
    }

    function it_throws_exception_when_no_strategy_support_the_given_arguments()
    {
        $invalidArgumentException = 'Gnugat\\Medio\\Exception\\InvalidArgumentException';

        $this->shouldThrow($invalidArgumentException)->duringGenerateCode('nope');
    }
}
