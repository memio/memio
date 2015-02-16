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

use PhpSpec\ObjectBehavior;

class PropertySpec extends ObjectBehavior
{
    const NAME = 'dateTime';

    function let()
    {
        $this->beConstructedWith(self::NAME);
    }

    function it_has_a_name()
    {
        $this->getName()->shouldBe(self::NAME);
    }

    function it_has_private_visibility_by_default()
    {
        $this->getVisibility()->shouldBe('private');
    }

    function it_can_have_public_visibility()
    {
        $this->makePublic();
        $this->getVisibility()->shouldBe('public');
    }

    function it_can_have_protected_visibility()
    {
        $this->makeProtected();
        $this->getVisibility()->shouldBe('protected');
    }

    function it_can_be_changed_back_to_private_visibility()
    {
        $this->makePublic();
        $this->makePrivate();
        $this->getVisibility()->shouldBe('private');
    }

    function it_is_not_static_by_default()
    {
        $this->isStatic()->shouldBe(false);
    }

    function it_can_be_made_static()
    {
        $this->makeStatic();
        $this->isStatic()->shouldBe(true);
    }

    function it_can_be_made_back_to_non_static()
    {
        $this->makeStatic();
        $this->removeStatic();
        $this->isStatic()->shouldBe(false);
    }
}
