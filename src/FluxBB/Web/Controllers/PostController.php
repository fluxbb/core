<?php

namespace FluxBB\Web\Controllers;

use FluxBB\Server\Exception\ValidationFailed;
use FluxBB\Web\Controller;

class PostController extends Controller
{
    public function create()
    {
        try {
            $post = $this->execute('reply_handler')->getData()['post'];

            return $this->redirectTo('viewpost', ['id' => $post->id])
                        ->withMessage(trans('fluxbb::post.post_added'));
        } catch (ValidationFailed $e) {
            return $this->redirectTo('conversation', $this->input);
        }
    }

    public function editForm()
    {

    }

    public function edit()
    {
        try {
            $post = $this->execute('post_edit_handler')->getData()['post'];

            return $this->redirectTo('viewpost', ['id' => $post->id])
                        ->withMessage(trans('fluxbb::post.edit_redirect'));
        } catch (ValidationFailed $e) {
            return $this->redirectTo('post_edit', $this->input);
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
