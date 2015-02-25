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

use Gnugat\Medio\Model\FullyQualifiedName;

class FullyQualifiedNameTest extends PrettyPrinterTestCase
{
    public function testSimpleOne()
    {
        $fullyQualifiedName = new FullyQualifiedName('\\DateTime');

        $generatedCode = $this->prettyPrinter->generateCode($fullyQualifiedName);

        $this->assertSame('use DateTime;', $generatedCode);
    }

    public function testWithAlias()
    {
        $fullyQualifiedName = FullyQualifiedName::make('\\ArrayObject')
            ->setAlias('StdArray')
        ;

        $generatedCode = $this->prettyPrinter->generateCode($fullyQualifiedName);

        $this->assertSame('use ArrayObject as StdArray;', $generatedCode);
    }
}
