<?php

namespace FluxBB\Controllers;

use FluxBB\Models\Post,
	FluxBB\Models\Topic,
	FluxBB\Models\Forum,
	FluxBB\Models\User,
	FluxBB\Models\Config;
use App;
use Auth;
use Input;
use Redirect;
use Request;
use Validator;
use View;

class PostingController extends BaseController
{

	public function get_reply($tid)
	{
		$topic = Topic::with('forum.perms')
			->where('id', '=', $tid)
			->first();

		if (is_null($topic))
		{
			App::abort(404);
		}

		return View::make('fluxbb::posting.post')
			->with('topic', $topic)
			->with('action', trans('fluxbb::post.post_a_reply'));
	}

	public function post_reply($tid)
	{
		$topic = Topic::with('forum.perms')
			->where('id', '=', $tid)
			->first();

		if (is_null($topic))
		{
			App::abort(404);
		}

		// TODO: Flood protection
		$rules = array(
			// TODO: PUN_MAX_POSTSIZE, censor, All caps message
			'req_message'		=> 'required',
		);
		// TODO: More validation

		if (Auth::guest())
		{
			if (Config::enabled('p_force_guest_email') || Input::get('email') != '')
			{
				$rules['req_email']	= 'required|email';
			}

			// TODO: banned email
		}

		$validation = Validator::make(Input::get(), $rules);
		if ($validation->fails())
		{
			return Redirect::route('posting@reply', array($tid))->withInput()->withErrors($validation);
		}

		$post_data = array(
			'poster'			=> User::current()->username,
			'poster_id'			=> User::current()->id,
			'poster_ip'			=> Request::getClientIp(),
			'message'			=> Input::get('req_message'),
			'hide_smilies'		=> Input::has('hide_smilies') ? '1' : '0',
			'posted'			=> time(), // TODO: Use SERVER_TIME
			'topic_id'			=> $tid
		);

		if (Auth::guest())
		{
			$post_data['poster'] = Input::get('req_username');
			$post_data['poster_email'] = Config::enabled('p_force_guest_email') ? Input::get('req_email') : Input::get('email');
		}

		// Insert the new post
		$post = Post::create($post_data);

		// To subscribe or not to subscribe
		$topic->subscribe(Input::has('subscribe'));

		// Update topic
		$topic->num_replies += 1;
		$topic->last_post = time(); // TODO: REQUEST_TIME
		$topic->last_post_id = $post->id;
		$topic->last_poster = $post_data['poster'];
		$topic->save();

		// Update forum (maybe $forum->update_forum() ?)
		$forum = $topic->forum;
		$forum->num_posts += 1;
		$forum->last_post = $topic->last_post;
		$forum->last_post_id = $topic->last_post_id;
		$forum->last_poster = $topic->last_poster;
		$forum->save();

		// TODO: update_search_index();

		// If the posting user is logged in, increment his/her post count
		$user = User::current();
		if (Auth::check())
		{
			$user->num_posts += 1;
			$user->last_post = time(); // TODO: Request_time
			$user->save();
			// TODO: Promote this user to a new group if enabled
		}
		else
		{
			// TODO: Session!
			//$user->online()->update(array('last_post' => time())); // TODO: REquest_time
		}


		return Redirect::route('viewpost', array('id' => $post->id))->with('message', trans('fluxbb::post.post_added'));
	}

	public function get_topic($fid)
	{
		$forum = Forum::with('perms')
			->where('id', $fid)
			->first();

		if (is_null($forum))
		{
			App::abort(404);
		}

		return View::make('fluxbb::posting.post')
			->with('forum', $forum)
			->with('action', trans('fluxbb::forum.post_topic'));
	}

	public function post_topic($fid)
	{
		$forum = Forum::with('perms')
			->where('id', '=', $fid)
			->first();

		if (is_null($forum))
		{
			App::abort(404);
		}

		// TODO: Flood protection
		$rules = array(
			// TODO: censored words, All caps subject
			'req_subject'	=> 'required|max:70',
			// TODO: PUN_MAX_POSTSIZE, censor, All caps message
			'req_message'	=> 'required',
		);
		// TODO: More validation

		if (Auth::guest())
		{
			if (Config::enabled('p_force_guest_email') || Input::get('email') != '')
			{
				$rules['req_email']	= 'required|email';
			}

			// TODO: banned email
		}

		$validation = Validator::make(Input::get(), $rules);
		if ($validation->fails())
		{
			return Redirect::route('new_topic', array('id' => $fid))
				->withInput()
				->withErrors($validation);
		}

		$topic_data = array(
			'poster'			=> User::current()->username,
			'subject'			=> Input::get('req_subject'),
			'posted'			=> time(),
			'last_post'			=> time(), // TODO: Use REQUEST_TIME!
			'last_poster'		=> User::current()->username,
			'sticky'			=> Input::has('stick_topic') ? '1' : '0',
			'forum_id'			=> $fid,
		);

		if (Auth::guest())
		{
			$topic_data['poster'] = $topic_data['last_poster'] = Input::get('req_username');
		}

		// Create the topic
		$topic = Topic::create($topic_data);

		// To subscribe or not to subscribe
		$topic->subscribe(Input::get('subscribe'));

		$post_data = array(
			'poster'			=> User::current()->username,
			'poster_id'			=> User::current()->id,
			'poster_ip'			=> '127.0.0.1', // TODO: Get IP from request
			'message'			=> Input::get('req_message'),
			'hide_smilies'		=> Input::has('hide_smilies') ? '1' : '0',
			'posted'			=> time(), // TODO: Use REQUEST_TIME
			'topic_id'			=> $topic->id
		);

		if (Auth::guest())
		{
			$post_data['poster'] = Input::get('req_username');
			$post_data['poster_email'] = Config::enabled('p_force_guest_email') ? Input::get('req_email') : Input::get('email');
		}

		// Create the post ("topic post")
		$post = Post::create($post_data);

		// Update the topic with last_post_id
		$topic->last_post_id = $topic->first_post_id = $post->id;
		$topic->save();

		// Update forum (maybe $forum->update_forum() ?)
		$forum->num_posts += 1;
		$forum->num_topics += 1;
		$forum->last_post = $topic->last_post;
		$forum->last_post_id = $topic->last_post_id;
		$forum->last_poster = $topic->last_poster;
		$forum->save();

		// TODO: update_search_index();
		$user = User::current();

		// If the posting user is logged in, increment his/her post count
		if (Auth::check())
		{
			$user->num_posts += 1;
			$user->last_post = time(); // TODO: Use request time
			$user->save();
			// TODO: Promote this user to a new group if enabled
		}
		else
		{
			// TODO: Session!
			//$this->session->put('last_post', time()); // TODO: Use Request time
		}

		return Redirect::route('viewtopic', array('id' => $topic->id))
			->with('message', trans('fluxbb::topic.topic_added'));
	}

	public function get_edit($pid)
	{
		$post = Post::with('author', 'topic')
			->where('id', $pid)
			->first();

		if (is_null($post))
		{
			App::abort(404);
		}

		// Check is the user is the author, or a moderator
		if ($post->author->id != Auth::user()->id && !Auth::user()->isAdmMod())
		{
			 App::abort(404);
		}

		return View::make('fluxbb::posting.post')
			->with('post', $post)
			->with('action', trans('fluxbb::forum.edit_post'));
	}

	public function post_edit($pid)
	{
		$post = Post::with('author', 'topic')
			->where('id', $pid)
			->first();

		if (is_null($post))
		{
			App::abort(404);
		}

		// Check is the user is the author, or a moderator
		if ($post->author->id != Auth::user()->id && !Auth::user()->isAdmMod())
		{
			 App::abort(404);
		}

		// TODO: Flood protection
		$rules = array(
			// TODO: PUN_MAX_POSTSIZE, censor, All caps message
			'req_message'		=> 'required',
		);

		// if the post if the first of the topic, the title is editable too
		if ($post->isFirstPostOfTopic())
		{
			$rules['req_subject'] = 'required|max:70';
		}

		$validation = Validator::make(Input::get(), $rules);
		if ($validation->fails())
		{
			return Redirect::route('posting@edit', array($pid))->withInput()->withErrors($validation);
		}

		$post_data = array(
			'message'			=> Input::get('req_message'),
			'hide_smilies'		=> Input::has('hide_smilies') ? '1' : '0',
			'edited'			=> time(), // TODO: Use SERVER_TIME
			'edited_by'			=> User::current()->username
		);

		// update the post
		$post->update($post_data);

		// update the topic
		if ($post->isFirstPostOfTopic())
		{
			$post->topic->update(array(
				'subject' => Input::get('req_subject')
			));
		}

		// To subscribe or not to subscribe
		$post->topic->subscribe(Input::has('subscribe'));

		// TODO: update_search_index();

		return Redirect::route('viewpost', array('id' => $post->id))->with('message', trans('fluxbb::post.edit_redirect'));
	}
}
