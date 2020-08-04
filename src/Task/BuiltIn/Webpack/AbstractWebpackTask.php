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

use Mage\Task\AbstractTask;

/**
 * Abstract Webpack Task.
 */
abstract class AbstractWebpackTask extends AbstractTask
{
    protected function getOptions()
    {
        $options = array_merge(
            ['path' => 'yarn'],
            $this->getWebpackOptions(),
            $this->runtime->getMergedOption('webpack'),
            $this->options
        );

        return $options;
    }

    protected function getWebpackOptions()
    {
        return [];
    }
}
