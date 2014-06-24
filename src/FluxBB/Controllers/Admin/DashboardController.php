<?php

namespace FluxBB\Controllers\Admin;

use View;

class DashboardController extends BaseController
{
    public function getUpdates()
    {
        return View::make('fluxbb::admin.dashboard.updates');
    }

    public function getStats()
    {
        return View::make('fluxbb::admin.dashboard.stats');
    }

    public function getReports()
    {
        return View::make('fluxbb::admin.dashboard.reports');
    }

    public function getNotes()
    {
        return View::make('fluxbb::admin.dashboard.notes');
    }

    public function getBackup()
    {
        return View::make('fluxbb::admin.dashboard.backup');
    }
}
