<?php namespace fluxbb;

class Online extends \FluxBB_BaseModel
{

	public static $table = 'online';

	// FIXME: Unique is combination of user_id <-> ident, not this!!!
	public static $key = 'ident';

}
