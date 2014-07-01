<?php

namespace FluxBB\Actions;

use FluxBB\Models\Category;
use Symfony\Component\HttpFoundation\Request;

class SearchPage extends Page
{
    protected $viewName = 'fluxbb::search.index';


    protected function handleRequest(Request $request)
    {
        $categories = Category::all();

        $this->data['categories'] = $categories;
    }
}
