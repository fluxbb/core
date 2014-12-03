<?php

namespace FluxBB\Web\Controllers;

use FluxBB\Server\Exception\ValidationFailed;
use FluxBB\Web\Controller;

class PostController extends Controller
{
    public function create()
    {
        try {
            $result = $this->execute('reply.topic');
            $post = $result['post'];

            return $this->redirectTo('viewpost', ['id' => $post->id])
                        ->withMessage(trans('fluxbb::post.post_added'));
        } catch (ValidationFailed $e) {
            return $this->redirectTo('conversation')
                        ->withInput()
                        ->withErrors($e);
        }
    }

    public function editForm()
    {

    }

    public function edit()
    {
        try {
            $result = $this->execute('edit.post');
            $post = $result['post'];

            return $this->redirectTo('viewpost', ['id' => $post->id])
                        ->withMessage(trans('fluxbb::post.edit_redirect'));
        } catch (ValidationFailed $e) {
            return $this->redirectTo('post_edit')
                        ->withInput()
                        ->withErrors($e);
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
