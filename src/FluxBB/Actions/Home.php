<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\User;
use FluxBB\Models\Category;

class Home extends Action
{
    protected function run()
    {
        $group_id = User::current()->group_id;

        $categories = Category::allForGroup($group_id);

        $this->data['categories'] = $categories;
    }
}
