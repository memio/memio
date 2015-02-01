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
use Gnugat\Medio\Model\ArgumentCollection;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\Type;
use Gnugat\Medio\PrettyPrinter\InlineArgumentCollectionPrinter;
use Gnugat\Medio\PrettyPrinter\MethodPhpdocPrinter;
use Gnugat\Medio\PrettyPrinter\MultilineArgumentCollectionPrinter;
use Gnugat\Medio\PrettyPrinter\ArgumentPrinter;
use PhpSpec\ObjectBehavior;

class MethodPrinterSpec extends ObjectBehavior
{
    function let()
    {
        $argumentPrinter = new ArgumentPrinter();

        $this->beConstructedWith(
            new InlineArgumentCollectionPrinter($argumentPrinter),
            new MethodPhpdocPrinter(),
            new MultilineArgumentCollectionPrinter($argumentPrinter)
        );
    }

    function it_generates_method_without_any_arguments()
    {
        $method = new Method('__construct');

        $this->dump($method)->shouldBe(<<<'EOT'
    public function __construct()
    {
    }
EOT
        );
    }

    function it_generates_method_with_arguments()
    {
        $method = new Method('__construct');
        $method->addArgument(new Argument(new Type('string'), 'argument'));

        $this->dump($method)->shouldBe(<<<'EOT'
    /**
     * @param string $argument
     */
    public function __construct($argument)
    {
    }
EOT
        );
    }

    function it_generates_method_longer_than_120_characters_on_many_lines()
    {
        $method = new Method('thisIsAlmostAsLongAsJavaMethodsButNotQuiteSo');
        $method->addArgument(new Argument(new Type('ArrayObject'), 'thisIsAlmostAsLongAsJavaArgumentButNotQuiteSo', true));

        $this->dump($method)->shouldBe(<<<'EOT'
    /**
     * @param \ArrayObject $thisIsAlmostAsLongAsJavaArgumentButNotQuiteSo
     */
    public function thisIsAlmostAsLongAsJavaMethodsButNotQuiteSo(
        \ArrayObject $thisIsAlmostAsLongAsJavaArgumentButNotQuiteSo
    )
    {
    }
EOT
        );
    }
}
