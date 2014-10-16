<?php

namespace FluxBB\Web\Controllers\Admin;

use FluxBB\Web\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return $this->view('admin.index');
    }

    public function stats()
    {
        return $this->view('admin.dashboard.stats');
    }

    public function updates()
    {
        return $this->view('admin.dashboard.updates');
    }

    public function reports()
    {
        return $this->view('admin.dashboard.reports');
    }
}
