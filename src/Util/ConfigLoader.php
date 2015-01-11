<?php

namespace FluxBB\Util;

use Illuminate\Contracts\Config\Repository;
use Symfony\Component\Finder\Finder;

class ConfigLoader
{
    /**
     * Load the config files from the given path and store the values in the repository.
     *
     * @param Repository $config
     * @param string $configPath
     * @return void
     */
    public function loadFrom(Repository $config, $configPath)
    {
        foreach ($this->filesIn($configPath) as $group => $configFile) {
            $config->set($group, require $configFile);
        }
    }

    /**
     * Get all files in the given directory.
     *
     * Returns an array with the full paths to all PHP files in the given directory, indexed by name without extension.
     *
     * @param string $configPath
     * @return string[]
     */
    protected function filesIn($configPath)
    {
        $files = [];

        foreach (Finder::create()->files()->name('*.php')->in($configPath) as $file) {
            $group = basename($file->getRealPath(), '.php');
            $files[$group] = $file->getRealPath();
        }

        return $files;
    }
}
