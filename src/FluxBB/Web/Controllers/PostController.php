<?php

namespace FluxBB\Web\Controllers;

use FluxBB\Server\Exception\ValidationFailed;
use FluxBB\Web\Controller;

class PostController extends Controller
{
    public function edit($id)
    {

    }

    public function store($id)
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

    public function report($id)
    {
        //
    }

    public function delete($id)
    {
        //
    }
}
