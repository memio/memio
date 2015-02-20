<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Model;

use Gnugat\Medio\ValueObject\FullyQualifiedClassname;

/**
 * @api
 */
class File
{
    /**
     * @var string
     */
    private $filename;

    /**
     * @var FullyQualifiedClassname
     */
    private $fullyQualifiedClassname;

    /**
     * @var ImportCollection
     */
    private $importCollection;

    /**
     * @var ConstantCollection
     */
    private $constantCollection;

    /**
     * @var PropertyCollection
     */
    private $propertyCollection;

    /**
     * @var MethodCollection
     */
    private $methodCollection;

    /**
     * @param string $filename
     *
     * @api
     */
    public function __construct($filename)
    {
        $filenameWithoutExtension = rtrim($filename, '.php');
        $parts = explode('/', $filenameWithoutExtension);
        $uppercases = array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N',
            'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        );
        $i = count($parts) - 1;
        // Detecting the first part that starts with a lowercase character
        while ($i >= 0 && in_array($parts[$i][0], $uppercases, true)) {
            $i--;
        }
        if ($parts[$i] !== 'spec') {
            $i++;
        }
        $namespaces = array_slice($parts, $i);
        $fullyQualifiedClassname = implode('\\', $namespaces);

        $this->filename = $filename;
        $this->fullyQualifiedClassname = new FullyQualifiedClassname($fullyQualifiedClassname);
        $this->importCollection = new ImportCollection();
        $this->constantCollection = new ConstantCollection();
        $this->methodCollection = new MethodCollection();
        $this->propertyCollection = new PropertyCollection();
    }

    /**
     * @param string $filename
     *
     * @return File
     *
     * @api
     */
    public static function make($filename)
    {
        return new self($filename);
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->fullyQualifiedClassname->getNamespace();
    }

    /**
     * @return string
     */
    public function getClassname()
    {
        return $this->fullyQualifiedClassname->getClassname();
    }

    /**
     * @return MethodCollection
     */
    public function getMethodCollection()
    {
        return $this->methodCollection;
    }

    /**
     * @param Method $method
     *
     * @return File
     *
     * @throws InvalidArgumentException If the name is already taken
     *
     * @api
     */
    public function addMethod(Method $method)
    {
        $this->methodCollection->add($method);

        return $this;
    }

    /**
     * @return PropertyCollection
     */
    public function getPropertyCollection()
    {
        return $this->propertyCollection;
    }

    /**
     * @param Property $property
     *
     * @return File
     *
     * @throws InvalidArgumentException If the name is already taken
     *
     * @api
     */
    public function addProperty(Property $property)
    {
        $this->propertyCollection->add($property);

        return $this;
    }

    /**
     * @return ConstantCollection
     */
    public function getConstantCollection()
    {
        return $this->constantCollection;
    }

    /**
     * @param Constant $constant
     *
     * @return File
     *
     * @throws InvalidArgumentException If the name is already taken
     *
     * @api
     */
    public function addConstant(Constant $constant)
    {
        $this->constantCollection->add($constant);

        return $this;
    }

    /**
     * @return ImportCollection
     */
    public function getImportCollection()
    {
        return $this->importCollection;
    }

    /**
     * @param Import $import
     *
     * @return File
     *
     * @api
     */
    public function addImport(Import $import)
    {
        $this->importCollection->add($import);

        return $this;
    }
}
