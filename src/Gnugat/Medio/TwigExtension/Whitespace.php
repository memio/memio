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
    public function getName()
    {
        return 'whitespace';
    }
}
