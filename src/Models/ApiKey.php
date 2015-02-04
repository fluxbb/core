<?php

namespace FluxBB\Models;

class ApiKey extends Base 
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'apikeys';
    
    protected $fillable = array(
        'api_key',
        'create_keys'
    );
    
}
