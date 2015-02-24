<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Model;

use Gnugat\Medio\Model\Constant;
use Gnugat\Medio\Model\Import;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\Property;
use Gnugat\Medio\Model\Structure;
use PhpSpec\ObjectBehavior;

class FileSpec extends ObjectBehavior
{
    const FILENAME = '/tmp/medio/src/Gnugat/Medio/MyClass.php';
    const NAMESPACE_ = 'Gnugat\\Medio';
    const CLASSNAME = 'MyClass';

    function let(Structure $structure)
    {
        $this->beConstructedWith(self::FILENAME, $structure);
    }

    function it_has_a_filename()
    {
        $this->getFilename()->shouldBe(self::FILENAME);
    }

    function it_has_a_namespace(Structure $structure)
    {
        $structure->getNamespace()->willReturn(self::NAMESPACE_);

        $this->getNamespace()->shouldBe(self::NAMESPACE_);
    }

    function it_has_a_structure(Structure $structure)
    {
        $this->getStructure()->shouldBe($structure);
    }

    function it_has_a_collection_of_imports(Import $import)
    {
        $importCollection = $this->getImportCollection();

        $importCollection->all()->shouldHaveCount(0);
        $this->addImport($import);
        $importCollection->all()->shouldHaveCount(1);
    }
}
