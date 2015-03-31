<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Memio\Memio\PrettyPrinter;

use Memio\Memio\Model\Argument;
use PhpSpec\ObjectBehavior;

class EmptyCollectionPrettyPrinterSpec extends ObjectBehavior
{
    function it_is_a_pretty_printer_strategy()
    {
        $this->shouldImplement('Memio\\Memio\\PrettyPrinter\\PrettyPrinterStrategy');
    }

    function it_supports_empty_arrays()
    {
        $this->supports(array(), array())->shouldBe(true);
    }

    function it_generates_an_empty_string()
    {
        $this->generateCode(array())->shouldBe('');
    }
}
