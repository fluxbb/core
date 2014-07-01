<?php

namespace FluxBB\Actions;

use FluxBB\Models\User;
use FluxBB\Models\Category;
use Symfony\Component\HttpFoundation\Request;

class Home extends Page
{
    protected $viewName = 'fluxbb::index';


    protected function handleRequest(Request $request)
    {
        $group_id = User::current()->group_id;

        $categories = Category::allForGroup($group_id);

        $this->data['categories'] = $categories;
    }
}
