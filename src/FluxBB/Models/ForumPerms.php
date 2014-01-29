<?php

namespace FluxBB\Models;

use Cache;

class ForumPerms extends Base
{

    protected $table = 'forum_perms';


    public function forum()
    {
        return $this->belongsTo('FluxBB\Models\Forum', 'forum_id');
    }

    public function group()
    {
        return $this->belongsTo('FluxBB\Models\Group', 'group_id');
    }


    public static function forumsForGroup($group_id)
    {
        return Cache::remember('fluxbb.forums_for_group.'.$group_id, 7 * 24 * 60, function() use($group_id) {
            $disallowed = ForumPerms::where('group_id', '=', $group_id)->where('read_forum', '=', 0)->lists('forum_id');
            $all_forum_ids = Forum::ids();
            return array_diff($all_forum_ids, $disallowed);
        });
    }

}
