<?php

namespace FluxBB\Controllers\Admin;

use View;

class DashboardController extends BaseController
{

	public function get_index()
	{
		return View::make('fluxbb::admin.index');
	}

}
