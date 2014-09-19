<?php

namespace FluxBB\Models;

class Post extends Base
{
    protected $table = 'posts';

    protected $fillable = array('poster', 'poster_id', 'poster_ip', 'message', 'hide_smilies', 'posted', 'topic_id', 'edited', 'edited_by');

    protected $dates = array('posted');


    public function topic()
    {
        return $this->belongsTo('FluxBB\\Models\\Topic');
    }

    public function author()
    {
        return $this->belongsTo('FluxBB\\Models\\User', 'poster_id');
    }

    public function message()
    {
        return $this->message;
    }

    /**
     * Check if the post if the first post of it's topic
     *
     * return boolean true if it is the first post of the topic, else false
     */
    public function isFirstPostOfTopic()
    {
        return $this->id == $this->topic->first_post_id;
    }

    public function wasEdited()
    {
        return !empty($this->edited);
    }
}
