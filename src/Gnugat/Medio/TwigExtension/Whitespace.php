<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\TwigExtension;

use Gnugat\Medio\TwigExtension\Line\Line;
use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class Whitespace extends Twig_Extension
{
    /**
     * @var Line
     */
    private $line;

    /**
     * @param Line $line
     */
    public function __construct(Line $line)
    {
        $this->line = $line;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('needs_line_after', array($this->line, 'needsLineAfter')),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter('indent', array($this, 'indent')),
        );
    }

    /**
     * @param string $text
     * @param int    $level
     * @param string $type
     *
     * @return string
     */
    public function indent($text, $level = 1, $type = 'code')
    {
        $lines = explode("\n", $text);
        $indentedLines = array();
        if ('phpdoc' === $type) {
            foreach ($lines as $line) {
                $indent = ' *';
                if (!empty($line)) {
                    $indent .= ' ';
                }
                $indentedLines[] = $indent.$line;
            }
        }

        return implode("\n", $indentedLines);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'whitespace';
    }
}
