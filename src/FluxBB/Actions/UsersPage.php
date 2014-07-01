<?php

namespace FluxBB\Actions;

use FluxBB\Models\User;
use Symfony\Component\HttpFoundation\Request;

class UsersPage extends Page
{
    protected $viewName = 'fluxbb::user.list';


    protected function handleRequest(Request $request)
    {
        $users = User::paginate(20);

        $this->data['users'] = $users;
    }
}
