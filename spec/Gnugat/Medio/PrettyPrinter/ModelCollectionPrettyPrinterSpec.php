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

    function it_supports_arrays()
    {
        $this->supports(array(), array())->shouldBe(true);
    }

    function it_generates_code_using_collection_templates(Twig_Environment $twig)
    {
        $argument = new Argument('string', 'filename');
        $arguments = array($argument);

        $twig->render('collection/argument_collection.twig', array('argument_collection' => $arguments))->shouldBeCalled();

        $this->generateCode($arguments);
    }

    function it_generates_code_empty_string_for_empty_arrays(Twig_Environment $twig)
    {
        $this->generateCode(array())->shouldBe('');
    }
}
