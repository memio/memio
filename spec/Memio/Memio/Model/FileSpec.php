<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Memio\Memio\Model;

use Memio\Memio\Model\FullyQualifiedName;
use Memio\Memio\Model\Phpdoc\LicensePhpdoc;
use Memio\Memio\Model\Structure;
use PhpSpec\ObjectBehavior;

class FileSpec extends ObjectBehavior
{
    const FILENAME = '/tmp/medio/src/Memio/Memio/MyClass.php';
    const NAMESPACE_ = 'Memio\\Memio';
    const CLASSNAME = 'MyClass';

    function let()
    {
        $this->beConstructedWith(self::FILENAME);
    }

    function it_has_a_filename()
    {
        $this->getFilename()->shouldBe(self::FILENAME);
    }

    function it_has_a_structure(Structure $structure)
    {
        $structure->getNamespace()->willReturn(self::NAMESPACE_);

        $this->setStructure($structure);

        $this->getStructure()->shouldBe($structure);
        $this->getNamespace()->shouldBe(self::NAMESPACE_);
    }

    function it_has_a_collection_of_fully_qualified_name(FullyQualifiedName $fullyQualifiedName)
    {
        $this->allFullyQualifiedNames()->shouldBe(array());
        $this->addFullyQualifiedName($fullyQualifiedName);
        $this->allFullyQualifiedNames()->shouldBe(array($fullyQualifiedName));
    }

    function it_can_have_license_phpdoc(LicensePhpdoc $licensePhpdoc)
    {
        $this->getLicensePhpdoc()->shouldBe(null);

        $this->setLicensePhpdoc($licensePhpdoc);
        $this->getLicensePhpdoc()->shouldBe($licensePhpdoc);

        $this->removeLicensePhpdoc();
        $this->getLicensePhpdoc()->shouldBe(null);
    }
}
