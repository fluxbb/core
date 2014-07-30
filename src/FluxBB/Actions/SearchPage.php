<?php

namespace FluxBB\Actions;

use FluxBB\Models\Category;

class SearchPage extends Page
{
    protected $viewName = 'fluxbb::search.index';


    protected function run()
    {
        $categories = Category::all();

        $this->data['categories'] = $categories;
    }
}
