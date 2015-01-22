<?php

namespace spec\Gnugat\Medio\Model;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Body;
use Gnugat\Medio\Model\Visibility;
use PhpSpec\ObjectBehavior;

class MethodSpec extends ObjectBehavior
{
    const NAME = '__construct';

    private $arguments;
    private $body;
    private $visibility;

    function let()
    {
        $this->arguments = array(new Argument('array', 'lines'));
        $this->body = new Body(array());
        $this->visibility = new Visibility('public');

        $this->beConstructedWith($this->arguments, $this->body, self::NAME, $this->visibility);
    }

    function it_has_arguments()
    {
        $this->getArguments()->shouldBe($this->arguments);
    }

    function it_has_a_body()
    {
        $this->getBody()->shouldBe($this->body);
    }

    function it_has_a_name()
    {
        $this->getName()->shouldBe(self::NAME);
    }

    function it_has_a_visibility()
    {
        $this->getVisibility()->shouldBe($this->visibility);
    }
}
