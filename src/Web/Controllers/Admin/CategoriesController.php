<?php

namespace FluxBB\Web\Controllers\Admin;

use FluxBB\Web\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        // TODO: Retrieve
        $categories = null;

        return $this->view('admin.categories.index', compact('categories'));
    }
}
