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

use Gnugat\Medio\Model\Constant;
use PhpSpec\ObjectBehavior;

class ConstantCollectionSpec extends ObjectBehavior
{
    function it_has_constants()
    {
        $this->all()->shouldHaveCount(0);
    }

    function it_can_get_more_constants()
    {
        $this->add(new Constant('FIRST_CONSTANT', '0'));
        $this->add(new Constant('SECOND_CONSTANT', '0'));

        $this->all()->shouldHaveCount(2);
    }

    function it_does_not_allow_name_duplication()
    {
        $this->add(new Constant('MY_CONSTANT', '0'));

        $exception = 'Gnugat\\Medio\\Exception\\InvalidArgumentException';
        $this->shouldThrow($exception)->duringAdd(new Constant('MY_CONSTANT', '0'));
    }
}
