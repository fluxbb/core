<?php

namespace FluxBB\Web\Controllers;

use FluxBB\Server\Exception\Exception;
use FluxBB\Web\Controller;

class ForumController extends Controller
{
    public function index()
    {
        try {
            $this->setInput('slug', '/');

            return $this->category();
        } catch (Exception $e) {
            return $this->view('no_content');
        }
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
