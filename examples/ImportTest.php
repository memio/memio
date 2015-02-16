<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples;

use Gnugat\Medio\Model\Import;

class ImportTest extends PrettyPrinterTestCase
{
    public function testSimpleOne()
    {
        $import = new Import('\\DateTime');

        $generatedCode = $this->prettyPrinter->generateCode($import);

        $this->assertSame('use DateTime;', $generatedCode);
    }

    public function testWithAlias()
    {
        $import = Import::make('\\ArrayObject')
            ->setAlias('StdArray')
        ;

        $generatedCode = $this->prettyPrinter->generateCode($import);

        $this->assertSame('use ArrayObject as StdArray;', $generatedCode);
    }
}
