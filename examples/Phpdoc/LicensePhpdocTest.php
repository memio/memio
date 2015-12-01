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
use Memio\Model\Phpdoc\LicensePhpdoc;

class LicensePhpdocTest extends PrettyPrinterTestCase
{
    const PROJECT_NAME = 'gnugat/medio';
    const AUTHOR_NAME = 'Loïc Chardonnet';
    const AUTHOR_EMAIL = 'loic.chardonnet@gmail.com';

    public function testSimpleOne()
    {
        $license = new LicensePhpdoc(self::PROJECT_NAME, self::AUTHOR_NAME, self::AUTHOR_EMAIL);

        $generatedCode = $this->prettyPrinter->generateCode($license);

        $this->assertExpectedCode($generatedCode);
    }
}
