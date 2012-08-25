<?php

use fluxbb\Models\Config,
	Laravel\Str;

class Fluxbb_Update_Task
{
	
	public function run($arguments = array())
	{
		$cur_version = $this->cur_version();
		$target_version = isset($arguments[0]) ? $arguments[0] : FLUXBB_VERSION;

		if (version_compare($cur_version, $target_version, '='))
		{
			$this->log('Already up-to-date.');
		}
		else
		{
			$this->migrate($cur_version, $target_version);

			$this->log('Updating database...');
			$this->update_version($target_version);
			$this->log('Done.');
		}
	}

	protected function migrate($from, $to)
	{
		$direction = version_compare($from, $to, '<') ? 'up' : 'down';

		$run_versions = array();

		$files = new FilesystemIterator($this->path());
		foreach ($files as $file)
		{
			$version = basename($file->getFileName());

			if ($this->version_between($version, $from, $to))
			{
				$run_versions[] = $version;
			}
		}

		// Sort the versions by name and then run their migrations in the correct order
		usort($run_versions, 'version_compare');
		if ($direction == 'down')
		{
			$run_versions = array_reverse($run_versions);
		}

		foreach ($run_versions as $run_version)
		{
			$this->{$direction.'_version'}($run_version);
		}
	}

	protected function version_between($version, $start, $end)
	{
		if (version_compare($start, $end, '>'))
		{
			$temp = $start;
			$start = $end;
			$end = $temp;
		}

		return version_compare($start, $version, '<') && version_compare($version, $end, '<=');
	}

	protected function up_version($version)
	{
		$this->log('Update to v'.$version.'...');

		$this->foreach_migration($version, 'up');
	}

	protected function down_version($version)
	{
		$this->log('Rollback to v'.$version.'...');

		$this->foreach_migration($version, 'down');
	}

	protected function foreach_migration($version, $method)
	{
		foreach (new FilesystemIterator($this->path().$version) as $file)
		{
			$cur_migration = basename($file->getFileName(), '.php');
			$this->log('Migrate '.$cur_migration.'...');
			
			$class = 'FluxBB_Update_'.Str::classify($cur_migration);
			include_once $file->getPathName();

			$migration = new $class;
			$migration->$method();
		}
	}

	protected function cur_version()
	{
		return Config::get('o_cur_version');
	}

	protected function update_version($new_version)
	{
		Config::set('o_cur_version', $new_version);
		Config::save();
	}

	protected function path()
	{
		return Bundle::path('fluxbb').'migrations'.DS.'updates'.DS;
	}

	protected function log($msg)
	{
		echo $msg.PHP_EOL;
	}

}
