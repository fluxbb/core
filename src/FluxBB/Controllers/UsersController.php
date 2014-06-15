<?php

namespace FluxBB\Controllers;

use FluxBB\Models\User;
use App;
use Input;
use View;
use Html;

class UsersController extends BaseController
{
    public function getProfile($id)
    {
        $user = User::find($id);
        $action = Input::get('action', 'essentials');

        if (is_null($user)) {
            App::abort(404);
        } elseif (User::current()->id != $id && !User::current()->isAdmin()) {
            $action = 'view';
        }

        // Only for display and avoid users leraning the sprintf function syntax for theming
        $user_infos = array(
                      'registered' => sprintf(trans('fluxbb::profile.registered_info'), HTML::format_time($user->registered, true, "Y-m-d")),
                      'last_post' => sprintf(trans('fluxbb::profile.last_post_info'), HTML::format_time($user->last_post)),
                      'last_visit' => sprintf(trans('fluxbb::profile.last_visit_info'), HTML::format_time($user->last_visit)),
                      'num_posts' => sprintf(trans('fluxbb::profile.posts_info'), $user->num_posts),
        );

        return View::make('fluxbb::user.profile.'.$action)
            ->with('action', $action)
            ->with('user', $user)
            ->with('user_infos', $user_infos);

    }

    public function postProfile($id, $action = 'essentials')
    {
        $user = User::find($id);
        // TODO: Add validation. This can probably wait until we restructure the profile.
        if ($action == 'essentials') {
            $user->username = Input::get('username', $user->username);
            $user->email = Input::get('email', $user->email);
            $user->timezone = Input::get('timezone', $user->timezone);
            $user->dst = Input::get('dst', $user->dst);
            $user->time_format = Input::get('time_format');
            $user->date_format = Input::get('date_format');
            $user->admin_note = Input::get('admin_note', $user->admin_note);
        } elseif ($action == 'personal') {
            $user->realname = Input::get('realname');
            $user->title = Input::get('title');
            $user->location = Input::get('location');
            $user->url = Input::get('url');
        } elseif ($action == 'personality') {
            $user->signature = Input::get('signature');
        } elseif ($action == 'display') {
        //This will give an error if not everything is set -> need to set defaults in database!
            $user->style = Input::get('style');
            $user->show_smilies = Input::get('show_smilies');
            $user->show_sig = Input::get('show_sig');
            $user->show_avatars = Input::get('show_avatars');
            $user->show_img = Input::get('show_img');
            $user->disp_topics = Input::get('disp_topics', $user->disp_topics);
            $user->disp_posts = Input::get('disp_posts', $user->disp_posts);
        } else { //if action == privacy
            //TODO
        }

        $user->save();
        return View::make('fluxbb::user.profile.'.$action)
                ->with('user', $user)
                ->with('admin', User::current()->isAdmin());
    }

    public function getList()
    {
        $users = User::paginate(20);

        return View::make('fluxbb::user.list')
            ->with('users', $users);
    }
}
