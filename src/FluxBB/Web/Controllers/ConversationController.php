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

            // TODO: id => conversation->id
            return $this->redirect('conversation', trans('fluxbb::topic.topic_added'));
        } catch (ValidationFailed $e) {
            // TODO: slug
            return $this->redirect('new_topic');
        }
    }

    public function subscribe($id)
    {
        $this->execute('topic_subscribe', ['id' => $id]);

        // TODO: Topic ID
        return $this->redirect('viewtopic', 'Subscription added.');
    }

    public function unsubscribe($id)
    {
        $this->execute('topic_unsubscribe', ['id' => $id]);

        // TODO: Topic ID
        return $this->redirect('viewtopic', 'Subscription removed.');
    }
}
