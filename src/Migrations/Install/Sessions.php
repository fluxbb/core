<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Sessions extends Migration
{
    /**
     * @var string
     */
    protected $table = 'sessions';


    protected function create(Blueprint $table)
    {
        $table->create();

        $table->string('id', 40);
        $table->integer('user_id')->unsigned()->default(1);
        $table->integer('created')->unsigned()->default(0);
        $table->integer('last_activity')->unsigned()->default(0);
        $table->string('last_ip', 200)->default('0.0.0.0');
        $table->text('payload');

        $table->primary('id');
        $table->index('user_id');
    }
}
