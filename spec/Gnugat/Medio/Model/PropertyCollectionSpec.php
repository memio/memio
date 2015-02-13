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

use Gnugat\Medio\Model\Property;
use PhpSpec\ObjectBehavior;

class PropertyCollectionSpec extends ObjectBehavior
{
    function it_has_properties()
    {
        $this->all()->shouldHaveCount(0);
    }

    function it_can_get_more_properties()
    {
        $this->add(new Property('dateTime'));
        $this->add(new Property('arrayObject'));

        $this->all()->shouldHaveCount(2);
    }

    function it_does_not_allow_name_duplication()
    {
        $this->add(new Property('dateTime'));

        $exception = 'Gnugat\\Medio\\Exception\\InvalidArgumentException';
        $this->shouldThrow($exception)->duringAdd(new Property('dateTime'));
    }
}
