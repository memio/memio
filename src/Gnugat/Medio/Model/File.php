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

use Gnugat\Medio\Model\Phpdoc\LicensePhpdoc;

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
     * @var LicensePhpdoc
     */
    private $licensePhpdoc;

    /**
     * @var Strucutre
     */
    private $structure;

    /**
     * @param string $filename
     *
     * @api
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
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
        if (null === $this->structure) {
            return;
        }

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
     * @param Structure $structure
     *
     * @return File
     *
     * @api
     */
    public function setStructure(Structure $structure)
    {
        $this->structure = $structure;

        return $this;
    }

    /**
     * @return Structure
     */
    public function getStructure()
    {
        return $this->structure;
    }

    /**
     * @return LicensePhpdoc
     */
    public function getLicensePhpdoc()
    {
        return $this->licensePhpdoc;
    }

    /**
     * @param LicensePhpdoc $licensePhpdoc
     *
     * @return File
     *
     * @api
     */
    public function setLicensePhpdoc(LicensePhpdoc $licensePhpdoc)
    {
        $this->licensePhpdoc = $licensePhpdoc;

        return $this;
    }

    /**
     * @return File
     *
     * @api
     */
    public function removeLicensePhpdoc()
    {
        $this->licensePhpdoc = null;
    }
}
