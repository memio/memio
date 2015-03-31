<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Memio\Memio\TwigExtension\Line;

use Memio\Memio\Model\File;
use PhpSpec\ObjectBehavior;

class FileLineStrategySpec extends ObjectBehavior
{
    const IMPORT_BLOCK = 'fully_qualified_names';

    function it_is_a_line_strategy()
    {
        $this->shouldImplement('Memio\Memio\TwigExtension\Line\LineStrategy');
    }

    function it_supports_files(File $file)
    {
        $this->supports($file)->shouldBe(true);
    }

    function it_needs_line_after_fully_qualified_names_if_file_has_fully_qualified_names(File $file)
    {
        $file->allFullyQualifiedNames()->willReturn(array(1));

        $this->needsLineAfter($file, self::IMPORT_BLOCK)->shouldBe(true);
    }
}
