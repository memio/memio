<?php

namespace spec\Gnugat\Medio\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VisibilitySpec extends ObjectBehavior
{
    function it_can_be_private()
    {
        $invalidArgumentException = 'Gnugat\\Medio\\Exception\\InvalidArgumentException';

        $invalidArgumentException = 'Gnugat\\Medio\\Exception\\InvalidArgumentException';

        $this->shouldNotThrow($invalidArgumentException)->during__construct('private');
    }

    function it_can_be_public()
    {
        $invalidArgumentException = 'Gnugat\\Medio\\Exception\\InvalidArgumentException';

        $this->shouldNotThrow($invalidArgumentException)->during__construct('public');
    }

    function it_can_be_protected()
    {
        $invalidArgumentException = 'Gnugat\\Medio\\Exception\\InvalidArgumentException';

        $this->shouldNotThrow($invalidArgumentException)->during__construct('protected');
    }

    function it_can_be_nothing()
    {
        $invalidArgumentException = 'Gnugat\\Medio\\Exception\\InvalidArgumentException';

        $this->shouldNotThrow($invalidArgumentException)->during__construct('');
    }

    function it_cannot_be_something_else()
    {
        $invalidArgumentException = 'Gnugat\\Medio\\Exception\\InvalidArgumentException';

        $this->shouldThrow($invalidArgumentException)->during__construct('spanish inquisition');
    }
}
