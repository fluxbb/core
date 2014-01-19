<?php

namespace FluxBB\Controllers;

use FluxBB\Models\User,
	Illuminate\Routing\Controller,
	Illuminate\Validation\Validator;

class BaseController extends Controller
{
	public $restful = true;

	public function __construct()
	{}

	public function user()
	{
		return User::current();
	}

	public function validator($attributes, $rules, $messages = array())
	{
		return \Validator::make($attributes, $rules, $messages);//->bundle('fluxbb');
	}

}
