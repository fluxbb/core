<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\Category;

class SearchPage extends Action
{
    protected function run()
    {
        $categories = Category::all();

        $this->data['categories'] = $categories;
    }
}
