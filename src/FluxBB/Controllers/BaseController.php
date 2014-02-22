<?php

namespace FluxBB\Controllers;

use FluxBB\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class BaseController extends Controller
{
    public function __construct()
    {
    }

    public function user()
    {
        return User::current();
    }

    public function validator($attributes, $rules, $messages = array())
    {
        return \Validator::make($attributes, $rules, $messages);
    }

    public function notFound()
    {
        throw new NotFoundHttpException;
    }

    public function badRequest()
    {
        throw new BadRequestHttpException;
    }

    public function forbidden()
    {
        throw new AccessDeniedHttpException;
    }
}
