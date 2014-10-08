<?php

namespace FluxBB\Actions;

use Carbon\Carbon;
use FluxBB\Core\Action;
use FluxBB\Events\UserHasPosted;
use FluxBB\Models\CategoryRepositoryInterface;
use FluxBB\Server\Request;
use FluxBB\Models\User;
use FluxBB\Models\Post;

class NewTopic extends Action
{
    protected $categories;


    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->categories = $repository;
    }

    /**
     * Run the action and return a response for the user.
     *
     * @return void
     */
    protected function run()
    {
        $slug = $this->request->get('slug');
        $slug = preg_replace('/\/+/', '/', '/'.$slug.'/');

        $category = $this->categories->findBySlug($slug);

        $creator = User::current();
        $now = Carbon::now();

        $conversation = (object) [
            'poster'        => $creator->username,
            'title'         => $this->request->get('subject'),
            'posted'        => $now,
            'last_post'     => $now,
            'last_poster'   => $creator->username,
            'category_slug' => $category->slug,
        ];

        $post = (new Post([
            'poster'	=> $creator->username,
            'poster_id'	=> $creator->id,
            'message'	=> $this->request->get('message'),
            'posted'	=> $now,
        ]));

        $this->onErrorRedirectTo(new Request('new_topic', ['slug' => $category->slug]));

        $this->categories->addNewTopic($category, $conversation, $post->toArray());

        $this->raise(new UserHasPosted($creator, $post));

        $this->redirectTo(
            new Request('conversation', ['id' => $conversation->id]),
            trans('fluxbb::topic.topic_added')
        );
    }
}
