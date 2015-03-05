<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Model\Phpdoc;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DescriptionSpec extends ObjectBehavior
{
    const SHORT_DESCRIPTION = 'This is a short description';

    function let()
    {
        $this->beConstructedWith(self::SHORT_DESCRIPTION);
    }

    function it_has_a_short_description()
    {
        $this->all()->shouldBe(array(self::SHORT_DESCRIPTION));
    }

    function it_can_have_empty_lines()
    {
        $this->addEmptyLine();

        $this->all()->shouldBe(array(self::SHORT_DESCRIPTION, ''));
    }

    function it_can_have_long_description()
    {
        $longDescription = array(
            'Long descriptions can span on many lines',
            '',
            '    They can also have empty lines and indented ones.'
        );

        foreach ($longDescription as $line) {
            $this->addLine($line);
        }

        $this->all()->shouldBe(array_merge(array(self::SHORT_DESCRIPTION), $longDescription));
    }
}
