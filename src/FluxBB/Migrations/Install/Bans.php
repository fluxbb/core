<?php

namespace FluxBB\Migrations\Install;

use Schema;
use Illuminate\Database\Migrations\Migration;

class Bans extends Migration
{

    public function up()
    {
        Schema::table('bans', function($table)
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
        });
    }

    public function down()
    {
        Schema::drop('bans');
    }

}