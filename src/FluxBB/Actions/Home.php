<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\CategoryRepository;

class Home extends Action
{
    /**
     * The category repository instance.
     *
     * @var \FluxBB\Models\CategoryRepository
     */
    protected $categories;


    public function __construct(CategoryRepository $repository)
    {
        $this->categories = $repository;
    }

    protected function run()
    {
        $category = $this->categories->findBySlug('/');

        $this->data['category'] = $category;
        $this->data['categories'] = $this->categories->getByParent('/');
        $this->data['conversations'] = $this->categories->getConversationsIn($category);
    }
}
