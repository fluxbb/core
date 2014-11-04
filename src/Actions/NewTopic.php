<?php

namespace FluxBB\Actions;

use Carbon\Carbon;
use FluxBB\Core\Action;
use FluxBB\Events\UserHasPosted;
use FluxBB\Models\CategoryRepositoryInterface;
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
     * @return array
     */
    protected function run()
    {
        $slug = $this->get('slug');

        $category = $this->categories->findBySlug($slug);

        $creator = User::current();
        $now = Carbon::now();

        $conversation = (object) [
            'poster'        => $creator->username,
            'title'         => $this->get('subject'),
            'posted'        => $now,
            'last_post'     => $now,
            'last_poster'   => $creator->username,
            'category_slug' => $category->slug,
        ];

        $post = (new Post([
            'poster'	=> $creator->username,
            'poster_id'	=> $creator->id,
            'message'	=> $this->get('message'),
            'posted'	=> $now,
        ]));

        $this->categories->addNewTopic($category, $conversation, $post->toArray());

        $this->raise(new UserHasPosted($creator, $post));
    }
}
