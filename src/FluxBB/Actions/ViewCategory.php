<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\CategoryRepositoryInterface;

class ViewCategory extends Action
{
    protected $categories;


    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->categories = $repository;
    }

    protected function run()
    {
        $slug = $this->get('slug');

        $category = $this->categories->findBySlug($slug);

        return [
            'category'      => $category,
            'categories'    => $this->categories->getByParent($slug),
            'conversations' => $this->categories->getConversationsIn($category),
        ];
    }
}
