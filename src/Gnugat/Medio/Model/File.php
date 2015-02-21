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

use Gnugat\Medio\ValueObject\Collection;
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
     * @var Collection
     */
    private $imports;

    /**
     * @var Collection
     */
    private $constants;

    /**
     * @var PropertyCollection
     */
    private $propertyCollection;

    /**
     * @var Collection
     */
    private $methods;

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
        $this->imports = new Collection('Gnugat\\Medio\\Model\\Import');
        $this->constants = new Collection('Gnugat\\Medio\\Model\\Constant');
        $this->propertyCollection = new PropertyCollection();
        $this->methods = new Collection('Gnugat\\Medio\\Model\\Method');
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
     * @return Collection
     */
    public function getMethodCollection()
    {
        return $this->methods;
    }

    /**
     * @param Method $method
     *
     * @return File
     *
     * @api
     */
    public function addMethod(Method $method)
    {
        $this->methods->add($method);

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
     * @return Collection
     */
    public function getConstantCollection()
    {
        return $this->constants;
    }

    /**
     * @param Constant $constant
     *
     * @return File
     *
     * @api
     */
    public function addConstant(Constant $constant)
    {
        $this->constants->add($constant);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getImportCollection()
    {
        return $this->imports;
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
        $this->imports->add($import);

        return $this;
    }
}
