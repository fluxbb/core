<?php

namespace FluxBB\Actions\Admin;

use FluxBB\Core\Action;

class CategoriesList extends Action
{
    protected function run()
    {
        $this->data['categories'] = [];
    }
}
