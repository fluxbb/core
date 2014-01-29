<?php

namespace FluxBB\Controllers\Admin;

use Input;
use Response;
use View;
use FluxBB\Models\ConfigRepositoryInterface;

class SettingsController extends BaseController
{

    /**
     * The config repository instance
     *
     * @var ConfigRepositoryInterface
     */
    protected $config;


    public function __construct(ConfigRepositoryInterface $config)
    {
        $this->config = $config;
    }

    public function getGlobal()
    {
        $globalConfig = $this->config->getGlobal();

        return View::make('fluxbb::admin.settings.global')
                   ->with('config', $globalConfig);
    }

    public function setOption($key)
    {
        $value = Input::get('value');

        $this->config->set($key, $value);
        $status = $this->config->save();

        return Response::json($status);
    }

    public function getEmail()
    {
        return View::make('fluxbb::admin.settings.email');
    }

    public function getMaintenance()
    {
        return View::make('fluxbb::admin.settings.maintenance');
    }

    //comited out below function to avoid errors
    /* public function getLogs()
    {
        return View::make('fluxbb::admin.settings.logs');
    }
    */

}
