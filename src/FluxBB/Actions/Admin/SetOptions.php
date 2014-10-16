<?php

namespace FluxBB\Actions\Admin;

use FluxBB\Core\Action;
use FluxBB\Events\OptionWasChanged;
use FluxBB\Models\ConfigRepositoryInterface;
use FluxBB\Server\Request;

class SetOptions extends Action
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
        $options = $this->get('options');

        foreach ($options as $key => $value) {
            $key = 'o_' . $key;
            if ($this->config->has($key)) {
                $this->config->set($key, $value);
                $this->raise(new OptionWasChanged($key, $value));
            }
        }

        $this->config->save();
    }
}
