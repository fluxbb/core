<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\User;

class UsersPage extends Action
{
    protected function run()
    {
        $users = User::paginate(20);

        $this->data['users'] = $users;
    }
}
