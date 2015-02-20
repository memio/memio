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
        $file = new File('/tmp/Filename.php');
        $twig->render('file.twig', array('file' => $file))->shouldBeCalled();

        $this->generateCode($file);
    }

    function it_handles_many_worded_model_class_names(Twig_Environment $twig)
    {
        $methodCollection = new MethodCollection();
        $twig->render('method_collection.twig', array('method_collection' => $methodCollection))->shouldBeCalled();

        $this->generateCode($methodCollection);
    }

    function it_passes_extra_parameters_to_template(Twig_Environment $twig)
    {
        $file = new File('/tmp/Filename.php');
        $twig->render('file.twig', array('extra' => 'parameter', 'file' => $file))->shouldBeCalled();

        $this->generateCode($file, array('extra' => 'parameter'));
    }
}
