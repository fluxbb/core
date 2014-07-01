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
}
