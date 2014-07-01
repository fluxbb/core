<?php

namespace FluxBB\Actions;

use Symfony\Component\HttpFoundation\Request;
use FluxBB\Models\User;

class ProfilePage extends Page
{
    protected $viewName = 'fluxbb::user.profile.view';


    protected function handleRequest(Request $request)
    {
        $uid = \Route::input('id');

        $user = User::findOrFail($uid);

        $this->data['user'] = $user;
    }
}
