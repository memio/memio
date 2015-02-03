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
