<?php namespace fluxbb;

class Post extends \FluxBB_BaseModel
{

	public function topic()
	{
		return $this->belongs_to('fluxbb\\Topic');
	}

	public function poster()
	{
		return $this->belongs_to('fluxbb\\User', 'poster_id');
	}

	public function message()
	{
		// TODO: Apply parse_message() with $this->hide_smilies as parameter
		// TODO2: Actually, the parsing might have to be moved to another method, as that's presentation code
		return $this->message;
	}

	public function was_edited()
	{
		return !empty($this->edited);
	}

}
