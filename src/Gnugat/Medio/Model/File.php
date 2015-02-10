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

class File
{
    /**
     * @var string
     */
    private $filename;

    /**
     * @var MethodCollection
     */
    private $methodCollection;

    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->methodCollection = new MethodCollection();
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

        return end(explode('/', $filenameWithoutExtension));
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
     * @throws InvalidArgumentException If the name is already taken
     */
    public function addMethod(Method $method)
    {
        $this->methodCollection->add($method);
    }
}
