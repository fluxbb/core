<?php

namespace FluxBB\Actions;

use FluxBB\Models\User;

class ProfilePage extends Page
{
    protected $viewName = 'fluxbb::user.profile.view';


    protected function run()
    {
        $uid = $this->request->get('id');

        $user = User::findOrFail($uid);

        $this->data['user'] = $user;
    }
}
