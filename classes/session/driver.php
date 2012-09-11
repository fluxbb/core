<?php
/**
 * FluxBB - fast, light, user-friendly PHP forum software
 * Copyright (C) 2008-2012 FluxBB.org
 * based on code by Rickard Andersson copyright (C) 2002-2008 PunBB
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public license for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category	FluxBB
 * @package		Core
 * @copyright	Copyright (c) 2008-2012 FluxBB (http://fluxbb.org)
 * @license		http://www.gnu.org/licenses/gpl.html	GNU General Public License
 */

namespace fluxbb\Session;

use Laravel\Session\Drivers\Database,
	Laravel\Session\Drivers\Sweeper,
	Laravel\Database\Connection,
	Laravel\Request,
	fluxbb\Models\Config;

class Driver extends Database implements Sweeper
{

	/**
	 * Load a session from storage by a given ID.
	 *
	 * If no session is found for the ID, null will be returned.
	 *
	 * @param  string  $id
	 * @return array
	 */
	public function load($id)
	{
		$session = $this->table()->find($id);

		if (!is_null($session))
		{
			return array(
				'id'            => $session->id,
				'last_activity' => $session->last_visit,
				'data'          => unserialize($session->data)
			);
		}
	}

	/**
	 * Save a given session to storage.
	 *
	 * @param  array  $session
	 * @param  array  $config
	 * @param  bool   $exists
	 * @return void
	 */
	public function save($session, $config, $exists)
	{
		if ($exists)
		{
			$this->table()->where('id', '=', $session['id'])->update(array(
				'last_visit'	=> $session['last_activity'],
				'last_ip'		=> Request::ip(),
				'data'          => serialize($session['data']),
			));
		}
		else
		{
			$this->table()->insert(array(
				'id'            => $session['id'],
				'user_id'		=> 1,
				'created'		=> Request::time(),
				'last_visit'	=> $session['last_activity'],
				'last_ip'		=> Request::ip(),
				'data'          => serialize($session['data']),
			));			
		}
	}

	/**
	 * Delete a session from storage by a given ID.
	 *
	 * @param  string  $id
	 * @return void
	 */
	public function delete($id)
	{
		$this->table()->delete($id);
	}

	/**
	 * Delete all expired sessions from persistent storage.
	 *
	 * @param  int   $expiration
	 * @return void
	 */
	public function sweep($expiration)
	{
		$expiration = Request::time() - Config::get('o_timeout_online');
		
		// Fetch all sessions that are older than o_timeout_online
		$result = $this->table()->where('user_id', '!=', 1)->where('last_visit', '<', $expiration)->get();

		$delete_ids = array();
		foreach ($result as $cur_session)
		{
			$delete_ids[] = $cur_session->id;
			$result = $this->connection->table('users')->where_id($cur_session->user_id)->update(array('last_visit' => $cur_session->last_visit));
		}

		if (!empty($delete_ids))
		{
			$this->table()->where_in('id', $delete_ids)->or_where('last_visit', '<', $expiration)->delete();
		}
	}

	/**
	 * Get a session database query.
	 *
	 * @return Query
	 */
	private function table()
	{
		return $this->connection->table('sessions');		
	}
	
}