<?php

namespace FluxBB\Web\Controllers\Admin;

use FluxBB\Web\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        $results = $this->execute('get.settings');

        return $this->view('admin.settings.global', $results->getData());
    }

    public function email()
    {
        return $this->view('admin.settings.email');
    }

    public function maintenance()
    {
        return $this->view('admin.settings.maintenance');
    }
}
