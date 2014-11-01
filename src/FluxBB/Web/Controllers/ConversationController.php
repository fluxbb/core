<?php

namespace FluxBB\Web\Controllers;

use FluxBB\Server\Exception\ValidationFailed;
use FluxBB\Web\Controller;

class ConversationController extends Controller
{
    public function createForm()
    {
        $category = $this->execute('category')->getData()['category'];

        return $this->view('new_topic', compact('category'));
    }

    public function create()
    {
        try {
            $this->execute('new_topic_handler');

            // TODO: id => conversation->id
            return $this->redirectTo('conversation')
                        ->withMessage(trans('fluxbb::topic.topic_added'));
        } catch (ValidationFailed $e) {
            // TODO: slug
            return $this->redirectTo('new_topic');
        }
    }

    public function subscribe()
    {
        $this->execute('topic_subscribe');

        // TODO: Topic ID
        return $this->redirectTo('viewtopic')
                    ->withMessage('Subscription added.');
    }

    public function unsubscribe()
    {
        $this->execute('topic_unsubscribe');

        // TODO: Topic ID
        return $this->redirectTo('viewtopic')
                    ->withMessage('Subscription removed.');
    }
}
