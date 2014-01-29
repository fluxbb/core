<?php

namespace FluxBB\Migrations\Install;

use Schema;
use Illuminate\Database\Migrations\Migration;

class Sessions extends Migration
{
    public function up()
    {
        Schema::table('sessions', function($table) {
            $table->create();

            $table->string('id', 40);
            $table->integer('user_id')->unsigned()->default(1);
            $table->integer('created')->unsigned()->default(0);
            $table->integer('last_visit')->unsigned()->default(0);
            $table->string('last_ip', 200)->default('0.0.0.0');
            $table->text('payload');

            $table->primary('id');
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::drop('sessions');
    }
}
