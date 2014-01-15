<?php

namespace FluxBB\Controllers\Admin;

use Input;
use Response;
use Validator;
use FluxBB\Models\Config;

class AjaxController extends BaseController
{

	public function post_board_config()
	{
		$rules = array(
			'board_title'		=> 'required',
			'board_description'	=> 'required',
		);

		$validation = Validator::make(Input::all(), $rules);

		if ($validation->fails())
		{
			return Response::json(array(
				'status'	=> 'failed',
				'errors'	=> $validation->errors(),
			));
		}

		Config::set('o_board_title', Input::get('board_title'));
		Config::set('o_board_desc', Input::get('board_description'));
		Config::save();

		return 'success';
	}

}
