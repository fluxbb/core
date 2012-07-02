<?php namespace fluxbb;

class Topic extends \FluxBB_BaseModel
{

	public function posts()
	{
		return $this->has_many('fluxbb\\Post');
	}

	public function forum()
	{
		return $this->belongs_to('fluxbb\\Forum');
	}

	public function subscription()
	{
		// TODO: Condition for current user
		return $this->has_one('fluxbb\\TopicSubscription');
	}

	public function num_replies()
	{
		return is_null($this->moved_to) ? $this->num_replies : '-';
	}

	public function num_views()
	{
		return is_null($this->moved_to) ? $this->num_views : '-';
	}

	public function is_user_subscribed()
	{
		// TODO: If logged out: return false!
		return !is_null($this->subscription);
	}

	public function was_moved()
	{
		return !is_null($this->moved_to);
	}

}
