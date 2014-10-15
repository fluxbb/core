<?php

namespace FluxBB\Web\Controllers;

use FluxBB\Server\Exception\ValidationFailed;
use FluxBB\Web\Controller;

class ConversationController extends Controller
{
    public function createForm($slug)
    {
        $slug = preg_replace('/\/+/', '/', '/'.$slug.'/');

        $category = $this->execute('category', ['slug' => $slug])->getData()['category'];

        return $this->view('new_topic', compact('category'));
    }

    public function create($slug)
    {
        try {
            $slug = preg_replace('/\/+/', '/', '/'.$slug.'/');

            $this->execute('new_topic_handler', ['slug' => $slug]);

            /*$this->redirectTo(
                new Request('conversation', ['id' => $conversation->id]),
                trans('fluxbb::topic.topic_added')
            );*/
        } catch (ValidationFailed $e) {
            // $this->onErrorRedirectTo(new Request('new_topic', ['slug' => $category->slug]));
        }
    }
}
