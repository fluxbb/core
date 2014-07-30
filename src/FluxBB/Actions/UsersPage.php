<?php

namespace FluxBB\Actions;

use FluxBB\Models\User;

class UsersPage extends Page
{
    protected $viewName = 'fluxbb::user.list';


    protected function run()
    {
        $users = User::paginate(20);

        $this->data['users'] = $users;
    }
}
