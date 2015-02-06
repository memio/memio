<?php

namespace spec\Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\File;
use Gnugat\Medio\Model\MethodCollection;
use PhpSpec\ObjectBehavior;
use Twig_Environment;

class TwigPrinterSpec extends ObjectBehavior
{
    function let(Twig_Environment $twig)
    {
        $this->beConstructedWith($twig);
    }

    function it_dumps_file(Twig_Environment $twig)
    {
        $file = new File('/tmp/filename.php');
        $twig->render('file.twig', array('file' => $file))->shouldBeCalled();

        $this->dump($file);
    }

    function it_dumps_method_collection(Twig_Environment $twig)
    {
        $methodCollection = new MethodCollection();
        $twig->render('method_collection.twig', array('method_collection' => $methodCollection))->shouldBeCalled();

        $this->dump($methodCollection);
    }
}
