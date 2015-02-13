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
        $this->filename = $filename;
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
        $filenameWithoutExtension = rtrim($this->filename, '.php');
        $parts = explode('/', $filenameWithoutExtension);
        $uppercases = array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N',
            'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        );
        array_pop($parts); // Removing classname
        $i = count($parts) - 1;
        // Detecting the first part that starts with a lowercase character
        while ($i >= 0 && in_array($parts[$i][0], $uppercases, true)) {
            $i--;
        }
        if ($parts[$i] !== 'spec') {
            $i++;
        }
        $namespaces = array_slice($parts, $i);

        return implode('\\', $namespaces);
    }

    /**
     * @return string
     */
    public function getClassname()
    {
        $filenameWithoutExtension = rtrim($this->filename, '.php');
        $namespaces = explode('/', $filenameWithoutExtension);

        return end($namespaces);
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
}
