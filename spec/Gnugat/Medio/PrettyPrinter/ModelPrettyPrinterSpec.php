<?php

namespace spec\Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\Argument;
use PhpSpec\ObjectBehavior;
use Twig_Environment;

class ModelPrettyPrinterSpec extends ObjectBehavior
{
    function let(Twig_Environment $twig)
    {
        $this->beConstructedWith($twig);
    }

    function it_supports_models()
    {
        $argument = new Argument('bool', 'isObject');

        $this->supports($argument)->shouldBe(true);
    }

    function it_generates_code_using_root_templates(Twig_Environment $twig)
    {
        $argument = new Argument('string', 'filename');

        $twig->render('argument.twig', array('argument' => $argument))->shouldBeCalled();

        $this->generateCode($argument);
    }
}
