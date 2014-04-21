<?php

namespace FluxBB\View;

use FluxBB\Models\ConfigRepositoryInterface;

class FooterComposer
{
    protected $config;


    public function __construct(ConfigRepositoryInterface $config)
    {
        $this->config = $config;
    }

    public function compose($view)
    {
        $poweredBy = '<a href="http://fluxbb.org/">FluxBB</a>';
        if ($this->config->isEnabled('show_version')) {
            $poweredBy .= ' ' . $this->config->get('cur_version');
        }
        $poweredBy = trans('fluxbb::common.powered_by', array('link' => $poweredBy));

        $view->with('powered_by', $poweredBy);
    }
}
