<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples\Collection;

use Gnugat\Medio\Examples\PrettyPrinterTestCase;
use Gnugat\Medio\Model\Import;

class ImportCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroImports()
    {
        $imports = array();

        $generatedCode = $this->prettyPrinter->generateCode($imports);

        $this->assertSame('', $generatedCode);
    }

    public function testOneImport()
    {
        $imports = array(
            new Import('DateTime'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($imports);

        $this->assertExpectedCode($generatedCode);
    }

    public function testThreeImports()
    {
        $imports = array(
            new Import('DateTime'),
            new Import('ArrayObject'),
            new Import('stdClass'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($imports);

        $this->assertExpectedCode($generatedCode);
    }
}
