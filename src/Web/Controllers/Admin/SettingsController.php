<?php

namespace FluxBB\Web\Controllers\Admin;

use FluxBB\Web\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class SettingsController extends Controller
{
    public function index()
    {
        $result = $this->execute('get.settings');

        return $this->view('admin.settings.global', $result);
    }

    public function email()
    {
        return $this->view('admin.settings.email');
    }

    public function maintenance()
    {
        return $this->view('admin.settings.maintenance');
    }

    public function set()
    {
        $this->execute('set.settings');

        return new JsonResponse();
    }
}
