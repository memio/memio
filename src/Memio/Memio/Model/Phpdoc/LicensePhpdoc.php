<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Model\Phpdoc;

/**
 * @api
 */
class LicensePhpdoc
{
    /**
     * @var string
     */
    private $projectName;

    /**
     * @var string
     */
    private $authorName;

    /**
     * @var string
     */
    private $authorEmail;

    /**
     * @param string $projectName
     * @param string $authorName
     * @param string $authorEmail
     *
     * @api
     */
    public function __construct($projectName, $authorName, $authorEmail)
    {
        $this->projectName = $projectName;
        $this->authorName = $authorName;
        $this->authorEmail = $authorEmail;
    }

    /**
     * @param string $projectName
     * @param string $authorName
     * @param string $authorEmail
     *
     * @return License
     *
     * @api
     */
    public static function make($projectName, $authorName, $authorEmail)
    {
        return new self($projectName, $authorName, $authorEmail);
    }

    /**
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }
}
