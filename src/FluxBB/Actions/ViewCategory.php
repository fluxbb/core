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
        $slug = $this->request->get('slug');
        $slug = preg_replace('/\/+/', '/', '/'.$slug.'/');

        $category = $this->categories->findBySlug($slug);

        $this->data['category'] = $category;
        $this->data['categories'] = $this->categories->getByParent($slug);
        $this->data['conversations'] = $this->categories->getConversationsIn($category);
    }
}
