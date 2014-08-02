<?php

namespace FluxBB\Actions;

use FluxBB\Models\User;

class UsersPage extends Base
{
    protected function run()
    {
        $users = User::paginate(20);

        $this->data['users'] = $users;
    }
}
