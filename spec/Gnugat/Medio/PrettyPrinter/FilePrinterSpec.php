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
use Gnugat\Medio\Model\File;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\Type;
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

    function it_generates_class_with_a_method_which_has_no_arguments()
    {
        $file = new File(self::FILENAME);
        $file->addMethod(new Method('__construct'));

        $this->dump($file)->shouldBe(get_expected_code());
    }

    function it_generates_class_with_a_method_which_has_one_non_typehinted_argument()
    {
        $method = new Method('__construct');
        $method->addArgument(new Argument(new Type('string'), 'filename'));
        $file = new File(self::FILENAME);
        $file->addMethod($method);

        $this->dump($file)->shouldBe(get_expected_code());
    }

    function it_generates_class_with_a_method_which_has_one_typehinted_argument()
    {
        $method = new Method('__construct');
        $method->addArgument(new Argument(new Type('array'), 'parameters'));
        $file = new File(self::FILENAME);
        $file->addMethod($method);

        $this->dump($file)->shouldBe(get_expected_code());
    }
}
