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
use Gnugat\Medio\Model\Type;
use Gnugat\Medio\PrettyPrinter\ArgumentPrinter;
use PhpSpec\ObjectBehavior;

class InlineArgumentCollectionPrinterSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new ArgumentPrinter());
    }

    function it_generates_no_arguments()
    {
        $this->dump(new ArgumentCollection())->shouldBe('');
    }

    function it_generates_one_argument()
    {
        $argument = new Argument(new Type('array'), 'lines');
        $argumentCollection = new ArgumentCollection();
        $argumentCollection->add($argument);

        $this->dump($argumentCollection)->shouldBe('array $lines');
    }

    function it_generates_many_arguments()
    {
        $argument1 = new Argument(new Type('array'), 'lines');
        $argument2 = new Argument(new Type('string'), 'content');
        $argument3 = new Argument(new Type('stdClass'), 'myClass', true);
        $argumentCollection = new ArgumentCollection();
        $argumentCollection->add($argument1);
        $argumentCollection->add($argument2);
        $argumentCollection->add($argument3);

        $this->dump($argumentCollection)->shouldBe('array $lines, $content, \\stdClass $myClass');
    }

    function it_avoids_name_collision()
    {
        $argument1 = new Argument(new Type('string'), 'line');
        $argument2 = new Argument(new Type('string'), 'line');
        $argumentCollection = new ArgumentCollection();
        $argumentCollection->add($argument1);
        $argumentCollection->add($argument2);

        $this->dump($argumentCollection)->shouldBe('$line1, $line2');
    }
}
