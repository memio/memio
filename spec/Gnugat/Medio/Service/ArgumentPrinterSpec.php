<?php

namespace spec\Gnugat\Medio\Service;

use Gnugat\Medio\Model\Argument;
use PhpSpec\ObjectBehavior;

class ArgumentPrinterSpec extends ObjectBehavior
{
    function it_supports_argument()
    {
        $this->supports(new Argument('array', 'lines'))->shouldBe(true);
    }

    function it_does_not_support_anything_else()
    {
        $this->supports(new \StdClass())->shouldBe(false);
    }

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
}
