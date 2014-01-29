<?php

namespace FluxBB\Migrations\Install;

use Schema;
use Illuminate\Database\Migrations\Migration;

class Categories extends Migration
{

    public function up()
    {
        Schema::table('categories', function($table)
        {
            $table->create();

            $table->increments('id');
            $table->string('cat_name', 80);
            $table->integer('disp_position')->default(0);
        });
    }

    public function down()
    {
        Schema::drop('categories');
    }

}