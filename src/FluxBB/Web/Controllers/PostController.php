<?php

namespace FluxBB\Web\Controllers;

use FluxBB\Server\Exception\ValidationFailed;
use FluxBB\Web\Controller;

class PostController extends Controller
{
    public function create($conversation)
    {
        try {
            $this->execute('reply_handler', ['id' => $conversation]);

            return $this->redirect('viewpost', trans('fluxbb::post.post_added'));
            // TODO: id => post->id (post == result['data'])
        } catch (ValidationFailed $e) {
            return $this->redirect('conversation');
            // TODO: id => conversation
        }
    }

    public function editForm($id)
    {

    }

    public function edit($id)
    {
        try {
            $this->execute('post_edit_handler', ['id' => $id]);

            return $this->redirect('viewpost', trans('fluxbb::post.edit_redirect'));
            // TODO: id => post->id
        } catch (ValidationFailed $e) {
            return $this->redirect('post_edit');
            // TODO: id => post->id
        }
    }

    public function reportForm($id)
    {
        //
    }

    public function report($id)
    {
        //
    }

    public function deleteForm($id)
    {
        //
    }

    public function delete($id)
    {
        //
    }
}
