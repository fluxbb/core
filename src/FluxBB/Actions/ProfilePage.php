<?php

namespace FluxBB\Actions;

use FluxBB\Models\User;

class ProfilePage extends Base
{
    protected function run()
    {
        $uid = $this->request->get('id');

        $user = User::findOrFail($uid);

        $this->data['user'] = $user;
    }
}
