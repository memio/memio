<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Model;

use Gnugat\Medio\Model\Argument;
use PhpSpec\ObjectBehavior;

class MethodSpec extends ObjectBehavior
{
    const NAME = '__construct';

    function let()
    {
        $this->beConstructedWith(self::NAME);
    }

    function it_has_a_collection_of_arguments(Argument $argument)
    {
        $argumentCollection = $this->getArgumentCollection();

        $argumentCollection->all()->shouldHaveCount(0);
        $this->addArgument($argument);
        $argumentCollection->all()->shouldHaveCount(1);
    }

    function it_has_a_name()
    {
        $this->getName()->shouldBe(self::NAME);
    }
}
