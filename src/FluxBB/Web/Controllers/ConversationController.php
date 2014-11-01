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
            $conversation = $this->execute('new_topic_handler')->getData()['conversation'];

            return $this->redirectTo('conversation', ['id' => $conversation->id])
                        ->withMessage(trans('fluxbb::topic.topic_added'));
        } catch (ValidationFailed $e) {
            // TODO: errors
            return $this->redirectTo('new_topic', $this->input);
        }
    }

    public function subscribe()
    {
        $this->execute('topic_subscribe');

        return $this->redirectTo('viewtopic', $this->input)
                    ->withMessage('Subscription added.');
    }

    public function unsubscribe()
    {
        $this->execute('topic_unsubscribe');

        return $this->redirectTo('viewtopic', $this->input)
                    ->withMessage('Subscription removed.');
    }
}
