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

use Gnugat\Medio\Model\Import;
use PhpSpec\ObjectBehavior;

class ImportCollectionSpec extends ObjectBehavior
{
    function it_has_imports()
    {
        $this->all()->shouldHaveCount(0);
    }

    function it_can_get_more_imports()
    {
        $this->add(new Import('DateTime'));
        $this->add(new Import('ArrayObject'));

        $this->all()->shouldHaveCount(2);
    }
}
