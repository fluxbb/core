<?php

namespace FluxBB\Services;

use FluxBB\Repositories\Topics;

class CreateReply
{

	protected $observer;
	protected $topics;

	public function __construct(CreateReplyObserver $observer, Topics $topics)
	{
		$this->observer = $observer;
		$this->topics = $topics;
	}

	public function createReply(array $data)
	{
		if (false)
		{
			return $this->observer->replyValidationFailed($topic, $errors);
		}
		
		return $this->observer->replyCreated($post);
	}

}
