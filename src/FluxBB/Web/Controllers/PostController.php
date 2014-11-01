<?php

namespace FluxBB\Web\Controllers;

use FluxBB\Server\Exception\ValidationFailed;
use FluxBB\Web\Controller;

class PostController extends Controller
{
    public function create()
    {
        try {
            $this->execute('reply_handler'); // TODO: param ID -> CONVERSATION for action

            return $this->redirect('viewpost')
                        ->withMessage(trans('fluxbb::post.post_added'));
            // TODO: id => post->id (post == result['data'])
        } catch (ValidationFailed $e) {
            return $this->redirect('conversation');
            // TODO: id => conversation
        }
    }

    public function editForm()
    {

    }

    public function edit()
    {
        try {
            $this->execute('post_edit_handler');

            return $this->redirect('viewpost')
                        ->withMessage(trans('fluxbb::post.edit_redirect'));
            // TODO: id => post->id
        } catch (ValidationFailed $e) {
            return $this->redirect('post_edit');
            // TODO: id => post->id
        }
    }

    public function reportForm()
    {
        //
    }

    public function report()
    {
        //
    }

    public function deleteForm()
    {
        //
    }

    public function delete()
    {
        //
    }
}
