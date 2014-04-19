<?php

namespace FluxBB\Controllers;

use App;
use Redirect;
use FluxBB\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Validator;
use Illuminate\Support\Contracts\MessageProviderInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class BaseController extends Controller
{
    protected function user()
    {
        return User::current();
    }

    protected function validator($attributes, $rules, $messages = array())
    {
        return \Validator::make($attributes, $rules, $messages);
    }

    protected function action($type)
    {
        $class = 'FluxBB\Actions\\' . strtoupper($type);
        return App::make($class);
    }

    protected function handleErrors($action, MessageProviderInterface $messages)
    {
        $action = get_class($this) . '@' . $action;
        return Redirect::action($class)->withInput()->withErrors($messages);
    }

    protected function notFound()
    {
        throw new NotFoundHttpException;
    }

    protected function badRequest()
    {
        throw new BadRequestHttpException;
    }

    protected function forbidden()
    {
        throw new AccessDeniedHttpException;
    }
}
