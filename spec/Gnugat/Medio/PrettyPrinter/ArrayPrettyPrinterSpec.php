<?php

namespace spec\Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\Argument;
use PhpSpec\ObjectBehavior;
use Twig_Environment;

class ArrayPrettyPrinterSpec extends ObjectBehavior
{
    function let(Twig_Environment $twig)
    {
        $this->beConstructedWith($twig);
    }

    function it_supports_arrays()
    {
        $this->supports(array())->shouldBe(true);
    }

    function it_generates_code_using_collection_templates(Twig_Environment $twig)
    {
        $argument = new Argument('string', 'filename');
        $arguments = array($argument);

        $twig->render('collection/argument_collection.twig', array('argument_collection' => $arguments))->shouldBeCalled();

        $this->generateCode($arguments);
    }
}
