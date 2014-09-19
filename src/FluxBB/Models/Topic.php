<?php

namespace FluxBB\Models;

use Auth;

class Topic extends Base
{
    protected $table = 'topics';

    protected $fillable = array('poster', 'subject', 'posted', 'last_post', 'last_poster', 'sticky', 'forum_id');

    protected $dates = array('last_post');


    public function posts()
    {
        return $this->hasMany('FluxBB\\Models\\Post')
                    ->orderBy('id');
    }

    public function lastPost()
    {
        return $this->belongsTo('FluxBB\\Models\\Post', 'last_post_id');
    }

    public function forum()
    {
        return $this->belongsTo('FluxBB\\Models\\Forum');
    }

    public function subscribers()
    {
        return $this->belongsToMany('FluxBB\Models\User', 'topic_subscriptions', 'topic_id', 'user_id');
    }

    public function addReply(Post $post)
    {
        $post->topic()->associate($this);
        $this->lastPost()->associate($post);
        $this->forum->lastPost()->associate($post);
    }

    public function getNumReplies()
    {
        return is_null($this->moved_to) ? $this->num_replies : '-';
    }

    public function getNumViews()
    {
        return is_null($this->moved_to) ? $this->num_views : '-';
    }

    public function isUserSubscribed()
    {
        return Auth::check() && !is_null($this->subscription);
    }

    public function wasMoved()
    {
        return !is_null($this->moved_to);
    }

    public function subscribe($subscribe = true)
    {
        // To subscribe or not to subscribe, that ...
        if (!Config::enabled('o_topic_subscriptions') || !Auth::check()) {
            return false;
        }

        if ($subscribe && !$this->isUserSubscribed()) {
            $this->subscription()->insert(array('user_id' => User::current()->id));
        } elseif (!$subscribe && $this->isUserSubscribed()) {
            $this->subscription()->delete();
        }
    }

    public function unsubscribe()
    {
        return $this->subscribe(false);
    }
}
