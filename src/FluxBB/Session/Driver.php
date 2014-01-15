<?php

namespace FluxBB\Session;

use Laravel\Auth,
	Laravel\Session,
	Laravel\Session\Drivers\Database,
	Laravel\Session\Drivers\Sweeper,
	Laravel\Request,
	fluxbb\Models\Config,
	fluxbb\Models\User;

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

		// Make sure logged-in users have no more than ten sessions alive
		if (Auth::check())
		{
			$uid = User::current()->id;

			$session_ids = $this->table()->where_user_id($uid)->order_by('last_visit', 'desc')->lists('id');
			$prune_ids = array_slice($session_ids, 10);

			$delete_ids = array_merge($delete_ids, $prune_ids);
		}

		if (!empty($delete_ids))
		{
			$this->table()->where_in('id', $delete_ids)->or_where('last_visit', '<', $expiration)->delete();
		}
	}

	/**
	 * Create a fresh session array with a unique ID.
	 *
	 * @return array
	 */
	public function fresh()
	{
		// Fetch a guest session with the same IP address
		$old_guest_session = $this->table()
			->where_user_id(1)
			->where_last_ip(Request::ip())
			->first();
		
		// We will simply generate an empty session payload array, using an ID
		// that is either not currently assigned to any existing session or
		// that belongs to a guest with the same IP address.
		if (is_null($old_guest_session))
		{
			$id = $this->id();
		}
		else
		{
			$id = $old_guest_session->id;
			Session::instance()->exists = true;
		}

		return array('id' => $id, 'data' => array(
			':new:' => array(),
			':old:' => array(),
		));
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