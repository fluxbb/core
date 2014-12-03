<?php

namespace FluxBB\Web\Controllers;

use FluxBB\Server\Exception\ValidationFailed;
use FluxBB\Web\Controller;

class ConversationController extends Controller
{
    public function createForm()
    {
        $data = $this->execute('get.category');

        return $this->view('new_topic', $data);
    }

    public function create()
    {
        try {
            $result = $this->execute('create.topic');
            $conversation = $result['conversation'];

            return $this->redirectTo('conversation', ['id' => $conversation->id])
                        ->withMessage(trans('fluxbb::topic.topic_added'));
        } catch (ValidationFailed $e) {
            return $this->redirectTo('new_topic')
                        ->withInput()
                        ->withErrors($e);
        }
    }

    public function subscribe()
    {
        $this->execute('subscribe.topic');

        return $this->redirectTo('viewtopic', $this->input)
                    ->withMessage('Subscription added.');
    }

    public function unsubscribe()
    {
        $this->execute('unsubscribe.topic');

        return $this->redirectTo('viewtopic', $this->input)
                    ->withMessage('Subscription removed.');
    }
}
