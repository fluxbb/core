<?php

namespace FluxBB\Actions;

use FluxBB\Models\Category;

class SearchPage extends Base
{
    protected function run()
    {
        $categories = Category::all();

        $this->data['categories'] = $categories;
    }
}
