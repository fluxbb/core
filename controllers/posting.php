<?php
/**
 * FluxBB - fast, light, user-friendly PHP forum software
 * Copyright (C) 2008-2012 FluxBB.org
 * based on code by Rickard Andersson copyright (C) 2002-2008 PunBB
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public license for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category	FluxBB
 * @package		Core
 * @copyright	Copyright (c) 2008-2012 FluxBB (http://fluxbb.org)
 * @license		http://www.gnu.org/licenses/gpl.html	GNU General Public License
 */

use fluxbb\Controllers\Base,
	fluxbb\Models\Post,
	fluxbb\Models\Topic,
	fluxbb\Models\Forum,
	fluxbb\Models\User,
	fluxbb\Models\Config;

class FluxBB_Posting_Controller extends Base
{

	public function get_reply($tid)
	{
		$topic = Topic::with(array(
			'forum',
			'forum.perms',
		))
		->where_id($tid)
		->first();

		if ($topic === NULL)
		{
			return Event::first('404');
		}

		return View::make("fluxbb::posting.post")
			->with('topic', $topic)
			->with('action', __('fluxbb::post.post_a_reply'));
	}

	public function put_reply($tid)
	{
		$topic = Topic::with(array(
			'forum',
			'forum.perms',
		))
		->where_id($tid)
		->first();

		if ($topic === NULL)
		{
			return Event::first('404');
		}

		// TODO: Flood protection
		$rules = array(
			// TODO: PUN_MAX_POSTSIZE, censor, All caps message
			'req_message'		=> 'required',
		);
		// TODO: More validation

		if (!Auth::check())
		{
			if (Config::enabled('p_force_guest_email') || Input::get('email') != '')
			{
				$rules['req_email']	= 'required|email';
			}

			// TODO: banned email
		}

		$validation = Validator::make(Input::all(), $rules);
		if ($validation->fails())
		{
			return Redirect::to_action('fluxbb::posting@reply', array($tid))->with_input()->with_errors($validation);
		}

		$post_data = array(
			'poster'			=> User::current()->username,
			'poster_id'			=> User::current()->id,
			'poster_ip'			=> Request::ip(),
			'message'			=> Input::get('req_message'),
			'hide_smilies'		=> Input::get('hide_smilies') ? '1' : '0',
			'posted'			=> Request::time(),
			'topic_id'			=> $tid
		);

		if (!Auth::check())
		{
			$post_data['poster'] = Input::get('req_username');
			$post_data['poster_email'] = Config::enabled('p_force_guest_email') ? Input::get('req_email') : Input::get('email');
		}

		// Insert the new post
		$post = Post::create($post_data);

		// To subscribe or not to subscribe
		$topic->subscribe(Input::get('subscribe'));

		// TODO: update_forum(), update_search_index();

		// If the posting user is logged in, increment his/her post count
		$user = User::current();
		if (Auth::check())
		{
			$user->num_posts += 1;
			$user->last_post = Request::time();
			$user->save();
			// TODO: Promote this user to a new group if enabled
		}
		else
		{
			$user->online()->update(array('last_post' => Request::time()));
		}


		return Redirect::to_action('fluxbb::post', array($post->id))->with('message', __('fluxbb::post.post_added'));
	}

	public function get_topic($fid)
	{
		$forum = Forum::with(array(
			'perms',
		))
		->where_id($fid)
		->first();

		if ($forum === NULL)
		{
			return Event::first('404');
		}

		return View::make("fluxbb::posting.post")
			->with('forum', $forum)
			->with('action', __('fluxbb::forum.post_topic'));
	}

	public function put_topic($fid)
	{
		$forum = Forum::with(array(
			'perms',
		))
		->where_id($fid)
		->first();

		if ($forum === NULL)
		{
			return Event::first('404');
		}

		// TODO: Flood protection
		$rules = array(
			// TODO: censored words, All caps subject
			'req_subject'	=> 'required|max:70',
			// TODO: PUN_MAX_POSTSIZE, censor, All caps message
			'req_message'	=> 'required',
		);
		// TODO: More validation

		if (!Auth::check())
		{
			if (Config::enabled('p_force_guest_email') || Input::get('email') != '')
			{
				$rules['req_email']	= 'required|email';
			}

			// TODO: banned email
		}

		$validation = Validator::make(Input::all(), $rules);
		if ($validation->fails())
		{
			return Redirect::to_action('fluxbb::posting@topic', array($fid))->with_input()->with_errors($validation);
		}

		$topic_data = array(
			'poster'			=> User::current()->username,
			'subject'			=> Input::get('req_subject'),
			'posted'			=> Request::time(),
			'last_post'			=> Request::time(),
			'last_poster'		=> User::current()->username,
			'sticky'			=> Input::get('stick_topic') ? '1' : '0',
			'forum_id'			=> $fid,
		);

		if (!Auth::check())
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
			'poster_ip'			=> Request::ip(),
			'message'			=> Input::get('req_message'),
			'hide_smilies'		=> Input::get('hide_smilies') ? '1' : '0',
			'posted'			=> Request::time(),
			'topic_id'			=> $topic->id
		);

		if (!Auth::check())
		{
			$post_data['poster'] = Input::get('req_username');
			$post_data['poster_email'] = Config::enabled('p_force_guest_email') ? Input::get('req_email') : Input::get('email');
		}

		// Create the post ("topic post")
		$post = Post::create($post_data);

		// Update the topic with last_post_id
		$topic->last_post_id = $topic->first_post_id = $post->id;
		$topic->save();

		// TODO: update_forum(), update_search_index();

		// If the posting user is logged in, increment his/her post count
		$user = User::current();
		if (Auth::check())
		{
			$user->num_posts += 1;
			$user->last_post = Request::time();
			$user->save();
			// TODO: Promote this user to a new group if enabled
		}
		else
		{
			$user->online()->update(array('last_post' => Request::time()));
		}

		return Redirect::to_action('fluxbb::topic', array($topic->id))->with('message', __('fluxbb::topic.topic_added'));
	}
}
