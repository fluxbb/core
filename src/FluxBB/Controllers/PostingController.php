<?php

namespace FluxBB\Controllers;

use FluxBB\Models\Post;
use FluxBB\Models\Topic;
use FluxBB\Models\Forum;
use FluxBB\Models\User;
use FluxBB\Models\Config;
use App;
use Auth;
use Input;
use Redirect;
use Request;
use Validator;
use View;

class PostingController extends BaseController
{
    public function postEdit($pid)
    {
        $post = Post::with('author', 'topic')
            ->where('id', $pid)
            ->first();

        if (is_null($post)) {
            App::abort(404);
        }

        // Check is the user is the author, or a moderator
        if ($post->author->id != Auth::user()->id && !Auth::user()->isAdmMod()) {
             App::abort(404);
        }

        // TODO: Flood protection
        $rules = array(
            // TODO: PUN_MAX_POSTSIZE, All caps message
            'req_message'       => 'required',
        );

        // if the post if the first of the topic, the title is editable too
        if ($post->isFirstPostOfTopic()) {
            $rules['req_subject'] = 'required|max:70';
        }

        $validation = Validator::make(Input::get(), $rules);
        if ($validation->fails()) {
            return Redirect::route('posting@edit', array($pid))->withInput()->withErrors($validation);
        }

        $post_data = array(
            'message'           => Input::get('req_message'),
            'hide_smilies'      => Input::has('hide_smilies') ? '1' : '0',
            'edited'            => time(), // TODO: Use SERVER_TIME
            'edited_by'         => User::current()->username
        );

        // update the post
        $post->update($post_data);

        // update the topic
        if ($post->isFirstPostOfTopic()) {
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
