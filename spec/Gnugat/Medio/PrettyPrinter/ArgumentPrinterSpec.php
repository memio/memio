<?php

namespace spec\Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\Argument;
use PhpSpec\ObjectBehavior;

class ArgumentPrinterSpec extends ObjectBehavior
{
    function it_formats_arrays()
    {
        $this->format(new Argument('array', 'lines'))->shouldBe('array $lines');
    }

    function it_formats_callables_only_from_php_54()
    {
        $formatedArgument = (version_compare(PHP_VERSION, '5.4.0') >= 0) ? 'callable $doSomething': '$doSomething';

        $this->format(new Argument('callable', 'doSomething'))->shouldBe($formatedArgument);
    }

    function it_formats_objects()
    {
        $this->format(new Argument('\\StdClass', 'myClass', true))->shouldBe('StdClass $myClass');
    }

    function it_formats_other_types()
    {
        $this->format(new Argument('string', 'content'))->shouldBe('$content');
    }
}
