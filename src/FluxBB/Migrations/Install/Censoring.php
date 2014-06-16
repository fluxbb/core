<?php

namespace FluxBB\Migrations\Install;

use Schema;
use Illuminate\Database\Migrations\Migration;

class Censoring extends Migration
{
    public function up()
    {
        Schema::table('censoring', function ($table) {
            $table->create();

            $table->increments('id');
            $table->string('search_for', 60)->default('');
            $table->string('replace_with', 60)->default('');

            $table->primary('id');
        });
    }

    public function down()
    {
        Schema::drop('censoring');
    }
}
