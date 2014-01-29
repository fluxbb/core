<?php

namespace FluxBB\Models;

use Auth,
    Hash;

class Guest extends User
{

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);

        $this->id = 1;
        $this->group_id = 1;
    }

    public function guest()
    {
        return true;
    }

    public function isAdmin()
    {
        return false;
    }

    public function isModerator()
    {
        return false;
    }

    public function title()
    {
        return t('Guest');
    }

    public function getAvatarFile()
    {
        return '';
    }

    public function hasAvatar()
    {
        return false;
    }

    public function hasSignature()
    {
        return false;
    }

    public function isOnline()
    {
        return false;
    }

    public function hasUrl()
    {
        return false;
    }

    public function hasLocation()
    {
        return false;
    }

    public function hasAdminNote()
    {
        return false;
    }

    public function canViewUsers()
    {
        return $this->group->g_view_users == 1;
    }

    public function dispTopics()
    {
        return Config::get('o_disp_topics_default');
    }

    public function dispPosts()
    {
        return Config::get('o_disp_posts_default');
    }

}
