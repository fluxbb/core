<?php

namespace FluxBB\Controllers;

use FluxBB\Models\Post;
use FluxBB\Models\Topic;
use FluxBB\Repositories\Topics;
use FluxBB\Services\CreateReply;
use FluxBB\Services\CreateReplyObserver;
use Illuminate\Support\MessageBag;
use Input;
use Redirect;

class PostsController extends BaseController implements
	CreateReplyObserver
{

	public function postReply($tid)
	{
		$topic = $this->topics->find($tid); // TODO: 404?

		$service = new CreateReply($this, $this->topics);
		return $service->createReply(array(
			'message'	=> Input::get('req_message'),
		));
	}

	public function replyCreated(Post $post)
	{
		return Redirect::route('viewpost', array('id' => $post->id));
	}

	public function replyValidationFailed(Topic $topic, MessageBag $errors)
	{
		return Redirect::route('posting@reply', array($topic->id))
		               ->withInput()
		               ->withErrors($errors);
	}

}
