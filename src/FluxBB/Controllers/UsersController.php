<?php

namespace FluxBB\Controllers;

use FluxBB\Models\User;
use App;
use Input;
use View;

class UsersController extends BaseController
{

    public function get_profile($id)
    {
        $user = User::find($id);
        $action = Input::get('action', 'essentials');

        if (is_null($user)) {
            App::abort(404);
        } else if (User::current()->id != $id && !User::current()->isAdmin()) {
            $action = 'view';
        }

        return View::make('fluxbb::user.profile.'.$action)
            ->with('action', $action)
            ->with('user', $user);

    }

    public function post_profile($id, $action = 'essentials')
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
        } else if ($action == 'personal') {
            $user->realname = Input::get('realname');
            $user->title = Input::get('title');
            $user->location = Input::get('location');
            $user->url = Input::get('url');
        } else if ($action == 'personality') {
            $user->signature = Input::get('signature');
        } else if ($action == 'display') {
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

    public function get_list()
    {
        $users = User::paginate(20);

        return View::make('fluxbb::user.list')
            ->with('users', $users);
    }

}
