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
 * Webpack Task - Install Vendors.
 */
class InstallTask extends AbstractWebpackTask
{
    public function getName()
    {
        return 'yarn/install';
    }

    public function getDescription()
    {
        return '[Webpack] Yarn Install';
    }

    public function execute()
    {
        $options = $this->getOptions();
        $cmd = sprintf('%s install %s', $options['path'], $options['flags']);

        /** @var Process $process */
        $process = $this->runtime->runCommand(trim($cmd), $options['timeout']);

        return $process->isSuccessful();
    }

    protected function getWebpackOptions()
    {
        return ['flags' => '', 'timeout' => 120];
    }
}
