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
     * @var array
     */
    private $fullyQualifiedNames = array();

    /**
     * @param string    $filename
     * @param Structure $structure
     *
     * @api
     */
    public function __construct($filename, Structure $structure)
    {
        $this->filename = $filename;
        $this->structure = $structure;
    }

    /**
     * @param string    $filename
     * @param Structure $structure
     *
     * @return File
     *
     * @api
     */
    public static function make($filename, Structure $structure)
    {
        return new self($filename, $structure);
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
        return $this->structure->getNamespace();
    }

    /**
     * @return array
     */
    public function allFullyQualifiedNames()
    {
        return $this->fullyQualifiedNames;
    }

    /**
     * @param FullyQualifiedName $fullyQualifiedName
     *
     * @return File
     *
     * @api
     */
    public function addFullyQualifiedName(FullyQualifiedName $fullyQualifiedName)
    {
        $this->fullyQualifiedNames[] = $fullyQualifiedName;

        return $this;
    }

    /**
     * @return Structure
     */
    public function getStructure()
    {
        return $this->structure;
    }
}
