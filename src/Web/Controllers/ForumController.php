<?php

namespace FluxBB\Web\Controllers;

use FluxBB\Web\Controller;

class ForumController extends Controller
{
    public function index()
    {
        $this->setInput('slug', '/');

        return $this->category();
    }

    public function category()
    {
        $response = $this->execute('category');

        return $this->view('category', $response);
    }

    public function conversation()
    {
        $response = $this->execute('conversation');

        return $this->view('conversation', $response);
    }

    public function post($id)
    {
        //
    }
}
