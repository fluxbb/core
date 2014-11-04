<?php

namespace FluxBB\Events;

class OptionWasChanged
{
    /**
     * @var string
     */
    public $key;

    /**
     * @var string
     */
    public $value;


    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}
