<?php

namespace FluxBB\Actions\Admin;

use FluxBB\Core\Action;
use FluxBB\Models\ConfigRepositoryInterface;
use FluxBB\Server\Request;

class SetOption extends Action
{
    /**
     * @var \FluxBB\Models\ConfigRepositoryInterface
     */
    protected $config;


    public function __construct(ConfigRepositoryInterface $config)
    {
        $this->config = $config;
    }

    /**
     * Run the action and return a response for the user.
     *
     * @return void
     */
    protected function run()
    {
        $key = 'o_' . $this->request->get('key');
        $value = $this->request->get('value');

        if ($this->config->has($key)) {
            $this->config->set($key, $value);
            $this->config->save();
            $this->trigger('option.changed', [$key, $value]);
        }
    }
}
