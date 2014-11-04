<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Config extends Migration
{
    /**
     * @var string
     */
    protected $table = 'config';


    protected function create(Blueprint $table)
    {
        $table->create();

        $table->string('conf_name', 255)->default('');
        $table->text('conf_value')->nullable();

        $table->primary('conf_name');
    }
}
