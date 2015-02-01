<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Type;
use PhpSpec\ObjectBehavior;

class ArgumentPrinterSpec extends ObjectBehavior
{
    function it_generates_arrays()
    {
        $this->dump(new Argument(new Type('array'), 'lines'))->shouldBe('array $lines');
    }

    function it_generates_callables_only_from_php_54()
    {
        $formatedArgument = (version_compare(PHP_VERSION, '5.4.0') >= 0) ? 'callable $doSomething': '$doSomething';

        $this->dump(new Argument(new Type('callable'), 'doSomething'))->shouldBe($formatedArgument);
    }

    function it_generates_objects()
    {
        $this->dump(new Argument(new Type('stdClass'), 'myClass', true))->shouldBe('\\stdClass $myClass');
    }

    function it_generates_other_types()
    {
        $this->dump(new Argument(new Type('string'), 'content'))->shouldBe('$content');
    }
}
