<?php
/*
 * This file is part of the Magallanes package.
 *
 * (c) Andrés Montañez <andres@andresmontanez.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mage\Task\BuiltIn\Symfony;

use Symfony\Component\Process\Process;

/**
 * Symfony Task - Install Assets
 *
 * @author Andrés Montañez <andresmontanez@gmail.com>
 */
class AssetsInstallTask extends AbstractSymfonyTask
{
    public function getName()
    {
        return 'symfony/assets-install';
    }

    public function getDescription()
    {
        return '[Symfony] Assets Install';
    }

    public function execute()
    {
        $options = $this->getOptions();
        $command = sprintf('%s assets:install %s --env=%s %s', $options['console'], $options['target'], $options['env'], $options['flags']);

        /** @var Process $process */
        $process = $this->runtime->runCommand(trim($command));

        return $process->isSuccessful();
    }

    protected function getSymfonyOptions()
    {
        return ['target' => 'public', 'flags' => '--symlink --relative'];
    }
}
