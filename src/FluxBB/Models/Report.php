<?php

namespace FluxBB\Models;

class Report extends Base
{

    protected $table = 'reports';

    public function post()
    {
        return $this->belongsTo('FluxBB\\Models\\Post');
    }

    public function topic()
    {
        return $this->belongsTo('FluxBB\\Models\\Topic');
    }

    public function forum()
    {
        return $this->belongsTo('FluxBB\\Models\\Forum');
    }

    public function reporter()
    {
        return $this->belongsTo('FluxBB\\Models\\User', 'reported_by');
    }

    public function zapper()
    {
        return $this->belongsTo('FluxBB\\Models\\User', 'zapped_by');
    }

}
