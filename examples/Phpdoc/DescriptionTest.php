<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples\Phpdoc;

use Gnugat\Medio\Examples\PrettyPrinterTestCase;
use Gnugat\Medio\Model\Phpdoc\Description;

class DescriptionTest extends PrettyPrinterTestCase
{
    public function testShortDescription()
    {
        $description = new Description('Short descriptions are put on one line');

        $generatedCode = $this->prettyPrinter->generateCode($description);

        $this->assertSame('Short descriptions are put on one line', $generatedCode);
    }

    public function testLongDescription()
    {
        $description = Description::make('Long descriptions are put on many lines')
            ->addEmptyLine()
            ->addLine('It can also have empty lines')
        ;

        $generatedCode = $this->prettyPrinter->generateCode($description);

        $this->assertExpectedCode($generatedCode);
    }
}
