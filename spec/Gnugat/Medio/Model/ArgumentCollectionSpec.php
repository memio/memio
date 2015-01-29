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
use Gnugat\Medio\Model\Type;
use PhpSpec\ObjectBehavior;

class ArgumentCollectionSpec extends ObjectBehavior
{
    function it_has_arguments()
    {
        $this->all()->shouldHaveCount(0);
    }

    function it_can_get_more_arguments()
    {
        $this->add(new Argument(new Type('array'), 'lines'));
        $this->add(new Argument(new Type('string'), 'content'));

        $this->all()->shouldHaveCount(2);
    }

    function it_renames_arguments_to_avoid_collision()
    {
        $this->add(new Argument(new Type('string'), 'line'));
        $this->add(new Argument(new Type('string'), 'line'));

        $arguments = $this->all();
        $argument1 = $arguments[0];
        $argument1->getName()->shouldBe('line1');
        $argument2 = $arguments[1];
        $argument2->getName()->shouldBe('line2');
    }
}
