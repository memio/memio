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
use PhpSpec\ObjectBehavior;

class MethodPhpdocPrinterSpec extends ObjectBehavior
{
    function it_generates_nothing_if_no_arguments()
    {
        $argumentCollection = new ArgumentCollection();
        $method = new Method($argumentCollection, '__construct', 'public');

        $this->dump($method)->shouldBe('');
    }

    function it_generates_phpdoc_for_one_scalar_argument()
    {
        $argumentCollection = new ArgumentCollection();
        $argumentCollection->add(new Argument('string', 'argument'));
        $method = new Method($argumentCollection, '__construct', 'public');

        $this->dump($method)->shouldBe(<<<'EOT'
    /**
     * @param string $argument
     */
EOT
        );
    }

    function it_generates_phpdoc_for_one_scalar_argument_and_one_object_argument()
    {
        $argumentCollection = new ArgumentCollection();
        $argumentCollection->add(new Argument('string', 'argument'));
        $argumentCollection->add(new Argument('\\ArrayObject', 'arrayObject', true));
        $method = new Method($argumentCollection, '__construct', 'public');

        $this->dump($method)->shouldBe(<<<'EOT'
    /**
     * @param string       $argument
     * @param \ArrayObject $arrayObject
     */
EOT
        );
    }
}
