<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\Argument;
use PhpSpec\ObjectBehavior;
use Twig_Environment;

class ModelCollectionPrettyPrinterSpec extends ObjectBehavior
{
    function let(Twig_Environment $twig)
    {
        $this->beConstructedWith($twig);
    }

    function it_is_a_pretty_printer_strategy()
    {
        $this->shouldImplement('Gnugat\\Medio\\PrettyPrinter\\PrettyPrinterStrategy');
    }

    function it_supports_array_of_models()
    {
        $argument = new Argument('string', 'filename');
        $arguments = array($argument);

        $this->supports($arguments, array())->shouldBe(true);
    }

    function it_generates_code_using_collection_templates(Twig_Environment $twig)
    {
        $argument = new Argument('string', 'filename');
        $arguments = array($argument);

        $twig->render('collection/argument_collection.twig', array('argument_collection' => $arguments))->shouldBeCalled();

        $this->generateCode($arguments);
    }
}
