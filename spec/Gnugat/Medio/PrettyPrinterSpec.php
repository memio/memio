<?php

namespace spec\Gnugat\Medio;

use Gnugat\Medio\Model\File;
use Gnugat\Medio\Model\MethodCollection;
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
        $file = new File('/tmp/filename.php');
        $twig->render('file.twig', array('file' => $file))->shouldBeCalled();

        $this->generateCode($file);
    }

    function it_handles_many_worded_model_class_names(Twig_Environment $twig)
    {
        $methodCollection = new MethodCollection();
        $twig->render('method_collection.twig', array('method_collection' => $methodCollection))->shouldBeCalled();

        $this->generateCode($methodCollection);
    }
}
