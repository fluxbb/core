<?php

namespace FluxBB\Web\Controllers;

use FluxBB\Web\Controller;

class ForumController extends Controller
{
    public function index()
    {
        return $this->category('/');
    }

    public function category($slug)
    {
        $slug = preg_replace('/\/+/', '/', '/'.$slug.'/');

        $response = $this->execute('category', ['slug' => $slug]);

        return $this->view('category', $response->getData());
    }

    public function conversation($id)
    {
        $response = $this->execute('conversation', ['id' => $id]);

        return $this->view('conversation', $response->getData());
    }

    public function post($id)
    {
        //
    }
}
