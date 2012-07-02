<?php namespace fluxbb;

class Forum extends \FluxBB_BaseModel
{

	public function topics()
	{
		return $this->has_many('fluxbb\\Topic');
	}

	public function subscriptions()
	{
		return $this->has_many('fluxbb\\ForumSubscription');
	}

	public function subscription()
	{
		// TODO: Condition for current user
		return $this->has_one('fluxbb\\ForumSubscription');
	}

	public function perms()
	{
		// TODO: has_one() with group condition?
		return $this->has_many('fluxbb\\ForumPerms');
	}

	public function num_topics()
	{
		return $this->redirect_url == '' ? $this->num_topics : '-';
	}

	public function num_posts()
	{
		return $this->redirect_url == '' ? $this->num_posts : '-';
	}

	public function is_user_subscribed()
	{
		// TODO: If logged out: return false!
		return !is_null($this->subscription);
	}

}
