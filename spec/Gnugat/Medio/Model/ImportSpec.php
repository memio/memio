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

class ImportSpec extends ObjectBehavior
{
    const FQCN = 'Gnugat\\Medio\\Fixtures\\MyClass';
    const CLASSNAME = 'MyClass';
    const ALIAS = 'ClassIsMine';

    function let()
    {
        $this->beConstructedWith(self::FQCN);
    }

    function it_has_a_fully_qualified_name()
    {
        $this->getFullyQualifiedName()->shouldBe(self::FQCN);
    }

    function it_has_classname()
    {
        $this->getClassname()->shouldBe(self::CLASSNAME);
    }

    function it_can_have_an_alias()
    {
        $this->hasAlias()->shouldBe(false);

        $this->setAlias(self::ALIAS);

        $this->hasAlias()->shouldBe(true);
        $this->getAlias()->shouldBe(self::ALIAS);
    }

    function it_can_remove_its_alias()
    {
        $this->setAlias(self::ALIAS);
        $this->removeAlias();

        $this->hasAlias()->shouldBe(false);
    }
}
