<?php

namespace FluxBB\Actions;

use Carbon\Carbon;
use FluxBB\Actions\Exception\ValidationException;
use FluxBB\Validator\PostValidator;
use Symfony\Component\HttpFoundation\Request;
use FluxBB\Models\User;
use FluxBB\Models\Post;
use FluxBB\Models\Topic;

class EditPost extends Base
{
    protected $post;

    protected $validator;

    protected $message;


    public function __construct(PostValidator $validator)
    {
        $this->validator = $validator;
    }

    protected function handleRequest(Request $request)
    {
        $pid = \Route::input('id');

        $this->post = Post::with('author', 'topic')->findOrFail($pid);

        $this->message = $request->input('req_message');
    }

    /**
     * Run the action and return a response for the user.
     *
     * @throws Exception\ValidationException
     * @return void
     */
    protected function run()
    {
        $creator = User::current();

        $this->post->fill([
            'message'	=> $this->message,
            'edited'    => Carbon::now(),
            'edited_by' => $creator->username,
        ]);

        if (! $this->validator->isValid($this->post)) {
            throw new ValidationException();
        }

        $this->post->save();

        $this->trigger('post.edited', [$this->post, $creator]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    protected function makeResponse()
    {
        return $this->redirectTo(route('viewpost', ['id' => $this->post->id]))
            ->withMessage(trans('fluxbb::post.edit_redirect'));
    }

    protected function urlOnError()
    {
        return route('post_edit', ['id' => $this->post->id]);
    }
}
