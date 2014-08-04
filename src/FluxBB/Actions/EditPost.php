<?php

namespace FluxBB\Actions;

use Carbon\Carbon;
use FluxBB\Actions\Exception\ValidationException;
use FluxBB\Validator\PostValidator;
use FluxBB\Server\Request;
use FluxBB\Models\User;
use FluxBB\Models\Post;

class EditPost extends Base
{
    protected $post;

    protected $validator;


    public function __construct(PostValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Run the action and return a response for the user.
     *
     * @throws Exception\ValidationException
     * @return void
     */
    protected function run()
    {
        $pid = $this->request->get('id');
        $this->post = Post::with('author', 'topic')->findOrFail($pid);

        $this->onErrorRedirectTo(new Request('post_edit', ['id' => $this->post->id]));

        $creator = User::current();
        $this->post->fill([
            'message'	=> $this->request->get('req_message'),
            'edited'    => Carbon::now(),
            'edited_by' => $creator->username,
        ]);

        if (! $this->validator->isValid($this->post)) {
            throw new ValidationException();
        }

        $this->post->save();
        $this->trigger('post.edited', [$this->post, $creator]);

        $this->redirectTo(new Request('viewpost', ['id' => $this->post->id]));
        // ->withMessage(trans('fluxbb::post.edit_redirect'));
    }
}
