<?php

namespace Mage\Task\BuiltIn\Doctrine;

use Mage\Task\BuiltIn\Symfony\AbstractSymfonyTask;
use Symfony\Component\Process\Process;

/**
 * Class MigrateTask.
 */
class MigrateTask extends AbstractSymfonyTask
{
    public function getName()
    {
        return 'doctrine/migrate';
    }

    public function getDescription()
    {
        return '[Doctrine] Executing migrations';
    }

    public function execute()
    {
        $options = $this->getOptions();

        $command = sprintf(
            '%s doctrine:migrations:migrate --env=%s %s',
            $options['console'],
            $options['env'],
            $options['flags']
        );

        /** @var Process $process */
        $process = $this->runtime->runCommand(trim($command));

        return $process->isSuccessful();
    }

    /**
     * @inheritDoc
     */
    protected function getSymfonyOptions()
    {
        return ['flags' => '-n --allow-no-migration'];
    }
}
