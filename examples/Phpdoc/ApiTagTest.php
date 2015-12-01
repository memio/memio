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
use Memio\Model\Phpdoc\ApiTag;

class ApiTagTest extends PrettyPrinterTestCase
{
    public function testTagOnly()
    {
        $apiTag = new ApiTag();

        $generatedCode = $this->prettyPrinter->generateCode($apiTag);

        $this->assertSame('@api', $generatedCode);
    }

    public function testTagWithVersion()
    {
        $apiTag = new ApiTag('v2.1');

        $generatedCode = $this->prettyPrinter->generateCode($apiTag);

        $this->assertSame('@api v2.1', $generatedCode);
    }
}
