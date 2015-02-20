<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\ValueObject;

use Gnugat\Medio\Model\Method;
use PhpSpec\ObjectBehavior;

class CollectionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Gnugat\\Medio\\Model\\Method');
    }

    function it_is_empty_by_default()
    {
        $this->isEmtpy()->shouldBe(true);
        $this->all()->shouldHaveCount(0);
    }

    function it_has_a_type()
    {
        $this->getType()->shouldBe('Gnugat\\Medio\\Model\\Method');
    }

    function it_can_add_element(Method $method)
    {
        $this->add($method);

        $this->isEmtpy()->shouldBe(false);
        $this->all()->shouldHaveCount(1);
        $this->all()->shouldBe(array($method));
    }
}
