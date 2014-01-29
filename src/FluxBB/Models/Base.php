<?php

namespace FluxBB\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Base extends Model
{
    public $timestamps = false;

    protected $rules = array();

    protected $errors = array();


    public function valid()
    {
        if (empty($this->rules)) return true;

        $v = Validator::make($this->attributes, $this->rules);
        return $v->passes();
    }

    public function invalid()
    {
        return ! $this->valid();
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
