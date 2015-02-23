<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\TwigExtension\Line;

use Gnugat\Medio\Model\File;
use Gnugat\Medio\ValueObject\Collection;
use PhpSpec\ObjectBehavior;

class FileLineStrategySpec extends ObjectBehavior
{
    const IMPORT_BLOCK = 'imports';

    function it_is_a_line_strategy()
    {
        $this->shouldImplement('Gnugat\Medio\TwigExtension\Line\LineStrategy');
    }

    function it_supports_files(File $file)
    {
        $this->supports($file)->shouldBe(true);
    }

    function it_needs_line_after_imports_if_file_has_imports(Collection $collection, File $file)
    {
        $file->getImportCollection()->willReturn($collection);
        $collection->all()->willReturn(array(1));

        $this->needsLineAfter($file, self::IMPORT_BLOCK)->shouldBe(true);
    }
}
