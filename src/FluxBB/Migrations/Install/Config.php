<?php

namespace FluxBB\Migrations\Install;

use Schema;
use Illuminate\Database\Migrations\Migration;

class Config extends Migration
{

    public function up()
    {
        Schema::table('config', function($table)
        {
            $table->create();

            $table->string('conf_name', 255)->default('');
            $table->text('conf_value')->nullable();

            $table->primary('conf_name');
        });
    }

    public function down()
    {
        Schema::drop('config');
    }

}