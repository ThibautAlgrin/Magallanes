<?php
/*
 * This file is part of the Magallanes package.
 *
 * (c) Andrés Montañez <andres@andresmontanez.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mage\Task\BuiltIn\Webpack;

use Symfony\Component\Process\Process;

/**
 * Webpack Task - Run script.
 */
class RunTask extends AbstractWebpackTask
{
    public function getName()
    {
        return 'yarn/run';
    }

    public function getDescription()
    {
        return '[Webpack] yarn Run';
    }

    public function execute()
    {
        $options = $this->getOptions();
        $cmd = sprintf('%s run %s', $options['path'], $options['command']);

        /** @var Process $process */
        $process = $this->runtime->runCommand(trim($cmd), $options['timeout']);

        return $process->isSuccessful();
    }

    protected function getWebpackOptions()
    {
        return ['timeout' => 120];
    }
}
