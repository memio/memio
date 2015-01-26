<?php

namespace spec\Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\ArgumentCollection;
use Gnugat\Medio\PrettyPrinter\ArgumentPrinter;
use PhpSpec\ObjectBehavior;

class MultilineArgumentCollectionPrinterSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new ArgumentPrinter());
    }

    function it_generates_no_arguments()
    {
        $this->dump(new ArgumentCollection())->shouldBe('');
    }

    function it_generates_one_argument()
    {
        $argumentCollection = new ArgumentCollection();
        $argumentCollection->add(new Argument('array', 'lines'));

        $this->dump($argumentCollection)->shouldBe(<<<'EOT'

        array $lines
    
EOT
        );
    }

    function it_generates_many_arguments()
    {
        $argumentCollection = new ArgumentCollection();
        $argumentCollection->add(new Argument('array', 'lines'));
        $argumentCollection->add(new Argument('string', 'content'));
        $argumentCollection->add(new Argument('\\StdClass', 'myClass', true));

        $this->dump($argumentCollection)->shouldBe(<<<'EOT'

        array $lines,
        $content,
        \StdClass $myClass
    
EOT
);
    }
}
