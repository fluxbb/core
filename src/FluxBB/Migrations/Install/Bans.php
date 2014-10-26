<?php

namespace FluxBB\Migrations\Install;

use FluxBB\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Bans extends Migration
{
    /**
     * @var string
     */
    protected $table = 'bans';


    protected function create(Blueprint $table)
    {
        $table->create();

        $table->increments('id');
        $table->string('username', 200)->nullable();
        $table->string('ip', 255)->nullable();
        $table->string('email', 80)->nullable();
        $table->string('message', 255)->nullable();
        $table->integer('expire')->unsigned()->nullable();
        $table->integer('ban_creator')->unsigned()->default(0);

        $table->index('username');
    }
}
