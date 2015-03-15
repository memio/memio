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
use Gnugat\Medio\Model\FullyQualifiedName;
use Gnugat\Medio\Model\Method;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument as ProphecyArgument;
use Twig_Environment;

class PrettyPrinterSpec extends ObjectBehavior
{
    function let(Twig_Environment $twig)
    {
        $twig->addExtension(ProphecyArgument::any())->shouldBeCalled();

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
        $fullyQualifiedName = new FullyQualifiedName('Gnugat\Medio\MyClass');
        $twig->render('fully_qualified_name.twig', array('fully_qualified_name' => $fullyQualifiedName))->shouldBeCalled();

        $this->generateCode($fullyQualifiedName);
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
