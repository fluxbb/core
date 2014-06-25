<?php

namespace FluxBB\Controllers;

use FluxBB\Models\Category;
use FluxBB\Models\Post;
use FluxBB\Models\Topic;
use FluxBB\Models\User;
use App;
use Paginator;
use View;

class HomeController extends BaseController
{
    public function getIndex()
    {
        // TODO: Get list of forums and topics with new posts since last visit & get all topics that were marked as read

        // Fetch the categories and forums
        $categories = Category::allForGroup(User::current()->group_id);

        return View::make('fluxbb::index')->with('categories', $categories);
    }
}
