<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio;

use Gnugat\Medio\Command\Command;

class Application
{
    /**
     * @var array of Command;
     */
    private $commands = array();

    /**
     * @param string  $name
     * @param Command $command
     */
    public function addCommand($name, Command $command)
    {
        $this->commands[$name] = $command;
    }

    /**
     * @param int    $argc
     * @param string $argv
     *
     * @return int
     */
    public function run($argc, $argv)
    {
        $command = $this->commands[$argv[1]];

        return $command->run($argv[2], $argv[3]);
    }
}
