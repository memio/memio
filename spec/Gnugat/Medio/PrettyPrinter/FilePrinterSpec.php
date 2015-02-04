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

use Gnugat\Medio\Model\File;
use PhpSpec\ObjectBehavior;
use Twig_Environment;
use Twig_Loader_Filesystem;

class FilePrinterSpec extends ObjectBehavior
{
    const FILENAME = '/tmp/medio/src/Gnugat/Medio/MyClass.php';

    function let()
    {
        $templatePath = str_replace('spec', 'src', __DIR__.'/templates');
        $twig = new Twig_Environment(new Twig_Loader_Filesystem($templatePath));

        $this->beConstructedWith($twig);
    }

    function it_generates_empty_class()
    {
        $this->dump(new File(self::FILENAME))->shouldBe(get_expected_code());
    }
}
