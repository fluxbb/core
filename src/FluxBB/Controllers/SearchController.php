<?php

namespace FluxBB\Controllers;

use FluxBB\Models\Category;
use View;

class SearchController extends BaseController
{
    public function getIndex()
    {
        $categories = Category::all();
        return View::make('fluxbb::search.index')
                ->with('categories', $categories);
    }
}
