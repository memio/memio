<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Examples\Phpdoc;

use Memio\Memio\Examples\PrettyPrinterTestCase;
use Memio\Model\Phpdoc\DeprecationTag;

class DeprecationTagTest extends PrettyPrinterTestCase
{
    public function testTagOnly()
    {
        $apiTag = new DeprecationTag();

        $generatedCode = $this->prettyPrinter->generateCode($apiTag);

        $this->assertSame('@deprecated', $generatedCode);
    }

    public function testTagWithVersion()
    {
        $apiTag = new DeprecationTag('v2.1');

        $generatedCode = $this->prettyPrinter->generateCode($apiTag);

        $this->assertSame('@deprecated v2.1', $generatedCode);
    }

    public function testTagWithVersionAndDescription()
    {
        $apiTag = new DeprecationTag('v2.1', 'Use Object#method instead');

        $generatedCode = $this->prettyPrinter->generateCode($apiTag);

        $this->assertSame('@deprecated v2.1 Use Object#method instead', $generatedCode);
    }
}
