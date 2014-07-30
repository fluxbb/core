<?php

namespace FluxBB\Actions;

use FluxBB\Models\User;
use FluxBB\Models\Category;

class Home extends Page
{
    protected $viewName = 'fluxbb::index';


    protected function run()
    {
        $group_id = User::current()->group_id;

        $categories = Category::allForGroup($group_id);

        $this->data['categories'] = $categories;
    }
}
