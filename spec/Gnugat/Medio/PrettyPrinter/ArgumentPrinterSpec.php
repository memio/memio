<?php

namespace spec\Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\Argument;
use PhpSpec\ObjectBehavior;

class ArgumentPrinterSpec extends ObjectBehavior
{
    function it_generates_arrays()
    {
        $this->dump(new Argument('array', 'lines'))->shouldBe('array $lines');
    }

    function it_generates_callables_only_from_php_54()
    {
        $formatedArgument = (version_compare(PHP_VERSION, '5.4.0') >= 0) ? 'callable $doSomething': '$doSomething';

        $this->dump(new Argument('callable', 'doSomething'))->shouldBe($formatedArgument);
    }

    function it_generates_objects()
    {
        $this->dump(new Argument('\\StdClass', 'myClass', true))->shouldBe('\\StdClass $myClass');
    }

    function it_generates_other_types()
    {
        $this->dump(new Argument('string', 'content'))->shouldBe('$content');
    }
}
