<?php

namespace FluxBB\View;

use FluxBB\Core;
use FluxBB\Models\ConfigRepositoryInterface;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\View\View as ViewContract;

class GlobalsComposer
{
    protected $appConfig;

    protected $fluxbbConfig;


    public function __construct(Repository $app, ConfigRepositoryInterface $fluxbb)
    {
        $this->appConfig = $app;
        $this->fluxbbConfig = $fluxbb;
    }

    public function compose(ViewContract $view)
    {
        $view->with('language', trans('fluxbb::common.lang_identifier'))
             ->with('direction', trans('fluxbb::common.lang_direction'))
             ->with('charset', $this->appConfig->get('fluxbb.database.charset'))
             ->with('head', '')
             ->with('page', 'index')
             ->with('board_title', $this->fluxbbConfig->get('o_board_title'))
             ->with('board_description', $this->fluxbbConfig->get('o_board_desc'))
             ->with('version', Core::version())
             ->with('navlinks', '<ul><li><a href="#">Home</a></li></ul>')
             ->with('status', 'You are not logged in.')
             ->with('announcement', '');
    }
}
