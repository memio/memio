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
use PhpSpec\ObjectBehavior;

class FileSpec extends ObjectBehavior
{
    const FILENAME = '/tmp/medio/src/Gnugat/Medio/MyClass.php';
    const NAMESPACE_ = 'Gnugat\\Medio';
    const CLASSNAME = 'MyClass';

    function let()
    {
        $this->beConstructedWith(self::FILENAME);
    }

    function it_has_a_filename()
    {
        $this->getFilename()->shouldBe(self::FILENAME);
    }

    function it_has_a_namespace()
    {
        $this->getNamespace()->shouldBe(self::NAMESPACE_);
    }

    function it_can_have_phpspec_namespace()
    {
        $this->beConstructedWith('/tmp/medio/spec/Gnugat/Medio/MyClassSpec.php');
        $this->getNamespace()->shouldBe('spec\\Gnugat\\Medio');
    }

    function it_has_a_classname()
    {
        $this->getClassname()->shouldBe(self::CLASSNAME);
    }

    function it_has_a_collection_of_imports(Import $import)
    {
        $importCollection = $this->getImportCollection();

        $importCollection->all()->shouldHaveCount(0);
        $this->addImport($import);
        $importCollection->all()->shouldHaveCount(1);
    }

    function it_has_a_collection_of_constants(Constant $constant)
    {
        $constantCollection = $this->getConstantCollection();

        $constantCollection->all()->shouldHaveCount(0);
        $this->addConstant($constant);
        $constantCollection->all()->shouldHaveCount(1);
    }

    function it_has_a_collection_of_properties(Property $property)
    {
        $propertyCollection = $this->getPropertyCollection();

        $propertyCollection->all()->shouldHaveCount(0);
        $this->addProperty($property);
        $propertyCollection->all()->shouldHaveCount(1);
    }

    function it_has_a_collection_of_methods(Method $method)
    {
        $methodCollection = $this->getMethodCollection();

        $methodCollection->all()->shouldHaveCount(0);
        $this->addMethod($method);
        $methodCollection->all()->shouldHaveCount(1);
    }
}