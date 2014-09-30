<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\TopicRepositoryInterface;

class ViewTopic extends Action
{
    protected $topics;


    public function __construct(TopicRepositoryInterface $repository)
    {
        $this->topics = $repository;
    }

    protected function run()
    {
        $id = $this->request->get('id');

        $topic = $this->topics->findById($id);

        $this->data['topic'] = $topic;
        $this->data['posts'] = $this->topics->getPostsIn($topic);
    }
}
