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
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\MethodPhpdoc;
use Gnugat\Medio\Model\Object;
use Gnugat\Medio\ValueObject\Collection;
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
        $file = new File('/tmp/Filename.php', new Object('Gnugat\\Medio\\MyClass'));
        $twig->render('file.twig', array('file' => $file))->shouldBeCalled();

        $this->generateCode($file);
    }

    function it_handles_many_worded_model_class_names(Twig_Environment $twig)
    {
        $methodPhpdoc = new MethodPhpdoc(new Method('__construct'));
        $twig->render('method_phpdoc.twig', array('method_phpdoc' => $methodPhpdoc))->shouldBeCalled();

        $this->generateCode($methodPhpdoc);
    }

    function it_passes_extra_parameters_to_template(Twig_Environment $twig)
    {
        $file = new File('/tmp/Filename.php', new Object('Gnugat\\Medio\\MyClass'));
        $twig->render('file.twig', array('extra' => 'parameter', 'file' => $file))->shouldBeCalled();

        $this->generateCode($file, array('extra' => 'parameter'));
    }

    function it_handles_collections(Twig_Environment $twig)
    {
        $collection = new Collection('Gnugat\\Medio\\Model\\Method');
        $twig->render('collection/method_collection.twig', array('method_collection' => $collection->all()))->shouldBeCalled();

        $this->generateCode($collection);
    }
}
