<?php

namespace FluxBB\Controllers;

use FluxBB\Models\Post;
use FluxBB\Repositories\Topics;
use FluxBB\Services\CreateReply;
use FluxBB\Services\CreateReplyObserver;
use Illuminate\Support\MessageBag;
use Auth;
use Input;
use Redirect;

class PostsController extends BaseController implements
	CreateReplyObserver
{

	public function postReply($tid)
	{
		$topic = $this->topics->find($tid); // TODO: 404?

		$service = new CreateReply($this, $this->topics);
		return $service->createReply($topic, Auth::user(), Input::get('req_message'));
	}

	public function replyCreated(Post $post)
	{
		return Redirect::route('viewpost', array('id' => $post->id));
	}

	public function replyValidationFailed(Post $post, MessageBag $errors)
	{
		return Redirect::route('posting@reply', array($post->topic_id))
		               ->withInput()
		               ->withErrors($errors);
	}

}
