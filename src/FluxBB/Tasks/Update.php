<?php

namespace FluxBB\Tasks;

use FluxBB\Models\Config;
use Laravel\Str;

class Update extends Base
{
    public function run($arguments = array())
    {
        $curVersion = $this->curVersion();
        $target_version = isset($arguments[0]) ? $arguments[0] : FLUXBB_VERSION;

        if (version_compare($curVersion, $target_version, '=')) {
            $this->log('Already up-to-date.');
        } else {
            $this->migrate($curVersion, $target_version);

            $this->log('Updating database...');
            $this->updateVersion($target_version);
            $this->log('Done.');
        }
    }

    public function up($arguments = array())
    {
        $version = $this->curVersion();
        $migration = $arguments[0];

        $this->runMigration($version, $migration, 'up');
    }

    public function down($arguments = array())
    {
        $version = $this->curVersion();
        $migration = $arguments[0];

        $this->runMigration($version, $migration, 'down');
    }

    protected function migrate($from, $to)
    {
        $direction = version_compare($from, $to, '<') ? 'up' : 'down';

        $run_versions = array();

        $files = new FilesystemIterator($this->path());
        foreach ($files as $file) {
            $version = basename($file->getFileName());

            if ($this->versionBetween($version, $from, $to)) {
                $run_versions[] = $version;
            }
        }

        // Sort the versions by name and then run their migrations in the correct order
        usort($run_versions, 'version_compare');
        if ($direction == 'down') {
            $run_versions = array_reverse($run_versions);
        }

        foreach ($run_versions as $run_version) {
            $this->{$direction.'_version'}($run_version);
        }
    }

    protected function versionBetween($version, $start, $end)
    {
        if (version_compare($start, $end, '>')) {
            $temp = $start;
            $start = $end;
            $end = $temp;
        }

        return version_compare($start, $version, '<') && version_compare($version, $end, '<=');
    }

    protected function upVersion($version)
    {
        $this->log('Update to v'.$version.'...');

        $this->foreachMigration($version, 'up');
    }

    protected function downVersion($version)
    {
        $this->log('Rollback from v'.$version.'...');

        $this->foreachMigration($version, 'down');
    }

    protected function foreachMigration($version, $method)
    {
        foreach (new FilesystemIterator($this->path().$version) as $file) {
            $cur_migration = basename($file->getFileName(), '.php');

            $this->runMigration($version, $cur_migration, $method);
        }
    }

    protected function runMigration($version, $migration, $method)
    {
        $file = $this->path().$version.DS.$migration.'.php';

        $this->log('Migrate '.$migration.'...');

        $class = 'FluxBB_Update_'.Str::classify($migration);
        include_once $file;

        $instance = new $class;
        $instance->$method();
    }

    protected function curVersion()
    {
        return Config::get('o_cur_version');
    }

    protected function updateVersion($new_version)
    {
        Config::set('o_cur_version', $new_version);
        Config::save();
    }

    protected function path()
    {
        return Bundle::path('fluxbb').'migrations'.DS.'update'.DS;
    }
}
