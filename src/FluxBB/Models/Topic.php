<?php

namespace FluxBB\Models;

use Auth;

class Topic extends Base
{
    protected $table = 'topics';

    protected $fillable = array('poster', 'subject', 'posted', 'last_post', 'last_poster', 'sticky', 'forum_id');


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

    public function subscription()
    {
        return $this->hasOne('FluxBB\\Models\\TopicSubscription');
    //		->where('user_id', '=', User::current()->id);
    }

    public function addReply(Post $post)
    {
        $post->topic()->associate($this);
        $this->lastPost()->associate($post);
        $this->forum->lastPost()->associate($post);

        $this->num_replies += 1;
        $this->forum->num_posts += 1;
    }

    public function numReplies()
    {
        return is_null($this->moved_to) ? $this->num_replies : '-';
    }

    public function numViews()
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
