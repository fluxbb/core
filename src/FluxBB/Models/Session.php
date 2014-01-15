<?php

namespace FluxBB\Models;

class Session extends Base
{

	protected $table = 'sessions';

	public function user()
	{
		return $this->belongsTo('FluxBB\Models\User', 'user_id');
	}

}
