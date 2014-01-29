
<?php

namespace FluxBB\Models;

class Ban extends Base
{

    protected $table = 'bans';


    public function creator()
    {
        return $this->belongsTo('FluxBB\\Models\\User', 'ban_creator');
    }

}
