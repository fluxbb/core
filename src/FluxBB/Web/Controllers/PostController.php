<?php

namespace FluxBB\Web\Controllers;

use FluxBB\Server\Exception\ValidationFailed;
use FluxBB\Web\Controller;

class PostController extends Controller
{
    public function create($conversation)
    {
        try {
            $result = $this->execute('reply_handler', ['id' => $conversation]);

            $this->redirect('viewpost', trans('fluxbb::post.post_added'));
            // TODO: id => post->id (post == result['data'])
        } catch (ValidationFailed $e) {
            $this->redirect('conversation');
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

            /*$this->redirectTo(
                new Request('viewpost', ['id' => $post->id]),
                trans('fluxbb::post.edit_redirect')
            );*/
        } catch (ValidationFailed $e) {
            //$this->onErrorRedirectTo(new Request('post_edit', ['id' => $this->post->id]));
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
