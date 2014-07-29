<?php

namespace FluxBB\Models;

use Illuminate\Auth\UserInterface;
use Auth;
use Hash;
use Mail;

class User extends Base implements UserInterface
{
    protected $table = 'users';

    // TODO: Review
    protected $fillable = array(
        'username',
        'group_id',
        'password',
        'email',
        'email_setting',
        'timezone',
        'dst',
        'language',
        'style',
        'registration_ip',
        'last_visit',
    );

    const GUEST = 1;


    public function group()
    {
        return $this->belongsTo('FluxBB\Models\Group');
    }

    public function bans()
    {
        return $this->hasMany('FluxBB\Models\Ban');
    }

    public function posts()
    {
        return $this->hasMany('FluxBB\Models\Post', 'poster_id');
    }

    public function sessions()
    {
        return $this->hasMany('FluxBB\Models\Session', 'user_id');
    }


    public static function current()
    {
        static $current = null;

        if (Auth::guest()) {
            if (!isset($current)) {
                $current = new Guest;
            }

            return $current;
        }

        // We already have the logged in user's object
        return Auth::user();
    }

    public function guest()
    {
        return $this->id == static::GUEST;
    }

    public function isMember()
    {
        return !$this->guest();
    }

    // Obsolete. Will be replaced by proper ACL stuff.
    public function isAdmMod()
    {
        return $this->isAdmin() || $this->isModerator();
    }

    public function isAdmin()
    {
        return $this->group->isAdmin();
    }

    public function isModerator()
    {
        return $this->group->g_moderator == 1;
    }

    public function title()
    {
        static $ban_list;

        // If not already built in a previous call, build an array of lowercase banned usernames
        if (empty($ban_list)) {
            $ban_list = array();

            // FIXME: Retrieve $bans (former $pun_bans)
            $bans = array();
            foreach ($bans as $cur_ban) {
                $ban_list[] = strtolower($cur_ban['username']);
            }
        }

        // If the user has a custom title
        if ($this->title != '') {
            return $this->title;
        } elseif (in_array(strtolower($this->username), $ban_list)) { // If the user is banned
            return trans('Banned');
        } elseif ($this->group->g_user_title != '') { // If the user group has a default user title
            return $this->group->g_user_title;
        } elseif ($this->guest()) { // If the user is a guest
            return trans('Guest');
        } else { // If nothing else helps, we assign the default
            return trans('Member');
        }
    }

    public function getAvatarFile()
    {
        // TODO: We might want to cache this result
        $filetypes = array('jpg', 'gif', 'png');

        foreach ($filetypes as $cur_type) {
            // FIXME: Prepend base path for upload dir
            $path = '/'.$this->id.'.'.$cur_type;

            if (file_exists($path)) {
                return $path;
            }
        }

        return '';
    }

    public function hasAvatar()
    {
        return (bool) $this->getAvatarFile();
    }

    public function hasSignature()
    {
        return !empty($this->signature);
    }

    public function signature()
    {
        return $this->signature;
    }

    public function isOnline()
    {
        return isset($this->sessions);
    }

    public function hasUrl()
    {
        return !empty($this->url);
    }

    public function hasLocation()
    {
        return !empty($this->location);
    }

    public function hasAdminNote()
    {
        return !empty($this->admin_note);
    }

    public function canViewUsers()
    {
        return $this->group->g_view_users == 1;
    }

    public function dispTopics()
    {
        return $this->disp_topics ?: Config::get('o_disp_topics_default');
    }

    public function dispPosts()
    {
        return $this->disp_posts ?: Config::get('o_disp_posts_default');
    }

    protected function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
        // TODO: Maybe reset some attributes like confirmation code here?
    }


    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
    
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
