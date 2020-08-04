<?php

declare(strict_types=1);

namespace Mage\Task\BuiltIn\Symfony;

use Mage\Runtime\Exception\RuntimeException;
use Mage\Task\Exception\SkipException;
use Symfony\Component\Process\Process;

/**
 * Class ChangeEnvironmentTask.
 */
class ChangeEnvironmentTask extends AbstractSymfonyTask
{
    public function getName()
    {
        return 'symfony/change-environment';
    }

    public function getDescription()
    {
        $options = $this->getOptions();

        return sprintf('[Symfony] Change environement in .env file to %s', $options['env']);
    }

    public function execute()
    {
        $options = $this->getOptions();
        $env = $options['env'];

        $path = realpath('.env');
        $data = file_get_contents($path);
        $items = [];
        preg_match('/APP_ENV=(.*)/', $data, $items);
        $this->runtime->setVar('symfony_revert_env', $items[1] ?? 'dev');
        file_put_contents($path, preg_replace('/APP_ENV=.*/', sprintf('APP_ENV=%s', $env), $data));

        return true;
    }
}
